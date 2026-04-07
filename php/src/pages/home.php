<?php
declare(strict_types=1);

// SEO optimisé pour consultoría en optimización de sistemas
$pageTitle = 'Optimización de Sistemas Educativos Colombia | Consultoría TI para Escuela';
$pageDescription = 'Deja de comprar software. Optimiza lo que ya tienes. Consultoría especializada en escuela: auditoría de sistemas, eliminación de duplicados, SSO e integración de aplicaciones. +50 escuelas en Colombia y Latinoamérica.';
$pageH1 = 'Consultoría en Optimización de Sistemas Educativos';

// Contenu dynamique
$contenido = [];
foreach (['hero', 'problema', 'metodologia', 'servicios', 'casos', 'contacto'] as $seccion) {
    $contenido[$seccion] = getContent($seccion);
}
?>
<script
  src="https://challenges.cloudflare.com/turnstile/v0/api.js"
  async
  defer
></script>
<!-- HERO SECTION - Posicionamiento claro: NO vendemos software -->
<section class="relative min-h-screen flex items-center pt-20 overflow-hidden bg-gradient-to-br from-gray-50 to-white">
    <!-- Elementos decorativos sutiles -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-primary-50/30 -skew-x-12 transform origin-top-right"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary-100/20 rounded-full blur-3xl"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="scroll-reveal">
                <!-- Badge de posicionamiento -->
                <div class="inline-flex items-center px-4 py-2 bg-red-50 text-red-700 rounded-full text-sm font-bold mb-6 border border-red-100">
                    <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                    No vendemos software. Optimizamos el que ya tienes.
                </div>
                
                <!-- H1 principal -->
                <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-6 text-gray-900">
                    Tu Escuela Ya Tiene las Herramientas.<br>
                    <span class="text-primary-600">Falta Que Hablen Entre Ellas.</span>
                </h1>
                
                <!-- Subtítulo explicativo -->
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Consultoría especializada en <strong>auditoría y optimización de sistemas de información</strong> 
                    para instituciones educativas. Detectamos duplicados, integramos aplicaciones, 
                    implementamos <strong>SSO</strong> y hacemos fluir la información sin comprar más licencias.
                </p>
                
                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#diagnostico" class="pulse-ring px-8 py-4 bg-primary-600 text-white rounded-full font-bold text-lg text-center hover:bg-primary-700 transition shadow-lg hover:shadow-xl">
                        Diagnóstico Gratuito del Sistema
                    </a>
                    <a href="#metodologia" class="px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-full font-bold text-lg text-center hover:border-primary-600 hover:text-primary-600 transition">
                        Cómo Trabajamos
                    </a>
                </div>
                
                <!-- Indicadores de confianza -->
                <div class="mt-10 flex flex-wrap items-center gap-6 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                        <span>Sin nuevas licencias</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                        <span>+50 escuelas optimizadas</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                        <span>Colombia y Latinoamérica</span>
                    </div>
                </div>
            </div>
            
            <!-- Visual del caos vs orden -->
            <div class="relative scroll-reveal">
                <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                    <!-- Representación visual del problema -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border border-red-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-red-200 rounded-lg flex items-center justify-center">
                                    <i data-lucide="file-spreadsheet" class="w-5 h-5 text-red-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Excel de Notas</p>
                                    <p class="text-xs text-red-600">Desactualizado</p>
                                </div>
                            </div>
                            <i data-lucide="x" class="w-5 h-5 text-red-500"></i>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border border-red-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-red-200 rounded-lg flex items-center justify-center">
                                    <i data-lucide="database" class="w-5 h-5 text-red-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Base de Datos Matrículas</p>
                                    <p class="text-xs text-red-600">Información duplicada</p>
                                </div>
                            </div>
                            <i data-lucide="x" class="w-5 h-5 text-red-500"></i>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border border-red-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-red-200 rounded-lg flex items-center justify-center">
                                    <i data-lucide="message-circle" class="w-5 h-5 text-red-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">App de Comunicación</p>
                                    <p class="text-xs text-red-600">Desconectada del resto</p>
                                </div>
                            </div>
                            <i data-lucide="x" class="w-5 h-5 text-red-500"></i>
                        </div>
                        
                        <!-- Flecha de transformación -->
                        <div class="flex justify-center py-2">
                            <div class="bg-primary-100 p-2 rounded-full animate-bounce">
                                <i data-lucide="arrow-down" class="w-6 h-6 text-primary-600"></i>
                            </div>
                        </div>
                        
                        <!-- Resultado optimizado -->
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl border border-green-200">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-200 rounded-lg flex items-center justify-center">
                                    <i data-lucide="network" class="w-5 h-5 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Sistema Integrado vía SSO</p>
                                    <p class="text-xs text-green-600">Datos sincronizados en tiempo real</p>
                                </div>
                            </div>
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                        </div>
                    </div>
                    
                    <!-- Stats flotante -->
                    <div class="absolute -right-4 -bottom-4 bg-white rounded-2xl shadow-xl p-4 border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                <i data-lucide="trending-down" class="w-6 h-6 text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">-40%</p>
                                <p class="text-xs text-gray-500">en costos de TI</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION PROBLEMA - El costo del desorden -->
<section id="problema" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">El Problema Real</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                ¿Por Qué Seguir Comprando Software<br>Cuando el Problema es la <span class="text-red-500">Desorganización</span>?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                La mayoría de las escuelas en Colombia y Latinoamérica <strong>ya tienen las herramientas</strong>. 
                Lo que no tienen es una estrategia de integración. Resultado: duplicidad de datos, 
                inseguridad y desperdicio de dinero.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Problema 1 -->
            <div class="bg-gray-50 rounded-2xl p-8 border-l-4 border-red-500 scroll-reveal">
                <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6">
                    <i data-lucide="copy" class="w-7 h-7 text-red-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Duplicidad de Información</h3>
                <p class="text-gray-600 mb-4">
                    La misma base de estudiantes en 4 sistemas diferentes. Cada cambio se debe hacer manualmente 
                    en cada plataforma.
                </p>
                <div class="bg-red-50 p-3 rounded-lg text-sm text-red-700 font-semibold">
                    <i data-lucide="alert-triangle" class="w-4 h-4 inline mr-1"></i>
                    Error humano garantizado
                </div>
            </div>
            
            <!-- Problema 2 -->
            <div class="bg-gray-50 rounded-2xl p-8 border-l-4 border-orange-500 scroll-reveal">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <i data-lucide="key" class="w-7 h-7 text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Múltiples Contraseñas</h3>
                <p class="text-gray-600 mb-4">
                    Profesores con 5 usuarios diferentes. Padres que olvidan qué app usar para qué. 
                    Administrativos con accesos dispersos.
                </p>
                <div class="bg-orange-50 p-3 rounded-lg text-sm text-orange-700 font-semibold">
                    <i data-lucide="shield-alert" class="w-4 h-4 inline mr-1"></i>
                    Riesgo de seguridad alto
                </div>
            </div>
            
            <!-- Problema 3 -->
            <div class="bg-gray-50 rounded-2xl p-8 border-l-4 border-yellow-500 scroll-reveal">
                <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center mb-6">
                    <i data-lucide="credit-card" class="w-7 h-7 text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Sobrecosto de Licencias</h3>
                <p class="text-gray-600 mb-4">
                    Pagando 3 herramientas que hacen lo mismo. Software abandonado que sigue facturando. 
                    Contratos auto-renovables olvidados.
                </p>
                <div class="bg-yellow-50 p-3 rounded-lg text-sm text-yellow-700 font-semibold">
                    <i data-lucide="dollar-sign" class="w-4 h-4 inline mr-1"></i>
                    30% del presupuesto de TI desperdiciado
                </div>
            </div>
        </div>
        
        <!-- Insight principal -->
        <div class="mt-16 bg-primary-900 rounded-3xl p-8 md:p-12 text-center text-white scroll-reveal">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">
                "Todo está ahí, pero mal organizado"
            </h3>
            <p class="text-primary-100 text-lg max-w-2xl mx-auto">
                Esa frase la escuchamos en el 80% de las escuelas que atendemos. 
                No necesitas más tecnología. Necesitas <strong>arquitectura de información</strong>.
            </p>
        </div>
    </div>
</section>

<!-- SECTION METODOLOGÍA - Cómo lo hacemos -->
<section id="metodologia" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Nuestra Metodología</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                De la Auditoría a la Optimización:<br>
                <span class="text-primary-600">Sin Comprar Nada Nuevo</span>
            </h2>
        </div>
        
        <!-- Pasos del proceso -->
        <div class="relative">
            <!-- Línea conectora -->
            <div class="hidden md:block absolute top-1/2 left-0 right-0 h-1 bg-primary-200 -translate-y-1/2 z-0"></div>
            
            <div class="grid md:grid-cols-4 gap-8 relative z-10">
                <!-- Paso 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg scroll-reveal">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4 mx-auto border-4 border-white shadow-md">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-center mb-3">Auditoría Completa</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Mapeamos <strong>todo</strong> el sistema de información actual: aplicaciones, 
                        bases de datos, usuarios y costos ocultos.
                    </p>
                    <ul class="mt-4 space-y-2 text-sm text-gray-500">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Inventario de software
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Análisis de duplicados
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Mapeo de costos
                        </li>
                    </ul>
                </div>
                
                <!-- Paso 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg scroll-reveal">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4 mx-auto border-4 border-white shadow-md">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-center mb-3">Diagnóstico de Integración</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Identificamos qué sistemas pueden hablar entre sí, dónde están los cuellos de botella 
                        y qué datos se pierden.
                    </p>
                    <ul class="mt-4 space-y-2 text-sm text-gray-500">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            APIs disponibles
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Flujos de datos
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Puntos de fricción
                        </li>
                    </ul>
                </div>
                
                <!-- Paso 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg scroll-reveal">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4 mx-auto border-4 border-white shadow-md">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-center mb-3">Implementación SSO</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Unificamos el acceso mediante <strong>Single Sign-On</strong>. Un solo usuario, 
                        un solo password, todas las aplicaciones.
                    </p>
                    <ul class="mt-4 space-y-2 text-sm text-gray-500">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Autenticación centralizada
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Gestión de permisos
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Seguridad reforzada
                        </li>
                    </ul>
                </div>
                
                <!-- Paso 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg scroll-reveal">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4 mx-auto border-4 border-white shadow-md">
                        4
                    </div>
                    <h3 class="text-lg font-bold text-center mb-3">Integración y Limpieza</h3>
                    <p class="text-gray-600 text-center text-sm">
                        Conectamos las aplicaciones existentes, eliminamos duplicados y establecemos 
                        flujos automáticos de información.
                    </p>
                    <ul class="mt-4 space-y-2 text-sm text-gray-500">
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Sincronización de datos
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Eliminación de redundancias
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                            Automatización de procesos
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Resultado -->
        <div class="mt-16 bg-white rounded-3xl p-8 shadow-xl border border-gray-100 scroll-reveal">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Resultado: Un Sistema que Funciona Como Uno Solo</h3>
                    <p class="text-gray-600 mb-6">
                        No implementamos software nuevo. <strong>Optimizamos tu inversión existente</strong>. 
                        Tus aplicaciones actuales, pero hablando entre ellas, sin duplicados, con acceso único 
                        y costos reducidos.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
                            Sin nuevas licencias
                        </span>
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
                            Menos errores humanos
                        </span>
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
                            Mayor seguridad
                        </span>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6">
                    <h4 class="font-bold text-gray-900 mb-4">Lo que eliminamos vs Lo que optimizamos</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <span class="text-sm text-gray-700">Duplicidad de datos</span>
                            <span class="text-red-600 font-bold text-sm">ELIMINADO</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <span class="text-sm text-gray-700">Múltiples passwords</span>
                            <span class="text-red-600 font-bold text-sm">ELIMINADO</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <span class="text-sm text-gray-700">Licencias redundantes</span>
                            <span class="text-red-600 font-bold text-sm">CANCELADAS</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <span class="text-sm text-gray-700">Aplicaciones existentes</span>
                            <span class="text-green-600 font-bold text-sm">INTEGRADAS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION SERVICIOS ESPECÍFICOS -->
<section id="servicios" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Servicios Especializados</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6">
                Optimización Real, No Más Software
            </h2>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Servicio 1 -->
            <div class="group bg-gray-50 rounded-2xl p-8 hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-200 scroll-reveal">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="search" class="w-7 h-7 text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Auditoría de Arquitectura de Datos</h3>
                <p class="text-gray-600 mb-4">
                    Análisis exhaustivo de cómo fluye la información en tu institución. Detectamos 
                    silos de datos, inconsistencias y oportunidades de integración.
                </p>
                <div class="flex items-center text-primary-600 font-semibold text-sm">
                    <span>Entregable: Mapa de sistemas y flujos de datos</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </div>
            </div>
            
            <!-- Servicio 2 -->
            <div class="group bg-gray-50 rounded-2xl p-8 hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-200 scroll-reveal">
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="link" class="w-7 h-7 text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Integración de Aplicaciones (APIs)</h3>
                <p class="text-gray-600 mb-4">
                    Conectamos tus sistemas existentes mediante APIs. SGA, financiero, comunicaciones 
                    y plataformas de pago trabajando como uno solo.
                </p>
                <div class="flex items-center text-primary-600 font-semibold text-sm">
                    <span>Entregable: Sistemas sincronizados en tiempo real</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </div>
            </div>
            
            <!-- Servicio 3 -->
            <div class="group bg-gray-50 rounded-2xl p-8 hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-200 scroll-reveal">
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="key-round" class="w-7 h-7 text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Implementación de SSO</h3>
                <p class="text-gray-600 mb-4">
                    Single Sign-On para tu institución. Un solo login para profesores, estudiantes 
                    y padres. Seguridad reforzada y experiencia de usuario simplificada.
                </p>
                <div class="flex items-center text-primary-600 font-semibold text-sm">
                    <span>Entregable: Acceso unificado y seguro</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </div>
            </div>
            
            <!-- Servicio 4 -->
            <div class="group bg-gray-50 rounded-2xl p-8 hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-200 scroll-reveal">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="scissors" class="w-7 h-7 text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Depuración y Limpieza de Datos</h3>
                <p class="text-gray-600 mb-4">
                    Eliminación de registros duplicados, estandarización de formatos y creación de 
                    fuente única de verdad para toda la institución.
                </p>
                <div class="flex items-center text-primary-600 font-semibold text-sm">
                    <span>Entregable: Base de datos única y limpia</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION CASOS DE ÉXITO -->
<section id="casos" class="py-24 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <span class="text-primary-400 font-semibold text-sm uppercase tracking-wider">Casos de Éxito</span>
            <h2 class="text-4xl font-bold mt-4 mb-6">
                Escuelas que Dejaron de Comprar<br>y Empezaron a <span class="text-primary-400">Optimizar</span>
            </h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Caso 1 -->
            <div class="bg-gray-800 rounded-2xl p-8 scroll-reveal">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-bold">BOGOTÁ</span>
                    <span class="px-3 py-1 bg-primary-500/20 text-primary-400 rounded-full text-xs font-bold">-35% COSTOS</span>
                </div>
                <h3 class="text-xl font-bold mb-3">Escuela San José de Bogotá</h3>
                <p class="text-gray-400 mb-6">
                    Tenían 4 sistemas de gestión académica pagando licencias. Auditamos, integramos vía API 
                    y cancelamos 2 herramientas redundantes. Ahorro anual: $45M COP.
                </p>
                <div class="border-t border-gray-700 pt-4">
                    <p class="text-sm text-gray-500 italic">
                        "Descubrimos que pagábamos dos veces por lo mismo. La auditoría nos abrió los ojos."
                    </p>
                    <p class="text-sm text-primary-400 mt-2 font-semibold">— Carlos M., Director TI</p>
                </div>
            </div>
            
            <!-- Caso 2 -->
            <div class="bg-gray-800 rounded-2xl p-8 scroll-reveal">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-bold">MEDELLÍN</span>
                    <span class="px-3 py-1 bg-primary-500/20 text-primary-400 rounded-full text-xs font-bold">SSO IMPLEMENTADO</span>
                </div>
                <h3 class="text-xl font-bold mb-3">Institución Educativa del Norte</h3>
                <p class="text-gray-400 mb-6">
                    Profesores con 6 passwords diferentes. Implementamos SSO con Google Workspace. 
                    Reducción del 80% en tickets de soporte de acceso.
                </p>
                <div class="border-t border-gray-700 pt-4">
                    <p class="text-sm text-gray-500 italic">
                        "Los profesores dejaron de llamar porque no podían entrar a ningún lado."
                    </p>
                    <p class="text-sm text-primary-400 mt-2 font-semibold">— Ana P., Coordinadora Académica</p>
                </div>
            </div>
            
            <!-- Caso 3 -->
            <div class="bg-gray-800 rounded-2xl p-8 scroll-reveal">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-bold">CALI</span>
                    <span class="px-3 py-1 bg-primary-500/20 text-primary-400 rounded-full text-xs font-bold">DATOS UNIFICADOS</span>
                </div>
                <h3 class="text-xl font-bold mb-3">Escuela del Valle</h3>
                <p class="text-gray-400 mb-6">
                    Base de datos de estudiantes en Excel, SGA y plataforma de pagos, nunca coincidían. 
                    Unificamos fuentes y eliminamos 3,200 registros duplicados.
                </p>
                <div class="border-t border-gray-700 pt-4">
                    <p class="text-sm text-gray-500 italic">
                        "Por fin sabemos exactamente cuántos estudiantes tenemos sin revisar 3 archivos."
                    </p>
                    <p class="text-sm text-primary-400 mt-2 font-semibold">— Marta L., Rectora</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION CTA FINAL -->
<section id="diagnostico" class="py-24 bg-primary-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center scroll-reveal">
        <div class="inline-flex items-center px-4 py-2 bg-white/10 text-white rounded-full text-sm font-semibold mb-6 backdrop-blur-sm">
            <i data-lucide="gift" class="w-4 h-4 mr-2"></i>
            Diagnóstico inicial sin costo
        </div>
        
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
            ¿Cuánto Dinero Estás Tirando<br>en Software Redundante?
        </h2>
        
        <p class="text-xl text-primary-100 mb-12 max-w-2xl mx-auto">
            En 30 minutos te mostramos duplicados, licencias innecesarias y oportunidades de integración 
            en tu sistema actual. Sin compromiso, sin venta de software.
        </p>
        
       <form class="bg-white rounded-3xl p-8 shadow-2xl max-w-2xl mx-auto text-left" id="form-auditoria" method="POST">
    <!-- Widget Turnstile -->
    <div class="cf-turnstile mb-6" 
         data-sitekey="0x4AAAAAAC1v_HDi1v6nPJoO"
         data-callback="onTurnstileSuccess"
         data-theme="light"></div>
    
    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Nombre completo</label>
            <input type="text" name="nombre" required 
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                   placeholder="Tu nombre">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Correo institucional</label>
            <input type="email" name="email" required 
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                   placeholder="nombre@escuela.edu.co">
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Nombre de la escuela</label>
            <input type="text" name="escuela" 
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                   placeholder="Institución Educativa...">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Ciudad / País</label>
            <input type="text" name="ubicacion" 
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                   placeholder="Bogotá, Colombia">
        </div>
    </div>
    
    <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">¿Qué sistemas usan actualmente? (breve lista)</label>
        <textarea name="sistemas" rows="3" 
                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800"
                  placeholder="Ej: Excel, Google Classroom, SGA X, plataforma de pagos Y..."></textarea>
    </div>
    
    <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Principal dolor de cabeza con sus sistemas</label>
        <select name="problema" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-gray-800">
            <option value="">Selecciona el problema principal</option>
            <option value="duplicados">Datos duplicados en varios sistemas</option>
            <option value="passwords">Muchas contraseñas para recordar</option>
            <option value="costos">Costos de licencias muy altos</option>
            <option value="desactualizado">Información desactualizada</option>
            <option value="soporte">Muchos tickets de soporte</option>
            <option value="otro">Otro (especificar en mensaje)</option>
        </select>
    </div>
    
    <!-- Champ caché pour le token Turnstile -->
    <input type="hidden" name="cf-turnstile-response" id="cf-turnstile-response">
    
    <button type="submit" id="submit-btn"
            class="w-full py-4 bg-gray-900 text-white rounded-xl font-bold text-lg hover:bg-gray-800 transition transform hover:scale-[1.02] flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
        <span>Solicitar Auditoría Gratuita</span>
        <i data-lucide="arrow-right" class="w-5 h-5"></i>
    </button>
    
    <p class="text-sm text-gray-500 mt-4 text-center flex items-center justify-center gap-1">
        <i data-lucide="shield-check" class="w-4 h-4"></i>
        No te venderemos software. Solo analizaremos tu infraestructura actual.
    </p>
</form>

<!-- Script Cloudflare Turnstile -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<script>
    // Callback quand Turnstile est validé
    function onTurnstileSuccess(token) {
        document.getElementById('cf-turnstile-response').value = token;
        document.getElementById('submit-btn').disabled = false;
    }
    
    // Désactiver le bouton au départ
    document.getElementById('submit-btn').disabled = true;
    
    // Validation du formulaire
    document.getElementById('form-auditoria').addEventListener('submit', function(e) {
        const token = document.getElementById('cf-turnstile-response').value;
        
        if (!token) {
            e.preventDefault();
            alert('Por favor completa la verificación de seguridad');
            return false;
        }
        
        // Le token sera envoyé avec le formulaire
        console.log('Token Turnstile:', token);
    });
</script>
    </div>
</section>


<!-- Keywords semánticas ocultas -->
<div class="sr-only" aria-hidden="true">
    <p>Consultoría en sistemas educativos Colombia, auditoría de software escolar, 
    integración de aplicaciones educativas, SSO para escuelas, eliminación de duplicados 
    en bases de datos escolares, optimización de infraestructura TI educativa, 
    arquitectura de información educativa, consultoría tecnológica escuelas Latinoamérica,
    unificación de sistemas escolares, reducción de costos de software educativo.</p>
</div>

<script>
document.getElementById('form-auditoria').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const button = form.querySelector('button');
    
    // Vérifier le token Turnstile
    const token = document.getElementById('cf-turnstile-response').value;
    if (!token) {
        mostrarMensajeAuditoria('❌ Por favor completa la verificación de seguridad (Turnstile)', 'error');
        return false;
    }
    
    // Créer le FormData APRÈS vérification du token
    const formData = new FormData(form);
    
    // S'assurer que le token est dans le FormData
    formData.set('cf-turnstile-response', token);

    // UX sympa 😏
    button.disabled = true;
    const originalText = button.innerHTML;
    button.innerHTML = "Enviando... ⏳";

    try {
       const response = await fetch('procesar_contacto', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const text = await response.text();

        const data = JSON.parse(text);

        if (data.exito) {
            mostrarMensajeAuditoria("✅ Auditoría solicitada correctamente. Te contactamos pronto.", "success");
            form.reset();
        } else {
            mostrarMensajeAuditoria("❌ " + data.errores.join('<br>'), "error");
        }

    } catch (error) {
        console.error(error);
        mostrarMensajeAuditoria("❌ Error de conexión", "error");
    }

    button.disabled = false;
    button.innerHTML = originalText;
});

function mostrarMensajeAuditoria(msg, tipo) {
    let container = document.getElementById('mensaje-auditoria');

    if (!container) {
        container = document.createElement('div');
        container.id = 'mensaje-auditoria';
        container.className = 'mb-6 p-4 rounded-xl';
        document.getElementById('form-auditoria').prepend(container);
    }

    container.innerHTML = msg;

    if (tipo === 'success') {
        container.className = 'mb-6 p-4 bg-green-100 text-green-700 rounded-xl';
    } else {
        container.className = 'mb-6 p-4 bg-red-100 text-red-700 rounded-xl';
    }
}
</script>