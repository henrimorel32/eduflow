<div id="paso-2" class="hidden-step">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm mr-3">2</span>
                        <?= t('titulo_acudiente2', 'inscripcion') ?>
                        <span class="ml-2 text-sm font-normal text-gray-500">(<?= t('opcional', 'inscripcion') ?>)</span>
                    </h2>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                        <p class="text-sm text-yellow-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            <?= t('info_acudiente2', 'inscripcion') ?>
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('nombres', 'inscripcion') ?></label>
                            <input type="text" name="acudiente2_nombres" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('apellido1', 'inscripcion') ?></label>
                            <input type="text" name="acudiente2_apellido1" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('apellido2', 'inscripcion') ?></label>
                            <input type="text" name="acudiente2_apellido2" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('direccion', 'inscripcion') ?></label>
                        <input type="text" name="acudiente2_direccion" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('ciudad', 'inscripcion') ?></label>
                            <input type="text" name="acudiente2_ciudad" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('pais', 'inscripcion') ?></label>
                            <select name="acudiente2_pais" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                                <?php foreach ($paises_america as $codigo => $nombres): ?>
                                    <option value="<?= $codigo ?>">
                                        <?= $nombres[$idioma_actual] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('profesion', 'inscripcion') ?></label>
                            <input type="text" name="acudiente2_profesion" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('empresa', 'inscripcion') ?></label>
                            <input type="text" name="acudiente2_empresa" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('prefijo', 'inscripcion') ?></label>
                            <select name="acudiente2_prefijo" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                                <?php foreach ($prefijos_telefonicos as $prefijo => $info): ?>
                                    <option value="<?= $prefijo ?>">
                                        <?= $prefijo ?> (<?= $info['nombre'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('telefono', 'inscripcion') ?></label>
                            <input type="tel" name="acudiente2_telefono" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('email', 'inscripcion') ?></label>
                            <input type="email" name="acudiente2_email" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('parentesco', 'inscripcion') ?></label>
                        <select name="acudiente2_parentesco" 
                                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                            <option value="Padre"><?= t('padre', 'inscripcion') ?></option>
                            <option value="Madre"><?= t('madre', 'inscripcion') ?></option>
                            <option value="Tutor legal"><?= t('tutor_legal', 'inscripcion') ?></option>
                            <option value="Abuelo/a"><?= t('abuelo', 'inscripcion') ?></option>
                            <option value="Tío/a"><?= t('tio', 'inscripcion') ?></option>
                            <option value="Otro"><?= t('otro', 'inscripcion') ?></option>
                        </select>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" onclick="anteriorPaso(1)" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <?= t('anterior', 'inscripcion') ?>
                        </button>
                        <button type="button" onclick="siguientePaso(3)" 
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                            <?= t('siguiente', 'inscripcion') ?>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>