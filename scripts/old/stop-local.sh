#!/bin/bash
# ============================================================
# ARRÊT LOCAL
# ============================================================
# Arrête tous les conteneurs de développement local
# ============================================================

echo "🛑 Arrêt des conteneurs locaux..."

docker-compose down

echo ""
echo "✅ Conteneurs arrêtés"
echo ""
echo "💡 Pour supprimer aussi les volumes (données):"
echo "   docker-compose down -v"
