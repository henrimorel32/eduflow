
# Création d'un schéma explicatif
explanation = '''
┌─────────────────────────────────────────────────────────────┐
│  FLUX DES VARIABLES DE MOT DE PASSE                         │
└─────────────────────────────────────────────────────────────┘

ÉTAPE 1 : Génération (dans deploy-eduflow-prod.sh)
─────────────────────────────────────────────────
if [ -z "$DB_ROOT_PASSWORD" ]; then
    DB_ROOT_PASSWORD=$(openssl rand -base64 32)  ← Généré ici
fi
if [ -z "$DB_PASSWORD" ]; then
    DB_PASSWORD=$(openssl rand -base64 32)       ← Généré ici
fi


ÉTAPE 2 : Stockage dans .env
────────────────────────────
cat > .env << EOF
MYSQL_ROOT_PASSWORD=$DB_ROOT_PASSWORD    ← Stocké ici
MYSQL_PASSWORD=$DB_PASSWORD              ← Stocké ici
DB_PASS=$DB_PASSWORD                     ← Stocké ici
EOF

chmod 600 .env  ← Permissions restrictives


ÉTAPE 3 : Utilisation par Docker Compose
────────────────────────────────────────
services:
  mysql:
    env_file: - .env    ← Charge MYSQL_ROOT_PASSWORD & MYSQL_PASSWORD
    
  php:
    env_file: - .env    ← Charge DB_HOST, DB_NAME, DB_USER, DB_PASS


ÉTAPE 4 : Connexion PHP à MySQL
───────────────────────────────
// config.php lit les variables d'environnement
$db_host = getenv('DB_HOST');     ← "mysql" (nom du service)
$db_name = getenv('DB_NAME');     ← "edu_platform"
$db_user = getenv('DB_USER');     ← "edu_user"
$db_pass = getenv('DB_PASS');     ← Mot de passe généré

PDO : mysql:host=mysql;dbname=edu_platform...
'''

print(explanation)
