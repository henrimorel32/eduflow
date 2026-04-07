#!/bin/bash
# ============================================================
# INSTALLATION COMPLÈTE DU SYSTÈME DE QUEUE
# ============================================================
# Ce script installe tout le système de déploiement asynchrone
# en une seule commande.
# ============================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"

echo "🚀 Installation du système de queue de déploiement"
echo "==================================================="
echo ""

# Couleurs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Fonctions
success() { echo -e "${GREEN}✅ $1${NC}"; }
warning() { echo -e "${YELLOW}⚠️  $1${NC}"; }
error() { echo -e "${RED}❌ $1${NC}"; }

# 1. Vérifier les dépendances
echo "📋 Vérification des dépendances..."

if ! command -v mysql &> /dev/null; then
    error "mysql client n'est pas installé"
    exit 1
fi

if ! command -v docker &> /dev/null; then
    error "docker n'est pas installé"
    exit 1
fi

success "Dépendances OK"
echo ""

# 2. Créer les tables SQL
echo "🗄️  Création des tables SQL..."

if [ -f "$PROJECT_DIR/mysql/add_deploy_queue_table.sql" ]; then
    # Déterminer les credentials
    DB_HOST="${DB_HOST:-mysql}"
    DB_NAME="${DB_NAME:-edu_platform}"
    DB_USER="${DB_USER:-edu_user}"
    
    if [ -f "$PROJECT_DIR/.env.local" ]; then
        DB_PASS=$(grep "DB_PASS=" "$PROJECT_DIR/.env.local" | cut -d= -f2 | head -1)
    elif [ -f "$PROJECT_DIR/.env" ]; then
        DB_PASS=$(grep "DB_PASS=" "$PROJECT_DIR/.env" | cut -d= -f2 | head -1)
    fi
    
    if [ -z "$DB_PASS" ]; then
        warning "Mot de passe DB non trouvé dans .env"
        read -s -p "Entrez le mot de passe MySQL pour $DB_USER: " DB_PASS
        echo
    fi
    
    # Exécuter le SQL
    if mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$PROJECT_DIR/mysql/add_deploy_queue_table.sql" 2>/dev/null; then
        success "Tables créées avec succès"
    else
        error "Échec de création des tables"
        echo "Vérifiez vos credentials et que MySQL est accessible"
        exit 1
    fi
else
    error "Fichier SQL non trouvé: mysql/add_deploy_queue_table.sql"
    exit 1
fi
echo ""

# 3. Rendre les scripts exécutables
echo "🔧 Configuration des permissions..."
chmod +x "$SCRIPT_DIR/process-deploy-queue.sh"
chmod +x "$SCRIPT_DIR/add-school.sh"
chmod +x "$SCRIPT_DIR/add-school-remote.sh"
success "Scripts exécutables"
echo ""

# 4. Créer les répertoires de logs
echo "📁 Création des répertoires de logs..."
mkdir -p /var/log/eduflow 2>/dev/null || sudo mkdir -p /var/log/eduflow || true
success "Répertoires de logs créés"
echo ""

# 5. Configuration du cron (si sur serveur)
echo "⏰ Configuration du cron..."
if [ -d "/opt/docker/apps/eduflow" ]; then
    # On est sur le serveur
    if command -v crontab &> /dev/null; then
        CRON_JOB="* * * * * $SCRIPT_DIR/process-deploy-queue.sh >> /var/log/eduflow/cron-deploy.log 2>&1"
        
        # Vérifier si déjà configuré
        if ! crontab -l 2>/dev/null | grep -q "process-deploy-queue.sh"; then
            (crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -
            success "Cron configuré"
        else
            warning "Cron déjà configuré"
        fi
    else
        warning "crontab non disponible"
    fi
else
    warning "Pas sur le serveur de production - cron non configuré"
    echo "   Sur le serveur, exécutez: ./scripts/setup-deploy-cron.sh"
fi
echo ""

# 6. Test de l'API
echo "🧪 Test de l'API..."
if [ -f "$PROJECT_DIR/php/src/api/deploy-school.php" ]; then
    success "API déploy-school.php présente"
    
    # Vérifier la syntaxe PHP
    if php -l "$PROJECT_DIR/php/src/api/deploy-school.php" > /dev/null 2>&1; then
        success "Syntaxe PHP OK"
    else
        warning "Erreur de syntaxe PHP détectée"
    fi
else
    error "API non trouvée"
fi
echo ""

# 7. Vérifier suscripcion.php
echo "📝 Vérification de suscripcion.php..."
if grep -q "addToDeployQueue" "$PROJECT_DIR/php/src/pages/suscripcion.php"; then
    success "suscripcion.php modifié pour utiliser la queue"
else
    warning "suscripcion.php ne semble pas utiliser la queue"
fi
echo ""

# Résumé
echo ""
echo "==================================================="
echo "✅ INSTALLATION TERMINÉE"
echo "==================================================="
echo ""
echo "📁 Fichiers installés:"
echo "   • php/src/api/deploy-school.php"
echo "   • scripts/process-deploy-queue.sh"
echo "   • scripts/setup-deploy-cron.sh"
echo ""
echo "🗄️  Tables créées:"
echo "   • school_deploy_queue"
echo "   • school_deploy_history"
echo "   • Vue: school_deploy_pending"
echo ""
echo "📊 Monitoring:"
echo "   • Logs queue:   tail -f /var/log/eduflow/queue-processor.log"
echo "   • Logs cron:    tail -f /var/log/eduflow/cron-deploy.log"
echo "   • Voir queue:   SELECT * FROM school_deploy_pending;"
echo ""
echo "📖 Documentation: DEPLOY-QUEUE.md"
echo ""

# Test rapide
if [ -d "/opt/docker/apps/eduflow" ]; then
    echo "🚀 Test rapide du processeur de queue..."
    "$SCRIPT_DIR/process-deploy-queue.sh" --dry-run 2>/dev/null || echo "   (Le test nécessite une DB accessible)"
fi
