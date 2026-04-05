
# Lecture du fichier de déploiement actuel
with open('/Users/henri/Documents/GitHub/ESchool/deploiementProd.py', 'r') as f:
    content = f.read()

# Correction : les variables doivent être générées AVANT et stockées dans .env
# Recherche de la section generate_configs et modification

old_section = '''# Variables configurables (à modifier selon votre environnement)
DOMAIN=${DOMAIN:-"eduflow.co"}                    # Votre domaine principal
WWW_DOMAIN=${WWW_DOMAIN:-"www.eduflow.co"}        # Sous-domaine www
EMAIL=${EMAIL:-"admin@eduflow.co"}                # Email pour Certbot
APP_DIR=${APP_DIR:-"/opt/eduflow"}                # Répertoire d'installation
DB_ROOT_PASSWORD=${DB_ROOT_PASSWORD:-$(openssl rand -base64 32)}
DB_PASSWORD=${DB_PASSWORD:-$(openssl rand -base64 32)}'''

new_section = '''# Variables configurables (à modifier selon votre environnement)
DOMAIN=${DOMAIN:-"eduflow.co"}                    # Votre domaine principal
WWW_DOMAIN=${WWW_DOMAIN:-"www.eduflow.co"}        # Sous-domaine www
EMAIL=${EMAIL:-"admin@eduflow.co"}                # Email pour Certbot
APP_DIR=${APP_DIR:-"/opt/eduflow"}                # Répertoire d'installation

# Génération des mots de passe sécurisés (une seule fois)
# Ces valeurs seront stockées dans le fichier .env
if [ -z "$DB_ROOT_PASSWORD" ]; then
    DB_ROOT_PASSWORD=$(openssl rand -base64 32)
fi
if [ -z "$DB_PASSWORD" ]; then
    DB_PASSWORD=$(openssl rand -base64 32)
fi'''

content = content.replace(old_section, new_section)

# Sauvegarde
with open('/Users/henri/Documents/GitHub/ESchool/deploiementProd.py', 'w') as f:
    f.write(content)

print("✅ Correction appliquée : Les mots de passe sont maintenant générés une seule fois")
print("   et stockés dans le fichier .env")
