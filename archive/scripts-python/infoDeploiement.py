
# Création d'un guide d'utilisation du script
guide_deploiement = '''# Guide de Déploiement Production - EduFlow

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir :

1. **Un serveur VPS** (recommandé : 2 CPU, 4GB RAM, 20GB SSD)
   - Ubuntu 20.04/22.04 LTS
   - Accès root (SSH)

2. **Un nom de domaine** pointant vers votre serveur
   - Exemple : `eduflow.co` → IP de votre serveur
   - Enregistrement A et AAAA (si IPv6)

3. **Un email valide** pour Certbot (Let's Encrypt)

## 🚀 Déploiement Rapide

### Étape 1 : Télécharger le script

```bash
# Sur votre serveur (en root)
wget https://votre-repo/deploiementProd.sh
chmod +x deploy-eduflow-prod.sh
```

### Étape 2 : Exécuter le déploiement

```bash
# Méthode interactive (recommandée)
./deploiementProd.sh

# Ou avec variables prédéfinies
DOMAIN=eduvotrecolegio.co EMAIL=admin@votrecolegio.co ./deploiementProd.sh
```

### Étape 3 : Suivre les instructions

Le script va :
1. Installer Docker et Docker Compose
2. Configurer le pare-feu (UFW)
3. Générer les certificats SSL
4. Déployer l'application
5. Configurer les sauvegardes automatiques

⏱️ **Durée totale :** ~10-15 minutes

## 🔧 Post-Déploiement

### Accès aux services

| Service | URL | Notes |
|---------|-----|-------|
| **Site Web** | `https://votredomaine.com` | HTTPS automatique |
| **phpMyAdmin** | `http://localhost:8080` | Via tunnel SSH uniquement |
| **API** | `https://votredomaine.com/procesar_contacto.php` | Endpoint formulaire |

### Tunnel SSH pour phpMyAdmin

```bash
# Depuis votre ordinateur local
ssh -L 8080:localhost:8080 root@votre-serveur.com

# Puis accédez à : http://localhost:8080 sur votre navigateur
```

## 🛠️ Commandes de Gestion

### Voir l'état des services
```bash
cd /opt/eduflow
docker-compose ps
```

### Voir les logs
```bash
# Tous les services
docker-compose logs -f

# Un service spécifique
docker-compose logs -f nginx
docker-compose logs -f php
docker-compose logs -f mysql
```

### Redémarrer les services
```bash
docker-compose restart

# Ou un seul service
docker-compose restart nginx
```

### Mettre à jour l'application
```bash
cd /opt/eduflow
./update.sh
```

### Sauvegarde manuelle
```bash
cd /opt/eduflow
./backup.sh
```

## 🔒 Sécurité

### Ce qui est configuré automatiquement :

✅ **Pare-feu UFW** - Ports 22, 80, 443 ouverts uniquement  
✅ **Certificats SSL** - HTTPS forcé avec redirection 301  
✅ **Headers de sécurité** - XSS Protection, Content-Type, etc.  
✅ **Isolation réseau** - Containers dans un réseau Docker dédié  
✅ **Pas de MySQL exposé** - Port 3306 uniquement interne  
✅ **phpMyAdmin local** - Accessible uniquement via tunnel SSH  

### Recommandations supplémentaires :

1. **Changer les mots de passe** dans `/opt/eduflow/.env`
2. **Configurer Fail2Ban** pour protéger SSH
3. **Désactiver root SSH** et utiliser une clé SSH
4. **Mises à jour automatiques** de sécurité :
   ```bash
   apt install unattended-upgrades
   ```

## 📊 Monitoring

### Vérifier l'espace disque
```bash
df -h
docker system df
```

### Vérifier l'utilisation mémoire
```bash
free -h
docker stats --no-stream
```

### Nettoyer Docker (attention aux données !)
```bash
# Images non utilisées
docker image prune -a

# Volumes orphelins
docker volume prune

# Tout nettoyer (⚠️)
docker system prune -a --volumes
```

## 🆘 Dépannage

### Le site ne s'affiche pas
```bash
# Vérifier les logs Nginx
docker-compose logs nginx

# Vérifier que les containers tournent
docker-compose ps

# Redémarrer
docker-compose restart
```

### Erreur de certificat SSL
```bash
# Forcer le renouvellement
cd /opt/eduflow
docker-compose run --rm certbot renew --force-renewal
docker-compose exec nginx nginx -s reload
```

### Base de données inaccessible
```bash
# Vérifier MySQL
docker-compose logs mysql

# Accès console MySQL
docker exec -it eduflow_mysql mysql -u edu_user -p
```

### Reconstruction complète (⚠️ perd les données)
```bash
cd /opt/eduflow
docker-compose down -v  # Supprime aussi les volumes
docker-compose up -d --build
```

## 📁 Structure sur le serveur

```
/opt/eduflow/
├── docker-compose.yml      # Configuration Docker
├── .env                    # Variables sensibles (chmod 600)
├── backup.sh               # Script de sauvegarde
├── update.sh               # Script de mise à jour
├── nginx/
│   ├── nginx.conf          # Config Nginx principale
│   └── default.conf        # Config site (SSL)
├── php/
│   ├── Dockerfile          # Image PHP custom
│   └── src/                # Code source de l'app
├── mysql/
│   └── init.sql            # Initialisation BD
├── certbot/                # Certificats SSL
│   ├── conf/               # /etc/letsencrypt
│   └── www/                # Challenge ACME
└── logs/                   # Logs Nginx/MySQL
```

## 🔄 Mise à jour du code

Pour mettre à jour la homepage :

```bash
# 1. Modifier les fichiers dans /opt/eduflow/php/src/
nano /opt/eduflow/php/src/index.php

# 2. Redémarrer PHP (pas besoin de rebuild)
docker-compose restart php

# Ou pour un changement complet :
docker-compose up -d --build php
```

## 💾 Restauration d'une sauvegarde

```bash
# 1. Trouver la dernière sauvegarde
ls -la /opt/backups/eduflow/

# 2. Restaurer la base de données
docker exec -i eduflow_mysql mysql -u edu_user -p edu_platform < /opt/backups/eduflow/db_20240328_020000.sql

# 3. Restaurer les fichiers
cd /opt/eduflow
tar -xzf /opt/backups/eduflow/files_20240328_020000.tar.gz
```

## 📞 Support

En cas de problème :
1. Vérifier les logs : `docker-compose logs`
2. Vérifier l'espace disque : `df -h`
3. Redémarrer les services : `docker-compose restart`

---
**Dernière mise à jour :** Mars 2024  
**Version :** 1.0.0
'''

with open('/mnt/kimi/output/GUIDE_DEPLOIEMENT.md', 'w') as f:
    f.write(guide_deploiement)

print("✅ Guide de déploiement créé: GUIDE_DEPLOIEMENT.md")
