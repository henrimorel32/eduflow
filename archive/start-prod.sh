#!/bin/bash
# ============================================================
# Script de démarrage en mode PRODUCTION
# ============================================================

set -e

echo "🚀 Démarrage en mode PRODUCTION"
echo "================================="
echo ""

# Vérifier que .env existe
if [ ! -f ".env" ]; then
    echo "❌ Erreur: Fichier .env non trouvé"
    echo "   Créez-le à partir de .env.example avec les vraies credentials"
    exit 1
fi

# Créer le réseau proxy s'il n'existe pas
if ! docker network ls | grep -q "proxy"; then
    echo "🌐 Création du réseau 'proxy'..."
    docker network create proxy
fi

# Vérifier si Traefik tourne
if ! docker ps | grep -q "traefik"; then
    echo "⚠️  Traefik n'est pas démarré!"
    echo ""
    echo "Voulez-vous démarrer Traefik maintenant?"
    read -p "(o/n): " response
    if [ "$response" = "o" ] || [ "$response" = "O" ]; then
        echo "🚀 Démarrage de Traefik..."
        docker-compose -f docker-compose.traefik.yml up -d
        echo "⏳ Attente de Traefik..."
        sleep 5
    else
        echo "❌ Annulé. Traefik est requis pour la production."
        exit 1
    fi
fi

# Arrêter les conteneurs existants
echo "🛑 Arrêt des conteneurs existants..."
docker-compose down 2>/dev/null || true

# Démarrer avec le fichier .env (production)
echo "🐳 Démarrage des conteneurs..."
docker-compose up -d

# Attendre que tout soit prêt
echo "⏳ Attente des services..."
sleep 5

# Vérifier l'état
echo ""
echo "📊 État des conteneurs:"
docker-compose ps

echo ""
echo "✅ Démarrage terminé!"
echo ""
echo "🌐 Le site est accessible via Traefik:"
echo "   - http://henrimorel.com"
echo "   - https://henrimorel.com (SSL)"
echo ""
echo "📋 Commandes utiles:"
echo "   Logs:        docker-compose logs -f"
echo "   Stop:        docker-compose down"
echo "   Restart:     docker-compose restart"
echo ""
