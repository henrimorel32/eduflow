
# 1. Docker Compose principal
docker_compose_env = '''version: '3.8'

services:
  # Serveur Web Nginx
  nginx:
    image: nginx:alpine
    container_name: edu_nginx
    ports:
      - "8081:80"
      - "443:443"
    volumes:
      - ./php/src:/var/www/html
      - ./nginx/nginx.conf:/etc/nginx/nginx.conf
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - php
    networks:
      - edu_network

  # PHP-FPM
  php:
    build:
      context: ./php
      dockerfile: Dockerfile
    container_name: edu_php
    volumes:
      - ./php/src:/var/www/html
    env_file:
      - .env
    environment:
      - DB_HOST=mysql
      - DB_PORT=3306
    depends_on:
      - mysql
    networks:
      - edu_network

  # Base de données MySQL
  mysql:
    image: mysql:8.0
    container_name: edu_mysql
    env_file:
      - .env
    volumes:
      - mysql_data:/var/lib/mysql
      - ./mysql/init.sql:/docker-entrypoint-initdb.d/init.sql
    ports:
      - "3306:3306"
    networks:
      - edu_network

  # phpMyAdmin pour la gestion de la base de données
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: edu_phpmyadmin
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
    ports:
      - "8080:80"
    depends_on:
      - mysql
    networks:
      - edu_network

volumes:
  mysql_data:

networks:
  edu_network:
    driver: bridge
'''

with open('/Users/henri/Documents/GitHub/ESchool/docker-compose.yml', 'w') as f:
    f.write(docker_compose)

print("✅ docker-compose.yml créé")
