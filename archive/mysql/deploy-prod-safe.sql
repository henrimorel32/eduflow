-- ============================================================
-- CONFIG ENCODAGE (ULTRA IMPORTANT)
-- ============================================================

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';

-- ============================================================
-- BONUS: éviter les galères d'échappement
-- ============================================================

SET sql_mode = REPLACE(@@sql_mode, 'NO_BACKSLASH_ESCAPES', '');

USE edu_platform;

-- ============================================================
-- TABLE (inchangée, déjà nickel)
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
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- ASTUCE PRINCIPALE 💡
-- Utiliser CHAR(39) pour les apostrophes
-- ============================================================

-- Exemple critique FR corrigé proprement
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'titulo_principal', 
 CONCAT('Créez votre propre formulaire d', CHAR(39), 'inscription'), 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- AUTRE EXEMPLE (texte long avec apostrophes)
-- ============================================================

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'explicacion',
 CONCAT(
 'Ici, vous pouvez générer votre propre page d', CHAR(39), 'inscription avec les couleurs de votre école. ',
 'La photo que vous téléchargez sera le logo de votre institution. ',
 'Nous avons juste besoin du nom de votre école et nous créerons une page dédiée et sécurisée ',
 'pour que vous puissiez profiter de la solution pendant 30 jours complètement gratuit.'
 ), 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- EMAIL (double apostrophe alternative)
-- ============================================================

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'email_invalido',
 'L''email n''est pas valide', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- EMOJIS (OK avec utf8mb4)
-- ============================================================

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'btn_suscripcion', '🎓 Inscrire mon école', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);