#!/bin/bash
# ============================================================
# DÉPLOIEMENT EN PRODUCTION - Site PHP
# ============================================================
# Usage: ./scripts/deploy-to-prod.sh
#
# Ce script déploie le site PHP sur le serveur de production
# Il fait un backup avant et vérifie que tout est OK
# ============================================================

set -e

# Configuration
SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SERVER_DIR="${SERVER_DIR:-/opt/docker/apps/eduflow}"

# Vérifier qu'on utilise bien le nom en minuscule
if [[ "$SERVER_DIR" =~ [A-Z] ]]; then
    echo "⚠️  ATTENTION : Le chemin contient des majuscules"
    echo "   Chemin demandé : $SERVER_DIR"
    echo "   Conversion en minuscules recommandée"
    SERVER_DIR=$(echo "$SERVER_DIR" | tr '[:upper:]' '[:lower:]')
    echo "   Nouveau chemin : $SERVER_DIR"
fi
LOCAL_DIR="$(pwd)"

# SSH Configuration
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"

# Options SSH complètes
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"
RSYNC_SSH="ssh -i $SSH_KEY -p $SSH_PORT"

echo "🚀 DÉPLOIEMENT EN PRODUCTION"
echo "=============================="
echo "Serveur: $SERVER_USER@$SERVER_HOST"
echo "Dossier: $SERVER_DIR"
echo ""

# Vérifier les variables d'environnement
if [ -z "$SERVER_HOST" ]; then
    echo "❌ Erreur: Définir SERVER_HOST"
    echo "   export SERVER_HOST=henrimorel.com"
    exit 1
fi

# ============================================================
# 1. VÉRIFICATIONS LOCALES
# ============================================================
echo "🔍 Vérifications locales..."

# Vérifier que les fichiers essentiels existent
for file in docker-compose.yml php/Dockerfile nginx/default.conf; do
    if [ ! -f "$file" ]; then
        echo "❌ Fichier manquant: $file"
        exit 1
    fi
done

echo "   ✅ Fichiers OK"

# ============================================================
# 2. BACKUP SUR LE SERVEUR
# ============================================================
echo ""
echo "💾 Backup sur le serveur..."

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << EOF
    cd $SERVER_DIR
    
    # Créer le dossier backup s'il n'existe pas
    mkdir -p backups
    
    # Backup avec timestamp
    BACKUP_NAME="backup-\$(date +%Y%m%d-%H%M%S)"
    echo "   Backup: backups/\$BACKUP_NAME"
    
    # Sauvegarder les sources PHP
    if [ -d php/src ]; then
        tar -czf "backups/\$BACKUP_NAME-php.tar.gz" php/src/
    fi
    
    # Sauvegarder la config nginx
    if [ -d nginx ]; then
        tar -czf "backups/\$BACKUP_NAME-nginx.tar.gz" nginx/
    fi
    
    # Lister les backups (garder les 5 derniers)
    ls -t backups/ | tail -n +6 | xargs -r rm -f
    
    echo "   ✅ Backup terminé"
EOF

# ============================================================
# 3. SYNCHRONISATION DES FICHIERS
# ============================================================
echo ""
echo "📤 Envoi des fichiers..."

# Exclusions
EXCLUDES="--exclude=node_modules --exclude=vendor --exclude=.git --exclude=archive --exclude=backups --exclude=logs --exclude=uploads"

# Envoyer les fichiers essentiels
echo "   → docker-compose.yml"
rsync -avz -e "$RSYNC_SSH" --progress $EXCLUDES docker-compose.yml "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"

echo "   → php/"
rsync -avz -e "$RSYNC_SSH" --progress $EXCLUDES php/ "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/php/"

echo "   → nginx/"
rsync -avz -e "$RSYNC_SSH" --progress $EXCLUDES nginx/ "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/nginx/"

echo "   → mysql/init.sql"
rsync -avz -e "$RSYNC_SSH" --progress mysql/init.sql "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/mysql/"

# Vérifier si .env existe sur le serveur
echo "   → .env"
ENV_EXISTS=$(ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" "test -f $SERVER_DIR/.env && echo 'yes' || echo 'no'" 2>/dev/null)
if [ "$ENV_EXISTS" = "no" ]; then
    echo "      ⚠️  .env manquant sur le serveur, envoi en cours..."
    rsync -avz -e "$RSYNC_SSH" --progress .env "$SERVER_USER@$SERVER_HOST:$SERVER_DIR/"
else
    echo "      ℹ️  .env existe déjà sur le serveur (non écrasé)"
    echo "         Pour mettre à jour: scp $SSH_OPTS .env $SERVER_USER@$SERVER_HOST:$SERVER_DIR/.env"
fi

echo "   ✅ Fichiers synchronisés"

# ============================================================
# 4. INSTALLATION DES DÉPENDANCES COMPOSER
# ============================================================
echo ""
echo "📦 Installation des dépendances PHP..."

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << EOF
    cd $SERVER_DIR
    
    # Vérifier si vendor existe
    if [ ! -f "php/src/vendor/autoload.php" ]; then
        echo "   → Installation de Composer..."
        docker exec edu_php sh -c 'cd /var/www/html && composer install --no-dev --optimize-autoloader 2>&1' || echo "   ⚠️  Erreur Composer, tentative avec PHP..."
    else
        echo "   ℹ️  vendor/ existe déjà"
    fi
EOF

# ============================================================
# 5. REDÉMARRAGE SUR LE SERVEUR
# ============================================================
echo ""
echo "🔄 Redémarrage des services..."

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << EOF
    cd $SERVER_DIR
    
    # Vérifier que le réseau existe
    if ! docker network ls | grep -q "edu_proxy"; then
        echo "   ⚠️  Création du réseau edu_proxy..."
        docker network create edu_proxy
    fi
    
    # Pull des images (pour avoir les dernières versions)
    echo "   → docker compose pull"
    docker compose -f docker-compose.yml pull
    
    # Rebuild PHP si Dockerfile changé
    echo "   → Rebuild PHP..."
    docker compose -f docker-compose.yml build php
    
    # Redémarrage
    echo "   → Redémarrage..."
    docker compose -f docker-compose.yml down || true
    docker compose -f docker-compose.yml up -d
    
    # Attendre que MySQL soit prêt
    echo "   → Attente MySQL..."
    sleep 5
    
    # Vérifier l'état
    echo ""
    echo "📊 État des conteneurs:"
    docker compose -f docker-compose.yml ps
    
    echo ""
    echo "📝 Logs récents:"
    docker compose -f docker-compose.yml logs --tail=10
EOF

# ============================================================
# 6. VÉRIFICATION
# ============================================================
echo ""
echo "🔍 Vérification..."

# Test HTTP
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://henrimorel.com || echo "000")

if [ "$HTTP_STATUS" = "200" ] || [ "$HTTP_STATUS" = "301" ] || [ "$HTTP_STATUS" = "302" ]; then
    echo "   ✅ Site accessible (HTTP $HTTP_STATUS)"
else
    echo "   ⚠️  Site répond HTTP $HTTP_STATUS"
fi

echo ""
echo "✅ DÉPLOIEMENT TERMINÉ !"
echo ""
echo "🌐 Vérifier le site: https://henrimorel.com"
echo ""
echo "📋 En cas de problème:"
echo "   ssh $SERVER_USER@$SERVER_HOST"
echo "   cd $SERVER_DIR"
echo "   docker compose logs -f"
echo ""
echo "💾 Backup disponible sur: $SERVER_DIR/backups/"
