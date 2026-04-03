-- ============================================
-- CLE : mensaje_exito_demo
-- ============================================

-- Español (es)
INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('mensaje_exito_demo', 'es', 'inscripcion', 'Hemos recibido tus datos correctamente. Recibirás un email con el resumen de tu inscripción.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Português (br)
INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('mensaje_exito_demo', 'br', 'inscripcion', 'Recebemos seus dados corretamente. Você receberá um e-mail com o resumo da sua inscrição.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- English (en)
INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('mensaje_exito_demo', 'en', 'inscripcion', 'We have received your data correctly. You will receive an email with the summary of your enrollment.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Français (fr)
INSERT INTO contenido_web (clave, idioma, seccion, valor) 
VALUES ('mensaje_exito_demo', 'fr', 'inscripcion', 'Nous avons bien reçu vos données. Vous recevrez un email avec le résumé de votre inscription.')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);