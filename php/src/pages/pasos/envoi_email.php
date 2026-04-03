<!-- Traitement PHP (au début du fichier principal) -->
<?php

// Reset demo
if (isset($_GET['reset_demo'])) {
    unset($_SESSION['demo_email']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$mensaje_exito = false;
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Si c'est l'entrée initiale avec email
    // if (isset($_POST['demo_email']) && count($_POST) === 1) {
    //     $_SESSION['demo_email'] = filter_var($_POST['demo_email'], FILTER_SANITIZE_EMAIL);
    //     header('Location: ' . $_SERVER['PHP_SELF']);
    //     exit;
    // }
    
    // Si c'est la soumission finale du formulaire
    if (isset($_POST['email_confirmacion'])) {
        
        // Validation...
        $email_destino = filter_var($_POST['email_confirmacion'], FILTER_VALIDATE_EMAIL);
        
        if ($email_destino) {
            // Envoi de l'email avec toutes les données
            $datos_inscripcion = [
                'acudiente1' => $_POST['acudiente1'] ?? [],
                'acudiente2' => $_POST['acudiente2'] ?? [],
                'alumno' => $_POST['alumno'] ?? [],
                'documentos' => $_FILES ?? []
            ];
            
            // Fonction d'envoi d'email
            enviarResumenDemo($email_destino, $datos_inscripcion);
            
            $mensaje_exito = true;
            
            // Optionnel: vider la session pour nouvelle demo
            // unset($_SESSION['demo_email']);
        }
    }
}

function enviarResumenDemo($email, $datos) {
    $subject = "Resumen de tu Demo - Sistema de Inscripciones";
    
    $body = "
    <h2>¡Gracias por probar nuestro sistema!</h2>
    <p>Aquí está el resumen de los datos que ingresaste:</p>
    <hr>
    <h3>Acudiente 1:</h3>
    <pre>" . print_r($datos['acudiente1'], true) . "</pre>
    <!-- etc... -->
    ";
    
    // Envoi mail (adapter selon ta config)
    mail($email, $subject, $body, "Content-Type: text/html; charset=UTF-8");
}
?>