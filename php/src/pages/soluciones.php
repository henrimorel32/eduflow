<?php
declare(strict_types=1);

$pageTitle = t('title', 'seo.soluciones');
$pageDescription = t('description', 'seo.soluciones');
$pageKeywords = t('keywords', 'seo.soluciones');
$pageH1 = t('h1', 'seo.soluciones');
$pageCanonical = url('soluciones');
$pageOgImage = '/og-soluciones.jpg';
?>
<!-- SECTION: REFACTORIZATION SI - À INTÉGRER DANS BODY EXISTANT -->
<section id="refactorizacion-si" class="relative w-full bg-slate-900 text-slate-100 overflow-hidden py-16">
    
    <!-- Background Effects (visibles sur fond blanc du site parent) -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 -z-10"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,rgba(59,130,246,0.15)_1px,transparent_0)] bg-[size:40px_40px] opacity-30 -z-10"></div>
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Hero Content -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 mb-6">
                <span class="flex h-2 w-2 rounded-full bg-emerald-400 mr-2 animate-pulse"></span>
                <span class="text-blue-400 text-sm font-medium tracking-wide uppercase" data-db="seccion:hero_badge"><?= t('hero_badge', 'soluciones') ?></span>
            </div>
            
            <h1 class="font-bold text-4xl md:text-6xl lg:text-7xl mb-6 leading-tight text-white" data-db="seccion:hero_h1">
                <?= t('hero_h1_l1', 'soluciones') ?><br>
                <span class="bg-gradient-to-r from-blue-400 via-cyan-400 to-purple-400 bg-clip-text text-transparent"><?= t('hero_h1_l2', 'soluciones') ?></span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto mb-8 leading-relaxed" data-db="seccion:hero_subtitulo">
                <?= t('hero_subtitle', 'soluciones') ?>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#contacto-si" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-full font-semibold text-white transition-all transform hover:scale-105 flex items-center gap-2" data-db="seccion:hero_cta_primario">
                    <?= t('cta_primario', 'soluciones') ?> <i class="fas fa-arrow-right"></i>
                </a>
                <a href="#arquitectura-si" class="px-8 py-4 border border-slate-500 hover:border-blue-400 rounded-full font-semibold text-slate-300 hover:text-white transition-all" data-db="seccion:hero_cta_secundario">
                    <?= t('cta_secundario', 'soluciones') ?>
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20 max-w-4xl mx-auto">
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-cyan-400">150+</div>
                <div class="text-sm text-slate-400"><?= t('stat_proyectos', 'soluciones') ?></div>
            </div>
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-purple-400">98%</div>
                <div class="text-sm text-slate-400"><?= t('stat_satisfaccion', 'soluciones') ?></div>
            </div>
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-emerald-400">12</div>
                <div class="text-sm text-slate-400"><?= t('stat_experiencia', 'soluciones') ?></div>
            </div>
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-blue-400">24/7</div>
                <div class="text-sm text-slate-400"><?= t('stat_soporte', 'soluciones') ?></div>
            </div>
        </div>

        <!-- Architecture Section -->
        <div id="arquitectura-si" class="mb-20">
            <div class="text-center mb-12">
                <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:arquitectura_h2">
                    <?= t('arquitectura_h2_l1', 'soluciones') ?> <span class="text-blue-400"><?= t('arquitectura_h2_l2', 'soluciones') ?></span>
                </h2>
                <p class="text-slate-400 text-lg max-w-3xl mx-auto" data-db="seccion:arquitectura_subtitulo">
                    <?= t('arquitectura_subtitle', 'soluciones') ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- API -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-blue-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-plug text-blue-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:api_titulo"><?= t('api_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:api_desc"><?= t('api_desc', 'soluciones') ?></p>
                </div>

                <!-- Microservices -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-cyan-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-cubes text-cyan-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:microservicios_titulo"><?= t('microservicios_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:microservicios_desc"><?= t('microservicios_desc', 'soluciones') ?></p>
                </div>

                <!-- AWS -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-orange-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-cloud text-orange-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:aws_titulo"><?= t('aws_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:aws_desc"><?= t('aws_desc', 'soluciones') ?></p>
                </div>

                <!-- SSO -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-emerald-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-emerald-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:sso_titulo"><?= t('sso_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:sso_desc"><?= t('sso_desc', 'soluciones') ?></p>
                </div>

                <!-- CMS -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-pink-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-pink-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-file-alt text-pink-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:cms_titulo"><?= t('cms_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:cms_desc"><?= t('cms_desc', 'soluciones') ?></p>
                </div>

                <!-- Standalone -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-indigo-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-box text-indigo-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:standalone_titulo"><?= t('standalone_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:standalone_desc"><?= t('standalone_desc', 'soluciones') ?></p>
                </div>

                <!-- Web -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-cyan-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-globe text-cyan-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:web_titulo"><?= t('web_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:web_desc"><?= t('web_desc', 'soluciones') ?></p>
                </div>

                <!-- Database -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-yellow-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-database text-yellow-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:bd_titulo"><?= t('bd_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:bd_desc"><?= t('bd_desc', 'soluciones') ?></p>
                </div>

                <!-- DevOps -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-red-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-infinity text-red-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:devops_titulo"><?= t('devops_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:devops_desc"><?= t('devops_desc', 'soluciones') ?></p>
                </div>

                <!-- Security -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-slate-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-slate-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-lock text-white text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:security_titulo"><?= t('security_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:security_desc"><?= t('security_desc', 'soluciones') ?></p>
                </div>

                <!-- ESB -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-teal-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-teal-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-project-diagram text-teal-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:esb_titulo"><?= t('esb_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:esb_desc"><?= t('esb_desc', 'soluciones') ?></p>
                </div>

                <!-- Mobile -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-violet-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-violet-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-mobile-alt text-violet-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:mobile_titulo"><?= t('mobile_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:mobile_desc"><?= t('mobile_desc', 'soluciones') ?></p>
                </div>
            </div>

            <!-- Architecture Diagram -->
            <div class="mt-12 bg-slate-800/30 border border-slate-700 rounded-3xl p-8">
                <h3 class="font-bold text-2xl text-white mb-8 text-center" data-db="clave:diagrama_titulo"><?= t('diagrama_titulo', 'soluciones') ?></h3>
                <div class="space-y-3 max-w-3xl mx-auto">
                    <div class="bg-blue-600/20 border border-blue-500/30 rounded-lg p-4 text-center">
                        <span class="text-blue-300 font-semibold" data-db="clave:capa_presentacion"><?= t('capa_presentacion', 'soluciones') ?></span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-purple-600/20 border border-purple-500/30 rounded-lg p-4 text-center">
                        <span class="text-purple-300 font-semibold" data-db="clave:capa_api"><?= t('capa_api', 'soluciones') ?></span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-orange-600/20 border border-orange-500/30 rounded-lg p-4 text-center">
                        <span class="text-orange-300 font-semibold" data-db="clave:capa_negocio"><?= t('capa_negocio', 'soluciones') ?></span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-emerald-600/20 border border-emerald-500/30 rounded-lg p-4 text-center">
                        <span class="text-emerald-300 font-semibold" data-db="clave:capa_datos"><?= t('capa_datos', 'soluciones') ?></span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-slate-600/20 border border-slate-500/30 rounded-lg p-4 text-center">
                        <span class="text-slate-300 font-semibold" data-db="clave:capa_infra"><?= t('capa_infra', 'soluciones') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Methodology Section -->
        <div id="metodologia-si" class="mb-20 bg-slate-800/30 rounded-3xl p-8 md:p-12">
            <div class="text-center mb-12">
                <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:metodologia_h2">
                    <?= t('metodologia_h2_l1', 'soluciones') ?> <span class="text-cyan-400"><?= t('metodologia_h2_l2', 'soluciones') ?></span>
                </h2>
                <p class="text-slate-400 text-lg max-w-3xl mx-auto" data-db="seccion:metodologia_subtitulo">
                    <?= t('metodologia_subtitle', 'soluciones') ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-blue-500">
                        <span class="text-2xl font-bold text-blue-400">1</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso1_titulo"><?= t('scrum_paso1_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso1_desc"><?= t('scrum_paso1_desc', 'soluciones') ?></p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-cyan-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-cyan-500">
                        <span class="text-2xl font-bold text-cyan-400">2</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso2_titulo"><?= t('scrum_paso2_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso2_desc"><?= t('scrum_paso2_desc', 'soluciones') ?></p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-purple-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-purple-500">
                        <span class="text-2xl font-bold text-purple-400">3</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso3_titulo"><?= t('scrum_paso3_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso3_desc"><?= t('scrum_paso3_desc', 'soluciones') ?></p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-emerald-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-emerald-500">
                        <span class="text-2xl font-bold text-emerald-400">4</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso4_titulo"><?= t('scrum_paso4_titulo', 'soluciones') ?></h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso4_desc"><?= t('scrum_paso4_desc', 'soluciones') ?></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex items-start space-x-4 p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                    <i class="fas fa-sync-alt text-blue-400 text-2xl mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-white" data-db="clave:beneficio_1_titulo"><?= t('beneficio_1_titulo', 'soluciones') ?></h4>
                        <p class="text-slate-400 text-sm" data-db="clave:beneficio_1_desc"><?= t('beneficio_1_desc', 'soluciones') ?></p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                    <i class="fas fa-handshake text-cyan-400 text-2xl mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-white" data-db="clave:beneficio_2_titulo"><?= t('beneficio_2_titulo', 'soluciones') ?></h4>
                        <p class="text-slate-400 text-sm" data-db="clave:beneficio_2_desc"><?= t('beneficio_2_desc', 'soluciones') ?></p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                    <i class="fas fa-rocket text-purple-400 text-2xl mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-white" data-db="clave:beneficio_3_titulo"><?= t('beneficio_3_titulo', 'soluciones') ?></h4>
                        <p class="text-slate-400 text-sm" data-db="clave:beneficio_3_desc"><?= t('beneficio_3_desc', 'soluciones') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tech Stack -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:tech_h2">
                    <?= t('tech_h2_l1', 'soluciones') ?> <span class="text-purple-400"><?= t('tech_h2_l2', 'soluciones') ?></span>
                </h2>
            </div>
            <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-aws text-3xl text-orange-400 mb-2"></i>
                    <span class="text-xs text-slate-300 block">AWS</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-docker text-3xl text-blue-400 mb-2"></i>
                    <span class="text-xs text-slate-300 block">Docker</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-kubernetes text-3xl text-blue-500 mb-2"></i>
                    <span class="text-xs text-slate-300 block">K8s</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-node text-3xl text-green-500 mb-2"></i>
                    <span class="text-xs text-slate-300 block">Node.js</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-react text-3xl text-cyan-400 mb-2"></i>
                    <span class="text-xs text-slate-300 block">React</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fas fa-database text-3xl text-blue-300 mb-2"></i>
                    <span class="text-xs text-slate-300 block">PostgreSQL</span>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <!-- <div id="contacto-si" class="bg-gradient-to-br from-blue-900/50 to-purple-900/50 rounded-3xl p-8 md:p-12 text-center border border-blue-500/20">
            <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:cta_h2">
                ¿Listo para modernizar tu <span class="text-blue-400">Arquitectura de SI</span>?
            </h2>
            <p class="text-slate-300 text-lg mb-8 max-w-2xl mx-auto" data-db="seccion:cta_subtitulo">
                Agenda una consultoría gratuita. Analizamos tu SI actual y diseñamos la hoja de ruta de transformación.
            </p>
            
            <form class="max-w-lg mx-auto space-y-4 text-left mb-6">
                <input type="text" placeholder="Nombre completo" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none">
                <input type="email" placeholder="Correo empresarial" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none">
                <input type="text" placeholder="Empresa" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none">
                <textarea rows="4" placeholder="¿Qué necesitas refactorizar?" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none"></textarea>
                <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 rounded-lg font-bold text-white transition-colors" data-db="seccion:cta_boton">
                    Solicitar Diagnóstico Gratis
                </button>
            </form>
            
            <p class="text-sm text-slate-500" data-db="seccion:cta_legal">No compartimos tus datos. Consultoría sin compromiso.</p>
        </div> -->

    </div>
</section>
