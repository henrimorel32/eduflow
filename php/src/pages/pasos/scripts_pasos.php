
    <script>
        let pasoActual = 1;
        const totalPasos = 4;

        function actualizarIndicadores() {
            for (let i = 1; i <= totalPasos; i++) {
                const indicador = document.getElementById(`step-indicator-${i}`);
                const barra = document.getElementById(`progress-${i}`);
                
                if (i < pasoActual) {
                    indicador.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold step-completed transition-all duration-300';
                    indicador.innerHTML = '<i class="fas fa-check"></i>';
                    if (barra) barra.style.width = '100%';
                } else if (i === pasoActual) {
                    indicador.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold step-active transition-all duration-300';
                    indicador.innerHTML = i;
                    if (barra) barra.style.width = '0%';
                } else {
                    indicador.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold step-pending transition-all duration-300';
                    indicador.innerHTML = i;
                    if (barra) barra.style.width = '0%';
                }
            }
        }

        function siguientePaso(paso) {
            // Validación básica del paso actual
            const pasoActualDiv = document.getElementById(`paso-${pasoActual}`);
            const camposRequeridos = pasoActualDiv.querySelectorAll('[required]');
            let valido = true;
            
            camposRequeridos.forEach(campo => {
                if (!campo.value.trim()) {
                    valido = false;
                    campo.classList.add('border-red-500');
                    campo.addEventListener('input', function() {
                        this.classList.remove('border-red-500');
                    }, {once: true});
                }
            });

            if (!valido) {
                alert('<?= t('completar_campos', 'inscripcion') ?>');
                return;
            }

            document.getElementById(`paso-${pasoActual}`).classList.add('hidden-step');
            document.getElementById(`paso-${paso}`).classList.remove('hidden-step');
            document.getElementById(`paso-${paso}`).classList.add('fade-in');
            
            pasoActual = paso;
            actualizarIndicadores();
            window.scrollTo(0, 0);
        }

        function anteriorPaso(paso) {
            document.getElementById(`paso-${pasoActual}`).classList.add('hidden-step');
            document.getElementById(`paso-${paso}`).classList.remove('hidden-step');
            document.getElementById(`paso-${paso}`).classList.add('fade-in');
            
            pasoActual = paso;
            actualizarIndicadores();
            window.scrollTo(0, 0);
        }

        // Inicializar
        actualizarIndicadores();
    </script>