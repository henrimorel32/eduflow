<?php
declare(strict_types=1);

// ============================================
// 1. CHARGEMENT FUNCTIONS (obligatoire avant tout)
// ============================================

$functionsPath = __DIR__ . '/functions.php';
if (!file_exists($functionsPath)) {
    die('Erreur: functions.php introuvable');
}
require_once $functionsPath;

// ============================================
// 2. DÉTERMINATION PAGE + SEO
// ============================================

$currentPage = $_GET['page'] ?? 'home';

// Récupère les données SEO
$seo = getSeoData($currentPage);

// ============================================
// 3. VARIABLES AVEC FALLBACKS ABSOLUS (jamais null)
// ============================================

// Fallbacks pour toutes les clés SEO possibles
$siteUrl = $seo['site_url'] ?? 'https://hm-edu.co';
$siteName = $seo['site_name'] ?? 'HM';
$twitter = $seo['twitter'] ?? '@hm_edu';

$pageTitle = $pageTitle ?? $seo['title'] ?? 'HM - Software para Colegios';
$pageDescription = $pageDescription ?? $seo['description'] ?? 'Sistema escuela integral';
$pageKeywords = $pageKeywords ?? $seo['keywords'] ?? 'software colegio, sistema escuela';
$pageH1 = $pageH1 ?? $seo['h1'] ?? 'Software para Colegios';
$pageCanonical = $pageCanonical ?? $seo['canonical'] ?? '/';
$pageOgImage = $pageOgImage ?? $seo['og_image'] ?? '/og-default.jpg';
$ctaNav = $seo['cta_nav'] ?? 'Diagnóstico Gratis';

// DEBUG (décommente si besoin)
// error_log("SEO: " . print_r($seo, true));
?>

<!DOCTYPE html>
<html lang="es-CO" class="scroll-smooth">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W26JM3VK');</script>
    <!-- End Google Tag Manager -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <meta property="og:title" content="HM" />
    <meta property="og:description" content="<?= e((string)$pageDescription) ?>" />
    <meta property="og:image" content="https://henrimorel.com/logo.png" />
    <meta property="og:url" content="https://henrimorel.com" />
    <meta property="og:type" content="website" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    
    <!-- ========== SEO CORE ========== -->
    <title><?= e((string)$pageTitle) ?></title>
    <meta name="description" content="<?= e((string)$pageDescription) ?>">
    <meta name="keywords" content="<?= e((string)$pageKeywords) ?>">
    
    <!-- Canonical & Hreflang (avec variables locales, pas $seo direct) -->
    <link rel="canonical" href="<?= e((string)$siteUrl) ?><?= e((string)$pageCanonical) ?>">
    <link rel="alternate" hreflang="es-CO" href="<?= e((string)$siteUrl) ?><?= e((string)$pageCanonical) ?>">
    <link rel="alternate" hreflang="es" href="<?= e((string)$siteUrl) ?><?= e((string)$pageCanonical) ?>">
    <link rel="alternate" hreflang="x-default" href="<?= e((string)$siteUrl) ?>">
    
    <!-- ========== OPEN GRAPH ========== -->
    <meta property="og:locale" content="es_CO">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e((string)$pageTitle) ?>">
    <meta property="og:description" content="<?= e((string)$pageDescription) ?>">
    <meta property="og:url" content="<?= e((string)$siteUrl) ?><?= e((string)$pageCanonical) ?>">
    <meta property="og:site_name" content="<?= e((string)$siteName) ?>">
    <meta property="og:image" content="<?= e((string)$siteUrl) ?><?= e((string)$pageOgImage) ?>">

    <!-- Canonical & Hreflang -->
    <link rel="canonical" href="<?= e($seo['site_url'] . $pageCanonical) ?>">
    <link rel="alternate" hreflang="es-CO" href="<?= e($seo['site_url'] . $pageCanonical) ?>">
    <link rel="alternate" hreflang="es" href="<?= e($seo['site_url'] . $pageCanonical) ?>">
    <link rel="alternate" hreflang="x-default" href="<?= e($seo['site_url']) ?>">
    <!-- ========== FAVICONS ========== -->

    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <!-- ========== PRECONNECT & PRELOAD ========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://unpkg.com">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"></noscript>
    
    <!-- ========== STYLES ========== -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: { 
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd',
                            400: '#60a5fa', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8',
                            800: '#1e40af', 900: '#1e3a8a', 950: '#172554',
                        },
                        secondary: { 
                            50: '#f0fdf4', 100: '#dcfce7', 500: '#22c55e', 600: '#16a34a',
                        },
                        dark: { 900: '#0f172a', 800: '#1e293b', 700: '#334155' }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'gradient-x': 'gradient-x 15s ease infinite',
                        'bounce-slow': 'bounce 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        'gradient-x': {
                            '0%, 100%': { 'background-position': '0% 50%' },
                            '50%': { 'background-position': '100% 50%' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- ========== STYLES CRITIQUES ========== -->
    <style>
        /* Gradient text utility */
        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #22c55e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Animated gradient background */
        .gradient-animated {
            background: linear-gradient(-45deg, #1e40af, #3b82f6, #22c55e, #1e40af);
            background-size: 400% 400%;
            animation: gradient-x 15s ease infinite;
        }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        /* Blob animations */
        .blob {
            position: absolute;
            filter: blur(60px);
            opacity: 0.5;
            animation: float 20s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        
        /* Pulse ring animation */
        .pulse-ring {
            position: relative;
        }
        
        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: inherit;
            background: linear-gradient(135deg, #2563eb, #22c55e);
            opacity: 0;
            z-index: -1;
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.7; }
            70% { transform: scale(1.1); opacity: 0; }
            100% { transform: scale(0.95); opacity: 0; }
        }
        
        /* Scroll reveal */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #22c55e);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #16a34a);
        }
        
        /* Navigation blur */
        .nav-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Magnetic button effect */
        .btn-magnetic {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-magnetic:hover {
            transform: scale(1.05);
        }
        
        /* Shine effect */
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.3) 50%,
                rgba(255,255,255,0) 100%
            );
            transform: rotate(30deg) translateX(-100%);
            transition: transform 0.6s;
        }
        
        .btn-shine:hover::after {
            transform: rotate(30deg) translateX(100%);
        }
        
        /* Screen reader only */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
    </style>
    
    <!-- ========== SCHEMA.ORG ========== -->
    <?= generateSchema($seo, $currentPage) ?>
    
    <!-- ========== GOOGLE ANALYTICS (décommente quand prêt) ========== -->
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-90M0NHP0R3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-90M0NHP0R3');
</script>
</head>
<body class="font-sans antialiased text-gray-800 bg-white overflow-x-hidden selection:bg-primary-100 selection:text-primary-900">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W26JM3VK"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Skip to content (accessibilité) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary-600 focus:text-white focus:rounded-lg">
        Saltar al contenido principal
    </a>

    <!-- Navigation ultra-moderne -->
    <nav class="fixed w-full z-50 nav-glass transition-all duration-500" id="navbar" role="navigation" aria-label="Navegación principal">
        <!-- Top bar avec social proof -->
        <div class="bg-gradient-to-r from-primary-900 via-primary-800 to-primary-900 text-white py-2 px-4 text-center text-sm hidden lg:block">
            <div class="max-w-7xl mx-auto flex items-center justify-center gap-6">
                <span class="flex items-center gap-2">
                    <?= pulseBadge('+50 colegios transformados', 'secondary') ?>
                </span>
                <span class="text-primary-200">|</span>
                <span class="text-primary-100">Transformación digital para colegios en Colombia</span>
                <span class="text-primary-200">|</span>
                <a href="tel:+573204181193" class="flex items-center gap-2 hover:text-white transition-colors">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                    +57 320 418 1193
                </a>
            </div>
        </div>
        
        <!-- Main nav -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo avec micro-interactions -->
                <a href="<?= url('home') ?>" class="group flex items-center space-x-3 relative" aria-label="HM - Inicio">
                    <div class="relative w-12 h-12 bg-gradient-to-br from-primary-600 via-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-primary-500/50 transition-all duration-300 group-hover:scale-105 group-hover:rotate-3">
                        <i data-lucide="graduation-cap" class="w-7 h-7 text-white"></i>
                        <!-- Glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-secondary-400 rounded-2xl opacity-0 group-hover:opacity-30 blur-xl transition-opacity duration-300"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold text-gray-900 tracking-tight group-hover:text-primary-600 transition-colors">
                            H<span class="text-primary-600">M</span>
                        </span>
                        <span class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">Software Escuela</span>
                    </div>
                </a>
                
                <!-- Desktop Navigation avec indicateurs visuels -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="<?= url('home') ?>" class="<?= isActive('home') ?> px-4 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        Inicio
                    </a>
                    
                    <a href="<?= url('soluciones') ?>" class="<?= isActive('soluciones') ?> px-4 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        Sistema Escuela
                    </a>

                     <a href="<?= url('inscripcion') ?>" class="<?= isActive('inscripcion') ?> px-4 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        Demo Inscripción
                    </a>
                    
                    <a href="<?= url('suscripcion') ?>" class="<?= isActive('suscripcion') ?> px-4 py-2 rounded-lg bg-gradient-to-r from-yellow-400 to-orange-500 text-white hover:from-yellow-500 hover:to-orange-600 transition-all font-semibold shadow-lg">
                        🎓 Suscribir Colegio
                    </a>
                    
                    <a href="<?= url('saberpro') ?>" class="<?= isActive('saberpro') ?> px-4 py-2 rounded-lg hover:bg-gray-50 transition-all flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        Preparación Saber PRO
                    </a>

                    <a href="<?= url('icfes') ?>" class="<?= isActive('icfes') ?> px-4 py-2 rounded-lg hover:bg-gray-50 transition-all flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary-500"></span>
                        </span>
                        Nuestra plataforma ICFES
                    </a>

                    <a href="<?= url('aplicaciones') ?>" class="<?= isActive('aplicaciones') ?> px-4 py-2 rounded-lg hover:bg-gray-50 transition-all flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                        </span>
                        Nuestras aplicaciones
                    </a>

                      <a href="<?= url('contacto') ?>" class="<?= isActive('contacto') ?> px-4 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        Contacto
                    </a>
                    
                    <!-- <a href="<?= url('home') ?>#testimonios" class="text-gray-600 hover:text-primary-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition-all">
                        Casos de Éxito
                    </a> -->
                </div>
                
                <!-- CTA Principal - Bouton marketing -->
                <div class="hidden lg:flex items-center gap-4">
                   <a href="https://wa.me/573204181193?text=Hola%20quiero%20informaci%C3%B3n%20sobre%20la%20plataforma" 
                        target="_blank"
                        class="text-gray-600 hover:text-primary-600 transition-colors flex items-center gap-2 text-sm font-medium">
                            <i data-lucide="headphones" class="w-4 h-4"></i>
                            Soporte
                        </a>
                    
                    <a href="<?= url('home') ?>#diagnostico" class="btn-magnetic btn-shine group relative px-6 py-3 bg-gradient-to-r from-primary-600 via-primary-500 to-secondary-500 text-white rounded-full font-semibold shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 transition-all flex items-center gap-2 overflow-hidden">
                        <span class="relative z-10"><?= e($seo['cta_nav']) ?></span>
                        <i data-lucide="arrow-right" class="w-4 h-4 relative z-10 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="toggleMobileMenu()" aria-label="Abrir menú" aria-expanded="false" id="mobile-menu-btn">
                    <i data-lucide="menu" class="w-6 h-6 text-gray-700"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu - Design moderne -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 shadow-2xl" role="menu">
            <div class="px-4 py-6 space-y-4 max-w-lg mx-auto">
                <!-- Mobile header -->
                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Menú</span>
                    <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Cerrar menú">
                        <i data-lucide="x" class="w-5 h-5 text-gray-500"></i>
                    </button>
                </div>
                
                <!-- Links -->
                <a href="<?= url('home') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-600 transition-all group">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                        <i data-lucide="home" class="w-5 h-5 text-primary-600"></i>
                    </div>
                    <div>
                        <span class="font-semibold block">Inicio</span>
                        <span class="text-xs text-gray-500">Software para colegios</span>
                    </div>
                </a>
                
                <a href="<?= url('soluciones') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-600 transition-all group">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                        <i data-lucide="layout-grid" class="w-5 h-5 text-primary-600"></i>
                    </div>
                    <div>
                        <span class="font-semibold block">Sistema Escuela</span>
                        <span class="text-xs text-gray-500">Todas las funcionalidades</span>
                    </div>
                </a>
                
                <a href="<?= url('saberpro') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-50 text-gray-700 hover:text-orange-600 transition-all group">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <i data-lucide="briefcase" class="w-5 h-5 text-orange-600"></i>
                    </div>
                    <div>
                        <span class="font-semibold block">Preparación Saber PRO</span>
                        <span class="text-xs text-gray-500">Simulacros reales</span>
                    </div>
                    <span class="ml-auto px-2 py-1 bg-orange-500 text-white text-xs rounded-full font-bold">TOP</span>
                </a>

                <a href="<?= url('icfes') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-secondary-50 text-gray-700 hover:text-secondary-600 transition-all group">
                    <div class="w-10 h-10 bg-secondary-100 rounded-lg flex items-center justify-center group-hover:bg-secondary-200 transition-colors">
                        <i data-lucide="brain" class="w-5 h-5 text-secondary-600"></i>
                    </div>
                    <div>
                        <span class="font-semibold block">Preparación ICFES</span>
                        <span class="text-xs text-gray-500">IA adaptativa</span>
                    </div>
                    <span class="ml-auto px-2 py-1 bg-secondary-500 text-white text-xs rounded-full font-bold">NUEVO</span>
                </a>

                <a href="<?= url('aplicaciones') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-purple-50 text-gray-700 hover:text-purple-600 transition-all group">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                        <i data-lucide="layout-grid" class="w-5 h-5 text-purple-600"></i>
                    </div>
                    <div>
                        <span class="font-semibold block">Nuestras aplicaciones</span>
                        <span class="text-xs text-gray-500">Todas nuestras plataformas</span>
                    </div>
                    <span class="ml-auto px-2 py-1 bg-purple-500 text-white text-xs rounded-full font-bold">NUEVO</span>
                </a>
                
                <a href="<?= url('suscripcion') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-yellow-50 to-orange-50 hover:from-yellow-100 hover:to-orange-100 text-gray-700 hover:text-orange-700 transition-all group border-2 border-yellow-400">
                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center shadow-lg">
                        <span class="text-xl">🎓</span>
                    </div>
                    <div>
                        <span class="font-semibold block">Suscribir Colegio</span>
                        <span class="text-xs text-gray-500">Crea tu página de inscripción</span>
                    </div>
                    <span class="ml-auto px-2 py-1 bg-orange-500 text-white text-xs rounded-full font-bold">GRATIS</span>
                </a>
                
                <!-- Contact info mobile -->
                <div class="pt-4 border-t border-gray-100 space-y-3">
                    <a href="tel:+573204181193" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 transition-all">
                        <i data-lucide="phone" class="w-5 h-5 text-primary-600"></i>
                        <span class="font-medium">+57 320 418 1193</span>
                    </a>
                    
                    <a href="<?= url('home') ?>#contacto" class="block w-full px-6 py-4 bg-gradient-to-r from-primary-600 to-secondary-500 text-white rounded-xl font-bold text-center shadow-lg">
                        <?= e($seo['cta_nav']) ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Spacer pour la nav fixe -->
    <div class="h-20 lg:h-28"></div>

    <!-- H1 caché SEO si pas visible dans hero -->
    <?php if ($currentPage !== 'home' || empty($contenido['hero']['titulo_principal'])): ?>
    <h1 class="sr-only"><?= e($pageH1) ?></h1>
    <?php endif; ?>

    <!-- Main content start -->
    <main id="main-content" class="relative">

    <!-- Scripts navigation -->
    <script>
        // Toggle mobile menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const btn = document.getElementById('mobile-menu-btn');
            const isHidden = menu.classList.contains('hidden');
            
            menu.classList.toggle('hidden');
            btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            
            // Animation d'entrée
            if (isHidden) {
                menu.style.opacity = '0';
                menu.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    menu.style.transition = 'all 0.3s ease';
                    menu.style.opacity = '1';
                    menu.style.transform = 'translateY(0)';
                }, 10);
            }
        }
        
        // Navbar scroll effect
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar.classList.add('shadow-lg');
                if (currentScroll > lastScroll && currentScroll > 300) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }
            } else {
                navbar.classList.remove('shadow-lg');
                navbar.style.transform = 'translateY(0)';
            }
            
            lastScroll = currentScroll;
        });
        
        // Smooth scroll pour ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#') && href.length > 1) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        // Fermer mobile menu si ouvert
                        document.getElementById('mobile-menu').classList.add('hidden');
                    }
                }
            });
        });
        
        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>