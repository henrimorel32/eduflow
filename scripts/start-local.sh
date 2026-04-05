#!/bin/bash
# ============================================================
# DÉMARRAGE LOCAL - Site PHP uniquement
# ============================================================
# Usage: ./scripts/start-local.sh
# 
# Ce script démarre le site PHP en local sur http://localhost:8080
# Sans Traefik, sans SSL - juste pour tester le site de base
# ============================================================

set -e

echo "🚀 Démarrage du site en local..."
echo ""

# Vérifier que Docker est installé
if ! command -v docker &> /dev/null; then
    echo "❌ Docker n'est pas installé"
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose n'est pas installé"
    exit 1
fi

# Créer les répertoires nécessaires
mkdir -p logs/nginx
mkdir -p uploads

# Démarrer les services
echo "🐳 Démarrage des conteneurs..."
docker-compose up -d

echo ""
echo "⏳ Attente du démarrage de MySQL (10s)..."
sleep 10

echo ""
echo "✅ Site démarré !"
echo ""
echo "🌐 URLs d'accès:"
echo "   Site web:    http://localhost:8080"
echo "   phpMyAdmin:  http://localhost:8081"
echo ""
echo "📋 Commandes utiles:"
echo "   Logs:        docker-compose logs -f"
echo "   Stop:        docker-compose down"
echo "   Restart:     docker-compose restart"
echo ""
echo "⚠️  Pour tester en PROD avec Traefik:"
echo "   docker-compose -f docker-compose.yml up -d"
echo ""
