<div id="paso-3" class="hidden-step">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm mr-3">3</span>
                        <?= t('titulo_alumno', 'inscripcion') ?>
                    </h2>

                    <div class="grid md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('nombres', 'inscripcion') ?> *</label>
                            <input type="text" name="alumno_nombres" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('apellido1', 'inscripcion') ?> *</label>
                            <input type="text" name="alumno_apellido1" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('apellido2', 'inscripcion') ?></label>
                            <input type="text" name="alumno_apellido2" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('fecha_nacimiento', 'inscripcion') ?> *</label>
                            <input type="date" name="alumno_fecha_nacimiento" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?= t('nacionalidad', 'inscripcion') ?> *</label>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label class="text-xs text-gray-500 mb-1 block"><?= t('nacionalidad_principal', 'inscripcion') ?></label>
                                <select name="alumno_nacionalidad" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                                    <?php foreach ($nacionalidades[$idioma_actual] as $nacionalidad): ?>
                                        <option value="<?= $nacionalidad ?>"><?= $nacionalidad ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1 block"><?= t('nacionalidad_secundaria', 'inscripcion') ?> (<?= t('opcional', 'inscripcion') ?>)</label>
                                <select name="alumno_nacionalidad_2" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                                    <?php foreach ($nacionalidades[$idioma_actual] as $nacionalidad): ?>
                                        <option value="<?= $nacionalidad ?>"><?= $nacionalidad ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 mb-1 block"><?= t('nacionalidad_tercera', 'inscripcion') ?> (<?= t('opcional', 'inscripcion') ?>)</label>
                                <select name="alumno_nacionalidad_3" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                                    <?php foreach ($nacionalidades[$idioma_actual] as $nacionalidad): ?>
                                        <option value="<?= $nacionalidad ?>"><?= $nacionalidad ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('grado_inscripcion', 'inscripcion') ?> *</label>
                        <select name="alumno_grado" required 
                                class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value=""><?= t('seleccione_grado', 'inscripcion') ?></option>
                            <?php foreach ($grados[$idioma_actual] as $index => $grado): ?>
                                <option value="<?= $grado ?>"><?= $grado ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <h3 class="text-lg font-bold text-gray-800 mb-4"><?= t('titulo_anterior_escuela', 'inscripcion') ?></h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('nombre_institucion', 'inscripcion') ?></label>
                        <input type="text" name="anterior_institucion" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('ciudad', 'inscripcion') ?></label>
                            <input type="text" name="anterior_ciudad" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('pais', 'inscripcion') ?></label>
                            <select name="anterior_pais" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value=""><?= t('seleccione', 'inscripcion') ?></option>
                                <?php foreach ($paises_america as $codigo => $nombres): ?>
                                    <option value="<?= $codigo ?>"><?= $nombres[$idioma_actual] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?= t('observaciones', 'inscripcion') ?></label>
                        <textarea name="observaciones" rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="<?= t('placeholder_observaciones', 'inscripcion') ?>"></textarea>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" onclick="anteriorPaso(2)" 
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <?= t('anterior', 'inscripcion') ?>
                        </button>
                        <button type="button" onclick="validarPaso3()" 
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                            <?= t('siguiente', 'inscripcion') ?>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <script>
function validarPaso3() {
    const container = document.getElementById('paso-3');
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

    // UX : focus + scroll vers première erreur
    if (!valido && primerError) {
        primerError.focus();
        primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        primerError.reportValidity();
        return;
    }

    // ✅ tout est OK → étape suivante
    siguientePaso(4);
}
</script>