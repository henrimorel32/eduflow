<header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-blue-900 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                        ISJ
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-blue-900">Instituto Monte de los Colores</h1>
                        <p class="text-sm text-gray-600"><?= t('subtitulo_escuela', 'inscripcion') ?></p>
                    </div>
                </div>
                
                <!-- Selector de idioma -->
                <div class="relative">
                    <select onchange="window.location.href='?lang=' + this.value" 
                            class="appearance-none bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php foreach ($idiomas as $codigo => $info): ?>
                            <option value="<?= $codigo ?>" <?= $idioma_actual === $codigo ? 'selected' : '' ?>>
                                <?= $info['bandera'] ?> <?= $info['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </header>