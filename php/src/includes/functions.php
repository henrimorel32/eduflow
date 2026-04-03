<?php
declare(strict_types=1);


/**
 * Échappe HTML (définie en PREMIER)
 */
function e(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Génère une URL propre
 */
function url(string $page = 'home'): string {
    if ($page === 'home') return '/';
    return '/' . $page;
}

/**
 * Génère un badge pulsant
 */
function pulseBadge(string $text, string $color = 'primary'): string {
    $colors = [
        'primary' => 'bg-blue-500',
        'secondary' => 'bg-green-500',
        'purple' => 'bg-purple-500',
        'red' => 'bg-red-500',
    ];
    $bg = $colors[$color] ?? 'bg-blue-500';
    
    return '<span class="relative inline-flex h-2 w-2 mr-2">'
         . '<span class="animate-ping absolute inline-flex h-full w-full rounded-full ' . $bg . ' opacity-75"></span>'
         . '<span class="relative inline-flex rounded-full h-2 w-2 ' . $bg . '"></span>'
         . '</span>' . $text;
}

/**
 * Vérifie si la page est active
 */
function isActive(string $pageName): string {
    $current = $_GET['page'] ?? 'home';
    
    if (isset($_SERVER['PATH_INFO'])) {
        $current = trim($_SERVER['PATH_INFO'], '/') ?: 'home';
    } elseif (isset($_SERVER['REQUEST_URI'])) {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $current = trim($uri, '/') ?: 'home';
        $current = preg_replace('#^public/#', '', $current);
        $current = preg_replace('/\.php$/', '', $current);
    }
    
    $isActive = ($current === $pageName);
    
    // Classes de base
    $classes = 'relative px-4 py-2 rounded-lg transition-all ';
    
    if ($isActive) {
        $classes .= 'text-primary-600 font-semibold bg-primary-50';
    } else {
        $classes .= 'text-gray-600 hover:text-primary-600 hover:bg-gray-50';
    }
    
    return $classes;
}

/**
 * Génère l'indicateur visuel pour le menu actif (séparé de isActive)
 */
function activeIndicator(string $pageName): string {
    $current = $_GET['page'] ?? 'home';
    
    if (isset($_SERVER['PATH_INFO'])) {
        $current = trim($_SERVER['PATH_INFO'], '/') ?: 'home';
    } elseif (isset($_SERVER['REQUEST_URI'])) {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $current = trim($uri, '/') ?: 'home';
        $current = preg_replace('#^public/#', '', $current);
        $current = preg_replace('/\.php$/', '', $current);
    }
    
    if ($current === $pageName) {
        return '<span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-primary-600 rounded-full"></span>';
    }
    
    return '';
}

/**
 * SEO - Données par page (AVEC TOUTES LES CLÉS GLOBALES)
 */
function getSeoData(string $page): array {
    // DONNÉES GLOBALES (communes à toutes les pages)
    $global = [
        'site_name' => 'HM - Transformación Digital Educativa',
        'site_url' => 'https://hm-edu.co',  // CLÉ MANQUANTE AJOUTÉE
        'twitter' => '@hm_edu',              // CLÉ MANQUANTE AJOUTÉE
        'favicon' => '/favicon.ico',
        'logo' => '/logo.png',
        'brand' => 'HM',
    ];

    // DONNÉES PAR PAGE
    $pages = [
        'home' => [
            'title' => 'Software para Colegios Colombia | Sistema de Gestión Escolar Integral',
            'description' => 'Digitaliza tu institución con el sistema escuela más completo. Software para colegios que integra matrículas, académico y administración.',
            'keywords' => 'software colegio, software escuela, sistema escuela, plataforma educativa, gestión escolar digital',
            'h1' => 'Software para Colegios: Digitaliza tu Gestión Educativa',
            'canonical' => '/',
            'og_image' => '/og-home.jpg',
            'schema_type' => 'Organization',
            'cta_nav' => 'Diagnóstico Gratis',
        ],
        
        'soluciones' => [
            'title' => 'Sistema Escuela Integral | Software Gestión Educativa Colombia',
            'description' => 'Descubre todas las funcionalidades de nuestro sistema escuela completo.',
            'keywords' => 'sistema escuela, software colegio funcionalidades, plataforma educativa',
            'h1' => 'Sistema Escuela Completo para tu Institución',
            'canonical' => '/soluciones',
            'og_image' => '/og-soluciones.jpg',
            'schema_type' => 'Product',
            'cta_nav' => 'Ver Soluciones',
        ],
        
        'icfes' => [
            'title' => 'Preparación ICFES con IA | Sistema Inteligente',
            'description' => 'Entrena para el ICFES con inteligencia artificial adaptativa.',
            'keywords' => 'preparación ICFES, simulacros ICFES, entrenamiento ICFES',
            'h1' => 'Sistema Inteligente de Preparación para el ICFES',
            'canonical' => '/icfes',
            'og_image' => '/og-icfes.jpg',
            'schema_type' => 'Product',
            'cta_nav' => 'Entrenar ICFES',
        ],
        
        'contacto' => [
            'title' => 'Contacto | Software Colegio Colombia - HM',
            'description' => 'Solicita tu diagnóstico gratuito de sistema escuela.',
            'keywords' => 'contacto software colegio, demo sistema escuela',
            'h1' => 'Hablemos de tu Transformación Digital',
            'canonical' => '/contacto',
            'og_image' => '/og-contacto.jpg',
            'schema_type' => 'ContactPage',
            'cta_nav' => 'Agendar Demo',
        ],
    ];

    // Fusion: global + page spécifique
    $pageData = $pages[$page] ?? $pages['home'];
    
    return array_merge($global, $pageData);
}

/**
 * Génère le Schema.org JSON-LD
 */
function generateSchema(array $seo, string $page): string {
    $schemas = [
        'Organization' => [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $seo['site_name'] ?? 'HM',
            'url' => $seo['site_url'] ?? 'https://hm-edu.co',
            'logo' => ($seo['site_url'] ?? 'https://hm-edu.co') . ($seo['logo'] ?? '/logo.png'),
            'description' => 'Software líder para gestión digital de colegios en Colombia',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+57-320-418-1193',
                'contactType' => 'sales',
            ],
        ],
        
        'Product' => [
            '@context' => 'https://schema.org',
            '@type' => 'SoftwareApplication',
            'name' => 'HM - ' . ($seo['title'] ?? 'Sistema Escuela'),
            'applicationCategory' => 'EducationalApplication',
            'operatingSystem' => 'Web',
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'COP',
            ],
        ],
        
        'ContactPage' => [
            '@context' => 'https://schema.org',
            '@type' => 'ContactPage',
            'name' => $seo['title'] ?? 'Contacto',
            'mainEntity' => [
                '@type' => 'Organization',
                'name' => 'HM',
                'telephone' => '+57-320-418-1193',
            ],
        ],
    ];

    $type = $seo['schema_type'] ?? 'Organization';
    $schema = $schemas[$type] ?? $schemas['Organization'];
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
}

/**
 * Keywords long-tail
 */
function getLongTailKeywords(): array {
    return [
        'software para colegios privados en colombia',
        'sistema de gestion escolar latinoamerica',
        'plataforma educativa para instituciones',
    ];
}

/**
 * Charge le contenu depuis la BDD
 */
function getContent(string $section): array {
    global $pdo;
    $content = [];
    
    if (!isset($pdo)) {
        return $content;
    }
    
    try {
        $stmt = $pdo->prepare("SELECT clave, valor FROM contenido_web WHERE seccion = ?");
        $stmt->execute([$section]);
        
        while ($row = $stmt->fetch()) {
            $content[$row['clave']] = $row['valor'];
        }
    } catch (PDOException $e) {
        error_log("Erreur chargement contenu: " . $e->getMessage());
    }
    
    return $content;
}

/**
 * Debug (à supprimer en prod)
 */
function debugUrl(): void {
    echo '<pre style="background:#333;color:#0f0;padding:10px;position:fixed;top:0;right:0;z-index:9999;font-size:12px;">';
    echo 'REQUEST_URI: ' . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
    echo 'PATH_INFO: ' . ($_SERVER['PATH_INFO'] ?? 'N/A') . "\n";
    echo 'QUERY_STRING: ' . ($_SERVER['QUERY_STRING'] ?? 'N/A') . "\n";
    echo 'PAGE: ' . ($_GET['page'] ?? 'N/A') . "\n";
    echo '</pre>';
}
