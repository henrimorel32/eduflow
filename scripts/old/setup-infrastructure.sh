#!/bin/bash
# ============================================================
# SETUP INFRASTRUCTURE INITIALE
# ============================================================

set -e

APPS_DIR="/opt/docker/apps"

echo "🚀 Setup Infrastructure ESchool"
echo "================================"
echo ""

# Vérifier Docker
echo "🔍 Vérification Docker..."
if ! command -v docker &> /dev/null; then
    echo "❌ Docker non installé"
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose non installé"
    exit 1
fi

echo "✅ Docker OK"

# Créer répertoires
echo ""
echo "📁 Création des répertoires..."
mkdir -p $APPS_DIR
mkdir -p $APPS_DIR/letsencrypt
mkdir -p $APPS_DIR/schools
mkdir -p $APPS_DIR/logs
mkdir -p $APPS_DIR/init/postgres
touch $APPS_DIR/letsencrypt/acme.json
chmod 600 $APPS_DIR/letsencrypt/acme.json

# Créer réseaux
echo ""
echo "🌐 Création des réseaux Docker..."
docker network create proxy 2>/dev/null || echo "Réseau 'proxy' existe déjà"
docker network create edu_internal 2>/dev/null || echo "Réseau 'edu_internal' existe déjà"

# Copier les fichiers
echo ""
echo "📂 Installation des fichiers..."

# Note: À adapter selon d'où vous exécutez ce script
# cp docker-compose.infrastructure.yml $APPS_DIR/
# cp .env.example $APPS_DIR/.env

echo ""
echo "✅ Infrastructure préparée!"
echo ""
echo "📋 Prochaines étapes:"
echo ""
echo "1. Aller dans le répertoire:"
echo "   cd $APPS_DIR"
echo ""
echo "2. Copier les fichiers docker-compose:"
echo "   cp /chemin/vers/docker-compose.infrastructure.yml ."
echo "   cp /chemin/vers/.env.example .env"
echo ""
echo "3. Éditer .env avec vos credentials"
echo ""
echo "4. Démarrer l'infrastructure:"
echo "   docker-compose -f docker-compose.infrastructure.yml up -d"
echo ""
echo "5. Vérifier que tout fonctionne:"
echo "   docker ps"
echo "   curl http://localhost"
echo ""
