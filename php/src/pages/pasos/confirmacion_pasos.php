<div class="min-h-[70vh] flex flex-col items-center justify-center fade-in">
                <!-- Carte principale avec effet glassmorphism -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-8 md:p-12 max-w-4xl w-full border border-white/20">
                    
                    <!-- Icône de succès animée -->
                    <div class="flex justify-center mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg animate-bounce">
                            <i class="fas fa-check text-white text-4xl"></i>
                        </div>
                    </div>

                   <!-- Titre multilingue stylisé -->
                    <div class="text-center mb-10">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                            <?= t('gracias_inscripcion', 'inscripcion') ?: '¡Gracias por tu inscripción!' ?>
                        </h2>
                        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-green-500 mx-auto rounded-full"></div>
                    </div>

                   <!-- Message dans la langue actuelle -->
                    <div class="bg-blue-50 rounded-2xl p-6 mb-8 border-l-4 border-blue-500">
                        <p class="text-lg text-blue-900 text-center font-medium">
                            <?= t('mensaje_exito_demo', 'inscripcion') ?>
                        </p>
                    </div>

                    <!-- SECTION MULTILINGUE ÉLÉGANTE -->
                    <div class="mb-8">
                        <p class="text-center text-gray-500 text-sm uppercase tracking-widest mb-6">
                            <?= t('disponible_idiomas', 'inscripcion') ?>
                        </p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Español -->
                            <a href="?lang=es" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-400 via-red-500 to-blue-600 p-0.5 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="bg-white rounded-2xl p-4 h-full flex flex-col items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-red-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <span class="text-4xl mb-2 relative z-10">🇨🇴</span>
                                    <span class="font-bold text-gray-800 relative z-10">Español</span>
                                    <span class="text-xs text-gray-500 mt-1 relative z-10">Gracias por tu inscripción</span>
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-400 to-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform"></div>
                                </div>
                            </a>

                            <!-- Português -->
                            <a href="?lang=br" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-400 via-yellow-400 to-blue-600 p-0.5 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="bg-white rounded-2xl p-4 h-full flex flex-col items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-yellow-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <span class="text-4xl mb-2 relative z-10">🇧🇷</span>
                                    <span class="font-bold text-gray-800 relative z-10">Português</span>
                                    <span class="text-xs text-gray-500 mt-1 relative z-10">Obrigado pela inscrição</span>
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-400 to-yellow-400 transform scale-x-0 group-hover:scale-x-100 transition-transform"></div>
                                </div>
                            </a>

                            <!-- English -->
                            <a href="?lang=en" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-500 via-white to-blue-600 p-0.5 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="bg-white rounded-2xl p-4 h-full flex flex-col items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-br from-red-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <span class="text-4xl mb-2 relative z-10">🇺🇸</span>
                                    <span class="font-bold text-gray-800 relative z-10">English</span>
                                    <span class="text-xs text-gray-500 mt-1 relative z-10">Thank you for enrolling</span>
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform"></div>
                                </div>
                            </a>

                            <!-- Français -->
                            <a href="?lang=fr" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-white to-red-500 p-0.5 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="bg-white rounded-2xl p-4 h-full flex flex-col items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-red-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <span class="text-4xl mb-2 relative z-10">🇫🇷</span>
                                    <span class="font-bold text-gray-800 relative z-10">Français</span>
                                    <span class="text-xs text-gray-500 mt-1 relative z-10">Merci pour votre inscription</span>
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Info démo -->
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-8">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-amber-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm text-amber-800 font-medium"><?= t('nota_simulacion', 'inscripcion') ?></p>
                                <p class="text-xs text-amber-600 mt-1"><?= t('demo_explicacion_detallada', 'inscripcion') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="?lang=<?= $idioma_actual ?>" 
                           class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold hover:shadow-lg hover:from-blue-700 hover:to-blue-800 transition-all">
                            <i class="fas fa-redo mr-2"></i>
                            <?= t('nueva_inscripcion', 'inscripcion') ?>
                        </a>
                        <a href="/" 
                           class="inline-flex items-center justify-center px-8 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all">
                            <i class="fas fa-home mr-2"></i>
                            <?= t('volver_inicio', 'inscripcion') ?>
                        </a>
                    </div>
                </div>

                <!-- Badge flottant DEMO -->
                <div class="mt-8 inline-flex items-center gap-2 px-4 py-2 bg-black/80 text-white rounded-full text-sm backdrop-blur-sm">
                    <i class="fas fa-flask"></i>
                    <span><?= t('sistema_demo', 'inscripcion') ?></span>
                </div>
            </div>

            