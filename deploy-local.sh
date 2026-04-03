#!/bin/bash

# =============================================================================
# Script de Déploiement LOCAL → VPS
# Auteur: EduFlow Team
# Description: Déploie depuis votre machine locale vers un VPS distant
# Usage: ./deploy-local.sh [user@hostname]
# =============================================================================

set -e

# Configuration
VPS_USER="ubuntu"                    # Utilisateur SSH (passer en paramètre ou défaut root)
VPS_HOST="51.178.136.181"           # Hostname ou IP du VPS
VPS_DIR="/opt/eduflow"                   # Répertoire distant
LOCAL_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"  # Répertoire local du projet

# Couleurs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

log_info() { echo -e "${BLUE}[INFO]${NC} $1"; }
log_success() { echo -e "${GREEN}[SUCCESS]${NC} $1"; }
log_warning() { echo -e "${YELLOW}[WARNING]${NC} $1"; }
log_error() { echo -e "${RED}[ERROR]${NC} $1"; }

# =============================================================================
# 1. VÉRIFICATIONS LOCALES
# =============================================================================

check_local() {
    log_info "Vérification de l'environnement local..."
    
    # Vérifier que nous sommes bien en local (pas sur le VPS)
    if hostname -I 2>/dev/null | grep -q "$VPS_HOST"; then
        log_error "Vous semblez être sur le VPS. Ce script doit être exécuté en LOCAL."
        exit 1
    fi
    
    # Vérifier les outils nécessaires
    for cmd in rsync ssh scp; do
        if ! command -v $cmd &> /dev/null; then
            log_error "$cmd est requis. Installez-le : sudo apt install $cmd"
            exit 1
        fi
    done
    
    # Vérifier que les fichiers sources existent
    if [ ! -f "$LOCAL_DIR/docker-compose.yml" ]; then
        log_error "Fichier docker-compose.yml non trouvé dans $LOCAL_DIR"
        log_info "Assurez-vous d'être dans le répertoire du projet"
        exit 1
    fi
    
    # Vérifier la connexion SSH
    log_info "Test de connexion SSH vers $VPS_USER@$VPS_HOST..."
    if ! ssh -o ConnectTimeout=5 -o StrictHostKeyChecking=no "$VPS_USER@$VPS_HOST" "echo 'OK'" &>/dev/null; then
        log_error "Impossible de se connecter en SSH à $VPS_USER@$VPS_HOST"
        log_info "Vérifiez :"
        log_info "  1. Que le VPS est accessible"
        log_info "  2. Votre clé SSH est configurée (ssh-copy-id)"
        log_info "  3. L'utilisateur et l'hôte sont corrects"
        exit 1
    fi
    
    log_success "Environnement local OK"
}

# =============================================================================
# 2. PRÉPARATION DU VPS (INSTALLATION DOCKER)
# =============================================================================

setup_vps() {
    log_info "Configuration initiale du VPS..."
    
    ssh "$VPS_USER@$VPS_HOST" << 'REMOTE_SCRIPT'
        # Installer Docker si pas présent
        if ! command -v docker &> /dev/null; then
            echo "Installation de Docker..."
            curl -fsSL https://get.docker.com | sh
            usermod -aG docker $USER || true
            systemctl enable docker
            systemctl start docker
        fi
        
        # Installer Docker Compose si pas présent
        if ! command -v docker-compose &> /dev/null; then
            echo "Installation de Docker Compose..."
            COMPOSE_VERSION=$(curl -s https://api.github.com/repos/docker/compose/releases/latest | grep 'tag_name' | cut -d'"' -f4)
            curl -L "https://github.com/docker/compose/releases/download/${COMPOSE_VERSION}/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
            chmod +x /usr/local/bin/docker-compose
        fi
        
        # Créer le répertoire de l'application
        mkdir -p /opt/eduflow
        
        # Installer Certbot si pas présent
        if ! command -v certbot &> /dev/null; then
            echo "Installation de Certbot..."
            sudo apt-get update
            sudo apt-get install -y certbot
        fi
REMOTE_SCRIPT
    
    log_success "VPS configuré"
}

# =============================================================================
# 3. COPIE DES SOURCES
# =============================================================================

deploy_sources() {
    log_info "Copie des fichiers sources vers le VPS..."
    
    # Créer le répertoire sur le VPS
    ssh "$VPS_USER@$VPS_HOST" "mkdir -p $VPS_DIR"
    
    # Rsync avec exclusions
    log_info "Synchronisation des fichiers..."
    rsync -avz --progress         --exclude='.git'         --exclude='.env'         --exclude='node_modules'         --exclude='vendor'         --exclude='*.log'         --exclude='.DS_Store'         --exclude='Thumbs.db'         "$LOCAL_DIR/"         "$VPS_USER@$VPS_HOST:$VPS_DIR/"
    
    # Copier le .env.example comme template (l'utilisateur devra le configurer)
    if [ -f "$LOCAL_DIR/.env" ]; then
        log_warning "Fichier .env local trouvé"
        read -p "Voulez-vous copier le .env local vers le VPS? (y/N): " copy_env
        if [[ $copy_env =~ ^[Yy]$ ]]; then
            scp "$LOCAL_DIR/.env" "$VPS_USER@$VPS_HOST:$VPS_DIR/.env"
            ssh "$VPS_USER@$VPS_HOST" "chmod 600 $VPS_DIR/.env"
            log_success ".env copié sur le VPS"
        else
            log_info "Création d'un .env par défaut sur le VPS..."
            create_remote_env
        fi
    else
        log_warning "Pas de .env local, création sur le VPS..."
        create_remote_env
    fi
    
    log_success "Sources déployées sur $VPS_HOST"
}

# =============================================================================
# 4. CRÉATION DU .ENV SUR LE VPS
# =============================================================================

create_remote_env() {
    log_info "Configuration des variables d'environnement sur le VPS..."
    
    # Demander les informations
    read -p "Domaine principal (ex: eduflow.co): " domain
    read -p "Email pour Certbot: " email
    
    # Générer des mots de passe sécurisés
    db_root_pass=$(openssl rand -base64 32)
    db_pass=$(openssl rand -base64 32)
    
    # Créer le .env sur le VPS
    ssh "$VPS_USER@$VPS_HOST" << EOF
        cat > $VPS_DIR/.env << 'ENVFILE'
# Configuration Production - EduFlow
DOMAIN=$domain
WWW_DOMAIN=www.$domain
EMAIL=$email

# Base de données
MYSQL_ROOT_PASSWORD=$db_root_pass
MYSQL_DATABASE=edu_platform
MYSQL_USER=edu_user
MYSQL_PASSWORD=$db_pass
DB_HOST=mysql
DB_NAME=edu_platform
DB_USER=edu_user
DB_PASS=$db_pass
DB_PORT=3306

# Application
APP_ENV=production
APP_DEBUG=false
ENVFILE
        chmod 600 $VPS_DIR/.env
EOF
    
    log_success ".env créé sur le VPS avec mots de passe sécurisés"
    log_warning "Conservez ces informations :"
    echo "  Domaine: $domain"
    echo "  DB User: edu_user"
    echo "  DB Pass: $db_pass"
}

# =============================================================================
# 5. VÉRIFICATION/CERTIFICAT SSL
# =============================================================================

setup_ssl() {
    log_info "Vérification du certificat SSL..."
    
    # Vérifier si le certificat existe déjà
    cert_exists=$(ssh "$VPS_USER@$VPS_HOST" "test -f /etc/letsencrypt/live/\$(head -1 $VPS_DIR/.env | grep DOMAIN | cut -d'=' -f2)/fullchain.pem && echo 'YES' || echo 'NO'")
    
    if [ "$cert_exists" == "YES" ]; then
        log_success "Certificat SSL existant trouvé"
        read -p "Voulez-vous renouveler/tester le certificat? (y/N): " renew
        if [[ $renew =~ ^[Yy]$ ]]; then
            renew_ssl
        fi
    else
        log_warning "Aucun certificat SSL trouvé"
        read -p "Voulez-vous créer un certificat SSL? (Y/n): " create
        if [[ ! $create =~ ^[Nn]$ ]]; then
            create_ssl
        fi
    fi
}

create_ssl() {
    log_info "Création du certificat SSL avec Certbot..."
    
    # Récupérer le domaine depuis le .env distant
    domain=$(ssh "$VPS_USER@$VPS_HOST" "grep DOMAIN $VPS_DIR/.env | head -1 | cut -d'=' -f2")
    email=$(ssh "$VPS_USER@$VPS_HOST" "grep EMAIL $VPS_DIR/.env | head -1 | cut -d'=' -f2")
    
    # Arrêter Nginx s'il tourne (pour libérer le port 80)
    ssh "$VPS_USER@$VPS_HOST" "cd $VPS_DIR && docker-compose stop nginx 2>/dev/null || true"
    
    # Créer le certificat avec Certbot standalone
    ssh "$VPS_USER@$VPS_HOST" << EOF
        certbot certonly --standalone \
            --agree-tos \
            --non-interactive \
            --email $email \
            -d $domain \
            -d www.$domain \
            || echo "Certbot a échoué, vérifiez le DNS"
EOF
    
    # Créer les répertoires pour les certificats dans le projet
    ssh "$VPS_USER@$VPS_HOST" << EOF
        mkdir -p $VPS_DIR/certbot/conf/live/$domain
        mkdir -p $VPS_DIR/certbot/www
        
        # Copier les certificats vers le répertoire du projet (pour Docker)
        if [ -f /etc/letsencrypt/live/$domain/fullchain.pem ]; then
            cp /etc/letsencrypt/live/$domain/fullchain.pem $VPS_DIR/certbot/conf/live/$domain/
            cp /etc/letsencrypt/live/$domain/privkey.pem $VPS_DIR/certbot/conf/live/$domain/
            echo "Certificats copiés"
        fi
EOF
    
    log_success "Certificat SSL configuré"
}

renew_ssl() {
    log_info "Renouvellement du certificat SSL..."
    
    ssh "$VPS_USER@$VPS_HOST" "certbot renew --quiet"
    
    # Redémarrer Nginx pour prendre en compte le nouveau certificat
    ssh "$VPS_USER@$VPS_HOST" "cd $VPS_DIR && docker-compose restart nginx 2>/dev/null || true"
    
    log_success "Certificat renouvelé"
}

# =============================================================================
# 6. DÉMARRAGE DES CONTAINERS
# =============================================================================

start_containers() {
    log_info "Démarrage des containers Docker sur le VPS..."
    
    ssh "$VPS_USER@$VPS_HOST" << EOF
        cd $VPS_DIR
        
        # Pull des images récentes
        docker-compose pull
        
        # Build si nécessaire
        docker-compose build --no-cache
        
        # Démarrage
        docker-compose down 2>/dev/null || true
        docker-compose up -d
        
        # Attendre que tout soit prêt
        sleep 10
        
        # Vérifier l'état
        docker-compose ps
EOF
    
    log_success "Containers démarrés"
}

# =============================================================================
# 7. VÉRIFICATION FINALE
# =============================================================================

check_deployment() {
    log_info "Vérification du déploiement..."
    
    domain=$(ssh "$VPS_USER@$VPS_HOST" "grep DOMAIN $VPS_DIR/.env | head -1 | cut -d'=' -f2")
    
    # Test HTTP
    http_status=$(curl -s -o /dev/null -w "%{http_code}" "http://$domain" || echo "000")
    
    # Test HTTPS
    https_status=$(curl -s -o /dev/null -w "%{http_code}" "https://$domain" || echo "000")
    
    echo ""
    echo "=========================================="
    echo "RÉSULTATS DU DÉPLOIEMENT"
    echo "=========================================="
    echo "Domaine: $domain"
    echo "HTTP:    $http_status $(if [ "$http_status" == "200" ] || [ "$http_status" == "301" ]; then echo "(OK)"; else echo "(ERREUR)"; fi)"
    echo "HTTPS:   $https_status $(if [ "$https_status" == "200" ]; then echo "(OK)"; else echo "(ERREUR)"; fi)"
    echo "=========================================="
    
    if [ "$https_status" == "200" ]; then
        log_success "Déploiement réussi! https://$domain"
    else
        log_warning "Le site répond mais HTTPS peut nécessiter un redémarrage"
        log_info "Commande pour redémarrer : ssh $VPS_USER@$VPS_HOST 'cd $VPS_DIR && docker-compose restart'"
    fi
}

# =============================================================================
# 8. SYNCHRONISATION RAPIDE (pour les mises à jour)
# =============================================================================

quick_sync() {
    log_info "Synchronisation rapide (sans reconfiguration)..."
    
    # Rsync rapide
    rsync -avz --progress         --exclude='.git'         --exclude='.env'         --exclude='certbot'         --exclude='mysql_data'         --exclude='logs'         "$LOCAL_DIR/"         "$VPS_USER@$VPS_HOST:$VPS_DIR/"
    
    # Redémarrage rapide
    ssh "$VPS_USER@$VPS_HOST" "cd $VPS_DIR && docker-compose up -d --build"
    
    log_success "Synchronisation terminée"
}

# =============================================================================
# MENU PRINCIPAL
# =============================================================================

show_usage() {
    echo ""
    echo "Usage: $0 [commande] [user@hostname]"
    echo ""
    echo "Commandes:"
    echo "  deploy    Déploiement complet (par défaut)"
    echo "  sync      Synchronisation rapide des fichiers"
    echo "  ssl       Gestion SSL uniquement"
    echo "  logs      Afficher les logs du VPS"
    echo ""
    echo "Exemples:"
    echo "  $0 deploy root@monserveur.com"
    echo "  $0 sync root@monserveur.com"
    echo "  $0 logs root@monserveur.com"
    echo ""
}

# =============================================================================
# EXÉCUTION
# =============================================================================

main() {
    COMMAND=${1:-"deploy"}
    VPS_TARGET=${2:-""}
    
    # Si le premier argument contient @, c'est un host
    if [[ "$COMMAND" == *"@"* ]]; then
        VPS_TARGET="$COMMAND"
        COMMAND="deploy"
    fi
    
    if [ -n "$VPS_TARGET" ]; then
        VPS_USER=$(echo "$VPS_TARGET" | cut -d'@' -f1)
        VPS_HOST=$(echo "$VPS_TARGET" | cut -d'@' -f2)
    fi
    
    echo "=========================================="
    echo "  DEPLOY EDUFLOW - LOCAL → VPS"
    echo "=========================================="
    echo "VPS: $VPS_USER@$VPS_HOST"
    echo "Commande: $COMMAND"
    echo "=========================================="
    echo ""
    
    case "$COMMAND" in
        deploy)
            check_local
            setup_vps
            deploy_sources
            setup_ssl
            start_containers
            check_deployment
            ;;
        sync)
            check_local
            quick_sync
            ;;
        ssl)
            setup_ssl
            ;;
        logs)
            ssh "$VPS_USER@$VPS_HOST" "cd $VPS_DIR && docker-compose logs -f"
            ;;
        *)
            show_usage
            exit 1
            ;;
    esac
}

# Lancement
main "$@"
