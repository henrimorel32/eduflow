#!/bin/bash
# ============================================================
# SYNCHRONISER LES SOURCES LOCALES VERS LE SERVEUR
# ============================================================
# Usage: ./scripts/sync-to-server.sh
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SERVER_DIR="${SERVER_DIR:-/opt/docker/apps/eduflow}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔄 SYNCHRONISATION VERS LE SERVEUR"
echo "==================================="
echo ""

# 1. Backup sur le serveur
echo "💾 Backup sur le serveur..."
ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" "cd $SERVER_DIR && mkdir -p backups && tar -czf backups/backup-\$(date +%Y%m%d-%H%M%S).tar.gz php/src nginx mysql docker-compose.yml 2>/dev/null || true"

# 2. Envoyer les fichiers essentiels
echo ""
echo "📤 Envoi des fichiers..."

# docker-compose files
scp -i "$SSH_KEY" -P "$SSH_PORT" docker-compose.yml "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"
scp -i "$SSH_KEY" -P "$SSH_PORT" docker-compose.infrastructure.yml "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"
scp -i "$SSH_KEY" -P "$SSH_PORT" docker-compose.school-template.yml "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"

# Sources PHP
echo "   → php/"
rsync -avz -e "ssh -i $SSH_KEY -P $SSH_PORT" --exclude=vendor --exclude=node_modules php/ "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/php/"

# Config Nginx
echo "   → nginx/"
scp -r -i "$SSH_KEY" -P "$SSH_PORT" nginx/ "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"

# MySQL init
echo "   → mysql/init.sql"
scp -i "$SSH_KEY" -P "$SSH_PORT" mysql/init.sql "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/mysql/"

# Scripts
echo "   → scripts/"
scp -r -i "$SSH_KEY" -P "$SSH_PORT" scripts/ "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"

# Template Next.js
echo "   → nextjs-template/"
rsync -avz -e "ssh -i $SSH_KEY -P $SSH_PORT" --exclude=node_modules --exclude=.next nextjs-template/ "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/nextjs-template/"

echo ""
echo "✅ Synchronisation terminée !"
echo ""
echo "🔄 Pour redémarrer les services sur le serveur:"
echo "   ssh $SERVER_USER@$SERVER_HOST 'cd $SERVER_DIR && docker compose restart'"
