-- ============================================================
-- TABLE: Queue de déploiement des écoles
-- ============================================================
-- Cette table permet de créer les containers Docker de manière
-- asynchrone via un cron, sans donner d'accès Docker au PHP
-- ============================================================

SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';

USE edu_platform;

-- Table pour la queue de déploiement
CREATE TABLE IF NOT EXISTS school_deploy_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    school_id INT NOT NULL,
    slug VARCHAR(150) NOT NULL,
    domain VARCHAR(255) NOT NULL,
    name VARCHAR(150) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'failed') DEFAULT 'pending',
    
    -- Logs et résultats
    output_log TEXT,
    error_message TEXT,
    attempts INT DEFAULT 0,
    max_attempts INT DEFAULT 3,
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    
    -- Index pour performance
    INDEX idx_status_created (status, created_at),
    INDEX idx_school_id (school_id),
    INDEX idx_slug (slug),
    
    -- Clé étrangère optionnelle (peut être null si school supprimée)
    FOREIGN KEY (school_id) REFERENCES suscripciones_escuelas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table pour l'historique des déploiements (archivage)
CREATE TABLE IF NOT EXISTS school_deploy_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    school_id INT NOT NULL,
    slug VARCHAR(150) NOT NULL,
    domain VARCHAR(255) NOT NULL,
    action VARCHAR(50) NOT NULL, -- 'create', 'restart', 'delete'
    status VARCHAR(20) NOT NULL,
    output_log TEXT,
    error_message TEXT,
    executed_by VARCHAR(100), -- 'cron', 'manual', 'api'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_school_id (school_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Vue pour voir les déploiements en attente
CREATE OR REPLACE VIEW school_deploy_pending AS
SELECT 
    q.id,
    q.school_id,
    q.slug,
    q.domain,
    q.name,
    q.status,
    q.attempts,
    q.created_at,
    TIMESTAMPDIFF(MINUTE, q.created_at, NOW()) as minutes_waiting,
    s.nombre_escuela,
    s.email
FROM school_deploy_queue q
LEFT JOIN suscripciones_escuelas s ON q.school_id = s.id
WHERE q.status IN ('pending', 'processing')
ORDER BY q.created_at ASC;

-- ============================================================
-- NOTES
-- ============================================================
-- school_deploy_queue : Queue de création asynchrone des containers Docker
-- school_deploy_history : Historique des opérations de déploiement
