#!/bin/bash
# ============================================================
# DÉPLOIEMENT INFRASTRUCTURE - PostgreSQL + Redis
# ============================================================
# Usage: ./scripts/deploy-infra.sh
# ============================================================

set -e

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SERVER_DIR="${SERVER_DIR:-/opt/docker/apps/eduflow}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🚀 DÉPLOIEMENT INFRASTRUCTURE"
echo "=============================="
echo "PostgreSQL + Redis pour les écoles"
echo ""

# Vérifier le .env.local
if [ ! -f ".env.local" ]; then
    echo "❌ Fichier .env.local manquant !"
    echo "   Créez-le avec: cp .env.local.example .env.local"
    exit 1
fi

echo "📤 Envoi des fichiers..."

# Envoyer le docker-compose infrastructure
scp -i "$SSH_KEY" -P "$SSH_PORT" docker-compose.infrastructure.yml "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"

# Envoyer le .env.local (pour POSTGRES_PASSWORD)
scp -i "$SSH_KEY" -P "$SSH_PORT" .env.local "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"

echo ""
echo "🐳 Démarrage sur le serveur..."

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << EOF
    cd $SERVER_DIR
    
    # Créer le réseau s'il n'existe pas
    if ! docker network ls | grep -q "edu_proxy"; then
        echo "   → Création du réseau edu_proxy..."
        docker network create edu_proxy
    fi
    
    echo ""
    echo "   → Démarrage PostgreSQL + Redis..."
    docker compose -f docker-compose.infrastructure.yml up -d
    
    echo ""
    echo "⏳ Attente du démarrage (15s)..."
    sleep 15
    
    echo ""
    echo "📊 État :"
    docker compose -f docker-compose.infrastructure.yml ps
    
    echo ""
    echo "✅ Vérification PostgreSQL :"
    docker exec edu_postgres pg_isready -U edu_admin 2>/dev/null && echo "   ✅ PostgreSQL OK" || echo "   ⏳ PostgreSQL en cours..."
    
    echo ""
    echo "✅ Vérification Redis :"
    docker exec edu_redis redis-cli ping 2>/dev/null && echo "   ✅ Redis OK" || echo "   ⏳ Redis en cours..."
EOF

echo ""
echo "✅ INFRASTRUCTURE DÉPLOYÉE !"
echo ""
echo "📋 Services :"
echo "   PostgreSQL : edu_postgres:5432 (interne)"
echo "   Redis      : edu_redis:6379 (interne)"
echo "   Adminer    : http://localhost:8082 (SSH tunnel)"
echo ""
echo "🚀 Prochaine étape : créer une école"
echo "   ./scripts/add-school.sh <slug> <domain>"
