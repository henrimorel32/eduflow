# 🚀 Déploiement Safe - Ajouter Multi-école sans tout casser

Ce guide explique comment ajouter le système multi-école (Next.js + sous-domaines) à côté de ton site PHP existant.

## 📋 Architecture finale

```
henrimorel.com           → Site PHP existant (conservé)
├─ colegio1.henrimorel.com  → École 1 (Next.js)
├─ colegio2.henrimorel.com  → École 2 (Next.js)
└─ ...
```

## ⚠️ Prérequis sur le serveur

1. **Le site PHP actuel tourne** sur `henrimorel.com`
2. **Traefik est déjà configuré** avec le réseau `edu_proxy`
3. **Docker et Docker Compose** sont installés

## 🚀 Étapes de déploiement

### 1. Backup (IMPORTANT)

```bash
# Sur le serveur, backup l'existant
cd /chemin/vers/ton/projet
docker-compose ps > backup-containers.txt
cp docker-compose.yml docker-compose.yml.backup.$(date +%Y%m%d)
```

### 2. Ajouter les variables d'environnement

Crée ou édite le fichier `.env` à côté de tes docker-compose existants :

```bash
# Ajouter à la fin de ton .env existant
POSTGRES_PASSWORD=UnMotDePasseFort123!
```

### 3. Démarrer les nouveaux services (PostgreSQL + Redis)

```bash
# Copier le fichier sur le serveur
scp docker-compose.new-services.yml user@server:/opt/docker/apps/

# Sur le serveur, démarrer les nouveaux services
cd /opt/docker/apps/
docker-compose -f docker-compose.new-services.yml up -d

# Vérifier
docker ps | grep edu_
```

Tu dois voir :
- `edu_postgres` 
- `edu_redis`
- `edu_adminer` (optionnel, localhost:8082)

### 4. Copier le template Next.js

```bash
# Sur le serveur
mkdir -p /opt/docker/apps/eduflow
cp -r nextjs-template /opt/docker/apps/eduflow/
```

### 5. Créer une première école

```bash
# Copier le script sur le serveur
scp scripts/add-school.sh user@server:/opt/docker/apps/
chmod +x /opt/docker/apps/add-school.sh

# Sur le serveur, créer une école
cd /opt/docker/apps/
./add-school.sh colegio-san-jose colegiosanjose.henrimorel.com "Colegio San José"
```

### 6. Vérifier le DNS

Ajoute dans Cloudflare/DNS :
```
Type: CNAME
Nom: colegiosanjose
Valeur: henrimorel.com (ou l'IP du serveur)
```

Ou si tu utilises l'API Cloudflare, le script peut le faire automatiquement.

## 📁 Structure finale sur le serveur

```
/opt/docker/apps/
├── eduflow/                          # Infra maître (optionnel)
│   └── nextjs-template/              # Template Next.js
│
├── docker-compose.new-services.yml   # PostgreSQL + Redis
├── .env                              # Variables partagées
├── add-school.sh                     # Script d'ajout d'école
│
├── colegio-san-jose/                 # École 1
│   └── docker-compose.yml
├── instituto-maria/                  # École 2
│   └── docker-compose.yml
│
└── [ton projet PHP actuel]/          # Site principal
    ├── docker-compose.yml            # L'existant
    ├── php/src/                      # Sources PHP
    └── ...
```

## 🔍 Vérification

```bash
# Voir tous les containers
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

# Logs site principal
docker logs -f edu_nginx

# Logs école
docker logs -f school_colegio-san-jose

# Logs PostgreSQL
docker logs -f edu_postgres
```

## 🧪 Test de non-régression

1. **Tester le site principal** : https://henrimorel.com doit toujours fonctionner
2. **Tester l'école** : https://colegiosanjose.henrimorel.com doit répondre
3. **Vérifier Traefik** : https://traefik.henrimorel.com (dashboard)

## 🛠️ Dépannage

### "network edu_proxy not found"
```bash
# Créer le réseau
docker network create edu_proxy
```

### "POSTGRES_PASSWORD manquant"
```bash
# Vérifier le .env
cat .env | grep POSTGRES
# Doit afficher: POSTGRES_PASSWORD=...
```

### L'école ne répond pas
```bash
# Vérifier les logs
docker logs school_colegio-san-jose

# Vérifier que Traefik voit le container
docker logs traefik | grep colegio
```

### Conflit de ports
Si le site PHP utilise déjà des ports, pas de souci :
- Les nouveaux services (postgres, redis) n'exposent pas de ports publics
- Les écoles sont exposées via Traefik uniquement

## ♻️ Rollback (si problème)

Si ça ne marche pas, tu peux arrêter uniquement les nouveaux services :

```bash
# Arrêter juste les nouveaux services
docker-compose -f docker-compose.new-services.yml down

# Supprimer une école
cd /opt/docker/apps/colegio-san-jose
docker-compose down

# Le site PHP continue de tourner normalement !
```

## 📝 Résumé des fichiers créés

| Fichier | Description |
|---------|-------------|
| `docker-compose.new-services.yml` | PostgreSQL + Redis |
| `docker-compose.school.yml.template` | Template pour chaque école |
| `scripts/add-school.sh` | Script pour créer une école |
| `DEPLOY-SAFE.md` | Ce guide |

---

**Questions ?** Vérifie d'abord que tout est ok sur le site principal avant de continuer !
