<?php
/**
 * Gestionnaire de stockage OVH Object Storage (S3 compatible)
 * Pour stocker les logos et favicons des écoles
 */

class StorageManager {
    
    private string $endpoint;
    private string $accessKey;
    private string $secretKey;
    private string $bucket;
    private string $region;
    private array $errors = [];
    
    public function __construct() {
        // Configuration OVH S3
        $this->endpoint = getenv('OVH_S3_ENDPOINT') ?: 'https://s3.gra.io.cloud.ovh.net/';
        $this->accessKey = getenv('OVH_S3_ACCESS_KEY') ?: '';
        $this->secretKey = getenv('OVH_S3_SECRET_KEY') ?: '';
        $this->bucket = getenv('OVH_S3_BUCKET') ?: 'tan-chu';
        $this->region = getenv('OVH_S3_REGION') ?: 'gra';
    }
    
    /**
     * Retourne les erreurs rencontrées
     */
    public function getErrors(): array {
        return $this->errors;
    }
    
    /**
     * Upload un logo d'école avec traitement et génère le favicon
     * Retourne un tableau avec logo_url et favicon_url
     */
    public function uploadSchoolLogo(string $tmpPath, string $originalName, string $schoolSlug): array {
        
        $this->errors = [];
        $result = ['logo_url' => null, 'favicon_url' => null];
        
        // Vérifier que le fichier existe
        if (!file_exists($tmpPath)) {
            $this->errors[] = "Fichier temporaire non trouvé: $tmpPath";
            error_log("StorageManager: " . end($this->errors));
            return $result;
        }
        
        // Note: Les clés S3 sont optionnelles - on fait du fallback local si non configurées
        $s3Configured = !empty($this->accessKey) && !empty($this->secretKey);
        if (!$s3Configured) {
            error_log("StorageManager: Clés OVH S3 non configurées - utilisation du stockage local");
        }
        
        // Vérifier le type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tmpPath);
        finfo_close($finfo);
        
        if (!in_array($mimeType, $allowedTypes)) {
            $this->errors[] = "Type de fichier non autorisé: $mimeType";
            error_log("StorageManager: " . end($this->errors));
            return $result;
        }
        
        // Vérifier la taille (max 2MB)
        $fileSize = filesize($tmpPath);
        if ($fileSize > 2 * 1024 * 1024) {
            $this->errors[] = "Fichier trop volumineux (max 2MB)";
            error_log("StorageManager: " . end($this->errors));
            return $result;
        }
        
        // Générer un nom unique
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $extension = 'png';
        }
        
        $logoName = 'logos/' . $schoolSlug . '_' . uniqid() . '.' . $extension;
        $faviconName = 'favicons/' . $schoolSlug . '_' . uniqid() . '.ico';
        
        // Générer le favicon à partir du logo
        $faviconPath = $this->generateFavicon($tmpPath, $schoolSlug);
        
        // Essayer avec AWS SDK si disponible
        if (class_exists('Aws\S3\S3Client') && !empty($this->accessKey) && !empty($this->secretKey)) {
            error_log("StorageManager: Tentative upload S3");
            
            // Upload du logo
            $logoUrl = $this->uploadWithSDK($tmpPath, $logoName, $mimeType);
            if ($logoUrl) {
                $result['logo_url'] = $logoUrl;
            }
            
            // Upload du favicon s'il a été généré
            if ($faviconPath && file_exists($faviconPath)) {
                $faviconUrl = $this->uploadWithSDK($faviconPath, $faviconName, 'image/x-icon');
                if ($faviconUrl) {
                    $result['favicon_url'] = $faviconUrl;
                }
                // Nettoyer le fichier temporaire du favicon
                unlink($faviconPath);
            }
            
            if ($result['logo_url']) {
                return $result;
            }
            error_log("StorageManager: S3 a échoué, fallback local");
        } else {
            error_log("StorageManager: AWS SDK non disponible ou clés non configurées");
        }
        
        // Fallback: Toujours sauvegarder localement
        error_log("StorageManager: Fallback vers stockage local");
        $localLogo = $this->uploadLocal($tmpPath, $logoName, $originalName);
        if ($localLogo) {
            $result['logo_url'] = $localLogo;
        }
        
        // Fallback favicon local
        if ($faviconPath && file_exists($faviconPath)) {
            $localFavicon = $this->uploadLocal($faviconPath, $faviconName, 'favicon.ico');
            if ($localFavicon) {
                $result['favicon_url'] = $localFavicon;
            }
            unlink($faviconPath);
        }
        
        return $result;
    }
    
    /**
     * Génère un favicon à partir d'une image source
     */
    private function generateFavicon(string $sourcePath, string $schoolSlug): string|false {
        
        // Vérifier que GD est disponible
        if (!extension_loaded('gd')) {
            error_log("StorageManager: Extension GD non disponible, favicon non généré");
            return false;
        }
        
        try {
            // Charger l'image source
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $sourcePath);
            finfo_close($finfo);
            
            switch ($mimeType) {
                case 'image/jpeg':
                    $sourceImage = @imagecreatefromjpeg($sourcePath);
                    break;
                case 'image/png':
                    $sourceImage = @imagecreatefrompng($sourcePath);
                    break;
                case 'image/gif':
                    $sourceImage = @imagecreatefromgif($sourcePath);
                    break;
                case 'image/webp':
                    $sourceImage = @imagecreatefromwebp($sourcePath);
                    break;
                default:
                    error_log("StorageManager: Format non supporté pour favicon: $mimeType");
                    return false;
            }
            
            if (!$sourceImage) {
                error_log("StorageManager: Impossible de charger l'image pour le favicon");
                return false;
            }
            
            // Créer une image carrée de 64x64 (taille standard favicon)
            $size = 64;
            $favicon = imagecreatetruecolor($size, $size);
            
            // Préserver la transparence pour PNG
            imagealphablending($favicon, false);
            imagesavealpha($favicon, true);
            $transparent = imagecolorallocatealpha($favicon, 255, 255, 255, 127);
            imagefill($favicon, 0, 0, $transparent);
            
            // Redimensionner l'image source en carré (crop centré)
            $srcWidth = imagesx($sourceImage);
            $srcHeight = imagesy($sourceImage);
            
            // Calculer les dimensions pour un crop carré centré
            if ($srcWidth > $srcHeight) {
                $cropSize = $srcHeight;
                $srcX = ($srcWidth - $srcHeight) / 2;
                $srcY = 0;
            } else {
                $cropSize = $srcWidth;
                $srcX = 0;
                $srcY = ($srcHeight - $srcWidth) / 2;
            }
            
            // Redimensionner avec crop centré
            imagecopyresampled(
                $favicon, $sourceImage,
                0, 0, $srcX, $srcY,
                $size, $size, $cropSize, $cropSize
            );
            
            // Sauvegarder le favicon
            $tempDir = sys_get_temp_dir() . '/school_favicons/';
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0755, true);
            }
            
            $faviconPath = $tempDir . $schoolSlug . '_favicon.ico';
            
            // Sauvegarder en PNG (plus compatible que ICO avec la plupart des navigateurs)
            $pngPath = $tempDir . $schoolSlug . '_favicon.png';
            imagepng($favicon, $pngPath, 9);
            
            // Libérer la mémoire
            imagedestroy($sourceImage);
            imagedestroy($favicon);
            
            error_log("StorageManager: Favicon généré avec succès: $pngPath");
            return $pngPath;
            
        } catch (Exception $e) {
            error_log("StorageManager: Erreur génération favicon: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Upload avec AWS SDK
     */
    public function uploadWithSDK(string $localPath, string $remoteName, string $contentType): string|false {
        
        try {
            $s3 = new \Aws\S3\S3Client([
                'version' => 'latest',
                'region'  => $this->region,
                'endpoint' => $this->endpoint,
                'credentials' => [
                    'key'    => $this->accessKey,
                    'secret' => $this->secretKey,
                ],
            ]);
            
            $result = $s3->putObject([
                'Bucket' => $this->bucket,
                'Key'    => $remoteName,
                'SourceFile' => $localPath,
                'ContentType' => $contentType,
                'ACL'    => 'public-read'
            ]);
            
            error_log("StorageManager: Upload S3 réussi - " . $result['ObjectURL']);
            return $result['ObjectURL'];
            
        } catch (Exception $e) {
            $this->errors[] = "AWS SDK Error: " . $e->getMessage();
            error_log("StorageManager: " . end($this->errors));
            return false;
        }
    }
    
    /**
     * Fallback: Sauvegarder le fichier localement
     */
    private function uploadLocal(string $tmpPath, string $remoteName, string $originalName): string|false {
        
        $uploadDir = __DIR__ . '/../uploads/' . dirname($remoteName) . '/';
        
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                $this->errors[] = "Impossible de créer le répertoire: $uploadDir";
                error_log("StorageManager: " . end($this->errors));
                return false;
            }
        }
        
        $localFileName = basename($remoteName);
        $destination = $uploadDir . $localFileName;
        
        // Si c'est un fichier uploadé, utiliser move_uploaded_file
        if (is_uploaded_file($tmpPath)) {
            if (move_uploaded_file($tmpPath, $destination)) {
                $url = '/uploads/' . dirname($remoteName) . '/' . $localFileName;
                error_log("StorageManager: Stockage local réussi - $url");
                return $url;
            }
        }
        
        // Sinon utiliser copy
        if (copy($tmpPath, $destination)) {
            $url = '/uploads/' . dirname($remoteName) . '/' . $localFileName;
            error_log("StorageManager: Stockage local (copy) réussi - $url");
            return $url;
        }
        
        $this->errors[] = "Échec du stockage local";
        error_log("StorageManager: " . end($this->errors));
        return false;
    }
    
    /**
     * Génère une URL publique pour un fichier S3
     */
    public function getPublicUrl(string $key): string {
        return 'https://' . $this->bucket . '.s3.gra.io.cloud.ovh.net/' . $key;
    }
}
