<?php
declare(strict_types=1);
$errores = [];
$exito = false;
?>

<section class="pt-32 pb-24 bg-gradient-to-br from-primary-600 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-6"><?= t('contacto', 'nav') ?></h1>
        <p class="text-xl text-primary-100 max-w-2xl mx-auto">
            <?= t('hero_subtitle', 'contacto') ?>
        </p>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16">
            
            <!-- Info -->
            <div class="scroll-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-6"><?= t('hablemos', 'contacto') ?></h2>
                <p class="text-gray-600 mb-8 text-lg">
                    <?= t('intro', 'contacto') ?>
                </p>
                
                <div class="space-y-6">
                    <?php if (isColombianMarket()): ?>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="phone" class="w-6 h-6 text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900"><?= t('telefono', 'contacto') ?></h3>
                            <p class="text-gray-600">+57 320 418 11 93</p>
                            <p class="text-sm text-gray-500"><?= t('horario', 'contacto') ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="mail" class="w-6 h-6 text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900"><?= t('email', 'contacto') ?></h3>
                            <p class="text-gray-600">henri@henrimorel.com</p>
                            <p class="text-sm text-gray-500"><?= t('respuesta_24h', 'contacto') ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="map-pin" class="w-6 h-6 text-primary-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900"><?= t('ubicacion', 'contacto') ?></h3>
                            <div class="space-y-1 mt-1">
                                <p class="text-gray-600 flex items-center gap-2">
                                    <span class="text-lg">🇨🇴</span> Pereira, Colombia
                                </p>
                                <p class="text-gray-600 flex items-center gap-2">
                                    <span class="text-lg">🇫🇷</span> Sainte-Gemme, 32120 France
                                </p>
                            </div>
                            <p class="text-sm text-gray-500 mt-2"><?= t('atencion_nacional', 'contacto') ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'ok'): ?>
    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl">
        ✅ <?= t('mensaje_exito', 'contacto') ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl">
        ❌ <?= t('mensaje_error', 'contacto') ?>
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
                        <label class="block text-gray-700 font-semibold mb-2"><?= t('label_nombre', 'contacto') ?> *</label>
                        <input type="text" name="nombre" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                               placeholder="<?= t('placeholder_nombre', 'contacto') ?>">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2"><?= t('label_email', 'contacto') ?> *</label>
                        <input type="email" name="email" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                               placeholder="<?= t('placeholder_email', 'contacto') ?>">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2"><?= t('label_colegio', 'contacto') ?></label>
                        <input type="text" name="colegio" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                               placeholder="<?= t('placeholder_colegio', 'contacto') ?>">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2"><?= t('label_mensaje', 'contacto') ?> *</label>
                        <textarea name="mensaje" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition"
                                  placeholder="<?= t('placeholder_mensaje', 'contacto') ?>"></textarea>
                    </div>
                    
                    <div class="cf-turnstile"
                         data-sitekey="0x4AAAAAAC1v_HDi1v6nPJoO"
                         data-callback="onTurnstileSuccess"
                         data-theme="light"></div>
                    <input type="hidden" name="cf-turnstile-response" id="cf-turnstile-response">

                    <button type="submit" name="enviar_contacto"
                            class="w-full py-4 bg-primary-600 text-white rounded-xl font-bold text-lg hover:bg-primary-700 transition shadow-lg hover:shadow-xl">
                        <?= t('enviar_mensaje', 'contacto') ?>
                        <i data-lucide="send" class="inline-block w-5 h-5 ml-2"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<script>
function onTurnstileSuccess(token) {
    const input = document.getElementById('cf-turnstile-response');
    if (input) input.value = token;
}

document.getElementById('form-contacto').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const button = form.querySelector('button[type="submit"]') || form.querySelector('button');
    
    // 💾 Sauvegarde le texte original et ajoute le spinner
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = `<span class="spinner-btn"></span> <?= t('enviando', 'contacto') ?>`;

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
            mostrarMensaje("✅ <?= t('mensaje_exito_corto', 'contacto') ?>", "success");
            form.reset();
        } 
        // 🔴 ERROR
        else {
            mostrarMensaje("❌ " + data.errores.join('<br>'), "error");
        }

    } catch (error) {
        mostrarMensaje("❌ <?= t('error_conexion', 'contacto') ?>", "error");
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