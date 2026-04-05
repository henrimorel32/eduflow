# Système de Souscription pour Écoles

Ce système permet aux écoles de créer leur propre page d'inscription personnalisée avec une période d'essai de 30 jours.

## Fonctionnalités

- ✅ Page d'inscription personnalisée avec les couleurs de l'école
- ✅ Upload du logo vers OVH Object Storage (S3)
- ✅ Génération automatique d'un sous-domaine dédié
- ✅ Vérification de disponibilité du nom en temps réel
- ✅ Envoi d'email récapitulatif avec PHPMailer
- ✅ Génération automatique de docker-compose.yml
- ✅ Base de données dédiée par école
- ✅ Support multilingue (ES, BR, EN, FR)

## Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                      Page Inscription                       │
│                    (inscripcion.php)                       │
│                                                             │
│   ┌─────────────────────┐    ┌─────────────────────────┐   │
│   │   Formulaire Demo   │ OR │  Bouton Souscription    │   │
│   │   (existant)        │    │  → suscripcion.php      │   │
│   └─────────────────────┘    └─────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                  Page Souscription                          │
│                  (suscripcion.php)                         │
│                                                             │
│   - Formulaire personnalisation (couleurs, logo)           │
│   - Vérification nom disponible (AJAX)                     │
│   - Preview en temps réel                                  │
└─────────────────────────────────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│              Traitement & Création                          │
│                                                             │
│   1. Upload logo → OVH S3                                  │
│   2. Insertion BDD (suscripciones_escuelas)               │
│   3. Génération docker-compose.yml                         │
│   4. Création fichier .env                                 │
│   5. Envoi email confirmation                              │
└─────────────────────────────────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────┐
│                  Déploiement Docker                         │
│                                                             │
│   URL: https://{slug}.henrimorel.com                       │
│   - Nginx + PHP-FPM                                        │
│   - MySQL dédié                                            │
│   - phpMyAdmin (localhost)                                 │
│   - SSL via Traefik/Let's Encrypt                          │
└─────────────────────────────────────────────────────────────┘
```

## Fichiers Créés

### 1. Structure PHP

| Fichier | Description |
|---------|-------------|
| `php/src/pages/suscripcion.php` | Page formulaire de souscription |
| `php/src/pages/check_nombre.php` | API AJAX vérification nom |
| `php/src/components/StorageManager.php` | Gestion OVH S3 |
| `php/src/components/DockerComposeGenerator.php` | Génération docker-compose |

### 2. Base de Données

```sql
-- Table principale
suscripciones_escuelas
  - id, nombre_escuela, slug
  - contact (nombre_director, email, telefono)
  - personnalisation (color_primario, color_secundario, logo_url)
  - période d'essai (fecha_inicio, fecha_fin, estado)
  - docker (docker_compose_content, docker_compose_path)
  - sécurité (db_name, db_user, db_password)
```

### 3. Configuration Stockage OVH

Ajoutez ces variables dans votre `.env`:

```bash
# OVH Object Storage (S3 compatible)
OVH_S3_ENDPOINT=https://s3.gra.io.cloud.ovh.net/
OVH_S3_ACCESS_KEY=votre_access_key
OVH_S3_SECRET_KEY=votre_secret_key
OVH_S3_BUCKET=tan-chu
OVH_S3_REGION=gra
```

> **Note:** Les clés OVH S3 sont disponibles dans votre espace client OVH Cloud.

## Installation

### 1. Base de Données

Le fichier `mysql/init.sql` contient la création de la table `suscripciones_escuelas` et les traductions. Elle sera créée automatiquement au démarrage des conteneurs.

Pour une mise à jour manuelle:

```bash
docker exec -i edu_mysql mysql -u edu_user -p edu_platform < mysql/init_suscripciones.sql
```

### 2. Dépendances PHP (pour OVH S3)

```bash
cd php/src
composer require aws/aws-sdk-php
```

### 3. Répertoire de déploiement

```bash
# Créer le répertoire où seront stockés les écoles
sudo mkdir -p /var/schools
sudo chown $USER:$USER /var/schools
```

## Utilisation

### Pour les utilisateurs

1. Aller sur `/inscripcion.php`
2. Cliquer sur **"🎓 Suscribir mi colegio"**
3. Remplir le formulaire avec:
   - Nom de l'école
   - Informations de contact
   - Couleurs personnalisées
   - Logo (upload vers OVH S3)
4. Valider → Email envoyé avec les accès
5. L'école reçoit une URL: `https://{nom-ecole}.henrimorel.com`

### Pour l'administrateur (déploiement)

```bash
# Après une souscription, déployer l'école
./scripts/deploy-school.sh nom-de-lecole

# Ou manuellement
cd /var/schools/{slug}
docker-compose up -d
```

## Flux de Données

```
1. Utilisateur soumet le formulaire
   │
   ├──→ Vérification nom disponible
   ├──→ Upload logo → OVH S3
   │     URL: https://tan-chu.s3.gra.io.cloud.ovh.net/logos/{slug}_{uniqid}.png
   │
   ├──→ Insertion BDD
   │     Table: suscripciones_escuelas
   │
   ├──→ Génération fichiers
   │     /var/schools/{slug}/docker-compose.yml
   │     /var/schools/{slug}/.env
   │     /var/schools/{slug}/deploy.sh
   │
   └──→ Envoi email (PHPMailer)
         SMTP Gmail configuré

2. Déploiement (manuel ou automatisé)
   │
   └──→ docker-compose up -d
         - Nginx (exposé via Traefik)
         - PHP-FPM
         - MySQL (interne)
         - phpMyAdmin (localhost)
```

## Personnalisation par École

Chaque école a ses propres variables d'environnement:

```bash
SCHOOL_NAME="Instituto Monte de los Colores"
SCHOOL_SLUG=instituto-monte-de-los-colores
SCHOOL_COLOR_PRIMARY=#2563eb
SCHOOL_COLOR_SECONDARY=#06b6d4
SCHOOL_LOGO_URL=https://tan-chu.s3.gra.io.cloud.ovh.net/logos/...
TRIAL_END_DATE=2026-05-05
```

Ces variables sont utilisées dans l'application PHP pour personnaliser:
- Les couleurs du formulaire
- Le logo affiché
- Les emails envoyés
- La date d'expiration de l'essai

## Emails Envoyés

### Email de Confirmation

Envoyé à l'adresse fournie avec:
- URL de la page d'inscription
- Date de fin d'essai
- Identifiants de base de données
- Instructions d'accès

## Sécurité

- ✅ Validation des entrées utilisateur
- ✅ Protection contre les injections SQL (PDO prepared statements)
- ✅ Upload de fichiers vérifié (type, taille)
- ✅ Mots de passe générés aléatoirement
- ✅ SSL/TLS pour tous les sous-domaines (Let's Encrypt)
- ✅ MySQL non exposé publiquement
- ✅ phpMyAdmin accessible uniquement en localhost

## Maintenance

### Vérifier les essais expirés

```sql
SELECT * FROM suscripciones_escuelas 
WHERE fecha_fin < CURDATE() 
AND estado = 'activa';
```

### Mettre à jour le statut des essais expirés

```sql
UPDATE suscripciones_escuelas 
SET estado = 'expirada' 
WHERE fecha_fin < CURDATE() 
AND estado = 'activa';
```

### Cron job suggéré (tous les jours à minuit)

```bash
0 0 * * * /usr/bin/docker exec edu_mysql mysql -u edu_user -p'password' edu_platform -e "UPDATE suscripciones_escuelas SET estado='expirada' WHERE fecha_fin < CURDATE() AND estado='activa';"
```

## Support

Pour toute question ou problème:
- Vérifier les logs: `docker-compose logs -f`
- Vérifier la BDD: phpMyAdmin sur localhost:8080
- Vérifier les emails: logs dans `/var/log/mail`
