<?php
declare(strict_types=1);

session_start();

define('ROOT_PATH', dirname(__DIR__));
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PAGES_PATH', ROOT_PATH . '/pages');
define('I18N_PATH', ROOT_PATH . '/i18n');
define('ASSETS_URL', '/assets');

// =====================================================
// DETECTION LANGUE
// =====================================================

$langs = ['es', 'en', 'fr'];
$lang = 'en'; // default = anglais (marché mondial)

// Priorité 1: paramètre GET ?lang=xx
if (!empty($_GET['lang']) && in_array($_GET['lang'], $langs, true)) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
}
// Priorité 2: session
elseif (!empty($_SESSION['lang']) && in_array($_SESSION['lang'], $langs, true)) {
    $lang = $_SESSION['lang'];
}
// Priorité 3: langue du navigateur (fallback EN si non supportée)
else {
    $acceptLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    if (!empty($acceptLang)) {
        // Parse les langues acceptées (ex: fr-FR,fr;q=0.9,en-US;q=0.8)
        preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)\s*(?:;q=([0-9.]+))?/', strtolower($acceptLang), $matches);
        $browserLangs = [];
        foreach ($matches[1] as $i => $code) {
            $q = $matches[2][$i] !== '' ? (float)$matches[2][$i] : 1.0;
            $browserLangs[$code] = $q;
        }
        arsort($browserLangs);
        
        foreach (array_keys($browserLangs) as $code) {
            $base = substr($code, 0, 2);
            if (in_array($base, $langs, true)) {
                $lang = $base;
                break;
            }
        }
    }
    $_SESSION['lang'] = $lang;
}

// =====================================================
// RESOLUTION URL (avec support préfixe langue /en/page)
// =====================================================

$page = 'home';
$rawPath = '';

// Priorité 1: paramètre GET
if (!empty($_GET['page'])) {
    $rawPath = trim($_GET['page'], '/');
}
// Priorité 2: PATH_INFO
elseif (!empty($_SERVER['PATH_INFO'])) {
    $rawPath = trim($_SERVER['PATH_INFO'], '/');
}
// Priorité 3: REQUEST_URI
elseif (!empty($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    $uri = preg_replace('#^public/#', '', $uri);
    $uri = preg_replace('/\.php$/', '', $uri);
    $uri = preg_replace('#^index\.php/?#', '', $uri);
    $rawPath = $uri;
}

// Extraction du préfixe de langue (/en/page -> lang=en, page=page)
if (!empty($rawPath)) {
    $parts = explode('/', $rawPath);
    if (in_array($parts[0], $langs, true)) {
        $lang = $parts[0];
        $_SESSION['lang'] = $lang;
        array_shift($parts);
        $page = implode('/', $parts);
    } else {
        $page = $rawPath;
    }
}

// Si pas de page après le langue, home
$page = $page ?: 'home';

// =====================================================
// SECURITE
// =====================================================

$page = preg_replace('/[^a-z0-9_-]/i', '', $page);
$page = $page ?: 'home';

$allowed = ['home', 'soluciones', 'contacto', 'icfes', 'aplicaciones', 'saberpro', 'procesar_contacto','inscripcion','suscripcion','check_nombre','check_disponibilidad','myschoolby'];
if (!in_array($page, $allowed, true)) {
    $page = 'home';
}

// =====================================================
// CHARGEMENT I18N
// =====================================================

require_once INCLUDES_PATH . '/functions.php';
loadLang($lang);

// Pages API / endpoints (pas de header/footer)
$apiPages = ['procesar_contacto', 'check_nombre', 'check_disponibilidad'];
if (in_array($page, $apiPages, true)) {
    require_once INCLUDES_PATH . '/config.php';
    require PAGES_PATH . '/' . $page . '.php';
    exit;
}

// =====================================================
# CHARGEMENT PAGE
// =====================================================

$pageFile = PAGES_PATH . '/' . $page . '.php';

if (!file_exists($pageFile)) {
    $page = 'home';
    $pageFile = PAGES_PATH . '/home.php';
}

// Exposer la page courante pour le header/functions
$_GET['page'] = $page;

define('CURRENT_PAGE', $page);
define('CURRENT_LANG', $lang);

require_once INCLUDES_PATH . '/config.php';
require_once INCLUDES_PATH . '/header.php';
require_once $pageFile;
require_once INCLUDES_PATH . '/footer.php';