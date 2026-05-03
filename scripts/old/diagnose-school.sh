#!/bin/bash
# ============================================================
# DIAGNOSTIC ÉCOLE - Outil de débogage complet
# ============================================================
# Usage: ./diagnose-school.sh [slug]
# Exemple: ./diagnose-school.sh lycee
# ============================================================

set -e

SCHOOL_SLUG=${1:-""}

echo "============================================================"
echo "🔍 DIAGNOSTIC EDUFLOW"
echo "============================================================"
echo "Date: $(date)"
echo "User: $(whoami)"
echo "Host: $(hostname)"
echo ""

# 1. Vérifier les services de base
echo "============================================================"
echo "1. SERVICES DE BASE (PostgreSQL, Redis, Traefik)"
echo "============================================================"

SERVICES=("edu_postgres" "edu_redis" "traefik")
for service in "${SERVICES[@]}"; do
    if docker ps | grep -q "$service"; then
        STATUS=$(docker ps | grep "$service" | awk '{print $7}')
        echo "✅ $service: $STATUS"
    else
        echo "❌ $service: NON TROUVÉ"
        echo "   Containers actifs:"
        docker ps --format '  - {{.Names}} ({{.Status}})' 2>/dev/null || echo "   (erreur)"
    fi
done
echo ""

# 2. Vérifier les réseaux Docker
echo "============================================================"
echo "2. RÉSEAUX DOCKER"
echo "============================================================"
echo "Réseaux requis: eduflow_edu_internal, edu_proxy"
echo ""
docker network ls --format '  - {{.Name}} ({{.Driver}})' | grep -E 'edu|proxy' || echo "  Aucun réseau trouvé"
echo ""

# Vérifier les subnets
for network in "eduflow_edu_internal" "edu_proxy"; do
    if docker network ls | grep -q "$network"; then
        echo "✅ $network existe"
        SUBNET=$(docker network inspect "$network" --format '{{range .IPAM.Config}}{{.Subnet}}{{end}}' 2>/dev/null || echo "N/A")
        GATEWAY=$(docker network inspect "$network" --format '{{range .IPAM.Config}}{{.Gateway}}{{end}}' 2>/dev/null || echo "N/A")
        echo "   Subnet: $SUBNET, Gateway: $GATEWAY"
    else
        echo "❌ $network MANQUANT"
    fi
done
echo ""

# 3. Vérifier les écoles existantes
echo "============================================================"
echo "3. ÉCOLES EXISTANTES"
echo "============================================================"
echo "Dossiers dans /opt/docker/apps/:"
ls -la /opt/docker/apps/ 2>/dev/null || echo "  (impossible de lister)"
echo ""

echo "Containers school_*:"
docker ps -a --format 'table {{.Names}}\t{{.Status}}\t{{.Ports}}' | grep -E 'school|^NAMES' || echo "  Aucun container school_*"
echo ""

# 4. Vérifier les routes Traefik
echo "============================================================"
echo "4. ROUTES TRAEFIK"
echo "============================================================"
if curl -s http://localhost:8080/api/http/routers 2>/dev/null | grep -q "rule"; then
    echo "Routers HTTP configurés:"
    curl -s http://localhost:8080/api/http/routers 2>/dev/null | grep -o '"rule":"[^"]*"' | sed 's/"rule"://' | sed 's/^/  - /'
else
    echo "⚠️  Dashboard Traefik non accessible sur localhost:8080"
    echo "   Labels Traefik trouvés sur les containers:"
    docker ps -q | xargs -I {} docker inspect {} --format '{{.Name}}' 2>/dev/null | while read name; do
        LABELS=$(docker inspect "$name" --format '{{range $k, $v := .Config.Labels}}{{if contains $k "traefik"}}{{$k}}={{$v}}{{printf "\n"}}{{end}}{{end}}' 2>/dev/null)
        if [ -n "$LABELS" ]; then
            echo "  $name:"
            echo "$LABELS" | sed 's/^/    /'
        fi
    done
fi
echo ""

# 5. Vérifier les logs récents
echo "============================================================"
echo "5. LOGS RÉCENTS"
echo "============================================================"
echo "Logs Traefik (erreurs des 10 dernières minutes):"
docker logs traefik --since 10m 2>&1 | grep -E 'error|ERROR|not found|404' | tail -10 || echo "  (aucune erreur récente ou logs indisponibles)"
echo ""

# 6. Vérifier une école spécifique si fournie
if [ -n "$SCHOOL_SLUG" ]; then
    echo "============================================================"
    echo "6. DIAGNOSTIC ÉCOLE: $SCHOOL_SLUG"
    echo "============================================================"
    
    SCHOOL_DIR="/opt/docker/apps/${SCHOOL_SLUG}"
    CONTAINER_NAME="school_${SCHOOL_SLUG}"
    
    # Vérifier le dossier
    if [ -d "$SCHOOL_DIR" ]; then
        echo "✅ Dossier existe: $SCHOOL_DIR"
        echo "   Contenu:"
        ls -la "$SCHOOL_DIR" | sed 's/^/     /'
    else
        echo "❌ Dossier MANQUANT: $SCHOOL_DIR"
    fi
    
    # Vérifier le container
    if docker ps -a | grep -q "$CONTAINER_NAME"; then
        echo "✅ Container existe: $CONTAINER_NAME"
        echo "   Statut:"
        docker ps -a --format 'table {{.Names}}\t{{.Status}}\t{{.State}}' | grep "$CONTAINER_NAME" | sed 's/^/     /'
        
        # Vérifier les labels
        echo "   Labels Traefik:"
        docker inspect "$CONTAINER_NAME" --format '{{range $k, $v := .Config.Labels}}{{if contains $k "traefik"}}{{$k}}={{printf "\n"}}{{end}}{{end}}' 2>/dev/null | sed 's/^/     /' || echo "     (aucun label traefik)"
        
        # Vérifier les réseaux
        echo "   Réseaux:"
        docker inspect "$CONTAINER_NAME" --format '{{range $k, $v := .NetworkSettings.Networks}}{{$k}}: {{.IPAddress}}{{printf "\n"}}{{end}}' 2>/dev/null | sed 's/^/     /' || echo "     (non connecté)"
        
        # Logs du container
        echo "   Logs récents:"
        docker logs --tail 10 "$CONTAINER_NAME" 2>&1 | sed 's/^/     /' || echo "     (pas de logs)"
    else
        echo "❌ Container MANQUANT: $CONTAINER_NAME"
    fi
    
    # Test DNS local
    echo "   Test DNS:"
    DOMAIN="${SCHOOL_SLUG}.henrimorel.com"
    if host "$DOMAIN" 2>/dev/null | grep -q "has address"; then
        IP=$(host "$DOMAIN" | grep "has address" | head -1 | awk '{print $4}')
        echo "     $DOMAIN → $IP"
    else
        echo "     $DOMAIN: résolution DNS échouée (peut être normal si wildcard)"
    fi
    
    # Test HTTP local
    echo "   Test HTTP (via Traefik):"
    HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" "http://${SCHOOL_SLUG}.henrimorel.com" 2>/dev/null || echo "000")
    echo "     HTTP Status: $HTTP_CODE"
fi
echo ""

# 7. Vérifier les permissions
echo "============================================================"
echo "7. PERMISSIONS"
echo "============================================================"
echo "Dossier /opt/docker/apps/:"
stat /opt/docker/apps/ 2>/dev/null | grep -E 'Access|Uid|Gid' | sed 's/^/  /'
echo ""
echo "User actuel: $(whoami), UID: $(id -u), GID: $(id -g)"
echo ""

# 8. Vérifier les logs de création
echo "============================================================"
echo "8. LOGS DE CRÉATION D'ÉCOLES"
echo "============================================================"
if [ -d "/var/log/eduflow" ]; then
    echo "Logs trouvés:"
    ls -lth /var/log/eduflow/ 2>/dev/null | head -10 | sed 's/^/  /'
else
    echo "Aucun répertoire de logs (/var/log/eduflow)"
fi
echo ""

echo "============================================================"
echo "🔍 DIAGNOSTIC TERMINÉ"
echo "============================================================"
