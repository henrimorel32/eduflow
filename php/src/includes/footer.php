    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary-600 to-secondary-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-white">H<span class="text-primary-400">M</span></span>
                    </div>
                    <p class="text-sm"><?= t('optimizacion', 'footer') ?></p>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4"><?= t('solutions', 'footer') ?></h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?= url('saberpro') ?>" class="hover:text-white transition text-orange-400 font-semibold"><?= t('preparacion_saberpro', 'footer') ?></a></li>
                        <li><a href="<?= url('soluciones') ?>" class="hover:text-white transition"><?= t('gestion_admisiones', 'footer') ?></a></li>
                        <li><a href="<?= url('soluciones') ?>" class="hover:text-white transition"><?= t('comunicacion_padres', 'footer') ?></a></li>
                        <li><a href="<?= url('soluciones') ?>" class="hover:text-white transition"><?= t('seguimiento_academico', 'footer') ?></a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4"><?= t('links', 'footer') ?></h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?= url('home') ?>" class="hover:text-white transition"><?= t('inicio', 'footer') ?></a></li>
                        <li><a href="<?= url('soluciones') ?>" class="hover:text-white transition"><?= t('soluciones', 'footer') ?></a></li>
                        <li><a href="<?= url('aplicaciones') ?>" class="hover:text-white transition"><?= t('nuestras_aplicaciones', 'footer') ?></a></li>
                        <li><a href="<?= url('saberpro') ?>" class="hover:text-white transition text-orange-400 font-semibold"><?= t('preparacion_saberpro_link', 'footer') ?></a></li>
                        <li><a href="<?= url('contacto') ?>" class="hover:text-white transition"><?= t('contact', 'footer') ?></a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-4"><?= t('contact', 'footer') ?></h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            henri@henrimorel.com
                        </li>
                        <?php if (isColombianMarket()): ?>
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            +57 320 418 11 93
                        </li>
                        <?php endif; ?>
                        <li class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            Pereira, Colombia
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">© <?= date('Y') ?> HM. <?= t('derechos', 'footer') ?></p>
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
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        document.getElementById('mobile-menu').classList.add('hidden');
                    }
                }
            });
        });
    </script>
</body>
</html>