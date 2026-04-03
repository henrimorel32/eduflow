<?php
//require(__DIR__ . '/../includes/init_demo.php');
?>

<?php require(__DIR__ . '/pasos/init_pasos.php');
require_once __DIR__ . '/../components/Mailer.php'; ?>

<?php
// Démarrer session si pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Reset demo - VERSION QUI MARCHE
$reset_done = false;
if (isset($_GET['reset_demo']) && isset($_SESSION['demo_email'])) {
    unset($_SESSION['demo_email']);
    $reset_done = true;
    // Pas de header() ! On laisse la page se recharger naturellement
}

// Détection mode demo
$demo_mode = false;

// Email soumis via POST (première visite)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['demo_email']) && !isset($_POST['acudiente1'])) {
    $email = filter_var($_POST['demo_email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['demo_email'] = $email;
        $demo_mode = true;
        // Pas de redirection - on affiche directement le formulaire
    }
}

// Email en session OU déjà dans formulaire
if (isset($_SESSION['demo_email']) || (isset($_POST['demo_email']) && isset($_POST['acudiente1']))) {
    $demo_mode = true;
}

// Traitement final
$mensaje_exito = false;
$errores = [];


// Détection mode demo (email en session OU email caché dans le formulaire)
$demo_mode = isset($_SESSION['demo_email']) || 
             (isset($_POST['demo_email']) && !empty($_POST['demo_email'])) ||
             (isset($_POST['email_confirmacion']) && !empty($_POST['email_confirmacion']));

$email_stored = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['demo_email']) && !isset($_POST['acudiente1'])) {
    $email = filter_var($_POST['demo_email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['demo_email'] = $email;
        $demo_mode = true;
        $email_stored = true; // Flag pour cacher hero via JS
    }
}

$mensaje_exito = false;
$errores = [];

function enviarResumenDemo($email, $datos) {

    $subject = "✨ Tu resumen de demo - Sistema de Inscripciones";

    $a = $datos['acudiente1'];

    $body = "
    <div style='font-family: Arial, sans-serif; background:#f5f7fa; padding:20px;'>
        
        <div style='max-width:600px; margin:auto; background:white; border-radius:10px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.05);'>
            
            <!-- Header -->
            <div style='background: linear-gradient(135deg,#4f46e5,#06b6d4); color:white; padding:25px; text-align:center;'>
                <h2 style='margin:0;'>¡Gracias por probar la demo! 🚀</h2>
                <p style='margin:5px 0 0;'>Sistema de inscripciones escolares</p>
            </div>

            <!-- Content -->
            <div style='padding:25px; color:#333;'>

                <p>Hola,</p>

                <p>
                    Aquí tienes un resumen de los datos que ingresaste en la demo.
                </p>

                <!-- Bloc info -->
                <div style='margin-top:20px; padding:15px; background:#f9fafb; border-radius:8px;'>
                    <h3 style='margin-top:0;'>👤 Acudiente principal</h3>

                    <p><strong>Nombre:</strong> {$a['nombres']} {$a['apellido1']} {$a['apellido2']}</p>
                    <p><strong>Email:</strong> {$a['email']}</p>
                    <p><strong>Teléfono:</strong> {$a['prefijo']} {$a['telefono']}</p>
                    <p><strong>Dirección:</strong> {$a['direccion']}</p>
                    <p><strong>Ciudad:</strong> {$a['ciudad']} ({$a['pais']})</p>
                    <p><strong>Parentesco:</strong> {$a['parentesco']}</p>
                    <p><strong>Profesión:</strong> {$a['profesion']}</p>
                    <p><strong>Empresa:</strong> {$a['empresa']}</p>
                </div>

                <!-- Info demo -->
                <div style='margin-top:25px; padding:15px; background:#fff3cd; border-radius:8px; color:#856404;'>
                    <strong>⚠️ Nota:</strong><br>
                    Esta es una versión de demostración.  
                    Algunos campos y funcionalidades han sido simplificados.
                </div>

                <!-- Explication produit -->
                <div style='margin-top:20px; font-size:14px; color:#555;'>
                    <p>
                        ✔️ Los formularios son totalmente configurables  
                        ✔️ Puedes añadir o eliminar pasos según tu proceso  
                        ✔️ Adaptado a cada institución educativa
                    </p>
                </div>

                <hr style='margin:25px 0;'>

                <p style='font-size:13px; color:#888;'>
                    Si quieres una versión adaptada a tu colegio, responde a este correo 😉
                </p>

            </div>

        </div>

    </div>
    ";

    $result = Mailer::envoyer([
        'to' => $email,
        'subject' => $subject,
        'body' => $body
    ]);

    if ($result !== true) {
        echo "ERROR: " . $result;
    }
}

// Traitement soumission finale
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar'])) {
    
    $email_destino = filter_var($_POST['email_confirmacion'] ?? $_SESSION['demo_email'] ?? '', FILTER_VALIDATE_EMAIL);
    
    if ($email_destino) {
        // Collecte données
        $datos = [
    'acudiente1' => [
        'nombres' => $_POST['acudiente1_nombres'] ?? '',
        'apellido1' => $_POST['acudiente1_apellido1'] ?? '',
        'apellido2' => $_POST['acudiente1_apellido2'] ?? '',
        'direccion' => $_POST['acudiente1_direccion'] ?? '',
        'ciudad' => $_POST['acudiente1_ciudad'] ?? '',
        'pais' => $_POST['acudiente1_pais'] ?? '',
        'profesion' => $_POST['acudiente1_profesion'] ?? '',
        'empresa' => $_POST['acudiente1_empresa'] ?? '',
        'prefijo' => $_POST['acudiente1_prefijo'] ?? '',
        'telefono' => $_POST['acudiente1_telefono'] ?? '',
        'email' => $_POST['acudiente1_email'] ?? '',
        'parentesco' => $_POST['acudiente1_parentesco'] ?? '',
    ]
];
        
        // Envoi email
        enviarResumenDemo($email_destino, $datos);
        
        $mensaje_exito = true;
    } else {
        $errores[] = "Email de confirmación inválido";
    }
}
?>
<!-- envoi de email -->

<!DOCTYPE html>
<html lang="<?= $idioma_actual ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Digitaliza el proceso de inscripción de tu escuela en línea. Automatiza formularios, gestiona estudiantes y simplifica la matrícula con una solución rápida y flexible.">

    <meta name="keywords" content="
    escuela,
    inscripción en línea,
    proceso de inscripción,
    formulario escolar,
    matrícula digital,
    gestión escolar,
    digitalización educativa,
    software para escuelas,
    inscripciones colegio,
    automatización escolar,
    formulario inscripción alumnos,
    sistema de matrícula,
    registro de estudiantes,
    plataforma educativa,
    gestión de alumnos,
    inscripción online colegio
    ">

    <meta name="author" content="Instituto Monte de los Colores">

    <!-- Open Graph (réseaux sociaux) -->
    <meta property="og:title" content="Digitaliza las inscripciones de tu escuela en línea">
    <meta property="og:description" content="Simplifica el proceso de inscripción de tu colegio con formularios digitales personalizables y gestión automatizada.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://henrimorel.com/inscripcion">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Inscripciones escolares en línea">
    <meta name="twitter:description" content="Automatiza el proceso de inscripción y matrícula en tu escuela.">
    
    <title><?= t('titulo_pagina', 'inscripcion') ?> | Instituto Monte de los Colores</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .step-active { background-color: #2563eb; color: white; }
        .step-completed { background-color: #10b981; color: white; }
        .step-pending { background-color: #e5e7eb; color: #6b7280; }
        .fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .hidden-step { display: none; }
       <?php require(__DIR__ . '/pasos/estilos_pasos.php'); ?>
    </style>
    <link rel="canonical" href="https://henrimorel.com/inscripcion">
</head>
<body class="bg-gray-50 min-h-screen">
    <?php include __DIR__ . '/pasos/selector_idioma.php'; ?>

    <?php if (!$demo_mode && !$mensaje_exito): ?>
        <!-- LANDING : Hero -->
        <?php include __DIR__ . '/pasos/hero.php'; ?>
        
    <?php elseif ($mensaje_exito): ?>
        
        <!-- CONFIRMATION -->
        <main class="max-w-4xl mx-auto px-4 py-8">
            <?php include __DIR__ . '/pasos/confirmacion_pasos.php'; ?>
        </main>
        
    <?php else: ?>
        <!-- FORMULAIRE -->
        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-lg mb-6">
                <p class="text-indigo-700">
                    <i class="fas fa-flask mr-2"></i>
                    <strong>Modo Demo activo</strong> - 
                    Email: <?= htmlspecialchars($_SESSION['demo_email']) ?> 
                    <a href="?reset_demo=1" class="underline ml-2">Cambiar email</a>
                </p>
            </div>

            <form method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-lg p-8">
                <input type="hidden" name="demo_email" value="<?= htmlspecialchars($_SESSION['demo_email']) ?>">
                
                <?php include __DIR__ . '/pasos/indicadores_pasos.php'; ?>
                <?php include __DIR__ . '/pasos/paso_acudiente1.php'; ?>
                <?php include __DIR__ . '/pasos/paso_acudiente2.php'; ?>
                <?php include __DIR__ . '/pasos/paso_datos_alumnos.php'; ?>
                <?php include __DIR__ . '/pasos/paso_documentos.php'; ?>
            </form>
        </main>
    <?php endif; ?>
</body>
    <!-- Footer explicatif -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <div class="mb-4">
                <span class="px-3 py-1 bg-yellow-500 text-gray-900 rounded-full text-xs font-bold uppercase tracking-wide">
                    <?= t('demo_sistema', 'inscripcion') ?>
                </span>
            </div>
            <p class="text-gray-400 text-sm">
                <?= t('footer_explicacion', 'inscripcion') ?>
            </p>
            <p class="text-gray-500 text-xs mt-4">
                © 2026 Instituto Monte de los Colores - <?= t('sistema_demo', 'inscripcion') ?>
            </p>
        </div>
    </footer>
<?php include __DIR__ . '/pasos/scripts_pasos.php'; ?>
</body>
</html>

