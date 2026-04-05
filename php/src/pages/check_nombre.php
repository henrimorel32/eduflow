<?php
/**
 * Vérifie si un nom d'école est disponible
 * Appel AJAX depuis la page de souscription
 */

require_once __DIR__ . '/../includes/config.php';

header('Content-Type: application/json');

$nombre = $_GET['nombre'] ?? '';

if (empty($nombre) || strlen($nombre) < 3) {
    echo json_encode(['disponible' => false, 'error' => 'Nombre too short']);
    exit;
}

$slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nombre));
$slug = trim($slug, '-');

try {
    $stmt = $pdo->prepare("SELECT id FROM suscripciones_escuelas WHERE slug = ? OR nombre_escuela = ?");
    $stmt->execute([$slug, $nombre]);
    $existe = $stmt->fetch();
    
    echo json_encode([
        'disponible' => !$existe,
        'slug' => $slug
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['disponible' => false, 'error' => 'Database error']);
}
