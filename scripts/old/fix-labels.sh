#!/bin/bash
# ============================================================
# CORRECTION DES LABELS - Vider caches et vérifier BDD
# ============================================================

SERVER_USER="${SERVER_USER:-henri}"
SERVER_HOST="${SERVER_HOST:-51.178.136.181}"
SSH_KEY="${SSH_KEY:-~/.ssh/id_ed25519_vps_web_page}"
SSH_PORT="${SSH_PORT:-2222}"
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT"

echo "🔧 CORRECTION DES LABELS"
echo "========================"
echo ""

ssh $SSH_OPTS "$SERVER_USER@$SERVER_HOST" << 'EOF'
    cd /opt/docker/apps/eduflow
    
    echo "1️⃣ Vérification de la connexion BDD..."
    docker exec edu_php php -r "
        require '/var/www/html/vendor/autoload.php';
        require '/var/www/html/includes/config.php';
        \$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (\$conn->connect_error) {
            echo '❌ Erreur connexion: ' . \$conn->connect_error . PHP_EOL;
        } else {
            echo '✅ Connexion BDD OK' . PHP_EOL;
            
            // Vérifier la table contenido_web
            \$result = \$conn->query('SELECT clave, valor FROM contenido_web WHERE clave LIKE \"%label%\" OR clave LIKE \"%titulo%\" LIMIT 5');
            if (\$result) {
                echo '--- Labels en BDD ---' . PHP_EOL;
                while (\$row = \$result->fetch_assoc()) {
                    echo \$row['clave'] . ' = ' . substr(\$row['valor'], 0, 50) . PHP_EOL;
                }
            }
        }
    " 2>&1 || echo "⚠️  Erreur PHP"
    
    echo ""
    echo "2️⃣ Vider les caches PHP..."
    docker exec edu_php sh -c 'rm -rf /var/www/html/cache/* 2>/dev/null; echo "Cache vidé"'
    
    echo ""
    echo "3️⃣ Redémarrage de PHP..."
    docker restart edu_php
    sleep 3
    
    echo ""
    echo "4️⃣ Vérification des logs PHP..."
    docker logs edu_php --tail=10 2>&1 | grep -i "error\|warning" || echo "Pas d'erreurs récentes"
    
    echo ""
    echo "✅ Terminé !"
EOF

echo ""
echo "🌐 Rafraîchissez la page : https://henrimorel.com"
echo ""
echo "💡 Si les labels n'apparaissent toujours pas :"
echo "   1. Vérifier que les scripts SQL ont bien été exécutés"
echo "   2. Vérifier les noms des clés dans contenido_web"
echo "   3. Vérifier les logs Apache/Nginx"
