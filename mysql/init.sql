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

-- ============================================
-- HERO (ES)
-- ============================================
('hero', 'titulo_principal', 'Transforma la gestión de tu colegio sin complicarte la vida', 'es'),
('hero', 'subtitulo', 'Menos desorden, más control. Organiza tu colegio y mejora la experiencia de padres y estudiantes.', 'es'),
('hero', 'cta_principal', 'Solicita tu diagnóstico gratuito', 'es'),
('hero', 'cta_secundaria', 'Ver cómo funciona', 'es'),
('hero', 'btn_suscripcion', '🎓 Suscribir mi colegio', 'es'),
('hero', 'btn_suscripcion_sub', 'Prueba gratuita de 30 días', 'es'),

-- ============================================
-- SUSCRIPCION (ES - complet)
-- ============================================
('suscripcion', 'titulo_pagina', 'Suscribir mi colegio - Prueba gratuita de 30 días', 'es'),
('suscripcion', 'titulo_principal', 'Crea tu propio formulario de inscripción', 'es'),
('suscripcion', 'subtitulo', 'Personaliza los colores, sube tu logo y genera una página dedicada para tu colegio. Prueba gratuita de 30 días.', 'es'),
('suscripcion', 'explicacion', 'Aquí puedes generar tu propia página de inscripción con los colores de tu colegio. La foto que subas será el logo de tu institución. Solo necesitamos el nombre de tu colegio y crearemos una página dedicada y segura para que disfrutes de la solución durante 30 días completamente gratis.', 'es'),
('suscripcion', 'label_nombre_escuela', 'Nombre del colegio', 'es'),
('suscripcion', 'placeholder_nombre', 'Ej: Instituto Monte de los Colores', 'es'),
('suscripcion', 'label_nombre_director', 'Nombre del director/a', 'es'),
('suscripcion', 'label_email', 'Correo electrónico', 'es'),
('suscripcion', 'label_telefono', 'Teléfono de contacto', 'es'),
('suscripcion', 'label_ciudad', 'Ciudad', 'es'),
('suscripcion', 'label_pais', 'País', 'es'),
('suscripcion', 'label_logo', 'Logo del colegio', 'es'),
('suscripcion', 'ayuda_logo', 'Sube el logo de tu colegio (JPG, PNG - Máx. 2MB). Esta imagen aparecerá en el formulario de inscripción.', 'es'),
('suscripcion', 'label_color_primario', 'Color principal', 'es'),
('suscripcion', 'label_color_secundario', 'Color secundario', 'es'),
('suscripcion', 'boton_crear', 'Crear mi página de inscripción', 'es'),
('suscripcion', 'verificando_disponibilidad', 'Verificando disponibilidad...', 'es'),
('suscripcion', 'nombre_disponible', '✓ Nombre disponible', 'es'),
('suscripcion', 'nombre_no_disponible', '✗ Este nombre ya está registrado', 'es'),
('suscripcion', 'error_cargar_logo', 'Error al cargar el logo', 'es'),
('suscripcion', 'exito_titulo', '¡Tu página ha sido creada!', 'es'),
('suscripcion', 'exito_mensaje', 'Hemos enviado un correo con los detalles de acceso. Tu período de prueba termina el:', 'es'),
('suscripcion', 'ir_a_pagina', 'Ir a mi página de inscripción', 'es'),
('suscripcion', 'preview_titulo', 'Vista previa de tu formulario', 'es'),
('suscripcion', 'info_trial', 'Período de prueba: 30 días', 'es'),
('suscripcion', 'info_seguro', 'Página segura con certificado SSL', 'es'),
('suscripcion', 'campo_obligatorio', 'Este campo es obligatorio', 'es'),
('suscripcion', 'email_invalido', 'El correo electrónico no es válido', 'es'),
('suscripcion', 'email_no_disponible', 'Este correo electrónico ya está registrado', 'es'),

-- ============================================
-- SUSCRIPCION (BR)
-- ============================================
('suscripcion', 'titulo_pagina', 'Assinar minha escola - Teste gratuito de 30 dias', 'br'),
('suscripcion', 'titulo_principal', 'Crie seu próprio formulário de inscrição', 'br'),
('suscripcion', 'subtitulo', 'Personalize as cores, faça upload do seu logotipo e gere uma página dedicada para sua escola. Teste gratuito de 30 dias.', 'br'),
('suscripcion', 'explicacion', 'Aqui você pode gerar sua própria página de inscrição com as cores da sua escola. A foto que você enviar será o logotipo da sua instituição. Precisamos apenas do nome da sua escola e criaremos uma página dedicada e segura para você aproveitar a solução por 30 dias completamente grátis.', 'br'),
('suscripcion', 'label_nombre_escuela', 'Nome da escola', 'br'),
('suscripcion', 'placeholder_nombre', 'Ex: Instituto Monte de los Colores', 'br'),
('suscripcion', 'label_nombre_director', 'Nome do diretor/a', 'br'),
('suscripcion', 'label_email', 'E-mail', 'br'),
('suscripcion', 'label_telefono', 'Telefone de contato', 'br'),
('suscripcion', 'label_ciudad', 'Cidade', 'br'),
('suscripcion', 'label_pais', 'País', 'br'),
('suscripcion', 'label_logo', 'Logotipo da escola', 'br'),
('suscripcion', 'ayuda_logo', 'Envie o logotipo da sua escola (JPG, PNG - Máx. 2MB). Esta imagem aparecerá no formulário de inscrição.', 'br'),
('suscripcion', 'label_color_primario', 'Cor principal', 'br'),
('suscripcion', 'label_color_secundario', 'Cor secundária', 'br'),
('suscripcion', 'boton_crear', 'Criar minha página de inscrição', 'br'),
('suscripcion', 'verificando_disponibilidad', 'Verificando disponibilidade...', 'br'),
('suscripcion', 'nombre_disponible', '✓ Nome disponível', 'br'),
('suscripcion', 'nombre_no_disponible', '✗ Este nome já está registrado', 'br'),
('suscripcion', 'error_cargar_logo', 'Erro ao carregar o logotipo', 'br'),
('suscripcion', 'exito_titulo', 'Sua página foi criada!', 'br'),
('suscripcion', 'exito_mensaje', 'Enviamos um e-mail com os detalhes de acesso. Seu período de teste termina em:', 'br'),
('suscripcion', 'ir_a_pagina', 'Ir para minha página de inscrição', 'br'),
('suscripcion', 'preview_titulo', 'Pré-visualização do seu formulário', 'br'),
('suscripcion', 'info_trial', 'Período de teste: 30 dias', 'br'),
('suscripcion', 'info_seguro', 'Página segura com certificado SSL', 'br'),
('suscripcion', 'campo_obligatorio', 'Este campo é obrigatório', 'br'),
('suscripcion', 'email_invalido', 'O e-mail não é válido', 'br'),
('suscripcion', 'email_no_disponible', 'Este e-mail já está registrado', 'br'),
('hero', 'btn_suscripcion', '🎓 Assinar minha escola', 'br'),
('hero', 'btn_suscripcion_sub', 'Teste gratuito de 30 dias', 'br'),

-- ============================================
-- SUSCRIPCION (EN)
-- ============================================
('suscripcion', 'titulo_pagina', 'Subscribe my school - 30 days free trial', 'en'),
('suscripcion', 'titulo_principal', 'Create your own enrollment form', 'en'),
('suscripcion', 'subtitulo', 'Customize colors, upload your logo and generate a dedicated page for your school. 30 days free trial.', 'en'),
('suscripcion', 'explicacion', 'Here you can generate your own enrollment page with your school colors. The photo you upload will be your institution\'s logo. We just need your school name and we\'ll create a dedicated, secure page for you to enjoy the solution for 30 days completely free.', 'en'),
('suscripcion', 'label_nombre_escuela', 'School name', 'en'),
('suscripcion', 'placeholder_nombre', 'Ex: Monte de los Colores Institute', 'en'),
('suscripcion', 'label_nombre_director', 'Principal name', 'en'),
('suscripcion', 'label_email', 'Email', 'en'),
('suscripcion', 'label_telefono', 'Contact phone', 'en'),
('suscripcion', 'label_ciudad', 'City', 'en'),
('suscripcion', 'label_pais', 'Country', 'en'),
('suscripcion', 'label_logo', 'School logo', 'en'),
('suscripcion', 'ayuda_logo', 'Upload your school logo (JPG, PNG - Max. 2MB). This image will appear on the enrollment form.', 'en'),
('suscripcion', 'label_color_primario', 'Primary color', 'en'),
('suscripcion', 'label_color_secundario', 'Secondary color', 'en'),
('suscripcion', 'boton_crear', 'Create my enrollment page', 'en'),
('suscripcion', 'verificando_disponibilidad', 'Checking availability...', 'en'),
('suscripcion', 'nombre_disponible', '✓ Name available', 'en'),
('suscripcion', 'nombre_no_disponible', '✗ This name is already registered', 'en'),
('suscripcion', 'error_cargar_logo', 'Error uploading logo', 'en'),
('suscripcion', 'exito_titulo', 'Your page has been created!', 'en'),
('suscripcion', 'exito_mensaje', 'We have sent an email with access details. Your trial period ends on:', 'en'),
('suscripcion', 'ir_a_pagina', 'Go to my enrollment page', 'en'),
('suscripcion', 'preview_titulo', 'Preview of your form', 'en'),
('suscripcion', 'info_trial', 'Trial period: 30 days', 'en'),
('suscripcion', 'info_seguro', 'Secure page with SSL certificate', 'en'),
('suscripcion', 'campo_obligatorio', 'This field is required', 'en'),
('suscripcion', 'email_invalido', 'The email is not valid', 'en'),
('suscripcion', 'email_no_disponible', 'This email is already registered', 'en'),
('hero', 'btn_suscripcion', '🎓 Subscribe my school', 'en'),
('hero', 'btn_suscripcion_sub', '30 days free trial', 'en'),

-- ============================================
-- SUSCRIPCION (FR - complet)
-- ============================================
('suscripcion', 'titulo_pagina', 'Inscrire mon école - Essai gratuit de 30 jours', 'fr'),
('suscripcion', 'titulo_principal', 'Créez votre propre formulaire d''inscription', 'fr'),
('suscripcion', 'subtitulo', 'Personnalisez les couleurs, téléchargez votre logo et générez une page dédiée pour votre école. Essai gratuit de 30 jours.', 'fr'),
('suscripcion', 'explicacion', 'Ici, vous pouvez générer votre propre page d''inscription avec les couleurs de votre école. La photo que vous téléchargez sera le logo de votre institution. Nous avons juste besoin du nom de votre école et nous créerons une page dédiée et sécurisée pour que vous puissiez profiter de la solution pendant 30 jours complètement gratuit.', 'fr'),
('suscripcion', 'label_nombre_escuela', 'Nom de l''école', 'fr'),
('suscripcion', 'placeholder_nombre', 'Ex: Institut Monte de los Colores', 'fr'),
('suscripcion', 'label_nombre_director', 'Nom du directeur', 'fr'),
('suscripcion', 'label_email', 'E-mail', 'fr'),
('suscripcion', 'label_telefono', 'Téléphone de contact', 'fr'),
('suscripcion', 'label_ciudad', 'Ville', 'fr'),
('suscripcion', 'label_pais', 'Pays', 'fr'),
('suscripcion', 'label_logo', 'Logo de l''école', 'fr'),
('suscripcion', 'ayuda_logo', 'Téléchargez le logo de votre école (JPG, PNG - Max. 2Mo). Cette image apparaîtra sur le formulaire d''inscription.', 'fr'),
('suscripcion', 'label_color_primario', 'Couleur principale', 'fr'),
('suscripcion', 'label_color_secundario', 'Couleur secondaire', 'fr'),
('suscripcion', 'boton_crear', 'Créer ma page d''inscription', 'fr'),
('suscripcion', 'verificando_disponibilidad', 'Vérification de la disponibilité...', 'fr'),
('suscripcion', 'nombre_disponible', '✓ Nom disponible', 'fr'),
('suscripcion', 'nombre_no_disponible', '✗ Ce nom est déjà enregistré', 'fr'),
('suscripcion', 'error_cargar_logo', 'Erreur lors du téléchargement du logo', 'fr'),
('suscripcion', 'exito_titulo', 'Votre page a été créée!', 'fr'),
('suscripcion', 'exito_mensaje', 'Nous avons envoyé un e-mail avec les détails d''accès. Votre période d''essai se termine le:', 'fr'),
('suscripcion', 'ir_a_pagina', 'Aller à ma page d''inscription', 'fr'),
('suscripcion', 'preview_titulo', 'Aperçu de votre formulaire', 'fr'),
('suscripcion', 'info_trial', 'Période d''essai: 30 jours', 'fr'),
('suscripcion', 'info_seguro', 'Page sécurisée avec certificat SSL', 'fr'),
('suscripcion', 'campo_obligatorio', 'Ce champ est obligatoire', 'fr'),
('suscripcion', 'email_invalido', 'L''email n''est pas valide', 'fr'),
('suscripcion', 'email_no_disponible', 'Cet email est déjà enregistré', 'fr'),
('hero', 'btn_suscripcion', '🎓 Inscrire mon école', 'fr'),
('hero', 'btn_suscripcion_sub', 'Essai gratuit de 30 jours', 'fr'),

-- ============================================
-- LOADING OVERLAY (ES)
-- ============================================
('suscripcion', 'loading_titre', 'Creando tu página...', 'es'),
('suscripcion', 'loading_sous_titre', 'Esto tomará solo unos segundos', 'es'),
('suscripcion', 'loading_step_1', 'Verificando datos', 'es'),
('suscripcion', 'loading_step_2', 'Generando configuración', 'es'),
('suscripcion', 'loading_step_3', 'Creando base de datos', 'es'),
('suscripcion', 'loading_step_4', 'Configurando servidor', 'es'),
('suscripcion', 'loading_step_5', 'Finalizando', 'es'),
('suscripcion', 'loading_securite_titre', 'Infraestructura segura', 'es'),
('suscripcion', 'loading_https', 'HTTPS SSL', 'es'),
('suscripcion', 'loading_cloud', 'Cloud OVH', 'es'),
('suscripcion', 'loading_bd', 'BD dedicada', 'es'),

-- ============================================
-- LOADING OVERLAY (BR)
-- ============================================
('suscripcion', 'loading_titre', 'Criando sua página...', 'br'),
('suscripcion', 'loading_sous_titre', 'Isso levará apenas alguns segundos', 'br'),
('suscripcion', 'loading_step_1', 'Verificando dados', 'br'),
('suscripcion', 'loading_step_2', 'Gerando configuração', 'br'),
('suscripcion', 'loading_step_3', 'Criando banco de dados', 'br'),
('suscripcion', 'loading_step_4', 'Configurando servidor', 'br'),
('suscripcion', 'loading_step_5', 'Finalizando', 'br'),
('suscripcion', 'loading_securite_titre', 'Infraestrutura segura', 'br'),
('suscripcion', 'loading_https', 'HTTPS SSL', 'br'),
('suscripcion', 'loading_cloud', 'Cloud OVH', 'br'),
('suscripcion', 'loading_bd', 'BD dedicada', 'br'),

-- ============================================
-- LOADING OVERLAY (EN)
-- ============================================
('suscripcion', 'loading_titre', 'Creating your page...', 'en'),
('suscripcion', 'loading_sous_titre', 'This will only take a few seconds', 'en'),
('suscripcion', 'loading_step_1', 'Verifying data', 'en'),
('suscripcion', 'loading_step_2', 'Generating configuration', 'en'),
('suscripcion', 'loading_step_3', 'Creating database', 'en'),
('suscripcion', 'loading_step_4', 'Configuring server', 'en'),
('suscripcion', 'loading_step_5', 'Finalizing', 'en'),
('suscripcion', 'loading_securite_titre', 'Secure infrastructure', 'en'),
('suscripcion', 'loading_https', 'HTTPS SSL', 'en'),
('suscripcion', 'loading_cloud', 'OVH Cloud', 'en'),
('suscripcion', 'loading_bd', 'Dedicated DB', 'en'),

-- ============================================
-- LOADING OVERLAY (FR)
-- ============================================
('suscripcion', 'loading_titre', 'Création de votre page...', 'fr'),
('suscripcion', 'loading_sous_titre', 'Cela ne prendra que quelques secondes', 'fr'),
('suscripcion', 'loading_step_1', 'Vérification des données', 'fr'),
('suscripcion', 'loading_step_2', 'Génération de la configuration', 'fr'),
('suscripcion', 'loading_step_3', 'Création de la base de données', 'fr'),
('suscripcion', 'loading_step_4', 'Configuration du serveur', 'fr'),
('suscripcion', 'loading_step_5', 'Finalisation', 'fr'),
('suscripcion', 'loading_securite_titre', 'Infrastructure sécurisée', 'fr'),
('suscripcion', 'loading_https', 'HTTPS SSL', 'fr'),
('suscripcion', 'loading_cloud', 'Cloud OVH', 'fr'),
('suscripcion', 'loading_bd', 'BD dédiée', 'fr'),

-- ============================================
-- APLICACIONES (ES)
-- ============================================
('aplicaciones', 'titulo_pagina', 'Nuestras Aplicaciones Educativas | ICFES, Saber, Saber PRO y más - HM', 'es'),
('aplicaciones', 'titulo_principal', 'Nuestras creaciones y aplicaciones educativas', 'es'),
('aplicaciones', 'subtitulo', 'Hemos desarrollado plataformas especializadas para que estudiantes y docentes en Colombia se preparen de manera inteligente.', 'es'),
('aplicaciones', 'cta_principal', 'Empezar entrenamiento gratis', 'es'),
('aplicaciones', 'label_icfes', 'ICFES', 'es'),
('aplicaciones', 'desc_icfes', 'El ICFES (ahora Pruebas Saber 11°) es el examen nacional que presentan los estudiantes de grado 11 en Colombia para acceder a la educación superior. Evalúa competencias en lectura crítica, matemáticas, ciencias naturales, ciencias sociales e inglés.', 'es'),
('aplicaciones', 'label_saber', 'Pruebas Saber', 'es'),
('aplicaciones', 'desc_saber', 'Las Pruebas Saber son las evaluaciones nacionales de calidad de la educación en Colombia. Los estudiantes de grados 3°, 5° y 9° las presentan para medir sus competencias en lengua castellana, matemáticas, ciencias naturales, ciencias sociales e inglés.', 'es'),
('aplicaciones', 'label_quierosersaber', 'Quiero Ser / Quiero Saber', 'es'),
('aplicaciones', 'desc_quierosersaber', 'Es una prueba de orientación vocacional diseñada para estudiantes de último año de bachillerato en Colombia. Ayuda a descubrir qué carreras y profesiones se ajustan mejor a tus intereses, habilidades y personalidad.', 'es'),
('aplicaciones', 'label_saberpro', 'Saber PRO', 'es'),
('aplicaciones', 'desc_saberpro', 'Las Pruebas Saber PRO son evaluaciones obligatorias que deben presentar los estudiantes de pregrado antes de graduarse en Colombia. Miden competencias genéricas y específicas según cada carrera.', 'es'),
('aplicaciones', 'label_docente', 'Concurso Docente', 'es'),
('aplicaciones', 'desc_docente', 'El Concurso de Méritos para el ingreso a la carrera docente en Colombia es el proceso mediante el cual el Estado selecciona y evalúa a los mejores profesionales de la educación.', 'es'),
('aplicaciones', 'btn_plataforma', 'Ir a la plataforma', 'es'),
('aplicaciones', 'btn_probar', 'Probar gratis', 'es'),

-- ============================================
-- SABERPRO (ES)
-- ============================================
('saberpro', 'titulo_pagina', 'Preparación Saber PRO Colombia | Simulacros y Entrenamiento Inteligente — Mente Viva', 'es'),
('saberpro', 'titulo_principal', 'Prepara tu Saber PRO como un profesional', 'es'),
('saberpro', 'subtitulo', 'Simulacros reales del examen Saber PRO con retroalimentación inmediata. Más de 3.000 estudiantes colombianos ya confían en nuestra plataforma.', 'es'),
('saberpro', 'cta_principal', 'Empezar preparación ahora', 'es'),
('saberpro', 'cta_secundaria', 'Probar gratis sin registro', 'es'),
('saberpro', 'label_que_es', '¿Qué es el Saber PRO?', 'es'),
('saberpro', 'desc_que_es', 'El Saber PRO es una evaluación estandarizada diseñada por el ICFES que deben presentar todos los estudiantes de programas de pregrado en Colombia antes de obtener su título profesional.', 'es'),
('saberpro', 'label_competencias', 'Competencias evaluadas', 'es'),
('saberpro', 'label_genericas', 'Competencias Genéricas', 'es'),
('saberpro', 'label_especificas', 'Competencias Específicas', 'es'),
('saberpro', 'label_metodo', 'Cómo funciona nuestra preparación', 'es'),
('saberpro', 'label_faq', 'Preguntas frecuentes', 'es'),
('saberpro', 'btn_plataforma', 'Ir a Saber PRO', 'es'),
('saberpro', 'btn_probar', 'Probar gratis', 'es')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);
