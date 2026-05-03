-- ============================================================
-- TRADUCCIONES PARA LA PÁGINA APLICACIONES
-- Añade contenido multilingüe para la nueva página de aplicaciones
-- ============================================================

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';

USE edu_platform;

-- ============================================================
-- CONTENIDO APLICACIONES (ES)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
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
('aplicaciones', 'btn_probar', 'Probar gratis', 'es')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- CONTENIDO APLICACIONES (BR)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('aplicaciones', 'titulo_pagina', 'Nossos Aplicativos Educacionais | ICFES, Saber, Saber PRO e mais - HM', 'br'),
('aplicaciones', 'titulo_principal', 'Nossas criações e aplicativos educacionais', 'br'),
('aplicaciones', 'subtitulo', 'Desenvolvemos plataformas especializadas para que estudantes e professores na Colômbia se preparem de forma inteligente.', 'br'),
('aplicaciones', 'cta_principal', 'Começar treinamento grátis', 'br'),
('aplicaciones', 'label_icfes', 'ICFES', 'br'),
('aplicaciones', 'desc_icfes', 'O ICFES (agora Pruebas Saber 11°) é o exame nacional que os estudantes do 11º ano na Colômbia fazem para acessar o ensino superior. Avalia competências em leitura crítica, matemática, ciências naturais, ciências sociais e inglês.', 'br'),
('aplicaciones', 'label_saber', 'Pruebas Saber', 'br'),
('aplicaciones', 'desc_saber', 'As Pruebas Saber são as avaliações nacionais de qualidade da educação na Colômbia. Os estudantes dos graus 3°, 5° e 9° as fazem para medir suas competências em língua espanhola, matemática, ciências naturais, ciências sociais e inglês.', 'br'),
('aplicaciones', 'label_quierosersaber', 'Quiero Ser / Quiero Saber', 'br'),
('aplicaciones', 'desc_quierosersaber', 'É um teste de orientação vocacional projetado para estudantes do último ano do ensino médio na Colômbia. Ajuda a descobrir quais carreiras e profissões se ajustam melhor aos seus interesses, habilidades e personalidade.', 'br'),
('aplicaciones', 'label_saberpro', 'Saber PRO', 'br'),
('aplicaciones', 'desc_saberpro', 'As Pruebas Saber PRO são avaliações obrigatórias que os estudantes de graduação devem fazer antes de se formar na Colômbia. Medem competências genéricas e específicas de acordo com cada carreira.', 'br'),
('aplicaciones', 'label_docente', 'Concurso Docente', 'br'),
('aplicaciones', 'desc_docente', 'O Concurso de Méritos para ingresso na carreira docente na Colômbia é o processo pelo qual o Estado seleciona e avalia os melhores profissionais da educação.', 'br'),
('aplicaciones', 'btn_plataforma', 'Ir para a plataforma', 'br'),
('aplicaciones', 'btn_probar', 'Experimentar grátis', 'br')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- CONTENIDO APLICACIONES (EN)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('aplicaciones', 'titulo_pagina', 'Our Educational Applications | ICFES, Saber, Saber PRO and more - HM', 'en'),
('aplicaciones', 'titulo_principal', 'Our creations and educational applications', 'en'),
('aplicaciones', 'subtitulo', 'We have developed specialized platforms for students and teachers in Colombia to prepare intelligently.', 'en'),
('aplicaciones', 'cta_principal', 'Start free training', 'en'),
('aplicaciones', 'label_icfes', 'ICFES', 'en'),
('aplicaciones', 'desc_icfes', 'The ICFES (now Pruebas Saber 11°) is the national exam taken by 11th grade students in Colombia to access higher education. It evaluates competencies in critical reading, mathematics, natural sciences, social sciences and English.', 'en'),
('aplicaciones', 'label_saber', 'Pruebas Saber', 'en'),
('aplicaciones', 'desc_saber', 'The Pruebas Saber are the national education quality assessments in Colombia. Students in grades 3°, 5° and 9° take them to measure their competencies in Spanish language, mathematics, natural sciences, social sciences and English.', 'en'),
('aplicaciones', 'label_quierosersaber', 'Quiero Ser / Quiero Saber', 'en'),
('aplicaciones', 'desc_quierosersaber', 'It is a vocational orientation test designed for last year high school students in Colombia. It helps discover which careers and professions best match your interests, abilities and personality.', 'en'),
('aplicaciones', 'label_saberpro', 'Saber PRO', 'en'),
('aplicaciones', 'desc_saberpro', 'The Pruebas Saber PRO are mandatory assessments that undergraduate students must take before graduating in Colombia. They measure generic and specific competencies according to each career.', 'en'),
('aplicaciones', 'label_docente', 'Concurso Docente', 'en'),
('aplicaciones', 'desc_docente', 'The Merit Contest for entry into the teaching career in Colombia is the process by which the State selects and evaluates the best education professionals.', 'en'),
('aplicaciones', 'btn_plataforma', 'Go to platform', 'en'),
('aplicaciones', 'btn_probar', 'Try for free', 'en')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- ============================================================
-- CONTENIDO APLICACIONES (FR)
-- ============================================================
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES
('aplicaciones', 'titulo_pagina', 'Nos Applications Éducatives | ICFES, Saber, Saber PRO et plus - HM', 'fr'),
('aplicaciones', 'titulo_principal', 'Nos créations et applications éducatives', 'fr'),
('aplicaciones', 'subtitulo', 'Nous avons développé des plateformes spécialisées pour que les étudiants et enseignants en Colombie se préparent intelligemment.', 'fr'),
('aplicaciones', 'cta_principal', 'Commencer l\'entraînement gratuit', 'fr'),
('aplicaciones', 'label_icfes', 'ICFES', 'fr'),
('aplicaciones', 'desc_icfes', 'L\'ICFES (maintenant Pruebas Saber 11°) est l\'examen national que passent les élèves de 11ème année en Colombie pour accéder à l\'enseignement supérieur. Il évalue les compétences en lecture critique, mathématiques, sciences naturelles, sciences sociales et anglais.', 'fr'),
('aplicaciones', 'label_saber', 'Pruebas Saber', 'fr'),
('aplicaciones', 'desc_saber', 'Les Pruebas Saber sont les évaluations nationales de la qualité de l\'éducation en Colombie. Les élèves des grades 3°, 5° et 9° les passent pour mesurer leurs compétences en langue espagnole, mathématiques, sciences naturelles, sciences sociales et anglais.', 'fr'),
('aplicaciones', 'label_quierosersaber', 'Quiero Ser / Quiero Saber', 'fr'),
('aplicaciones', 'desc_quierosersaber', 'C\'est un test d\'orientation professionnelle conçu pour les élèves de dernière année du secondaire en Colombie. Il aide à découvrir quelles carrières et professions correspondent le mieux à vos intérêts, capacités et personnalité.', 'fr'),
('aplicaciones', 'label_saberpro', 'Saber PRO', 'fr'),
('aplicaciones', 'desc_saberpro', 'Les Pruebas Saber PRO sont des évaluations obligatoires que les étudiants du premier cycle doivent passer avant d\'obtenir leur diplôme en Colombie. Elles mesurent les compétences génériques et spécifiques selon chaque carrière.', 'fr'),
('aplicaciones', 'label_docente', 'Concurso Docente', 'fr'),
('aplicaciones', 'desc_docente', 'Le Concours de Mérites pour l\'entrée dans la carrière d\'enseignant en Colombie est le processus par lequel l\'État sélectionne et évalue les meilleurs professionnels de l\'éducation.', 'fr'),
('aplicaciones', 'btn_plataforma', 'Aller sur la plateforme', 'fr'),
('aplicaciones', 'btn_probar', 'Essayer gratuitement', 'fr')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);
