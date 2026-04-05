# Traefik Server - Configuration de Production

Configuration Traefik pour serveur dédié (plus puissant) avec gestion automatique des certificats SSL.

## 🏗️ Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                      Serveur VPS                            │
│                                                             │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐   │
│  │ Traefik  │  │ School 1 │  │ School 2 │  │ School N │   │
│  │  :80     │  │  :3000   │  │  :3000   │  │  :3000   │   │
│  │  :443    │  └──────────┘  └──────────┘  └──────────┘   │
│  │  :8080   │        |            |            |          │
│  └────┬─────┘        └────────────┴────────────┘          │
│       │                        |                          │
│       └────────────────────────┼──────────────────────────┘
│                                |                          
│                         ┌──────┴──────┐                   
│                         │ edu_proxy   │                   
│                         │  (réseau)   │                   
│                         └─────────────┘                   
└─────────────────────────────────────────────────────────────┘
```

## 📁 Structure

```
traefik-server/
├── docker-compose.yml          # Service Traefik
├── traefik.yml                 # Configuration statique
├── .env                        # Variables d'environnement (créer)
├── dynamic/                    # Configs dynamiques (File provider)
│   ├── middlewares.yml         # Middlewares globaux
│   └── schools.yml             # Routes des écoles (généré)
└── letsencrypt/                # Stockage certificats
    └── acme.json               # Certificats SSL (créé auto)
```

## 🚀 Installation

### 1. Prérequis

```bash
# Docker & Docker Compose
sudo apt update && sudo apt install -y docker.io docker-compose-plugin

# Network Docker
sudo docker network create edu_proxy
```

### 2. Configuration

```bash
cd traefik-server

# Créer le fichier .env
cat > .env << EOF
CF_DNS_API_TOKEN=votre_token_cloudflare
CF_API_EMAIL=votre@email.com
EOF

chmod 600 .env

# Créer le fichier acme.json avec les bonnes permissions
touch letsencrypt/acme.json
chmod 600 letsencrypt/acme.json
```

### 3. Lancement

```bash
docker compose up -d

# Vérifier les logs
docker logs -f traefik
```

## 📊 Dashboard

Accessible sur : `https://traefik.henrimorel.com`

Auth par défaut : `admin` / `changeme`

> ⚠️ **Changer le mot de passe en production !**
> ```bash
> htpasswd -nb admin nouveau_mot_de_passe
> # Copier le résultat dans dynamic/middlewares.yml
> ```

## 🔄 Ajouter une école

### Méthode 1: Fichier YAML (Recommandé)

Créer `/opt/docker/traefik/dynamic/mon-ecole.yml` :

```yaml
http:
  routers:
    school-mon-ecole:
      rule: Host(`mon-ecole.henrimorel.com`)
      service: service-mon-ecole
      tls:
        certResolver: letsencrypt
      middlewares:
        - security-headers@file

  services:
    service-mon-ecole:
      loadBalancer:
        servers:
          - url: "http://school_mon-ecole:3000"
```

### Méthode 2: Docker Labels

```yaml
services:
  school_mon-ecole:
    image: node:20-alpine
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.mon-ecole.rule=Host(`mon-ecole.henrimorel.com`)"
      - "traefik.http.routers.mon-ecole.tls.certresolver=letsencrypt"
      - "traefik.http.services.mon-ecole.loadbalancer.server.port=3000"
    networks:
      - edu_proxy
```

## 🔒 Sécurité

- **HTTPS forcé** : Redirection automatique HTTP → HTTPS
- **Headers sécurisés** : HSTS, X-Frame-Options, etc.
- **Rate limiting** : 100 req/sec par IP
- **TLS 1.2+** : Min version configurée
- **Certificats auto** : Let's Encrypt avec DNS-01 (Cloudflare)

## 🛠️ Commandes utiles

```bash
# Voir la config chargée
curl http://localhost:8080/api/rawdata | jq

# Voir les certificats
docker exec traefik cat /letsencrypt/acme.json | jq

# Reload config (après modification)
docker exec traefik traefik reload

# Logs
docker logs -f traefik --tail 100

# Debug mode (temporairement)
docker exec traefik traefik --log.level=DEBUG
```

## 📈 Monitoring

Le endpoint `/ping` est disponible pour les health checks :

```bash
curl http://localhost:8080/ping
# Réponse: OK
```

## 🚨 Dépannage

### Certificat non généré

```bash
# Vérifier les logs
docker logs traefik | grep -i "acme\|certificate\|error"

# Vérifier les permissions du fichier acme.json
ls -la letsencrypt/acme.json  # Doit être 600

# Forcer le renouvellement (supprimer le certificat du fichier acme.json)
```

### DNS Challenge échoue

```bash
# Vérifier le token Cloudflare
curl -X GET "https://api.cloudflare.com/client/v4/user/tokens/verify" \
  -H "Authorization: Bearer ${CF_DNS_API_TOKEN}"
```

### Route non trouvée

```bash
# Vérifier les routes chargées
curl http://localhost:8080/api/http/routers | jq

# Vérifier les services
curl http://localhost:8080/api/http/services | jq
```

## 📝 Notes

- **Ne jamais committer** le fichier `acme.json` ou `.env`
- Le fichier `acme.json` doit avoir les permissions **600**
- Traefik gère automatiquement le renouvellement des certificats (30 jours avant expiration)
