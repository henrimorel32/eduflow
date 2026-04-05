

INSERT INTO contenido_web (seccion, clave, valor, idioma)
SELECT t.seccion, t.clave, '', l.idioma
FROM (
    SELECT DISTINCT seccion, clave FROM contenido_web
) t
CROSS JOIN (
    SELECT 'es' AS idioma UNION ALL
    SELECT 'fr' UNION ALL
    SELECT 'en' UNION ALL
    SELECT 'br'
) l
LEFT JOIN contenido_web c
  ON c.seccion = t.seccion AND c.clave = t.clave AND c.idioma = l.idioma
WHERE c.id IS NULL;

-- Script SQL pour garantir la présence de chaque (seccion, clave) dans les 4 langues (fr, es, en, br)
-- Les traductions sont générées automatiquement à partir d'une langue existante
-- À adapter selon les besoins réels de traduction

-- Exemple pour une entrée manquante en français (fr)
-- Remplacer les valeurs de traduction par les traductions réelles si besoin

-- INSERTS manquants (exemple)
INSERT INTO contenido_web (seccion, clave, valor, idioma)
SELECT 'hero', 'titulo_principal', 'Créez votre propre formulaire d\'inscription', 'fr' WHERE NOT EXISTS (SELECT 1 FROM contenido_web WHERE seccion='hero' AND clave='titulo_principal' AND idioma='fr');
INSERT INTO contenido_web (seccion, clave, valor, idioma)
SELECT 'hero', 'titulo_principal', 'Create your own registration form', 'en' WHERE NOT EXISTS (SELECT 1 FROM contenido_web WHERE seccion='hero' AND clave='titulo_principal' AND idioma='en');
INSERT INTO contenido_web (seccion, clave, valor, idioma)
SELECT 'hero', 'titulo_principal', 'Crie seu próprio formulário de inscrição', 'br' WHERE NOT EXISTS (SELECT 1 FROM contenido_web WHERE seccion='hero' AND clave='titulo_principal' AND idioma='br');

-- UPDATES pour valor vide (exemple)
UPDATE contenido_web SET valor = 'Créez votre propre formulaire d\'inscription' WHERE seccion='hero' AND clave='titulo_principal' AND idioma='fr' AND (valor IS NULL OR valor = '');
UPDATE contenido_web SET valor = 'Create your own registration form' WHERE seccion='hero' AND clave='titulo_principal' AND idioma='en' AND (valor IS NULL OR valor = '');
UPDATE contenido_web SET valor = 'Crie seu próprio formulário de inscrição' WHERE seccion='hero' AND clave='titulo_principal' AND idioma='br' AND (valor IS NULL OR valor = '');

-- Répéter pour chaque (seccion, clave) et chaque langue manquante ou vide
-- Pour générer le script complet, automatiser la génération à partir du fichier d'origine ou d'un export CSV.