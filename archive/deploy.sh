#!/bin/bash
# ============================================================
# DÉPLOIEMENT COMPLET PRODUCTION
# ============================================================
# Ce script déploie l'infrastructure eduflow dans /opt/docker/apps/eduflow/
# ============================================================

set -e

EDUFLOW_DIR="/opt/docker/apps/eduflow"

echo "🚀 Déploiement Production ESchool"
echo "=================================="
echo ""

# Vérifier les prérequis
echo "🔍 Vérification..."

if ! command -v docker &> /dev/null; then
    echo "❌ Docker non installé"
    exit 1
fi

# Créer la structure
echo ""
echo "📁 Création de la structure..."

# Créer /opt/docker/apps si nécessaire
if [ ! -d "/opt/docker/apps" ]; then
    sudo mkdir -p /opt/docker/apps
    sudo chown $USER:$USER /opt/docker/apps
fi

# Créer les réseaux
docker network create proxy 2>/dev/null || echo "✅ Réseau 'proxy' existe déjà"
docker network create edu_internal 2>/dev/null || echo "✅ Réseau 'edu_internal' existe déjà"

# Copier le projet vers eduflow si on est dans le repo git
if [ -f "docker-compose.prod.yml" ]; then
    echo "📂 Copie vers /opt/docker/apps/eduflow..."
    
    # Créer le répertoire eduflow
    mkdir -p $EDUFLOW_DIR
    
    # Copier les fichiers
    cp -r . $EDUFLOW_DIR/
    
    echo "✅ Projet copié dans $EDUFLOW_DIR"
fi

# Aller dans le répertoire eduflow
cd $EDUFLOW_DIR

# Vérifier le .env
if [ ! -f ".env" ]; then
    echo ""
    echo "⚠️  Fichier .env non trouvé!"
    echo ""
    if [ -f "infra/.env.example" ]; then
        cp infra/.env.example .env
        echo "📝 Template .env créé. Veuillez l'éditer:"
        echo "   nano $EDUFLOW_DIR/.env"
        echo ""
        echo "Variables obligatoires:"
        echo "   POSTGRES_PASSWORD=votre_mot_de_passe"
        echo "   OVH_S3_ACCESS_KEY=votre_key"
        echo "   OVH_S3_SECRET_KEY=votre_secret"
        exit 1
    fi
fi

# Créer les répertoires nécessaires
mkdir -p letsencrypt
mkdir -p logs/nginx
mkdir -p logs/php
touch letsencrypt/acme.json
chmod 600 letsencrypt/acme.json

# Démarrage
echo ""
echo "🐳 Démarrage de l'infrastructure..."
docker-compose -f infra/docker-compose.infrastructure.yml up -d

# Attendre
echo "⏳ Attente du démarrage (10s)..."
sleep 10

# Vérifier
echo ""
echo "📊 État des services:"
docker-compose -f infra/docker-compose.infrastructure.yml ps

echo ""
echo "✅ Déploiement terminé!"
echo ""
echo "📁 Structure créée:"
echo "   Infra maître:  $EDUFLOW_DIR/"
echo "   Écoles:        /opt/docker/apps/<nom-ecole>/"
echo ""
echo "🌐 Accès:"
echo "   Site principal: https://henrimorel.com"
echo "   Adminer:        http://localhost:8082"
echo ""
echo "🎓 Pour ajouter une école:"
echo "   $EDUFLOW_DIR/infra/scripts/deploy-school.sh <slug> <domain>"
echo ""
echo "📋 Commandes utiles:"
echo "   cd $EDUFLOW_DIR"
echo "   docker-compose -f infra/docker-compose.infrastructure.yml logs -f"
echo ""
