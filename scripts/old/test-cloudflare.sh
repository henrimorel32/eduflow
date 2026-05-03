#!/bin/bash
# ============================================================
# TEST DE CONNEXION CLOUDFLARE
# ============================================================

set -e

# Charger les variables d'environnement
if [ -f "/opt/docker/apps/eduflow/.env" ]; then
    export $(grep -v '^#' /opt/docker/apps/eduflow/.env | xargs)
fi

if [ -f ".env" ]; then
    export $(grep -v '^#' .env | xargs)
fi

echo "🌐 Test de connexion Cloudflare"
echo "================================"
echo ""

# Vérifier les variables
if [ -z "$CF_API_TOKEN" ]; then
    echo "❌ Variable CF_API_TOKEN non définie"
    echo "   Ajoutez-la dans le fichier .env"
    exit 1
fi

if [ -z "$CF_ZONE_ID" ]; then
    echo "❌ Variable CF_ZONE_ID non définie"
    echo "   Ajoutez-la dans le fichier .env"
    exit 1
fi

echo "✅ Variables d'environnement OK"
echo ""

# Test 1: Vérifier le token
echo "🔑 Test 1: Vérification du token API..."
RESPONSE=$(curl -s -H "Authorization: Bearer $CF_API_TOKEN" \
    "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID")

if echo "$REPONSE" | grep -q "\"success\":true"; then
    echo "✅ Token API valide"
    
    # Extraire le nom du domaine
    DOMAIN=$(echo "$REPONSE" | grep -o '"name":"[^"]*"' | head -1 | cut -d'"' -f4)
    echo "   Domaine trouvé: $DOMAIN"
else
    echo "❌ Token API invalide"
    echo "   Réponse: $REPONSE"
    exit 1
fi

echo ""

# Test 2: Lister les DNS existants
echo "📋 Test 2: Liste des records DNS..."
curl -s -H "Authorization: Bearer $CF_API_TOKEN" \
    "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID/dns_records" | \
    grep -o '"name":"[^"]*"' | cut -d'"' -f4 | head -10

echo ""

# Test 3: Créer un record de test (optionnel)
read -p "Voulez-vous créer un record de test ? (o/n): " response
if [ "$response" = "o" ] || [ "$response" = "O" ]; then
    echo ""
    echo "📝 Test 3: Création d'un record DNS de test..."
    
    TEST_RESULT=$(curl -s -X POST \
        "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID/dns_records" \
        -H "Authorization: Bearer $CF_API_TOKEN" \
        -H "Content-Type: application/json" \
        --data '{
            "type": "CNAME",
            "name": "test-eschool",
            "content": "'"$DOMAIN"'",
            "ttl": 1,
            "proxied": true
        }')
    
    if echo "$TEST_RESULT" | grep -q "\"success\":true"; then
        echo "✅ Record créé: test-eschool.$DOMAIN"
        echo "   URL: https://test-eschool.$DOMAIN"
        echo ""
        echo "   Suppression du record de test..."
        
        # Récupérer l'ID du record pour le supprimer
        RECORD_ID=$(echo "$TEST_RESULT" | grep -o '"id":"[^"]*"' | head -1 | cut -d'"' -f4)
        
        curl -s -X DELETE \
            "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID/dns_records/$RECORD_ID" \
            -H "Authorization: Bearer $CF_API_TOKEN" > /dev/null
        
        echo "✅ Record de test supprimé"
    else
        echo "❌ Échec création record"
        echo "   Réponse: $TEST_RESULT"
    fi
fi

echo ""
echo "🎉 Tests terminés!"
echo ""
echo "📋 Prochaines étapes:"
echo "   1. Créer un record A vers votre IP serveur"
echo "   2. Configurer SSL/TLS sur 'Full (strict)'"
echo "   3. Déployer avec: ./deploy-school.sh <slug> <domain>"
echo ""
