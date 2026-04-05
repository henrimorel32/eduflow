-- ============================================================
-- SCRIPT DE DEPLOIEMENT PRODUCTION - Système de Souscription
-- Exécuter ce script sur la base de données de production
-- ============================================================
-- Ce script crée:
-- 1. La table suscripciones_escuelas
-- 2. Toutes les traductions pour la page de souscription (4 langues)
-- 3. Les traductions pour le bouton sur la page d'inscription
-- ============================================================

USE edu_platform;

-- ============================================================
-- 1. CREATION DE LA TABLE: suscripciones_escuelas
-- ============================================================

CREATE TABLE IF NOT EXISTS suscripciones_escuelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Identité de l'école
    nombre_escuela VARCHAR(150) NOT NULL UNIQUE,
    slug VARCHAR(150) NOT NULL UNIQUE,
    
    -- Contact
    nombre_director VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    
    -- Localisation
    direccion VARCHAR(200),
    ciudad VARCHAR(100),
    pais VARCHAR(2) DEFAULT 'CO',
    
    -- Personnalisation
    color_primario VARCHAR(7) DEFAULT '#2563eb',
    color_secundario VARCHAR(7) DEFAULT '#06b6d4',
    logo_url VARCHAR(500),
    
    -- Période d'essai
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_fin DATE NOT NULL,
    estado ENUM('activa', 'expirada', 'convertida', 'suspendida') DEFAULT 'activa',
    
    -- Docker Compose généré
    docker_compose_content TEXT,
    docker_compose_path VARCHAR(500),
    
    -- Identifiants générés
    db_name VARCHAR(50),
    db_user VARCHAR(50),
    db_password VARCHAR(100),
    
    -- Métadonnées
    ip_registro VARCHAR(45),
    user_agent TEXT,
    notas_admin TEXT,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_slug (slug),
    INDEX idx_estado (estado),
    INDEX idx_fecha_fin (fecha_fin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 2. TRADUCTIONS: Page de Souscription (suscripcion)
-- ============================================================

-- Titre de page
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'titulo_pagina', 'Suscribir mi colegio - Prueba gratuita de 30 días', 'es'),
('suscripcion', 'titulo_pagina', 'Assinar minha escola - Teste gratuito de 30 dias', 'br'),
('suscripcion', 'titulo_pagina', 'Subscribe my school - 30 days free trial', 'en'),
('suscripcion', 'titulo_pagina', 'Inscrire mon école - Essai gratuit de 30 jours', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Titre principal
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'titulo_principal', 'Crea tu propio formulario de inscripción', 'es'),
('suscripcion', 'titulo_principal', 'Crie seu próprio formulário de inscrição', 'br'),
('suscripcion', 'titulo_principal', 'Create your own enrollment form', 'en'),
('suscripcion', 'titulo_principal', 'Créez votre propre formulaire d\'inscription', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Sous-titre
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'subtitulo', 'Personaliza los colores, sube tu logo y genera una página dedicada para tu colegio. Prueba gratuita de 30 días.', 'es'),
('suscripcion', 'subtitulo', 'Personalize as cores, faça upload do seu logotipo e gere uma página dedicada para sua escola. Teste gratuito de 30 dias.', 'br'),
('suscripcion', 'subtitulo', 'Customize colors, upload your logo and generate a dedicated page for your school. 30 days free trial.', 'en'),
('suscripcion', 'subtitulo', 'Personnalisez les couleurs, téléchargez votre logo et générez une page dédiée pour votre école. Essai gratuit de 30 jours.', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Explication
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'explicacion', 'Aquí puedes generar tu propia página de inscripción con los colores de tu colegio. La foto que subas será el logo de tu institución. Solo necesitamos el nombre de tu colegio y crearemos una página dedicada y segura para que disfrutes de la solución durante 30 días completamente gratis.', 'es'),
('suscripcion', 'explicacion', 'Aqui você pode gerar sua própria página de inscrição com as cores da sua escola. A foto que você enviar será o logotipo da sua instituição. Precisamos apenas do nome da sua escola e criaremos uma página dedicada e segura para você aproveitar a solução por 30 dias completamente grátis.', 'br'),
('suscripcion', 'explicacion', 'Here you can generate your own enrollment page with your school colors. The photo you upload will be your institution\'s logo. We just need your school name and we\'ll create a dedicated, secure page for you to enjoy the solution for 30 days completely free.', 'en'),
('suscripcion', 'explicacion', 'Ici, vous pouvez générer votre propre page d\'inscription avec les couleurs de votre école. La photo que vous téléchargez sera le logo de votre institution. Nous avons juste besoin du nom de votre école et nous créerons une page dédiée et sécurisée pour que vous puissiez profiter de la solution pendant 30 jours complètement gratuit.', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Nom de l'école
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_nombre_escuela', 'Nombre del colegio', 'es'),
('suscripcion', 'label_nombre_escuela', 'Nome da escola', 'br'),
('suscripcion', 'label_nombre_escuela', 'School name', 'en'),
('suscripcion', 'label_nombre_escuela', 'Nom de l\'école', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Placeholder: Nom de l'école
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'placeholder_nombre', 'Ej: Instituto Monte de los Colores', 'es'),
('suscripcion', 'placeholder_nombre', 'Ex: Instituto Monte de los Colores', 'br'),
('suscripcion', 'placeholder_nombre', 'Ex: Monte de los Colores Institute', 'en'),
('suscripcion', 'placeholder_nombre', 'Ex: Institut Monte de los Colores', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Nom du directeur
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_nombre_director', 'Nombre del director/a', 'es'),
('suscripcion', 'label_nombre_director', 'Nome do diretor/a', 'br'),
('suscripcion', 'label_nombre_director', 'Principal name', 'en'),
('suscripcion', 'label_nombre_director', 'Nom du directeur', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Email
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_email', 'Correo electrónico', 'es'),
('suscripcion', 'label_email', 'E-mail', 'br'),
('suscripcion', 'label_email', 'Email', 'en'),
('suscripcion', 'label_email', 'E-mail', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Téléphone
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_telefono', 'Teléfono de contacto', 'es'),
('suscripcion', 'label_telefono', 'Telefone de contato', 'br'),
('suscripcion', 'label_telefono', 'Contact phone', 'en'),
('suscripcion', 'label_telefono', 'Téléphone de contact', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Ville
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_ciudad', 'Ciudad', 'es'),
('suscripcion', 'label_ciudad', 'Cidade', 'br'),
('suscripcion', 'label_ciudad', 'City', 'en'),
('suscripcion', 'label_ciudad', 'Ville', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Pays
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_pais', 'País', 'es'),
('suscripcion', 'label_pais', 'País', 'br'),
('suscripcion', 'label_pais', 'Country', 'en'),
('suscripcion', 'label_pais', 'Pays', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Logo
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_logo', 'Logo del colegio', 'es'),
('suscripcion', 'label_logo', 'Logotipo da escola', 'br'),
('suscripcion', 'label_logo', 'School logo', 'en'),
('suscripcion', 'label_logo', 'Logo de l\'école', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Aide: Logo
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'ayuda_logo', 'Sube el logo de tu colegio (JPG, PNG - Máx. 2MB). Esta imagen aparecerá en el formulario de inscripción.', 'es'),
('suscripcion', 'ayuda_logo', 'Envie o logotipo da sua escola (JPG, PNG - Máx. 2MB). Esta imagem aparecerá no formulário de inscrição.', 'br'),
('suscripcion', 'ayuda_logo', 'Upload your school logo (JPG, PNG - Max. 2MB). This image will appear on the enrollment form.', 'en'),
('suscripcion', 'ayuda_logo', 'Téléchargez le logo de votre école (JPG, PNG - Max. 2Mo). Cette image apparaîtra sur le formulaire d\'inscription.', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Couleur principale
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_color_primario', 'Color principal', 'es'),
('suscripcion', 'label_color_primario', 'Cor principal', 'br'),
('suscripcion', 'label_color_primario', 'Primary color', 'en'),
('suscripcion', 'label_color_primario', 'Couleur principale', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Label: Couleur secondaire
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_color_secundario', 'Color secundario', 'es'),
('suscripcion', 'label_color_secundario', 'Cor secundária', 'br'),
('suscripcion', 'label_color_secundario', 'Secondary color', 'en'),
('suscripcion', 'label_color_secundario', 'Couleur secondaire', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Bouton: Créer ma page
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'boton_crear', 'Crear mi página de inscripción', 'es'),
('suscripcion', 'boton_crear', 'Criar minha página de inscrição', 'br'),
('suscripcion', 'boton_crear', 'Create my enrollment page', 'en'),
('suscripcion', 'boton_crear', 'Créer ma page d\'inscription', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Message: Vérification disponibilité
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'verificando_disponibilidad', 'Verificando disponibilidad...', 'es'),
('suscripcion', 'verificando_disponibilidad', 'Verificando disponibilidade...', 'br'),
('suscripcion', 'verificando_disponibilidad', 'Checking availability...', 'en'),
('suscripcion', 'verificando_disponibilidad', 'Vérification de la disponibilité...', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Message: Nom disponible
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'nombre_disponible', '✓ Nombre disponible', 'es'),
('suscripcion', 'nombre_disponible', '✓ Nome disponível', 'br'),
('suscripcion', 'nombre_disponible', '✓ Name available', 'en'),
('suscripcion', 'nombre_disponible', '✓ Nom disponible', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Message: Nom non disponible
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'nombre_no_disponible', '✗ Este nombre ya está registrado', 'es'),
('suscripcion', 'nombre_no_disponible', '✗ Este nome já está registrado', 'br'),
('suscripcion', 'nombre_no_disponible', '✗ This name is already registered', 'en'),
('suscripcion', 'nombre_no_disponible', '✗ Ce nom est déjà enregistré', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Message: Erreur upload logo
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'error_cargar_logo', 'Error al cargar el logo', 'es'),
('suscripcion', 'error_cargar_logo', 'Erro ao carregar o logotipo', 'br'),
('suscripcion', 'error_cargar_logo', 'Error uploading logo', 'en'),
('suscripcion', 'error_cargar_logo', 'Erreur lors du téléchargement du logo', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Message: Succès titre
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'exito_titulo', '¡Tu página ha sido creada!', 'es'),
('suscripcion', 'exito_titulo', 'Sua página foi criada!', 'br'),
('suscripcion', 'exito_titulo', 'Your page has been created!', 'en'),
('suscripcion', 'exito_titulo', 'Votre page a été créée!', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Message: Succès message
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'exito_mensaje', 'Hemos enviado un correo con los detalles de acceso. Tu período de prueba termina el:', 'es'),
('suscripcion', 'exito_mensaje', 'Enviamos um e-mail com os detalhes de acesso. Seu período de teste termina em:', 'br'),
('suscripcion', 'exito_mensaje', 'We have sent an email with access details. Your trial period ends on:', 'en'),
('suscripcion', 'exito_mensaje', 'Nous avons envoyé un e-mail avec les détails d\'accès. Votre période d\'essai se termine le:', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Bouton: Aller à ma page
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'ir_a_pagina', 'Ir a mi página de inscripción', 'es'),
('suscripcion', 'ir_a_pagina', 'Ir para minha página de inscrição', 'br'),
('suscripcion', 'ir_a_pagina', 'Go to my enrollment page', 'en'),
('suscripcion', 'ir_a_pagina', 'Aller à ma page d\'inscription', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Titre: Preview
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'preview_titulo', 'Vista previa de tu formulario', 'es'),
('suscripcion', 'preview_titulo', 'Pré-visualização do seu formulário', 'br'),
('suscripcion', 'preview_titulo', 'Preview of your form', 'en'),
('suscripcion', 'preview_titulo', 'Aperçu de votre formulaire', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Info: Période d'essai
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'info_trial', 'Período de prueba: 30 días', 'es'),
('suscripcion', 'info_trial', 'Período de teste: 30 dias', 'br'),
('suscripcion', 'info_trial', 'Trial period: 30 days', 'en'),
('suscripcion', 'info_trial', 'Période d\'essai: 30 jours', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Info: Sécurité SSL
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'info_seguro', 'Página segura con certificado SSL', 'es'),
('suscripcion', 'info_seguro', 'Página segura com certificado SSL', 'br'),
('suscripcion', 'info_seguro', 'Secure page with SSL certificate', 'en'),
('suscripcion', 'info_seguro', 'Page sécurisée avec certificat SSL', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Erreur: Champ obligatoire
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'campo_obligatorio', 'Este campo es obligatorio', 'es'),
('suscripcion', 'campo_obligatorio', 'Este campo é obrigatório', 'br'),
('suscripcion', 'campo_obligatorio', 'This field is required', 'en'),
('suscripcion', 'campo_obligatorio', 'Ce champ est obligatoire', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Erreur: Email invalide
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'email_invalido', 'El correo electrónico no es válido', 'es'),
('suscripcion', 'email_invalido', 'O e-mail não é válido', 'br'),
('suscripcion', 'email_invalido', 'The email is not valid', 'en'),
('suscripcion', 'email_invalido', 'L\'email n\'est pas valide', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- 3. TRADUCTIONS: Bouton sur la page d'inscription (hero)
-- ============================================================

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'btn_suscripcion', '🎓 Suscribir mi colegio', 'es'),
('hero', 'btn_suscripcion', '🎓 Assinar minha escola', 'br'),
('hero', 'btn_suscripcion', '🎓 Subscribe my school', 'en'),
('hero', 'btn_suscripcion', '🎓 Inscrire mon école', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'btn_suscripcion_sub', 'Prueba gratuita de 30 días', 'es'),
('hero', 'btn_suscripcion_sub', 'Teste gratuito de 30 dias', 'br'),
('hero', 'btn_suscripcion_sub', '30 days free trial', 'en'),
('hero', 'btn_suscripcion_sub', 'Essai gratuit de 30 jours', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- VERIFICATION
-- ============================================================

SELECT '============================================' AS ' ';
SELECT 'DEPLOIEMENT TERMINE AVEC SUCCES' AS 'STATUS';
SELECT '============================================' AS ' ';

SELECT 
    'Table suscripciones_escuelas' AS element,
    CASE 
        WHEN COUNT(*) > 0 THEN 'CREEE ✓'
        ELSE 'NON TROUVEE ✗'
    END AS status
FROM information_schema.tables 
WHERE table_schema = 'edu_platform' 
AND table_name = 'suscripciones_escuelas';

SELECT 
    'Traductions suscripcion' AS element,
    CONCAT(COUNT(*), ' traductions') AS status
FROM contenido_web 
WHERE seccion = 'suscripcion';

SELECT 
    'Bouton inscription' AS element,
    CONCAT(COUNT(*), ' traductions') AS status
FROM contenido_web 
WHERE seccion = 'hero' AND clave LIKE 'btn_suscripcion%';

SELECT '============================================' AS ' ';
SELECT 'Nombre total de traductions par langue:' AS ' ';

SELECT 
    idioma,
    COUNT(*) as total
FROM contenido_web 
WHERE seccion = 'suscripcion'
GROUP BY idioma;
