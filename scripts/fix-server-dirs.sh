#!/bin/bash
# ============================================================
# CORRECTION DES DOSSIERS EN DOUBLE SUR LE SERVEUR
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔧 CORRECTION DES DOSSIERS EN DOUBLE"
echo "===================================="
echo ""

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    APPS_DIR="/opt/docker/apps"
    
    # Chercher tous les dossiers edu*
    echo "📁 Dossiers trouvés :"
    ls -la $APPS_DIR/ | grep -i edu
    echo ""
    
    # Déterminer lequel est le bon (celui avec docker-compose.yml ET containers actifs)
    GOOD_DIR=""
    for dir in $APPS_DIR/edu*; do
        if [ -d "$dir" ]; then
            CONTAINERS=$(docker ps --format "{{.Names}}" | grep -c "edu_" || echo "0")
            if [ "$CONTAINERS" -gt 0 ] && [ -f "$dir/docker-compose.yml" ]; then
                GOOD_DIR="$dir"
                echo "✅ Dossier actif trouvé : $GOOD_DIR"
                break
            fi
        fi
    done
    
    if [ -z "$GOOD_DIR" ]; then
        echo "⚠️  Aucun dossier avec containers actifs trouvé"
        echo "   Utilisation de : /opt/docker/apps/eduflow"
        GOOD_DIR="/opt/docker/apps/eduflow"
    fi
    
    # Normaliser le nom (tout en minuscule)
    TARGET_DIR="/opt/docker/apps/eduflow"
    
    if [ "$GOOD_DIR" != "$TARGET_DIR" ]; then
        echo ""
        echo "🔄 Renommage $GOOD_DIR → $TARGET_DIR"
        
        # Arrêter les containers avant
        echo "   Arrêt des containers..."
        cd "$GOOD_DIR" && docker-compose down 2>/dev/null || true
        
        # Backup avant déplacement
        echo "   Backup..."
        cp -r "$GOOD_DIR" "${GOOD_DIR}.backup.$(date +%Y%m%d)"
        
        # Déplacer
        mv "$GOOD_DIR" "$TARGET_DIR"
        echo "   ✅ Déplacé vers $TARGET_DIR"
    fi
    
    # Supprimer les autres dossiers edu* (sauf le bon et backups)
    echo ""
    echo "🧹 Nettoyage des dossiers en double..."
    for dir in $APPS_DIR/edu*; do
        if [ -d "$dir" ] && [ "$dir" != "$TARGET_DIR" ] && [[ ! "$dir" =~ \.backup\.[0-9]{8}$ ]]; then
            echo "   ❌ Suppression de $dir"
            rm -rf "$dir"
        fi
    done
    
    echo ""
    echo "✅ Nettoyage terminé !"
    echo ""
    echo "📁 Dossier officiel : $TARGET_DIR"
    echo ""
    echo "🐳 Pour redémarrer les services :"
    echo "   cd $TARGET_DIR"
    echo "   docker-compose up -d"
EOF
