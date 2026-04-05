
# 5. Configuration de connexion à la base de données
config_php = '''<?php
// Configuration de la base de données
$db_host = getenv('DB_HOST') ?: 'mysql';
$db_name = getenv('DB_NAME') ?: 'edu_platform';
$db_user = getenv('DB_USER') ?: 'edu_user';
$db_pass = getenv('DB_PASS') ?: 'edu_password';
$db_port = getenv('DB_PORT') ?: '3306';

// Connexion PDO
try {
    $pdo = new PDO(
        "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// Fonction pour récupérer le contenu de la page
function getContenido($pdo, $seccion, $clave) {
    $stmt = $pdo->prepare("SELECT valor FROM contenido_web WHERE seccion = ? AND clave = ?");
    $stmt->execute([$seccion, $clave]);
    $result = $stmt->fetch();
    return $result ? $result['valor'] : '';
}
?>
'''

with open('/Users/henri/Documents/GitHub/ESchool/php/src/includes/config.php', 'w') as f:
    f.write(config_php)

print("✅ Configuration PHP créée")
