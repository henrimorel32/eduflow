#!/bin/bash
# ============================================================
# CRÉATION MANUELLE DE DNS CLOUDFLARE
# ============================================================
# Usage: ./create-dns.sh <nom> <type> <contenu>
# Exemple: ./create-dns.sh colegio-san-jose CNAME henrimorel.com
# ============================================================

set -e

# Charger les variables
if [ -f "/opt/docker/apps/eduflow/.env" ]; then
    source /opt/docker/apps/eduflow/.env
fi

if [ -f ".env" ]; then
    source .env
fi

NAME=$1
TYPE=${2:-CNAME}
CONTENT=${3:-"henrimorel.com"}

if [ -z "$NAME" ]; then
    echo "Usage: $0 <nom> [type] [contenu]"
    echo ""
    echo "Exemples:"
    echo "  $0 colegio-san-jose"
    echo "  $0 ecole-primaire CNAME henrimorel.com"
    echo "  $0 test A 1.2.3.4"
    exit 1
fi

if [ -z "$CF_API_TOKEN" ] || [ -z "$CF_ZONE_ID" ]; then
    echo "❌ Variables Cloudflare non définies"
    echo "   Assurez-vous que CF_API_TOKEN et CF_ZONE_ID sont dans .env"
    exit 1
fi

echo "🌐 Création DNS Cloudflare"
echo "=========================="
echo ""
echo "Nom:     $NAME"
echo "Type:    $TYPE"
echo "Contenu: $CONTENT"
echo ""

# Créer le record
RESULT=$(curl -s -X POST \
    "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID/dns_records" \
    -H "Authorization: Bearer $CF_API_TOKEN" \
    -H "Content-Type: application/json" \
    --data "{
        \"type\": \"$TYPE\",
        \"name\": \"$NAME\",
        \"content\": \"$CONTENT\",
        \"ttl\": 1,
        \"proxied\": true
    }")

if echo "$RESULT" | grep -q "\"success\":true"; then
    echo "✅ Record créé avec succès!"
    echo ""
    echo "🌐 URL: https://$NAME.$(curl -s -H "Authorization: Bearer $CF_API_TOKEN" \
        "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID" | grep -o '"name":"[^"]*"' | head -1 | cut -d'"' -f4)"
else
    echo "❌ Erreur lors de la création"
    echo ""
    echo "Réponse:"
    echo "$RESULT" | jq . 2>/dev/null || echo "$RESULT"
fi
