# 🚀 Déploiement Complet - Résumé

## Étapes rapides

### 1. Préparation Serveur

```bash
# Sur votre serveur VPS
sudo mkdir -p /opt/docker/apps
sudo chown $USER:$USER /opt/docker/apps
cd /opt/docker/apps
```

### 2. Cloner le projet

```bash
git clone https://github.com/votre-repo/eschool.git eduflow
cd eduflow
```

### 3. Configurer Cloudflare

1. **Ajouter le domaine** dans [dash.cloudflare.com](https://dash.cloudflare.com)
2. **Créer le record A**:
   | Type | Nom | Contenu | Proxy |
   |------|-----|---------|-------|
   | A | @ | IP_VOTRE_SERVEUR | 🟠 |
3. **SSL/TLS** → Mettre sur **"Full (strict)"**
4. **Always Use HTTPS** → ON

### 4. Obtenir Token API Cloudflare

1. Profil (haut droite) → **My Profile** → **API Tokens**
2. **Create Token** → **Use template** → "Edit zone DNS"
3. Permissions:
   - Zone : DNS : Edit
   - Zone Resources : Include : Specific zone : henrimorel.com
4. **Create Token** → Copier le token
5. Récupérer **Zone ID** sur la page d'accueil du domaine

### 5. Configurer le projet

```bash
cd /opt/docker/apps/eduflow

# Copier et éditer .env
cp infra/.env.example .env
nano .env
```

**Contenu .env:**
```bash
# Base de données
POSTGRES_PASSWORD=UnMotDePasseFort123!

# OVH S3 (pour les logos)
OVH_S3_ACCESS_KEY=votre_key
OVH_S3_SECRET_KEY=votre_secret

# Cloudflare (pour création auto DNS)
CF_API_TOKEN=votre_token_copié
CF_ZONE_ID=votre_zone_id

# Email
SMTP_PASS=votre_app_password
```

### 6. Démarrer l'infrastructure

```bash
./deploy.sh
```

### 7. Créer une école

```bash
./infra/scripts/deploy-school.sh colegio-san-jose colegiosanjose.henrimorel.com
```

Cela va:
1. Créer automatiquement le DNS dans Cloudflare
2. Créer le container Next.js
3. Rendre accessible: https://colegiosanjose.henrimorel.com

## Commandes utiles

```bash
# Voir tous les containers
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

# Logs d'une école
docker logs -f school_colegio-san-jose

# Redémarrer une école
cd /opt/docker/apps/colegio-san-jose
docker-compose restart

# Supprimer une école
cd /opt/docker/apps/colegio-san-jose
docker-compose down
# Puis supprimer manuellement le DNS dans Cloudflare

# Logs infrastructure
cd /opt/docker/apps/eduflow
docker-compose -f infra/docker-compose.infrastructure.yml logs -f
```

## Structure finale

```
/opt/docker/apps/
├── eduflow/                    # Infra maître
│   ├── docker-compose.yml
│   ├── .env
│   ├── php/src/               # App PHP
│   └── nextjs-template/       # Template écoles
│
├── colegio-san-jose/          # École 1
│   └── docker-compose.yml
│
├── instituto-monte/           # École 2
│   └── docker-compose.yml
│
└── ...
```

## URLs après déploiement

| Service | URL |
|---------|-----|
| Site principal | https://henrimorel.com |
| École 1 | https://colegio-san-jose.henrimorel.com |
| École 2 | https://instituto-monte.henrimorel.com |
| Adminer (local) | http://localhost:8082 |
| Traefik | https://traefik.henrimorel.com |

## Dépannage

### "Error 525 SSL Handshake Failed"
→ Cloudflare → SSL/TLS → Passer sur **"Full"** (pas strict)

### "DNS_PROBE_FINISHED_NXDOMAIN"
→ Attendre 5 min pour propagation DNS

### Le script ne crée pas le DNS
→ Vérifier: `docker exec edu_php env | grep CF_`
→ Tester API: `./infra/scripts/test-cloudflare.sh`

## Support

WhatsApp: [+57 320 418 1193](https://wa.me/573204181193)
