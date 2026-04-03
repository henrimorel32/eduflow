<div id="paso-1" class="fade-in">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm mr-3">1</span>
                        <?= t('titulo_acudiente1', 'inscripcion') ?>
                        <span class="ml-2 text-sm font-normal text-gray-500">(<?= t('principal', 'inscripcion') ?>)</span>
                    </h2>
                    
                    <div class="grid md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('nombres', 'inscripcion') ?> *</label>
                            <input type="text" name="acudiente1_nombres" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('apellido1', 'inscripcion') ?> *</label>
                            <input type="text" name="acudiente1_apellido1" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('apellido2', 'inscripcion') ?></label>
                            <input type="text" name="acudiente1_apellido2" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('direccion', 'inscripcion') ?> *</label>
                        <input type="text" name="acudiente1_direccion" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('ciudad', 'inscripcion') ?> *</label>
                            <input type="text" name="acudiente1_ciudad" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('pais', 'inscripcion') ?> *</label>
                            <select name="acudiente1_pais" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                                <?php foreach ($paises_america as $codigo => $nombres): ?>
                                    <option value="<?= $codigo ?>" <?= $codigo === 'CO' ? 'selected' : '' ?>>
                                        <?= $nombres[$idioma_actual] ?> (<?= $codigo ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('profesion', 'inscripcion') ?></label>
                            <input type="text" name="acudiente1_profesion" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('empresa', 'inscripcion') ?></label>
                            <input type="text" name="acudiente1_empresa" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('prefijo', 'inscripcion') ?> *</label>
                            <select name="acudiente1_prefijo" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <?php foreach ($prefijos_telefonicos as $prefijo => $info): ?>
                                    <option value="<?= $prefijo ?>" <?= $info['pais'] === 'CO' ? 'selected' : '' ?>>
                                        <?= $prefijo ?> (<?= $info['nombre'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('telefono', 'inscripcion') ?> *</label>
                            <input type="tel" name="acudiente1_telefono" required 
                                   pattern="[0-9]+" 
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                   placeholder="3001234567"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1"><?= t('solo_numeros', 'inscripcion') ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('email', 'inscripcion') ?> *</label>
                            <input 
                                type="email" 
                                name="acudiente1_email" 
                                required
                                oninput="validarEmail(this)"
                                class="w-full px-4 py-2 border rounded-lg"
                            >

                            <script>
                            function validarEmail(input) {
                                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                                if (!regex.test(input.value)) {
                                    input.classList.add('border-red-500');
                                } else {
                                    input.classList.remove('border-red-500');
                                }
                            }
                            </script>
                        </div>
                        
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('parentesco', 'inscripcion') ?> *</label>
                        <select name="acudiente1_parentesco" required 
                                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Padre"><?= t('padre', 'inscripcion') ?></option>
                            <option value="Madre" selected><?= t('madre', 'inscripcion') ?></option>
                            <option value="Tutor legal"><?= t('tutor_legal', 'inscripcion') ?></option>
                            <option value="Abuelo/a"><?= t('abuelo', 'inscripcion') ?></option>
                            <option value="Tío/a"><?= t('tio', 'inscripcion') ?></option>
                            <option value="Otro"><?= t('otro', 'inscripcion') ?></option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="validarPaso1()"  
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                            <?= t('siguiente', 'inscripcion') ?>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
                <script>
                    function validarPaso1() {
                        const container = document.getElementById('paso-1');
                        const requiredFields = container.querySelectorAll('[required]');
                        
                        let valido = true;
                        let primerError = null;

                        requiredFields.forEach(field => {
                            // reset style
                            field.classList.remove('border-red-500');

                            // validation HTML native
                            if (!field.checkValidity()) {
                                field.classList.add('border-red-500');

                                if (!primerError) {
                                    primerError = field;
                                }

                                valido = false;
                            }
                        });

                        // 🔥 Validation spécifique email (plus stricte)
                        const emailInput = container.querySelector('[name="acudiente1_email"]');
                        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                        if (emailInput && !regex.test(emailInput.value)) {
                            emailInput.classList.add('border-red-500');
                            emailInput.setCustomValidity('Email no válido');

                            if (!primerError) {
                                primerError = emailInput;
                            }

                            valido = false;
                        } else if (emailInput) {
                            emailInput.setCustomValidity('');
                        }

                        // 💡 UX : focus + scroll vers première erreur
                        if (!valido && primerError) {
                            primerError.focus();
                            primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            primerError.reportValidity();
                            return;
                        }

                        // ✅ tout est OK → étape suivante
                        siguientePaso(2);
                    }
                </script>