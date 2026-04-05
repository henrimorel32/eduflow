
# 4. Script d'initialisation MySQL
init_sql = '''-- Base de données pour la plateforme éducative
USE edu_platform;

-- Table pour les contacts/leads
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    colegio VARCHAR(150),
    cargo VARCHAR(100),
    telefono VARCHAR(20),
    mensaje TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('nuevo', 'contactado', 'en_proceso', 'convertido') DEFAULT 'nuevo'
);

-- Table pour les écoles partenaires
CREATE TABLE IF NOT EXISTS colegios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    direccion VARCHAR(200),
    ciudad VARCHAR(100),
    telefono VARCHAR(20),
    email VARCHAR(100),
    director VARCHAR(100),
    cantidad_estudiantes INT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo', 'inactivo', 'prueba') DEFAULT 'prueba'
);

-- Table pour le contenu de la page (sections modifiables)
CREATE TABLE IF NOT EXISTS contenido_web (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seccion VARCHAR(50) NOT NULL,
    clave VARCHAR(50) NOT NULL,
    valor TEXT,
    idioma VARCHAR(5) DEFAULT 'es',
    ultima_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertion du contenu initial de la homepage
INSERT INTO contenido_web (seccion, clave, valor) VALUES
('hero', 'titulo_principal', 'Transforma la gestión de tu colegio sin complicarte la vida'),
('hero', 'subtitulo', 'Menos desorden, más control. Organiza tu colegio y mejora la experiencia de padres y estudiantes.'),
('hero', 'cta_principal', 'Solicita tu diagnóstico gratuito'),
('hero', 'cta_secundaria', 'Ver cómo funciona'),

('problematica', 'titulo', '¿Tu equipo pierde tiempo entre WhatsApp, correos y Excel?'),
('problematica', 'descripcion', 'La información está en todas partes... menos donde debería estar.'),

('solucion', 'titulo', 'Te ayudamos a estructurar, organizar y digitalizar tu colegio paso a paso'),
('solucion', 'subtitulo', 'No es solo tecnología, es una nueva forma de trabajar.'),

('beneficios', 'titulo', 'Más tiempo para educar, menos estrés administrativo'),
('beneficios', 'item_1', 'Orden y claridad en todos los procesos'),
('beneficios', 'item_2', 'Comunicación fluida con las familias'),
('beneficios', 'item_3', 'Control y visibilidad total'),
('beneficios', 'item_4', 'Tranquilidad para tu equipo'),

('testimonios', 'titulo', 'Colegios que ya transformaron su gestión'),

('cta_final', 'titulo', '¿Listo para organizar tu colegio?'),
('cta_final', 'subtitulo', 'Comienza con un diagnóstico gratuito de tu situación actual.'),
('cta_final', 'boton', 'Agenda tu diagnóstico ahora');
'''

with open('/Users/henri/Documents/GitHub/ESchool/mysql/init.sql', 'w') as f:
    f.write(init_sql)

print("✅ Script SQL d'initialisation créé")
