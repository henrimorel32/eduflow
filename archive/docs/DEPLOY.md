# Guide de Déploiement Production

Ce guide explique comment déployer le système de souscription sur un serveur de production.

## 🔧 Prérequis

- Docker et Docker Compose installés
- Accès root ou sudo sur le serveur
- Les conteneurs `edu_mysql` et `edu_php` doivent être en cours d'exécution

## 📋 Étapes de Déploiement

### 1. Configurer les répertoires (sur l'hôte)

```bash
# Exécuter le script de configuration
sudo ./scripts/setup-production.sh
```

Ce script va :
- Créer le répertoire `/var/schools`
- Configurer les permissions (777 pour Docker)

### 2. Mettre à jour la base de données

```bash
# Exécuter le script SQL complet
docker exec -i edu_mysql mysql -u edu_user -p'VOTRE_MOT_DE_PASSE' edu_platform < mysql/deploy-prod-complete.sql
```

### 3. Vérifier que tout fonctionne

1. Aller sur `https://votredomaine.com/inscripcion.php`
2. Vérifier que le bouton "🎓 Suscribir mi colegio" s'affiche
3. Cliquer et tester le formulaire de souscription

## 🚀 Créer une école après inscription

Quand un utilisateur s'inscrit via le formulaire, l'école est créée en BDD avec le statut `pending_deploy`. Pour créer les fichiers et démarrer l'école :

```bash
# Sur le serveur hôte (PAS dans Docker)
./scripts/create-school.sh <slug-de-lecole>

# Exemple:
./scripts/create-school.sh instituto-monte-de-los-colores
```

Ce script va :
1. Créer le répertoire `/var/schools/<slug>/`
2. Générer le fichier `.env`
3. Générer le `docker-compose.yml`
4. Copier les fichiers source
5. Créer le script de démarrage

### Démarrer l'école

```bash
cd /var/schools/<slug>
docker-compose up -d
```

## 🔄 Flux complet

```
1. Utilisateur s'inscrit sur /suscripcion.php
   └── Données stockées en BDD (statut: pending_deploy)
   └── Email envoyé à l'utilisateur (activation en attente)

2. Admin exécute: ./scripts/create-school.sh <slug>
   └── Fichiers créés dans /var/schools/<slug>/

3. Admin démarre: cd /var/schools/<slug> && docker-compose up -d
   └── École accessible sur https://<slug>.henrimorel.com
   └── Statut BDD passe à: activa
```

## 🛠️ Dépannage

### Erreur: "Permission denied" sur /var/schools

```bash
# Corriger les permissions
sudo chmod 777 /var/schools
sudo chown -R $USER:$USER /var/schools
```

### Erreur: "Table suscripciones_escuelas n'existe pas"

```bash
# Ré-exécuter le script SQL
docker exec -i edu_mysql mysql -u edu_user -p'PASSWORD' edu_platform < mysql/deploy-prod-complete.sql
```

### Vérifier les écoles en attente

```bash
# Se connecter à MySQL
docker exec -it edu_mysql mysql -u edu_user -p edu_platform

# Lister les écoles en attente
SELECT id, nombre_escuela, slug, estado, created_at 
FROM suscripciones_escuelas 
WHERE estado = 'pending_deploy';
```

## 📁 Structure des fichiers

```
/var/schools/
└── <school-slug>/
    ├── docker-compose.yml
    ├── .env
    ├── deploy.sh
    ├── logs/
    │   └── nginx/
    ├── php/
    │   └── src/
    ├── mysql/
    │   └── init.sql
    └── nginx/
```

## 🔐 Sécurité

- Le répertoire `/var/schools` a des permissions 777 (nécessaire pour Docker)
- Chaque école a sa propre base de données MySQL
- Les fichiers de configuration contiennent des mots de passe générés aléatoirement
- Les conteneurs MySQL des écoles ne sont pas exposés publiquement

## 📧 Support

En cas de problème, vérifier les logs :
```bash
# Logs du conteneur principal
docker-compose logs -f php

# Logs d'une école spécifique
cd /var/schools/<slug>
docker-compose logs -f
```
