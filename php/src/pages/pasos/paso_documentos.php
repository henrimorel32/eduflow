<div id="paso-4" class="hidden-step">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm mr-3">4</span>
                        <?= t('titulo_documentos', 'inscripcion') ?>
                    </h2>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            <?= t('info_documentos', 'inscripcion') ?>
                        </p>
                    </div>

                    <div class="space-y-6 mb-8">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-blue-500 transition">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('boletin_1', 'inscripcion') ?> *
                                <span class="text-xs text-gray-500 block mt-1"><?= t('formatos_aceptados', 'inscripcion') ?>: PDF, JPG, PNG (Max 5MB)</span>
                            </label>
                            <input type="file" name="boletin_1" accept=".pdf,.jpg,.jpeg,.png" required 
                                   class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-blue-500 transition">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('boletin_2', 'inscripcion') ?> *
                                <span class="text-xs text-gray-500 block mt-1"><?= t('formatos_aceptados', 'inscripcion') ?>: PDF, JPG, PNG (Max 5MB)</span>
                            </label>
                            <input type="file" name="boletin_2" accept=".pdf,.jpg,.jpeg,.png" required 
                                   class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-blue-500 transition">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('boletin_3', 'inscripcion') ?> *
                                <span class="text-xs text-gray-500 block mt-1"><?= t('formatos_aceptados', 'inscripcion') ?>: PDF, JPG, PNG (Max 5MB)</span>
                            </label>
                            <input type="file" name="boletin_3" accept=".pdf,.jpg,.jpeg,.png" required 
                                   class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-blue-500 transition bg-yellow-50">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
                                <?= t('carta_motivacion', 'inscripcion') ?> 
                                <span class="text-xs font-normal text-gray-500 block mt-1"><?= t('opcional_recomendado', 'inscripcion') ?></span>
                            </label>
                            <input type="file" name="carta_motivacion" accept=".pdf,.doc,.docx" 
                                   class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-100 file:text-yellow-700 hover:file:bg-yellow-200">
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" required class="mt-1 mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">
                                <?= t('terminos_condiciones', 'inscripcion') ?>
                                <a href="#" class="text-blue-600 hover:underline"><?= t('ver_terminos', 'inscripcion') ?></a>
                            </span>
                        </label>
                    </div>

                     <input 
                        type="email" 
                        name="email_confirmacion" 
                        id="email-confirmacion"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all"
                        value="<?= htmlspecialchars($_SESSION['demo_email'] ?? '') ?>"
                        required
                    >

                    <div class="flex justify-between">
                        <button type="button" onclick="anteriorPaso(3)" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <?= t('anterior', 'inscripcion') ?>
                        </button>
                        <button type="submit" name="finalizar" value="1" 
                                class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center font-bold shadow-lg">
                            <i class="fas fa-check-circle mr-2"></i>
                            <?= t('finalizar_inscripcion', 'inscripcion') ?>
                        </button>
                    </div>
                </div>