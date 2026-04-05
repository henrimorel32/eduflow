<?php
/**
 * Vérifie la disponibilité du nom ET de l'email
 * Appel AJAX depuis la page de souscription
 */

require_once __DIR__ . '/../includes/config.php';

header('Content-Type: application/json');

$nombre = $_GET['nombre'] ?? '';
$email = $_GET['email'] ?? '';
$response = ['disponible' => true, 'errors' => []];

// Vérifier le nom
if (!empty($nombre) && strlen($nombre) >= 3) {
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nombre));
    $slug = trim($slug, '-');
    
    try {
        $stmt = $pdo->prepare("SELECT id FROM suscripciones_escuelas WHERE slug = ? OR nombre_escuela = ?");
        $stmt->execute([$slug, $nombre]);
        if ($stmt->fetch()) {
            $response['disponible'] = false;
            $response['errors'][] = 'nombre_no_disponible';
        }
    } catch (PDOException $e) {
        error_log("Erreur vérification nom: " . $e->getMessage());
    }
}

// Vérifier l'email
if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    try {
        $stmt = $pdo->prepare("SELECT id FROM suscripciones_escuelas WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $response['disponible'] = false;
            $response['errors'][] = 'email_no_disponible';
        }
    } catch (PDOException $e) {
        error_log("Erreur vérification email: " . $e->getMessage());
    }
}

echo json_encode($response);
