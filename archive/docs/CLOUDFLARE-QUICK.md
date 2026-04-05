# ⚡ Cloudflare - Configuration Rapide

## ✅ Token ajouté !

Le token Cloudflare a été ajouté au fichier `.env`.

## 🔧 Dernière étape : Récupérer le Zone ID

### Méthode 1 : Via le Dashboard Cloudflare

1. Allez sur [dash.cloudflare.com](https://dash.cloudflare.com)
2. Cliquez sur votre domaine `henrimorel.com`
3. Sur la page d'accueil (à droite), vous verrez :
   ```
   Zone ID: a1b2c3d4e5f6... (une longue chaîne)
   ```
4. Copiez cette valeur

### Méthode 2 : Via l'API (avec votre token)

```bash
curl -H "Authorization: Bearer cfut_ODAxjdMm01L4yE3OI8twIqIFFmafAQQ6nK8LpwU19f112046" \
  "https://api.cloudflare.com/client/v4/zones?name=henrimorel.com" | \
  grep -o '"id":"[^"]*"' | head -1 | cut -d'"' -f4
```

## 📝 Mettre à jour le fichier .env

```bash
# Éditer le fichier
nano /opt/docker/apps/eduflow/.env

# Remplacer:
CF_ZONE_ID=a_remplir_avec_votre_zone_id

# Par votre Zone ID (exemple):
CF_ZONE_ID=abc123def456ghi789
```

## 🧪 Tester la configuration

```bash
# Aller dans le répertoire
cd /opt/docker/apps/eduflow

# Tester la connexion
./infra/scripts/test-cloudflare.sh
```

Vous devriez voir :
```
✅ Token API valide
Domaine trouvé: henrimorel.com
✅ Tests terminés!
```

## 🚀 Déployer votre première école

Une fois le Zone ID ajouté :

```bash
./infra/scripts/deploy-school.sh mi-colegio mi-colegio.henrimorel.com
```

Le script va automatiquement créer le DNS dans Cloudflare !

---

## 🔒 IMPORTANT - Sécurité

⚠️ **Votre token est confidentiel !**
- Ne le partagez jamais
- Il est déjà dans `.gitignore` (ne sera pas commit)
- En production, gardez le fichier `.env` sécurisé

## 📞 Support

Si vous avez des problèmes :
- WhatsApp: +57 320 418 1193
- Email: henri@henrimorel.com
