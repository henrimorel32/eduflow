# 🚀 Déploiement Production - Site PHP

## Prérequis

- Accès SSH au serveur (`root@henrimorel.com`)
- Clé SSH : `~/.ssh/id_ed25519_vps_web_page`
- Port SSH : `2222`
- Docker et Docker Compose installés sur le serveur
- Réseau `edu_proxy` créé (pour Traefik)

## 🚀 Déploiement rapide

```bash
# 1. Configurer les variables (une fois)
export SERVER_USER=root
export SERVER_HOST=henrimorel.com
export SERVER_DIR=/opt/docker/apps/eduflow
export SSH_KEY=~/.ssh/id_ed25519_vps_web_page
export SSH_PORT=2222

# 2. Lancer le déploiement
./scripts/deploy-to-prod.sh
```

## 📋 Ce qui est déployé

| Fichier | Destination |
|---------|-------------|
| `docker-compose.yml` | `/opt/docker/apps/eduflow/` |
| `php/` (sources) | `/opt/docker/apps/eduflow/php/` |
| `nginx/` (config) | `/opt/docker/apps/eduflow/nginx/` |
| `mysql/init.sql` | `/opt/docker/apps/eduflow/mysql/` |

## 🔄 Processus de déploiement

1. **Backup automatique** des sources actuelles
2. **Synchronisation** des nouveaux fichiers
3. **Rebuild** de l'image PHP (si Dockerfile changé)
4. **Redémarrage** sans coupure des services
5. **Vérification** que le site répond

## 📁 Structure sur le serveur

```
/opt/docker/apps/eduflow/
├── docker-compose.yml      ← Fichier principal
├── php/
│   ├── Dockerfile
│   └── src/                ← Code source PHP
├── nginx/
│   ├── nginx.conf
│   └── default.conf
├── mysql/
│   └── init.sql
├── .env                    ← Variables (non écrasé)
├── backups/                ← Backups automatiques
│   ├── backup-20240405-120000-php.tar.gz
│   └── backup-20240405-120000-nginx.tar.gz
└── logs/
    └── nginx/
```

## 🛠️ Commandes utiles sur le serveur

```bash
# Se connecter
ssh root@henrimorel.com
cd /opt/docker/apps/eduflow

# Voir les conteneurs
docker-compose ps

# Logs
docker-compose logs -f
docker-compose logs -f nginx
docker-compose logs -f php
docker-compose logs -f mysql

# Redémarrer
docker-compose restart

# Arrêter
docker-compose down

# Entrer dans un conteneur
docker exec -it edu_php bash
docker exec -it edu_mysql mysql -u edu_user -p
```

## ⚠️ Rollback

Si problème après déploiement :

```bash
ssh root@henrimorel.com
cd /opt/docker/apps/eduflow

# Restaurer le backup
tar -xzf backups/backup-XXXX-php.tar.gz

# Redémarrer
docker-compose restart
```

## ✅ Checklist avant déploiement

- [ ] Code testé en local (`./scripts/start-local.sh`)
- [ ] Pas de fichiers sensibles dans php/src/
- [ ] Variables d'env configurées sur le serveur
- [ ] Accès SSH OK
