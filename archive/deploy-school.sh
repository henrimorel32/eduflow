#!/bin/bash
# ============================================================
# Script de déploiement d'une nouvelle école
# Usage: ./deploy-school.sh <SCHOOL_SLUG>
# ============================================================

set -e

SCHOOL_SLUG=$1

if [ -z "$SCHOOL_SLUG" ]; then
    echo "❌ Erreur: Vous devez spécifier le slug de l'école"
    echo "Usage: $0 <school-slug>"
    exit 1
fi

DEPLOY_DIR="/var/schools/$SCHOOL_SLUG"

echo "🚀 Déploiement de l'école: $SCHOOL_SLUG"
echo "📁 Répertoire: $DEPLOY_DIR"

# Vérifier si le répertoire existe
if [ ! -d "$DEPLOY_DIR" ]; then
    echo "❌ Erreur: Le répertoire $DEPLOY_DIR n'existe pas"
    echo "   Assurez-vous que la souscription a été créée via le formulaire web"
    exit 1
fi

cd "$DEPLOY_DIR"

# Vérifier les fichiers nécessaires
if [ ! -f "docker-compose.yml" ]; then
    echo "❌ Erreur: docker-compose.yml non trouvé"
    exit 1
fi

if [ ! -f ".env" ]; then
    echo "❌ Erreur: .env non trouvé"
    exit 1
fi

echo "📋 Fichiers trouvés:"
ls -la

# Créer les répertoires nécessaires
echo "📁 Création des répertoires..."
mkdir -p logs/nginx
mkdir -p php/src
mkdir -p mysql
mkdir -p nginx

# Copier les fichiers source (ou créer des liens symboliques)
echo "📂 Configuration des sources..."

# Option 1: Copier les fichiers (pour des installations indépendantes)
# cp -r /var/www/template/php/src/* php/src/
# cp -r /var/www/template/nginx/* nginx/
# cp /var/www/template/mysql/init.sql mysql/

# Option 2: Liens symboliques (pour partager les mises à jour)
# ln -sf /var/www/template/php/src php/src
# ln -sf /var/www/template/nginx nginx
# ln -sf /var/www/template/mysql/init.sql mysql/init.sql

# Option 3: Monter les volumes Docker (recommandé pour le développement)
# Déjà configuré dans docker-compose.yml

echo "🐳 Lancement des conteneurs Docker..."
docker-compose up -d

# Attendre que MySQL soit prêt
echo "⏳ Attente de MySQL..."
sleep 10

# Vérifier l'état des conteneurs
echo "📊 État des conteneurs:"
docker-compose ps

# Afficher les informations
echo ""
echo "✅ Déploiement terminé avec succès!"
echo ""
echo "🌐 URL d'accès:"
echo "   https://$SCHOOL_SLUG.henrimorel.com"
echo ""
echo "🔧 phpMyAdmin (localhost uniquement):"
echo "   http://localhost:<port_configuré>"
echo ""
echo "📋 Pour voir les logs:"
echo "   docker-compose logs -f"
echo ""
echo "🛑 Pour arrêter:"
echo "   docker-compose down"
echo ""
