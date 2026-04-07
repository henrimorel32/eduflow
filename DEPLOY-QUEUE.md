# 🚀 Système de Déploiement Asynchrone

Ce document explique le fonctionnement du système de création automatique des containers Docker via une queue asynchrone.

## 📋 Architecture

```
┌─────────────────┐     ┌──────────────┐     ┌─────────────────┐
│ suscripcion.php │────▶│  DB Queue    │────▶│  Cron (1min)    │
│  (Appel API)    │     │  (MySQL)     │     │  (Bash Script)  │
└─────────────────┘     └──────────────┘     └─────────────────┘
                                                      │
                                                      ▼
                                               ┌──────────────┐
                                               │ add-school.sh│
                                               │ (Docker)     │
                                               └──────────────┘
```

## 🗂️ Fichiers

| Fichier | Description |
|---------|-------------|
| `php/src/api/deploy-school.php` | API pour ajouter une école à la queue |
| `php/src/pages/suscripcion.php` | Appelle l'API après l'inscription |
| `scripts/process-deploy-queue.sh` | Traite la queue (cron) |
| `scripts/setup-deploy-cron.sh` | Configure le cron |
| `mysql/add_deploy_queue_table.sql` | Schema des tables de queue |

## 🚀 Installation

### 1. Créer les tables

```bash
mysql -u edu_user -p edu_platform < mysql/add_deploy_queue_table.sql
```

### 2. Configurer le cron

Sur le serveur de production :

```bash
cd /opt/docker/apps/eduflow
./scripts/setup-deploy-cron.sh
```

Ou manuellement :

```bash
crontab -e
# Ajouter:
* * * * * /opt/docker/apps/eduflow/scripts/process-deploy-queue.sh >> /var/log/eduflow/cron-deploy.log 2>&1
```

## 📊 Tables de la Queue

### `school_deploy_queue`

| Champ | Description |
|-------|-------------|
| `id` | ID unique de la tâche |
| `school_id` | ID de l'école dans `suscripciones_escuelas` |
| `slug` | Slug de l'école |
| `domain` | Domaine complet (ex: ecole.henrimorel.com) |
| `name` | Nom de l'école |
| `status` | `pending`, `processing`, `completed`, `failed` |
| `attempts` | Nombre de tentatives |
| `output_log` | Logs du déploiement |
| `error_message` | Message d'erreur si échec |

### `school_deploy_history`

Archive de tous les déploiements (succès et échecs).

### Vue `school_deploy_pending`

Vue des déploiements en cours :

```sql
SELECT * FROM school_deploy_pending;
```

## 🔍 Monitoring

### Logs

```bash
# Logs du cron (toutes les exécutions)
tail -f /var/log/eduflow/cron-deploy.log

# Logs du processeur de queue (détails)
tail -f /var/log/eduflow/queue-processor.log

# Logs de création des écoles
tail -f /var/log/eduflow/school-creation.log
```

### Voir la queue en temps réel

```bash
# MySQL direct
mysql -u edu_user -p edu_platform -e "SELECT * FROM school_deploy_pending;"

# Ou plus détaillé
mysql -u edu_user -p edu_platform -e "
  SELECT id, slug, status, attempts, 
         TIMESTAMPDIFF(MINUTE, created_at, NOW()) as minutes_waiting
  FROM school_deploy_queue 
  WHERE status IN ('pending', 'processing')
  ORDER BY created_at ASC;
"
```

### Commandes utiles

```bash
# Forcer un redéploiement
mysql -u edu_user -p edu_platform -e "
  UPDATE school_deploy_queue 
  SET status='pending', attempts=0 
  WHERE school_id=123;
"

# Voir l'historique d'une école
mysql -u edu_user -p edu_platform -e "
  SELECT * FROM school_deploy_history 
  WHERE school_id=123 
  ORDER BY created_at DESC;
"
```

## ⚙️ Configuration

### Variables d'environnement

Le script `process-deploy-queue.sh` utilise :

| Variable | Défaut | Description |
|----------|--------|-------------|
| `DB_HOST` | `mysql` | Hôte MySQL |
| `DB_NAME` | `edu_platform` | Nom de la BDD |
| `DB_USER` | `edu_user` | Utilisateur MySQL |
| `DB_PASS` | (depuis .env) | Mot de passe |

### Paramètres modifiables

Dans `process-deploy-queue.sh` :

```bash
MAX_ATTEMPTS=3        # Tentatives max avant échec
LIMIT=5               # Écoles traitées par cycle
```

## 🔄 Flux de données

1. **Inscription** (`suscripcion.php`)
   - Valide les données
   - Insère dans `suscripciones_escuelas`
   - Insère dans PostgreSQL
   - Appelle `addToDeployQueue()` → API

2. **API** (`api/deploy-school.php`)
   - Vérifie les données
   - Vérifie pas de doublon
   - INSERT dans `school_deploy_queue` (status='pending')

3. **Cron** (toutes les minutes)
   - Récupère les écoles `status='pending'`
   - Pour chaque école:
     - UPDATE status='processing'
     - Appelle `add-school.sh`
     - UPDATE status='completed' ou 'failed'
     - INSERT dans `school_deploy_history`

## 🛠️ Dépannage

### Problème: Le déploiement ne démarre pas

```bash
# Vérifier que le cron tourne
crontab -l | grep process-deploy

# Vérifier les logs
tail /var/log/eduflow/cron-deploy.log

# Tester manuellement
./scripts/process-deploy-queue.sh
```

### Problème: Échec répété

```bash
# Voir les erreurs
mysql -u edu_user -p edu_platform -e "
  SELECT slug, error_message, attempts 
  FROM school_deploy_queue 
  WHERE status='failed';
"

# Tester le script de création manuellement
./scripts/add-school.sh <slug> <domain> "<name>"
```

### Problème: Lock bloqué

```bash
# Si le lock est resté bloqué
rm -f /tmp/eduflow-deploy-queue.lock
```

## 📝 Notes de sécurité

- ✅ Le container PHP n'a **pas** accès à Docker
- ✅ Le script de queue tourne sur l'hôte avec les droits nécessaires
- ✅ Limitation de 5 écoles par cycle (évite surcharge)
- ✅ Max 3 tentatives avant échec définitif
- ✅ Lock file évite les exécutions simultanées
- ✅ Logs complets pour audit

## 🔄 Processus manuel (si besoin)

Si vous devez créer une école manuellement sans passer par la queue :

```bash
# Sur le serveur
cd /opt/docker/apps/eduflow
./scripts/add-school.sh <slug> <domain> "<nom>"

# Exemple:
./scripts/add-school.sh colegio-san-jose colegiosanjose.henrimorel.com "Colegio San José"
```
