<?php
session_start();
ob_clean();
header('Content-Type: application/json');
// 🔌 Chargement du service mail
require_once __DIR__ . '/../components/Mailer.php';

$isColombianMarket = ($_SESSION['lang'] ?? 'es') === 'es';

// 🧠 Variables de contrôle
$errores = [];
$exito = false;

// 📩 Vérifie qu’on est bien sur un POST du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    // --------------------------------------------------
    // 🧹 1. Récupération + nettoyage des données
    // --------------------------------------------------
    $nombre  = trim($_POST['nombre'] ?? '');
    $email   = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $colegio = trim($_POST['colegio'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');
    $escuela  = trim($_POST['escuela'] ?? '');
    $ubicacion = trim($_POST['ubicacion'] ?? '');
    $sistemas = trim($_POST['sistemas'] ?? '');
    $problema = trim($_POST['problema'] ?? '');

    // --------------------------------------------------
    // ✅ 2. Validation des champs
    // --------------------------------------------------
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Email inválido";
    }
    if (empty($mensaje) && !empty($sistemas)) {
        $mensaje = $sistemas;
    }
    if (empty($mensaje)) {
        $errores[] = "El mensaje es obligatorio";
    }

    // --------------------------------------------------
    // 🛡️ 3. Vérification Turnstile (Cloudflare)
    // --------------------------------------------------
    $turnstileToken = $_POST['cf-turnstile-response'] ?? '';
    
    if (empty($turnstileToken)) {
        $errores[] = "Verificación de seguridad requerida";
    } else {
        // Vérification avec l'API Cloudflare
        $turnstileSecret = '0x4AAAAAAC1v_DA1UDl-TkqtWNOgE6ltsp0';
        $verifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
        
        $ch = curl_init($verifyUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret' => $turnstileSecret,
            'response' => $turnstileToken,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200 && $response) {
            $result = json_decode($response, true);
            if (!$result || $result['success'] !== true) {
                $errores[] = "Verificación de seguridad fallida. Por favor intenta de nuevo.";
                error_log('Turnstile verification failed: ' . json_encode($result));
            }
        } else {
            $errores[] = "Error en verificación de seguridad. Por favor intenta de nuevo.";
            error_log('Turnstile API error: HTTP ' . $httpCode);
        }
    }

    // --------------------------------------------------
    // 🚀 4. Envoi des emails si tout est OK
    // --------------------------------------------------
    if (empty($errores)) {

        // ==============================
        // 📧 Email interne (pour toi)
        // ==============================
        $subject_admin = "📩 Nuevo contacto desde la web";

        $body_admin = "
        <div style='font-family: Arial, sans-serif; padding:20px;'>
            <h2>Nuevo mensaje recibido</h2>
            <hr>

            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Colegio:</strong> " . ($colegio ?: 'No especificado') . "</p>

            <h3>Mensaje:</h3>
            <p style='background:#f5f5f5; padding:10px; border-radius:5px;'>
                " . nl2br(htmlspecialchars($mensaje)) . "
            </p>
        </div>
        <p><strong>Escuela:</strong> {$escuela}</p>
        <p><strong>Ubicación:</strong> {$ubicacion}</p>
        <p><strong>Sistemas actuales:</strong><br>{$sistemas}</p>
        <p><strong>Problema principal:</strong> {$problema}</p>
        ";

        $result_admin = Mailer::envoyer([
            'to' => 'henri@henrimorel.com',
            'subject' => $subject_admin,
            'body' => $body_admin
        ]);

        // ==============================
        // 📧 Email utilisateur (confirmation)
        // ==============================
        $subject_user = "✨ Hemos recibido tu mensaje";

        $body_user = "
        <div style='font-family: Arial, sans-serif; background:#f5f7fa; padding:20px;'>
            
            <div style='max-width:600px; margin:auto; background:white; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);'>
                
                <!-- Header -->
                <div style='background: linear-gradient(135deg,#4f46e5,#06b6d4); color:white; padding:25px; text-align:center;'>
                    <h2 style='margin:0;'>¡Mensaje recibido! 🚀</h2>
                    <p style='margin:5px 0 0;'>Equipo de Inscripciones Digitales</p>
                </div>

                <!-- Content -->
                <div style='padding:25px; color:#333;'>

                    <p style='font-size:16px;'>Hola <strong>{$nombre}</strong>,</p>

                    <p>
                        Gracias por contactarnos 🙌<br>
                        Hemos recibido tu mensaje correctamente y nuestro equipo ya está revisándolo.
                    </p>

                    <div style='margin:20px 0; padding:15px; background:#f9fafb; border-radius:8px;'>
                        <p style='margin:0; font-size:14px; color:#555;'>
                            ⏱️ Tiempo de respuesta estimado: <strong>menos de 24 horas</strong>
                        </p>
                    </div>

                    <p>
                        Te ayudaremos a digitalizar el proceso de inscripción y mejorar la gestión de tu escuela.
                    </p>

                    <hr style='margin:25px 0;'>

                    <?php if ($isColombianMarket): ?>
                    <!-- CTA -->
                    <div style='text-align:center; margin:25px 0;'>
                        <a href='https://wa.me/573204181193' 
                           style='background:#25D366; color:white; padding:12px 20px; border-radius:8px; text-decoration:none; font-weight:bold; display:inline-block;'>
                            💬 Hablar por WhatsApp
                        </a>
                    </div>
                    <?php endif; ?>

                    <p style='font-size:13px; color:#888; text-align:center;'>
                        También puedes responder directamente a este correo.
                    </p>

                </div>

            </div>

        </div>
        ";

        $result_user = Mailer::envoyer([
            'to' => $email,
            'subject' => $subject_user,
            'body' => $body_user
        ]);

        // --------------------------------------------------
        // 🎯 5. Gestion du résultat global
        // --------------------------------------------------
        if ($result_admin === true && $result_user === true) {
            $exito = true;
        } else {
            $errores[] = "Error al enviar el mensaje";
        }
    }
}

// --------------------------------------------------
// 📤 6. Retour JSON (si appel AJAX) OU variable PHP
// --------------------------------------------------

// 👉 Si tu veux l’utiliser en AJAX
ob_end_clean();
echo json_encode([
    'exito' => $exito,
    'errores' => $errores
]);
exit;

// 👉 Sinon $exito reste dispo pour ta vue PHP
?>