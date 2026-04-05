<?php
/**
 * Page de souscription pour les écoles
 * Formulaire pour créer une page d'inscription personnalisée
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../components/Mailer.php';
require_once __DIR__ . '/../components/StorageManager.php';
require_once __DIR__ . '/../components/DockerComposeGenerator.php';

// Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuration des langues
$idiomas = [
    'es' => ['nombre' => 'Español', 'bandera' => '🇨🇴'],
    'br' => ['nombre' => 'Português', 'bandera' => '🇧🇷'],
    'en' => ['nombre' => 'English', 'bandera' => '🇺🇸'],
    'fr' => ['nombre' => 'Français', 'bandera' => '🇫🇷']
];

// Détection de la langue
$idioma_actual = $_GET['lang'] ?? $_SESSION['lang'] ?? 'es';
if (!isset($idiomas[$idioma_actual])) $idioma_actual = 'es';
$_SESSION['lang'] = $idioma_actual;

// Fonction de traduction
function t(string $clave, string $seccion = 'suscripcion'): string {
    global $idioma_actual, $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT valor FROM contenido_web WHERE seccion = ? AND clave = ? AND idioma = ? LIMIT 1");
        $stmt->execute([$seccion, $clave, $idioma_actual]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['valor'] ?? $clave;
    } catch (PDOException $e) {
        return $clave;
    }
}

// Traitement du formulaire
$mensaje_exito = false;
$errores = [];
$datos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validation
    $nombre_escuela = trim($_POST['nombre_escuela'] ?? '');
    $nombre_director = trim($_POST['nombre_director'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');
    $pais = trim($_POST['pais'] ?? 'CO');
    $color_primario = trim($_POST['color_primario'] ?? '#2563eb');
    $color_secundario = trim($_POST['color_secundario'] ?? '#06b6d4');
    
    // Générer le slug
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nombre_escuela));
    $slug = trim($slug, '-');
    
    // Validations
    if (empty($nombre_escuela)) {
        $errores[] = t('campo_obligatorio') . ': ' . t('label_nombre_escuela');
    }
    
    if (empty($nombre_director)) {
        $errores[] = t('campo_obligatorio') . ': ' . t('label_nombre_director');
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = t('email_invalido');
    }
    
    // Vérifier si le nom existe déjà
    if (empty($errores)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM suscripciones_escuelas WHERE slug = ? OR nombre_escuela = ?");
            $stmt->execute([$slug, $nombre_escuela]);
            if ($stmt->fetch()) {
                $errores[] = t('nombre_no_disponible');
            }
        } catch (PDOException $e) {
            error_log("Erreur vérification nom: " . $e->getMessage());
        }
    }
    
    // Vérifier si l'email existe déjà
    if (empty($errores)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM suscripciones_escuelas WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errores[] = t('email_no_disponible');
            }
        } catch (PDOException $e) {
            error_log("Erreur vérification email: " . $e->getMessage());
        }
    }
    
    // Upload du logo (OPTIONNEL - ne bloque pas l'inscription)
    $logo_url = null;
    $favicon_url = null;
    $logo_warning = null;
    error_log("Upload logo: _FILES = " . print_r($_FILES, true));
    
    if (!empty($_FILES['logo']['tmp_name']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        error_log("Upload logo: Fichier présent, tentative upload");
        $storage = new StorageManager();
        $uploadResult = $storage->uploadSchoolLogo(
            $_FILES['logo']['tmp_name'],
            $_FILES['logo']['name'],
            $slug
        );
        
        $logo_url = $uploadResult['logo_url'];
        $favicon_url = $uploadResult['favicon_url'];
        
        error_log("Upload logo: logo_url = " . ($logo_url ?: "NULL") . ", favicon_url = " . ($favicon_url ?: "NULL"));
        
        if (!$logo_url) {
            // Le logo est optionnel - on affiche un warning mais on continue
            $errors = $storage->getErrors();
            error_log("Logo upload warning: " . implode(', ', $errors));
            $logo_warning = t('error_cargar_logo') . " (" . implode(', ', $errors) . ")";
            // On ne bloque pas l'inscription pour une erreur de logo
        }
    } else {
        error_log("Upload logo: Pas de fichier ou erreur: " . ($_FILES['logo']['error'] ?? 'no file'));
    }
    
    // Si pas d'erreurs, créer l'école
    if (empty($errores)) {
        
        try {
            // Calculer la date de fin (30 jours)
            $fecha_fin = date('Y-m-d', strtotime('+30 days'));
            $fecha_inicio = date('Y-m-d H:i:s');
            
            // Générer les identifiants DB
            $db_root_password = bin2hex(random_bytes(16));
            $phpmyadmin_port = 9000 + random_int(1, 999);
            
            // Préparer les données
            $schoolData = [
                'nombre_escuela' => $nombre_escuela,
                'slug' => $slug,
                'nombre_director' => $nombre_director,
                'email' => $email,
                'telefono' => $telefono,
                'ciudad' => $ciudad,
                'pais' => $pais,
                'color_primario' => $color_primario,
                'color_secundario' => $color_secundario,
                'logo_url' => $logo_url,
                'favicon_url' => $favicon_url,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'db_root_password' => $db_root_password,
                'phpmyadmin_port' => $phpmyadmin_port,
                'id' => null
            ];
            
            // Générer le docker-compose
            $dockerInfo = DockerComposeGenerator::generate($schoolData);
            
            // Insérer dans la base de données
            $stmt = $pdo->prepare("INSERT INTO suscripciones_escuelas (
                nombre_escuela, slug, nombre_director, email, telefono, 
                ciudad, pais, color_primario, color_secundario, logo_url,
                fecha_inicio, fecha_fin, estado,
                docker_compose_content, docker_compose_path,
                db_name, db_user, db_password,
                ip_registro, user_agent
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, 'activa', ?, ?, ?, ?, ?, ?, ?)");
            
            error_log("INSERT logo_url: " . ($logo_url ?: "NULL"));
            
            $stmt->execute([
                $nombre_escuela,
                $slug,
                $nombre_director,
                $email,
                $telefono,
                $ciudad,
                $pais,
                $color_primario,
                $color_secundario,
                $logo_url,
                $fecha_fin,
                $dockerInfo['content'],
                $dockerInfo['path'],
                $dockerInfo['db_name'],
                $dockerInfo['db_user'],
                $dockerInfo['db_password'],
                $_SERVER['REMOTE_ADDR'] ?? null,
                $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);
            
            $schoolId = $pdo->lastInsertId();
            $schoolData['id'] = $schoolId;
            
            // NOTE: Les fichiers docker-compose ne sont PAS créés ici
            // car le conteneur PHP n'a pas les droits sur /var/schools
            // Un admin doit exécuter sur l'hôte: ./scripts/create-school.sh $slug
            
            // Insérer aussi dans PostgreSQL pour le template Next.js
            try {
                $pg_host = getenv('POSTGRES_HOST') ?: 'postgres';
                $pg_db = getenv('POSTGRES_DB') ?: 'edu_platform';
                $pg_user = getenv('POSTGRES_USER') ?: 'edu_admin';
                $pg_pass = getenv('POSTGRES_PASSWORD') ?: '';
                
                $pgPdo = new PDO(
                    "pgsql:host=$pg_host;dbname=$pg_db",
                    $pg_user,
                    $pg_pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
                
                $stmt = $pgPdo->prepare("INSERT INTO schools (
                    nombre, slug, dominio, email_director, telefono,
                    direccion, ciudad, pais, color_primario, color_secundario,
                    logo_url, favicon_url, estado, trial_hasta
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'activa', ?) 
                ON CONFLICT (slug) DO UPDATE SET
                    logo_url = EXCLUDED.logo_url,
                    favicon_url = EXCLUDED.favicon_url,
                    color_primario = EXCLUDED.color_primario,
                    color_secundario = EXCLUDED.color_secundario
                RETURNING id");
                
                $stmt->execute([
                    $nombre_escuela,
                    $slug,
                    $dockerInfo['subdomain'],
                    $email,
                    $telefono,
                    '', // direccion
                    $ciudad,
                    $pais,
                    $color_primario,
                    $color_secundario,
                    $logo_url,
                    $favicon_url,
                    $fecha_fin
                ]);
                
                $pgSchoolId = $stmt->fetchColumn();
                error_log("École insérée dans PostgreSQL avec ID: $pgSchoolId");
                
            } catch (Exception $pgError) {
                error_log("Erreur insertion PostgreSQL (non bloquante): " . $pgError->getMessage());
                // On ne bloque pas l'inscription si PostgreSQL échoue
            }
            
            // Envoyer l'email de confirmation
            enviarEmailConfirmacion($email, $schoolData, $dockerInfo);
            
            $mensaje_exito = true;
            $datos = [
                'nombre_escuela' => $nombre_escuela,
                'slug' => $slug,
                'fecha_fin' => $fecha_fin,
                'subdomain' => $dockerInfo['subdomain']
            ];
            
        } catch (Exception $e) {
            error_log("Erreur création école: " . $e->getMessage());
            $errores[] = "Error: " . $e->getMessage();
        }
    }
}

/**
 * Envoyer l'email de confirmation
 */
function enviarEmailConfirmacion(string $email, array $schoolData, array $dockerInfo): void {
    
    $subject = match($GLOBALS['idioma_actual']) {
        'es' => "✅ Tu página de inscripción está lista - {$schoolData['nombre_escuela']}",
        'br' => "✅ Sua página de inscrição está pronta - {$schoolData['nombre_escuela']}",
        'en' => "✅ Your enrollment page is ready - {$schoolData['nombre_escuela']}",
        'fr' => "✅ Votre page d'inscription est prête - {$schoolData['nombre_escuela']}",
        default => "✅ Tu página de inscripción está lista"
    };
    
    $url = "https://" . $dockerInfo['subdomain'];
    
    $body = <<<HTML
<div style="font-family: Arial, sans-serif; background:#f5f7fa; padding:20px;">
    <div style="max-width:600px; margin:auto; background:white; border-radius:10px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.05);">
        
        <div style="background: linear-gradient(135deg,{$schoolData['color_primario']},{$schoolData['color_secundario']}); color:white; padding:25px; text-align:center;">
            <h2 style="margin:0;">🎉 ¡Bienvenido!</h2>
            <p style="margin:5px 0 0;">{$schoolData['nombre_escuela']}</p>
        </div>

        <div style="padding:25px; color:#333;">
            <p>Hola {$schoolData['nombre_director']},</p>
            
            <p>
                Tu página de inscripción personalizada ha sido creada exitosamente.
            </p>
            
            <div style="margin:20px 0; padding:15px; background:#f0f9ff; border-radius:8px; text-align:center;">
                <p style="margin:0 0 10px;"><strong>Tu URL será:</strong></p>
                <span style="color:{$schoolData['color_primario']}; font-size:18px; text-decoration:none;">
                    {$url}
                </span>
            </div>
            
            <div style="margin:20px 0; padding:15px; background:#fef3c7; border-radius:8px; border-left:4px solid #f59e0b;">
                <p style="margin:0; color:#92400e;"><strong>⏳ Activación pendiente</strong></p>
                <p style="margin:5px 0 0; color:#a16207; font-size:14px;">
                    Tu página será activada en las próximas horas. Te enviaremos un correo cuando esté lista.
                </p>
            </div>
            
            <div style="margin:20px 0; padding:15px; background:#fff7ed; border-radius:8px;">
                <p style="margin:0;"><strong>📅 Período de prueba:</strong> 30 días</p>
                <p style="margin:5px 0 0;"><strong>📅 Fecha de vencimiento:</strong> {$schoolData['fecha_fin']}</p>
            </div>
            
            <div style="margin:20px 0; padding:15px; background:#f0fdf4; border-radius:8px; border-left:4px solid #22c55e;">
                <p style="margin:0 0 10px; color:#166534;"><strong>🚀 ¿Qué has conseguido?</strong></p>
                <p style="margin:0; color:#15803d; font-size:14px; line-height:1.6;">
                    Has dado el primer paso para <strong>digitalizar completamente tu colegio</strong>. 
                    Nuestra plataforma no es solo un formulario: es un <strong>sistema integral de gestión escolar</strong> 
                    que incluye control de matrículas, comunicación con padres, reportes académicos y 
                    herramientas administrativas potentes. Todo <strong>personalizado con los colores de tu institución</strong> 
                    y alojado en servidores seguros de OVH Cloud con certificado SSL.
                </p>
            </div>
            
            <div style="margin:20px 0; padding:15px; background:#eff6ff; border-radius:8px; border-left:4px solid #3b82f6;">
                <p style="margin:0 0 10px; color:#1e40af;"><strong>💡 ¿Y ahora qué?</strong></p>
                <ul style="margin:0; padding-left:20px; color:#1e3a8a; font-size:14px; line-height:1.6;">
                    <li>En las próximas <strong>24 horas</strong> activaremos tu página personalizada</li>
                    <li>Recibirás un email de confirmación cuando esté lista</li>
                    <li>Tendrás <strong>30 días de prueba gratuita</strong> para explorar todas las funcionalidades</li>
                    <li>Sin compromiso, sin tarjeta de crédito, sin letra pequeña</li>
                </ul>
            </div>
            
            <div style="text-align:center; margin:25px 0;">
                <a href="https://wa.me/573204181193?text=Hola%2C%20acabo%20de%20registrar%20mi%20colegio%20{$schoolData['nombre_escuela']}%20y%20tengo%20preguntas" 
                   style="display:inline-block; background:#25d366; color:white; padding:12px 24px; border-radius:25px; text-decoration:none; font-weight:bold;">
                    💬 Hablar por WhatsApp
                </a>
                <p style="margin:10px 0 0; font-size:12px; color:#666;">
                    ¿Preguntas? Escríbenos directamente, te respondemos en minutos
                </p>
            </div>
            
            <hr style="margin:25px 0;">
            
            <p style="font-size:13px; color:#888;">
                También puedes responder a este correo.<br>
                <strong>¡Gracias por confiar en nosotros para transformar la educación!</strong>
            </p>
        </div>
    </div>
</div>
HTML;

    Mailer::envoyer([
        'to' => $email,
        'subject' => $subject,
        'body' => $body
    ]);
}

// Pays pour le select
$paises_america = [
    'CO' => ['es' => 'Colombia', 'br' => 'Colômbia', 'en' => 'Colombia', 'fr' => 'Colombie'],
    'AR' => ['es' => 'Argentina', 'br' => 'Argentina', 'en' => 'Argentina', 'fr' => 'Argentine'],
    'BO' => ['es' => 'Bolivia', 'br' => 'Bolívia', 'en' => 'Bolivia', 'fr' => 'Bolivie'],
    'BR' => ['es' => 'Brasil', 'br' => 'Brasil', 'en' => 'Brazil', 'fr' => 'Brésil'],
    'CL' => ['es' => 'Chile', 'br' => 'Chile', 'en' => 'Chile', 'fr' => 'Chili'],
    'CR' => ['es' => 'Costa Rica', 'br' => 'Costa Rica', 'en' => 'Costa Rica', 'fr' => 'Costa Rica'],
    'EC' => ['es' => 'Ecuador', 'br' => 'Equador', 'en' => 'Ecuador', 'fr' => 'Équateur'],
    'SV' => ['es' => 'El Salvador', 'br' => 'El Salvador', 'en' => 'El Salvador', 'fr' => 'Salvador'],
    'GT' => ['es' => 'Guatemala', 'br' => 'Guatemala', 'en' => 'Guatemala', 'fr' => 'Guatemala'],
    'MX' => ['es' => 'México', 'br' => 'México', 'en' => 'Mexico', 'fr' => 'Mexique'],
    'PA' => ['es' => 'Panamá', 'br' => 'Panamá', 'en' => 'Panama', 'fr' => 'Panama'],
    'PE' => ['es' => 'Perú', 'br' => 'Peru', 'en' => 'Peru', 'fr' => 'Pérou'],
    'UY' => ['es' => 'Uruguay', 'br' => 'Uruguai', 'en' => 'Uruguay', 'fr' => 'Uruguay'],
    'VE' => ['es' => 'Venezuela', 'br' => 'Venezuela', 'en' => 'Venezuela', 'fr' => 'Venezuela'],
];
?>
<!DOCTYPE html>
<html lang="<?= $idioma_actual ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Optimisé -->
    <title>Crear Formulario de Inscripción para Colegios | 30 Días Gratis</title>
    <meta name="description" content="Crea tu propio formulario de inscripción escolar personalizado. Página web segura con los colores de tu colegio. Prueba gratuita 30 días. Digitaliza tu proceso de matrícula ahora.">
    <meta name="keywords" content="formulario inscripción colegio, matrícula escolar digital, sistema inscripción escuela, software inscripción estudiantes, plataforma matrícula colegio, formulario online colegio, inscripción escolar Colombia, gestión matrícula educativa">
    <meta name="author" content="ESchool">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://henrimorel.com/suscripcion">
    <meta property="og:title" content="Crea tu Formulario de Inscripción Escolar | 30 Días Gratis">
    <meta property="og:description" content="Digitaliza el proceso de inscripción de tu colegio. Página personalizada con tus colores y logo. Prueba gratuita de 30 días.">
    <meta property="og:image" content="https://henrimorel.com/public/logo.png">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://henrimorel.com/suscripcion">
    <meta property="twitter:title" content="Formulario de Inscripción Digital para Colegios">
    <meta property="twitter:description" content="Crea tu página de inscripción personalizada. 30 días gratis.">
    <meta property="twitter:image" content="https://henrimorel.com/public/logo.png">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://henrimorel.com/suscripcion">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .preview-box {
            border: 2px dashed #e5e7eb;
            transition: all 0.3s ease;
        }
        .preview-box:hover {
            border-color: #3b82f6;
        }
        .color-picker-wrapper {
            position: relative;
            overflow: hidden;
        }
        .color-picker-wrapper input[type="color"] {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            cursor: pointer;
        }
        .availability-checking {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .success-animation {
            animation: bounceIn 0.6s ease-out;
        }
        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Navigation -->
    <nav class="gradient-bg text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-2xl mr-3"></i>
                    <span class="font-bold text-xl">ESchool</span>
                </div>
                
                <!-- Sélecteur de langue -->
                <div class="flex items-center space-x-2">
                    <?php foreach ($idiomas as $codigo => $info): ?>
                        <a href="?lang=<?= $codigo ?>" 
                           class="px-3 py-1 rounded-full text-sm transition-all <?= $idioma_actual === $codigo ? 'bg-white text-purple-700 font-bold' : 'text-white hover:bg-white/20' ?>">
                            <?= $info['bandera'] ?> <?= $info['nombre'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php if ($mensaje_exito): ?>
        <!-- Message de succès -->
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl p-8 max-w-lg w-full text-center success-animation">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-4xl text-green-500"></i>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-800 mb-4"><?= t('exito_titulo') ?></h1>
                
                <p class="text-gray-600 mb-6">
                    <?= t('exito_mensaje') ?><br>
                    <strong class="text-purple-600 text-lg"><?= date('d/m/Y', strtotime($datos['fecha_fin'])) ?></strong>
                </p>
                
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-sm text-gray-500 mb-2">URL de tu página:</p>
                    <a href="https://<?= $datos['subdomain'] ?>" target="_blank" 
                       class="text-purple-600 font-medium hover:underline break-all">
                        https://<?= $datos['subdomain'] ?>
                    </a>
                </div>
                
                <a href="https://<?= $datos['subdomain'] ?>" 
                   class="inline-block bg-gradient-to-r from-purple-600 to-blue-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition-all transform hover:-translate-y-1">
                    <?= t('ir_a_pagina') ?> <i class="fas fa-arrow-right ml-2"></i>
                </a>
                
                <p class="text-xs text-gray-400 mt-6">
                    Se ha enviado un correo con todos los detalles a tu bandeja de entrada.
                </p>
            </div>
        </div>
        
    <?php else: ?>
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold mb-4">
                    🎁 30 días gratis
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    <?= t('titulo_principal') ?>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    <?= t('subtitulo') ?>
                </p>
            </div>
            
            <!-- Explication -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg mb-8 max-w-3xl mx-auto">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                    <p class="text-blue-800">
                        <?= t('explicacion') ?>
                    </p>
                </div>
            </div>
            
            <?php if (!empty($errores)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-8 max-w-3xl mx-auto">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3 mt-1"></i>
                        <ul class="text-red-700">
                            <?php foreach ($errores as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="grid md:grid-cols-2 gap-8">
                
                <!-- Formulaire -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    
                    <!-- Lien vers la démo/test -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <div class="flex items-start">
                            <i class="fas fa-flask text-blue-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold text-blue-800 mb-1">¿Quieres probar antes de suscribirte?</p>
                                <p class="text-blue-700 text-sm mb-2">
                                    Prueba nuestra <strong>versión demo gratuita</strong> y experimenta cómo funciona el formulario de inscripción sin compromiso.
                                </p>
                                <a href="/inscripcion" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    <i class="fas fa-vial mr-2"></i>Probar la demo ahora
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-school text-purple-600 mr-3"></i>
                        Datos del colegio
                    </h2>
                    
                    <form method="POST" enctype="multipart/form-data" class="space-y-6" id="suscripcionForm">
                        
                        <!-- Nom de l'école -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('label_nombre_escuela') ?> *
                            </label>
                            <input type="text" name="nombre_escuela" id="nombre_escuela" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                                   placeholder="<?= t('placeholder_nombre') ?>"
                                   value="<?= htmlspecialchars($_POST['nombre_escuela'] ?? '') ?>">
                            <div id="availability-status" class="mt-2 text-sm min-h-[24px]"></div>
                        </div>
                        
                        <!-- Nom du directeur -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('label_nombre_director') ?> *
                            </label>
                            <input type="text" name="nombre_director" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                                   value="<?= htmlspecialchars($_POST['nombre_director'] ?? '') ?>">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('label_email') ?> *
                            </label>
                            <input type="email" name="email" id="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            <div id="email-status" class="mt-2 text-sm min-h-[24px]"></div>
                        </div>
                        
                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('label_telefono') ?>
                            </label>
                            <input type="tel" name="telefono"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                                   value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
                        </div>
                        
                        <!-- Ville et Pays -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <?= t('label_ciudad') ?>
                                </label>
                                <input type="text" name="ciudad"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                                       value="<?= htmlspecialchars($_POST['ciudad'] ?? '') ?>">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <?= t('label_pais') ?>
                                </label>
                                <select name="pais" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                                    <?php foreach ($paises_america as $codigo => $nombres): ?>
                                        <option value="<?= $codigo ?>" <?= ($_POST['pais'] ?? 'CO') === $codigo ? 'selected' : '' ?>>
                                            <?= $nombres[$idioma_actual] ?? $nombres['es'] ?> (<?= $codigo ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Logo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <?= t('label_logo') ?>
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-purple-500 transition-colors cursor-pointer" onclick="document.getElementById('logo').click()">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <span class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500">
                                            Subir archivo
                                        </span>
                                        <input id="logo" name="logo" type="file" accept="image/*" class="sr-only" onchange="previewLogo(this)">
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG hasta 2MB</p>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500"><?= t('ayuda_logo') ?></p>
                            <div id="logo-preview" class="mt-4 hidden">
                                <img src="" alt="Logo preview" class="h-24 object-contain rounded-lg border border-gray-200">
                            </div>
                        </div>
                        
                        <!-- Couleurs -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <?= t('label_color_primario') ?>
                                </label>
                                <div class="flex items-center space-x-3">
                                    <div class="color-picker-wrapper w-12 h-12 rounded-lg shadow-sm border border-gray-300" style="background-color: #2563eb;">
                                        <input type="color" name="color_primario" id="color_primario" 
                                               value="<?= $_POST['color_primario'] ?? '#2563eb' ?>"
                                               onchange="updatePreview()">
                                    </div>
                                    <span class="text-sm text-gray-500 font-mono" id="color_primario_hex">#2563eb</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <?= t('label_color_secundario') ?>
                                </label>
                                <div class="flex items-center space-x-3">
                                    <div class="color-picker-wrapper w-12 h-12 rounded-lg shadow-sm border border-gray-300" style="background-color: #06b6d4;">
                                        <input type="color" name="color_secundario" id="color_secundario" 
                                               value="<?= $_POST['color_secundario'] ?? '#06b6d4' ?>"
                                               onchange="updatePreview()">
                                    </div>
                                    <span class="text-sm text-gray-500 font-mono" id="color_secundario_hex">#06b6d4</span>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-purple-600 to-blue-500 text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center">
                            <i class="fas fa-magic mr-2"></i>
                            <?= t('boton_crear') ?>
                        </button>
                        
                    </form>
                </div>
                
                <!-- Preview -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-eye text-purple-600 mr-3"></i>
                            <?= t('preview_titulo') ?>
                        </h2>
                        
                        <!-- Aperçu du formulaire -->
                        <div class="preview-box rounded-xl p-6 bg-gray-50">
                            
                            <!-- Header preview -->
                            <div id="preview-header" class="rounded-t-xl p-6 text-white transition-all duration-300" 
                                 style="background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);">
                                <div class="flex items-center space-x-4">
                                    <div id="preview-logo-container" class="w-16 h-16 bg-white rounded-lg flex items-center justify-center hidden">
                                        <img id="preview-logo" src="" alt="Logo" class="max-w-full max-h-full p-1">
                                    </div>
                                    <div id="preview-logo-placeholder" class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-school text-2xl text-white/80"></i>
                                    </div>
                                    <div>
                                        <h3 id="preview-school-name" class="text-xl font-bold">Nombre del Colegio</h3>
                                        <p class="text-white/80 text-sm">Formulario de Inscripción</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form preview -->
                            <div class="bg-white rounded-b-xl p-6 border border-t-0 border-gray-200">
                                <div class="space-y-4">
                                    <div>
                                        <div class="h-4 bg-gray-200 rounded w-1/3 mb-2"></div>
                                        <div class="h-10 bg-gray-100 rounded border border-gray-200"></div>
                                    </div>
                                    <div>
                                        <div class="h-4 bg-gray-200 rounded w-1/4 mb-2"></div>
                                        <div class="h-10 bg-gray-100 rounded border border-gray-200"></div>
                                    </div>
                                    <div class="h-12 rounded-lg flex items-center justify-center text-white font-semibold transition-all duration-300"
                                         id="preview-button"
                                         style="background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);">
                                        Continuar <i class="fas fa-arrow-right ml-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <?= t('info_trial') ?>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-shield-alt text-green-500 mr-3"></i>
                                <?= t('info_seguro') ?>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-paint-brush text-purple-500 mr-3"></i>
                                Personalización de colores incluida
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-envelope text-blue-500 mr-3"></i>
                                Correo de confirmación con accesos
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        
    <?php endif; ?>
    
    <!-- Overlay de chargement -->
    <div id="loading-overlay" class="fixed inset-0 bg-gray-900/90 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 text-center">
            <!-- Spinner -->
            <div class="relative w-24 h-24 mx-auto mb-6">
                <div class="absolute inset-0 border-4 border-gray-200 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-purple-600 rounded-full border-t-transparent animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-cog text-3xl text-purple-600 animate-pulse"></i>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800 mb-2"><?= t('loading_titre') ?></h2>
            <p class="text-gray-600 mb-6"><?= t('loading_sous_titre') ?></p>
            
            <!-- Étapes -->
            <div class="space-y-3 text-left">
                <div id="step-1" class="flex items-center space-x-3 text-gray-400">
                    <i class="fas fa-circle text-xs"></i>
                    <span class="text-sm"><?= t('loading_step_1') ?></span>
                </div>
                <div id="step-2" class="flex items-center space-x-3 text-gray-400">
                    <i class="fas fa-circle text-xs"></i>
                    <span class="text-sm"><?= t('loading_step_2') ?></span>
                </div>
                <div id="step-3" class="flex items-center space-x-3 text-gray-400">
                    <i class="fas fa-circle text-xs"></i>
                    <span class="text-sm"><?= t('loading_step_3') ?></span>
                </div>
                <div id="step-4" class="flex items-center space-x-3 text-gray-400">
                    <i class="fas fa-circle text-xs"></i>
                    <span class="text-sm"><?= t('loading_step_4') ?></span>
                </div>
                <div id="step-5" class="flex items-center space-x-3 text-gray-400">
                    <i class="fas fa-circle text-xs"></i>
                    <span class="text-sm"><?= t('loading_step_5') ?></span>
                </div>
            </div>
            
            <!-- Info sécurité -->
            <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="flex items-center justify-center space-x-2 mb-2">
                    <i class="fas fa-shield-alt text-green-600"></i>
                    <span class="font-semibold text-green-800"><?= t('loading_securite_titre') ?></span>
                </div>
                <div class="grid grid-cols-2 gap-2 text-xs text-green-700">
                    <div class="flex items-center justify-center space-x-1">
                        <i class="fas fa-lock"></i>
                        <span><?= t('loading_https') ?></span>
                    </div>
                    <div class="flex items-center justify-center space-x-1">
                        <i class="fas fa-server"></i>
                        <span><?= t('loading_cloud') ?></span>
                    </div>
                    <div class="flex items-center justify-center space-x-1">
                        <i class="fas fa-database"></i>
                        <span><?= t('loading_bd') ?></span>
                    </div>
                    <div class="flex items-center justify-center space-x-1">
                        <i class="fas fa-envelope"></i>
                        <span><?= t('loading_email') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400">
                © 2026 ESchool - Plataforma de inscripciones escolares
            </p>
        </div>
    </footer>
    
    <script>
        // Preview du logo
        function previewLogo(input) {
            const preview = document.getElementById('logo-preview');
            const previewImg = preview.querySelector('img');
            const previewContainer = document.getElementById('preview-logo-container');
            const previewPlaceholder = document.getElementById('preview-logo-placeholder');
            const previewLogo = document.getElementById('preview-logo');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                    
                    // Update preview
                    previewLogo.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    previewPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Mise à jour des couleurs en preview
        function updatePreview() {
            const primary = document.getElementById('color_primario').value;
            const secondary = document.getElementById('color_secundario').value;
            
            document.getElementById('color_primario_hex').textContent = primary;
            document.getElementById('color_secundario_hex').textContent = secondary;
            
            document.getElementById('preview-header').style.background = 
                `linear-gradient(135deg, ${primary} 0%, ${secondary} 100%)`;
            document.getElementById('preview-button').style.background = 
                `linear-gradient(135deg, ${primary} 0%, ${secondary} 100%)`;
                
            document.querySelector('.color-picker-wrapper').style.backgroundColor = primary;
        }
        
        // Mise à jour du nom de l'école en preview
        document.getElementById('nombre_escuela')?.addEventListener('input', function() {
            document.getElementById('preview-school-name').textContent = 
                this.value || 'Nombre del Colegio';
        });
        
        // Vérification INDÉPENDANTE du nom et email
        let checkNombreTimeout, checkEmailTimeout;
        let disponibilidadNombreOk = false;
        let disponibilidadEmailOk = false;
        const nombreStatusDiv = document.getElementById('availability-status');
        const emailStatusDiv = document.getElementById('email-status');
        const submitBtn = document.querySelector('button[type="submit"]');
        const nombreInput = document.getElementById('nombre_escuela');
        const emailInput = document.getElementById('email');
        
        function updateSubmitButton() {
            if (disponibilidadNombreOk && disponibilidadEmailOk) {
                submitBtn?.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn?.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
        
        // Vérifier uniquement le NOM
        function verificarNombre() {
            clearTimeout(checkNombreTimeout);
            const nombre = nombreInput?.value.trim() || '';
            
            if (nombre.length < 3) {
                nombreStatusDiv.innerHTML = '';
                disponibilidadNombreOk = false;
                updateSubmitButton();
                return;
            }
            
            nombreStatusDiv.innerHTML = '<span class="text-gray-500 availability-checking"><i class="fas fa-spinner fa-spin mr-2"></i><?= t('verificando_disponibilidad') ?></span>';
            
            checkNombreTimeout = setTimeout(() => {
                fetch(`/check_disponibilidad?nombre=${encodeURIComponent(nombre)}&email=`)
                    .then(r => r.json())
                    .then(data => {
                        const hasError = data.errors && data.errors.includes('nombre_no_disponible');
                        
                        if (hasError) {
                            disponibilidadNombreOk = false;
                            nombreStatusDiv.innerHTML = '<span class="text-red-600"><i class="fas fa-times-circle mr-2"></i><?= t('nombre_no_disponible') ?></span>';
                        } else {
                            disponibilidadNombreOk = true;
                            nombreStatusDiv.innerHTML = '<span class="text-green-600"><i class="fas fa-check-circle mr-2"></i><?= t('nombre_disponible') ?></span>';
                        }
                        updateSubmitButton();
                    })
                    .catch(() => {
                        nombreStatusDiv.innerHTML = '<span class="text-orange-600"><i class="fas fa-exclamation-triangle mr-2"></i>Error</span>';
                        disponibilidadNombreOk = false;
                        updateSubmitButton();
                    });
            }, 500);
        }
        
        // Vérifier uniquement l'EMAIL
        function verificarEmail() {
            clearTimeout(checkEmailTimeout);
            const email = emailInput?.value.trim() || '';
            
            if (email.length < 5 || !email.includes('@')) {
                emailStatusDiv.innerHTML = '';
                disponibilidadEmailOk = false;
                updateSubmitButton();
                return;
            }
            
            emailStatusDiv.innerHTML = '<span class="text-gray-500 availability-checking"><i class="fas fa-spinner fa-spin mr-2"></i><?= t('verificando_disponibilidad') ?></span>';
            
            checkEmailTimeout = setTimeout(() => {
                fetch(`/check_disponibilidad?nombre=&email=${encodeURIComponent(email)}`)
                    .then(r => r.json())
                    .then(data => {
                        const hasError = data.errors && data.errors.includes('email_no_disponible');
                        
                        if (hasError) {
                            disponibilidadEmailOk = false;
                            emailStatusDiv.innerHTML = '<span class="text-red-600"><i class="fas fa-times-circle mr-2"></i><?= t('email_no_disponible') ?></span>';
                        } else {
                            disponibilidadEmailOk = true;
                            emailStatusDiv.innerHTML = '<span class="text-green-600"><i class="fas fa-check-circle mr-2"></i>Email disponible</span>';
                        }
                        updateSubmitButton();
                    })
                    .catch(() => {
                        emailStatusDiv.innerHTML = '<span class="text-orange-600"><i class="fas fa-exclamation-triangle mr-2"></i>Error</span>';
                        disponibilidadEmailOk = false;
                        updateSubmitButton();
                    });
            }, 500);
        }
        
        // Vérifier les deux (pour le bouton submit)
        window.verificarDisponibilidad = function() {
            verificarNombre();
            verificarEmail();
        }
        
        // Événements NOM
        if (nombreInput) {
            nombreInput.addEventListener('blur', verificarNombre);
            nombreInput.addEventListener('input', function() {
                disponibilidadNombreOk = false;
                nombreStatusDiv.innerHTML = '';
                updateSubmitButton();
            });
        }
        
        // Événements EMAIL
        if (emailInput) {
            emailInput.addEventListener('blur', verificarEmail);
            emailInput.addEventListener('input', function() {
                disponibilidadEmailOk = false;
                emailStatusDiv.innerHTML = '';
                updateSubmitButton();
            });
        }
        
        // Initialiser les couleurs
        updatePreview();
        
        // Désactiver le bouton au départ
        updateSubmitButton();
        
        // Gestion de la soumission du formulaire en AJAX
        document.getElementById('suscripcionForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Vérifier que le formulaire est valide
            if (!this.checkValidity()) {
                this.reportValidity();
                return;
            }
            
            // Vérifier la disponibilité
            if (!disponibilidadNombreOk || !disponibilidadEmailOk) {
                verificarDisponibilidad(true);
                setTimeout(() => {
                    if (!disponibilidadNombreOk || !disponibilidadEmailOk) {
                        alert('<?= t('verificar_antes_continuar') ?>');
                    }
                }, 600);
                return;
            }
            
            // Afficher l'overlay de chargement
            const overlay = document.getElementById('loading-overlay');
            overlay.classList.remove('hidden');
            
            // Désactiver le bouton
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creando...';
            }
            
            // Animer les étapes
            const steps = [
                { id: 'step-1', delay: 500 },
                { id: 'step-2', delay: 1500 },
                { id: 'step-3', delay: 3000 },
                { id: 'step-4', delay: 4500 },
                { id: 'step-5', delay: 6000 }
            ];
            
            steps.forEach(step => {
                setTimeout(() => {
                    const el = document.getElementById(step.id);
                    if (el) {
                        el.classList.remove('text-gray-400');
                        el.classList.add('text-purple-600', 'font-semibold');
                        el.querySelector('i')?.classList.remove('fa-circle');
                        el.querySelector('i')?.classList.add('fa-check-circle');
                    }
                }, step.delay);
            });
            
            // Soumettre en AJAX pour garder l'overlay visible
            const formData = new FormData(this);
            
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                // Remplacer le body entier pour afficher la page de succès
                document.open();
                document.write(html);
                document.close();
            })
            .catch(error => {
                console.error('Erreur:', error);
                overlay.classList.add('hidden');
                alert('Error al crear la página. Por favor intenta de nuevo.');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-magic mr-2"></i><?= t('boton_crear') ?>';
                }
            });
        });
    </script>
    
</body>
</html>
