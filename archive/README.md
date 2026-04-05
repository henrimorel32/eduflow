# 📦 Archive - Fichiers obsolètes

Ce dossier contient les anciens fichiers conservés pour historique.
**Ne pas utiliser** - Ces fichiers ne sont plus maintenus.

## 📁 Structure

```
archive/
├── docker-compose/          # Anciens docker-compose
│   ├── docker-compose.prod.yml
│   ├── docker-compose.local.yml
│   ├── docker-compose_old.yml
│   └── ...
├── scripts-python/          # Anciens scripts Python (remplacés par Bash)
│   ├── deployProd.py
│   ├── deploiementProd.py
│   └── ...
├── mysql/                   # Anciens scripts SQL
│   ├── script2.sql
│   ├── script3.sql
│   └── ...
└── docs/                    # Anciennes documentations
    ├── DEPLOY.md
    ├── INFRA-RESUME.md
    └── ...
```

## 🗑️ Pourquoi archiver ?

- Éviter la confusion entre les versions
- Garder un historique au cas où
- Alléger la racine du projet

## ✅ Fichiers actifs (utiliser ceux-là)

| À la racine | Description |
|-------------|-------------|
| `docker-compose.yml` | Site PHP principal |
| `docker-compose.infrastructure.yml` | PostgreSQL + Redis |
| `docker-compose.school-template.yml` | Template école Next.js |
| `scripts/add-school.sh` | Ajouter une école |
| `README.md` | Documentation principale |
