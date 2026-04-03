
# 9. Fichier .env.example pour la configuration
env_example = '''# Configuration de la Base de Données
DB_HOST=mysql
DB_NAME=edu_platform
DB_USER=edu_user
DB_PASS=edu_password
DB_PORT=3306

# Configuration Email (SMTP)
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=tu-email@gmail.com
SMTP_PASS=tu-password-app
SMTP_FROM=noreply@eduflow.co

# Configuration de l'Application
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost
'''

with open('/Users/henri/Documents/GitHub/ESchool/.env.example', 'w') as f:
    f.write(env_example)

print("✅ Fichier .env.example créé")
