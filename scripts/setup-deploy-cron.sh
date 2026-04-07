#!/bin/bash
# ============================================================
# INSTALLER LE CRON DE DÉPLOIEMENT
# ============================================================
# Ce script configure le cron pour traiter automatiquement
# la queue de déploiement des écoles.
# ============================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="/opt/docker/apps/eduflow"
LOG_DIR="/var/log/eduflow"

echo "🚀 Configuration du cron de déploiement"
echo "======================================="
echo ""

# Vérifier qu'on est sur le serveur (pas en local)
if [ ! -d "$PROJECT_DIR" ]; then
    echo "❌ Répertoire projet non trouvé: $PROJECT_DIR"
    echo "   Ce script doit être exécuté sur le serveur de production"
    exit 1
fi

# Créer le répertoire de logs
mkdir -p "$LOG_DIR"

# Rendre les scripts exécutables
chmod +x "$SCRIPT_DIR/process-deploy-queue.sh"
chmod +x "$SCRIPT_DIR/add-school.sh"

echo "✅ Scripts rendus exécutables"

# Créer le cron job
CRON_JOB="* * * * * $SCRIPT_DIR/process-deploy-queue.sh >> $LOG_DIR/cron-deploy.log 2>&1"

# Vérifier si le cron existe déjà
if crontab -l 2>/dev/null | grep -q "process-deploy-queue.sh"; then
    echo "⚠️  Le cron existe déjà"
    echo ""
    echo "Cron actuel:"
    crontab -l | grep "process-deploy-queue.sh"
    echo ""
    read -p "Voulez-vous le mettre à jour? (y/n) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "❌ Annulé"
        exit 0
    fi
    # Supprimer l'ancien cron
    crontab -l 2>/dev/null | grep -v "process-deploy-queue.sh" | crontab -
fi

# Ajouter le nouveau cron
(crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -

echo "✅ Cron configuré"
echo ""
echo "📋 Configuration:"
echo "   Fréquence: Toutes les minutes"
echo "   Script: $SCRIPT_DIR/process-deploy-queue.sh"
echo "   Logs: $LOG_DIR/cron-deploy.log"
echo ""
echo "📊 Logs de déploiement: $LOG_DIR/queue-processor.log"
echo ""

# Vérifier le cron
echo "🔍 Vérification du cron:"
crontab -l | grep "process-deploy-queue.sh" || echo "❌ Cron non trouvé!"
echo ""

# Tester le script une première fois
echo "🧪 Test du script (mode dry-run)..."
"$SCRIPT_DIR/process-deploy-queue.sh" --dry-run 2>/dev/null || echo "Test terminé"
echo ""

echo "✅ Configuration terminée!"
echo ""
echo "📚 Commandes utiles:"
echo "   Voir les logs cron:   tail -f $LOG_DIR/cron-deploy.log"
echo "   Voir les logs queue:  tail -f $LOG_DIR/queue-processor.log"
echo "   Voir la queue:        mysql -u edu_user -p edu_platform -e 'SELECT * FROM school_deploy_pending'"
echo "   Modifier le cron:     crontab -e"
echo ""
