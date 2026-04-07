#!/bin/bash
# ============================================================
# TRAITER LA QUEUE DE DÉPLOIEMENT
# ============================================================
# Ce script est exécuté par cron toutes les minutes pour créer
# les containers Docker des écoles en attente.
# 
# Installation cron:
#   * * * * * /opt/docker/apps/eduflow/scripts/process-deploy-queue.sh >> /var/log/eduflow/cron-deploy.log 2>&1
# ============================================================

set -e

# Configuration
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="/opt/docker/apps/eduflow"
LOG_DIR="${LOG_DIR:-/var/log/eduflow}"
# Fallback vers le répertoire du projet si pas de permission sur /var/log
if [ ! -w "$LOG_DIR" ] && [ ! -d "$LOG_DIR" ]; then
    LOG_DIR="$PROJECT_DIR/logs"
    mkdir -p "$LOG_DIR" 2>/dev/null || true
fi
LOG_FILE="$LOG_DIR/queue-processor.log"
LOCK_FILE="/tmp/eduflow-deploy-queue.lock"
MAX_ATTEMPTS=3

# Mode dry-run (simulation sans Docker)
DRY_RUN=false
if [ "$1" = "--dry-run" ] || [ "$1" = "--test" ]; then
    DRY_RUN=true
    echo "🧪 MODE TEST/SIMULATION - Aucun container ne sera créé"
fi

# Vérifier l'environnement
if [ "$DRY_RUN" = false ]; then
    # Vérifier qu'on est sur le serveur (ou un environnement avec Docker)
    if ! command -v docker &> /dev/null; then
        echo "⚠️  ATTENTION: Docker n'est pas disponible"
        echo ""
        echo "Ce script doit être exécuté sur le serveur de production où :"
        echo "   - Docker est installé et accessible"
        echo "   - MySQL/MariaDB client est installé (ou container mysql)"
        echo "   - Le projet est dans /opt/docker/apps/eduflow"
        echo ""
        echo "Pour tester en local, utilisez: $0 --dry-run"
        echo ""
        exit 1
    fi
    
    # Vérifier que le container mysql existe (mysql ou edu_mysql)
    MYSQL_CONTAINER=$(docker ps --format '{{.Names}}' | grep -E '^(mysql|edu_mysql)' | head -1)
    if [ -z "$MYSQL_CONTAINER" ]; then
        echo "⚠️  ATTENTION: Container MySQL non trouvé"
        echo ""
        echo "Assurez-vous que le container MySQL tourne :"
        echo "   docker compose up -d mysql"
        echo ""
        exit 1
    fi
fi

# Créer les répertoires de logs
mkdir -p "$LOG_DIR" 2>/dev/null || true

# Fonction de logging
log() {
    local msg="[$(date '+%Y-%m-%d %H:%M:%S')] $1"
    echo "$msg"
  #  echo "$msg" >> "$LOG_FILE" 2>/dev/null || true
}

log_error() {
    log "❌ ERROR: $1"
}

log_info() {
    log "ℹ️  INFO: $1"
}

log_success() {
    log "✅ SUCCESS: $1"
}

# Vérifier le lock (éviter les exécutions simultanées)
if [ -f "$LOCK_FILE" ]; then
    LOCK_PID=$(cat "$LOCK_FILE" 2>/dev/null)
    if [ -n "$LOCK_PID" ] && kill -0 "$LOCK_PID" 2>/dev/null; then
        log_info "Un autre processus est en cours (PID: $LOCK_PID). Sortie."
        exit 0
    else
        # Le processus précédent est mort, on supprime le lock
        rm -f "$LOCK_FILE"
    fi
fi

# Créer le lock file
echo $$ > "$LOCK_FILE"

# Nettoyer le lock à la sortie
trap 'rm -f "$LOCK_FILE"' EXIT

log_info "=== DÉMARRAGE TRAITEMENT QUEUE ==="

# Récupérer les credentials depuis l'environnement ou le fichier .env
DB_HOST="${DB_HOST:-mysql}"
DB_NAME="${DB_NAME:-edu_platform}"
DB_USER="${DB_USER:-edu_user}"
DB_PASS="${DB_PASS:-}"

# Si DB_PASS n'est pas défini, essayer de le récupérer du fichier .env
if [ -z "$DB_PASS" ] && [ -f "$PROJECT_DIR/.env" ]; then
    DB_PASS=$(grep "DB_PASS=" "$PROJECT_DIR/.env" | cut -d= -f2 | tr -d '"')
fi

if [ -z "$DB_PASS" ]; then
    log_error "Mot de passe DB non trouvé"
    exit 1
fi

# Détecter si on peut utiliser mysql client ou docker
USE_DOCKER_MYSQL=false
if ! command -v mysql &> /dev/null; then
    log_info "Client mysql non trouvé, utilisation de Docker pour MySQL"
    USE_DOCKER_MYSQL=true
fi

# Vérifier que MySQL est accessible (directement ou via Docker)
if [ "$DRY_RUN" = false ] && [ "$USE_DOCKER_MYSQL" = true ]; then
    # Vérifier que le container mysql existe et tourne
    if ! docker ps | grep -q "mysql"; then
        log_error "Container mysql non trouvé et client mysql non installé"
        log_info "Installez mysql-client ou assurez-vous que le container 'mysql' tourne"
        exit 1
    fi
    log_info "Utilisation du container Docker 'mysql' pour les requêtes"
elif [ "$DRY_RUN" = false ] && ! command -v mysql &> /dev/null && ! command -v docker &> /dev/null; then
    log_error "Ni mysql client ni Docker disponible"
    exit 1
fi

# Fonction pour exécuter une requête SQL
run_sql() {
    local query="$1"
    
    if [ "$USE_DOCKER_MYSQL" = true ]; then
        # Trouver le container MySQL (peut s'appeler 'mysql' ou 'edu_mysql')
        MYSQL_CONTAINER=$(docker ps --format '{{.Names}}' | grep -E '^(mysql|edu_mysql)' | head -1)
        if [ -z "$MYSQL_CONTAINER" ]; then
            log_error "Container MySQL non trouvé"
            return 1
        fi
        docker exec -i "$MYSQL_CONTAINER" mysql -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" -N -e "$query" 2>/dev/null
    else
        # Utiliser le client mysql local
        mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" -N -e "$query" 2>/dev/null
    fi
}

# Fonction pour mettre à jour le statut d'une entrée de queue
update_queue_status() {
    local queue_id="$1"
    local status="$2"
    local output="$3"
    local error="$4"
    
    local escaped_output=$(echo "$output" | sed "s/'/\\'/g" | cut -c1-1000)
    local escaped_error=$(echo "$error" | sed "s/'/\\'/g" | cut -c1-500)
    
    local now=$(date '+%Y-%m-%d %H:%M:%S')
    
    if [ "$status" = "completed" ]; then
        run_sql "UPDATE school_deploy_queue 
                SET status='$status', 
                    output_log='$escaped_output',
                    completed_at='$now'
                WHERE id=$queue_id"
    elif [ "$status" = "failed" ]; then
        run_sql "UPDATE school_deploy_queue 
                SET status='$status', 
                    output_log='$escaped_output',
                    error_message='$escaped_error',
                    completed_at='$now'
                WHERE id=$queue_id"
    else
        run_sql "UPDATE school_deploy_queue 
                SET status='$status', 
                    output_log='$escaped_output'
                WHERE id=$queue_id"
    fi
}

# Fonction pour incrémenter le compteur de tentatives
increment_attempts() {
    local queue_id="$1"
    run_sql "UPDATE school_deploy_queue 
            SET attempts = attempts + 1, 
                processed_at='$(date '+%Y-%m-%d %H:%M:%S')'
            WHERE id=$queue_id"
}

# Fonction pour créer une école
deploy_school() {
    local queue_id="$1"
    local school_id="$2"
    local slug="$3"
    local domain="$4"
    local name="$5"
    
    log_info "Déploiement école: $name (slug: $slug, domain: $domain)"
    
    local output=""
    local error_msg=""
    local success=false
    
    # Vérifier que le script add-school.sh existe
    if [ ! -f "$SCRIPT_DIR/add-school.sh" ]; then
        error_msg="Script add-school.sh non trouvé"
        log_error "$error_msg"
        update_queue_status "$queue_id" "failed" "" "$error_msg"
        return 1
    fi
    
    # Vérifier que PostgreSQL et Redis tournent
    if ! docker ps | grep -q "edu_postgres"; then
        error_msg="PostgreSQL n'est pas démarré"
        log_error "$error_msg"
        update_queue_status "$queue_id" "failed" "" "$error_msg"
        return 1
    fi
    
    if ! docker ps | grep -q "edu_redis"; then
        error_msg="Redis n'est pas démarré"
        log_error "$error_msg"
        update_queue_status "$queue_id" "failed" "" "$error_msg"
        return 1
    fi
    
    # Exécuter le script de création
    log_info "Exécution de add-school.sh $slug $domain '$name'"
    
    set +e
    output=$("$SCRIPT_DIR/add-school.sh" "$slug" "$domain" "$name" 2>&1)
    exit_code=$?
    set -e
    
    if [ $exit_code -eq 0 ]; then
        log_success "École $slug déployée avec succès"
        update_queue_status "$queue_id" "completed" "$output" ""
        success=true
        
        # Envoyer une notification (optionnel)
        # send_notification "$school_id" "success"
    else
        error_msg="Échec du déploiement (exit code: $exit_code)"
        log_error "$error_msg"
        log_error "Output: $output"
        
        # Vérifier si on doit réessayer
        local attempts=$(run_sql "SELECT attempts FROM school_deploy_queue WHERE id=$queue_id")
        if [ "$attempts" -lt "$MAX_ATTEMPTS" ]; then
            log_info "Tentative $attempts/$MAX_ATTEMPTS échouée, nouvelle tentative lors du prochain cycle"
            update_queue_status "$queue_id" "pending" "$output" "$error_msg"
        else
            log_error "Nombre max de tentatives atteint, marqué comme échoué"
            update_queue_status "$queue_id" "failed" "$output" "$error_msg"
        fi
        success=false
    fi
    
    # Archiver dans l'historique
    local action_status=$([ "$success" = true ] && echo "completed" || echo "failed")
    run_sql "INSERT INTO school_deploy_history 
            (school_id, slug, domain, action, status, output_log, error_message, executed_by)
            VALUES ($school_id, '$slug', '$domain', 'create', '$action_status', 
                    '$(echo "$output" | sed "s/'/\\'/g" | cut -c1-1000)', 
                    '$(echo "$error_msg" | sed "s/'/\\'/g")', 
                    'cron')"
    
    # Retourner le statut explicitement
    if [ "$success" = true ]; then
        return 0
    else
        return 1
    fi
}

# === TRAITEMENT PRINCIPAL ===

# Récupérer les écoles en attente
log_info "Récupération des écoles en attente..."

pending_jobs=$(run_sql "SELECT id, school_id, slug, domain, name, attempts 
                        FROM school_deploy_queue 
                        WHERE status='pending' AND attempts < $MAX_ATTEMPTS 
                        ORDER BY created_at ASC 
                        LIMIT 5")

if [ -z "$pending_jobs" ]; then
    log_info "Aucune école en attente de déploiement"
    exit 0
fi

log_info "$(echo "$pending_jobs" | wc -l) école(s) en attente"

# Traiter chaque école
while IFS=$'\t' read -r queue_id school_id slug domain name attempts; do
    [ -z "$queue_id" ] && continue
    
    log_info "----------------------------------------"
    log_info "Traitement: $name (ID: $queue_id, tentatives: $attempts)"
    
    # Marquer comme en cours de traitement
    run_sql "UPDATE school_deploy_queue SET status='processing' WHERE id=$queue_id"
    increment_attempts "$queue_id"
    
    # Déployer
    if deploy_school "$queue_id" "$school_id" "$slug" "$domain" "$name"; then
        log_success "Déploiement terminé pour $slug"
    else
        log_error "Déploiement échoué pour $slug"
    fi
    
    # Petite pause entre les déploiements
    sleep 2
    
done <<< "$pending_jobs"

log_info "=== FIN TRAITEMENT QUEUE ==="
log_info ""
