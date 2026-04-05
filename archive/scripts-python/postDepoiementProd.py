
# Création d'un script de vérification post-déploiement
health_check_script = '''#!/bin/bash
# Script de vérification de santé post-déploiement

RED='\\033[0;31m'
GREEN='\\033[0;32m'
YELLOW='\\033[1;33m'
NC='\\033[0m'

APP_DIR="/opt/eduflow"
DOMAIN=$(grep DOMAIN $APP_DIR/.env | cut -d'=' -f2)

echo "=========================================="
echo "   VÉRIFICATION POST-DÉPLOIEMENT"
echo "=========================================="
echo ""

# Fonction de vérification
check_service() {
    if [ $2 -eq 0 ]; then
        echo -e "${GREEN}✓${NC} $1"
        return 0
    else
        echo -e "${RED}✗${NC} $1"
        return 1
    fi
}

ERRORS=0

# 1. Vérifier les containers
echo "1. Vérification des containers Docker..."
cd $APP_DIR

if docker-compose ps | grep -q "Up"; then
    check_service "Containers Docker en cours d'exécution" 0
else
    check_service "Containers Docker en cours d'exécution" 1
    ERRORS=$((ERRORS + 1))
fi

# 2. Vérifier le site web
echo ""
echo "2. Vérification du site web..."
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost)
if [ "$HTTP_CODE" = "200" ] || [ "$HTTP_CODE" = "301" ]; then
    check_service "Site web accessible (HTTP $HTTP_CODE)" 0
else
    check_service "Site web accessible (HTTP $HTTP_CODE)" 1
    ERRORS=$((ERRORS + 1))
fi

# 3. Vérifier HTTPS
echo ""
echo "3. Vérification HTTPS..."
if curl -sI https://$DOMAIN 2>&1 | grep -q "HTTP/2 200"; then
    check_service "HTTPS fonctionnel avec HTTP/2" 0
else
    check_service "HTTPS fonctionnel" 1
    ERRORS=$((ERRORS + 1))
fi

# 4. Vérifier le certificat SSL
echo ""
echo "4. Vérification du certificat SSL..."
CERT_DAYS=$(echo | openssl s_client -servername $DOMAIN -connect $DOMAIN:443 2>/dev/null | openssl x509 -noout -dates | grep notAfter | cut -d'=' -f2 | xargs -I {} date -d "{}" +%s)
NOW=$(date +%s)
DAYS_LEFT=$(( ($CERT_DAYS - $NOW) / 86400 ))

if [ $DAYS_LEFT -gt 30 ]; then
    check_service "Certificat SSL valide ($DAYS_LEFT jours restants)" 0
elif [ $DAYS_LEFT -gt 0 ]; then
    check_service "Certificat SSL expire bientôt ($DAYS_LEFT jours)" 0
    echo -e "${YELLOW}  ⚠ Renouvellement automatique dans $DAYS_LEFT jours${NC}"
else
    check_service "Certificat SSL valide" 1
    ERRORS=$((ERRORS + 1))
fi

# 5. Vérifier MySQL
echo ""
echo "5. Vérification de la base de données..."
if docker exec eduflow_mysql mysqladmin -u edu_user -p$(grep DB_PASS $APP_DIR/.env | cut -d'=' -f2) ping 2>/dev/null | grep -q "alive"; then
    check_service "MySQL répond aux requêtes" 0
else
    check_service "MySQL répond aux requêtes" 1
    ERRORS=$((ERRORS + 1))
fi

# 6. Vérifier l'espace disque
echo ""
echo "6. Vérification de l'espace disque..."
DISK_USAGE=$(df -h / | awk 'NR==2 {print $5}' | sed 's/%//')
if [ $DISK_USAGE -lt 80 ]; then
    check_service "Espace disque suffisant ($DISK_USAGE% utilisé)" 0
else
    check_service "Espace disque suffisant" 1
    echo -e "${YELLOW}  ⚠ Espace disque à $DISK_USAGE%${NC}"
    ERRORS=$((ERRORS + 1))
fi

# 7. Vérifier la mémoire
echo ""
echo "7. Vérification de la mémoire..."
MEM_USAGE=$(free | grep Mem | awk '{printf "%.0f", $3/$2 * 100.0}')
if [ $MEM_USAGE -lt 90 ]; then
    check_service "Mémoire disponible ($MEM_USAGE% utilisé)" 0
else
    check_service "Mémoire disponible" 1
    echo -e "${YELLOW}  ⚠ Mémoire à $MEM_USAGE%${NC}"
    ERRORS=$((ERRORS + 1))
fi

# 8. Vérifier les sauvegardes
echo ""
echo "8. Vérification des sauvegardes..."
if [ -d "/opt/backups/eduflow" ]; then
    LATEST_BACKUP=$(ls -t /opt/backups/eduflow/*.sql 2>/dev/null | head -1)
    if [ ! -z "$LATEST_BACKUP" ]; then
        BACKUP_DATE=$(stat -c %y "$LATEST_BACKUP" | cut -d' ' -f1)
        check_service "Sauvegardes configurées (dernière: $BACKUP_DATE)" 0
    else
        check_service "Sauvegardes configurées" 1
        ERRORS=$((ERRORS + 1))
    fi
else
    check_service "Répertoire de sauvegardes existe" 1
    ERRORS=$((ERRORS + 1))
fi

# Résumé
echo ""
echo "=========================================="
if [ $ERRORS -eq 0 ]; then
    echo -e "${GREEN}✓ TOUT EST OPÉRATIONNEL!${NC}"
else
    echo -e "${RED}✗ $ERRORS PROBLÈME(S) DÉTECTÉ(S)${NC}"
fi
echo "=========================================="
echo ""
echo "Commandes utiles:"
echo "  - Voir les logs: docker-compose -f $APP_DIR/docker-compose.yml logs -f"
echo "  - Redémarrer:    docker-compose -f $APP_DIR/docker-compose.yml restart"
echo "  - Sauvegarde:    $APP_DIR/backup.sh"
echo ""

exit $ERRORS
'''

with open('/mnt/kimi/output/health-check.sh', 'w') as f:
    f.write(health_check_script)

print("✅ Script de vérification santé créé: health-check.sh")
