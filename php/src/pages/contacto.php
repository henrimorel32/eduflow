<?php
declare(strict_types=1);
$errores = [];
$exito = false;
?>

<section class="pt-32 pb-24 bg-gradient-to-br from-primary-600 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-6">Contacto</h1>
        <p class="text-xl text-primary-100 max-w-2xl mx-auto">
            Estamos aquí para ayudarte a transformar tu colegio
        </p>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16">
            
            <!-- Info -->
            <div class="scroll-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Hablemos</h2>
                <p class="text-gray-600 mb-8 text-lg">
                    Ya sea que tengas preguntas sobre nuestras soluciones o quieras agendar una demostración, nuestro equipo está listo para ayudarte.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="phone" class="w-6 h-6 text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Teléfono</h3>
                            <p class="text-gray-600">+57 320 418 11 93</p>
                            <p class="text-sm text-gray-500">Lun-Vie: 8am - 6pm</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="mail" class="w-6 h-6 text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Email</h3>
                            <p class="text-gray-600">penelope@henrimorel.com</p>
                            <p class="text-sm text-gray-500">Respondemos en 24h</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="map-pin" class="w-6 h-6 text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Ubicación</h3>
                            <p class="text-gray-600">Pereira, Colombia</p>
                            <p class="text-sm text-gray-500">Atención nacional</p>
                        </div>
                    </div>
                </div>
            </div>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'ok'): ?>
    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl">
        ✅ Mensaje enviado correctamente. Te responderemos pronto.
    </div>
<?php endif; ?>

<?php if (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl">
        ❌ Error al enviar el mensaje.
    </div>
<?php endif; ?>

            <?php if (!empty($errores)): ?>
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl">
                    <?php foreach ($errores as $e): ?>
                        <div>• <?= $e ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!-- Form -->
            <div class="bg-gray-50 rounded-3xl p-8 scroll-reveal">
                <form id="form-contacto" method="POST" class="space-y-6">
                    <input type="hidden" name="form_type" value="contacto">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nombre completo *</label>
                        <input type="text" name="nombre" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                               placeholder="Tu nombre">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Correo electrónico *</label>
                        <input type="email" name="email" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                               placeholder="tu@email.com">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nombre del colegio</label>
                        <input type="text" name="colegio" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                               placeholder="Institución Educativa...">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Mensaje *</label>
                        <textarea name="mensaje" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                                  placeholder="¿En qué podemos ayudarte?"></textarea>
                    </div>
                    
                    <button type="submit" name="enviar_contacto" 
                            class="w-full py-4 bg-primary-600 text-white rounded-xl font-bold text-lg hover:bg-primary-700 transition shadow-lg hover:shadow-xl"
                            button.innerText = "Enviando...";>
                        Enviar Mensaje
                        <i data-lucide="send" class="inline-block w-5 h-5 ml-2"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<script>
document.getElementById('form-contacto').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const button = form.querySelector('button[type="submit"]') || form.querySelector('button');
    
    // 💾 Sauvegarde le texte original et ajoute le spinner
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = `<span class="spinner-btn"></span> Enviando...`;

    try {
        const response = await fetch('procesar_contacto', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        const data = await response.json();
        
        // 🟢 SUCCESS
        if (data.exito) {
            mostrarMensaje("✅ Mensaje enviado correctamente", "success");
            form.reset();
        } 
        // 🔴 ERROR
        else {
            mostrarMensaje("❌ " + data.errores.join('<br>'), "error");
        }

    } catch (error) {
        mostrarMensaje("❌ Error de conexión", "error");
    } finally {
        // 🔄 Restore le bouton dans tous les cas
        button.disabled = false;
        button.innerHTML = originalText;
    }
});

function mostrarMensaje(msg, tipo) {
    let container = document.getElementById('mensaje-form');

    if (!container) {
        container = document.createElement('div');
        container.id = 'mensaje-form';
        container.className = 'mb-6 p-4 rounded-xl';
        document.getElementById('form-contacto').prepend(container);
    }

    container.innerHTML = msg;

    if (tipo === 'success') {
        container.className = 'mb-6 p-4 bg-green-100 text-green-700 rounded-xl';
    } else {
        container.className = 'mb-6 p-4 bg-red-100 text-red-700 rounded-xl';
    }
}
</script>