# Configuration Cloudflare pour ESchool

## 1. Créer un compte / Se connecter

Allez sur [cloudflare.com](https://cloudflare.com) et ajoutez votre domaine `henrimorel.com`

## 2. Configuration DNS de Base

### Record A (obligatoire)
| Type | Nom | Contenu | Proxy |
|------|-----|---------|-------|
| A | @ (ou henrimorel.com) | IP_DE_VOTRE_SERVEUR | 🟠 Proxied |

> **Note:** Remplacez `IP_DE_VOTRE_SERVEUR` par l'IP publique de votre serveur VPS

### Record CNAME (www)
| Type | Nom | Contenu | Proxy |
|------|-----|---------|-------|
| CNAME | www | henrimorel.com | 🟠 Proxied |

### Records pour les écoles (exemples)
| Type | Nom | Contenu | Proxy |
|------|-----|---------|-------|
| CNAME | colegio-san-jose | henrimorel.com | 🟠 Proxied |
| CNAME | instituto-monte | henrimorel.com | 🟠 Proxied |
| CNAME | traefik | henrimorel.com | 🟠 Proxied |

## 3. SSL/TLS Settings

Dans Cloudflare Dashboard :
1. Allez dans **SSL/TLS** → **Overview**
2. Sélectionnez : **Full (strict)**

### Explication :
- **Flexible** ❌ - Cloudflare → Serveur en HTTP (pas sécurisé)
- **Full** ✅ - Cloudflare → Serveur en HTTPS (certificat auto-signé OK)
- **Full (strict)** ✅✅ - Cloudflare → Serveur en HTTPS (certificat valide requis)

## 4. Toujours utiliser HTTPS

Dans **SSL/TLS** → **Edge Certificates** :
- ✅ **Always Use HTTPS** : ON
- ✅ **Automatic HTTPS Rewrites** : ON

## 5. API Token (pour création automatique DNS)

### Créer un Token API

1. Dans Cloudflare Dashboard, allez dans **Mon profil** (icône en haut à droite)
2. Allez dans **API Tokens**
3. Cliquez **Create Token**
4. Cliquez **Use template** pour "Edit zone DNS"
5. Configurez :
   - **Token name** : `ESchool DNS Management`
   - **Permissions** :
     - Zone : DNS : Edit
   - **Zone Resources** :
     - Include : Specific zone : henrimorel.com
6. Cliquez **Continue to summary** puis **Create Token**
7. **Copiez le token** immédiatement (il ne s'affiche qu'une fois)

### Récupérer le Zone ID

1. Dans Cloudflare Dashboard, allez dans votre domaine `henrimorel.com`
2. En bas à droite de la page d'accueil (Zone ID)
3. Copiez la valeur (ex: `a1b2c3d4e5f6...`)

## 6. Configuration dans le projet

### Éditer le fichier `.env`

```bash
cd /opt/docker/apps/eduflow
nano .env
```

### Ajouter les variables Cloudflare

```bash
# Cloudflare API
CF_API_TOKEN=votre_token_copié_ici
CF_ZONE_ID=votre_zone_id_ici
```

## 7. Test de l'API

### Test manuel

```bash
# Remplacez par vos valeurs
CF_API_TOKEN="votre_token"
CF_ZONE_ID="votre_zone_id"

# Créer un CNAME de test
curl -X POST "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID/dns_records" \
  -H "Authorization: Bearer $CF_API_TOKEN" \
  -H "Content-Type: application/json" \
  --data '{
    "type": "CNAME",
    "name": "test",
    "content": "henrimorel.com",
    "ttl": 1,
    "proxied": true
  }'
```

### Si ça fonctionne

Vous devriez voir apparaître dans Cloudflare un record `test.henrimorel.com`

## 8. Déploiement automatique avec Cloudflare

Maintenant quand vous déployez une école :

```bash
./infra/scripts/deploy-school.sh colegio-san-jose colegiosanjose.henrimorel.com
```

Le script va automatiquement créer le CNAME dans Cloudflare !

## 9. Vérification

### Vérifier le DNS

```bash
# Attendre 1-2 minutes puis tester
dig colegio-san-jose.henrimorel.com

# Ou avec nslookup
nslookup colegio-san-jose.henrimorel.com
```

### Vérifier HTTPS

```bash
curl -I https://colegio-san-jose.henrimorel.com
```

## 10. Dépannage

### Problème : "Error 525 SSL Handshake Failed"

**Solution :** Dans Cloudflare, allez dans **SSL/TLS** → **Overview** et changez en **Full** (pas strict) pendant les tests.

### Problème : "DNS_PROBE_FINISHED_NXDOMAIN"

**Solution :** Attendre 5-10 minutes pour la propagation DNS. Ou vérifier que le record est bien créé dans Cloudflare.

### Problème : Le script ne crée pas le DNS

**Vérifier :**
```bash
# Vérifier que les variables sont définies
docker exec edu_php env | grep CF_

# Vérifier le token
curl -s -H "Authorization: Bearer $CF_API_TOKEN" \
  "https://api.cloudflare.com/client/v4/zones/$CF_ZONE_ID/dns_records" | head
```

## Résumé des étapes

1. ✅ Ajouter domaine dans Cloudflare
2. ✅ Configurer record A vers IP serveur
3. ✅ Mettre SSL/TLS sur "Full (strict)"
4. ✅ Créer API Token avec permissions DNS
5. ✅ Copier Zone ID et Token dans `.env`
6. ✅ Déployer avec le script

C'est prêt ! 🚀
