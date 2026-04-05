<?php
/**
 * Script de test pour vérifier la configuration S3
 * Accéder à ce fichier via: https://votresite.com/test-s3.php
 */

require_once __DIR__ . '/components/StorageManager.php';

echo "<h1>Test Configuration S3</h1>";

// Test 1: Vérifier les variables d'environnement
echo "<h2>1. Variables d'environnement</h2>";
echo "OVH_S3_ENDPOINT: " . (getenv('OVH_S3_ENDPOINT') ?: 'NON DEFINI') . "<br>";
echo "OVH_S3_ACCESS_KEY: " . (getenv('OVH_S3_ACCESS_KEY') ? substr(getenv('OVH_S3_ACCESS_KEY'), 0, 10) . '...' : 'NON DEFINI') . "<br>";
echo "OVH_S3_SECRET_KEY: " . (getenv('OVH_S3_SECRET_KEY') ? 'DEFINI (' . strlen(getenv('OVH_S3_SECRET_KEY')) . ' chars)' : 'NON DEFINI') . "<br>";
echo "OVH_S3_BUCKET: " . (getenv('OVH_S3_BUCKET') ?: 'NON DEFINI') . "<br>";
echo "OVH_S3_REGION: " . (getenv('OVH_S3_REGION') ?: 'NON DEFINI') . "<br>";

// Test 2: Vérifier si AWS SDK est installé
echo "<h2>2. AWS SDK</h2>";
if (class_exists('Aws\S3\S3Client')) {
    echo "✅ AWS SDK est installé<br>";
} else {
    echo "❌ AWS SDK n'est PAS installé<br>";
    echo "Pour l'installer: <code>composer require aws/aws-sdk-php</code><br>";
}

// Test 3: Tester l'upload
echo "<h2>3. Test d'upload</h2>";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_file'])) {
    $storage = new StorageManager();
    $result = $storage->uploadSchoolLogo(
        $_FILES['test_file']['tmp_name'],
        $_FILES['test_file']['name'],
        'test-school'
    );
    
    if ($result) {
        echo "✅ Upload réussi!<br>";
        echo "URL: $result<br>";
    } else {
        echo "❌ Échec de l'upload<br>";
        echo "Erreurs:<br><pre>";
        print_r($storage->getErrors());
        echo "</pre>";
    }
}

// Formulaire de test
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<input type='file' name='test_file' accept='image/*' required><br><br>";
echo "<button type='submit'>Tester l'upload</button>";
echo "</form>";

// Informations PHP
echo "<h2>4. Informations PHP</h2>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "<br>";

// Répertoire uploads
echo "<h2>5. Répertoire uploads</h2>";
$uploadDir = __DIR__ . '/uploads/logos/';
if (is_dir($uploadDir)) {
    echo "✅ Le répertoire existe: $uploadDir<br>";
    echo "Permissions: " . substr(sprintf('%o', fileperms($uploadDir)), -4) . "<br>";
    if (is_writable($uploadDir)) {
        echo "✅ Le répertoire est accessible en écriture<br>";
    } else {
        echo "❌ Le répertoire N'est PAS accessible en écriture<br>";
    }
} else {
    echo "❌ Le répertoire n'existe PAS: $uploadDir<br>";
}
