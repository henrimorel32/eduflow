-- ============================================================
-- CONFIG ENCODAGE (OBLIGATOIRE)
-- ============================================================

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';

USE edu_platform;

-- ============================================================
-- TABLES (inchangées, déjà propres)
-- ============================================================

CREATE TABLE IF NOT EXISTS suscripciones_escuelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_escuela VARCHAR(150) NOT NULL UNIQUE,
    slug VARCHAR(150) NOT NULL UNIQUE,
    nombre_director VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    ciudad VARCHAR(100),
    pais VARCHAR(2) DEFAULT 'CO',
    color_primario VARCHAR(7) DEFAULT '#2563eb',
    color_secundario VARCHAR(7) DEFAULT '#06b6d4',
    logo_url VARCHAR(500),
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_fin DATE NOT NULL,
    estado ENUM('activa', 'expirada', 'convertida', 'suspendida') DEFAULT 'activa',
    docker_compose_content TEXT,
    docker_compose_path VARCHAR(500),
    db_name VARCHAR(50),
    db_user VARCHAR(50),
    db_password VARCHAR(100),
    ip_registro VARCHAR(45),
    user_agent TEXT,
    notas_admin TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_estado (estado),
    INDEX idx_fecha_fin (fecha_fin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contenido_web (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seccion VARCHAR(50) NOT NULL,
    clave VARCHAR(50) NOT NULL,
    valor TEXT,
    idioma VARCHAR(5) DEFAULT 'es',
    ultima_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- CONTENU + TRADUCTIONS (CORRIGÉ)
-- ============================================================

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES

-- HERO
('hero', 'titulo_principal', 'Transforma la gestión de tu colegio sin complicarte la vida', 'es'),
('hero', 'subtitulo', 'Menos desorden, más control. Organiza tu colegio y mejora la experiencia de padres y estudiantes.', 'es'),
('hero', 'cta_principal', 'Solicita tu diagnóstico gratuito', 'es'),
('hero', 'cta_secundaria', 'Ver cómo funciona', 'es'),

-- SUSCRIPCION (FR corrigé)
('suscripcion', 'titulo_principal', 'Créez votre propre formulaire d''inscription', 'fr'),

('suscripcion', 'explicacion',
'Ici, vous pouvez générer votre propre page d''inscription avec les couleurs de votre école. La photo que vous téléchargez sera le logo de votre institution. Nous avons juste besoin du nom de votre école et nous créerons une page dédiée et sécurisée pour que vous puissiez profiter de la solution pendant 30 jours complètement gratuit.',
'fr'),

('suscripcion', 'label_nombre_escuela', 'Nom de l''école', 'fr'),
('suscripcion', 'label_logo', 'Logo de l''école', 'fr'),

('suscripcion', 'boton_crear', 'Créer ma page d''inscription', 'fr'),

('suscripcion', 'exito_mensaje',
'Nous avons envoyé un e-mail avec les détails d''accès. Votre période d''essai se termine le:',
'fr'),

('suscripcion', 'ir_a_pagina', 'Aller à ma page d''inscription', 'fr'),

('suscripcion', 'info_trial', 'Période d''essai: 30 jours', 'fr'),

('suscripcion', 'email_invalido', 'L''email n''est pas valide', 'fr'),

-- HERO bouton (emoji OK)
('hero', 'btn_suscripcion', '🎓 Inscrire mon école', 'fr'),
('hero', 'btn_suscripcion_sub', 'Essai gratuit de 30 jours', 'fr');
