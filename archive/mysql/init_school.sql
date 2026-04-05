-- ============================================================
-- Initialisation de la base de données pour une école
-- Ce fichier est exécuté automatiquement par MySQL au premier démarrage
-- ============================================================

-- Utiliser la base créée par docker-compose
USE ${MYSQL_DATABASE};

-- ============================================================
-- TABLE: inscripciones
-- Stocke les inscriptions des élèves
-- ============================================================
CREATE TABLE IF NOT EXISTS inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idioma_inscripcion VARCHAR(5) DEFAULT 'es',
    
    -- Données de l'élève
    alumno_nombres VARCHAR(100) NOT NULL,
    alumno_apellido1 VARCHAR(50) NOT NULL,
    alumno_apellido2 VARCHAR(50),
    alumno_fecha_nacimiento DATE,
    alumno_nacionalidad VARCHAR(50),
    alumno_grado_inscripcion VARCHAR(50),
    
    -- École précédente
    alumno_anterior_institucion VARCHAR(150),
    alumno_anterior_ciudad VARCHAR(100),
    alumno_anterior_pais VARCHAR(2),
    
    -- Acudiente principal
    acudiente1_nombres VARCHAR(100) NOT NULL,
    acudiente1_apellido1 VARCHAR(50) NOT NULL,
    acudiente1_apellido2 VARCHAR(50),
    acudiente1_direccion VARCHAR(200),
    acudiente1_ciudad VARCHAR(100),
    acudiente1_profesion VARCHAR(100),
    acudiente1_empresa VARCHAR(100),
    acudiente1_pais VARCHAR(2),
    acudiente1_prefijo VARCHAR(5),
    acudiente1_telefono VARCHAR(20),
    acudiente1_email VARCHAR(100),
    acudiente1_parentesco VARCHAR(50),
    
    -- Acudiente secondaire
    acudiente2_nombres VARCHAR(100),
    acudiente2_apellido1 VARCHAR(50),
    acudiente2_apellido2 VARCHAR(50),
    acudiente2_direccion VARCHAR(200),
    acudiente2_ciudad VARCHAR(100),
    acudiente2_profesion VARCHAR(100),
    acudiente2_empresa VARCHAR(100),
    acudiente2_pais VARCHAR(2),
    acudiente2_prefijo VARCHAR(5),
    acudiente2_telefono VARCHAR(20),
    acudiente2_email VARCHAR(100),
    acudiente2_parentesco VARCHAR(50),
    
    -- Documents
    archivo_boletin_1 VARCHAR(500),
    archivo_boletin_2 VARCHAR(500),
    archivo_boletin_3 VARCHAR(500),
    archivo_carta_motivacion VARCHAR(500),
    
    -- Statut
    estado_inscripcion ENUM('pendiente', 'revision', 'aprobada', 'rechazada') DEFAULT 'pendiente',
    observaciones TEXT,
    
    INDEX idx_fecha (fecha_inscripcion),
    INDEX idx_estado (estado_inscripcion),
    INDEX idx_grado (alumno_grado_inscripcion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: contenido_web
-- Contenu traduisible du site
-- ============================================================
CREATE TABLE IF NOT EXISTS contenido_web (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seccion VARCHAR(50) NOT NULL,
    clave VARCHAR(50) NOT NULL,
    valor TEXT,
    idioma VARCHAR(5) DEFAULT 'es',
    ultima_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    UNIQUE KEY unique_traduccion (seccion, clave, idioma)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- TABLE: configuracion_escuela
-- Configuration spécifique de l'école
-- ============================================================
CREATE TABLE IF NOT EXISTS configuracion_escuela (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(50) NOT NULL UNIQUE,
    valor TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion de la configuration par défaut
INSERT INTO configuracion_escuela (clave, valor) VALUES
('school_name', '${SCHOOL_NAME}'),
('school_slug', '${SCHOOL_SLUG}'),
('color_primary', '${SCHOOL_COLOR_PRIMARY}'),
('color_secondary', '${SCHOOL_COLOR_SECONDARY}'),
('logo_url', '${SCHOOL_LOGO_URL}'),
('trial_end_date', '${TRIAL_END_DATE}'),
('email_contacto', '${EMAIL_CONTACTO}'),
('telefono_contacto', '${TELEFONO_CONTACTO}')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- Insertion des traductions par défaut
-- ============================================================

-- Espagnol (défaut)
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'badge_demo', 'Demo gratuita', 'es'),
('hero', 'hero_titulo', 'Sistema de Inscripciones', 'es'),
('hero', 'hero_subtitulo', 'Complete el formulario para inscribir a su hijo', 'es'),
('hero', 'hero_boton', 'Comenzar inscripción', 'es'),
('hero', 'hero_email_label', 'Ingrese su correo para comenzar', 'es'),
('hero', 'hero_email_placeholder', 'su@email.com', 'es'),
('hero', 'hero_email_hint', 'Usaremos este correo para enviarle la confirmación', 'es'),

('paso', 'paso_acudiente1', 'Acudiente Principal', 'es'),
('paso', 'paso_acudiente2', 'Acudiente Secundario', 'es'),
('paso', 'paso_alumno', 'Datos del Alumno', 'es'),
('paso', 'paso_documentos', 'Documentos', 'es'),

('confirmacion', 'gracias_inscripcion', '¡Gracias por su inscripción!', 'es'),
('confirmacion', 'mensaje_exito', 'Hemos recibido su solicitud. Pronto nos pondremos en contacto.', 'es')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Portugais
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'badge_demo', 'Demo gratuita', 'br'),
('hero', 'hero_titulo', 'Sistema de Inscrições', 'br'),
('hero', 'hero_subtitulo', 'Preencha o formulário para matricular seu filho', 'br'),
('hero', 'hero_boton', 'Começar inscrição', 'br'),
('hero', 'hero_email_label', 'Digite seu e-mail para começar', 'br'),
('hero', 'hero_email_placeholder', 'seu@email.com', 'br'),
('hero', 'hero_email_hint', 'Usaremos este e-mail para enviar a confirmação', 'br'),

('paso', 'paso_acudiente1', 'Responsável Principal', 'br'),
('paso', 'paso_acudiente2', 'Responsável Secundário', 'br'),
('paso', 'paso_alumno', 'Dados do Aluno', 'br'),
('paso', 'paso_documentos', 'Documentos', 'br'),

('confirmacion', 'gracias_inscripcion', 'Obrigado pela sua inscrição!', 'br'),
('confirmacion', 'mensaje_exito', 'Recebemos sua solicitação. Entraremos em contato em breve.', 'br')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Anglais
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'badge_demo', 'Free Demo', 'en'),
('hero', 'hero_titulo', 'Enrollment System', 'en'),
('hero', 'hero_subtitulo', 'Complete the form to enroll your child', 'en'),
('hero', 'hero_boton', 'Start enrollment', 'en'),
('hero', 'hero_email_label', 'Enter your email to start', 'en'),
('hero', 'hero_email_placeholder', 'your@email.com', 'en'),
('hero', 'hero_email_hint', 'We will use this email to send you confirmation', 'en'),

('paso', 'paso_acudiente1', 'Primary Guardian', 'en'),
('paso', 'paso_acudiente2', 'Secondary Guardian', 'en'),
('paso', 'paso_alumno', 'Student Information', 'en'),
('paso', 'paso_documentos', 'Documents', 'en'),

('confirmacion', 'gracias_inscripcion', 'Thank you for your enrollment!', 'en'),
('confirmacion', 'mensaje_exito', 'We have received your request. We will contact you soon.', 'en')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Français
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'badge_demo', 'Démo gratuite', 'fr'),
('hero', 'hero_titulo', 'Système d\'Inscription', 'fr'),
('hero', 'hero_subtitulo', 'Remplissez le formulaire pour inscrire votre enfant', 'fr'),
('hero', 'hero_boton', 'Commencer l\'inscription', 'fr'),
('hero', 'hero_email_label', 'Entrez votre email pour commencer', 'fr'),
('hero', 'hero_email_placeholder', 'votre@email.com', 'fr'),
('hero', 'hero_email_hint', 'Nous utiliserons cet email pour vous envoyer la confirmation', 'fr'),

('paso', 'paso_acudiente1', 'Responsable Principal', 'fr'),
('paso', 'paso_acudiente2', 'Responsable Secondaire', 'fr'),
('paso', 'paso_alumno', 'Informations de l\'Élève', 'fr'),
('paso', 'paso_documentos', 'Documents', 'fr'),

('confirmacion', 'gracias_inscripcion', 'Merci pour votre inscription!', 'fr'),
('confirmacion', 'mensaje_exito', 'Nous avons reçu votre demande. Nous vous contacterons bientôt.', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);
