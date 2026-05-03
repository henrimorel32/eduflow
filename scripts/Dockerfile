FROM node:20-alpine

WORKDIR /app

# Copier les fichiers de dépendances
COPY package.json ./
RUN npm install --omit=dev

# Copier le code source
COPY . .

# Créer le répertoire pour les applications écoles
RUN mkdir -p /opt/docker/apps

CMD ["node", "worker.js"]
