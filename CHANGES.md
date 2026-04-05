# ✅ Template Next.js - Version Finale

## 🎨 Design "Pasos" implémenté

- **Fond dégradé sombre** : `#0f172a` → `#1e293b` → `#334155`
- **Carte avec glassmorphism** : `backdrop-filter: blur(10px)`
- **Formulaire multi-étapes** : 3 étapes avec indicateur visuel
- **Logo circulaire** : Avec fond blanc et ombre

## 🌍 Multilingue (4 langues)

| Langue | Code | Drapeau |
|--------|------|---------|
| Espagnol | es | 🇨🇴 |
| Portugais | br | 🇧🇷 |
| Anglais | en | 🇺🇸 |
| Français | fr | 🇫🇷 |

## 📋 Formulaire d'inscription (3 étapes)

### Étape 1 : Informations de l'élève
- Noms
- Apellidos  
- Fecha de nacimiento
- Grado a cursar

### Étape 2 : Informations du parent
- Nom complet du responsable
- Email
- Téléphone
- Pays / Ville / Adresse

### Étape 3 : Confirmation
- Récapitulatif
- Acceptation des termes
- Envoi + emails automatiques

## 🖼️ Logo et Favicon

- **Logo** : Récupéré depuis `SCHOOL_LOGO_URL` (S3) ou fallback local
- **Favicon** : `favicon.ico` copié depuis le site PHP
- **Container logo** : Cercle blanc avec ombre portée

## 📁 Structure ERP (prête pour évolution)

```
nextjs-template/
├── pages/
│   ├── index.js          # Inscription élève (actuel)
│   ├── _app.js           # Layout principal
│   └── api/
│       └── inscripcion.js # API enregistrement
├── public/
│   └── favicon.ico
└── package.json
```

### Futurs modules ERP (à ajouter) :
- `/dashboard` - Tableau de bord école
- `/estudiantes` - Liste des élèves
- `/profesores` - Gestion profs
- `/calificaciones` - Notes
- `/asistencia` - Présences
- `/pagos` - Paiements

## 🚀 Déploiement

```bash
# Envoi sur le serveur
scp -r nextjs-template/pages nextjs-template/public user@server:/opt/docker/apps/eduflow/nextjs-template/

# Redémarrage
cd /opt/docker/apps/demo && docker compose restart
```

## ⚠️ Problème SSL temporaire

**Status** : Rate limit Let's Encrypt (trop de tentatives)  
**Solution** : Attendre 17h43 UTC (~10 min)  
**URL** : https://demo.henrimorel.com (accessible après résolution SSL)
