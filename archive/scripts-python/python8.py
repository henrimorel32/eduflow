
# 7. Script de traitement du formulaire de contact
procesar_php = '''<?php
require_once 'includes/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Récupération et nettoyage des données
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$colegio = filter_input(INPUT_POST, 'colegio', FILTER_SANITIZE_SPECIAL_CHARS);
$cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_SPECIAL_CHARS);
$mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS);

// Validation
$errors = [];

if (empty($nombre) || strlen($nombre) < 2) {
    $errors[] = 'El nombre es requerido';
}

if (empty($email)) {
    $errors[] = 'El correo electrónico no es válido';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit;
}

try {
    // Insertion dans la base de données
    $stmt = $pdo->prepare("
        INSERT INTO contacts (nombre, email, colegio, cargo, mensaje, fecha_registro, estado) 
        VALUES (?, ?, ?, ?, ?, NOW(), 'nuevo')
    ");
    
    $stmt->execute([$nombre, $email, $colegio, $cargo, $mensaje]);
    
    // Envoi d'email (simulation - à configurer avec un vrai service SMTP)
    $to = "hola@eduflow.co";
    $subject = "Nuevo contacto: $nombre - $colegio";
    $body = "
        Nombre: $nombre
        Email: $email
        Colegio: $colegio
        Cargo: $cargo
        Mensaje: $mensaje
    ";
    
    // mail($to, $subject, $body); // Décommenter après configuration SMTP
    
    echo json_encode([
        'success' => true,
        'message' => '¡Gracias! Hemos recibido tu solicitud. Te contactaremos en menos de 24 horas.'
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error al guardar el contacto. Por favor intenta nuevamente.'
    ]);
}
?>
'''

with open('/Users/henri/Documents/GitHub/ESchool/php/src/procesar_contacto.php', 'w') as f:
    f.write(procesar_php)

print("✅ Script de traitement du formulaire créé")
