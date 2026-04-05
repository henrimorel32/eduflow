#!/bin/bash
# ============================================================
# Script de configuration Production - Droits et répertoires
# À exécuter sur le serveur hôte (PAS dans le conteneur Docker)
# ============================================================

set -e

echo "🔧 Configuration des répertoires pour le système de souscription"
echo "================================================================"

# Créer le répertoire principal pour les écoles
SCHOOLS_DIR="/var/schools"

echo "📁 Création de $SCHOOLS_DIR..."
if [ ! -d "$SCHOOLS_DIR" ]; then
    sudo mkdir -p "$SCHOOLS_DIR"
    echo "✅ Répertoire créé"
else
    echo "✅ Répertoire existe déjà"
fi

# Créer le répertoire pour les logos en local (fallback si S3 échoue)
LOGOS_DIR="$(cd "$(dirname "$0")/.." && pwd)/php/src/uploads/logos"
echo "📁 Création du répertoire pour logos: $LOGOS_DIR..."
mkdir -p "$LOGOS_DIR"
chmod -R 777 "$LOGOS_DIR"
echo "✅ Répertoire logos créé avec permissions 777"

# Définir les permissions pour /var/schools
echo "🔐 Configuration des permissions pour $SCHOOLS_DIR..."
sudo chown -R $USER:$USER "$SCHOOLS_DIR"
sudo chmod -R 755 "$SCHOOLS_DIR"

# Vérifier que Docker peut écrire dans ce répertoire (si Docker s'exécute en tant que root)
echo "🔐 Permissions pour Docker..."
sudo chmod 777 "$SCHOOLS_DIR"  # Permettre à tout le monde d'écrire (nécessaire pour Docker)

echo ""
echo "✅ Configuration terminée!"
echo ""
echo "📋 Résumé:"
echo "   Répertoire écoles: $SCHOOLS_DIR"
echo "   Permissions: $(ls -ld $SCHOOLS_DIR | awk '{print $1}')"
echo "   Répertoire logos: $LOGOS_DIR"
echo ""
echo "💡 Pour créer une nouvelle école, utilisez:"
echo "   ./scripts/create-school.sh <school-slug>"
echo ""
