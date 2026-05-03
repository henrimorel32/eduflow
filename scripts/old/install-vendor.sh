#!/bin/bash
# ============================================================
# INSTALLER LES DÉPENDANCES PHP (VENDOR)
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "📦 Installation des dépendances PHP (Composer)"
echo "=============================================="
echo ""

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    cd /opt/docker/apps/eduflow
    
    echo "🐳 Vérification du container PHP..."
    if ! docker ps | grep -q "edu_php"; then
        echo "❌ Container edu_php non trouvé !"
        echo "   Démarrage des services..."
        docker compose up -d php
        sleep 5
    fi
    
    echo ""
    echo "📦 Installation de Composer..."
    docker exec edu_php sh -c 'cd /var/www/html && composer install --no-dev --optimize-autoloader'
    
    echo ""
    echo "🔄 Redémarrage de PHP..."
    docker restart edu_php
    
    echo ""
    echo "✅ Terminé !"
    echo ""
    echo "📋 Vérification :"
    ls -la php/src/vendor/autoload.php
EOF

echo ""
echo "🌐 Testez le site : https://henrimorel.com"
