-- =====================================================
-- MODIFICACIÓN TABLA INSCRIPCIONES - 3 NACIONALIDADES
-- =====================================================

-- Añadir campos para nacionalidades 2 y 3
ALTER TABLE inscripciones 
ADD COLUMN alumno_nacionalidad_2 VARCHAR(50) DEFAULT NULL AFTER alumno_nacionalidad,
ADD COLUMN alumno_nacionalidad_3 VARCHAR(50) DEFAULT NULL AFTER alumno_nacionalidad_2;

-- Modificar la consulta INSERT en PHP para incluir las 3 nacionalidades
-- (ya está incluido en el código PHP generado anteriormente)

-- =====================================================
-- DATOS DE EJEMPLO / DEMO
-- =====================================================

-- Insertar algunas inscripciones de ejemplo para mostrar funcionalidad
-- (Opcional - para testing)

INSERT INTO inscripciones (
    fecha_inscripcion, idioma_inscripcion, estado_inscripcion,
    alumno_nombres, alumno_apellido1, alumno_apellido2,
    alumno_fecha_nacimiento, alumno_nacionalidad, alumno_nacionalidad_2, alumno_nacionalidad_3,
    alumno_grado_inscripcion,
    alumno_anterior_institucion, alumno_anterior_ciudad, alumno_anterior_pais,
    acudiente1_nombres, acudiente1_apellido1, acudiente1_apellido2,
    acudiente1_direccion, acudiente1_ciudad, acudiente1_profesion,
    acudiente1_empresa, acudiente1_pais, acudiente1_prefijo, acudiente1_telefono,
    acudiente1_email, acudiente1_parentesco,
    observaciones
) VALUES 
(
    NOW(), 'es', 'pendiente',
    'María Camila', 'Rodríguez', 'Gómez',
    '2015-03-15', 'Colombiano/a', NULL, NULL,
    'Quinto',
    'Colegio San José', 'Bogotá', 'CO',
    'Carlos Andrés', 'Rodríguez', 'Pérez',
    'Calle 123 # 45-67', 'Bogotá', 'Ingeniero',
    'Empresa ABC', 'CO', '+57', '3101234567',
    'carlos.rodriguez@email.com', 'Padre',
    'Inscripción de ejemplo para testing'
),
(
    NOW(), 'br', 'pendiente',
    'João Pedro', 'Silva', 'Santos',
    '2014-07-22', 'Brasileño/a', 'Italiano/a', NULL,
    'Sexto',
    'Escola Primária São Paulo', 'São Paulo', 'BR',
    'Ana Maria', 'Silva', 'Oliveira',
    'Rua das Flores, 456', 'São Paulo', 'Médica',
    'Hospital das Clínicas', 'BR', '+55', '11987654321',
    'ana.silva@email.com', 'Madre',
    'Ejemplo con doble nacionalidad'
);