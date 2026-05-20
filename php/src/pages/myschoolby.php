<?php
declare(strict_types=1);

// SEO spécifique MySchoolBy
$pageTitle = t('title', 'seo.myschoolby');
$pageDescription = t('description', 'seo.myschoolby');
$pageKeywords = t('keywords', 'seo.myschoolby');
$pageH1 = t('h1', 'seo.myschoolby');
$pageCanonical = url('myschoolby');
$pageOgImage = '/og-myschoolby.jpg';
?>

<!-- HERO SECTION -->
<section class="relative min-h-[70vh] flex items-center overflow-hidden bg-gradient-to-br from-slate-900 via-primary-900 to-slate-900">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-primary-600/20 via-transparent to-transparent"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 py-24">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-300 text-sm font-medium mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                    </span>
                    <?= t('hero_badge', 'myschoolby') ?>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
                    <?= t('hero_title', 'myschoolby') ?>
                </h1>
                
                <p class="text-xl text-slate-300 max-w-2xl mb-8">
                    <?= t('hero_subtitle', 'myschoolby') ?>
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="<?= url('contacto') ?>" class="group relative px-8 py-4 bg-gradient-to-r from-primary-600 to-secondary-500 text-white rounded-full font-bold text-lg text-center overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:shadow-primary-500/25">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <?= t('cta_demo', 'myschoolby') ?>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </span>
                    </a>
                </div>
                
                <div class="flex flex-wrap gap-6 mt-10 justify-center lg:justify-start text-sm text-slate-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Cloud SSL
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Multilanguage
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        GDPR Ready
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-600 to-secondary-500 rounded-3xl opacity-20 blur-2xl"></div>
                    <div class="relative bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 border border-slate-700 shadow-2xl">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-white text-xl font-bold">MySchoolBy</h3>
                                <p class="text-slate-400 text-sm">Ecosistema SaaS</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-slate-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-primary-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <span class="text-slate-300 text-sm"><?= t('portail_prof', 'catalogo') ?></span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-slate-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-secondary-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <span class="text-slate-300 text-sm"><?= t('portail_eleve', 'catalogo') ?></span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-slate-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-orange-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-slate-300 text-sm"><?= t('systemes_gestion', 'catalogo') ?></span>
                            </div>
                        </div>
                        
                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a href="https://myschoolby.mente-viva.co" target="_blank" class="px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-semibold text-center transition-colors">
                                <?= t('cta_portal_prof', 'myschoolby') ?>
                            </a>
                            <a href="https://mente-viva.co/myschoolby" target="_blank" class="px-4 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold text-center transition-colors">
                                <?= t('cta_portal_est', 'myschoolby') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION PHILOSOPHIE -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Philosophy</span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('philosophie_title', 'myschoolby') ?>
            </h2>
            <p class="text-xl text-slate-600 mt-4 max-w-3xl mx-auto">
                <?= t('philosophie_intro', 'myschoolby') ?>
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-slate-50 rounded-2xl p-8 border-l-4 border-primary-500 scroll-reveal">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900"><?= t('pilier_1_title', 'myschoolby') ?></h3>
                <p class="text-slate-600">
                    <?= t('pilier_1_text', 'myschoolby') ?>
                </p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border-l-4 border-secondary-500 scroll-reveal">
                <div class="w-14 h-14 bg-secondary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900"><?= t('pilier_2_title', 'myschoolby') ?></h3>
                <p class="text-slate-600">
                    <?= t('pilier_2_text', 'myschoolby') ?>
                </p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border-l-4 border-orange-500 scroll-reveal">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900"><?= t('pilier_3_title', 'myschoolby') ?></h3>
                <p class="text-slate-600">
                    <?= t('pilier_3_text', 'myschoolby') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION FEATURES -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Features</span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('features_title', 'myschoolby') ?>
            </h2>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div class="group bg-white rounded-2xl p-8 hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-200 scroll-reveal">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= t('portal_prof_title', 'myschoolby') ?></h3>
                <p class="text-slate-600 mb-4">
                    <?= t('portal_prof_desc', 'myschoolby') ?>
                </p>
                <a href="https://myschoolby.mente-viva.co" target="_blank" class="inline-flex items-center gap-2 text-primary-600 font-semibold text-sm hover:text-primary-700">
                    <?= t('cta_portal_prof', 'myschoolby') ?> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
            
            <div class="group bg-white rounded-2xl p-8 hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-200 scroll-reveal">
                <div class="w-14 h-14 bg-secondary-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?= t('portal_est_title', 'myschoolby') ?></h3>
                <p class="text-slate-600 mb-4">
                    <?= t('portal_est_desc', 'myschoolby') ?>
                </p>
                <a href="https://mente-viva.co/myschoolby" target="_blank" class="inline-flex items-center gap-2 text-secondary-600 font-semibold text-sm hover:text-secondary-700">
                    <?= t('cta_portal_est', 'myschoolby') ?> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION SYSTEMS -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Systems</span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('systems_title', 'myschoolby') ?>
            </h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200 scroll-reveal">
                <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <span class="text-white font-bold text-lg">US</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('system_us_title', 'myschoolby') ?></h3>
                <p class="text-slate-600">
                    <?= t('system_us_desc', 'myschoolby') ?>
                </p>
            </div>
            
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-8 border border-red-200 scroll-reveal">
                <div class="w-14 h-14 bg-red-500 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <span class="text-white font-bold text-lg">FR</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('system_fr_title', 'myschoolby') ?></h3>
                <p class="text-slate-600">
                    <?= t('system_fr_desc', 'myschoolby') ?>
                </p>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-8 border border-yellow-200 scroll-reveal">
                <div class="w-14 h-14 bg-yellow-500 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <span class="text-white font-bold text-lg">CO</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('system_co_title', 'myschoolby') ?></h3>
                <p class="text-slate-600">
                    <?= t('system_co_desc', 'myschoolby') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION LANGUES -->
<section class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-bold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?= t('langues_badge', 'myschoolby') ?>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('langues_title', 'myschoolby') ?>
            </h2>
            <p class="text-xl text-slate-600 mt-4 max-w-3xl mx-auto">
                <?= t('langues_intro', 'myschoolby') ?>
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-12">
            <!-- Anglais -->
            <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border <?= getLang() === 'en' ? 'border-2 border-blue-500 ring-2 ring-blue-200 shadow-lg' : 'border-blue-200 hover:border-blue-400 hover:shadow-lg' ?> transition-all text-center scroll-reveal">
                <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                    <span class="text-white font-bold text-lg">EN</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1"><?= t('langue_anglais', 'myschoolby') ?></h3>
                <span class="inline-flex items-center px-2 py-1 <?= getLang() === 'en' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' ?> rounded-full text-xs font-semibold"><?= getLang() === 'en' ? t('langue_active', 'myschoolby') : t('langues_native', 'myschoolby') ?></span>
            </div>
            
            <!-- Italien -->
            <div class="group bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200 hover:border-green-400 hover:shadow-lg transition-all text-center scroll-reveal">
                <div class="w-14 h-14 bg-green-500 rounded-xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                    <span class="text-white font-bold text-lg">IT</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1"><?= t('langue_italien', 'myschoolby') ?></h3>
                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold"><?= t('langues_native', 'myschoolby') ?></span>
            </div>
            
            <!-- Espagnol -->
            <div class="group bg-gradient-to-br from-yellow-50 to-amber-50 rounded-2xl p-6 border <?= getLang() === 'es' ? 'border-2 border-yellow-500 ring-2 ring-yellow-200 shadow-lg' : 'border-yellow-200 hover:border-yellow-400 hover:shadow-lg' ?> transition-all text-center scroll-reveal">
                <div class="w-14 h-14 bg-yellow-500 rounded-xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                    <span class="text-white font-bold text-lg">ES</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1"><?= t('langue_espagnol', 'myschoolby') ?></h3>
                <span class="inline-flex items-center px-2 py-1 <?= getLang() === 'es' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' ?> rounded-full text-xs font-semibold"><?= getLang() === 'es' ? t('langue_active', 'myschoolby') : t('langues_native', 'myschoolby') ?></span>
            </div>
            
            <!-- Chinois -->
            <div class="group bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl p-6 border border-red-200 hover:border-red-400 hover:shadow-lg transition-all text-center scroll-reveal">
                <div class="w-14 h-14 bg-red-500 rounded-xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                    <span class="text-white font-bold text-lg">中</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1"><?= t('langue_chinois', 'myschoolby') ?></h3>
                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold"><?= t('langues_native', 'myschoolby') ?></span>
            </div>
            
            <!-- Arabe -->
            <div class="group bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl p-6 border border-teal-200 hover:border-teal-400 hover:shadow-lg transition-all text-center scroll-reveal">
                <div class="w-14 h-14 bg-teal-500 rounded-xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                    <span class="text-white font-bold text-lg">ع</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1"><?= t('langue_arabe', 'myschoolby') ?></h3>
                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold"><?= t('langues_native', 'myschoolby') ?></span>
            </div>
            
            <!-- Allemand -->
            <div class="group bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-6 border border-orange-200 hover:border-orange-400 hover:shadow-lg transition-all text-center scroll-reveal">
                <div class="w-14 h-14 bg-orange-500 rounded-xl flex items-center justify-center mb-4 mx-auto shadow-lg">
                    <span class="text-white font-bold text-lg">DE</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1"><?= t('langue_allemand', 'myschoolby') ?></h3>
                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold"><?= t('langues_native', 'myschoolby') ?></span>
            </div>
        </div>
        
        <!-- Autres langues sur demande -->
        <div class="bg-slate-50 rounded-3xl p-8 md:p-12 border <?= getLang() === 'fr' ? 'border-2 border-primary-500 ring-2 ring-primary-200 shadow-xl' : 'border-slate-200' ?> scroll-reveal">
            <div class="flex flex-col md:flex-row items-center gap-6 text-center md:text-left">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">
                        <?= t('langues_plus', 'myschoolby') ?>
                        <?php if (getLang() === 'fr'): ?>
                        <span class="ml-2 inline-flex items-center px-2 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-semibold"><?= t('langue_active', 'myschoolby') ?> — Français</span>
                        <?php endif; ?>
                    </h3>
                    <p class="text-slate-600 text-lg"><?= t('langues_plus_desc', 'myschoolby') ?></p>
                </div>
                <a href="<?= url('contacto') ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition-colors shadow-lg shadow-primary-200 flex-shrink-0">
                    <?= t('cta_demo', 'myschoolby') ?>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION INTERNATIONAL -->
<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-600/20 to-secondary-600/20"></div>
    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            <?= t('international_title', 'myschoolby') ?>
        </h2>
        <p class="text-xl text-slate-300 mb-12 max-w-2xl mx-auto">
            <?= t('international_desc', 'myschoolby') ?>
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?= url('contacto') ?>" class="group relative inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-white transition-all duration-200 bg-gradient-to-r from-primary-600 via-primary-500 to-secondary-500 rounded-full hover:shadow-2xl hover:shadow-primary-500/50 hover:scale-105">
                <span class="relative z-10 flex items-center gap-3">
                    <?= t('international_cta', 'myschoolby') ?>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </span>
            </a>
        </div>
        
        <div class="mt-10 flex flex-wrap justify-center gap-6 text-sm text-slate-400">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                OVH Cloud Europe
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                SSL Let's Encrypt
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                ES / EN / FR
            </div>
        </div>
    </div>
</section>

<!-- SECTION FAQ -->
<section class="py-24 bg-slate-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">FAQ</span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                MySchoolBy
            </h2>
        </div>
        
        <div class="space-y-6">
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('seo_faq_1_title', 'myschoolby') ?></h3>
                <p class="text-slate-600"><?= t('seo_faq_1_text', 'myschoolby') ?></p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('seo_faq_2_title', 'myschoolby') ?></h3>
                <p class="text-slate-600"><?= t('seo_faq_2_text', 'myschoolby') ?></p>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('seo_faq_3_title', 'myschoolby') ?></h3>
                <p class="text-slate-600"><?= t('seo_faq_3_text', 'myschoolby') ?></p>
            </div>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section class="py-24 bg-primary-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            MySchoolBy
        </h2>
        <p class="text-xl text-primary-100 mb-12 max-w-2xl mx-auto">
            <?= t('hero_subtitle', 'myschoolby') ?>
        </p>
        <a href="<?= url('contacto') ?>" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-primary-700 transition-all duration-200 bg-white rounded-full hover:shadow-2xl hover:scale-105">
            <?= t('cta_demo', 'myschoolby') ?>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
        </a>
    </div>
</section>

<!-- Keywords sémantiques cachées -->
<div class="sr-only" aria-hidden="true">
    <p>MySchoolBy ecosistema aprendizaje SaaS, plataforma educativa internacional, portal profesores, portal estudiantes, 
    sistema educativo Estados Unidos, sistema educativo Francia, sistema educativo Colombia, 
    plataforma educativa cloud, plataforma colegio pedagógica, aprendizaje centrado en educación,
    evaluación idiomas extranjeros colegio, evaluación lengua extranjera inglés, evaluación lengua extranjera italiano,
    evaluación lengua extranjera chino, evaluación lengua extranjera árabe, evaluación lengua extranjera alemán,
    plataforma evaluación idiomas, preparación evaluación lenguas escuela.</p>
</div>
