-- ============================================================
-- TABLA DE INSCRIPCIONES DE ESTUDIANTES - COMPLETA
-- ============================================================

CREATE TABLE IF NOT EXISTS inscripciones_estudiantes (
    id SERIAL PRIMARY KEY,
    school_id INTEGER NOT NULL,
    
    -- Datos del estudiante
    nombre_estudiante VARCHAR(200) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    grado VARCHAR(50) NOT NULL,
    tipo_documento VARCHAR(20) DEFAULT 'RC',
    numero_documento VARCHAR(50) NOT NULL,
    lugar_nacimiento VARCHAR(100),
    
    -- Colegio de procedencia
    colegio_procedencia VARCHAR(200),
    direccion_colegio_anterior VARCHAR(300),
    telefono_colegio_anterior VARCHAR(50),
    motivo_retiro TEXT,
    
    -- Acudiente 1 (principal)
    nombre_acudiente1 VARCHAR(200) NOT NULL,
    email_acudiente1 VARCHAR(100) NOT NULL,
    telefono_acudiente1 VARCHAR(50) NOT NULL,
    parentesco_acudiente1 VARCHAR(50) NOT NULL,
    profesion_acudiente1 VARCHAR(100),
    empresa_acudiente1 VARCHAR(100),
    direccion_acudiente1 VARCHAR(300) NOT NULL,
    ciudad_acudiente1 VARCHAR(100) NOT NULL,
    pais_acudiente1 VARCHAR(2) DEFAULT 'CO',
    
    -- Acudiente 2 (opcional)
    nombre_acudiente2 VARCHAR(200),
    email_acudiente2 VARCHAR(100),
    telefono_acudiente2 VARCHAR(50),
    parentesco_acudiente2 VARCHAR(50),
    profesion_acudiente2 VARCHAR(100),
    empresa_acudiente2 VARCHAR(100),
    direccion_acudiente2 VARCHAR(300),
    ciudad_acudiente2 VARCHAR(100),
    pais_acudiente2 VARCHAR(2),
    
    -- Documentos (URLs en S3)
    boletin_1_url VARCHAR(500),
    boletin_2_url VARCHAR(500),
    boletin_3_url VARCHAR(500),
    carta_motivacion_url VARCHAR(500),
    
    -- Preferencias
    idioma_preferido VARCHAR(5) DEFAULT 'es',
    
    -- Metadata
    estado VARCHAR(20) DEFAULT 'pendiente',
    notas_admin TEXT,
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Índices
    CONSTRAINT idx_school_id FOREIGN KEY (school_id) REFERENCES schools(id) ON DELETE CASCADE
);

-- Índices adicionales
CREATE INDEX IF NOT EXISTS idx_inscripciones_school ON inscripciones_estudiantes(school_id);
CREATE INDEX IF NOT EXISTS idx_inscripciones_email ON inscripciones_estudiantes(email_acudiente1);
CREATE INDEX IF NOT EXISTS idx_inscripciones_fecha ON inscripciones_estudiantes(created_at);
CREATE INDEX IF NOT EXISTS idx_inscripciones_estado ON inscripciones_estudiantes(estado);

-- ============================================================
-- TABLA DE ESCUELAS (si no existe)
-- ============================================================

CREATE TABLE IF NOT EXISTS schools (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE,
    slug VARCHAR(150) NOT NULL UNIQUE,
    dominio VARCHAR(150),
    email_director VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    ciudad VARCHAR(100),
    pais VARCHAR(2) DEFAULT 'CO',
    color_primario VARCHAR(7) DEFAULT '#6366f1',
    color_secundario VARCHAR(7) DEFAULT '#8b5cf6',
    logo_url VARCHAR(500),
    estado VARCHAR(20) DEFAULT 'activa',
    trial_hasta DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_schools_slug ON schools(slug);
CREATE INDEX IF NOT EXISTS idx_schools_dominio ON schools(dominio);

-- Insertar escuela de demo si no existe
INSERT INTO schools (nombre, slug, dominio, email_director, trial_hasta)
VALUES ('Colegio Demo', 'demo', 'demo.henrimorel.com', 'demo@example.com', '2025-12-31')
ON CONFLICT (slug) DO NOTHING;

-- ============================================================
-- FUNCIÓN PARA ACTUALIZAR updated_at
-- ============================================================

CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ language 'plpgsql';

-- Trigger para inscripciones
DROP TRIGGER IF EXISTS update_inscripciones_updated_at ON inscripciones_estudiantes;
CREATE TRIGGER update_inscripciones_updated_at
    BEFORE UPDATE ON inscripciones_estudiantes
    FOR EACH ROW
    EXECUTE FUNCTION update_updated_at_column();

-- Trigger para schools
DROP TRIGGER IF EXISTS update_schools_updated_at ON schools;
CREATE TRIGGER update_schools_updated_at
    BEFORE UPDATE ON schools
    FOR EACH ROW
    EXECUTE FUNCTION update_updated_at_column();
