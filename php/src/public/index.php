<?php
declare(strict_types=1);

session_start();

define('ROOT_PATH', dirname(__DIR__));
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PAGES_PATH', ROOT_PATH . '/pages');
define('ASSETS_URL', '/assets');

// =====================================================
// RESOLUTION URL
// =====================================================

$page = 'home';


// Priorité 1: paramètre GET (/?page=xxx ou /index.php?page=xxx)
if (!empty($_GET['page'])) {
    $page = trim($_GET['page'], '/');
} 
// Priorité 2: PATH_INFO
elseif (!empty($_SERVER['PATH_INFO'])) {
    $page = trim($_SERVER['PATH_INFO'], '/');
}
// Priorité 3: REQUEST_URI
elseif (!empty($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    
    // Nettoyer
    $uri = preg_replace('#^public/#', '', $uri);
    $uri = preg_replace('/\.php$/', '', $uri);
    $uri = preg_replace('#^index\.php/?#', '', $uri);
    
    if (!empty($uri)) {
        $page = $uri;
    }
}

// =====================================================
// SECURITE
// =====================================================

$page = preg_replace('/[^a-z0-9_-]/i', '', $page); // Nettoyage
$page = $page ?: 'home';

$allowed = ['home', 'soluciones', 'contacto', 'icfes','procesar_contacto','inscripcion'];
if (!in_array($page, $allowed, true)) {
    $page = 'home';
}

//page de process à ne pas router
if ($page === 'procesar_contacto') {
    require PAGES_PATH . '/procesar_contacto.php';
    exit;
}
// =====================================================
# CHARGEMENT
// =====================================================

$pageFile = PAGES_PATH . '/' . $page . '.php';

if (!file_exists($pageFile)) {
    $page = 'home';
    $pageFile = PAGES_PATH . '/home.php';
}

require_once INCLUDES_PATH . '/config.php';
require_once INCLUDES_PATH . '/functions.php';
require_once INCLUDES_PATH . '/header.php';
require_once $pageFile;
require_once INCLUDES_PATH . '/footer.php';