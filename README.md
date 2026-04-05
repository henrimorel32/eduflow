# 🎓 EduFlow - Plateforme Multi-école

Plateforme de souscription et gestion d'écoles avec sous-domaines personnalisés.

## 🏗️ Architecture

```
henrimorel.com              → Site principal (PHP + Nginx)
school1.henrimorel.com      → École 1 (Next.js)
school2.henrimorel.com      → École 2 (Next.js)
```

## 📁 Structure du projet

```
.
├── docker-compose.yml                    # Site principal (EXISTANT - NE PAS MODIFIER)
├── docker-compose.infrastructure.yml     # PostgreSQL + Redis (pour les écoles)
├── docker-compose.school-template.yml    # Template pour créer une école
├── scripts/
│   ├── add-school.sh                     # Créer une nouvelle école
│   └── setup-infrastructure.sh           # Setup initial
├── nextjs-template/                      # Template Next.js pour les écoles
├── php/                                  # Site principal PHP
├── mysql/                                # BDD MySQL (site principal)
├── nginx/                                # Config Nginx
└── archive/                              # Fichiers obsolètes (ne pas utiliser)
```

## 🚀 Démarrage rapide

### Étape 1 : Déployer le site PHP en production

```bash
# Déployer le site principal
./scripts/deploy-to-prod.sh
```

### Étape 2 : Déployer l'infrastructure multi-école

```bash
# Déployer PostgreSQL + Redis
./scripts/deploy-infra.sh
```

### Étape 3 : Créer une école

```bash
# Créer une nouvelle école (avec DNS automatique)
./scripts/add-school-remote.sh <slug> <domain> [nom]

# Exemple:
./scripts/add-school-remote.sh colegio1 colegio1.henrimorel.com "Colegio San José"
```

### Développement local

```bash
# Lancer en local (http://localhost:8080)
./scripts/start-local.sh

# Arrêter
./scripts/stop-local.sh
```

## 📝 Fichiers importants

| Fichier | Description |
|---------|-------------|
| `docker-compose.yml` | Site PHP principal (inchangé en prod) |
| `docker-compose.infrastructure.yml` | PostgreSQL + Redis pour les écoles |
| `scripts/add-school.sh` | Script pour créer une école |

## ⚠️ Ne pas modifier

- `docker-compose.yml` - Site principal en production
- `php/src/` - Code source PHP (sauf si bugfix nécessaire)

## 📚 Documentation

- `DEPLOY-SAFE.md` - Guide déploiement complet
- `archive/` - Anciens fichiers (conservés pour historique)

## 🛠️ Commandes utiles

```bash
# Voir tous les containers (local)
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

# Synchroniser les sources vers le serveur
./scripts/sync-to-server.sh

# Logs d'une école (sur le serveur)
ssh -p 2222 -i ~/.ssh/id_ed25519_vps_web_page henri@51.178.136.181 "docker logs -f school_<slug>"

# Redémarrer l'infrastructure (sur le serveur)
ssh -p 2222 -i ~/.ssh/id_ed25519_vps_web_page henri@51.178.136.181 "cd /opt/docker/apps/eduflow && docker compose -f docker-compose.infrastructure.yml restart"
```

## 📋 Architecture déployée

```
henrimorel.com                    → Site PHP principal (nginx + php + mysql)
├── demo.henrimorel.com           → École 1 (Next.js) ✅
├── colegio1.henrimorel.com       → École 2 (Next.js) - à créer
└── ...

Services partagés:
├── edu_postgres:5432             → PostgreSQL (pour écoles Next.js)
├── edu_redis:6379                → Redis (cache/sessions)
└── traefik:80/443                → Reverse proxy + SSL
```
