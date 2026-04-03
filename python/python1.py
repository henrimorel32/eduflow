
import os

# Création de la structure de dossiers
folders = [
    "/Users/henri/Documents/GitHub/ESchool",
    "/Users/henri/Documents/GitHub/ESchool/php",
    "/Users/henri/Documents/GitHub/ESchool/mysql",
    "/Users/henri/Documents/GitHub/ESchool/nginx",
    "/Users/henri/Documents/GitHub/ESchool/php/src",
    "/Users/henri/Documents/GitHub/ESchool/php/src/assets",
    "/Users/henri/Documents/GitHub/ESchoolphp/src/assets/css",
    "/Users/henri/Documents/GitHub/ESchool/php/src/assets/js",
    "/Users/henri/Documents/GitHub/ESchoolphp/src/assets/images",
    "/Users/henri/Documents/GitHub/ESchool/php/src/includes"
]

for folder in folders:
    os.makedirs(folder, exist_ok=True)
    print(f"✓ Created: {folder}")

print("\n✅ Structure de dossiers créée avec succès!")
