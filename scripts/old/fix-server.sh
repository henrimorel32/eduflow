#!/bin/bash
# ============================================================
# CORRECTION RAPIDE DU SERVEUR
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔧 CORRECTION DU SERVEUR"
echo "========================"
echo ""

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    cd /opt/docker/apps/eduflow
    
    echo "1️⃣ Arrêt des anciens containers..."
    docker stop edu_nginx edu_php edu_mysql edu_phpmyadmin 2>/dev/null || true
    
    echo ""
    echo "2️⃣ Démarrage avec docker compose..."
    docker compose -f docker-compose.yml up -d
    
    echo ""
    echo "3️⃣ Attente du démarrage (10s)..."
    sleep 10
    
    echo ""
    echo "4️⃣ Vérification du réseau edu_proxy..."
    if docker network ls | grep -q "edu_proxy"; then
        echo "   ✅ Réseau edu_proxy existe"
        
        # Vérifier que nginx est connecté
        if ! docker network inspect edu_proxy | grep -q "edu_nginx"; then
            echo "   → Connexion edu_nginx au réseau..."
            docker network connect edu_proxy edu_nginx
        fi
    else
        echo "   ⚠️  Création du réseau edu_proxy..."
        docker network create edu_proxy
        docker network connect edu_proxy edu_nginx
    fi
    
    echo ""
    echo "5️⃣ Redémarrage de Traefik (si besoin)..."
    if docker ps | grep -q "traefik"; then
        docker restart traefik
        echo "   ✅ Traefik redémarré"
    else
        echo "   ⚠️  Traefik non trouvé - il faut le démarrer séparément"
    fi
    
    echo ""
    echo "6️⃣ État final :"
    docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
    
    echo ""
    echo "📊 Vérification des labels Traefik :"
    docker inspect edu_nginx --format='{{range $k, $v := .Config.Labels}}{{$k}}={{$v}}{{println}}{{end}}' | grep traefik || echo "Pas de labels traefik !"
EOF

echo ""
echo "✅ Corrections appliquées !"
echo ""
echo "⏳ Attendre 30s puis tester :"
echo "   https://henrimorel.com"
