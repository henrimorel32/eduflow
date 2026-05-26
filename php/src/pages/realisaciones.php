<?php
declare(strict_types=1);

// SEO multilingue pour la page réalisaciones
$pageTitle = t('title', 'seo.realisaciones');
$pageDescription = t('description', 'seo.realisaciones');
$pageKeywords = t('keywords', 'seo.realisaciones');
$pageH1 = t('h1', 'seo.realisaciones');
$pageCanonical = url('realisaciones');
$pageOgImage = '/og-realisaciones.jpg';

$projects = [
    [
        'name' => 'Mente Viva',
        'url' => 'https://mente-viva.co',
        'type' => t('project_type_platform', 'realisaciones'),
        'desc' => t('project_desc_mente', 'realisaciones'),
        'tags' => ['Next.js', 'PostgreSQL', 'Docker', 'Tailwind'],
        'color' => 'from-violet-500 to-fuchsia-500',
        'bg' => 'bg-violet-50',
        'img' => 'mente-viva.jpg',
        'icon' => 'brain-circuit',
    ],
    [
        'name' => 'Saber PRO',
        'url' => 'https://saberpro.mente-viva.co',
        'type' => t('project_type_edtech', 'realisaciones'),
        'desc' => t('project_desc_saberpro', 'realisaciones'),
        'tags' => ['React', 'Node.js', 'IA', 'AWS'],
        'color' => 'from-orange-500 to-red-500',
        'bg' => 'bg-orange-50',
        'img' => 'saberpro.jpg',
        'icon' => 'graduation-cap',
    ],
    [
        'name' => 'MySchoolBy',
        'url' => 'https://mente-viva.co/myschoolby',
        'type' => t('project_type_saas', 'realisaciones'),
        'desc' => t('project_desc_myschoolby', 'realisaciones'),
        'tags' => ['SaaS', 'Multi-tenant', 'SSL', 'Cloud'],
        'color' => 'from-blue-500 to-cyan-500',
        'bg' => 'bg-blue-50',
        'img' => 'myschoolby.jpg',
        'icon' => 'school',
    ],
    [
        'name' => 'Palenque Rincón del Mar',
        'url' => 'https://palenquerincondelmar.co',
        'type' => t('project_type_tourism', 'realisaciones'),
        'desc' => t('project_desc_palenque', 'realisaciones'),
        'tags' => ['WordPress', 'Booking', 'Responsive', 'SEO'],
        'color' => 'from-emerald-500 to-teal-500',
        'bg' => 'bg-emerald-50',
        'img' => 'palenque.jpg',
        'icon' => 'umbrella',
    ],
    [
        'name' => 'Escuela Taller Sophia',
        'url' => 'https://escuelatallersophia.com',
        'type' => t('project_type_school', 'realisaciones'),
        'desc' => t('project_desc_sophia', 'realisaciones'),
        'tags' => ['CMS', 'Multilangue', 'PWA', 'Analytics'],
        'color' => 'from-pink-500 to-rose-500',
        'bg' => 'bg-pink-50',
        'img' => 'sophia.jpg',
        'icon' => 'sparkles',
    ],
    [
        'name' => 'Concurso Docente',
        'url' => 'https://docente.mente-viva.co',
        'type' => t('project_type_training', 'realisaciones'),
        'desc' => t('project_desc_docente', 'realisaciones'),
        'tags' => ['LMS', 'Video', 'Payments', 'Auth'],
        'color' => 'from-indigo-500 to-purple-500',
        'bg' => 'bg-indigo-50',
        'img' => 'docente.jpg',
        'icon' => 'users',
    ],
];

$skills = [
    [
        'icon' => 'rocket',
        'title' => t('skill_speed_title', 'realisaciones'),
        'desc' => t('skill_speed_desc', 'realisaciones'),
        'color' => 'text-rose-500',
        'bg' => 'bg-rose-50',
    ],
    [
        'icon' => 'smartphone',
        'title' => t('skill_mobile_title', 'realisaciones'),
        'desc' => t('skill_mobile_desc', 'realisaciones'),
        'color' => 'text-violet-500',
        'bg' => 'bg-violet-50',
    ],
    [
        'icon' => 'zap',
        'title' => t('skill_seo_title', 'realisaciones'),
        'desc' => t('skill_seo_desc', 'realisaciones'),
        'color' => 'text-amber-500',
        'bg' => 'bg-amber-50',
    ],
    [
        'icon' => 'shield-check',
        'title' => t('skill_security_title', 'realisaciones'),
        'desc' => t('skill_security_desc', 'realisaciones'),
        'color' => 'text-emerald-500',
        'bg' => 'bg-emerald-50',
    ],
];
?>

<style>
    .portfolio-hero {
        background: radial-gradient(ellipse at 20% 50%, rgba(124, 58, 237, 0.15) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 20%, rgba(236, 72, 153, 0.1) 0%, transparent 50%),
                    radial-gradient(ellipse at 50% 80%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                    #0f172a;
    }
    
    .browser-mockup {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .browser-mockup:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.4);
    }
    
    .browser-header {
        background: linear-gradient(to bottom, #f8fafc, #e2e8f0);
        border-bottom: 1px solid #cbd5e1;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .browser-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    
    .browser-dot.red { background: #ef4444; }
    .browser-dot.yellow { background: #eab308; }
    .browser-dot.green { background: #22c55e; }
    
    .browser-url {
        flex: 1;
        background: white;
        border-radius: 6px;
        padding: 4px 12px;
        font-size: 11px;
        color: #64748b;
        font-family: monospace;
        margin-left: 8px;
        border: 1px solid #e2e8f0;
    }
    
    .project-card-content {
        position: relative;
        height: 260px;
        overflow: hidden;
    }
    
    .project-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.6) 50%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.5rem;
    }
    
    .browser-mockup:hover .project-overlay {
        opacity: 1;
    }
    
    .project-meta {
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }
    
    .browser-mockup:hover .project-meta {
        transform: translateY(0);
    }
    
    .floating-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.4;
        animation: orbFloat 20s infinite ease-in-out;
    }
    
    @keyframes orbFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -30px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    
    .gradient-border {
        position: relative;
        background: white;
        border-radius: 16px;
    }
    
    .gradient-border::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 18px;
        background: linear-gradient(135deg, #8b5cf6, #ec4899, #3b82f6);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    
    .gradient-border:hover::before {
        opacity: 1;
    }
    
    .marquee-container {
        overflow: hidden;
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }
    
    .marquee-track {
        display: flex;
        gap: 2rem;
        animation: marquee 30s linear infinite;
    }
    
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    .tech-tag {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>

<!-- ========== HERO ========== -->
<section class="portfolio-hero relative min-h-[70vh] flex items-center overflow-hidden">
    <!-- Orbes flottants -->
    <div class="floating-orb w-96 h-96 bg-purple-500 top-0 left-0"></div>
    <div class="floating-orb w-72 h-72 bg-pink-500 bottom-0 right-0" style="animation-delay: -7s;"></div>
    <div class="floating-orb w-64 h-64 bg-blue-500 top-1/2 left-1/2" style="animation-delay: -14s;"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <div class="scroll-reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-purple-300 text-sm font-medium mb-8">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                </span>
                <?= t('hero_badge', 'realisaciones') ?>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-8 tracking-tight">
                <?= t('hero_h1_l1', 'realisaciones') ?><br>
                <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400 bg-clip-text text-transparent">
                    <?= t('hero_h1_l2', 'realisaciones') ?>
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto mb-12 leading-relaxed">
                <?= t('hero_subtitle', 'realisaciones') ?>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#proyectos" class="group px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full font-bold text-lg hover:shadow-2xl hover:shadow-purple-500/25 transition-all hover:scale-105 flex items-center justify-center gap-2">
                    <?= t('cta_see_projects', 'realisaciones') ?>
                    <i data-lucide="arrow-down" class="w-5 h-5 group-hover:translate-y-1 transition-transform"></i>
                </a>
                <a href="<?= url('contacto') ?>" class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-full font-bold text-lg hover:bg-white/10 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                    <?= t('cta_contact', 'realisaciones') ?>
                </a>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-20 max-w-4xl mx-auto">
            <?php foreach ([
                ['number' => '3', 'label' => t('stat_languages', 'realisaciones')],
                ['number' => '100%', 'label' => t('stat_responsive', 'realisaciones')],
                ['number' => '24/7', 'label' => t('stat_support', 'realisaciones')],
            ] as $stat): ?>
            <div class="scroll-reveal text-center p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                <div class="text-3xl md:text-4xl font-bold text-white mb-1"><?= $stat['number'] ?></div>
                <div class="text-sm text-slate-400"><?= $stat['label'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== PROJETS ========== -->
<section id="proyectos" class="py-24 bg-slate-950 relative overflow-hidden">
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <span class="text-purple-400 font-semibold text-sm uppercase tracking-wider"><?= t('section_work_label', 'realisaciones') ?></span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mt-4 mb-6">
                <?= t('section_work_title', 'realisaciones') ?>
            </h2>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                <?= t('section_work_subtitle', 'realisaciones') ?>
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8 lg:gap-10">
            <?php foreach ($projects as $i => $project): ?>
            <div class="scroll-reveal" style="transition-delay: <?= $i * 100 ?>ms">
                <div class="browser-mockup bg-slate-900 border border-slate-800">
                    <div class="browser-header">
                        <div class="browser-dot red"></div>
                        <div class="browser-dot yellow"></div>
                        <div class="browser-dot green"></div>
                        <div class="browser-url"><?= $project['url'] ?></div>
                    </div>
                    
                    <div class="project-card-content bg-slate-800 relative">
                        <!-- Screenshot -->
                        <img src="/screenshots/<?= $project['img'] ?>" alt="<?= $project['name'] ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        
                        <!-- Overlay hover -->
                        <div class="project-overlay">
                            <div class="project-meta">
                                <span class="text-purple-300 text-sm font-medium mb-2 block"><?= $project['type'] ?></span>
                                <p class="text-white/90 text-sm mb-4 leading-relaxed"><?= $project['desc'] ?></p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <?php foreach ($project['tags'] as $tag): ?>
                                    <span class="tech-tag px-3 py-1 rounded-full text-xs text-white font-medium"><?= $tag ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <a href="<?= $project['url'] ?>" target="_blank" rel="noopener noreferrer" 
                                   class="inline-flex items-center gap-2 text-white font-semibold hover:text-purple-300 transition-colors">
                                    <?= t('visit_site', 'realisaciones') ?>
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== COMPÉTENCES ========== -->
<section class="py-24 bg-slate-900 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <span class="text-pink-400 font-semibold text-sm uppercase tracking-wider"><?= t('section_why_label', 'realisaciones') ?></span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mt-4 mb-6">
                <?= t('section_why_title', 'realisaciones') ?>
            </h2>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                <?= t('section_why_subtitle', 'realisaciones') ?>
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($skills as $skill): ?>
            <div class="gradient-border scroll-reveal p-8 hover:shadow-2xl transition-all duration-500 group">
                <div class="w-14 h-14 rounded-2xl <?= $skill['bg'] ?> flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="<?= $skill['icon'] ?>" class="w-7 h-7 <?= $skill['color'] ?>"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3"><?= $skill['title'] ?></h3>
                <p class="text-gray-600 leading-relaxed"><?= $skill['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== MARQUEE TECH ========== -->
<section class="py-16 bg-slate-950 border-y border-slate-800 overflow-hidden">
    <div class="marquee-container">
        <div class="marquee-track">
            <?php 
            $techs = ['React', 'Next.js', 'Node.js', 'PostgreSQL', 'Docker', 'AWS', 'Tailwind CSS', 'TypeScript', 'Figma', 'WordPress', 'PHP', 'Python', 'Laravel', 'Vue.js', 'GraphQL'];
            // Doubler pour le loop infini
            foreach (array_merge($techs, $techs) as $tech): 
            ?>
            <div class="flex items-center gap-3 px-6 py-3 bg-slate-900 rounded-full border border-slate-800 whitespace-nowrap">
                <div class="w-2 h-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500"></div>
                <span class="text-slate-300 font-semibold"><?= $tech ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== CTA FINAL ========== -->
<section class="py-24 bg-gradient-to-br from-slate-900 via-slate-900 to-slate-800 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-purple-600/20 to-pink-600/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center scroll-reveal">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-300 text-sm font-medium mb-8">
            <i data-lucide="sparkles" class="w-4 h-4"></i>
            <?= t('cta_badge', 'realisaciones') ?>
        </div>
        
        <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
            <?= t('cta_title', 'realisaciones') ?>
        </h2>
        
        <p class="text-xl text-slate-400 mb-10 max-w-2xl mx-auto">
            <?= t('cta_subtitle', 'realisaciones') ?>
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/573204181193?text=Hola%2C%20vi%20sus%20realizaciones%20y%20quiero%20crear%20mi%20sitio%20web" 
               target="_blank"
               class="group px-10 py-5 bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 text-white rounded-full font-bold text-xl hover:shadow-2xl hover:shadow-purple-500/30 transition-all hover:scale-105 flex items-center justify-center gap-3">
                <i data-lucide="message-circle" class="w-6 h-6"></i>
                <?= t('cta_button', 'realisaciones') ?>
                <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        
        <p class="text-slate-500 mt-8 text-sm">
            <?= t('cta_note', 'realisaciones') ?>
        </p>
    </div>
</section>

<script>
    // Scroll reveal amélioré
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        
        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
    });
</script>
