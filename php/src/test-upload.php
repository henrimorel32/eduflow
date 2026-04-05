<?php
/**
 * Test d'upload de logo
 */

require_once __DIR__ . '/components/StorageManager.php';

echo "<h1>Test Upload Logo</h1>";
echo "<pre>";

// Vérifier si AWS SDK est installé
echo "AWS SDK installé: " . (class_exists('Aws\S3\S3Client') ? 'OUI' : 'NON') . "\n";

// Vérifier les variables d'environnement
echo "OVH_S3_ACCESS_KEY: " . (getenv('OVH_S3_ACCESS_KEY') ? 'DEFINI' : 'NON DEFINI') . "\n";
echo "OVH_S3_SECRET_KEY: " . (getenv('OVH_S3_SECRET_KEY') ? 'DEFINI' : 'NON DEFINI') . "\n";
echo "OVH_S3_BUCKET: " . getenv('OVH_S3_BUCKET') . "\n";

// Vérifier le répertoire uploads
$uploadDir = __DIR__ . '/uploads/logos/';
echo "\nRépertoire uploads/logos: " . (is_dir($uploadDir) ? 'EXISTE' : 'INEXISTANT') . "\n";
echo "Writable: " . (is_writable($uploadDir) ? 'OUI' : 'NON') . "\n";

// Test upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['logo'])) {
    echo "\n=== TEST UPLOAD ===\n";
    echo "Fichier reçu: " . $_FILES['logo']['name'] . "\n";
    echo "Type: " . $_FILES['logo']['type'] . "\n";
    echo "Taille: " . $_FILES['logo']['size'] . " bytes\n";
    echo "Tmp: " . $_FILES['logo']['tmp_name'] . "\n";
    echo "Error code: " . $_FILES['logo']['error'] . "\n\n";
    
    if ($_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $storage = new StorageManager();
        $result = $storage->uploadSchoolLogo(
            $_FILES['logo']['tmp_name'],
            $_FILES['logo']['name'],
            'test-school'
        );
        
        echo "Résultat: " . ($result ?: "NULL/FAUX") . "\n";
        
        if (!$result) {
            echo "\nERREURS:\n";
            print_r($storage->getErrors());
        }
    } else {
        echo "Erreur upload PHP: " . $_FILES['logo']['error'];
    }
}

echo "</pre>";
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="logo" accept="image/*" required>
    <button type="submit">Tester l'upload</button>
</form>
