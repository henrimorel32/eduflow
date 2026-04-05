#!/bin/bash
# ============================================================
# DÉPLOIEMENT D'UNE ÉCOLE
# ============================================================
# Usage: ./deploy-school.sh <slug> <domain>
# 
# L'école sera créée dans: /opt/docker/apps/<slug>/
# Visible directement par Traefik (même réseau 'proxy')
# ============================================================

set -e

SCHOOL_SLUG=$1
DOMAIN=$2

if [ -z "$SCHOOL_SLUG" ] || [ -z "$DOMAIN" ]; then
    echo "Usage: $0 <school_slug> <domain>"
    echo "Exemple: $0 colegio-san-jose colegiosanjose.henrimorel.com"
    exit 1
fi

# Vérifier qu'on est sur le bon serveur
if [ ! -d "/opt/docker/apps/eduflow" ]; then
    echo "❌ Erreur: Infra eduflow non trouvée dans /opt/docker/apps/eduflow"
    exit 1
fi

APPS_DIR="/opt/docker/apps"
SCHOOL_DIR="$APPS_DIR/$SCHOOL_SLUG"
EDUFLOW_DIR="$APPS_DIR/eduflow"

echo "🚀 Déploiement École: $SCHOOL_SLUG"
echo "🌐 Domaine: $DOMAIN"
echo "📁 Emplacement: $SCHOOL_DIR"
echo ""

# Récupérer les infos depuis la BDD ou les arguments
SCHOOL_NAME=${3:-"Colegio $SCHOOL_SLUG"}
COLOR_PRIMARY=${4:-"#2563eb"}
COLOR_SECONDARY=${5:-"#06b6d4"}
LOGO_PATH=${6:-""}

# ============================================================
# 1. CRÉATION DU RÉPERTOIRE ÉCOLE
# ============================================================
echo "📁 Création du répertoire..."
mkdir -p "$SCHOOL_DIR"

# ============================================================
# 2. GÉNÉRATION DU DOCKER COMPOSE
# ============================================================
echo "🐳 Génération docker-compose.yml..."

cat > "$SCHOOL_DIR/docker-compose.yml" << EOF
# ============================================================
# ÉCOLE: $SCHOOL_NAME
# Sous-domaine: $DOMAIN
# ============================================================
# Ce fichier est dans /opt/docker/apps/$SCHOOL_SLUG/
# Traefik le détecte automatiquement via le réseau 'proxy'
# ============================================================

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
      - SCHOOL_COLOR_PRIMARY=${COLOR_PRIMARY}
      - SCHOOL_COLOR_SECONDARY=${COLOR_SECONDARY}
      - SCHOOL_DOMAIN=${DOMAIN}
      - DATABASE_URL=postgresql://edu_admin:\${POSTGRES_PASSWORD}@postgres:5432/edu_platform
      - REDIS_URL=redis://redis:6379
      - NODE_ENV=production
      - PORT=3000
    volumes:
      # Template Next.js
      - /opt/docker/apps/eduflow/nextjs-template:/app:ro
      # Formulaires PHP partagés
      - /opt/docker/apps/eduflow/php/src/pages/pasos:/app/public/forms:ro
      # Logo de l'école (si présent)
      ${LOGO_PATH:+- ${LOGO_PATH}:/app/public/logo.png:ro}
    networks:
      - edu_internal
      - proxy
    labels:
      # Traefik routing
      - "traefik.enable=true"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.rule=Host(\`${DOMAIN}\`)"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.entrypoints=websecure"
      - "traefik.http.routers.school-${SCHOOL_SLUG}.tls.certresolver=letsencrypt"
      - "traefik.http.services.school-${SCHOOL_SLUG}.loadbalancer.server.port=3000"

networks:
  edu_internal:
    external: true
  proxy:
    external: true
EOF

# ============================================================
# 3. CRÉATION DU FICHIER DE CONFIG
# ============================================================
echo "⚙️  Création de la configuration..."

cat > "$SCHOOL_DIR/config.json" << EOF
{
  "school": {
    "slug": "${SCHOOL_SLUG}",
    "name": "${SCHOOL_NAME}",
    "domain": "${DOMAIN}"
  },
  "colors": {
    "primary": "${COLOR_PRIMARY}",
    "secondary": "${COLOR_SECONDARY}"
  },
  "logo": {
    "path": "${LOGO_PATH}"
  },
  "created_at": "$(date -u +"%Y-%m-%dT%H:%M:%SZ")"
}
EOF

# ============================================================
# 4. DÉMARRAGE
# ============================================================
echo "🚀 Démarrage du container..."

cd "$SCHOOL_DIR"
docker-compose up -d

# ============================================================
# 5. VÉRIFICATION
# ============================================================
echo "⏳ Vérification..."
sleep 5

if docker ps | grep -q "school_${SCHOOL_SLUG}"; then
    echo ""
    echo "✅ École déployée avec succès!"
    echo ""
    echo "🌐 Accès:"
    echo "   https://${DOMAIN}"
    echo ""
    echo "📁 Fichiers:"
    echo "   ${SCHOOL_DIR}/"
    echo ""
    echo "📋 Commandes:"
    echo "   Logs:   docker logs -f school_${SCHOOL_SLUG}"
    echo "   Stop:   docker-compose -f ${SCHOOL_DIR}/docker-compose.yml down"
    echo "   Restart: docker-compose -f ${SCHOOL_DIR}/docker-compose.yml restart"
    echo ""
else
    echo "❌ Échec du déploiement"
    docker logs school_${SCHOOL_SLUG} 2>&1 | tail -30
    exit 1
fi
