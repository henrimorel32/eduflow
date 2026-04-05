
# 10. Fichier .gitignore
gitignore = '''# Environment variables
.env

# Docker
.docker/

# IDE
.vscode/
.idea/
*.swp
*.swo

# OS
.DS_Store
Thumbs.db

# Logs
*.log
logs/

# Dependencies
vendor/
node_modules/

# Uploads
uploads/
'''

with open('/Users/henri/Documents/GitHub/ESchool/.gitignore', 'w') as f:
    f.write(gitignore)

print("✅ Fichier .gitignore créé")
