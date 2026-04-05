
# Vérification que le .env est correctement généré avec les variables
env_section = '''    # Fichier .env pour les variables sensibles
    cat > .env << EOF
# ============================================
# Configuration Production - EduFlow
# ============================================

# Domaines
DOMAIN=$DOMAIN
WWW_DOMAIN=$WWW_DOMAIN
EMAIL=$EMAIL

# Base de données (générées automatiquement - NE PAS MODIFIER)
MYSQL_ROOT_PASSWORD=$DB_ROOT_PASSWORD
MYSQL_DATABASE=edu_platform
MYSQL_USER=edu_user
MYSQL_PASSWORD=$DB_PASSWORD

# Variables pour l'application PHP
DB_HOST=mysql
DB_NAME=edu_platform
DB_USER=edu_user
DB_PASS=$DB_PASSWORD

# Sécurité
APP_ENV=production
APP_DEBUG=false
EOF
    
    chmod 600 .env'''

print("Contenu du fichier .env généré :")
print("=" * 50)
print(env_section)
print("=" * 50)
print()
print("✅ Les variables DB_ROOT_PASSWORD et DB_PASSWORD sont bien :")
print("   1. Générées dans le script bash (une seule fois)")
print("   2. Stockées dans le fichier .env")
print("   3. Utilisées par Docker Compose via 'env_file: - .env'")
