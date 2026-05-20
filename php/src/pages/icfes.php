<?php
declare(strict_types=1);

$pageTitle = t('title', 'seo.icfes');
$pageDescription = t('description', 'seo.icfes');
$pageKeywords = t('keywords', 'seo.icfes');
$pageH1 = t('h1', 'seo.icfes');
$pageCanonical = url('icfes');
$pageOgImage = '/og-icfes.jpg';
?>

<!-- HERO SECTION - Impact immédiat -->
<section class="relative min-h-screen flex items-center overflow-hidden bg-slate-950">
    <!-- Background dynamique -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-600/20 via-purple-600/10 to-slate-950"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%234f46e5%22%20fill-opacity%3D%220.05%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 py-20 grid lg:grid-cols-2 gap-12 items-center">
        <!-- Texte -->
        <div class="space-y-8 animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm font-medium">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                <?= t('hero_badge', 'icfes') ?>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight">
                <?= t('hero_h1_l1', 'icfes') ?> 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">ICFES</span> 
                <?= t('hero_h1_l2', 'icfes') ?>
            </h1>
            
            <p class="text-xl text-slate-400 max-w-lg">
                <?= t('hero_subtitle', 'icfes') ?>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#entrenar" class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full font-bold text-lg text-center overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/25">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <?= t('cta_entrenar', 'icfes') ?>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
                
                <!-- <button onclick="document.getElementById('demo-video').showModal()" class="px-8 py-4 border border-slate-600 text-slate-300 rounded-full font-semibold text-lg hover:border-slate-400 hover:text-white transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Ver cómo funciona
                </button> -->
            </div>
            
            <!-- Social proof compact -->
            <div class="flex items-center gap-4 text-sm text-slate-500">
                <div class="flex -space-x-3">
                    <img src="https://i.pravatar.cc/100?img=1" class="w-10 h-10 rounded-full border-2 border-slate-950" alt="">
                    <img src="https://i.pravatar.cc/100?img=5" class="w-10 h-10 rounded-full border-2 border-slate-950" alt="">
                    <img src="https://i.pravatar.cc/100?img=8" class="w-10 h-10 rounded-full border-2 border-slate-950" alt="">
                    <div class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs font-bold text-white">+2k</div>
                </div>
                <p><?= t('social_proof', 'icfes') ?></p>
            </div>
        </div>
        
        <!-- VISUAL/STATS - Graphique animé -->
        <div class="relative hidden lg:block">
            <div class="relative bg-slate-900/80 backdrop-blur-xl rounded-3xl p-8 border border-slate-700 shadow-2xl">
                
                <!-- Header du graphique -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="text-slate-400 text-sm"><?= t('progreso_promedio', 'icfes') ?></p>
                        <p class="text-white text-2xl font-bold"><?= t('evolucion_puntaje', 'icfes') ?></p>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-green-500/20 rounded-full">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-green-400 text-sm font-semibold"><?= t('mejora', 'icfes') ?></span>
                    </div>
                </div>
                
                <!-- Graphique SVG animé -->
                <div class="relative h-64 w-full">
                    <svg class="w-full h-full" viewBox="0 0 400 200" preserveAspectRatio="none">
                        <!-- Grille -->
                        <defs>
                            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(148,163,184,0.1)" stroke-width="1"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" />
                        
                        <!-- Ligne de base (avant) -->
                        <path d="M 0 160 Q 100 155, 150 150 T 300 140" 
                              fill="none" 
                              stroke="rgba(148,163,184,0.3)" 
                              stroke-width="2" 
                              stroke-dasharray="5,5"/>
                        
                        <!-- Zone sous la courbe (gradient) -->
                        <defs>
                            <linearGradient id="gradientArea" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.3" />
                                <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:0" />
                            </linearGradient>
                        </defs>
                        
                        <!-- Zone remplie -->
                        <path d="M 0 160 L 0 160 Q 50 140, 100 120 T 200 80 T 300 40 T 400 20 L 400 200 L 0 200 Z" 
                              fill="url(#gradientArea)"
                              class="animate-pulse-slow">
                            <animate attributeName="d" 
                                     dur="2s" 
                                     fill="freeze"
                                     from="M 0 200 L 0 200 Q 50 200, 100 200 T 200 200 T 300 200 T 400 200 L 400 200 L 0 200 Z"
                                     to="M 0 160 L 0 160 Q 50 140, 100 120 T 200 80 T 300 40 T 400 20 L 400 200 L 0 200 Z"/>
                        </path>
                        
                        <!-- Ligne principale animée -->
                        <path d="M 0 160 Q 50 140, 100 120 T 200 80 T 300 40 T 400 20" 
                              fill="none" 
                              stroke="url(#lineGradient)" 
                              stroke-width="4"
                              stroke-linecap="round">
                            <defs>
                                <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#3b82f6" />
                                    <stop offset="50%" style="stop-color:#8b5cf6" />
                                    <stop offset="100%" style="stop-color:#ec4899" />
                                </linearGradient>
                            </defs>
                            <animate attributeName="stroke-dasharray" from="0,1000" to="1000,0" dur="2s" fill="freeze"/>
                        </path>
                        
                        <!-- Points sur la courbe -->
                        <circle cx="0" cy="160" r="6" fill="#3b82f6" class="animate-fade-in" style="animation-delay: 0.5s"/>
                        <circle cx="100" cy="120" r="6" fill="#6366f1" class="animate-fade-in" style="animation-delay: 1s"/>
                        <circle cx="200" cy="80" r="6" fill="#8b5cf6" class="animate-fade-in" style="animation-delay: 1.3s"/>
                        <circle cx="300" cy="40" r="8" fill="#ec4899" class="animate-bounce" style="animation-delay: 1.6s"/>
                        
                        <!-- Labels -->
                        <text x="0" y="185" fill="#94a3b8" font-size="12" font-family="sans-serif"><?= t('mes_1', 'icfes') ?></text>
                        <text x="180" y="185" fill="#94a3b8" font-size="12" font-family="sans-serif"><?= t('mes_2', 'icfes') ?></text>
                        <text x="360" y="185" fill="#94a3b8" font-size="12" font-family="sans-serif"><?= t('mes_3', 'icfes') ?></text>
                        
                        <!-- Valeur finale -->
                        <g class="animate-fade-in" style="animation-delay: 2s">
                            <rect x="320" y="10" width="70" height="25" rx="5" fill="#ec4899"/>
                            <text x="355" y="27" fill="white" font-size="12" font-weight="bold" text-anchor="middle"><?= t('puntaje_final', 'icfes') ?></text>
                            <path d="M 340 35 L 330 40" stroke="#ec4899" stroke-width="2"/>
                        </g>
                    </svg>
                </div>
                
                <!-- Légende -->
                <div class="flex items-center justify-center gap-8 mt-6 text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                        <span class="text-slate-400"><?= t('estudio_tradicional', 'icfes') ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-1 rounded bg-gradient-to-r from-blue-500 to-pink-500"></div>
                        <span class="text-white font-semibold"><?= t('con_mente_viva', 'icfes') ?></span>
                    </div>
                </div>
            </div>
            
            <!-- Badge flottant -->
            <div class="absolute -top-4 -right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg animate-bounce">
                🚀 <?= t('puntos_mas', 'icfes') ?>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>
</section>

<!-- URGENCE - Le problème réel -->
<section class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-red-600 font-semibold text-sm uppercase tracking-wider"><?= t('problema_label', 'icfes') ?></span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('problema_h2', 'icfes') ?>
            </h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Problème 1 -->
            <div class="group relative bg-slate-50 rounded-2xl p-8 hover:bg-red-50 transition-colors duration-300">
                <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('problema_1_title', 'icfes') ?></h3>
                <p class="text-slate-600">
                    <?= t('problema_1_desc', 'icfes') ?>
                </p>
            </div>
            
            <!-- Problème 2 -->
            <div class="group relative bg-slate-50 rounded-2xl p-8 hover:bg-orange-50 transition-colors duration-300">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('problema_2_title', 'icfes') ?></h3>
                <p class="text-slate-600">
                    <?= t('problema_2_desc', 'icfes') ?>
                </p>
            </div>
            
            <!-- Problème 3 -->
            <div class="group relative bg-slate-50 rounded-2xl p-8 hover:bg-purple-50 transition-colors duration-300">
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('problema_3_title', 'icfes') ?></h3>
                <p class="text-slate-600">
                    <?= t('problema_3_desc', 'icfes') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SOLUTION - Transformation -->
<section id="entrenar" class="py-24 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white relative overflow-hidden">
    <!-- Effets de fond -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,_rgba(59,130,246,0.15)_0%,_transparent_50%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,_rgba(147,51,234,0.15)_0%,_transparent_50%)]"></div>
    
    <div class="relative max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-blue-300 text-sm font-medium mb-6">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <?= t('solucion_badge', 'icfes') ?>
            </span>
            <h2 class="text-4xl md:text-6xl font-bold mb-6">
                <?= t('solucion_h2_l1', 'icfes') ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400"><?= t('solucion_h2_l2', 'icfes') ?></span>
            </h2>
        </div>
        
        <!-- Étapes interactives -->
        <div class="grid lg:grid-cols-3 gap-8 mb-16">
            <!-- Étape 1 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-800/50 backdrop-blur-sm rounded-2xl p-8 border border-slate-700 hover:border-blue-500/50 transition">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-6 text-xl font-bold">1</div>
                    <h3 class="text-2xl font-bold mb-4"><?= t('paso_1_title', 'icfes') ?></h3>
                    <p class="text-slate-400 mb-6">
                        <?= t('paso_1_desc', 'icfes') ?>
                    </p>
                    <div class="flex items-center gap-2 text-blue-400 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <?= t('paso_1_feature', 'icfes') ?>
                    </div>
                </div>
            </div>
            
            <!-- Étape 2 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-800/50 backdrop-blur-sm rounded-2xl p-8 border border-slate-700 hover:border-purple-500/50 transition">
                    <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mb-6 text-xl font-bold">2</div>
                    <h3 class="text-2xl font-bold mb-4"><?= t('paso_2_title', 'icfes') ?></h3>
                    <p class="text-slate-400 mb-6">
                        <?= t('paso_2_desc', 'icfes') ?>
                    </p>
                    <div class="flex items-center gap-2 text-purple-400 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <?= t('paso_2_feature', 'icfes') ?>
                    </div>
                </div>
            </div>
            
            <!-- Étape 3 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-red-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-800/50 backdrop-blur-sm rounded-2xl p-8 border border-slate-700 hover:border-pink-500/50 transition">
                    <div class="w-12 h-12 bg-pink-600 rounded-xl flex items-center justify-center mb-6 text-xl font-bold">3</div>
                    <h3 class="text-2xl font-bold mb-4"><?= t('paso_3_title', 'icfes') ?></h3>
                    <p class="text-slate-400 mb-6">
                        <?= t('paso_3_desc', 'icfes') ?>
                    </p>
                    <div class="flex items-center gap-2 text-pink-400 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <?= t('paso_3_feature', 'icfes') ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats dynamiques -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-12 border-t border-slate-800">
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-blue-400 mb-2">+47</div>
                <div class="text-slate-400 text-sm"><?= t('stat_puntos', 'icfes') ?></div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-purple-400 mb-2">2,500+</div>
                <div class="text-slate-400 text-sm"><?= t('stat_estudiantes', 'icfes') ?></div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-pink-400 mb-2">94%</div>
                <div class="text-slate-400 text-sm"><?= t('stat_recomiendan', 'icfes') ?></div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-green-400 mb-2">12</div>
                <div class="text-slate-400 text-sm"><?= t('stat_semanas', 'icfes') ?></div>
            </div>
        </div>
    </div>
</section>

<!-- PREUVE SOCIAL - Témoignages -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-slate-900 mb-16">
            <?= t('testimonios_h2', 'icfes') ?>
        </h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Témoignage 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-slate-600 mb-6 text-lg">
                    "Pasé de 220 a 387 puntos. Lo mejor fue que ya no me daba pánico el examen, sabía exactamente qué esperar."
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=32" class="w-12 h-12 rounded-full" alt="">
                    <div>
                        <p class="font-bold text-slate-900">Laura Gómez</p>
                        <p class="text-sm text-slate-500">Ingeniería, Universidad Nacional</p>
                    </div>
                </div>
                <div class="mt-4 inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +167 puntos
                </div>
            </div>
            
            <!-- Témoignage 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-slate-600 mb-6 text-lg">
                    "La corrección inmediata me ayudó a entender mis errores. En 3 meses subí 89 puntos y entré a Medicina."
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=12" class="w-12 h-12 rounded-full" alt="">
                    <div>
                        <p class="font-bold text-slate-900">Andrés Martínez</p>
                        <p class="text-sm text-slate-500">Medicina, Universidad de Antioquia</p>
                    </div>
                </div>
                <div class="mt-4 inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +89 puntos
                </div>
            </div>
            
            <!-- Témoignage 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-slate-600 mb-6 text-lg">
                    "Pensé que no tenía chance con mi puntaje inicial. Mente Viva me mostró que solo necesitaba entrenar inteligentemente."
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=44" class="w-12 h-12 rounded-full" alt="">
                    <div>
                        <p class="font-bold text-slate-900">Sofía Ramírez</p>
                        <p class="text-sm text-slate-500">Derecho, Universidad de los Andes</p>
                    </div>
                </div>
                <div class="mt-4 inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +124 puntos
                </div>
            </div>
        </div>
    </div>
</section>

<!-- URGENCE FINALE - CTA -->
<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.03%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <!-- Compte à rebours ou urgence -->
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-500/20 border border-red-500/30 text-red-300 text-sm font-medium mb-8 animate-pulse">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <?= t('urgencia_badge', 'icfes') ?>
        </div>
        
        <h2 class="text-5xl md:text-6xl font-bold mb-6">
            <?= t('urgencia_h2', 'icfes') ?>
        </h2>
        
        <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto">
            <?= t('urgencia_desc', 'icfes') ?>
        </p>
        
        <!-- Bouton principal MASSIF -->
        <div class="flex flex-col items-center gap-6">
            <a href="https://mente-viva.co/empezarya" target="_blank" 
               class="group relative inline-flex items-center justify-center px-12 py-6 text-xl font-bold text-white transition-all duration-200 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-full hover:shadow-2xl hover:shadow-blue-500/50 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                <span class="relative z-10 flex items-center gap-3">
                    <?= t('cta_ahora', 'icfes') ?>
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </span>
                <!-- Effet de brillance -->
                <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-12"></div>
            </a>
            
            <p class="text-slate-500 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?= t('gratis_sin_tarjeta', 'icfes') ?>
            </p>
        </div>
        
        <!-- Garantie -->
        <div class="mt-16 grid md:grid-cols-3 gap-8 text-center text-sm text-slate-500">
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                <?= t('garantia_segura', 'icfes') ?>
            </div>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?= t('garantia_inmediato', 'icfes') ?>
            </div>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <?= t('garantia_soporte', 'icfes') ?>
            </div>
        </div>
    </div>
</section>

<!-- Modal vidéo (optionnel) -->
<dialog id="demo-video" class="rounded-2xl p-0 backdrop:bg-black/80 w-full max-w-4xl">
    <div class="relative aspect-video bg-black">
        <button onclick="document.getElementById('demo-video').close()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="flex items-center justify-center h-full text-white">
            <p>[Video demo aquí - YouTube o Vimeo embed]</p>
        </div>
    </div>
</dialog>

<?php include __DIR__ . '/../includes/footer.php'; ?>
