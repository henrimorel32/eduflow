<?php
declare(strict_types=1);

$pageTitle = t('title', 'seo.saberpro');
$pageDescription = t('description', 'seo.saberpro');
$pageKeywords = t('keywords', 'seo.saberpro');
$pageH1 = t('h1', 'seo.saberpro');
$pageCanonical = url('saberpro');
$pageOgImage = '/og-saberpro.jpg';
?>

<!-- SCHEMA.ORG RICH SNIPPETS -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "Mente Viva — Preparación Saber PRO",
  "applicationCategory": "EducationalApplication",
  "operatingSystem": "Web",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "COP"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "ratingCount": "3200"
  },
  "description": "Plataforma líder de preparación para el examen Saber PRO en Colombia. Simulacros reales con retroalimentación inmediata.",
  "url": "https://saberpro.mente-viva.co"
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "¿Qué es el examen Saber PRO?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "El Saber PRO es una evaluación obligatoria del ICFES que deben presentar los estudiantes de pregrado en Colombia antes de graduarse. Mide competencias genéricas (lectura crítica, razonamiento cuantitativo, inglés, competencias ciudadanas) y competencias específicas según cada carrera."
      }
    },
    {
      "@type": "Question",
      "name": "¿Cómo preparar el Saber PRO en línea?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "La mejor forma de preparar el Saber PRO en línea es practicar con simulacros que repliquen las condiciones reales del examen. Mente Viva ofrece simulacros cronometrados, retroalimentación por cada respuesta y un reporte detallado de competencias para que sepas exactamente en qué debes mejorar."
      }
    },
    {
      "@type": "Question",
      "name": "¿Cuánto tiempo se necesita para preparar el Saber PRO?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Con un método de estudio adaptativo como el de Mente Viva, la mayoría de estudiantes obtienen resultados significativos en 4 a 6 semanas practicando 30 minutos diarios. La clave es enfocarse en las competencias donde tienes más oportunidad de mejora."
      }
    }
  ]
}
</script>

<!-- HERO SECTION — SEO MAXIMIZÉ -->
<section class="relative min-h-screen flex items-center overflow-hidden bg-slate-950">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-orange-600/30 via-amber-600/10 to-slate-950"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%23f97316%22%20fill-opacity%3D%220.05%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 py-20 grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-medium">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                </span>
                <?= t('hero_badge', 'saberpro') ?>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                <?= t('hero_h1_l1', 'saberpro') ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-amber-400 to-yellow-400">Saber PRO</span> <?= t('hero_h1_l2', 'saberpro') ?>
            </h1>
            
            <p class="text-xl text-slate-400 max-w-xl">
                <?= t('hero_subtitle', 'saberpro') ?>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="https://saberpro.mente-viva.co" target="_blank" class="group relative px-8 py-4 bg-gradient-to-r from-orange-600 to-amber-500 text-white rounded-full font-bold text-lg text-center overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:shadow-orange-500/25">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <?= t('cta_empezar', 'saberpro') ?>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </span>
                </a>
                <a href="https://saberpro.mente-viva.co/materia-practica?guest=1" target="_blank" class="px-8 py-4 border-2 border-orange-500 text-orange-400 rounded-full font-bold text-lg text-center hover:bg-orange-500/10 transition-all">
                    <?= t('cta_probar', 'saberpro') ?>
                </a>
            </div>
            
            <div class="flex items-center gap-4 text-sm text-slate-500">
                <div class="flex -space-x-3">
                    <img src="https://i.pravatar.cc/100?img=11" class="w-10 h-10 rounded-full border-2 border-slate-950" alt="Estudiante">
                    <img src="https://i.pravatar.cc/100?img=22" class="w-10 h-10 rounded-full border-2 border-slate-950" alt="Estudiante">
                    <img src="https://i.pravatar.cc/100?img=33" class="w-10 h-10 rounded-full border-2 border-slate-950" alt="Estudiante">
                    <div class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800 flex items-center justify-center text-xs font-bold text-white">+3k</div>
                </div>
                <p><?= t('social_proof', 'saberpro') ?></p>
            </div>
        </div>
        
        <!-- Stats Card -->
        <div class="hidden lg:block">
            <div class="relative bg-slate-900/80 backdrop-blur-xl rounded-3xl p-8 border border-orange-500/30 shadow-2xl">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="text-slate-400 text-sm"><?= t('resultados_reales', 'saberpro') ?></p>
                        <p class="text-white text-2xl font-bold"><?= t('preparacion_titulo', 'saberpro') ?></p>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-green-500/20 rounded-full">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-green-400 text-sm font-semibold"><?= t('mejora_pct', 'saberpro') ?></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center p-4 bg-slate-800/50 rounded-2xl border border-slate-700">
                        <div class="text-3xl font-bold text-orange-400 mb-1">+3.000</div>
                        <div class="text-slate-400 text-sm"><?= t('estudiantes_preparados', 'saberpro') ?></div>
                    </div>
                    <div class="text-center p-4 bg-slate-800/50 rounded-2xl border border-slate-700">
                        <div class="text-3xl font-bold text-amber-400 mb-1">4.8/5</div>
                        <div class="text-slate-400 text-sm"><?= t('calificacion_promedio', 'saberpro') ?></div>
                    </div>
                    <div class="text-center p-4 bg-slate-800/50 rounded-2xl border border-slate-700">
                        <div class="text-3xl font-bold text-yellow-400 mb-1">98%</div>
                        <div class="text-slate-400 text-sm"><?= t('recomiendan_plataforma', 'saberpro') ?></div>
                    </div>
                    <div class="text-center p-4 bg-slate-800/50 rounded-2xl border border-slate-700">
                        <div class="text-3xl font-bold text-orange-300 mb-1">+50</div>
                        <div class="text-slate-400 text-sm"><?= t('simulacros_disponibles', 'saberpro') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: ¿QUÉ ES EL SABER PRO? — CONTENU LONG POUR SEO -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <span class="text-orange-600 font-semibold text-sm uppercase tracking-wider"><?= t('guia_label', 'saberpro') ?></span>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4 mb-8">
            <?= t('que_es_h2', 'saberpro') ?>
        </h2>
        
        <div class="prose prose-lg prose-slate max-w-none">
            <p class="text-slate-600 text-xl leading-relaxed mb-6">
                <?= t('que_es_desc_1', 'saberpro') ?>
            </p>
            
            <p class="text-slate-600 text-xl leading-relaxed mb-6">
                <?= t('que_es_desc_2', 'saberpro') ?>
            </p>
            
            <div class="bg-orange-50 border-l-4 border-orange-500 p-6 rounded-r-xl my-8">
                <p class="text-slate-800 font-semibold mb-2"><?= t('importancia_title', 'saberpro') ?></p>
                <p class="text-slate-600">
                    <?= t('importancia_desc', 'saberpro') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: ¿QUÉ EVALÚA? — SEO RICHE -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900">
                <?= t('evalua_h2', 'saberpro') ?>
            </h2>
            <p class="text-lg text-slate-600 mt-4 max-w-2xl mx-auto">
                <?= t('evalua_subtitle', 'saberpro') ?>
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Competencias Genéricas -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4"><?= t('competencias_generic_title', 'saberpro') ?></h3>
                <p class="text-slate-600 mb-6">
                    <?= t('competencias_generic_desc', 'saberpro') ?>
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">1</span>
                        <div>
                            <strong class="text-slate-900"><?= t('lectura_critica', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('lectura_critica_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">2</span>
                        <div>
                            <strong class="text-slate-900"><?= t('razonamiento', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('razonamiento_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">3</span>
                        <div>
                            <strong class="text-slate-900"><?= t('ciudadanas', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('ciudadanas_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">4</span>
                        <div>
                            <strong class="text-slate-900"><?= t('ingles', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('ingles_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <!-- Competencias Específicas -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4"><?= t('competencias_espec_title', 'saberpro') ?></h3>
                <p class="text-slate-600 mb-6">
                    <?= t('competencias_espec_desc', 'saberpro') ?>
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">A</span>
                        <div>
                            <strong class="text-slate-900"><?= t('salud', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('salud_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">B</span>
                        <div>
                            <strong class="text-slate-900"><?= t('economicas', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('economicas_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">C</span>
                        <div>
                            <strong class="text-slate-900"><?= t('ingenieria', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('ingenieria_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">D</span>
                        <div>
                            <strong class="text-slate-900"><?= t('sociales', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('sociales_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm font-bold shrink-0">E</span>
                        <div>
                            <strong class="text-slate-900"><?= t('agrarias', 'saberpro') ?></strong>
                            <p class="text-slate-500 text-sm"><?= t('agrarias_desc', 'saberpro') ?></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: CÓMO FUNCIONA NUESTRA PLATAFORMA -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-orange-600 font-semibold text-sm uppercase tracking-wider"><?= t('metodo_label', 'saberpro') ?></span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('metodo_h2', 'saberpro') ?>
            </h2>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-600 to-amber-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-50 rounded-2xl p-8 border border-slate-200 hover:border-orange-300 transition">
                    <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center mb-6 text-xl font-bold text-white">1</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4"><?= t('metodo_1_title', 'saberpro') ?></h3>
                    <p class="text-slate-600">
                        <?= t('metodo_1_desc', 'saberpro') ?>
                    </p>
                </div>
            </div>
            
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-amber-600 to-yellow-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-50 rounded-2xl p-8 border border-slate-200 hover:border-amber-300 transition">
                    <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center mb-6 text-xl font-bold text-white">2</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4"><?= t('metodo_2_title', 'saberpro') ?></h3>
                    <p class="text-slate-600">
                        <?= t('metodo_2_desc', 'saberpro') ?>
                    </p>
                </div>
            </div>
            
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-yellow-600 to-orange-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-slate-50 rounded-2xl p-8 border border-slate-200 hover:border-yellow-300 transition">
                    <div class="w-12 h-12 bg-yellow-600 rounded-xl flex items-center justify-center mb-6 text-xl font-bold text-white">3</div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4"><?= t('metodo_3_title', 'saberpro') ?></h3>
                    <p class="text-slate-600">
                        <?= t('metodo_3_desc', 'saberpro') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: TESTIMONIOS -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-slate-900 mb-16">
            <?= t('testimonios_h2', 'saberpro') ?>
        </h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-slate-600 mb-6 text-lg">
                    "Pensé que el Saber PRO era solo un trámite. Cuando vi mi primer simulacro en Mente Viva me di cuenta de que necesitaba prepararme en serio. Subí 40 puntos en lectura crítica."
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=60" class="w-12 h-12 rounded-full" alt="Camilo R.">
                    <div>
                        <p class="font-bold text-slate-900">Camilo R.</p>
                        <p class="text-sm text-slate-500">Administración de Empresas — Universidad Javeriana</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-slate-600 mb-6 text-lg">
                    "La parte de competencias específicas de ingeniería me salvó. En la universidad nunca nos habían evaluado así. Los simulacros de Mente Viva me acostumbraron al formato."
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=15" class="w-12 h-12 rounded-full" alt="Daniela M.">
                    <div>
                        <p class="font-bold text-slate-900">Daniela M.</p>
                        <p class="text-sm text-slate-500">Ingeniería Industrial — Universidad Nacional</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
                <p class="text-slate-600 mb-6 text-lg">
                    "Mi universidad nos obligó a presentar el Saber PRO para graduarnos. Usé Mente Viva 3 semanas antes y pasé sin problemas. El modo invitado me convenció de comprar el plan completo."
                </p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=28" class="w-12 h-12 rounded-full" alt="Andrés P.">
                    <div>
                        <p class="font-bold text-slate-900">Andrés P.</p>
                        <p class="text-sm text-slate-500">Derecho — Universidad de los Andes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: FAQ — RICH SNIPPETS POUR GOOGLE -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-orange-600 font-semibold text-sm uppercase tracking-wider"><?= t('faq_label', 'saberpro') ?></span>
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-4">
                <?= t('faq_h2', 'saberpro') ?>
            </h2>
        </div>
        
        <div class="space-y-6">
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_1_q', 'saberpro') ?></h3>
                <p class="text-slate-600">
                    <?= t('faq_1_a', 'saberpro') ?>
                </p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_2_q', 'saberpro') ?></h3>
                <p class="text-slate-600">
                    <?= t('faq_2_a', 'saberpro') ?>
                </p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_3_q', 'saberpro') ?></h3>
                <p class="text-slate-600 mb-4">
                    <?= t('faq_3_a_intro', 'saberpro') ?>
                </p>
                <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                    <li><?= t('faq_3_a_generic', 'saberpro') ?></li>
                    <li><?= t('faq_3_a_specific', 'saberpro') ?></li>
                </ul>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_4_q', 'saberpro') ?></h3>
                <p class="text-slate-600">
                    <?= t('faq_4_a', 'saberpro') ?>
                </p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_5_q', 'saberpro') ?></h3>
                <p class="text-slate-600">
                    <?= t('faq_5_a', 'saberpro') ?>
                </p>
            </div>
            
            <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-3"><?= t('faq_6_q', 'saberpro') ?></h3>
                <p class="text-slate-600">
                    <?= t('faq_6_a', 'saberpro') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION: CTA FINAL — ULTRA OPTIMISÉE -->
<section class="py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-orange-600/20 to-amber-600/20"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.03%22%3E%3Cpath%20d%3D%22M36%2034v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6%2034v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6%204V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-6xl font-bold mb-6">
            <?= t('cta_final_h2', 'saberpro') ?>
        </h2>
        <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto">
            <?= t('cta_final_desc', 'saberpro') ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <a href="https://saberpro.mente-viva.co" target="_blank" 
               class="group relative inline-flex items-center justify-center px-12 py-6 text-xl font-bold text-white transition-all duration-200 bg-gradient-to-r from-orange-600 via-amber-500 to-yellow-500 rounded-full hover:shadow-2xl hover:shadow-orange-500/50 hover:scale-105">
                <span class="relative z-10 flex items-center gap-3">
                    <?= t('cta_final_btn', 'saberpro') ?>
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </span>
            </a>
            <a href="https://saberpro.mente-viva.co/materia-practica?guest=1" target="_blank" 
               class="inline-flex items-center justify-center px-12 py-6 text-xl font-bold text-orange-400 transition-all duration-200 border-2 border-orange-500 rounded-full hover:bg-orange-500/10">
                <?= t('cta_final_probar', 'saberpro') ?>
            </a>
        </div>
        <div class="mt-12 grid md:grid-cols-3 gap-8 text-center text-sm text-slate-500">
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?= t('garantia_1', 'saberpro') ?>
            </div>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?= t('garantia_2', 'saberpro') ?>
            </div>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <?= t('garantia_3', 'saberpro') ?>
            </div>
        </div>
    </div>
</section>
