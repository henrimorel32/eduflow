#!/bin/bash
# ============================================================
# VÉRIFICATION DU SERVEUR
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔍 Vérification des dossiers sur le serveur..."
echo ""

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    echo "📁 Dossiers dans /opt/docker/apps/ :"
    ls -la /opt/docker/apps/ | grep -i edu
    
    echo ""
    echo "🐳 Containers Docker en cours :"
    docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
    
    echo ""
    echo "🌐 Réseaux Docker :"
    docker network ls | grep edu
    
    echo ""
    echo "📂 Quel dossier contient docker-compose.yml ?"
    for dir in /opt/docker/apps/edu*; do
        if [ -f "$dir/docker-compose.yml" ]; then
            echo "   ✅ $dir/docker-compose.yml existe"
            echo "      Dernière modif: $(stat -c %y "$dir/docker-compose.yml" 2>/dev/null || stat -f %Sm "$dir/docker-compose.yml" 2>/dev/null)"
        else
            echo "   ❌ $dir/docker-compose.yml MANQUANT"
        fi
    done
EOF
