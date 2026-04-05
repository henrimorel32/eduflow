
# Création d'un guide d'utilisation pour le déploiement local
guide_local = '''# Guide de Déploiement Local → VPS

## 🎯 Objectif
Déployer votre projet EduFlow depuis votre machine locale vers un VPS distant en une seule commande.

## 📋 Prérequis

### Sur votre machine locale :
```bash
# Linux/Mac
ssh-keygen -t rsa -b 4096
ssh-copy-id root@votre-vps.com

# Windows (PowerShell)
# Utiliser PuTTYgen ou OpenSSH
```

### Sur le VPS :
- Ubuntu 20.04/22.04
- Ports 22, 80, 443 ouverts
- Un nom de domaine pointant vers le VPS

## 🚀 Utilisation

### 1. Déploiement complet (première fois)
```bash
./deploy-local.sh deploy root@monserveur.com
```

Ce que fait le script :
1. ✅ Vérifie la connexion SSH
2. ✅ Installe Docker sur le VPS (si besoin)
3. ✅ Copie tous les fichiers sources
4. ✅ Crée le fichier .env avec vos paramètres
5. ✅ Vérifie/crée le certificat SSL
6. ✅ Démarre les containers
7. ✅ Vérifie que tout fonctionne

### 2. Synchronisation rapide (mises à jour)
```bash
./deploy-local.sh sync root@monserveur.com
```

Copie uniquement les fichiers modifiés et redémarre.

### 3. Voir les logs
```bash
./deploy-local.sh logs root@monserveur.com
```

### 4. Gestion SSL uniquement
```bash
./deploy-local.sh ssl root@monserveur.com
```

## 📁 Structure du projet local

```
mon-projet/
├── deploy-local.sh       ← Ce script
├── docker-compose.yml    ← Configuration Docker
├── php/
│   ├── Dockerfile
│   └── src/              ← Code source
├── nginx/
│   ├── nginx.conf
│   └── default.conf
├── mysql/
│   └── init.sql
└── .env                  ← Variables locales (optionnel)
```

## 🔒 Gestion du .env

Le script gère automatiquement le fichier `.env` :

**Si vous avez un .env local :**
- Le script demande si vous voulez le copier
- Sinon, il crée un nouveau .env sur le VPS

**Si vous n'avez pas de .env :**
- Le script demande le domaine et l'email
- Génère des mots de passe aléatoires sécurisés
- Crée le .env sur le VPS

## 🌐 Workflow de déploiement

```
┌─────────────────┐         ┌─────────────────┐
│  VOTRE MACHINE  │  SSH    │      VPS        │
│    (Local)      │ ───────►│   (Distant)     │
│                 │  Rsync  │                 │
│  deploy-local.sh│         │  Docker Compose │
│                 │         │  Certbot (SSL)  │
└─────────────────┘         └────────┬────────┘
                                     │
                              ┌──────▼──────┐
                              │   HTTPS     │
                              │  eduflow.co │
                              └─────────────┘
```

## 🛠️ Commandes disponibles

| Commande | Description |
|----------|-------------|
| `deploy` | Déploiement complet (par défaut) |
| `sync` | Synchronisation rapide des fichiers |
| `ssl` | Vérification/création SSL uniquement |
| `logs` | Afficher les logs en temps réel |

## 📝 Exemples

### Premier déploiement
```bash
# Depuis le répertoire du projet
./deploy-local.sh root@123.456.789.0

# Ou avec un nom de domaine
./deploy-local.sh deploy root@eduflow.co
```

### Mise à jour du code
```bash
# Après modification des fichiers PHP
./deploy-local.sh sync root@eduflow.co
```

### Renouvellement SSL
```bash
# Si le certificat expire
./deploy-local.sh ssl root@eduflow.co
```

## ⚠️ Exclusions de synchronisation

Ces fichiers ne sont PAS copiés vers le VPS :
- `.git/` - Historique git
- `.env` - Variables locales (sauf si explicitement demandé)
- `node_modules/` - Dépendances Node
- `vendor/` - Dépendances PHP
- `*.log` - Fichiers de logs
- `certbot/` - Certificats SSL (déjà sur le VPS)
- `mysql_data/` - Données de la base

## 🔧 Dépannage

### Erreur de connexion SSH
```bash
# Tester la connexion manuellement
ssh root@votre-vps.com

# Si ça ne marche pas, configurer la clé SSH
ssh-copy-id root@votre-vps.com
```

### Certificat SSL échoue
```bash
# Vérifier que le domaine pointe bien vers le VPS
dig +short votre-domaine.com

# Vérifier que le port 80 est ouvert
nc -zv votre-vps.com 80
```

### Containers ne démarrent pas
```bash
# Se connecter au VPS manuellement
ssh root@votre-vps.com
cd /opt/eduflow
docker-compose logs
```

## 🎨 Personnalisation

Modifier les variables en début de script :
```bash
VPS_DIR="/opt/eduflow"        # Répertoire sur le VPS
LOCAL_DIR="..."               # Répertoire local (auto-détecté)
```

---
**Version:** 1.0  
**Dernière mise à jour:** Mars 2024
'''

with open('/mnt/kimi/output/GUIDE_DEPLOY_LOCAL.md', 'w') as f:
    f.write(guide_local)

print("✅ Guide de déploiement local créé: GUIDE_DEPLOY_LOCAL.md")
