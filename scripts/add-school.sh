#!/bin/bash
# ============================================================
# AJOUTER UNE ÉCOLE - Sans toucher à l'existant
# ============================================================
# Usage: ./add-school.sh <slug> <sous-domaine>
# Exemple: ./add-school.sh colegio-san-jose colegiosanjose.henrimorel.com
# ============================================================

set -e

SCHOOL_SLUG=$1
SCHOOL_DOMAIN=$2
SCHOOL_NAME=${3:-"$SCHOOL_SLUG"}

if [ -z "$SCHOOL_SLUG" ] || [ -z "$SCHOOL_DOMAIN" ]; then
    echo "❌ Usage: $0 <slug> <sous-domaine> [nom_école]"
    echo "   Exemple: $0 colegio-san-jose colegiosanjose.henrimorel.com 'Colegio San José'"
    exit 1
fi

# Vérifier que PostgreSQL et Redis tournent
if ! docker ps | grep -q "edu_postgres"; then
    echo "❌ PostgreSQL n'est pas démarré !"
    echo "   Lance d'abord: docker compose -f docker-compose.new-services.yml up -d"
    exit 1
fi

if ! docker ps | grep -q "edu_redis"; then
    echo "❌ Redis n'est pas démarré !"
    echo "   Lance d'abord: docker compose -f docker-compose.new-services.yml up -d"
    exit 1
fi

# Répertoire de l'école (peut être ailleurs que l'infra principale)
SCHOOL_DIR="/opt/docker/apps/${SCHOOL_SLUG}"
TEMPLATE_PATH="/opt/docker/apps/eduflow/nextjs-template"

echo "🚀 Création de l'école: $SCHOOL_NAME"
echo "   Slug: $SCHOOL_SLUG"
echo "   Domaine: $SCHOOL_DOMAIN"
echo "   Dossier: $SCHOOL_DIR"
echo ""

# Créer le dossier
mkdir -p "$SCHOOL_DIR"

# Récupérer le mot de passe PostgreSQL depuis l'env
POSTGRES_PASSWORD=${POSTGRES_PASSWORD:-$(docker exec edu_postgres env | grep POSTGRES_PASSWORD | cut -d= -f2)}

# Générer le docker-compose
cat > "$SCHOOL_DIR/docker-compose.yml" << EOF
# École: $SCHOOL_NAME ($SCHOOL_DOMAIN)
version: '3.8'

services:
  school_${SCHOOL_SLUG}:
    image: node:20-alpine
    container_name: school_${SCHOOL_SLUG}
    restart: unless-stopped
    working_dir: /app
    environment:
      - SCHOOL_SLUG=${SCHOOL_SLUG}
      - SCHOOL_NAME=${SCHOOL_NAME}
      - SCHOOL_DOMAIN=${SCHOOL_DOMAIN}
      - DATABASE_URL=postgresql://edu_admin:${POSTGRES_PASSWORD}@postgres:5432/edu_platform
      - REDIS_URL=redis://redis:6379
      - NODE_ENV=production
      - PORT=3000
    volumes:
      - ${TEMPLATE_PATH}:/app:ro
    networks:
      - edu_internal
      - edu_proxy
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.rule=Host(\`${SCHOOL_DOMAIN}\`)"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.entrypoints=websecure"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.tls.certresolver=letsencrypt"
      - "traefik.http.services.school-${SCHOOL_SLUG}.loadbalancer.server.port=3000"

networks:
  edu_internal:
    external: true
  edu_proxy:
    external: true
EOF

echo "✅ Fichier docker-compose créé"

# Démarrer l'école
cd "$SCHOOL_DIR"
docker compose up -d

echo ""
echo "⏳ Attente du démarrage..."
sleep 5

# Vérification
if docker ps | grep -q "school_${SCHOOL_SLUG}"; then
    echo ""
    echo "✅ École '$SCHOOL_NAME' déployée avec succès !"
    echo ""
    echo "🌐 URL: https://${SCHOOL_DOMAIN}"
    echo "📁 Dossier: ${SCHOOL_DIR}"
    echo ""
    echo "📋 Commandes utiles:"
    echo "   Logs:     docker logs -f school_${SCHOOL_SLUG}"
    echo "   Stop:     docker compose -f ${SCHOOL_DIR}/docker-compose.yml down"
    echo "   Restart:  docker compose -f ${SCHOOL_DIR}/docker-compose.yml restart"
else
    echo "❌ Échec du démarrage"
    docker logs "school_${SCHOOL_SLUG}" 2>&1 | tail -20
    exit 1
fi
