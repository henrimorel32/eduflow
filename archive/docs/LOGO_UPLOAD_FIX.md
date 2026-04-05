# Résolution du problème d'upload de logo

## 🔴 Problème: "Error al cargar el logo"

## Causes possibles et solutions

### 1. AWS SDK non installé

Le système essaie d'utiliser AWS SDK pour PHP, mais s'il n'est pas installé, il fait un fallback vers le stockage local.

**Vérifier si AWS SDK est installé:**
```bash
cd php/src
composer show aws/aws-sdk-php
```

**Installer AWS SDK (recommandé pour production):**
```bash
cd php/src
composer require aws/aws-sdk-php
```

**Si vous ne pouvez pas installer AWS SDK**, le système fait automatiquement un fallback vers le stockage local dans `uploads/logos/`.

### 2. Répertoire uploads/logos inexistant ou non accessible

**Vérifier et créer le répertoire:**
```bash
# Sur le serveur hôte
mkdir -p php/src/uploads/logos
chmod -R 777 php/src/uploads/logos

# Ou exécuter le script de setup
./scripts/setup-production.sh
```

### 3. Variables d'environnement S3 non configurées

**Vérifier dans le conteneur PHP:**
```bash
docker exec edu_php env | grep OVH
```

**Si les variables ne sont pas définies, ajoutez-les dans docker-compose.yml:**
```yaml
services:
  php:
    environment:
      - OVH_S3_ENDPOINT=https://s3.gra.io.cloud.ovh.net/
      - OVH_S3_ACCESS_KEY=votre_access_key
      - OVH_S3_SECRET_KEY=votre_secret_key
      - OVH_S3_BUCKET=tan-chu
      - OVH_S3_REGION=gra
```

Puis redémarrez:
```bash
docker-compose down
docker-compose up -d
```

### 4. Vérifier la configuration (outil de test)

Accédez à: `https://votresite.com/test-s3.php`

Cette page affiche:
- Les variables d'environnement S3
- Si AWS SDK est installé
- Un formulaire pour tester l'upload
- Les permissions du répertoire uploads

## 🔧 Solutions rapides

### Solution A: Installer AWS SDK (recommandé)
```bash
cd php/src
composer require aws/aws-sdk-php
docker-compose restart php
```

### Solution B: Créer le répertoire uploads avec bonnes permissions
```bash
mkdir -p php/src/uploads/logos
chmod -R 777 php/src/uploads
```

### Solution C: Ignorer l'erreur de logo (déjà fait)
Le logo est maintenant optionnel - l'inscription fonctionne même sans logo.

## 📝 Logs d'erreur

Pour voir les détails de l'erreur:
```bash
docker exec edu_php tail -f /var/log/apache2/error.log
# ou
docker logs edu_php
```

## ✅ Vérification finale

Après correction:
1. Aller sur `test-s3.php` et vérifier la config
2. Essayer d'uploader un logo sur la page de souscription
3. Vérifier que l'inscription fonctionne (avec ou sans logo)
