#!/bin/bash
# ============================================================
# DEPLOY TO PRODUCTION - Script rapide
# ============================================================
# Ce script déploie tout sur le serveur production

set -e

# Couleurs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🚀 DÉPLOIEMENT PRODUCTION${NC}"
echo "============================================================"

# Vérifier que nous sommes dans le bon dossier
if [ ! -f "docker-compose.yml" ]; then
    echo -e "${RED}❌ Erreur: docker-compose.yml non trouvé${NC}"
    echo "Exécutez ce script depuis la racine du projet"
    exit 1
fi

# Configuration
SERVER_IP="votre_ip_ici"  # <-- MODIFIEZ CECI
REMOTE_DIR="/opt/docker/apps/eduflow"

echo -e "${YELLOW}⚙️ Configuration:${NC}"
echo "   Serveur: $SERVER_IP"
echo "   Dossier: $REMOTE_DIR"
echo ""

# Vérifier le Zone ID Cloudflare
if grep -q "CF_ZONE_ID=a_remplir" .env; then
    echo -e "${RED}❌ ATTENTION: CF_ZONE_ID n'est pas configuré!${NC}"
    echo ""
    echo "Récupérez votre Zone ID depuis:"
    echo "  https://dash.cloudflare.com"
    echo "  → Sélectionnez henrimorel.com → Zone ID (à droite)"
    echo ""
    echo "Puis modifiez le fichier .env:"
    echo "  CF_ZONE_ID=votre_zone_id_ici"
    echo ""
    read -p "Appuyez sur Entrée quand c'est fait..."
fi

echo -e "${BLUE}📁 Synchronisation des fichiers...${NC}"

# Créer l'archive
ARCHIVE="deploy-$(date +%Y%m%d-%H%M%S).tar.gz"
tar czf "/tmp/$ARCHIVE" \
    --exclude='.git' \
    --exclude='node_modules' \
    --exclude='*.log' \
    --exclude='php/src/uploads/logos/*' \
    --exclude='infra/scripts/test-cloudflare.sh' \
    .

echo -e "${GREEN}✅ Archive créée: /tmp/$ARCHIVE${NC}"

# Upload (décommentez quand le serveur est prêt)
# echo -e "${BLUE}📤 Upload vers le serveur...${NC}"
# scp "/tmp/$ARCHIVE" root@$SERVER_IP:/tmp/
# 
# echo -e "${BLUE}🔄 Extraction et déploiement...${NC}"
# ssh root@$SERVER_IP "
#     cd $REMOTE_DIR
#     tar xzf /tmp/$ARCHIVE --exclude='php/src/uploads'
#     docker-compose down
#     docker-compose up -d
#     rm /tmp/$ARCHIVE
# "

echo ""
echo -e "${GREEN}============================================================${NC}"
echo -e "${GREEN}✅ PRÊT POUR LE DÉPLOIEMENT!${NC}"
echo -e "${GREEN}============================================================${NC}"
echo ""
echo "Pour déployer, modifiez ce script avec:"
echo "  SERVER_IP=votre_ip"
echo ""
echo "Puis exécutez: ./deploy-to-production.sh"
echo ""

# Nettoyage
rm -f "/tmp/$ARCHIVE"
