<?php
declare(strict_types=1);

// SEO multilingue pour la page aplicaciones
$pageTitle = t('title', 'seo.aplicaciones');
$pageDescription = t('description', 'seo.aplicaciones');
$pageKeywords = t('keywords', 'seo.aplicaciones');
$pageH1 = t('h1', 'seo.aplicaciones');
$pageCanonical = url('aplicaciones');
$pageOgImage = '/og-aplicaciones.jpg';
?>

<!-- HERO SECTION -->
<section class="relative min-h-[60vh] flex items-center overflow-hidden bg-slate-950">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary-600/30 via-purple-600/10 to-slate-950"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%233b82f6\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 py-20">
        <div class="text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-400 text-sm font-medium mb-6">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                <?= t('hero_badge', 'aplicaciones') ?>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
                <?= t('hero_title', 'aplicaciones') ?>
            </h1>
            
            <p class="text-xl text-slate-400 max-w-3xl mx-auto">
                <?= t('hero_subtitle', 'aplicaciones') ?>
            </p>

            <div class="flex flex-col sm:flex-row gap-4 mt-10 justify-center">
                <a href="<?= url('myschoolby') ?>" class="group relative px-8 py-4 bg-gradient-to-r from-primary-600 to-secondary-500 text-white rounded-full font-bold text-lg text-center overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:shadow-primary-500/25">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <?= t('cta_myschoolby', 'aplicaciones') ?>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </span>
                </a>
                <a href="https://saberpro.mente-viva.co" target="_blank" class="px-8 py-4 border-2 border-orange-500 text-orange-400 rounded-full font-bold text-lg text-center hover:bg-orange-500/10 transition-all">
                    <?= t('cta_saberpro', 'aplicaciones') ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION MYSCHOOLBY — MISE EN AVANT INTERNATIONALE -->
<section class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-100 text-primary-700 text-sm font-bold mb-6">
                    <?= t('myschoolby_badge', 'aplicaciones') ?>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                    <?= t('myschoolby_title', 'aplicaciones') ?>
                </h2>
                
                <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                    <?= t('myschoolby_desc', 'aplicaciones') ?>
                </p>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-slate-700"><?= t('myschoolby_feature_1', 'aplicaciones') ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-slate-700"><?= t('myschoolby_feature_2', 'aplicaciones') ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-slate-700"><?= t('myschoolby_feature_3', 'aplicaciones') ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-slate-700"><?= t('myschoolby_feature_4', 'aplicaciones') ?></span>
                    </div>
                </div>
                
                <a href="<?= url('myschoolby') ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition-colors shadow-lg shadow-primary-200">
                    <?= t('myschoolby_cta', 'aplicaciones') ?>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
            
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-r from-primary-200 to-secondary-200 rounded-3xl opacity-30 blur-xl"></div>
                <div class="relative bg-slate-50 rounded-3xl p-8 border border-slate-100 shadow-xl">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="text-2xl font-bold text-slate-900">Profesores</div>
                            <div class="text-sm text-slate-500 mt-1">Planificación & Evaluación</div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center">
                            <div class="w-12 h-12 bg-secondary-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div class="text-2xl font-bold text-slate-900">Estudiantes</div>
                            <div class="text-sm text-slate-500 mt-1">Progreso & Recursos</div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <span class="text-blue-600 font-bold">US</span>
                            </div>
                            <div class="text-sm font-bold text-slate-900">Estados Unidos</div>
                            <div class="text-xs text-slate-500 mt-1">Créditos & GPA</div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center">
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <span class="text-red-600 font-bold">FR</span>
                            </div>
                            <div class="text-sm font-bold text-slate-900">Francia</div>
                            <div class="text-xs text-slate-500 mt-1">Cycles & Compétences</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION PLATAFORMAS EXAMENES COLOMBIA -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-orange-600 font-semibold text-sm uppercase tracking-wider">Colombia</span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('preparacion_title', 'aplicaciones') ?>
            </h2>
            <p class="text-lg text-slate-600 mt-4 max-w-2xl mx-auto">
                <?= t('preparacion_subtitle', 'aplicaciones') ?>
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- SABER PRO -->
            <div class="group relative bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-8 border-2 border-orange-300 hover:border-orange-400 shadow-lg shadow-orange-100">
                <div class="absolute -top-3 left-8 px-4 py-1 bg-gradient-to-r from-orange-500 to-amber-500 text-white text-sm font-bold rounded-full shadow-lg">
                    ⭐ <?= t('recomendado', 'common') ?>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= t('saberpro_card_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600 mb-6">
                    <?= t('saberpro_card_desc', 'aplicaciones') ?>
                </p>
                <div class="flex flex-col gap-3">
                    <a href="https://saberpro.mente-viva.co" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-orange-600 text-white rounded-xl font-semibold hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">
                        <?= t('ir_plataforma', 'common') ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    <a href="https://saberpro.mente-viva.co/materia-practica?guest=1" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 border-2 border-orange-600 text-orange-600 rounded-xl font-semibold hover:bg-orange-50 transition-colors">
                        <?= t('probar_gratis', 'common') ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </a>
                </div>
            </div>
            
            <!-- CONCURSO DOCENTE -->
            <div class="group relative bg-pink-50 rounded-2xl p-8 border border-pink-200 hover:border-pink-300 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-pink-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= t('docente_card_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600 mb-6">
                    <?= t('docente_card_desc', 'aplicaciones') ?>
                </p>
                <div class="flex flex-col gap-3">
                    <a href="https://docente.mente-viva.co" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-pink-600 text-white rounded-xl font-semibold hover:bg-pink-700 transition-colors">
                        <?= t('ir_plataforma', 'common') ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    <div class="text-xs text-green-600 bg-green-50 rounded-lg px-3 py-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <?= t('incluye_myschoolby', 'catalogo') ?>
                    </div>
                </div>
            </div>
            
            <!-- PREICFES -->
            <div class="group relative bg-blue-50 rounded-2xl p-8 border border-blue-200 hover:border-blue-300 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= t('preicfes_card_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600 mb-6">
                    <?= t('preicfes_card_desc', 'aplicaciones') ?>
                </p>
                <div class="flex flex-col gap-3">
                    <a href="https://mente-viva.co/preicfes" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                        <?= t('ir_plataforma', 'common') ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    <a href="https://mente-viva.co/empezarya" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 border-2 border-blue-600 text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition-colors">
                        <?= t('probar_gratis', 'common') ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </a>
                </div>
            </div>
            
            <!-- SABER -->
            <div class="group relative bg-green-50 rounded-2xl p-8 border border-green-200 hover:border-green-300 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= t('saber_card_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600 mb-6">
                    <?= t('saber_card_desc', 'aplicaciones') ?>
                </p>
                <div class="flex flex-col gap-3">
                    <a href="https://mente-viva.co/saber" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
                        <?= t('ir_plataforma', 'common') ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    <a href="https://mente-viva.co/empezaryasaber" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 border-2 border-green-600 text-green-600 rounded-xl font-semibold hover:bg-green-50 transition-colors">
                        <?= t('probar_gratis', 'common') ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </a>
                </div>
            </div>
            
            <!-- QUIERO SER / QUIERO SABER -->
            <div class="group relative bg-purple-50 rounded-2xl p-8 border border-purple-200 hover:border-purple-300 hover:shadow-lg transition-all md:col-span-2 lg:col-span-2">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="lg:w-2/3">
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= t('quierosersaber_card_title', 'aplicaciones') ?></h3>
                        <p class="text-slate-600 mb-4">
                            <?= t('quierosersaber_card_desc', 'aplicaciones') ?>
                        </p>
                    </div>
                    <div class="lg:w-1/3 flex flex-col gap-3 justify-end">
                        <a href="https://mente-viva.co/quierosersaber" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700 transition-colors">
                            <?= t('ir_plataforma', 'common') ?>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                        <a href="https://mente-viva.co/empezaryaquierosersaber" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-3 border-2 border-purple-600 text-purple-600 rounded-xl font-semibold hover:bg-purple-50 transition-colors">
                            <?= t('probar_gratis', 'common') ?>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- SECTION FAQ -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">FAQ</span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('faq_title', 'aplicaciones') ?>
            </h2>
        </div>
        
        <div class="space-y-6">
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_q1_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600"><?= t('faq_q1_text', 'aplicaciones') ?></p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_q2_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600"><?= t('faq_q2_text', 'aplicaciones') ?></p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_q3_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600"><?= t('faq_q3_text', 'aplicaciones') ?></p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_q4_title', 'aplicaciones') ?></h3>
                <p class="text-slate-600"><?= t('faq_q4_text', 'aplicaciones') ?></p>
            </div>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-600/20 to-secondary-600/20"></div>
    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            <?= t('hero_title', 'aplicaciones') ?>
        </h2>
        <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto">
            <?= t('hero_subtitle', 'aplicaciones') ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <a href="<?= url('myschoolby') ?>" class="group relative inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-white transition-all duration-200 bg-gradient-to-r from-primary-600 via-primary-500 to-secondary-500 rounded-full hover:shadow-2xl hover:shadow-primary-500/50 hover:scale-105">
                <span class="relative z-10 flex items-center gap-3">
                    <?= t('cta_myschoolby', 'aplicaciones') ?>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </span>
            </a>
            <a href="https://saberpro.mente-viva.co/materia-practica?guest=1" target="_blank" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-orange-400 transition-all duration-200 border-2 border-orange-500 rounded-full hover:bg-orange-500/10">
                <?= t('probar_gratis', 'common') ?> Saber PRO
            </a>
        </div>
    </div>
</section>

<!-- Schema.org ItemList pour les applications -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "item": {
                "@type": "SoftwareApplication",
                "name": "MySchoolBy",
                "applicationCategory": "EducationalApplication",
                "operatingSystem": "Web",
                "offers": {"@type": "Offer", "price": "0", "priceCurrency": "COP"}
            }
        },
        {
            "@type": "ListItem",
            "position": 2,
            "item": {
                "@type": "SoftwareApplication",
                "name": "Saber PRO",
                "applicationCategory": "EducationalApplication",
                "operatingSystem": "Web",
                "offers": {"@type": "Offer", "price": "0", "priceCurrency": "COP"}
            }
        },
        {
            "@type": "ListItem",
            "position": 3,
            "item": {
                "@type": "SoftwareApplication",
                "name": "Preicfes",
                "applicationCategory": "EducationalApplication",
                "operatingSystem": "Web",
                "offers": {"@type": "Offer", "price": "0", "priceCurrency": "COP"}
            }
        }
    ]
}
</script>

<!-- Keywords sémantiques cachées -->
<div class="sr-only" aria-hidden="true">
    <p>Ecosistema educativo HM, MySchoolBy plataforma aprendizaje, Saber PRO preparación Colombia, 
    Concurso Docente formación online, Preicfes gratis, Pruebas Saber Colombia, 
    Quiero Ser Quiero Saber orientación vocacional, plataforma educativa internacional,
    ecosistema escolar pedagógico, plataforma examenes Colombia.</p>
</div>
