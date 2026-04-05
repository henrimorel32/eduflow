-- ============================================
-- BADGE DEMO
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('badge_demo', 'es', 'inscripcion', 'Demo Interactiva')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('badge_demo', 'br', 'inscripcion', 'Demo Interativa')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('badge_demo', 'en', 'inscripcion', 'Interactive Demo')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('badge_demo', 'fr', 'inscripcion', 'Démo Interactive')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- TITRE HERO
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_titulo', 'es', 'inscripcion', 'Sistema de Inscripciones Inteligente')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_titulo', 'br', 'inscripcion', 'Sistema de Inscrições Inteligente')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_titulo', 'en', 'inscripcion', 'Smart Enrollment System')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_titulo', 'fr', 'inscripcion', 'Système d\'Inscription Intelligent')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- SOUS-TITRE HERO
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_subtitulo', 'es', 'inscripcion', 'Experimenta el flujo completo de admisiones adaptado a las necesidades de tu institución educativa.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_subtitulo', 'br', 'inscripcion', 'Experimente o fluxo completo de admissões adaptado às necessidades da sua instituição de ensino.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_subtitulo', 'en', 'inscripcion', 'Experience the complete admissions flow adapted to your educational institution\'s needs.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_subtitulo', 'fr', 'inscripcion', 'Découvrez le flux complet d\'admissions adapté aux besoins de votre établissement d\'enseignement.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- FEATURE 1
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_1', 'es', 'inscripcion', 'Flujo completo de inscripción')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_1', 'br', 'inscripcion', 'Fluxo completo de inscrição')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_1', 'en', 'inscripcion', 'Complete enrollment flow')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_1', 'fr', 'inscripcion', 'Flux d\'inscription complet')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- FEATURE 2
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_2', 'es', 'inscripcion', '100% adaptable a tu colegio')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_2', 'br', 'inscripcion', '100% adaptável à sua escola')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_2', 'en', 'inscripcion', '100% adaptable to your school')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_2', 'fr', 'inscripcion', '100% adaptable à votre école')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- FEATURE 3
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_3', 'es', 'inscripcion', 'Sin compromiso de contratación')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_3', 'br', 'inscripcion', 'Sem compromisso de contratação')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_3', 'en', 'inscripcion', 'No contract commitment')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_feature_3', 'fr', 'inscripcion', 'Sans engagement de contrat')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- LABEL EMAIL
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_label', 'es', 'inscripcion', 'Ingresa tu email para comenzar la demo:')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_label', 'br', 'inscripcion', 'Digite seu email para começar a demo:')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_label', 'en', 'inscripcion', 'Enter your email to start the demo:')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_label', 'fr', 'inscripcion', 'Entrez votre email pour commencer la démo :')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- PLACEHOLDER EMAIL
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_placeholder', 'es', 'inscripcion', 'tu@email.com')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_placeholder', 'br', 'inscripcion', 'seu@email.com')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_placeholder', 'en', 'inscripcion', 'your@email.com')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_placeholder', 'fr', 'inscripcion', 'votre@email.com')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- BOUTON
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_boton', 'es', 'inscripcion', 'Comenzar Demo')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_boton', 'br', 'inscripcion', 'Começar Demo')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_boton', 'en', 'inscripcion', 'Start Demo')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_boton', 'fr', 'inscripcion', 'Commencer la Démo')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- HINT EMAIL
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_hint', 'es', 'inscripcion', 'Recibirás un resumen de tus datos al finalizar')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_hint', 'br', 'inscripcion', 'Você receberá um resumo dos seus dados ao finalizar')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_hint', 'en', 'inscripcion', 'You will receive a summary of your data upon completion')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_email_hint', 'fr', 'inscripcion', 'Vous recevrez un résumé de vos données à la fin')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- TRUST TEXT
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_trust', 'es', 'inscripcion', 'Personalización total: añade, elimina o modifica campos según tu proceso de admisión.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_trust', 'br', 'inscripcion', 'Personalização total: adicione, remova ou modifique campos de acordo com seu processo de admissão.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_trust', 'en', 'inscripcion', 'Full customization: add, remove or modify fields according to your admission process.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('hero_trust', 'fr', 'inscripcion', 'Personnalisation totale : ajoutez, supprimez ou modifiez des champs selon votre processus d\'admission.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);