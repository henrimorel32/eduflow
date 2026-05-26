<?php
declare(strict_types=1);

// ============================================
// I18N - Système de traduction
// ============================================

$translations = [];
$currentLang = 'es';

/**
 * Charge le fichier de langue
 */
function loadLang(string $lang): void {
    global $translations, $currentLang;
    
    $langs = ['es', 'en', 'fr'];
    if (!in_array($lang, $langs, true)) {
        $lang = 'es';
    }
    
    $currentLang = $lang;
    $file = I18N_PATH . '/' . $lang . '.php';
    
    if (file_exists($file)) {
        $translations = require $file;
    } else {
        $translations = [];
    }
}

/**
 * Récupère une traduction (supporte les clés imbriquées avec .)
 * Ex: t('title', 'seo.myschoolby') ou t('nav.home')
 */
function t(string $key, string $section = 'global'): string {
    global $translations;
    
    $value = $translations;
    
    // Si section contient des points, on les ajoute aux clés
    $keys = [];
    if ($section !== 'global') {
        $keys = array_merge(explode('.', $section), explode('.', $key));
    } else {
        $keys = explode('.', $key);
    }
    
    foreach ($keys as $k) {
        if (is_array($value) && array_key_exists($k, $value)) {
            $value = $value[$k];
        } else {
            return $key; // Fallback: retourne la clé
        }
    }
    
    return is_string($value) ? $value : $key;
}

/**
 * Retourne la langue courante
 */
function getLang(): string {
    global $currentLang;
    return $currentLang;
}

/**
 * Détecte si l'utilisateur est sur le marché colombien
 * Basé sur la langue : ES = Colombie, EN/FR = international
 */
function isColombianMarket(): bool {
    return getLang() === 'es';
}

/**
 * Échappe HTML (définie en PREMIER)
 */
function e(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Génère une URL propre (avec support langue)
 */
function url(string $page = 'home'): string {
    global $currentLang;
    
    $prefix = ($currentLang !== 'es') ? '/' . $currentLang : '';
    if ($page === 'home') return $prefix . '/';
    return $prefix . '/' . $page;
}

/**
 * Génère l'URL canonique pour une langue donnée
 */
function urlLang(string $page = 'home', string $lang = ''): string {
    global $currentLang;
    
    if (empty($lang)) $lang = $currentLang;
    $prefix = ($lang !== 'es') ? '/' . $lang : '';
    if ($page === 'home') return 'https://hm-edu.co' . $prefix . '/';
    return 'https://hm-edu.co' . $prefix . '/' . $page;
}

/**
 * Génère l'URL pour changer de langue (en conservant la page courante)
 */
function switchLangUrl(string $targetLang): string {
    $page = $_GET['page'] ?? 'home';
    $prefix = ($targetLang !== 'es') ? '/' . $targetLang : '';
    $url = $prefix . ($page === 'home' ? '/' : '/' . $page);
    if ($targetLang === 'es') {
        $url .= '?lang=es';
    }
    return $url;
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
 * Accède directement aux traductions (pour tableaux)
 */
function tRaw(string $key, string $section = 'global') {
    global $translations;
    
    $value = $translations;
    $keys = [];
    if ($section !== 'global') {
        $keys = array_merge(explode('.', $section), explode('.', $key));
    } else {
        $keys = explode('.', $key);
    }
    
    foreach ($keys as $k) {
        if (is_array($value) && array_key_exists($k, $value)) {
            $value = $value[$k];
        } else {
            return null;
        }
    }
    
    return $value;
}

/**
 * SEO - Données par page (multilingue via fichiers i18n)
 */
function getSeoData(string $page): array {
    $lang = getLang();
    
    // DONNÉES GLOBALES
    $global = [
        'site_name' => t('site_name', 'seo'),
        'site_url' => t('site_url', 'seo'),
        'twitter' => t('twitter', 'seo'),
        'favicon' => '/favicon.ico',
        'logo' => '/logo.png',
        'brand' => t('brand', 'seo'),
        'lang' => $lang,
    ];
    
    // Données SEO depuis les traductions (accès direct pour récupérer le tableau)
    $pageSeo = tRaw($page, 'seo');
    if (!is_array($pageSeo)) {
        $pageSeo = tRaw('home', 'seo') ?? [];
    }
    
    // Ajuster le canonical avec le préfixe langue
    $pageSeo['canonical'] = url($page === 'home' ? 'home' : $page);
    
    return array_merge($global, $pageSeo);
}

/**
 * Génère le Schema.org JSON-LD (multilingue)
 */
function generateSchema(array $seo, string $page): string {
    $lang = getLang();
    $descriptions = [
        'es' => 'Software líder para gestión digital de colegios en Colombia y el mundo',
        'en' => 'Leading software for digital school management in Colombia and worldwide',
        'fr' => 'Logiciel leader pour la gestion digitale des écoles en Colombie et dans le monde',
    ];
    
    $schemas = [
        'Organization' => [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $seo['site_name'] ?? 'HM',
            'url' => $seo['site_url'] ?? 'https://hm-edu.co',
            'logo' => ($seo['site_url'] ?? 'https://hm-edu.co') . ($seo['logo'] ?? '/logo.png'),
            'description' => $descriptions[$lang] ?? $descriptions['es'],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'sales',
                'availableLanguage' => ['Spanish', 'English', 'French'],
            ] + (isColombianMarket() ? ['telephone' => '+57-320-418-1193'] : []),
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
            'mainEntity' => array_filter([
                '@type' => 'Organization',
                'name' => 'HM',
                'telephone' => isColombianMarket() ? '+57-320-418-1193' : null,
            ]),
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
