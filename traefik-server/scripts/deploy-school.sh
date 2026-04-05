#!/bin/bash
# Script de déploiement d'une école sur le nouveau serveur Traefik
# Usage: ./deploy-school.sh <slug> <domain> <name> <email> [color1] [color2]

set -e

SCHOOL_SLUG=$1
DOMAIN=$2
SCHOOL_NAME=$3
EMAIL=$4
COLOR_PRIMARY=${5:-"#2563eb"}
COLOR_SECONDARY=${6:-"#06b6d4"}

# Configuration
VPS_IP=$(curl -s -4 ifconfig.me)
CF_DNS_API_TOKEN=${CF_DNS_API_TOKEN:-""}
CF_ZONE_ID=${CF_ZONE_ID:-""}
TRAEFIK_DYNAMIC_DIR="/opt/traefik/dynamic"
TEMPLATE_DIR="/opt/docker/apps/eduflow/nextjs-template"
BASE_DIR="/opt/schools"

# Couleurs pour les logs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

log() {
    echo -e "${BLUE}[$(date +%H:%M:%S)]${NC} $1"
}

success() {
    echo -e "${GREEN}✅ $1${NC}"
}

warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

error() {
    echo -e "${RED}❌ $1${NC}"
    exit 1
}

# Vérification des arguments
if [ -z "$SCHOOL_SLUG" ] || [ -z "$DOMAIN" ] || [ -z "$SCHOOL_NAME" ]; then
    error "Usage: $0 <slug> <domain> <name> <email> [color1] [color2]"
    echo "Exemple: $0 mon-ecole ecole.henrimorel.com 'Mon École' contact@ecole.com #2563eb #06b6d4"
    exit 1
fi

# Vérification des prérequis
log "Vérification des prérequis..."
command -v docker >/dev/null 2>&1 || error "Docker n'est pas installé"
docker network inspect edu_proxy >/dev/null 2>&1 || error "Network edu_proxy n'existe pas"
[ -d "$TEMPLATE_DIR" ] || error "Template Next.js non trouvé: $TEMPLATE_DIR"
[ -d "$TRAEFIK_DYNAMIC_DIR" ] || error "Répertoire Traefik non trouvé: $TRAEFIK_DYNAMIC_DIR"

log "🚀 DÉPLOIEMENT ÉCOLE: $SCHOOL_NAME"
log "   Slug: $SCHOOL_SLUG"
log "   Domaine: $DOMAIN"
log "   IP: $VPS_IP"
echo ""

# 1. CRÉATION DU RÉPERTOIRE ET DOCKER-COMPOSE
log "1️⃣  Création du répertoire et docker-compose..."
SCHOOL_DIR="${BASE_DIR}/${SCHOOL_SLUG}"
mkdir -p "$SCHOOL_DIR"

# Générer un mot de passe DB aléatoire
DB_PASSWORD=$(openssl rand -base64 32 | tr -dc 'a-zA-Z0-9' | head -c 24)
DB_USER="school_${SCHOOL_SLUG}"
DB_NAME="school_${SCHOOL_SLUG//-/_}"

cat > "$SCHOOL_DIR/docker-compose.yml" << EOFCOMPOSE
services:
  school_${SCHOOL_SLUG}:
    image: node:20-alpine
    container_name: school_${SCHOOL_SLUG}
    restart: unless-stopped
    working_dir: /app
    command: sh -c "npm ci && npm run build && npx next start -H 0.0.0.0"
    environment:
      - SCHOOL_SLUG=${SCHOOL_SLUG}
      - SCHOOL_NAME=${SCHOOL_NAME}
      - SCHOOL_COLOR_PRIMARY=${COLOR_PRIMARY}
      - SCHOOL_COLOR_SECONDARY=${COLOR_SECONDARY}
      - SCHOOL_DOMAIN=${DOMAIN}
      - DATABASE_URL=postgresql://${DB_USER}:${DB_PASSWORD}@postgres:5432/${DB_NAME}
      - REDIS_URL=redis://redis:6379
      - NODE_ENV=production
      - PORT=3000
    volumes:
      - ${TEMPLATE_DIR}:/app:ro
    networks:
      - eduflow_edu_internal
      - edu_proxy
    deploy:
      resources:
        limits:
          cpus: '1.0'
          memory: 512M
    healthcheck:
      test: ["CMD", "wget", "--spider", "-q", "http://localhost:3000"]
      interval: 30s
      timeout: 10s
      retries: 3

networks:
  eduflow_edu_internal:
    external: true
  edu_proxy:
    external: true
EOFCOMPOSE

# Sauvegarder les credentials
echo "DB_USER=${DB_USER}" > "$SCHOOL_DIR/.env"
echo "DB_PASSWORD=${DB_PASSWORD}" >> "$SCHOOL_DIR/.env"
echo "DB_NAME=${DB_NAME}" >> "$SCHOOL_DIR/.env"
chmod 600 "$SCHOOL_DIR/.env"

success "Répertoire créé: $SCHOOL_DIR"

# 2. CRÉATION DE LA BASE DE DONNÉES
log "2️⃣  Création de la base de données..."
docker exec postgres psql -U edu_admin -d edu_platform -c "
CREATE USER ${DB_USER} WITH PASSWORD '${DB_PASSWORD}';
CREATE DATABASE ${DB_NAME} OWNER ${DB_USER};
GRANT ALL PRIVILEGES ON DATABASE ${DB_NAME} TO ${DB_USER};
" 2>/dev/null || warning "DB existe déjà ou erreur de connexion"

success "Base de données créée: $DB_NAME"

# 3. DÉMARRAGE DU CONTAINER
log "3️⃣  Démarrage du container..."
cd "$SCHOOL_DIR" && docker compose up -d

# Attendre que le container démarre
for i in {1..12}; do
    if docker ps | grep -q "school_${SCHOOL_SLUG}"; then
        success "Container démarré"
        break
    fi
    echo "   ⏳ Attente container... ($i/12)"
    sleep 5
done

# Vérifier le port 3000
log "   Vérification du port 3000..."
for i in {1..12}; do
    if docker exec "school_${SCHOOL_SLUG}" wget -qO- http://localhost:3000 2>/dev/null | grep -q "html"; then
        success "Application répond sur le port 3000"
        break
    fi
    echo "   ⏳ Attente application... ($i/12)"
    sleep 5
done

# 4. CONFIGURATION TRAEFIK
log "4️⃣  Configuration Traefik..."

cat > "${TRAEFIK_DYNAMIC_DIR}/${SCHOOL_SLUG}.yml" << EOFTRAEFIK
http:
  routers:
    school-${SCHOOL_SLUG}:
      rule: Host(\`${DOMAIN}\`)
      service: service-${SCHOOL_SLUG}
      tls:
        certResolver: letsencrypt
      middlewares:
        - security-headers@file
        - rate-limit@file
    
    school-${SCHOOL_SLUG}-www:
      rule: Host(\`www.${DOMAIN}\`)
      service: service-${SCHOOL_SLUG}
      tls:
        certResolver: letsencrypt
      middlewares:
        - security-headers@file

  services:
    service-${SCHOOL_SLUG}:
      loadBalancer:
        servers:
          - url: "http://school_${SCHOOL_SLUG}:3000"
        healthCheck:
          path: /
          interval: 10s
          timeout: 5s
EOFTRAEFIK

chmod 644 "${TRAEFIK_DYNAMIC_DIR}/${SCHOOL_SLUG}.yml"
success "Config Traefik créée: ${TRAEFIK_DYNAMIC_DIR}/${SCHOOL_SLUG}.yml"

# 5. CRÉATION DES DNS (si token Cloudflare est configuré)
if [ -n "$CF_DNS_API_TOKEN" ] && [ -n "$CF_ZONE_ID" ]; then
    log "5️⃣  Création des DNS Cloudflare..."
    
    # DNS principal
    curl -s -X POST \
      "https://api.cloudflare.com/client/v4/zones/${CF_ZONE_ID}/dns_records" \
      -H "Authorization: Bearer ${CF_DNS_API_TOKEN}" \
      -H "Content-Type: application/json" \
      -d "{\"type\":\"A\",\"name\":\"${DOMAIN}\",\"content\":\"${VPS_IP}\",\"ttl\":120,\"proxied\":false}" | grep -o '"success":[^,]*' || warning "Échec création DNS principal"
    
    # DNS www
    curl -s -X POST \
      "https://api.cloudflare.com/client/v4/zones/${CF_ZONE_ID}/dns_records" \
      -H "Authorization: Bearer ${CF_DNS_API_TOKEN}" \
      -H "Content-Type: application/json" \
      -d "{\"type\":\"A\",\"name\":\"www.${DOMAIN}\",\"content\":\"${VPS_IP}\",\"ttl\":120,\"proxied\":false}" | grep -o '"success":[^,]*' || warning "Échec création DNS www"
    
    success "DNS créés"
    
    # 6. ATTENTE PROPAGATION DNS
    log "6️⃣  Attente propagation DNS (60s)..."
    sleep 60
    
    for i in {1..10}; do
        if nslookup "$DOMAIN" 1.1.1.1 2>/dev/null | grep -q "${VPS_IP}"; then
            success "DNS propagé"
            break
        fi
        echo "   ⏳ Attente DNS... ($i/10)"
        sleep 10
    done
else
    warning "Token Cloudflare non configuré - DNS manuels requis"
    warning "Créez un enregistrement A: ${DOMAIN} -> ${VPS_IP}"
fi

# 7. ATTENTE CERTIFICAT SSL
log "7️⃣  Attente certificat SSL..."
for i in {1..30}; do
    CERT_INFO=$(echo | openssl s_client -connect "${DOMAIN}:443" -servername "${DOMAIN}" 2>/dev/null | openssl x509 -noout -issuer 2>/dev/null || true)
    if echo "$CERT_INFO" | grep -q "Let's Encrypt"; then
        success "Certificat SSL OK (Let's Encrypt)"
        break
    fi
    echo "   ⏳ Attente certificat... ($i/30)"
    sleep 10
done

# 8. VÉRIFICATION FINALE
log "8️⃣  Vérification finale..."
HTTP_CODE=$(curl -s -o /dev/null -w '%{http_code}' "https://${DOMAIN}" 2>/dev/null || echo "000")
if [ "$HTTP_CODE" = "200" ] || [ "$HTTP_CODE" = "307" ]; then
    success "Site accessible (HTTP $HTTP_CODE)"
else
    warning "Site retourne HTTP $HTTP_CODE"
fi

# 9. ENVOI EMAIL DE CONFIRMATION (si email fourni)
if [ -n "$EMAIL" ]; then
    log "9️⃣  Envoi email de confirmation..."
    log "   📧 Envoi à: $EMAIL"
    
    # Créer un email simple
    EMAIL_SUBJECT="🎉 Votre école ${SCHOOL_NAME} est en ligne !"
    EMAIL_BODY="Bonjour,

Votre école \"${SCHOOL_NAME}\" a été déployée avec succès !

🌐 URL: https://${DOMAIN}
📊 Administration: À configurer
🔒 Certificat SSL: Actif (Let's Encrypt)
💾 Base de données: ${DB_NAME}

Les parents peuvent dès maintenant s'inscrire via le formulaire en ligne.

Cordialement,
L'équipe EduFlow"

    # Envoyer via sendmail ou mail si disponible
    if command -v mail >/dev/null 2>&1; then
        echo "$EMAIL_BODY" | mail -s "$EMAIL_SUBJECT" "$EMAIL" && success "Email envoyé"
    elif command -v sendmail >/dev/null 2>&1; then
        {
            echo "To: $EMAIL"
            echo "Subject: $EMAIL_SUBJECT"
            echo "Content-Type: text/plain; charset=UTF-8"
            echo ""
            echo "$EMAIL_BODY"
        } | sendmail "$EMAIL" && success "Email envoyé"
    else
        warning "Commande mail non disponible - Email non envoyé"
        echo "$EMAIL_BODY" > "$SCHOOL_DIR/email.txt"
        log "Email sauvegardé dans: $SCHOOL_DIR/email.txt"
    fi
fi

echo ""
echo "═══════════════════════════════════════════════════════════"
echo "🎉 DÉPLOIEMENT TERMINÉ!"
echo "═══════════════════════════════════════════════════════════"
echo "   🏫 École: $SCHOOL_NAME"
echo "   🌐 URL: https://$DOMAIN"
echo "   📁 Répertoire: $SCHOOL_DIR"
echo "   💾 Database: $DB_NAME"
echo "   📊 Dashboard: http://$VPS_IP:8080"
echo "═══════════════════════════════════════════════════════════"
