#!/bin/bash
# ============================================================
# Script de démarrage en mode DEVELOPPEMENT LOCAL
# ============================================================

set -e

echo "🚀 Démarrage en mode DÉVELOPPEMENT LOCAL"
echo "=========================================="

# Vérifier que .env.local existe
if [ ! -f ".env.local" ]; then
    echo "❌ Erreur: Fichier .env.local non trouvé"
    echo "   Créez-le à partir de .env.example ou copiez .env"
    exit 1
fi

# Arrêter les conteneurs existants
echo "🛑 Arrêt des conteneurs existants..."
docker-compose -f docker-compose.local.yml down 2>/dev/null || true

# Démarrer avec le fichier .env.local
echo "🐳 Démarrage des conteneurs..."
docker-compose -f docker-compose.local.yml --env-file .env.local up -d

# Attendre que MySQL soit prêt
echo "⏳ Attente de MySQL..."
sleep 5

# Vérifier l'état
echo ""
echo "📊 État des conteneurs:"
docker-compose -f docker-compose.local.yml ps

echo ""
echo "✅ Démarrage terminé!"
echo ""
echo "🌐 Accès:"
echo "   Site web:     http://localhost:8081"
echo "   phpMyAdmin:   http://localhost:8080"
echo ""
echo "🛑 Pour arrêter:"
echo "   docker-compose -f docker-compose.local.yml down"
echo ""
