#!/bin/bash
# ============================================================
# AJOUTER UNE ÉCOLE - Avec logging complet
# ============================================================
# Usage: ./add-school.sh <slug> <sous-domaine> [nom_école]
# Exemple: ./add-school.sh colegio-san-jose colegiosanjose.henrimorel.com "Colegio San José"
# ============================================================

set -e

# Configuration des logs
LOG_DIR="/var/log/eduflow"
LOG_FILE="$LOG_DIR/school-creation.log"
TIMESTAMP=$(date '+%Y-%m-%d_%H-%M-%S')
EXEC_LOG="$LOG_DIR/add-school-${TIMESTAMP}.log"

# Créer le répertoire de logs si nécessaire
if ! mkdir -p "$LOG_DIR" 2>/dev/null; then
    # Fallback vers le répertoire du script si /var/log n'est pas accessible
    SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
    PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
    LOG_DIR="$PROJECT_DIR/logs"
    mkdir -p "$LOG_DIR" 2>/dev/null || true
    LOG_FILE="$LOG_DIR/school-creation.log"
    EXEC_LOG="$LOG_DIR/add-school-${TIMESTAMP}.log"
fi

# Fonction de logging
log() {
    local msg="[$(date '+%Y-%m-%d %H:%M:%S')] $1"
    echo "$msg" | tee -a "$EXEC_LOG" 2>/dev/null || echo "$msg"
    echo "$msg" >> "$LOG_FILE" 2>/dev/null || true
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

log_warn() {
    log "⚠️  WARN: $1"
}

# Rediriger stderr vers le log
exec 2> >(tee -a "$EXEC_LOG" >&2)

SCHOOL_SLUG=$1
SCHOOL_DOMAIN=$2
SCHOOL_NAME=${3:-"$SCHOOL_SLUG"}

log_info "=== DÉMARRAGE CRÉATION ÉCOLE ==="
log_info "Script: $0"
log_info "Arguments: slug='$SCHOOL_SLUG' domain='$SCHOOL_DOMAIN' name='$SCHOOL_NAME'"
log_info "User: $(whoami)"
log_info "PWD: $(pwd)"
log_info "Log file: $EXEC_LOG"

# Validation des arguments
if [ -z "$SCHOOL_SLUG" ] || [ -z "$SCHOOL_DOMAIN" ]; then
    log_error "Arguments manquants"
    echo "❌ Usage: $0 <slug> <sous-domaine> [nom_école]"
    echo "   Exemple: $0 colegio-san-jose colegiosanjose.henrimorel.com 'Colegio San José'"
    exit 1
fi

# Vérifier que le slug est valide (pas d'espaces, caractères spéciaux)
if [[ ! "$SCHOOL_SLUG" =~ ^[a-z0-9_-]+$ ]]; then
    log_error "Slug invalide: '$SCHOOL_SLUG' (caractères autorisés: a-z, 0-9, -, _)"
    exit 1
fi

# Vérifier que PostgreSQL et Redis tournent
log_info "Vérification des services..."

if ! docker ps | grep -q "edu_postgres"; then
    log_error "PostgreSQL n'est pas démarré !"
    log_info "Containers Docker actifs:"
    docker ps 2>&1 | tee -a "$EXEC_LOG" || true
    echo "❌ PostgreSQL n'est pas démarré !"
    echo "   Lancez: docker compose -f docker-compose.infrastructure.yml up -d"
    exit 1
fi
log_success "PostgreSQL OK"

if ! docker ps | grep -q "edu_redis"; then
    log_error "Redis n'est pas démarré !"
    echo "❌ Redis n'est pas démarré !"
    exit 1
fi
log_success "Redis OK"

# Vérifier les réseaux Docker
log_info "Vérification des réseaux Docker..."
NETWORKS=$(docker network ls --format '{{.Name}}')
log_info "Réseaux disponibles: $NETWORKS"

if ! echo "$NETWORKS" | grep -q "eduflow_edu_internal"; then
    log_error "Réseau eduflow_edu_internal non trouvé !"
    docker network ls 2>&1 | tee -a "$EXEC_LOG" || true
    exit 1
fi
log_success "Réseau eduflow_edu_internal OK"

if ! echo "$NETWORKS" | grep -q "edu_proxy"; then
    log_error "Réseau edu_proxy non trouvé !"
    exit 1
fi
log_success "Réseau edu_proxy OK"

# Répertoire de l'école
SCHOOL_DIR="/opt/docker/apps/${SCHOOL_SLUG}"
TEMPLATE_PATH="/opt/docker/apps/eduflow/nextjs-template"

log_info "Configuration:"
log_info "  Slug: $SCHOOL_SLUG"
log_info "  Domaine: $SCHOOL_DOMAIN"
log_info "  Nom: $SCHOOL_NAME"
log_info "  Dossier: $SCHOOL_DIR"
log_info "  Template: $TEMPLATE_PATH"

# Vérifier si l'école existe déjà
if [ -d "$SCHOOL_DIR" ]; then
    log_warn "Le dossier $SCHOOL_DIR existe déjà !"
    ls -la "$SCHOOL_DIR" 2>&1 | tee -a "$EXEC_LOG" || true
fi

if docker ps | grep -q "school_${SCHOOL_SLUG}"; then
    log_warn "Un container school_${SCHOOL_SLUG} existe déjà !"
    docker ps | grep "school_${SCHOOL_SLUG}" 2>&1 | tee -a "$EXEC_LOG" || true
fi

# Créer le dossier
log_info "Création du dossier $SCHOOL_DIR..."
if ! mkdir -p "$SCHOOL_DIR" 2>&1 | tee -a "$EXEC_LOG"; then
    log_error "Impossible de créer le dossier $SCHOOL_DIR"
    ls -la /opt/docker/apps/ 2>&1 | tee -a "$EXEC_LOG" || true
    exit 1
fi
log_success "Dossier créé"

# Vérifier que le template existe
if [ ! -d "$TEMPLATE_PATH" ]; then
    log_error "Template non trouvé: $TEMPLATE_PATH"
    ls -la /opt/docker/apps/eduflow/ 2>&1 | tee -a "$EXEC_LOG" || true
    exit 1
fi
log_success "Template trouvé"

# Récupérer le mot de passe PostgreSQL depuis l'env
log_info "Récupération du mot de passe PostgreSQL..."
POSTGRES_PASSWORD=$(docker exec edu_postgres env | grep POSTGRES_PASSWORD | cut -d= -f2)
if [ -z "$POSTGRES_PASSWORD" ]; then
    log_error "Impossible de récupérer POSTGRES_PASSWORD"
    docker exec edu_postgres env 2>&1 | tee -a "$EXEC_LOG" || true
    exit 1
fi
log_success "Mot de passe PostgreSQL récupéré (masqué)"

# Générer le docker-compose
log_info "Génération du fichier docker-compose.yml..."
cat > "$SCHOOL_DIR/docker-compose.yml" << EOF
# École: $SCHOOL_NAME ($SCHOOL_DOMAIN)
# Créée le: $(date)

services:
  school_${SCHOOL_SLUG}:
    image: node:20-alpine
    container_name: school_${SCHOOL_SLUG}
    restart: unless-stopped
    working_dir: /app
    # Important: -H 0.0.0.0 pour écouter sur toutes les interfaces
    command: sh -c "npm ci && npm run build && npx next start -H 0.0.0.0"
    environment:
      - SCHOOL_SLUG=${SCHOOL_SLUG}
      - SCHOOL_NAME=${SCHOOL_NAME}
      - SCHOOL_DOMAIN=${SCHOOL_DOMAIN}
      - DATABASE_URL=postgresql://edu_admin:${POSTGRES_PASSWORD}@postgres:5432/edu_platform
      - REDIS_URL=redis://redis:6379
      - NODE_ENV=production
      - PORT=3000
    volumes:
      - ${TEMPLATE_PATH}:/app
    networks:
      - eduflow_edu_internal
      - edu_proxy
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.rule=Host(\`${SCHOOL_DOMAIN}\`) || Host(\`www.${SCHOOL_DOMAIN}\`)"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.entrypoints=websecure"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.tls.certresolver=letsencrypt"
      - "traefik.http.services.school-${SCHOOL_SLUG}.loadbalancer.server.port=3000"

networks:
  eduflow_edu_internal:
    external: true
  edu_proxy:
    external: true
EOF

if [ ! -f "$SCHOOL_DIR/docker-compose.yml" ]; then
    log_error "Fichier docker-compose.yml non créé !"
    exit 1
fi
log_success "Fichier docker-compose.yml créé"
cat "$SCHOOL_DIR/docker-compose.yml" 2>&1 | tee -a "$EXEC_LOG" || true

# Démarrer l'école
log_info "Démarrage du container..."
cd "$SCHOOL_DIR"
if ! docker compose up -d 2>&1 | tee -a "$EXEC_LOG"; then
    log_error "docker compose up a échoué"
    echo "❌ Échec du démarrage avec docker compose"
    exit 1
fi

log_info "Attente du démarrage (5s)..."
sleep 5

# Vérification
log_info "Vérification du container..."
if docker ps | grep -q "school_${SCHOOL_SLUG}"; then
    log_success "Container school_${SCHOOL_SLUG} est en cours d'exécution"
    docker ps | grep "school_${SCHOOL_SLUG}" 2>&1 | tee -a "$EXEC_LOG" || true
else
    log_error "Container school_${SCHOOL_SLUG} n'est pas en cours d'exécution"
    echo "❌ Échec du démarrage"
    log_info "Logs du container:"
    docker logs "school_${SCHOOL_SLUG}" 2>&1 | tail -30 | tee -a "$EXEC_LOG" || true
    log_info "Containers existants:"
    docker ps -a 2>&1 | tee -a "$EXEC_LOG" || true
    exit 1
fi

# Vérifier les labels Traefik
log_info "Vérification des labels Traefik..."
LABELS=$(docker inspect "school_${SCHOOL_SLUG}" --format '{{json .Config.Labels}}' 2>&1)
echo "Labels: $LABELS" | tee -a "$EXEC_LOG" || true

log_info "Vérification des réseaux..."
NETWORKS=$(docker inspect "school_${SCHOOL_SLUG}" --format '{{range .NetworkSettings.Networks}}{{.}} {{end}}' 2>&1)
echo "Réseaux: $NETWORKS" | tee -a "$EXEC_LOG" || true

log_success "=== ÉCOLE CRÉÉE AVEC SUCCÈS ==="
log_info "URL: https://${SCHOOL_DOMAIN}"
log_info "Dossier: ${SCHOOL_DIR}"
log_info "Log complet: $EXEC_LOG"
log_info "Log global: $LOG_FILE"

echo ""
echo "✅ École '$SCHOOL_NAME' déployée avec succès !"
echo ""
echo "🌐 URL: https://${SCHOOL_DOMAIN}"
echo "📁 Dossier: ${SCHOOL_DIR}"
echo "📝 Log: $EXEC_LOG"
echo ""
echo "📋 Commandes utiles:"
echo "   Logs:     docker logs -f school_${SCHOOL_SLUG}"
echo "   Stop:     docker compose -f ${SCHOOL_DIR}/docker-compose.yml down"
echo "   Restart:  docker compose -f ${SCHOOL_DIR}/docker-compose.yml restart"
