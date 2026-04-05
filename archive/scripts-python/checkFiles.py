
# Résumé final de tous les fichiers créés
import os

print("=" * 70)
print("   FICHIERS DE DÉPLOIEMENT PRODUCTION CRÉÉS")
print("=" * 70)
print()

files = {
    "deploy-eduflow-prod.sh": "Script principal de déploiement automatisé avec Certbot",
    "GUIDE_DEPLOIEMENT.md": "Documentation complète d'utilisation",
    "health-check.sh": "Script de vérification post-déploiement"
}

for filename, description in files.items():
    filepath = f"/mnt/kimi/output/{filename}"
    if os.path.exists(filepath):
        size = os.path.getsize(filepath)
        print(f"📄 {filename}")
        print(f"   └─ {description}")
        print(f"   └─ Taille: {size:,} octets")
        print()

print("=" * 70)
print("UTILISATION:")
print("=" * 70)
print()
print("1. Copier deploy-eduflow-prod.sh sur votre serveur:")
print("   scp deploy-eduflow-prod.sh root@votre-serveur.com:/root/")
print()
print("2. Connectez-vous en SSH et exécutez:")
print("   ssh root@votre-serveur.com")
print("   chmod +x deploy-eduflow-prod.sh")
print("   ./deploy-eduflow-prod.sh")
print()
print("3. Suivez les instructions à l'écran")
print()
print("=" * 70)
