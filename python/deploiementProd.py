#!/bin/bash

# =============================================================================
# Script de Déploiement Production - EduFlow Platform
# Auteur: EduFlow Team
# Description: Déploiement automatisé avec Docker, Nginx et Certbot (HTTPS)
# =============================================================================

set -e  # Arrêt immédiat en cas d'erreur

# Couleurs pour les logs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Variables configurables (à modifier selon votre environnement)
DOMAIN=${DOMAIN:-"henrimorel.com"}                    # Votre domaine principal
WWW_DOMAIN=${WWW_DOMAIN:-"www.eduflow.co"}        # Sous-domaine www
EMAIL=${EMAIL:-"henri@henrimorel.com"}                # Email pour Certbot
APP_DIR=${APP_DIR:-"/opt/eduflow"}                # Répertoire d'installation
DB_ROOT_PASSWORD=${DB_ROOT_PASSWORD:-$(openssl rand -base64 32)}
DB_PASSWORD=${DB_PASSWORD:-$(openssl rand -base64 32)}

# Fonctions de logging
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# =============================================================================
# 1. VÉRIFICATIONS PRÉALABLES
# =============================================================================

check_prerequisites() {
    log_info "Vérification des prérequis..."
    
    # Vérifier si exécuté en root
    if [[ $EUID -ne 0 ]]; then
       log_error "Ce script doit être exécuté en root (sudo)"
       exit 1
    fi
    
    # Vérifier la connexion Internet
    if ! ping -c 1 google.com &> /dev/null; then
        log_error "Pas de connexion Internet"
        exit 1
    fi
    
    # Vérifier les ports disponibles
    for port in 80 443 3306 8080; do
        if netstat -tuln | grep -q ":$port "; then
            log_warning "Le port $port est déjà utilisé"
        fi
    done
    
    log_success "Prérequis validés"
}

# =============================================================================
# 2. INSTALLATION DES DÉPENDANCES SYSTÈME
# =============================================================================

install_dependencies() {
    log_info "Installation des dépendances système..."
    
    apt-get update
    apt-get install -y \
        apt-transport-https \
        ca-certificates \
        curl \
        gnupg \
        lsb-release \
        software-properties-common \
        git \
        ufw \
        net-tools \
        openssl
    
    # Installation de Docker si non présent
    if ! command -v docker &> /dev/null; then
        log_info "Installation de Docker..."
        curl -fsSL https://get.docker.com -o get-docker.sh
        sh get-docker.sh
        usermod -aG docker $SUDO_USER || true
        systemctl enable docker
        systemctl start docker
        rm get-docker.sh
    else
        log_info "Docker déjà installé"
    fi
    
    # Installation de Docker Compose
    if ! command -v docker-compose &> /dev/null; then
        log_info "Installation de Docker Compose..."
        COMPOSE_VERSION=$(curl -s https://api.github.com/repos/docker/compose/releases/latest | grep 'tag_name' | cut -d -f4)
        curl -L "https://github.com/docker/compose/releases/download/${COMPOSE_VERSION}/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
        chmod +x /usr/local/bin/docker-compose
    else
        log_info "Docker Compose déjà installé"
    fi
    
    log_success "Dépendances installées"
}

# =============================================================================
# 3. CONFIGURATION DU FIREWALL
# =============================================================================

configure_firewall() {
    log_info "Configuration du pare-feu (UFW)..."
    
    ufw default deny incoming
    ufw default allow outgoing
    
    # Ports essentiels
    ufw allow 22/tcp    # SSH
    ufw allow 80/tcp    # HTTP
    ufw allow 443/tcp   # HTTPS
    
    # Ports optionnels (commenter en production si non nécessaire)
    # ufw allow 8080/tcp  # phpMyAdmin (restreindre par IP en prod)
    # ufw allow 3306/tcp  # MySQL (ne pas exposer publiquement)
    
    ufw --force enable
    
    log_success "Pare-feu configuré"
    ufw status
}

# =============================================================================
# 4. PRÉPARATION DU RÉPERTOIRE D'APPLICATION
# =============================================================================

prepare_app_directory() {
    log_info "Préparation du répertoire d'application: $APP_DIR"
    
    mkdir -p $APP_DIR
    cd $APP_DIR
    
    # Création de la structure
    mkdir -p {php/src,nginx,mysql,certbot/conf,certbot/www,logs}
    mkdir -p php/src/{includes,assets/{css,js,images}}
    
    # Définir les permissions
    chown -R $SUDO_USER:$SUDO_USER $APP_DIR
    
    log_success "Répertoire préparé"
}

# =============================================================================
# 5. GÉNÉRATION DES FICHIERS DE CONFIGURATION
# =============================================================================

generate_configs() {
    log_info "Génération des fichiers de configuration..."
    
    cd $APP_DIR
    
    # Fichier .env pour les variables sensibles
    cat > .env << EOF
# ============================================
# Configuration Production - EduFlow
# ============================================

# Domaines
DOMAIN=$DOMAIN
WWW_DOMAIN=$WWW_DOMAIN
EMAIL=$EMAIL

# Base de données (générées automatiquement)
MYSQL_ROOT_PASSWORD=$DB_ROOT_PASSWORD
MYSQL_DATABASE=edu_platform
MYSQL_USER=edu_user
MYSQL_PASSWORD=$DB_PASSWORD
DB_HOST=mysql
DB_NAME=edu_platform
DB_USER=edu_user
DB_PASS=$DB_PASSWORD

# Sécurité
APP_ENV=production
APP_DEBUG=false
EOF
    
    chmod 600 .env
    
    log_success "Fichier .env créé"
}

# =============================================================================
# 6. DOCKER COMPOSE PRODUCTION
# =============================================================================

generate_docker_compose() {
    log_info "Génération de docker-compose.yml production..."
    
    cd $APP_DIR
    
    cat > docker-compose.yml << 'EOF'
version: '3.8'

services:
  # Nginx avec Certbot
  nginx:
    image: nginx:alpine
    container_name: eduflow_nginx
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./php/src:/var/www/html:ro
      - ./nginx/nginx.conf:/etc/nginx/nginx.conf:ro
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf:ro
      - ./certbot/conf:/etc/letsencrypt:ro
      - ./certbot/www:/var/www/certbot:ro
      - ./logs/nginx:/var/log/nginx
    depends_on:
      - php
    networks:
      - eduflow_network
    command: "/bin/sh -c 'while :; do sleep 6h & wait $${!}; nginx -s reload; done & nginx -g "daemon off;"'"

  # Certbot pour SSL
  certbot:
    image: certbot/certbot
    container_name: eduflow_certbot
    restart: unless-stopped
    volumes:
      - ./certbot/conf:/etc/letsencrypt
      - ./certbot/www:/var/www/certbot
    entrypoint: "/bin/sh -c 'trap exit TERM; while :; do certbot renew; sleep 12h & wait $${!}; done;'"
    networks:
      - eduflow_network

  # PHP-FPM
  php:
    build:
      context: ./php
      dockerfile: Dockerfile
    container_name: eduflow_php
    restart: unless-stopped
    volumes:
      - ./php/src:/var/www/html
    env_file:
      - .env
    depends_on:
      - mysql
    networks:
      - eduflow_network

  # MySQL
  mysql:
    image: mysql:8.0
    container_name: eduflow_mysql
    restart: unless-stopped
    env_file:
      - .env
    volumes:
      - mysql_data:/var/lib/mysql
      - ./mysql/init.sql:/docker-entrypoint-initdb.d/init.sql:ro
      - ./logs/mysql:/var/log/mysql
    networks:
      - eduflow_network
    command: --default-authentication-plugin=mysql_native_password

  # phpMyAdmin (restreint à localhost par défaut)
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: eduflow_phpmyadmin
    restart: unless-stopped
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
    ports:
      - "127.0.0.1:8080:80"  # Accessible uniquement via SSH tunnel
    depends_on:
      - mysql
    networks:
      - eduflow_network

volumes:
  mysql_data:

networks:
  eduflow_network:
    driver: bridge
EOF

    log_success "docker-compose.yml créé"
}

# =============================================================================
# 7. CONFIGURATION NGINX AVEC SSL
# =============================================================================

generate_nginx_config() {
    log_info "Génération de la configuration Nginx..."
    
    cd $APP_DIR
    
    # nginx.conf principal
    cat > nginx/nginx.conf << 'EOF'
user nginx;
worker_processes auto;
error_log /var/log/nginx/error.log warn;
pid /var/run/nginx.pid;

events {
    worker_connections 1024;
}

http {
    include /etc/nginx/mime.types;
    default_type application/octet-stream;
    
    # Logging format
    log_format main '$remote_addr - $remote_user [$time_local] "$request" '
                    '$status $body_bytes_sent "$http_referer" '
                    '"$http_user_agent" "$http_x_forwarded_for"';

    access_log /var/log/nginx/access.log main;

    # Performance
    sendfile on;
    tcp_nopush on;
    tcp_nodelay on;
    keepalive_timeout 65;
    types_hash_max_size 2048;
    
    # Compression
    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml application/json application/javascript \
               application/rss+xml application/atom+xml image/svg+xml;

    include /etc/nginx/conf.d/*.conf;
}
EOF

    # Configuration du site (HTTP initial pour Certbot)
    cat > nginx/default.conf << EOF
# Configuration initiale pour Certbot challenge
server {
    listen 80;
    listen [::]:80;
    server_name $DOMAIN $WWW_DOMAIN;
    
    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }
    
    location / {
        return 301 https://\$host\$request_uri;
    }
}

# Configuration HTTPS (sera activée après obtention du certificat)
# server {
#     listen 443 ssl http2;
#     listen [::]:443 ssl http2;
#     server_name $DOMAIN $WWW_DOMAIN;
#     
#     ssl_certificate /etc/letsencrypt/live/$DOMAIN/fullchain.pem;
#     ssl_certificate_key /etc/letsencrypt/live/$DOMAIN/privkey.pem;
#     include /etc/letsencrypt/options-ssl-nginx.conf;
#     ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;
#     
#     root /var/www/html;
#     index index.php index.html;
#     
#     location / {
#         try_files \$uri \$uri/ /index.php?\$query_string;
#     }
#     
#     location ~ \.php$ {
#         fastcgi_pass php:9000;
#         fastcgi_index index.php;
#         fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
#         include fastcgi_params;
#     }
#     
#     location ~ /\.(?!well-known).* {
#         deny all;
#     }
# }
EOF

    log_success "Configuration Nginx créée"
}

# =============================================================================
# 8. DOCKERFILE PHP OPTIMISÉ
# =============================================================================

generate_php_dockerfile() {
    log_info "Génération du Dockerfile PHP..."
    
    cd $APP_DIR
    
    cat > php/Dockerfile << 'EOF'
FROM php:8.2-fpm-alpine

# Extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql opcache

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration PHP Production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Optimisations OPcache pour production
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Sécurité : créer un utilisateur non-root
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

WORKDIR /var/www/html

# Permissions
RUN chown -R www:www /var/www/html

USER www
EOF

    log_success "Dockerfile PHP créé"
}

# =============================================================================
# 9. OBTENTION DU CERTIFICAT SSL (CERTBOT)
# =============================================================================

setup_ssl() {
    log_info "Configuration du certificat SSL avec Certbot..."
    
    cd $APP_DIR
    
    # Démarrer temporairement Nginx pour le challenge HTTP
    docker-compose up -d nginx
    
    # Attendre que Nginx soit prêt
    sleep 5
    
    # Vérifier que le domaine pointe vers ce serveur
    SERVER_IP=$(curl -s ifconfig.me)
    DOMAIN_IP=$(dig +short $DOMAIN | tail -n1)
    
    if [ "$SERVER_IP" != "$DOMAIN_IP" ]; then
        log_warning "Le domaine $DOMAIN ne pointe pas vers ce serveur ($SERVER_IP vs $DOMAIN_IP)"
        log_warning "Mettez à jour votre DNS et relancez le script"
        log_info "Continuons avec une configuration temporaire..."
    fi
    
    # Obtenir le certificat
    docker-compose run --rm certbot certonly \
        --webroot \
        --webroot-path=/var/www/certbot \
        --email $EMAIL \
        --agree-tos \
        --no-eff-email \
        -d $DOMAIN \
        -d $WWW_DOMAIN || {
        log_error "Échec de l'obtention du certificat"
        log_info "Vérifiez que le domaine pointe bien vers ce serveur"
        return 1
    }
    
    log_success "Certificat SSL obtenu"
    
    # Mettre à jour la configuration Nginx pour HTTPS
    generate_nginx_ssl_config
    
    # Recharger Nginx
    docker-compose exec nginx nginx -s reload
}

generate_nginx_ssl_config() {
    log_info "Activation de la configuration HTTPS..."
    
    cd $APP_DIR
    
    cat > nginx/default.conf << EOF
# Redirection HTTP vers HTTPS
server {
    listen 80;
    listen [::]:80;
    server_name $DOMAIN $WWW_DOMAIN;
    
    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }
    
    location / {
        return 301 https://\$host\$request_uri;
    }
}

# Configuration HTTPS
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name $DOMAIN $WWW_DOMAIN;
    
    # Certificats SSL
    ssl_certificate /etc/letsencrypt/live/$DOMAIN/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/$DOMAIN/privkey.pem;
    
    # Configuration SSL optimisée
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_prefer_server_ciphers off;
    ssl_ciphers ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384;
    ssl_session_timeout 1d;
    ssl_session_cache shared:SSL:50m;
    ssl_stapling on;
    ssl_stapling_verify on;
    
    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
    
    root /var/www/html;
    index index.php index.html;
    
    # Logs
    access_log /var/log/nginx/access.log main;
    error_log /var/log/nginx/error.log;
    
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }
    
    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }
    
    # Cache static files
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
}
EOF

    log_success "Configuration HTTPS activée"
}

# =============================================================================
# 10. DÉPLOIEMENT DE L'APPLICATION
# =============================================================================

deploy_application() {
    log_info "Déploiement de l'application..."
    
    cd $APP_DIR
    
    # Construction et démarrage des conteneurs
    docker-compose down 2>/dev/null || true
    docker-compose build --no-cache
    docker-compose up -d
    
    # Attendre que MySQL soit prêt
    log_info "Attente de l'initialisation de MySQL (30s)..."
    sleep 30
    
    # Vérifier l'état des conteneurs
    if docker-compose ps | grep -q "Up"; then
        log_success "Application déployée avec succès"
    else
        log_error "Problème lors du démarrage des conteneurs"
        docker-compose logs
        exit 1
    fi
}

# =============================================================================
# 11. CRÉATION DU SCRIPT DE SAUVEGARDE
# =============================================================================

create_backup_script() {
    log_info "Création du script de sauvegarde..."
    
    cat > $APP_DIR/backup.sh << 'EOF'
#!/bin/bash
# Script de sauvegarde quotidienne

BACKUP_DIR="/opt/backups/eduflow"
DATE=$(date +%Y%m%d_%H%M%S)
RETENTION_DAYS=7

mkdir -p $BACKUP_DIR

# Sauvegarde de la base de données
docker exec eduflow_mysql mysqldump -u edu_user -p${DB_PASSWORD} edu_platform > $BACKUP_DIR/db_$DATE.sql

# Sauvegarde des fichiers
tar -czf $BACKUP_DIR/files_$DATE.tar.gz -C /opt/eduflow php/src

# Suppression des anciennes sauvegardes
find $BACKUP_DIR -name "*.sql" -mtime +$RETENTION_DAYS -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +$RETENTION_DAYS -delete

echo "Sauvegarde terminée: $DATE"
EOF

    chmod +x $APP_DIR/backup.sh
    
    # Créer une tâche cron pour les sauvegardes quotidiennes
    (crontab -l 2>/dev/null; echo "0 2 * * * $APP_DIR/backup.sh >> /var/log/eduflow-backup.log 2>&1") | crontab -
    
    log_success "Script de sauvegarde créé (exécution quotidienne à 2h00)"
}

# =============================================================================
# 12. CRÉATION DU SCRIPT DE MISE À JOUR
# =============================================================================

create_update_script() {
    log_info "Création du script de mise à jour..."
    
    cat > $APP_DIR/update.sh << 'EOF'
#!/bin/bash
# Script de mise à jour de l'application

cd /opt/eduflow

echo "Arrêt des services..."
docker-compose down

echo "Pull des dernières images..."
docker-compose pull

echo "Rebuild des images..."
docker-compose build --no-cache

echo "Démarrage des services..."
docker-compose up -d

echo "Nettoyage des images obsolètes..."
docker image prune -f

echo "Mise à jour terminée!"
EOF

    chmod +x $APP_DIR/update.sh
    log_success "Script de mise à jour créé"
}

# =============================================================================
# 13. AFFICHAGE DU RÉCAPITULATIF
# =============================================================================

show_summary() {
    echo ""
    echo "================================================================"
    echo "           DÉPLOIEMENT TERMINÉ AVEC SUCCÈS! 🎉"
    echo "================================================================"
    echo ""
    echo -e "${GREEN}URLs d'accès:${NC}"
    echo "  • Site Web:        https://$DOMAIN"
    echo "  • phpMyAdmin:      http://localhost:8080 (via SSH tunnel)"
    echo ""
    echo -e "${GREEN}Informations de connexion:${NC}"
    echo "  • Répertoire:      $APP_DIR"
    echo "  • Base de données: edu_platform"
    echo "  • DB User:         edu_user"
    echo "  • DB Password:     $DB_PASSWORD"
    echo ""
    echo -e "${YELLOW}Commandes utiles:${NC}"
    echo "  cd $APP_DIR"
    echo "  docker-compose ps          # Voir l'état des services"
    echo "  docker-compose logs -f     # Voir les logs en temps réel"
    echo "  ./backup.sh                # Lancer une sauvegarde manuelle"
    echo "  ./update.sh                # Mettre à jour l'application"
    echo ""
    echo -e "${YELLOW}Sauvegardes:${NC}"
    echo "  • Automatique:     Tous les jours à 2h00"
    echo "  • Emplacement:     /opt/backups/eduflow/"
    echo ""
    echo "================================================================"
    echo "Important: Conservez ces informations dans un endroit sûr!"
    echo "================================================================"
    echo ""
}

# =============================================================================
# EXÉCUTION PRINCIPALE
# =============================================================================

main() {
    echo ""
    echo "================================================================"
    echo "      DEPLOYMENT EDUFLOW - PRODUCTION SERVER SETUP"
    echo "================================================================"
    echo ""
    
    # Demander les informations si non fournies
    if [ -z "$DOMAIN" ] || [ "$DOMAIN" = "eduflow.co" ]; then
        read -p "Entrez votre domaine (ex: eduflow.co): " DOMAIN
        read -p "Entrez votre email (pour Certbot): " EMAIL
    fi
    
    # Exécution des étapes
    check_prerequisites
    install_dependencies
    configure_firewall
    prepare_app_directory
    generate_configs
    generate_docker_compose
    generate_nginx_config
    generate_php_dockerfile
    deploy_application
    setup_ssl
    create_backup_script
    create_update_script
    show_summary
}

# Gestion des erreurs
trap 'log_error "Une erreur s\'est produite. Déploiement annulé."' ERR

# Lancement
main "$@"
