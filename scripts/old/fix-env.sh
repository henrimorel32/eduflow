#!/bin/bash
# ============================================================
# CORRECTION RAPIDE - Envoyer le .env et redémarrer
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SERVER_DIR="${SERVER_DIR:-/opt/docker/apps/eduflow}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔧 CORRECTION - Envoi du .env"
echo "============================="
echo ""

# Vérifier le .env local
if [ ! -f ".env" ]; then
    echo "❌ .env local non trouvé !"
    exit 1
fi

echo "📤 Envoi du .env..."
scp $SSH_OPTS .env "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/.env"

echo ""
echo "🔄 Redémarrage des services avec le nouvel .env..."
ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << EOF
    cd $SERVER_DIR
    
    echo "   Arrêt..."
    docker compose -f docker-compose.yml down || true
    
    echo "   Démarrage..."
    docker compose -f docker-compose.yml up -d
    
    sleep 5
    
    echo ""
    echo "📊 État :"
    docker compose ps
EOF

echo ""
echo "✅ Terminé !"
echo ""
echo "🌐 Testez : https://henrimorel.com"
