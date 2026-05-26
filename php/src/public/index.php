<?php
declare(strict_types=1);

session_start();

define('ROOT_PATH', dirname(__DIR__));
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PAGES_PATH', ROOT_PATH . '/pages');
define('I18N_PATH', ROOT_PATH . '/i18n');
define('ASSETS_URL', '/assets');

// =====================================================
// LANGUES SUPPORTÉES
// =====================================================

$langs = ['es', 'en', 'fr'];

// =====================================================
// RÉSOLUTION URL (extrait page + préfixe langue potentiel)
// =====================================================

$page = 'home';
$rawPath = '';
$langFromUrl = null;

if (!empty($_GET['page'])) {
    $rawPath = trim($_GET['page'], '/');
} elseif (!empty($_SERVER['PATH_INFO'])) {
    $rawPath = trim($_SERVER['PATH_INFO'], '/');
} elseif (!empty($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    $uri = preg_replace('#^public/#', '', $uri);
    $uri = preg_replace('/\.php$/', '', $uri);
    $uri = preg_replace('#^index\.php/?#', '', $uri);
    $rawPath = $uri;
}

if (!empty($rawPath)) {
    $parts = explode('/', $rawPath);
    if (in_array($parts[0], $langs, true)) {
        $langFromUrl = $parts[0];
        array_shift($parts);
        $page = implode('/', $parts);
    } else {
        $page = $rawPath;
    }
}

$page = $page ?: 'home';

// =====================================================
// DÉTECTION LANGUE
// Priorité: GET ?lang=xx > Préfixe URL > Session (choix explicite) > Navigateur > Défaut ES
// =====================================================

if (!empty($_GET['lang']) && in_array($_GET['lang'], $langs, true)) {
    // Priorité 1: paramètre GET explicite (clic sur le sélecteur)
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
    $_SESSION['lang_chosen'] = true;
} elseif ($langFromUrl !== null) {
    // Priorité 2: préfixe URL (/en/page, /fr/page)
    $lang = $langFromUrl;
    $_SESSION['lang'] = $lang;
    $_SESSION['lang_chosen'] = true;
} elseif (!empty($_SESSION['lang_chosen']) && !empty($_SESSION['lang']) && in_array($_SESSION['lang'], $langs, true)) {
    // Priorité 3: l'utilisateur a déjà choisi une langue explicitement
    $lang = $_SESSION['lang'];
} else {
    // Priorité 4: détection navigateur (pas de choix explicite encore)
    $lang = 'es';
    $acceptLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
    if (!empty($acceptLang)) {
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
// REDIRECTION PROPRE (si ?lang=xx ne correspond pas à l'URL)
// =====================================================
if (!empty($_GET['lang']) && in_array($_GET['lang'], $langs, true)) {
    $needsRedirect = false;
    if ($langFromUrl === null && $_GET['lang'] !== 'es') {
        // /contacto?lang=fr  →  doit rediriger vers /fr/contacto
        $needsRedirect = true;
    } elseif ($langFromUrl !== null && $_GET['lang'] !== $langFromUrl) {
        // /fr/contacto?lang=en  →  doit rediriger vers /en/contacto
        $needsRedirect = true;
    }
    if ($needsRedirect) {
        $targetPrefix = ($_GET['lang'] !== 'es') ? '/' . $_GET['lang'] : '';
        $targetUrl = $targetPrefix . ($page === 'home' ? '/' : '/' . $page);
        header('Location: ' . $targetUrl, true, 302);
        exit;
    }
}

// =====================================================
// SÉCURITÉ
// =====================================================

$page = preg_replace('/[^a-z0-9_-]/i', '', $page);
$page = $page ?: 'home';

$allowed = ['home', 'soluciones', 'contacto', 'icfes', 'aplicaciones', 'saberpro', 'realisaciones', 'procesar_contacto','inscripcion','suscripcion','check_nombre','check_disponibilidad','myschoolby'];
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
