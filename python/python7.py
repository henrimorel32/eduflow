
# 6. Homepage HTML/PHP avec design moderne et responsive
homepage_php = '''<?php
require_once 'includes/config.php';

// Récupération du contenu dynamique
$contenido = [];
$secciones = ['hero', 'problematica', 'solucion', 'beneficios', 'testimonios', 'cta_final'];

foreach ($secciones as $seccion) {
    $stmt = $pdo->prepare("SELECT clave, valor FROM contenido_web WHERE seccion = ?");
    $stmt->execute([$seccion]);
    while ($row = $stmt->fetch()) {
        $contenido[$seccion][$row['clave']] = $row['valor'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transformación Digital Educativa | Organiza tu Colegio</title>
    <meta name="description" content="Transforma la gestión de tu colegio. Menos desorden, más control. Organización escolar digital para colegios privados en Colombia.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        secondary: {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #22c55e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .blob {
            position: absolute;
            filter: blur(40px);
            opacity: 0.4;
            animation: float 20s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 20px rgba(37, 99, 235, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
        }
        
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        .nav-blur {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-white overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 nav-blur border-b border-gray-100 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-secondary-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Edu<span class="text-primary-600">Flow</span></span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#problematica" class="text-gray-600 hover:text-primary-600 transition">El Problema</a>
                    <a href="#solucion" class="text-gray-600 hover:text-primary-600 transition">Solución</a>
                    <a href="#beneficios" class="text-gray-600 hover:text-primary-600 transition">Beneficios</a>
                    <a href="#contacto" class="px-6 py-3 bg-primary-600 text-white rounded-full font-semibold hover:bg-primary-700 transition shadow-lg hover:shadow-xl">
                        Diagnóstico Gratis
                    </a>
                </div>
                
                <button class="md:hidden" onclick="toggleMobileMenu()">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-4 py-4 space-y-3">
                <a href="#problematica" class="block py-2 text-gray-600">El Problema</a>
                <a href="#solucion" class="block py-2 text-gray-600">Solución</a>
                <a href="#beneficios" class="block py-2 text-gray-600">Beneficios</a>
                <a href="#contacto" class="block py-3 px-4 bg-primary-600 text-white rounded-lg text-center">Diagnóstico Gratis</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <!-- Background Blobs -->
        <div class="blob bg-primary-200 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="blob bg-secondary-200 w-80 h-80 rounded-full bottom-0 right-0 translate-x-1/3 translate-y-1/3 animation-delay-2000"></div>
        <div class="blob bg-purple-200 w-64 h-64 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animation-delay-4000"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="scroll-reveal">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-50 text-primary-700 rounded-full text-sm font-semibold mb-6">
                        <i data-lucide="sparkles" class="w-4 h-4 mr-2"></i>
                        Transformación Digital para Colegios
                    </div>
                    
                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                        <?php echo htmlspecialchars($contenido['hero']['titulo_principal'] ?? 'Transforma la gestión de tu colegio sin complicarte la vida'); ?>
                    </h1>
                    
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        <?php echo htmlspecialchars($contenido['hero']['subtitulo'] ?? 'Menos desorden, más control. Organiza tu colegio y mejora la experiencia de padres y estudiantes.'); ?>
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contacto" class="pulse-ring px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-full font-bold text-lg text-center hover:shadow-2xl transition">
                            <?php echo htmlspecialchars($contenido['hero']['cta_principal'] ?? 'Solicita tu diagnóstico gratuito'); ?>
                        </a>
                        <a href="#solucion" class="px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-full font-bold text-lg text-center hover:border-primary-600 hover:text-primary-600 transition flex items-center justify-center gap-2">
                            <i data-lucide="play-circle" class="w-5 h-5"></i>
                            <?php echo htmlspecialchars($contenido['hero']['cta_secundaria'] ?? 'Ver cómo funciona'); ?>
                        </a>
                    </div>
                    
                    <div class="mt-8 flex items-center gap-4 text-sm text-gray-500">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-primary-500 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-secondary-500 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-purple-500 border-2 border-white"></div>
                        </div>
                        <span>+50 colegios ya transformaron su gestión</span>
                    </div>
                </div>
                
                <div class="relative scroll-reveal">
                    <div class="relative bg-white rounded-3xl shadow-2xl p-6 border border-gray-100">
                        <img src="https://kimi-web-img.moonshot.cn/img/other-levels.com/a7ae950a8e77bef592548df383cef40c0b26094c.png" 
                             alt="Dashboard de Gestión Escolar" 
                             class="rounded-2xl w-full shadow-lg">
                        
                        <!-- Floating Cards -->
                        <div class="absolute -left-8 top-1/4 bg-white rounded-xl shadow-xl p-4 animate-bounce" style="animation-duration: 3s;">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Matrícula completada</p>
                                    <p class="font-bold text-sm">¡Todo listo!</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute -right-4 bottom-1/4 bg-white rounded-xl shadow-xl p-4 animate-bounce" style="animation-duration: 3.5s;">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="message-circle" class="w-5 h-5 text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Nuevo mensaje</p>
                                    <p class="font-bold text-sm">Padre de familia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problemática Section -->
    <section id="problematica" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">La Realidad Hoy</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                    <?php echo htmlspecialchars($contenido['problematica']['titulo'] ?? '¿Tu equipo pierde tiempo entre WhatsApp, correos y Excel?'); ?>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    <?php echo htmlspecialchars($contenido['problematica']['descripcion'] ?? 'La información está en todas partes... menos donde debería estar.'); ?>
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover scroll-reveal">
                    <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="message-square" class="w-7 h-7 text-red-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Caos de Comunicación</h3>
                    <p class="text-gray-600">WhatsApp, correos, llamadas... la información se pierde entre múltiples canales desorganizados.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover scroll-reveal">
                    <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="file-spreadsheet" class="w-7 h-7 text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Datos Fragmentados</h3>
                    <p class="text-gray-600">Excel dispersos, versiones desactualizadas, información duplicada o contradictoria.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg card-hover scroll-reveal">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="clock" class="w-7 h-7 text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tiempo Perdido</h3>
                    <p class="text-gray-600">Horas buscando información en lugar de dedicarse a lo importante: educar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Solución Section -->
    <section id="solucion" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-primary-50 to-white opacity-50"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 scroll-reveal">
                    <div class="relative">
                        <img src="https://kimi-web-img.moonshot.cn/img/www.thoughtco.com/40518a0d6957f037926f6b4fc3d87378db3abcc1.jpg" 
                             alt="Comunicación efectiva escuela-familia" 
                             class="rounded-3xl shadow-2xl w-full">
                        
                        <!-- Stats Overlay -->
                        <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-xl p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i data-lucide="trending-up" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-3xl font-bold text-gray-900">85%</p>
                                    <p class="text-sm text-gray-500">reducción en tiempo administrativo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2 scroll-reveal">
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Nuestra Propuesta</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                        <?php echo htmlspecialchars($contenido['solucion']['titulo'] ?? 'Te ayudamos a estructurar, organizar y digitalizar tu colegio paso a paso'); ?>
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        <?php echo htmlspecialchars($contenido['solucion']['subtitulo'] ?? 'No es solo tecnología, es una nueva forma de trabajar.'); ?>
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-primary-600 font-bold">1</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Diagnóstico Personalizado</h4>
                                <p class="text-gray-600">Analizamos tus procesos actuales y identificamos oportunidades de mejora.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-primary-600 font-bold">2</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Diseño de Flujos</h4>
                                <p class="text-gray-600">Creamos procesos claros y estandarizados para cada área de tu colegio.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-primary-600 font-bold">3</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Implementación Acompañada</h4>
                                <p class="text-gray-600">Te guiamos en cada paso con capacitación y soporte continuo.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios Section -->
    <section id="beneficios" class="py-24 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-400 font-semibold text-sm uppercase tracking-wider">Resultados Reales</span>
                <h2 class="text-4xl font-bold mt-4 mb-6">
                    <?php echo htmlspecialchars($contenido['beneficios']['titulo'] ?? 'Más tiempo para educar, menos estrés administrativo'); ?>
                </h2>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gray-800 rounded-2xl p-8 card-hover scroll-reveal">
                    <div class="w-14 h-14 bg-blue-500/20 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="layout-grid" class="w-7 h-7 text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3"><?php echo htmlspecialchars($contenido['beneficios']['item_1'] ?? 'Orden y claridad'); ?></h3>
                    <p class="text-gray-400">Procesos claros en todos los departamentos, desde admisiones hasta coordinación.</p>
                </div>
                
                <div class="bg-gray-800 rounded-2xl p-8 card-hover scroll-reveal">
                    <div class="w-14 h-14 bg-green-500/20 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="heart-handshake" class="w-7 h-7 text-green-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3"><?php echo htmlspecialchars($contenido['beneficios']['item_2'] ?? 'Comunicación fluida'); ?></h3>
                    <p class="text-gray-400">Padres informados y felices, con canales claros y respuestas oportunas.</p>
                </div>
                
                <div class="bg-gray-800 rounded-2xl p-8 card-hover scroll-reveal">
                    <div class="w-14 h-14 bg-purple-500/20 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="eye" class="w-7 h-7 text-purple-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3"><?php echo htmlspecialchars($contenido['beneficios']['item_3'] ?? 'Control total'); ?></h3>
                    <p class="text-gray-400">Visibilidad completa de matrículas, pensiones, asistencia y rendimiento.</p>
                </div>
                
                <div class="bg-gray-800 rounded-2xl p-8 card-hover scroll-reveal">
                    <div class="w-14 h-14 bg-yellow-500/20 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="coffee" class="w-7 h-7 text-yellow-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3"><?php echo htmlspecialchars($contenido['beneficios']['item_4'] ?? 'Tranquilidad'); ?></h3>
                    <p class="text-gray-400">Equipo enfocado en educar, no en lidiar con desorden administrativo.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios Section -->
    <section class="py-24 bg-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    <?php echo htmlspecialchars($contenido['testimonios']['titulo'] ?? 'Colegios que ya transformaron su gestión'); ?>
                </h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-reveal">
                    <div class="flex items-center gap-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6">"Pasamos de 3 días a 3 horas en el proceso de matrícula. La tranquilidad de nuestros padres de familia es invaluable."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                            <span class="text-primary-700 font-bold">MR</span>
                        </div>
                        <div>
                            <p class="font-bold">María Rodríguez</p>
                            <p class="text-sm text-gray-500">Directora, Colegio San José</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-reveal">
                    <div class="flex items-center gap-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6">"Finalmente tenemos toda la información en un solo lugar. El seguimiento a estudiantes nunca había sido tan eficiente."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-secondary-100 rounded-full flex items-center justify-center">
                            <span class="text-secondary-700 font-bold">CP</span>
                        </div>
                        <div>
                            <p class="font-bold">Carlos Pérez</p>
                            <p class="text-sm text-gray-500">Coordinador Académico, Institución Educativa Norte</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-reveal">
                    <div class="flex items-center gap-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-6">"La comunicación con padres mejoró 100%. Saben exactamente dónde buscar información y nosotros respondemos más rápido."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <span class="text-purple-700 font-bold">AL</span>
                        </div>
                        <div>
                            <p class="font-bold">Ana López</p>
                            <p class="text-sm text-gray-500">Secretaria Académica, Colegio del Valle</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final Section -->
    <section id="contacto" class="py-24 bg-gradient-to-br from-primary-600 to-primary-800 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center scroll-reveal">
            <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                <?php echo htmlspecialchars($contenido['cta_final']['titulo'] ?? '¿Listo para organizar tu colegio?'); ?>
            </h2>
            <p class="text-xl text-primary-100 mb-12">
                <?php echo htmlspecialchars($contenido['cta_final']['subtitulo'] ?? 'Comienza con un diagnóstico gratuito de tu situación actual.'); ?>
            </p>
            
            <form class="bg-white rounded-3xl p-8 shadow-2xl max-w-2xl mx-auto" action="procesar_contacto.php" method="POST">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-left text-gray-700 font-semibold mb-2">Nombre completo</label>
                        <input type="text" name="nombre" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                               placeholder="Tu nombre">
                    </div>
                    <div>
                        <label class="block text-left text-gray-700 font-semibold mb-2">Correo electrónico</label>
                        <input type="email" name="email" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                               placeholder="tu@email.com">
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-left text-gray-700 font-semibold mb-2">Nombre del colegio</label>
                        <input type="text" name="colegio" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                               placeholder="Institución Educativa...">
                    </div>
                    <div>
                        <label class="block text-left text-gray-700 font-semibold mb-2">Cargo</label>
                        <select name="cargo" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800">
                            <option value="">Selecciona tu cargo</option>
                            <option value="director">Director(a)</option>
                            <option value="coordinador">Coordinador(a)</option>
                            <option value="secretario">Secretario(a) Académico</option>
                            <option value="administrativo">Administrativo</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-left text-gray-700 font-semibold mb-2">¿Qué proceso te gustaría mejorar?</label>
                    <textarea name="mensaje" rows="3" 
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                              placeholder="Cuéntanos brevemente sobre tu situación actual..."></textarea>
                </div>
                
                <button type="submit" 
                        class="w-full py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-bold text-lg hover:shadow-xl transition transform hover:scale-[1.02]">
                    <?php echo htmlspecialchars($contenido['cta_final']['boton'] ?? 'Agenda tu diagnóstico ahora'); ?>
                    <i data-lucide="arrow-right" class="inline-block w-5 h-5 ml-2"></i>
                </button>
                
                <p class="text-sm text-gray-500 mt-4">
                    <i data-lucide="shield-check" class="inline-block w-4 h-4 mr-1"></i>
                    Tu información está segura. Nunca compartimos tus datos.
                </p>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary-600 to-secondary-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-white">Edu<span class="text-primary-400">Flow</span></span>
                    </div>
                    <p class="text-sm">Aliado en la organización y modernización de colegios en Colombia.</p>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4">Soluciones</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Gestión de Admisiones</a></li>
                        <li><a href="#" class="hover:text-white transition">Comunicación Padres</a></li>
                        <li><a href="#" class="hover:text-white transition">Seguimiento Académico</a></li>
                        <li><a href="#" class="hover:text-white transition">Administración</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4">Recursos</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Guías</a></li>
                        <li><a href="#" class="hover:text-white transition">Webinars</a></li>
                        <li><a href="#" class="hover:text-white transition">Casos de Éxito</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4">Contacto</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            hola@eduflow.co
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            +57 (1) 234 5678
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            Bogotá, Colombia
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">© 2024 EduFlow. Todos los derechos reservados.</p>
                <div class="flex gap-4 mt-4 md:mt-0">
                    <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary-600 transition">
                        <i data-lucide="linkedin" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary-600 transition">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary-600 transition">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
        
        // Scroll reveal animation
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.scroll-reveal').forEach((el) => observer.observe(el));
        
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
'''

with open('/Users/henri/Documents/GitHub/ESchool/php/src/index.php', 'w') as f:
    f.write(homepage_php)

print("✅ Homepage PHP créée avec succès!")
