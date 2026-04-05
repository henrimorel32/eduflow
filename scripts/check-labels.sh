#!/bin/bash
# ============================================================
# VÉRIFIER LES LABELS EN BASE DE DONNÉES
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔍 VÉRIFICATION DES LABELS EN BDD"
echo "=================================="
echo ""

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    cd /opt/docker/apps/eduflow
    
    # Récupérer les credentials
    DB_NAME=$(grep MYSQL_DATABASE .env | cut -d= -f2)
    DB_USER=$(grep MYSQL_USER .env | cut -d= -f2)
    DB_PASS=$(grep MYSQL_PASSWORD .env | cut -d= -f2)
    
    echo "📊 Contenu de la table 'contenido_web' :"
    echo "-----------------------------------------"
    docker exec edu_mysql mysql -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" -e "
        SELECT clave, LEFT(valor, 60) as valor 
        FROM contenido_web 
        ORDER BY clave 
        LIMIT 30;
    " 2>/dev/null || echo "❌ Erreur de connexion à MySQL"
    
    echo ""
    echo "📊 Tables disponibles :"
    docker exec edu_mysql mysql -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" -e "SHOW TABLES;" 2>/dev/null | head -20
EOF

echo ""
echo "✅ Vérification terminée"
