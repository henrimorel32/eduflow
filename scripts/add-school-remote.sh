#!/bin/bash
# ============================================================
# AJOUTER UNE ÉCOLE - Sur le serveur distant
# ============================================================
# Usage: ./scripts/add-school-remote.sh <slug> <domain> [nom]
# Exemple: ./scripts/add-school-remote.sh colegio1 colegio1.henrimorel.com "Colegio San José"
# ============================================================

set -e

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

SCHOOL_SLUG=$1
SCHOOL_DOMAIN=$2
SCHOOL_NAME=${3:-"$SCHOOL_SLUG"}

if [ -z "$SCHOOL_SLUG" ] || [ -z "$SCHOOL_DOMAIN" ]; then
    echo "❌ Usage: $0 <slug> <sous-domaine> [nom_école]"
    echo "   Exemple: $0 colegio1 colegio1.henrimorel.com 'Colegio San José'"
    exit 1
fi

echo "🚀 Création de l'école sur le serveur"
echo "======================================"
echo "Slug: $SCHOOL_SLUG"
echo "Domaine: $SCHOOL_DOMAIN"
echo "Nom: $SCHOOL_NAME"
echo ""

# 1. Vérifier que le template existe sur le serveur
echo "🔍 Vérification du template Next.js..."
TEMPLATE_EXISTS=$(ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" "test -d /opt/docker/apps/eduflow/nextjs-template && echo 'yes' || echo 'no'")

if [ "$TEMPLATE_EXISTS" = "no" ]; then
    echo "   ⚠️  Template non trouvé sur le serveur"
    echo "   📤 Envoi du template..."
    scp -r -i "$SSH_KEY" -P "$SSH_PORT" nextjs-template/ "$SERVER_USER@$SERVER_HOST:/opt/docker/apps/eduflow/"
    echo "   ✅ Template envoyé"
else
    echo "   ✅ Template présent"
fi

# 2. Créer l'école sur le serveur
echo ""
echo "🐳 Création du container..."

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << EOF
    set -e
    
    SCHOOL_DIR="/opt/docker/apps/${SCHOOL_SLUG}"
    
    # Vérifier PostgreSQL
    if ! docker ps | grep -q "edu_postgres"; then
        echo "❌ PostgreSQL n'est pas démarré !"
        echo "   Lancez: docker compose -f docker-compose.infrastructure.yml up -d"
        exit 1
    fi
    
    # Créer le dossier
    mkdir -p "\$SCHOOL_DIR"
    
    # Récupérer le mot de passe PostgreSQL
    POSTGRES_PASSWORD=\$(docker exec edu_postgres env | grep POSTGRES_PASSWORD | cut -d= -f2)
    
    # Générer le docker-compose
    cat > "\$SCHOOL_DIR/docker-compose.yml" << DOCKERFILE
services:
  school_${SCHOOL_SLUG}:
    image: node:20-alpine
    container_name: school_${SCHOOL_SLUG}
    restart: unless-stopped
    working_dir: /app
    # Important: -H 0.0.0.0 pour écouter sur toutes les interfaces (nécessaire pour Docker)
    command: sh -c "npm install && npm run build && npx next start -H 0.0.0.0"
    environment:
      - SCHOOL_SLUG=${SCHOOL_SLUG}
      - SCHOOL_NAME=${SCHOOL_NAME}
      - SCHOOL_DOMAIN=${SCHOOL_DOMAIN}
      - DATABASE_URL=postgresql://edu_admin:\${POSTGRES_PASSWORD}@postgres:5432/edu_platform
      - REDIS_URL=redis://redis:6379
      - NODE_ENV=production
      - PORT=3000
    volumes:
      - /opt/docker/apps/eduflow/nextjs-template:/app
    networks:
      - eduflow_edu_internal
      - edu_proxy
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.rule=Host(\`${SCHOOL_DOMAIN}\`) || Host(\`www.${SCHOOL_DOMAIN}\`)"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.entrypoints=websecure"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.tls.certresolver=letsencrypt"
      - "traefik.http.services.school-${SCHOOL_SLUG}.loadbalancer.server.port=3000"

networks:
  eduflow_edu_internal:
    external: true
  edu_proxy:
    external: true
DOCKERFILE
    
    echo "✅ Docker-compose créé"
    
    # Démarrer
    cd "\$SCHOOL_DIR"
    docker compose up -d
    
    sleep 5
    
    # Vérification
    if docker ps | grep -q "school_${SCHOOL_SLUG}"; then
        echo ""
        echo "✅ Container démarré !"
    else
        echo "❌ Échec du démarrage"
        docker logs "school_${SCHOOL_SLUG}" 2>&1 | tail -10
        exit 1
    fi
EOF

# 3. Créer le DNS dans Cloudflare
echo ""
echo "🌐 Création du DNS..."

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << EOF
    cd /opt/docker/apps/eduflow
    
    # Récupérer les credentials
    CF_API_TOKEN=\$(grep CF_API_TOKEN .env | cut -d= -f2)
    CF_ZONE_ID=\$(grep CF_ZONE_ID .env | cut -d= -f2)
    IP=\$(curl -s ifconfig.me)
    
    # Créer le record A (domaine principal)
    RESULT=\$(curl -s -X POST "https://api.cloudflare.com/client/v4/zones/\${CF_ZONE_ID}/dns_records" \
        -H "Authorization: Bearer \${CF_API_TOKEN}" \
        -H "Content-Type: application/json" \
        --data "{\"type\":\"A\",\"name\":\"${SCHOOL_SLUG}\",\"content\":\"\${IP}\",\"ttl\":120,\"proxied\":false}")
    
    if echo "\$RESULT" | grep -q '"success":true'; then
        echo "✅ DNS créé: ${SCHOOL_SLUG}.henrimorel.com → \${IP}"
    else
        echo "⚠️  Erreur DNS (peut-être déjà existe):"
        echo "\$RESULT" | grep -o '"message":"[^"]*"' || true
    fi
    
    # Créer le record A (www)
    RESULT_WWW=\$(curl -s -X POST "https://api.cloudflare.com/client/v4/zones/\${CF_ZONE_ID}/dns_records" \
        -H "Authorization: Bearer \${CF_API_TOKEN}" \
        -H "Content-Type: application/json" \
        --data "{\"type\":\"A\",\"name\":\"www.${SCHOOL_SLUG}\",\"content\":\"\${IP}\",\"ttl\":120,\"proxied\":false}")
    
    if echo "\$RESULT_WWW" | grep -q '"success":true'; then
        echo "✅ DNS créé: www.${SCHOOL_SLUG}.henrimorel.com → \${IP}"
    else
        echo "⚠️  Erreur DNS www (peut-être déjà existe):"
        echo "\$RESULT_WWW" | grep -o '"message":"[^"]*"' || true
    fi
EOF

echo ""
echo "✅ ÉCOLE CRÉÉE AVEC SUCCÈS !"
echo ""
echo "🌐 URL: https://${SCHOOL_DOMAIN}"
echo "📁 Dossier: /opt/docker/apps/${SCHOOL_SLUG}/"
echo ""
echo "⏳ Le build peut prendre 1-2 minutes..."
echo "⏳ Le certificat SSL peut prendre 1-2 minutes après le build..."
echo ""
echo "📋 Commandes utiles:"
echo "   Logs:  ssh ... 'docker logs -f school_${SCHOOL_SLUG}'"
echo "   Stop:  ssh ... 'cd /opt/docker/apps/${SCHOOL_SLUG} && docker compose down'"
