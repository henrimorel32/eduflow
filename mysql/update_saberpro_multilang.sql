-- ============================================================
-- TRADUCCIONES PARA LA PÁGINA SABERPRO
-- Añade contenido multilingüe para la página dedicada Saber PRO
-- ============================================================

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';

USE edu_platform;

-- ============================================================
-- CONTENIDO SABERPRO (ES)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
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

-- ============================================================
-- CONTENIDO SABERPRO (BR)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('saberpro', 'titulo_pagina', 'Preparação Saber PRO Colômbia | Simulados e Treinamento Inteligente — Mente Viva', 'br'),
('saberpro', 'titulo_principal', 'Prepare seu Saber PRO como um profissional', 'br'),
('saberpro', 'subtitulo', 'Simulados reais do exame Saber PRO com feedback imediato. Mais de 3.000 estudantes colombianos já confiam em nossa plataforma.', 'br'),
('saberpro', 'cta_principal', 'Começar preparação agora', 'br'),
('saberpro', 'cta_secundaria', 'Experimentar grátis sem cadastro', 'br'),
('saberpro', 'label_que_es', 'O que é o Saber PRO?', 'br'),
('saberpro', 'desc_que_es', 'O Saber PRO é uma avaliação padronizada desenhada pelo ICFES que todos os estudantes de programas de graduação na Colômbia devem fazer antes de obter seu título profissional.', 'br'),
('saberpro', 'label_competencias', 'Competências avaliadas', 'br'),
('saberpro', 'label_genericas', 'Competências Genéricas', 'br'),
('saberpro', 'label_especificas', 'Competências Específicas', 'br'),
('saberpro', 'label_metodo', 'Como funciona nossa preparação', 'br'),
('saberpro', 'label_faq', 'Perguntas frequentes', 'br'),
('saberpro', 'btn_plataforma', 'Ir para Saber PRO', 'br'),
('saberpro', 'btn_probar', 'Experimentar grátis', 'br')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- CONTENIDO SABERPRO (EN)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('saberpro', 'titulo_pagina', 'Saber PRO Preparation Colombia | Real Mock Tests and Smart Training — Mente Viva', 'en'),
('saberpro', 'titulo_principal', 'Prepare your Saber PRO like a pro', 'en'),
('saberpro', 'subtitulo', 'Real Saber PRO exam simulations with instant feedback. Over 3,000 Colombian students already trust our platform.', 'en'),
('saberpro', 'cta_principal', 'Start preparation now', 'en'),
('saberpro', 'cta_secundaria', 'Try for free without registration', 'en'),
('saberpro', 'label_que_es', 'What is Saber PRO?', 'en'),
('saberpro', 'desc_que_es', 'Saber PRO is a standardized assessment designed by ICFES that all undergraduate students in Colombia must take before obtaining their professional degree.', 'en'),
('saberpro', 'label_competencias', 'Evaluated competencies', 'en'),
('saberpro', 'label_genericas', 'Generic Competencies', 'en'),
('saberpro', 'label_especificas', 'Specific Competencies', 'en'),
('saberpro', 'label_metodo', 'How our preparation works', 'en'),
('saberpro', 'label_faq', 'Frequently asked questions', 'en'),
('saberpro', 'btn_plataforma', 'Go to Saber PRO', 'en'),
('saberpro', 'btn_probar', 'Try for free', 'en')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- CONTENIDO SABERPRO (FR)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('saberpro', 'titulo_pagina', 'Préparation Saber PRO Colombie | Simulacres et Entraînement Intelligent — Mente Viva', 'fr'),
('saberpro', 'titulo_principal', 'Préparez votre Saber PRO comme un pro', 'fr'),
('saberpro', 'subtitulo', 'Simulacres réels de l\'examen Saber PRO avec rétroaction immédiate. Plus de 3 000 étudiants colombiens font déjà confiance à notre plateforme.', 'fr'),
('saberpro', 'cta_principal', 'Commencer la préparation maintenant', 'fr'),
('saberpro', 'cta_secundaria', 'Essayer gratuitement sans inscription', 'fr'),
('saberpro', 'label_que_es', 'Qu\'est-ce que le Saber PRO ?', 'fr'),
('saberpro', 'desc_que_es', 'Le Saber PRO est une évaluation standardisée conçue par l\'ICFES que tous les étudiants de premier cycle en Colombie doivent passer avant d\'obtenir leur diplôme professionnel.', 'fr'),
('saberpro', 'label_competencias', 'Compétences évaluées', 'fr'),
('saberpro', 'label_genericas', 'Compétences Génériques', 'fr'),
('saberpro', 'label_especificas', 'Compétences Spécifiques', 'fr'),
('saberpro', 'label_metodo', 'Comment fonctionne notre préparation', 'fr'),
('saberpro', 'label_faq', 'Questions fréquentes', 'fr'),
('saberpro', 'btn_plataforma', 'Aller sur Saber PRO', 'fr'),
('saberpro', 'btn_probar', 'Essayer gratuitement', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);
