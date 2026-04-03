<div class="mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex items-center">
                        <div id="step-indicator-1" class="w-10 h-10 rounded-full flex items-center justify-center font-bold step-active transition-all duration-300">1</div>
                        <div class="flex-1 h-1 bg-gray-300 mx-2"><div id="progress-1" class="h-full bg-blue-600 transition-all duration-500" style="width: 0%"></div></div>
                    </div>
                    <div class="flex-1 flex items-center">
                        <div id="step-indicator-2" class="w-10 h-10 rounded-full flex items-center justify-center font-bold step-pending transition-all duration-300">2</div>
                        <div class="flex-1 h-1 bg-gray-300 mx-2"><div id="progress-2" class="h-full bg-blue-600 transition-all duration-500" style="width: 0%"></div></div>
                    </div>
                    <div class="flex-1 flex items-center">
                        <div id="step-indicator-3" class="w-10 h-10 rounded-full flex items-center justify-center font-bold step-pending transition-all duration-300">3</div>
                        <div class="flex-1 h-1 bg-gray-300 mx-2"><div id="progress-3" class="h-full bg-blue-600 transition-all duration-500" style="width: 0%"></div></div>
                    </div>
                    <div class="flex-1 flex items-center">
                        <div id="step-indicator-4" class="w-10 h-10 rounded-full flex items-center justify-center font-bold step-pending transition-all duration-300">4</div>
                    </div>
                </div>
                <div class="flex justify-between mt-2 text-sm text-gray-600">
                    <span class="text-center flex-1"><?= t('paso_acudiente1', 'inscripcion') ?></span>
                    <span class="text-center flex-1"><?= t('paso_acudiente2', 'inscripcion') ?></span>
                    <span class="text-center flex-1"><?= t('paso_alumno', 'inscripcion') ?></span>
                    <span class="text-center flex-1"><?= t('paso_documentos', 'inscripcion') ?></span>
                </div>
            </div>