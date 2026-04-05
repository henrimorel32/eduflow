#!/bin/bash
# Déploiement complet d'une école avec vérifications

set -e

SCHOOL_SLUG=$1
DOMAIN=$2
SCHOOL_NAME=$3
COLOR_PRIMARY=$4
COLOR_SECONDARY=$5
LOGO_URL=$6
EMAIL=$7

if [ -z "$SCHOOL_SLUG" ] || [ -z "$DOMAIN" ]; then
    echo "Usage: $0 <slug> <domain> <name> <color1> <color2> <logo_url> <email>"
    exit 1
fi

# Configuration
VPS_IP="51.178.136.181"
CF_TOKEN="cfut_ODAxjdMm01L4yE3OI8twIqIFFmafAQQ6nK8LpwU19f112046"
ZONE_ID="7f32dd53110ce98aa3b8afad0b166710"
TRAEFIK_DYNAMIC_DIR="/opt/docker/traefik/dynamic"

echo "🚀 DÉPLOIEMENT ÉCOLE: $SCHOOL_NAME"
echo "   Slug: $SCHOOL_SLUG"
echo "   Domaine: $DOMAIN"
echo "   IP: $VPS_IP"
echo ""

# 1. CRÉATION DU CONTAINER
echo "1️⃣  Création du container..."
SCHOOL_DIR="/opt/docker/apps/$SCHOOL_SLUG"
mkdir -p "$SCHOOL_DIR"

cat > "$SCHOOL_DIR/docker-compose.yml" << EOFCOMPOSE
services:
  school_${SCHOOL_SLUG}:
    image: node:20-alpine
    container_name: school_${SCHOOL_SLUG}
    restart: unless-stopped
    working_dir: /app
    command: sh -c "npm install && npm run build && npx next start -H 0.0.0.0"
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
      - EMAIL_USER=henri@henrimorel.com
      - EMAIL_PASSWORD=fgufapesjsxreeol
    volumes:
      - /opt/docker/apps/eduflow/nextjs-template:/app
    networks:
      - eduflow_edu_internal
      - edu_proxy

networks:
  eduflow_edu_internal:
    external: true
  edu_proxy:
    external: true
EOFCOMPOSE

cd "$SCHOOL_DIR" && docker compose up -d

# 2. VÉRIFICATION CONTAINER
echo "2️⃣  Vérification du container..."
sleep 10
for i in {1..10}; do
    if docker ps | grep -q "school_${SCHOOL_SLUG}"; then
        echo "   ✅ Container démarré"
        break
    fi
    echo "   ⏳ Attente container... (\$i/10)"
    sleep 3
done

# Vérifier port 3000
echo "   Vérification port 3000..."
for i in {1..10}; do
    if docker exec "school_${SCHOOL_SLUG}" wget -qO- http://localhost:3000 2>/dev/null | grep -q "html"; then
        echo "   ✅ Port 3000 OK"
        break
    fi
    echo "   ⏳ Attente port 3000... (\$i/10)"
    sleep 5
done

# 3. CRÉATION CONFIG TRAEFIK (fichier séparé)
echo "3️⃣  Configuration Traefik..."

cat > "${TRAEFIK_DYNAMIC_DIR}/${SCHOOL_SLUG}.yml" << EOFTRAEFIK
http:
  routers:
    school-${SCHOOL_SLUG}:
      rule: Host(\`${DOMAIN}\`)
      service: service-${SCHOOL_SLUG}
      tls:
        certResolver: letsencrypt
    
    school-${SCHOOL_SLUG}-www:
      rule: Host(\`www.${DOMAIN}\`)
      service: service-${SCHOOL_SLUG}
      tls:
        certResolver: letsencrypt

  services:
    service-${SCHOOL_SLUG}:
      loadBalancer:
        servers:
          - url: "http://school_${SCHOOL_SLUG}:3000"
EOFTRAEFIK

echo "   ✅ Config Traefik créée: ${TRAEFIK_DYNAMIC_DIR}/${SCHOOL_SLUG}.yml"
sleep 5

# 4. CRÉATION DES DNS Cloudflare
echo "4️⃣  Création des DNS Cloudflare..."

curl -s -X POST \
  "https://api.cloudflare.com/client/v4/zones/${ZONE_ID}/dns_records" \
  -H "Authorization: Bearer ${CF_TOKEN}" \
  -H "Content-Type: application/json" \
  -d "{\"type\":\"A\",\"name\":\"${DOMAIN}\",\"content\":\"${VPS_IP}\",\"ttl\":120,\"proxied\":false}" | grep -o '"success":[^,]*'

curl -s -X POST \
  "https://api.cloudflare.com/client/v4/zones/${ZONE_ID}/dns_records" \
  -H "Authorization: Bearer ${CF_TOKEN}" \
  -H "Content-Type: application/json" \
  -d "{\"type\":\"A\",\"name\":\"www.${DOMAIN}\",\"content\":\"${VPS_IP}\",\"ttl\":120,\"proxied\":false}" | grep -o '"success":[^,]*'

echo "   ✅ DNS créés"

# 5. ATTENTE PROPAGATION DNS
echo "5️⃣  Attente propagation DNS..."
sleep 60

for i in {1..10}; do
    if nslookup "$DOMAIN" 1.1.1.1 2>/dev/null | grep -q "${VPS_IP}"; then
        echo "   ✅ DNS propagé"
        break
    fi
    echo "   ⏳ Attente DNS... (\$i/10)"
    sleep 10
done

# 6. ATTENTE CERTIFICAT SSL
echo "6️⃣  Attente génération certificat SSL (Let's Encrypt)..."
for i in {1..30}; do
    CERT_INFO=$(echo | openssl s_client -connect "${DOMAIN}:443" -servername "${DOMAIN}" 2>/dev/null | openssl x509 -noout -issuer 2>/dev/null || true)
    if echo "$CERT_INFO" | grep -q "Let's Encrypt"; then
        echo "   ✅ Certificat SSL OK (Let's Encrypt)"
        break
    fi
    echo "   ⏳ Attente certificat... (\$i/30)"
    sleep 10
done

# 7. VÉRIFICATION FINALE
echo "7️⃣  Vérification finale..."
HTTP_CODE=$(curl -s -o /dev/null -w '%{http_code}' "https://${DOMAIN}" 2>/dev/null || echo "000")
if [ "$HTTP_CODE" = "200" ] || [ "$HTTP_CODE" = "307" ]; then
    echo "   ✅ Site accessible (HTTP $HTTP_CODE)"
else
    echo "   ⚠️  Site retourne HTTP $HTTP_CODE"
fi

# 8. ENVOI EMAIL DE CONFIRMATION
echo "8️⃣  Envoi email de confirmation..."
if [ -n "$EMAIL" ]; then
    echo "   📧 Envoi à: $EMAIL"
    
    # Utiliser le script PHP avec PHPMailer
    docker exec edu_php php /var/www/html/src/pages/suscripcion_email_deployed.php "$EMAIL" "$SCHOOL_NAME" "$DOMAIN" 2>/dev/null
    if [ $? -eq 0 ]; then
        echo "   ✅ Email envoyé avec PHPMailer"
    else
        echo "   ⚠️  Échec envoi email (vérifiez container edu_php)"
    fi
else
    echo "   ℹ️  Aucun email fourni"
fi

echo 
echo 🎉 DÉPLOIEMENT TERMINÉ!
echo  URL: https://$DOMAIN
echo  Dashboard: http://$VPS_IP:8080
