<?php
/**
 * API: Ajouter une école à la queue de déploiement
 * 
 * Cette API est appelée par suscripcion.php pour demander la création
 * d'un container Docker de manière asynchrone.
 * 
 * Méthode: POST
 * Content-Type: application/json
 * 
 * Body:
 * {
 *   "school_id": 123,
 *   "slug": "colegio-san-jose",
 *   "domain": "colegiosanjose.henrimorel.com",
 *   "name": "Colegio San José"
 * }
 * 
 * Response:
 * {
 *   "success": true,
 *   "message": "École ajoutée à la queue de déploiement",
 *   "queue_id": 456
 * }
 */

header('Content-Type: application/json');

// CORS - autoriser uniquement le domaine principal
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$allowedOrigins = [
    'https://henrimorel.com',
    'https://www.henrimorel.com',
    'http://localhost:8081',
    'http://localhost:8081'
];

if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
}

// Répondre aux requêtes OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Uniquement POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

// Charger la configuration
require_once __DIR__ . '/../includes/config.php';

// Logger les requêtes
$logFile = '/var/log/php-deploy-api.log';
function logApi($message) {
    global $logFile;
    $line = date('Y-m-d H:i:s') . " [API] $message\n";
    error_log($line, 3, $logFile);
}

logApi("=== Nouvelle requête ===");
logApi("IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));

// Récupérer le body JSON
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    logApi("Erreur: JSON invalide - $input");
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'JSON invalide']);
    exit;
}

logApi("Données reçues: " . json_encode($data));

// Validation des champs requis
$required = ['school_id', 'slug', 'domain', 'name'];
$missing = [];

foreach ($required as $field) {
    if (empty($data[$field])) {
        $missing[] = $field;
    }
}

if (!empty($missing)) {
    logApi("Erreur: Champs manquants - " . implode(', ', $missing));
    http_response_code(400);
    echo json_encode([
        'success' => false, 
        'error' => 'Champs requis manquants',
        'missing' => $missing
    ]);
    exit;
}

// Validation du slug (sécurité)
$slug = $data['slug'];
if (!preg_match('/^[a-z0-9_-]+$/', $slug)) {
    logApi("Erreur: Slug invalide - $slug");
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Slug invalide']);
    exit;
}

// Validation du domaine
$domain = $data['domain'];
if (!filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
    logApi("Erreur: Domaine invalide - $domain");
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Domaine invalide']);
    exit;
}

try {
    // Vérifier si l'école existe
    $stmt = $pdo->prepare("SELECT id FROM suscripciones_escuelas WHERE id = ? AND slug = ?");
    $stmt->execute([$data['school_id'], $slug]);
    
    if (!$stmt->fetch()) {
        logApi("Erreur: École non trouvée - ID: {$data['school_id']}, Slug: $slug");
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'École non trouvée']);
        exit;
    }
    
    // Vérifier si un déploiement est déjà en cours pour cette école
    $stmt = $pdo->prepare("SELECT id, status FROM school_deploy_queue 
                          WHERE school_id = ? AND status IN ('pending', 'processing')");
    $stmt->execute([$data['school_id']]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existing) {
        logApi("Info: Déploiement déjà en cours - Queue ID: {$existing['id']}, Status: {$existing['status']}");
        echo json_encode([
            'success' => true,
            'message' => 'Un déploiement est déjà en cours pour cette école',
            'queue_id' => $existing['id'],
            'status' => $existing['status'],
            'already_queued' => true
        ]);
        exit;
    }
    
    // Vérifier si le container existe déjà
    // Note: On ne peut pas vérifier Docker depuis PHP, mais on peut vérifier
    // si un déploiement a déjà réussi
    $stmt = $pdo->prepare("SELECT id FROM school_deploy_queue 
                          WHERE school_id = ? AND status = 'completed'");
    $stmt->execute([$data['school_id']]);
    if ($stmt->fetch()) {
        logApi("Info: École déjà déployée - School ID: {$data['school_id']}");
        echo json_encode([
            'success' => true,
            'message' => 'Cette école a déjà été déployée',
            'already_deployed' => true
        ]);
        exit;
    }
    
    // Insérer dans la queue
    $stmt = $pdo->prepare("INSERT INTO school_deploy_queue 
        (school_id, slug, domain, name, status, attempts, created_at) 
        VALUES (?, ?, ?, ?, 'pending', 0, NOW())");
    
    $stmt->execute([
        $data['school_id'],
        $slug,
        $domain,
        $data['name']
    ]);
    
    $queueId = $pdo->lastInsertId();
    
    logApi("Succès: École ajoutée à la queue - Queue ID: $queueId");
    
    echo json_encode([
        'success' => true,
        'message' => 'École ajoutée à la queue de déploiement',
        'queue_id' => $queueId,
        'status' => 'pending',
        'estimated_time' => '1-2 minutes'
    ]);
    
} catch (PDOException $e) {
    logApi("Erreur DB: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'error' => 'Erreur de base de données',
        'details' => $e->getMessage()
    ]);
}
