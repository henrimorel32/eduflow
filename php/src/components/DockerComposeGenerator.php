<?php
/**
 * Générateur de fichier docker-compose personnalisé pour chaque école
 */

class DockerComposeGenerator {
    
    /**
     * Génère un docker-compose.yml personnalisé pour une école
     * 
     * @param array $schoolData Données de l'école
     * @return array Contenu du fichier et métadonnées
     */
    public static function generate(array $schoolData): array {
        
        $slug = $schoolData['slug'];
        $dbName = 'edu_' . $slug;
        $dbUser = 'user_' . substr(md5($slug), 0, 8);
        $dbPassword = self::generatePassword();
        
        // Générer un sous-domaine unique
        $subdomain = $slug . '.henrimorel.com';
        
        $dockerCompose = <<<YAML
version: '3.8'

# ============================================================
# Docker Compose généré pour: {$schoolData['nombre_escuela']}
# Date de création: {$schoolData['fecha_inicio']}
# Période d'essai jusqu'au: {$schoolData['fecha_fin']}
# ID École: {$schoolData['id']}
# ============================================================

services:
  # Nginx - Serveur web
  nginx_{$slug}:
    image: nginx:alpine
    container_name: edu_nginx_{$slug}
    restart: unless-stopped
    volumes:
      - ./php/src:/var/www/html:ro
      - ./nginx/nginx.conf:/etc/nginx/nginx.conf:ro
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf:ro
      - ./logs/nginx:/var/log/nginx
    depends_on:
      - php_{$slug}
    networks:
      - edu_network_{$slug}
      - proxy
    labels:
      - "traefik.enable=true"
      - "traefik.docker.network=proxy"
      - "traefik.http.routers.edu-{$slug}.rule=Host(`{$subdomain}`)"
      - "traefik.http.routers.edu-{$slug}.entrypoints=web"
      - "traefik.http.routers.edu-{$slug}.middlewares=edu-{$slug}-redirect"
      - "traefik.http.routers.edu-{$slug}-secure.rule=Host(`{$subdomain}`)"
      - "traefik.http.routers.edu-{$slug}-secure.entrypoints=websecure"
      - "traefik.http.routers.edu-{$slug}-secure.tls=true"
      - "traefik.http.routers.edu-{$slug}-secure.tls.certresolver=letsencrypt"
      - "traefik.http.middlewares.edu-{$slug}-redirect.redirectscheme.scheme=https"
      - "traefik.http.services.edu-{$slug}.loadbalancer.server.port=80"

  # PHP-FPM
  php_{$slug}:
    build:
      context: ./php
      dockerfile: Dockerfile
    container_name: edu_php_{$slug}
    restart: unless-stopped
    volumes:
      - ./php/src:/var/www/html
    env_file:
      - .env
    environment:
      - DB_HOST=mysql_{$slug}
      - DB_PORT=3306
      - DB_NAME={$dbName}
      - DB_USER={$dbUser}
      - DB_PASS={$dbPassword}
      # Configuration personnalisée de l'école
      - SCHOOL_NAME={$schoolData['nombre_escuela']}
      - SCHOOL_COLOR_PRIMARY={$schoolData['color_primario']}
      - SCHOOL_COLOR_SECONDARY={$schoolData['color_secundario']}
      - SCHOOL_LOGO_URL={$schoolData['logo_url']}
      - SCHOOL_SLUG={$slug}
      - TRIAL_END_DATE={$schoolData['fecha_fin']}
    depends_on:
      - mysql_{$slug}
    networks:
      - edu_network_{$slug}

  # MySQL - Base de données dédiée
  mysql_{$slug}:
    image: mysql:8.0
    container_name: edu_mysql_{$slug}
    restart: unless-stopped
    environment:
      - MYSQL_ROOT_PASSWORD={$schoolData['db_root_password']}
      - MYSQL_DATABASE={$dbName}
      - MYSQL_USER={$dbUser}
      - MYSQL_PASSWORD={$dbPassword}
    volumes:
      - mysql_data_{$slug}:/var/lib/mysql
      - ./mysql/init_school.sql:/docker-entrypoint-initdb.d/init.sql:ro
    networks:
      - edu_network_{$slug}

  # phpMyAdmin (optionnel - localhost uniquement)
  phpmyadmin_{$slug}:
    image: phpmyadmin/phpmyadmin
    container_name: edu_phpmyadmin_{$slug}
    restart: unless-stopped
    environment:
      PMA_HOST: mysql_{$slug}
      PMA_PORT: 3306
    ports:
      - "127.0.0.1:{$schoolData['phpmyadmin_port']}:80"
    depends_on:
      - mysql_{$slug}
    networks:
      - edu_network_{$slug}

volumes:
  mysql_data_{$slug}:

networks:
  edu_network_{$slug}:
    driver: bridge
  proxy:
    external: true
YAML;

        return [
            'content' => $dockerCompose,
            'db_name' => $dbName,
            'db_user' => $dbUser,
            'db_password' => $dbPassword,
            'subdomain' => $subdomain,
            'path' => '/var/schools/' . $slug . '/docker-compose.yml'
        ];
    }
    
    /**
     * Génère le fichier .env pour l'école
     */
    public static function generateEnv(array $schoolData, array $dbInfo): string {
        
        return <<<ENV
# ============================================================
# Configuration pour: {$schoolData['nombre_escuela']}
# ============================================================

# Domaine
DOMAIN={$dbInfo['subdomain']}
EMAIL={$schoolData['email']}

# Base de données
MYSQL_ROOT_PASSWORD={$schoolData['db_root_password']}
MYSQL_DATABASE={$dbInfo['db_name']}
MYSQL_USER={$dbInfo['db_user']}
MYSQL_PASSWORD={$dbInfo['db_password']}

# PHP / Application
DB_HOST=mysql_{$schoolData['slug']}
DB_NAME={$dbInfo['db_name']}
DB_USER={$dbInfo['db_user']}
DB_PASS={$dbInfo['db_password']}
DB_PORT=3306

# Configuration école
SCHOOL_NAME="{$schoolData['nombre_escuela']}"
SCHOOL_SLUG={$schoolData['slug']}
SCHOOL_COLOR_PRIMARY={$schoolData['color_primario']}
SCHOOL_COLOR_SECONDARY={$schoolData['color_secundario']}
SCHOOL_LOGO_URL={$schoolData['logo_url']}

# Période d'essai
TRIAL_START_DATE={$schoolData['fecha_inicio']}
TRIAL_END_DATE={$schoolData['fecha_fin']}

# Application
APP_ENV=production
APP_DEBUG=false

# Email (SMTP Gmail)
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=henri@henrimorel.com
SMTP_PASS=xxxxxxxxxxxxxxxx
SMTP_ENCRYPTION=tls

# OVH Object Storage
OVH_S3_ENDPOINT=https://s3.gra.io.cloud.ovh.net/
OVH_S3_ACCESS_KEY=xxx
OVH_S3_SECRET_KEY=xxx
OVH_S3_BUCKET=tan-chu
OVH_S3_REGION=gra
ENV;
    }
    
    /**
     * Génère le script de déploiement pour l'école
     */
    public static function generateDeployScript(array $schoolData, array $dbInfo): string {
        
        return <<<SCRIPT
#!/bin/bash
# ============================================================
# Script de déploiement pour: {$schoolData['nombre_escuela']}
# ============================================================

set -e

SCHOOL_SLUG="{$schoolData['slug']}"
SCHOOL_NAME="{$schoolData['nombre_escuela']}"
DEPLOY_DIR="/var/schools/\$SCHOOL_SLUG"

echo "🚀 Déploiement de \$SCHOOL_NAME..."

# Créer le répertoire
mkdir -p \$DEPLOY_DIR
cd \$DEPLOY_DIR

# Copier les fichiers nécessaires
echo "📁 Configuration des fichiers..."

# Le docker-compose sera généré et copié ici
# docker-compose up -d

echo "✅ Déploiement terminé!"
echo "🌐 URL: https://{$dbInfo['subdomain']}"
echo "📅 Fin d'essai: {$schoolData['fecha_fin']}"
SCRIPT;
    }
    
    /**
     * Génère un mot de passe aléatoire sécurisé
     */
    private static function generatePassword(int $length = 20): string {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $password;
    }
}
