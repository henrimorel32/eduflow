#!/bin/bash
# ============================================================
# ENVOYER LE .ENV SUR LE SERVEUR
# ============================================================
# Usage: ./scripts/send-env.sh
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SERVER_DIR="${SERVER_DIR:-/opt/docker/apps/eduflow}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "📤 Envoi du .env sur le serveur"
echo "==============================="
echo ""

if [ ! -f ".env" ]; then
    echo "❌ Fichier .env local non trouvé !"
    exit 1
fi

echo "⚠️  ATTENTION : Cela va écraser le .env sur le serveur"
echo "   Serveur: $SERVER_USER@$SERVER_HOST:$SERVER_DIR/.env"
echo ""
read -p "Continuer ? (yes/no): " CONFIRM

if [ "$CONFIRM" != "yes" ]; then
    echo "❌ Annulé"
    exit 1
fi

echo ""
echo "📤 Envoi..."
scp $SSH_OPTS .env "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/.env"

echo ""
echo "✅ .env envoyé !"
echo ""
echo "🔄 Redémarrage des services..."
ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" "cd $SERVER_DIR && docker compose restart"

echo ""
echo "✅ Terminé !"
