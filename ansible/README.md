# Ansible - ESchool Production

Playbooks pour déployer ESchool sur Ubuntu 22.04 avec Docker 24.x et Traefik 3.2.

## Structure

```
ansible/
├── ansible.cfg              # Config Ansible
├── inventory.yml            # Inventaire (IP, user temporaire)
├── playbook-setup.yml       # Setup: sécurité + Docker 24.x
├── playbook-traefik.yml     # Install Traefik 3.2
└── playbook-app.yml         # Déployer l'app
```

## Prérequis

- Serveur Ubuntu 22.04 fraîchement installé
- IP: 57.129.104.225
- User temporaire: `ubuntu` / mot de passe: `K7mcTceW26D6`
- DNS: henrimorel.com → 57.129.104.225

## Installation

### 1. Setup initial (sécurité + Docker)

```bash
cd ansible
ansible-playbook -i inventory.yml playbook-setup.yml --ask-pass
```

Configure:
- Mise à jour Ubuntu 22.04
- User `henri` avec clés SSH
- SSH sur port 2222 (clé uniquement)
- UFW (ports 2222, 80, 443)
- Fail2ban
- Docker 24.x

### 2. Update inventory (après setup)

Modifie `inventory.yml`:
```yaml
ansible_user: henri
ansible_port: 2222
ansible_ssh_private_key_file: ~/.ssh/id_ed25519
ansible_ssh_pass: null  # ou supprimer cette ligne
```

### 3. Install Traefik 3.2

```bash
ansible-playbook -i inventory.yml playbook-traefik.yml
```

### 4. Déployer l'application

```bash
ansible-playbook -i inventory.yml playbook-app.yml
```

## Accès

- Site: https://henrimorel.com
- Dashboard: https://traefik.henrimorel.com (admin/admin)
- SSH: `ssh -p 2222 henri@57.129.104.225`

## Commandes utiles

```bash
# Vérifier les conteneurs
ssh -p 2222 henri@57.129.104.225 "docker ps"

# Logs Traefik
ssh -p 2222 henri@57.129.104.225 "docker logs traefik --tail 20"

# Logs app
ssh -p 2222 henri@57.129.104.225 "cd /opt/docker/apps/eduflow && docker compose logs -f"
```
