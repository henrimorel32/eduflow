#!/bin/bash
# ============================================================
# Script de création d'une école
# À exécuter sur le serveur hôte (PAS dans le conteneur Docker)
# Usage: ./create-school.sh <school-slug>
# ============================================================

set -e

SCHOOL_SLUG=$1

if [ -z "$SCHOOL_SLUG" ]; then
    echo "❌ Erreur: Vous devez spécifier le slug de l'école"
    echo "Usage: $0 <school-slug>"
    echo "Exemple: $0 instituto-monte-de-los-colores"
    exit 1
fi

DEPLOY_DIR="/var/schools/$SCHOOL_SLUG"
PROJECT_DIR="$(cd "$(dirname "$0")/.." && pwd)"

echo "🚀 Création de l'école: $SCHOOL_SLUG"
echo "================================================================"

# Vérifier que le répertoire parent existe
if [ ! -d "/var/schools" ]; then
    echo "❌ Erreur: Le répertoire /var/schools n'existe pas"
    echo "   Exécutez d'abord: ./scripts/setup-production.sh"
    exit 1
fi

# Créer le répertoire de l'école
echo "📁 Création du répertoire: $DEPLOY_DIR"
mkdir -p "$DEPLOY_DIR"

# Récupérer les informations de l'école depuis la base de données
echo "📊 Récupération des informations depuis la BDD..."

# Note: Adapter les credentials selon votre configuration
DB_USER="edu_user"
DB_PASS="edu_password"
DB_NAME="edu_platform"

# Récupérer les données
docker exec edu_mysql mysql -u$DB_USER -p$DB_PASS $DB_NAME -N -e "
SELECT 
    nombre_escuela,
    slug,
    color_primario,
    color_secundario,
    logo_url,
    fecha_fin,
    docker_compose_content,
    db_name,
    db_user,
    db_password
FROM suscripciones_escuelas 
WHERE slug = '$SCHOOL_SLUG';
" 2>/dev/null | while IFS=$'\t' read -r nombre slug color1 color2 logo fecha_fin docker_compose db_name db_user db_pass; do
    
    echo "   École trouvée: $nombre"
    
    # Générer le fichier .env
    echo "📝 Création du fichier .env..."
    cat > "$DEPLOY_DIR/.env" << ENVEOF
# Configuration pour: $nombre
DOMAIN=$slug.henrimorel.com
EMAIL=henri@henrimorel.com

# Base de données
MYSQL_ROOT_PASSWORD=$(openssl rand -hex 16)
MYSQL_DATABASE=$db_name
MYSQL_USER=$db_user
MYSQL_PASSWORD=$db_pass

# PHP
DB_HOST=mysql_$slug
DB_NAME=$db_name
DB_USER=$db_user
DB_PASS=$db_pass
DB_PORT=3306

# Configuration école
SCHOOL_NAME="$nombre"
SCHOOL_SLUG=$slug
SCHOOL_COLOR_PRIMARY=$color1
SCHOOL_COLOR_SECONDARY=$color2
SCHOOL_LOGO_URL=$logo
TRIAL_END_DATE=$fecha_fin

# Application
APP_ENV=production
APP_DEBUG=false

# Email
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=henri@henrimorel.com
SMTP_PASS=fgufapesjsxreeol
SMTP_ENCRYPTION=tls

# OVH S3
OVH_S3_ENDPOINT=https://s3.gra.io.cloud.ovh.net/
OVH_S3_ACCESS_KEY=18c5bb6059db4da4b32901b1cd1ce69e
OVH_S3_SECRET_KEY=c39ad9ccce324f9d923fb8e899750171
OVH_S3_BUCKET=tan-chu
OVH_S3_REGION=gra
ENVEOF
    
    # Écrire le docker-compose
    echo "📝 Création du docker-compose.yml..."
    echo "$docker_compose" > "$DEPLOY_DIR/docker-compose.yml"
    
    # Créer le script de déploiement
    echo "📝 Création du script de déploiement..."
    cat > "$DEPLOY_DIR/deploy.sh" << DEPLOYEOF
#!/bin/bash
set -e
cd "$DEPLOY_DIR"
echo "🚀 Démarrage de $nombre..."
docker-compose up -d
echo "✅ Déployé! URL: https://$slug.henrimorel.com"
DEPLOYEOF
    chmod +x "$DEPLOY_DIR/deploy.sh"
    
done

# Créer les sous-répertoires nécessaires
echo "📁 Création des sous-répertoires..."
mkdir -p "$DEPLOY_DIR/logs/nginx"
mkdir -p "$DEPLOY_DIR/php/src"
mkdir -p "$DEPLOY_DIR/mysql"
mkdir -p "$DEPLOY_DIR/nginx"

# Copier les fichiers source depuis le projet principal
echo "📂 Copie des fichiers source..."
if [ -d "$PROJECT_DIR/php/src" ]; then
    cp -r "$PROJECT_DIR/php/src"/* "$DEPLOY_DIR/php/src/"
    echo "   ✅ Fichiers PHP copiés"
fi

if [ -d "$PROJECT_DIR/nginx" ]; then
    cp -r "$PROJECT_DIR/nginx"/* "$DEPLOY_DIR/nginx/"
    echo "   ✅ Configuration Nginx copiée"
fi

# Créer le fichier SQL d'initialisation
echo "📝 Création du fichier SQL d'initialisation..."
cat > "$DEPLOY_DIR/mysql/init.sql" << 'SQLEOF'
-- Initialisation de la base de données pour l'école
USE ${MYSQL_DATABASE};

CREATE TABLE IF NOT EXISTS inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idioma_inscripcion VARCHAR(5) DEFAULT 'es',
    alumno_nombres VARCHAR(100) NOT NULL,
    alumno_apellido1 VARCHAR(50) NOT NULL,
    alumno_apellido2 VARCHAR(50),
    alumno_fecha_nacimiento DATE,
    alumno_nacionalidad VARCHAR(50),
    alumno_grado_inscripcion VARCHAR(50),
    alumno_anterior_institucion VARCHAR(150),
    alumno_anterior_ciudad VARCHAR(100),
    alumno_anterior_pais VARCHAR(2),
    acudiente1_nombres VARCHAR(100) NOT NULL,
    acudiente1_apellido1 VARCHAR(50) NOT NULL,
    acudiente1_apellido2 VARCHAR(50),
    acudiente1_direccion VARCHAR(200),
    acudiente1_ciudad VARCHAR(100),
    acudiente1_profesion VARCHAR(100),
    acudiente1_empresa VARCHAR(100),
    acudiente1_pais VARCHAR(2),
    acudiente1_prefijo VARCHAR(5),
    acudiente1_telefono VARCHAR(20),
    acudiente1_email VARCHAR(100),
    acudiente1_parentesco VARCHAR(50),
    acudiente2_nombres VARCHAR(100),
    acudiente2_apellido1 VARCHAR(50),
    acudiente2_apellido2 VARCHAR(50),
    acudiente2_direccion VARCHAR(200),
    acudiente2_ciudad VARCHAR(100),
    acudiente2_profesion VARCHAR(100),
    acudiente2_empresa VARCHAR(100),
    acudiente2_pais VARCHAR(2),
    acudiente2_prefijo VARCHAR(5),
    acudiente2_telefono VARCHAR(20),
    acudiente2_email VARCHAR(100),
    acudiente2_parentesco VARCHAR(50),
    archivo_boletin_1 VARCHAR(500),
    archivo_boletin_2 VARCHAR(500),
    archivo_boletin_3 VARCHAR(500),
    archivo_carta_motivacion VARCHAR(500),
    estado_inscripcion ENUM('pendiente', 'revision', 'aprobada', 'rechazada') DEFAULT 'pendiente',
    observaciones TEXT,
    INDEX idx_fecha (fecha_inscripcion),
    INDEX idx_estado (estado_inscripcion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQLEOF

echo ""
echo "✅ École créée avec succès!"
echo ""
echo "📋 Résumé:"
echo "   Répertoire: $DEPLOY_DIR"
echo "   Fichiers créés:"
ls -la "$DEPLOY_DIR" | grep -E "^-|^d" | awk '{print "     - " $9}'
echo ""
echo "🚀 Pour démarrer l'école:"
echo "   cd $DEPLOY_DIR && docker-compose up -d"
echo ""
echo "🌐 URL: https://$SCHOOL_SLUG.henrimorel.com"
echo ""
