#!/bin/bash
# ============================================================
# CORRECTION TRAEFIK - Vérifier et redémarrer
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔧 Vérification et correction de la configuration"
echo "=================================================="
echo ""

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    cd /opt/docker/apps/eduflow
    
    echo "🐳 Containers en cours :"
    docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Networks}}"
    
    echo ""
    echo "🌐 Réseaux :"
    docker network ls | grep -E "(edu_|proxy)"
    
    echo ""
    echo "🔗 Vérification du réseau edu_proxy..."
    if ! docker network ls | grep -q "edu_proxy"; then
        echo "   ⚠️  Création du réseau edu_proxy..."
        docker network create edu_proxy
    else
        echo "   ✅ Réseau edu_proxy existe"
    fi
    
    echo ""
    echo "🔄 Connexion des containers au réseau..."
    
    # Connecter nginx au réseau proxy s'il ne l'est pas
    if docker ps | grep -q "edu_nginx"; then
        if ! docker network inspect edu_proxy | grep -q "edu_nginx"; then
            echo "   → Connexion edu_nginx au réseau edu_proxy"
            docker network connect edu_proxy edu_nginx 2>/dev/null || echo "   Déjà connecté ou erreur"
        fi
    fi
    
    echo ""
    echo "🏷️  Labels Traefik sur edu_nginx :"
    docker inspect edu_nginx --format='{{json .Config.Labels}}' | jq . 2>/dev/null || docker inspect edu_nginx --format='{{range $k, $v := .Config.Labels}}{{$k}}={{$v}}{{println}}{{end}}'
    
    echo ""
    echo "🔄 Redémarrage des services..."
    docker compose restart
    
    echo ""
    echo "⏳ Attente du redémarrage..."
    sleep 5
    
    echo ""
    echo "📊 État final :"
    docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
EOF

echo ""
echo "✅ Terminé !"
echo ""
echo "🌐 Testez le site dans 30 secondes :"
echo "   https://henrimorel.com"
