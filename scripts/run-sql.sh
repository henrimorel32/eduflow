#!/bin/bash
# ============================================================
# EXÉCUTER UN SCRIPT SQL SUR LE SERVEUR
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

SQL_FILE="${1:-mysql/update_contenido_web.sql}"

echo "🗄️  EXÉCUTION SQL"
echo "================="
echo ""

if [ ! -f "$SQL_FILE" ]; then
    echo "❌ Fichier SQL non trouvé: $SQL_FILE"
    echo "Usage: $0 <fichier.sql>"
    exit 1
fi

echo "📤 Envoi du fichier SQL..."
scp $SSH_OPTS "$SQL_FILE" "$SERVER_USER@$SERVER_HOST:/tmp/script.sql"

echo ""
echo "🗄️  Exécution sur MySQL..."
ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    cd /opt/docker/apps/eduflow
    
    # Récupérer les credentials depuis .env
    DB_NAME=$(grep MYSQL_DATABASE .env | cut -d= -f2)
    DB_USER=$(grep MYSQL_USER .env | cut -d= -f2)
    DB_PASS=$(grep MYSQL_PASSWORD .env | cut -d= -f2)
    
    echo "BDD: $DB_NAME"
    echo ""
    
    # Exécuter le script
    docker exec -i edu_mysql mysql -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" < /tmp/script.sql 2>&1
    
    echo ""
    echo "✅ Script exécuté !"
    
    # Vider le cache
    echo ""
    echo "🧹 Vidage du cache..."
    docker restart edu_php
EOF

echo ""
echo "✅ Terminé !"
echo "🌐 Testez: https://henrimorel.com"
