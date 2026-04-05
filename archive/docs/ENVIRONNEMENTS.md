# Configuration des Environnements

Ce projet supporte deux environnements distincts : **Développement Local** et **Production**.

## 🖥️ Développement Local

### Fichiers
- `docker-compose.local.yml` - Configuration Docker pour le dev
- `.env.local` - Variables d'environnement locales
- `scripts/start-local.sh` - Script de démarrage

### Caractéristiques
- Port direct : **8081** (localhost uniquement)
- Debug activé (`APP_DEBUG=true`)
- Pas de SSL
- Stockage S3 optionnel (fallback local automatique)
- Email factice
- **Pas besoin de Traefik**

### Démarrage
```bash
# Méthode 1: Avec le script
./scripts/start-local.sh

# Méthode 2: Manuellement
docker-compose -f docker-compose.local.yml --env-file .env.local up -d
```

### Accès
- Site: http://localhost:8081
- phpMyAdmin: http://localhost:8080

---

## 🌐 Production (avec Traefik)

### Architecture
```
Internet
    ↓ (ports 80/443)
Traefik (SSL/Let's Encrypt)
    ↓ (port 80 interne)
Nginx (container edu_nginx)
    ↓ (port 9000)
PHP-FPM (container edu_php)
    ↓
MySQL (container edu_mysql)
```

### Fichiers
- `docker-compose.traefik.yml` - Traefik reverse proxy
- `docker-compose.yml` - Application (Nginx + PHP + MySQL)
- `.env` - Variables de production (crédentials réels)
- `scripts/start-prod.sh` - Script de démarrage

### Caractéristiques
- **Traefik** gère les ports 80 et 443
- SSL Let's Encrypt automatique
- Accès via domaine : henrimorel.com
- S3 OVH configuré
- Email réel (Gmail SMTP)

### Démarrage

#### 1. Démarrer Traefik (une seule fois)
```bash
# Créer le réseau proxy
docker network create proxy

# Démarrer Traefik
docker-compose -f docker-compose.traefik.yml up -d
```

#### 2. Démarrer l'application
```bash
# Méthode 1: Avec le script (recommandé)
./scripts/start-prod.sh

# Méthode 2: Manuellement
docker-compose up -d
```

### Vérifier que tout fonctionne
```bash
# Voir les conteneurs actifs
docker ps

# Voir les logs Traefik
docker logs -f traefik

# Voir les logs de l'app
docker-compose logs -f
```

### Accès
- Site: https://henrimorel.com (SSL auto)
- phpMyAdmin: http://localhost:8080 (localhost uniquement)

---

## ⚠️ Important

### Différences entre DEV et PROD

| | DEV | PROD |
|--|-----|------|
| **Reverse Proxy** | ❌ Direct | ✅ Traefik |
| **Port externe** | 8081 | 80/443 |
| **SSL** | ❌ Non | ✅ Let's Encrypt |
| **Accès** | localhost | Domaine public |
| **S3** | Fallback local | OVH Cloud |
| **Debug** | Activé | Désactivé |

### Fichiers d'environnement

| Fichier | DEV | PROD |
|---------|-----|------|
| `docker-compose.local.yml` | ✅ | ❌ |
| `docker-compose.yml` | ❌ | ✅ |
| `docker-compose.traefik.yml` | ❌ | ✅ |
| `.env.local` | ✅ | ❌ |
| `.env` | ❌ | ✅ |

### Reset complet
Si vous avez des problèmes de connexion BDD :
```bash
# DEV
docker-compose -f docker-compose.local.yml down -v
docker-compose -f docker-compose.local.yml up -d

# PROD
docker-compose down -v
docker-compose up -d
```
