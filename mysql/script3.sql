-- ============================================
-- TITRE : gracias_inscripcion
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('gracias_inscripcion', 'es', 'inscripcion', '¡Gracias por tu inscripción!')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('gracias_inscripcion', 'br', 'inscripcion', 'Obrigado pela sua inscrição!')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('gracias_inscripcion', 'en', 'inscripcion', 'Thank you for your enrollment!')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('gracias_inscripcion', 'fr', 'inscripcion', 'Merci pour votre inscription !')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- MESSAGE EXPLICATION : demo_exito_mensaje
-- ============================================

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('demo_exito_mensaje', 'es', 'inscripcion', 'Hemos recibido tus datos correctamente. Recibirás un email con el resumen de tu inscripción.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('demo_exito_mensaje', 'br', 'inscripcion', 'Recebemos seus dados corretamente. Você receberá um e-mail com o resumo da sua inscrição.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('demo_exito_mensaje', 'en', 'inscripcion', 'We have received your data correctly. You will receive an email with the summary of your enrollment.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('demo_exito_mensaje', 'fr', 'inscripcion', 'Nous avons bien reçu vos données. Vous recevrez un email avec le résumé de votre inscription.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================
-- AUTRES CLÉS
-- ============================================

-- disponible_idiomas
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('disponible_idiomas', 'es', 'inscripcion', 'Disponible en otros idiomas') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('disponible_idiomas', 'br', 'inscripcion', 'Disponível em outros idiomas') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('disponible_idiomas', 'en', 'inscripcion', 'Available in other languages') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('disponible_idiomas', 'fr', 'inscripcion', 'Disponible dans d\'autres langues') ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- nota_simulacion
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nota_simulacion', 'es', 'inscripcion', 'Esta es una simulación') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nota_simulacion', 'br', 'inscripcion', 'Esta é uma simulação') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nota_simulacion', 'en', 'inscripcion', 'This is a simulation') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nota_simulacion', 'fr', 'inscripcion', 'Ceci est une simulation') ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- demo_explicacion_detallada
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('demo_explicacion_detallada', 'es', 'inscripcion', 'Los datos ingresados no se guardan permanentemente. Esta demo es solo para mostrar el funcionamiento del sistema.') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('demo_explicacion_detallada', 'br', 'inscripcion', 'Os dados inseridos não são salvos permanentemente. Esta demonstração é apenas para mostrar o funcionamento do sistema.') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('demo_explicacion_detallada', 'en', 'inscripcion', 'Data entered is not permanently saved. This demo is only to show how the system works.') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('demo_explicacion_detallada', 'fr', 'inscripcion', 'Les données saisies ne sont pas enregistrées définitivement. Cette démo sert uniquement à montrer le fonctionnement du système.') ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- nueva_inscripcion
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nueva_inscripcion', 'es', 'inscripcion', 'Nueva inscripción') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nueva_inscripcion', 'br', 'inscripcion', 'Nova inscrição') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nueva_inscripcion', 'en', 'inscripcion', 'New enrollment') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('nueva_inscripcion', 'fr', 'inscripcion', 'Nouvelle inscription') ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- volver_inicio
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('volver_inicio', 'es', 'inscripcion', 'Volver al inicio') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('volver_inicio', 'br', 'inscripcion', 'Voltar ao início') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('volver_inicio', 'en', 'inscripcion', 'Back to home') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('volver_inicio', 'fr', 'inscripcion', 'Retour à l\'accueil') ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- sistema_demo
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('sistema_demo', 'es', 'inscripcion', 'Sistema en modo demo') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('sistema_demo', 'br', 'inscripcion', 'Sistema em modo demonstração') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('sistema_demo', 'en', 'inscripcion', 'System in demo mode') ON DUPLICATE KEY UPDATE valor = VALUES(valor);
INSERT INTO contenido_web (clave, idioma, seccion, valor) VALUES ('sistema_demo', 'fr', 'inscripcion', 'Système en mode démo') ON DUPLICATE KEY UPDATE valor = VALUES(valor);