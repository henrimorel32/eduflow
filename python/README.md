# EduFlow - Plataforma de Transformación Digital Educativa

Sistema de gestión escolar moderno construido con PHP, MySQL y Docker.

## 🚀 Características

- **Homepage optimizada** para conversión de leads de colegios privados
- **Diseño responsive** con Tailwind CSS
- **Base de datos MySQL** para gestión de contactos y contenido dinámico
- **Panel phpMyAdmin** para administración de la base de datos
- **Arquitectura Docker** lista para producción

## 📋 Requisitos

- Docker Engine 20.10+
- Docker Compose 2.0+
- 2GB RAM mínimo
- Puertos disponibles: 80, 8080, 3306

## 🛠️ Instalación

1. **Clonar o descargar el proyecto:**
```bash
cd docker-edu-platform
```

2. **Iniciar los contenedores:**
```bash
docker-compose up -d --build
```

3. **Verificar que todo está funcionando:**
```bash
docker-compose ps
```

4. **Acceder a la aplicación:**
   - **Website:** http://localhost
   - **phpMyAdmin:** http://localhost:8080
     - Usuario: `edu_user`
     - Contraseña: `edu_password`

## 📁 Estructura del Proyecto

```
docker-edu-platform/
├── docker-compose.yml          # Configuración de servicios Docker
├── README.md                   # Este archivo
├── mysql/
│   └── init.sql               # Script de inicialización de la BD
├── nginx/
│   ├── nginx.conf             # Configuración principal Nginx
│   └── default.conf           # Configuración del servidor virtual
└── php/
    ├── Dockerfile             # Configuración del contenedor PHP
    └── src/                   # Código fuente de la aplicación
        ├── index.php          # Homepage principal
        ├── procesar_contacto.php  # API para formulario
        └── includes/
            └── config.php     # Configuración de base de datos
```

## 🗄️ Base de Datos

### Tablas principales:

1. **contacts** - Almacena los leads del formulario de contacto
2. **colegios** - Información de colegios registrados
3. **contenido_web** - Contenido editable de la homepage (CMS básico)

### Acceso a la base de datos:
- **Host:** `mysql` (dentro de la red Docker) o `localhost:3306` (desde fuera)
- **Database:** `edu_platform`
- **Usuario:** `edu_user`
- **Password:** `edu_password`

## 🎨 Personalización del Contenido

El contenido de la homepage se puede modificar directamente en la base de datos:

```sql
-- Ejemplo: Cambiar el título principal
UPDATE contenido_web 
SET valor = 'Nuevo título aquí' 
WHERE seccion = 'hero' AND clave = 'titulo_principal';
```

## 🔧 Comandos Útiles

```bash
# Ver logs
docker-compose logs -f

# Ver logs de un servicio específico
docker-compose logs -f php

# Reiniciar servicios
docker-compose restart

# Detener todo
docker-compose down

# Detener y eliminar volúmenes (⚠️ borra la base de datos)
docker-compose down -v

# Acceder al contenedor PHP
docker exec -it edu_php bash

# Acceder al contenedor MySQL
docker exec -it edu_mysql mysql -u edu_user -p edu_platform
```

## 🌐 Configuración para Producción

1. **Cambiar contraseñas** en `docker-compose.yml`:
   - `MYSQL_ROOT_PASSWORD`
   - `MYSQL_PASSWORD`
   - `DB_PASS`

2. **Configurar SSL** en `nginx/default.conf`:
```nginx
server {
    listen 443 ssl http2;
    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;
    # ... resto de la configuración
}
```

3. **Variables de entorno** - Crear archivo `.env`:
```env
DB_HOST=mysql
DB_NAME=edu_platform
DB_USER=edu_user
DB_PASS=tu_password_seguro
```

## 📝 SEO y Marketing

La homepage está optimizada con:
- **Meta descripción** enfocada en transformación digital educativa
- **Keywords:** gestión escolar, modernización de colegios, organización escolar
- **Estructura semántica** HTML5
- **Open Graph** tags para redes sociales
- **Performance** optimizada con lazy loading

## 🐛 Troubleshooting

### Problema: "Error de conexión a la base de datos"
**Solución:** Esperar 30 segundos después de `docker-compose up` para que MySQL termine de inicializarse.

### Problema: Permisos de archivos
**Solución:**
```bash
docker exec -it edu_php chown -R www-data:www-data /var/www/html
```

### Problema: Puerto 80 ocupado
**Solución:** Cambiar el puerto en `docker-compose.yml`:
```yaml
ports:
  - "8081:80"  # Usar puerto 8081 en lugar de 80
```

## 📞 Soporte

Para soporte técnico o consultas comerciales:
- Email: hola@eduflow.co
- Teléfono: +57 (1) 234 5678

---

**EduFlow** - Aliado en la organización y modernización de colegios 🎓
