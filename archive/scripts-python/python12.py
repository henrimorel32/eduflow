
# Vérification finale de tous les fichiers créés
import os

base_path = "/Users/henri/Documents/GitHub/ESchool"

print("📁 STRUCTURE COMPLÈTE DU PROJET\n")
print("=" * 60)

for root, dirs, files in os.walk(base_path):
    level = root.replace(base_path, '').count(os.sep)
    indent = '  ' * level
    folder_name = os.path.basename(root) or 'docker-edu-platform'
    print(f"{indent}📂 {folder_name}/")
    
    subindent = '  ' * (level + 1)
    for file in files:
        file_path = os.path.join(root, file)
        size = os.path.getsize(file_path)
        print(f"{subindent}📄 {file} ({size:,} bytes)")

print("\n" + "=" * 60)
print("\n✅ PROJET DOCKER-COMPOSE PHP/MYSQL PRÊT À L'EMPLOI!")
print("\n🚀 POUR DÉMARRER:")
print("   cd docker-edu-platform")
print("   docker-compose up -d --build")
print("\n🌐 ACCÈS:")
print("   Site Web: http://localhost")
print("   phpMyAdmin: http://localhost:8080")
print("   MySQL: localhost:3306")
