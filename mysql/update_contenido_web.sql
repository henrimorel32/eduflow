-- ============================================================
-- CONFIG ENCODAGE (OBLIGATOIRE)
-- ============================================================

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';

USE edu_platform;

-- ============================================================
-- TRADUCTIONS PAGE SUSCRIPCION
-- ============================================================

-- Titre principal (FR corrigé)
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'titulo_principal', 'Créez votre propre formulaire d''inscription', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Explication (FR corrigé)
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'explicacion',
'Ici, vous pouvez générer votre propre page d''inscription avec les couleurs de votre école. La photo que vous téléchargez sera le logo de votre institution. Nous avons juste besoin du nom de votre école et nous créerons une page dédiée et sécurisée pour que vous puissiez profiter de la solution pendant 30 jours complètement gratuit.',
'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Labels corrigés
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'label_nombre_escuela', 'Nom de l''école', 'fr'),
('suscripcion', 'label_logo', 'Logo de l''école', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Bouton
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'boton_crear', 'Créer ma page d''inscription', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Message succès
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'exito_mensaje',
'Nous avons envoyé un e-mail avec les détails d''accès. Votre période d''essai se termine le:',
'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Navigation
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'ir_a_pagina', 'Aller à ma page d''inscription', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Info trial
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'info_trial', 'Période d''essai: 30 jours', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Email invalide
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('suscripcion', 'email_invalido', 'L''email n''est pas valide', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- HERO (emoji OK)
-- ============================================================

INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('hero', 'btn_suscripcion', '🎓 Inscrire mon école', 'fr'),
('hero', 'btn_suscripcion_sub', 'Essai gratuit de 30 jours', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- VERIFICATION
-- ============================================================

SELECT 'Mise à jour terminée' AS status;

SELECT COUNT(*) AS total_traductions
FROM contenido_web
WHERE (seccion IN ('suscripcion', 'hero') AND clave LIKE 'btn_suscripcion%')
   OR seccion = 'suscripcion';