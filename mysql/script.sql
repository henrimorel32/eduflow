
-- =====================================================
-- SISTEMA DE INSCRIPCIÓN MULTILINGÜE
-- Instituto Monte de los Colores (Demo)
-- =====================================================

-- 1. TABLA EXISTENTE: contenido_web (para traducciones CMS)
-- =====================================================
CREATE TABLE IF NOT EXISTS contenido_web (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seccion VARCHAR(50) NOT NULL COMMENT 'Sección del contenido (ej: inscripcion, general)',
    clave VARCHAR(100) NOT NULL COMMENT 'Clave identificadora del texto',
    valor TEXT NOT NULL COMMENT 'Texto traducido',
    idioma CHAR(2) NOT NULL COMMENT 'Código de idioma: es, br, en, fr',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uk_seccion_clave_idioma (seccion, clave, idioma),
    INDEX idx_idioma (idioma),
    INDEX idx_seccion (seccion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de contenido multilingüe para CMS';

-- 2. NUEVA TABLA: inscripciones (para almacenar postulaciones)
-- =====================================================
CREATE TABLE IF NOT EXISTS inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Metadata de la inscripción
    fecha_inscripcion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idioma_inscripcion CHAR(2) NOT NULL DEFAULT 'es' COMMENT 'Idioma en que se realizó la inscripción',
    estado_inscripcion ENUM('pendiente', 'en_revision', 'aprobada', 'rechazada', 'completada') DEFAULT 'pendiente',
    
    -- DATOS DEL ALUMNO
    alumno_nombres VARCHAR(100) NOT NULL,
    alumno_apellido1 VARCHAR(50) NOT NULL,
    alumno_apellido2 VARCHAR(50) DEFAULT NULL,
    alumno_fecha_nacimiento DATE DEFAULT NULL,
    alumno_nacionalidad VARCHAR(50) DEFAULT NULL,
    alumno_grado_inscripcion VARCHAR(50) NOT NULL COMMENT 'Grado al que aspira ingresar',
    
    -- INFORMACIÓN ACADÉMICA ANTERIOR
    alumno_anterior_institucion VARCHAR(150) DEFAULT NULL COMMENT 'Nombre de la institución anterior',
    alumno_anterior_ciudad VARCHAR(100) DEFAULT NULL,
    alumno_anterior_pais CHAR(2) DEFAULT NULL COMMENT 'Código ISO del país',
    
    -- ACUDIENTE 1 (Principal - obligatorio)
    acudiente1_nombres VARCHAR(100) NOT NULL,
    acudiente1_apellido1 VARCHAR(50) NOT NULL,
    acudiente1_apellido2 VARCHAR(50) DEFAULT NULL,
    acudiente1_direccion TEXT NOT NULL,
    acudiente1_ciudad VARCHAR(100) NOT NULL,
    acudiente1_profesion VARCHAR(100) DEFAULT NULL,
    acudiente1_empresa VARCHAR(150) DEFAULT NULL,
    acudiente1_pais CHAR(2) NOT NULL,
    acudiente1_prefijo VARCHAR(5) NOT NULL DEFAULT '+57',
    acudiente1_telefono VARCHAR(20) NOT NULL,
    acudiente1_email VARCHAR(150) NOT NULL,
    acudiente1_parentesco VARCHAR(50) NOT NULL DEFAULT 'Padre/Madre',
    
    -- ACUDIENTE 2 (Secundario - opcional)
    acudiente2_nombres VARCHAR(100) DEFAULT NULL,
    acudiente2_apellido1 VARCHAR(50) DEFAULT NULL,
    acudiente2_apellido2 VARCHAR(50) DEFAULT NULL,
    acudiente2_direccion TEXT DEFAULT NULL,
    acudiente2_ciudad VARCHAR(100) DEFAULT NULL,
    acudiente2_profesion VARCHAR(100) DEFAULT NULL,
    acudiente2_empresa VARCHAR(150) DEFAULT NULL,
    acudiente2_pais CHAR(2) DEFAULT NULL,
    acudiente2_prefijo VARCHAR(5) DEFAULT NULL,
    acudiente2_telefono VARCHAR(20) DEFAULT NULL,
    acudiente2_email VARCHAR(150) DEFAULT NULL,
    acudiente2_parentesco VARCHAR(50) DEFAULT NULL,
    
    -- ARCHIVOS ADJUNTOS (rutas de los uploads)
    archivo_boletin_1 VARCHAR(255) DEFAULT NULL COMMENT 'Ruta del archivo subido',
    archivo_boletin_2 VARCHAR(255) DEFAULT NULL,
    archivo_boletin_3 VARCHAR(255) DEFAULT NULL,
    archivo_carta_motivacion VARCHAR(255) DEFAULT NULL,
    
    -- CAMPOS ADICIONALES ÚTILES
    observaciones TEXT DEFAULT NULL COMMENT 'Observaciones generales',
    ip_inscripcion VARCHAR(45) DEFAULT NULL COMMENT 'IP del solicitante',
    user_agent TEXT DEFAULT NULL,
    
    fecha_revision DATETIME DEFAULT NULL,
    revisado_por INT DEFAULT NULL,
    
    INDEX idx_estado (estado_inscripcion),
    INDEX idx_fecha (fecha_inscripcion),
    INDEX idx_email_acudiente1 (acudiente1_email),
    INDEX idx_grado (alumno_grado_inscripcion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de inscripciones de estudiantes';

-- =====================================================
-- DATOS DE TRADUCCIÓN: INSCRIPCIÓN (sección 'inscripcion')
-- =====================================================

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
-- Español
('inscripcion', 'titulo_pagina', 'Sistema de Inscripción en Línea', 'es'),
('inscripcion', 'subtitulo_escuela', 'Excelencia Académica desde 1950', 'es'),
('inscripcion', 'paso_acudiente1', 'Acudiente 1', 'es'),
('inscripcion', 'paso_acudiente2', 'Acudiente 2', 'es'),
('inscripcion', 'paso_alumno', 'Estudiante', 'es'),
('inscripcion', 'paso_documentos', 'Documentos', 'es'),
('inscripcion', 'titulo_acudiente1', 'Datos del Acudiente Principal', 'es'),
('inscripcion', 'titulo_acudiente2', 'Datos del Segundo Acudiente', 'es'),
('inscripcion', 'titulo_alumno', 'Datos del Estudiante', 'es'),
('inscripcion', 'titulo_documentos', 'Documentos de Soporte', 'es'),
('inscripcion', 'principal', 'Principal', 'es'),
('inscripcion', 'opcional', 'Opcional', 'es'),
('inscripcion', 'nombres', 'Nombres', 'es'),
('inscripcion', 'apellido1', 'Primer Apellido', 'es'),
('inscripcion', 'apellido2', 'Segundo Apellido', 'es'),
('inscripcion', 'direccion', 'Dirección completa', 'es'),
('inscripcion', 'ciudad', 'Ciudad', 'es'),
('inscripcion', 'pais', 'País', 'es'),
('inscripcion', 'profesion', 'Profesión / Ocupación', 'es'),
('inscripcion', 'empresa', 'Empresa donde trabaja', 'es'),
('inscripcion', 'prefijo', 'Prefijo internacional', 'es'),
('inscripcion', 'telefono', 'Número de teléfono', 'es'),
('inscripcion', 'email', 'Correo electrónico', 'es'),
('inscripcion', 'parentesco', 'Parentesco con el estudiante', 'es'),
('inscripcion', 'padre', 'Padre', 'es'),
('inscripcion', 'madre', 'Madre', 'es'),
('inscripcion', 'tutor_legal', 'Tutor legal', 'es'),
('inscripcion', 'abuelo', 'Abuelo/a', 'es'),
('inscripcion', 'tio', 'Tío/a', 'es'),
('inscripcion', 'otro', 'Otro', 'es'),
('inscripcion', 'seleccione', 'Seleccione...', 'es'),
('inscripcion', 'info_acudiente2', 'Este acudiente es opcional, pero recomendado para casos de emergencia o cuando el acudiente principal no esté disponible.', 'es'),
('inscripcion', 'fecha_nacimiento', 'Fecha de nacimiento', 'es'),
('inscripcion', 'nacionalidad', 'Nacionalidad', 'es'),
('inscripcion', 'grado_inscripcion', 'Grado al que aspira ingresar', 'es'),
('inscripcion', 'seleccione_grado', 'Seleccione el grado...', 'es'),
('inscripcion', 'titulo_anterior_escuela', 'Institución Educativa Anterior', 'es'),
('inscripcion', 'nombre_institucion', 'Nombre de la institución', 'es'),
('inscripcion', 'observaciones', 'Observaciones adicionales', 'es'),
('inscripcion', 'placeholder_observaciones', 'Información adicional relevante para la inscripción (condiciones médicas, necesidades especiales, etc.)', 'es'),
('inscripcion', 'siguiente', 'Siguiente paso', 'es'),
('inscripcion', 'anterior', 'Paso anterior', 'es'),
('inscripcion', 'info_documentos', 'Por favor suba los últimos 3 boletines académicos. La carta de motivación es opcional pero altamente recomendada para completar su perfil.', 'es'),
('inscripcion', 'boletin_1', 'Boletín académico más reciente', 'es'),
('inscripcion', 'boletin_2', 'Boletín académico anterior', 'es'),
('inscripcion', 'boletin_3', 'Tercer boletín académico', 'es'),
('inscripcion', 'carta_motivacion', 'Carta de motivación del estudiante', 'es'),
('inscripcion', 'formatos_aceptados', 'Formatos aceptados', 'es'),
('inscripcion', 'opcional_recomendado', 'Opcional pero recomendado', 'es'),
('inscripcion', 'terminos_condiciones', 'Acepto los términos y condiciones del proceso de inscripción y autorizo el tratamiento de datos personales conforme a la política de privacidad.', 'es'),
('inscripcion', 'ver_terminos', 'Ver términos', 'es'),
('inscripcion', 'finalizar_inscripcion', 'Finalizar Inscripción', 'es'),
('inscripcion', 'completar_campos', 'Por favor complete todos los campos obligatorios marcados con *', 'es'),
('inscripcion', 'inscripcion_completada', '¡Inscripción registrada con éxito!', 'es'),
('inscripcion', 'mensaje_exito_inscripcion', 'Su solicitud de inscripción N° %s ha sido registrada en nuestro sistema. Hemos enviado un correo de confirmación a %s (simulación).', 'es'),
('inscripcion', 'nota_simulacion', 'Nota: Este es un sistema de demostración. En un entorno real, aquí se enviaría un correo electrónico de confirmación con los siguientes pasos del proceso.', 'es'),
('inscripcion', 'nueva_inscripcion', 'Realizar nueva inscripción', 'es'),
('inscripcion', 'error_procesamiento', 'Error al procesar la inscripción', 'es'),
('inscripcion', 'demo_sistema', 'Sistema de Demostración', 'es'),
('inscripcion', 'footer_explicacion', 'Este es un sistema de inscripción escolar de demostración que muestra cómo se puede optimizar el flujo de captación de estudiantes sin implementar nuevas plataformas costosas. El proceso incluye validación de datos, carga de documentos y gestión multilingüe integrada.', 'es'),
('inscripcion', 'sistema_demo', 'Sistema Demo - No es una inscripción real', 'es'),

-- Português (Brasil)
('inscripcion', 'titulo_pagina', 'Sistema de Inscrição Online', 'br'),
('inscripcion', 'subtitulo_escuela', 'Excelência Acadêmica desde 1950', 'br'),
('inscripcion', 'paso_acudiente1', 'Responsável 1', 'br'),
('inscripcion', 'paso_acudiente2', 'Responsável 2', 'br'),
('inscripcion', 'paso_alumno', 'Estudante', 'br'),
('inscripcion', 'paso_documentos', 'Documentos', 'br'),
('inscripcion', 'titulo_acudiente1', 'Dados do Responsável Principal', 'br'),
('inscripcion', 'titulo_acudiente2', 'Dados do Segundo Responsável', 'br'),
('inscripcion', 'titulo_alumno', 'Dados do Estudante', 'br'),
('inscripcion', 'titulo_documentos', 'Documentos de Apoio', 'br'),
('inscripcion', 'principal', 'Principal', 'br'),
('inscripcion', 'opcional', 'Opcional', 'br'),
('inscripcion', 'nombres', 'Nomes', 'br'),
('inscripcion', 'apellido1', 'Primeiro Sobrenome', 'br'),
('inscripcion', 'apellido2', 'Segundo Sobrenome', 'br'),
('inscripcion', 'direccion', 'Endereço completo', 'br'),
('inscripcion', 'ciudad', 'Cidade', 'br'),
('inscripcion', 'pais', 'País', 'br'),
('inscripcion', 'profesion', 'Profissão / Ocupação', 'br'),
('inscripcion', 'empresa', 'Empresa onde trabalha', 'br'),
('inscripcion', 'prefijo', 'Prefixo internacional', 'br'),
('inscripcion', 'telefono', 'Número de telefone', 'br'),
('inscripcion', 'email', 'E-mail', 'br'),
('inscripcion', 'parentesco', 'Parentesco com o estudante', 'br'),
('inscripcion', 'padre', 'Pai', 'br'),
('inscripcion', 'madre', 'Mãe', 'br'),
('inscripcion', 'tutor_legal', 'Tutor legal', 'br'),
('inscripcion', 'abuelo', 'Avô/Avó', 'br'),
('inscripcion', 'tio', 'Tio/Tia', 'br'),
('inscripcion', 'otro', 'Outro', 'br'),
('inscripcion', 'seleccione', 'Selecione...', 'br'),
('inscripcion', 'info_acudiente2', 'Este responsável é opcional, mas recomendado para casos de emergência ou quando o responsável principal não estiver disponível.', 'br'),
('inscripcion', 'fecha_nacimiento', 'Data de nascimento', 'br'),
('inscripcion', 'nacionalidad', 'Nacionalidade', 'br'),
('inscripcion', 'grado_inscripcion', 'Ano escolar pretendido', 'br'),
('inscripcion', 'seleccione_grado', 'Selecione o ano...', 'br'),
('inscripcion', 'titulo_anterior_escuela', 'Instituição de Ensino Anterior', 'br'),
('inscripcion', 'nombre_institucion', 'Nome da instituição', 'br'),
('inscripcion', 'observaciones', 'Observações adicionais', 'br'),
('inscripcion', 'placeholder_observaciones', 'Informações adicionais relevantes para a inscrição (condições médicas, necessidades especiais, etc.)', 'br'),
('inscripcion', 'siguiente', 'Próximo passo', 'br'),
('inscripcion', 'anterior', 'Passo anterior', 'br'),
('inscripcion', 'info_documentos', 'Por favor, envie os últimos 3 boletins escolares. A carta de motivação é opcional, mas altamente recomendada para completar seu perfil.', 'br'),
('inscripcion', 'boletin_1', 'Boletim escolar mais recente', 'br'),
('inscripcion', 'boletin_2', 'Boletim escolar anterior', 'br'),
('inscripcion', 'boletin_3', 'Terceiro boletim escolar', 'br'),
('inscripcion', 'carta_motivacion', 'Carta de motivação do estudante', 'br'),
('inscripcion', 'formatos_aceptados', 'Formatos aceitos', 'br'),
('inscripcion', 'opcional_recomendado', 'Opcional mas recomendado', 'br'),
('inscripcion', 'terminos_condiciones', 'Aceito os termos e condições do processo de inscrição e autorizo o tratamento de dados pessoais de acordo com a política de privacidade.', 'br'),
('inscripcion', 'ver_terminos', 'Ver termos', 'br'),
('inscripcion', 'finalizar_inscripcion', 'Finalizar Inscrição', 'br'),
('inscripcion', 'completar_campos', 'Por favor, preencha todos os campos obrigatórios marcados com *', 'br'),
('inscripcion', 'inscripcion_completada', 'Inscrição registrada com sucesso!', 'br'),
('inscripcion', 'mensaje_exito_inscripcion', 'Sua solicitação de inscrição N° %s foi registrada em nosso sistema. Enviamos um e-mail de confirmação para %s (simulação).', 'br'),
('inscripcion', 'nota_simulacion', 'Nota: Este é um sistema de demonstração. Em um ambiente real, aqui seria enviado um e-mail de confirmação com os próximos passos do processo.', 'br'),
('inscripcion', 'nueva_inscripcion', 'Fazer nova inscrição', 'br'),
('inscripcion', 'error_procesamiento', 'Erro ao processar a inscrição', 'br'),
('inscripcion', 'demo_sistema', 'Sistema de Demonstração', 'br'),
('inscripcion', 'footer_explicacion', 'Este é um sistema de inscrição escolar de demonstração que mostra como é possível otimizar o fluxo de captação de estudantes sem implementar novas plataformas caras. O processo inclui validação de dados, upload de documentos e gestão multilíngue integrada.', 'br'),
('inscripcion', 'sistema_demo', 'Sistema Demo - Não é uma inscrição real', 'br'),

-- English
('inscripcion', 'titulo_pagina', 'Online Enrollment System', 'en'),
('inscripcion', 'subtitulo_escuela', 'Academic Excellence Since 1950', 'en'),
('inscripcion', 'paso_acudiente1', 'Guardian 1', 'en'),
('inscripcion', 'paso_acudiente2', 'Guardian 2', 'en'),
('inscripcion', 'paso_alumno', 'Student', 'en'),
('inscripcion', 'paso_documentos', 'Documents', 'en'),
('inscripcion', 'titulo_acudiente1', 'Primary Guardian Information', 'en'),
('inscripcion', 'titulo_acudiente2', 'Secondary Guardian Information', 'en'),
('inscripcion', 'titulo_alumno', 'Student Information', 'en'),
('inscripcion', 'titulo_documentos', 'Supporting Documents', 'en'),
('inscripcion', 'principal', 'Primary', 'en'),
('inscripcion', 'opcional', 'Optional', 'en'),
('inscripcion', 'nombres', 'First Names', 'en'),
('inscripcion', 'apellido1', 'First Last Name', 'en'),
('inscripcion', 'apellido2', 'Second Last Name', 'en'),
('inscripcion', 'direccion', 'Full Address', 'en'),
('inscripcion', 'ciudad', 'City', 'en'),
('inscripcion', 'pais', 'Country', 'en'),
('inscripcion', 'profesion', 'Profession / Occupation', 'en'),
('inscripcion', 'empresa', 'Company where employed', 'en'),
('inscripcion', 'prefijo', 'International Prefix', 'en'),
('inscripcion', 'telefono', 'Phone Number', 'en'),
('inscripcion', 'email', 'Email Address', 'en'),
('inscripcion', 'parentesco', 'Relationship to Student', 'en'),
('inscripcion', 'padre', 'Father', 'en'),
('inscripcion', 'madre', 'Mother', 'en'),
('inscripcion', 'tutor_legal', 'Legal Guardian', 'en'),
('inscripcion', 'abuelo', 'Grandparent', 'en'),
('inscripcion', 'tio', 'Aunt/Uncle', 'en'),
('inscripcion', 'otro', 'Other', 'en'),
('inscripcion', 'seleccione', 'Select...', 'en'),
('inscripcion', 'info_acudiente2', 'This guardian is optional but recommended for emergency situations or when the primary guardian is unavailable.', 'en'),
('inscripcion', 'fecha_nacimiento', 'Date of Birth', 'en'),
('inscripcion', 'nacionalidad', 'Nationality', 'en'),
('inscripcion', 'grado_inscripcion', 'Grade Applying For', 'en'),
('inscripcion', 'seleccione_grado', 'Select grade level...', 'en'),
('inscripcion', 'titulo_anterior_escuela', 'Previous Educational Institution', 'en'),
('inscripcion', 'nombre_institucion', 'Institution Name', 'en'),
('inscripcion', 'observaciones', 'Additional Comments', 'en'),
('inscripcion', 'placeholder_observaciones', 'Any additional relevant information for enrollment (medical conditions, special needs, etc.)', 'en'),
('inscripcion', 'siguiente', 'Next Step', 'en'),
('inscripcion', 'anterior', 'Previous Step', 'en'),
('inscripcion', 'info_documentos', 'Please upload the last 3 academic report cards. The motivation letter is optional but highly recommended to complete your profile.', 'en'),
('inscripcion', 'boletin_1', 'Most recent report card', 'en'),
('inscripcion', 'boletin_2', 'Previous report card', 'en'),
('inscripcion', 'boletin_3', 'Third report card', 'en'),
('inscripcion', 'carta_motivacion', 'Student motivation letter', 'en'),
('inscripcion', 'formatos_aceptados', 'Accepted formats', 'en'),
('inscripcion', 'opcional_recomendado', 'Optional but recommended', 'en'),
('inscripcion', 'terminos_condiciones', 'I accept the terms and conditions of the enrollment process and authorize the processing of personal data according to the privacy policy.', 'en'),
('inscripcion', 'ver_terminos', 'View terms', 'en'),
('inscripcion', 'finalizar_inscripcion', 'Complete Enrollment', 'en'),
('inscripcion', 'completar_campos', 'Please complete all required fields marked with *', 'en'),
('inscripcion', 'inscripcion_completada', 'Enrollment successfully registered!', 'en'),
('inscripcion', 'mensaje_exito_inscripcion', 'Your enrollment application No. %s has been registered in our system. We have sent a confirmation email to %s (simulation).', 'en'),
('inscripcion', 'nota_simulacion', 'Note: This is a demonstration system. In a real environment, a confirmation email would be sent here with the next steps of the process.', 'en'),
('inscripcion', 'nueva_inscripcion', 'Submit new enrollment', 'en'),
('inscripcion', 'error_procesamiento', 'Error processing enrollment', 'en'),
('inscripcion', 'demo_sistema', 'Demonstration System', 'en'),
('inscripcion', 'footer_explicacion', 'This is a school enrollment demonstration system showing how student admission flows can be optimized without implementing expensive new platforms. The process includes data validation, document upload, and integrated multilingual management.', 'en'),
('inscripcion', 'sistema_demo', 'Demo System - Not a real enrollment', 'en'),

-- Français
('inscripcion', 'titulo_pagina', 'Système d\'Inscription en Ligne', 'fr'),
('inscripcion', 'subtitulo_escuela', 'Excellence Académique depuis 1950', 'fr'),
('inscripcion', 'paso_acudiente1', 'Responsable 1', 'fr'),
('inscripcion', 'paso_acudiente2', 'Responsable 2', 'fr'),
('inscripcion', 'paso_alumno', 'Élève', 'fr'),
('inscripcion', 'paso_documentos', 'Documents', 'fr'),
('inscripcion', 'titulo_acudiente1', 'Informations du Responsable Principal', 'fr'),
('inscripcion', 'titulo_acudiente2', 'Informations du Second Responsable', 'fr'),
('inscripcion', 'titulo_alumno', 'Informations de l\'Élève', 'fr'),
('inscripcion', 'titulo_documentos', 'Documents Justificatifs', 'fr'),
('inscripcion', 'principal', 'Principal', 'fr'),
('inscripcion', 'opcional', 'Optionnel', 'fr'),
('inscripcion', 'nombres', 'Prénoms', 'fr'),
('inscripcion', 'apellido1', 'Premier Nom de Famille', 'fr'),
('inscripcion', 'apellido2', 'Deuxième Nom de Famille', 'fr'),
('inscripcion', 'direccion', 'Adresse complète', 'fr'),
('inscripcion', 'ciudad', 'Ville', 'fr'),
('inscripcion', 'pais', 'Pays', 'fr'),
('inscripcion', 'profesion', 'Profession / Occupation', 'fr'),
('inscripcion', 'empresa', 'Entreprise employeur', 'fr'),
('inscripcion', 'prefijo', 'Préfixe international', 'fr'),
('inscripcion', 'telefono', 'Numéro de téléphone', 'fr'),
('inscripcion', 'email', 'Adresse e-mail', 'fr'),
('inscripcion', 'parentesco', 'Lien de parenté avec l\'élève', 'fr'),
('inscripcion', 'padre', 'Père', 'fr'),
('inscripcion', 'madre', 'Mère', 'fr'),
('inscripcion', 'tutor_legal', 'Tuteur légal', 'fr'),
('inscripcion', 'abuelo', 'Grand-parent', 'fr'),
('inscripcion', 'tio', 'Oncle/Tante', 'fr'),
('inscripcion', 'otro', 'Autre', 'fr'),
('inscripcion', 'seleccione', 'Sélectionnez...', 'fr'),
('inscripcion', 'info_acudiente2', 'Ce responsable est optionnel mais recommandé pour les cas d\'urgence ou lorsque le responsable principal n\'est pas disponible.', 'fr'),
('inscripcion', 'fecha_nacimiento', 'Date de naissance', 'fr'),
('inscripcion', 'nacionalidad', 'Nationalité', 'fr'),
('inscripcion', 'grado_inscripcion', 'Niveau scolaire souhaité', 'fr'),
('inscripcion', 'seleccione_grado', 'Sélectionnez le niveau...', 'fr'),
('inscripcion', 'titulo_anterior_escuela', 'Établissement Scolaire Précédent', 'fr'),
('inscripcion', 'nombre_institucion', 'Nom de l\'établissement', 'fr'),
('inscripcion', 'observaciones', 'Commentaires additionnels', 'fr'),
('inscripcion', 'placeholder_observaciones', 'Informations complémentaires pertinentes pour l\'inscription (conditions médicales, besoins particuliers, etc.)', 'fr'),
('inscripcion', 'siguiente', 'Étape suivante', 'fr'),
('inscripcion', 'anterior', 'Étape précédente', 'fr'),
('inscripcion', 'info_documentos', 'Veuillez télécharger les 3 derniers bulletins scolaires. La lettre de motivation est optionnelle mais fortement recommandée pour compléter votre dossier.', 'fr'),
('inscripcion', 'boletin_1', 'Bulletin scolaire le plus récent', 'fr'),
('inscripcion', 'boletin_2', 'Bulletin scolaire précédent', 'fr'),
('inscripcion', 'boletin_3', 'Troisième bulletin scolaire', 'fr'),
('inscripcion', 'carta_motivacion', 'Lettre de motivation de l\'élève', 'fr'),
('inscripcion', 'formatos_aceptados', 'Formats acceptés', 'fr'),
('inscripcion', 'opcional_recomendado', 'Optionnel mais recommandé', 'fr'),
('inscripcion', 'terminos_condiciones', 'J\'accepte les termes et conditions du processus d\'inscription et j\'autorise le traitement des données personnelles conformément à la politique de confidentialité.', 'fr'),
('inscripcion', 'ver_terminos', 'Voir les termes', 'fr'),
('inscripcion', 'finalizar_inscripcion', 'Finaliser l\'Inscription', 'fr'),
('inscripcion', 'completar_campos', 'Veuillez compléter tous les champs obligatoires marqués d\'un *', 'fr'),
('inscripcion', 'inscripcion_completada', 'Inscription enregistrée avec succès !', 'fr'),
('inscripcion', 'mensaje_exito_inscripcion', 'Votre demande d\'inscription N° %s a été enregistrée dans notre système. Nous avons envoyé un e-mail de confirmation à %s (simulation).', 'fr'),
('inscripcion', 'nota_simulacion', 'Note : Il s\'agit d\'un système de démonstration. Dans un environnement réel, un e-mail de confirmation serait envoyé ici avec les prochaines étapes du processus.', 'fr'),
('inscripcion', 'nueva_inscripcion', 'Nouvelle inscription', 'fr'),
('inscripcion', 'error_procesamiento', 'Erreur lors du traitement de l\'inscription', 'fr'),
('inscripcion', 'demo_sistema', 'Système de Démonstration', 'fr'),
('inscripcion', 'footer_explicacion', 'Il s\'agit d\'un système d\'inscription scolaire de démonstration montrant comment les flux d\'admission des élèves peuvent être optimisés sans implémenter de nouvelles plateformes coûteuses. Le processus inclut la validation des données, le téléchargement de documents et la gestion multilingue intégrée.', 'fr'),
('inscripcion', 'sistema_demo', 'Système Démo - Pas une inscription réelle', 'fr');

-- print("Structure SQL générée")
-- print(f"Longueur: {len(sql_structure)} caractères")
-- print("\n" + "="*50)
-- print("RÉSUMÉ DE L'ARCHITECTURE")
-- print("="*50)
-- print("""
-- 📚 ÉCOLE: Instituto Monte de los Colores
--    - Nom latino-authentique (inspiré des écoles La Salle en Colombie)
--    - Fondée en 1950 (crédibilité historique)

-- 🗄️  TABLES CRÉÉES:
--    1. contenido_web (CMS multilingue existant)
--       - seccion, clave, valor, idioma
--       - 4 langues: es, br, en, fr
   
--    2. inscripciones (NOUVELLE - stockage des candidatures)
--       - Données complètes: 2 acudientes + alumno + documentos
--       - Champs pour uploads (boletines + carta)
--       - Statut de suivi (pendiente/aprobada/etc.)

-- 🌎 MULTILINGUE:
--    - Espagnol (Colombie/Latinoamérica)
--    - Portugais (Brésil)
--    - Anglais (International)
--    - Français (International)

-- 📋 FORMULAIRE 4 ÉTAPES:
--    1. Acudiente 1 (obligatoire) - avec préfixe Colombia par défaut
--    2. Acudiente 2 (optionnel)
--    3. Alumno + école précédente
--    4. Uploads (3 bulletins + lettre motivation)

-- ⚠️  SIMULATION:
--    - Message final indique l'envoi d'email (mais rien n'est envoyé)
--    - Badge "DEMO" visible sur toute la page
--    - Explication dans le footer
-- """)
