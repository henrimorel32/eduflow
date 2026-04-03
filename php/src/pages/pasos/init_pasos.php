<?php
declare(strict_types=1);

// Configuration des langues
$idiomas = [
    'es' => ['nombre' => 'Español', 'bandera' => '🇨🇴'],
    'br' => ['nombre' => 'Português', 'bandera' => '🇧🇷'],
    'en' => ['nombre' => 'English', 'bandera' => '🇺🇸'],
    'fr' => ['nombre' => 'Français', 'bandera' => '🇫🇷']
];

// Détection de la langue
$idioma_actual = $_GET['lang'] ?? $_SESSION['lang'] ?? 'es';
if (!isset($idiomas[$idioma_actual])) $idioma_actual = 'es';
$_SESSION['lang'] = $idioma_actual;

// Fonction de traduction depuis la base contenido_web
function t(string $clave, string $seccion = 'general'): string {
    global $idioma_actual, $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT valor FROM contenido_web WHERE seccion = ? AND clave = ? AND idioma = ? LIMIT 1");
        $stmt->execute([$seccion, $clave, $idioma_actual]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['valor'] ?? $clave;
    } catch (PDOException $e) {
        return $clave;
    }
}

// Données pour les selects
$paises_america = [
    'CO' => ['es' => 'Colombia', 'br' => 'Colômbia', 'en' => 'Colombia', 'fr' => 'Colombie'],
    'AR' => ['es' => 'Argentina', 'br' => 'Argentina', 'en' => 'Argentina', 'fr' => 'Argentine'],
    'BO' => ['es' => 'Bolivia', 'br' => 'Bolívia', 'en' => 'Bolivia', 'fr' => 'Bolivie'],
    'BR' => ['es' => 'Brasil', 'br' => 'Brasil', 'en' => 'Brazil', 'fr' => 'Brésil'],
    'CA' => ['es' => 'Canadá', 'br' => 'Canadá', 'en' => 'Canada', 'fr' => 'Canada'],
    'CL' => ['es' => 'Chile', 'br' => 'Chile', 'en' => 'Chile', 'fr' => 'Chili'],
    'CR' => ['es' => 'Costa Rica', 'br' => 'Costa Rica', 'en' => 'Costa Rica', 'fr' => 'Costa Rica'],
    'CU' => ['es' => 'Cuba', 'br' => 'Cuba', 'en' => 'Cuba', 'fr' => 'Cuba'],
    'EC' => ['es' => 'Ecuador', 'br' => 'Equador', 'en' => 'Ecuador', 'fr' => 'Équateur'],
    'SV' => ['es' => 'El Salvador', 'br' => 'El Salvador', 'en' => 'El Salvador', 'fr' => 'Salvador'],
    'US' => ['es' => 'Estados Unidos', 'br' => 'Estados Unidos', 'en' => 'United States', 'fr' => 'États-Unis'],
    'GT' => ['es' => 'Guatemala', 'br' => 'Guatemala', 'en' => 'Guatemala', 'fr' => 'Guatemala'],
    'HT' => ['es' => 'Haití', 'br' => 'Haiti', 'en' => 'Haiti', 'fr' => 'Haïti'],
    'HN' => ['es' => 'Honduras', 'br' => 'Honduras', 'en' => 'Honduras', 'fr' => 'Honduras'],
    'MX' => ['es' => 'México', 'br' => 'México', 'en' => 'Mexico', 'fr' => 'Mexique'],
    'NI' => ['es' => 'Nicaragua', 'br' => 'Nicarágua', 'en' => 'Nicaragua', 'fr' => 'Nicaragua'],
    'PA' => ['es' => 'Panamá', 'br' => 'Panamá', 'en' => 'Panama', 'fr' => 'Panama'],
    'PY' => ['es' => 'Paraguay', 'br' => 'Paraguai', 'en' => 'Paraguay', 'fr' => 'Paraguay'],
    'PE' => ['es' => 'Perú', 'br' => 'Peru', 'en' => 'Peru', 'fr' => 'Pérou'],
    'PR' => ['es' => 'Puerto Rico', 'br' => 'Porto Rico', 'en' => 'Puerto Rico', 'fr' => 'Porto Rico'],
    'DO' => ['es' => 'República Dominicana', 'br' => 'República Dominicana', 'en' => 'Dominican Republic', 'fr' => 'République Dominicaine'],
    'UY' => ['es' => 'Uruguay', 'br' => 'Uruguai', 'en' => 'Uruguay', 'fr' => 'Uruguay'],
    'VE' => ['es' => 'Venezuela', 'br' => 'Venezuela', 'en' => 'Venezuela', 'fr' => 'Venezuela'],
    'JM' => ['es' => 'Jamaica', 'br' => 'Jamaica', 'en' => 'Jamaica', 'fr' => 'Jamaïque'],
    'TT' => ['es' => 'Trinidad y Tobago', 'br' => 'Trinidad e Tobago', 'en' => 'Trinidad and Tobago', 'fr' => 'Trinité-et-Tobago'],
    'BS' => ['es' => 'Bahamas', 'br' => 'Bahamas', 'en' => 'Bahamas', 'fr' => 'Bahamas'],
    'BZ' => ['es' => 'Belice', 'br' => 'Belize', 'en' => 'Belize', 'fr' => 'Belize'],
    'GY' => ['es' => 'Guyana', 'br' => 'Guiana', 'en' => 'Guyana', 'fr' => 'Guyana'],
    'SR' => ['es' => 'Surinam', 'br' => 'Suriname', 'en' => 'Suriname', 'fr' => 'Suriname'],
    'GF' => ['es' => 'Guayana Francesa', 'br' => 'Guiana Francesa', 'en' => 'French Guiana', 'fr' => 'Guyane française'],
    'FK' => ['es' => 'Islas Malvinas', 'br' => 'Ilhas Malvinas', 'en' => 'Falkland Islands', 'fr' => 'Îles Malouines'],
    'GL' => ['es' => 'Groenlandia', 'br' => 'Groenlândia', 'en' => 'Greenland', 'fr' => 'Groenland']
];

$prefijos_telefonicos = [
    '+57' => ['pais' => 'CO', 'nombre' => 'Colombia'],
    '+55' => ['pais' => 'BR', 'nombre' => 'Brasil'],
    '+51' => ['pais' => 'PE', 'nombre' => 'Perú'],
    '+52' => ['pais' => 'MX', 'nombre' => 'México'],
    '+54' => ['pais' => 'AR', 'nombre' => 'Argentina'],
    '+56' => ['pais' => 'CL', 'nombre' => 'Chile'],
    '+58' => ['pais' => 'VE', 'nombre' => 'Venezuela'],
    '+593' => ['pais' => 'EC', 'nombre' => 'Ecuador'],
    '+595' => ['pais' => 'PY', 'nombre' => 'Paraguay'],
    '+598' => ['pais' => 'UY', 'nombre' => 'Uruguay'],
    '+591' => ['pais' => 'BO', 'nombre' => 'Bolivia'],
    '+506' => ['pais' => 'CR', 'nombre' => 'Costa Rica'],
    '+507' => ['pais' => 'PA', 'nombre' => 'Panamá'],
    '+503' => ['pais' => 'SV', 'nombre' => 'El Salvador'],
    '+502' => ['pais' => 'GT', 'nombre' => 'Guatemala'],
    '+504' => ['pais' => 'HN', 'nombre' => 'Honduras'],
    '+505' => ['pais' => 'NI', 'nombre' => 'Nicaragua'],
    '+53' => ['pais' => 'CU', 'nombre' => 'Cuba'],
    '+1' => ['pais' => 'US', 'nombre' => 'USA/Canadá'],
    '+44' => ['pais' => 'GB', 'nombre' => 'Reino Unido'],
    '+33' => ['pais' => 'FR', 'nombre' => 'Francia'],
    '+49' => ['pais' => 'DE', 'nombre' => 'Alemania'],
    '+34' => ['pais' => 'ES', 'nombre' => 'España'],
    '+39' => ['pais' => 'IT', 'nombre' => 'Italia'],
    '+351' => ['pais' => 'PT', 'nombre' => 'Portugal']
];

$grados = [
    'es' => ['Prejardín', 'Jardín', 'Transición', 'Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto', 'Séptimo', 'Octavo', 'Noveno', 'Décimo', 'Undécimo'],
    'br' => ['Pré-jardim', 'Jardim', 'Transição', 'Primeiro', 'Segundo', 'Terceiro', 'Quarto', 'Quinto', 'Sexto', 'Sétimo', 'Oitavo', 'Nono', 'Décimo', 'Décimo Primeiro'],
    'en' => ['Pre-kindergarten', 'Kindergarten', 'Transition', 'First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth', 'Eleventh'],
    'fr' => ['Pré-jardin', 'Jardin', 'Transition', 'Première', 'Deuxième', 'Troisième', 'Quatrième', 'Cinquième', 'Sixième', 'Septième', 'Huitième', 'Neuvième', 'Dixième', 'Onzième']
];

$nacionalidades = [
    'es' => ['Colombiano/a', 'Argentino/a', 'Boliviano/a', 'Brasileño/a', 'Chileno/a', 'Costarricense', 'Cubano/a', 'Ecuatoriano/a', 'Salvadoreño/a', 'Guatemalteco/a', 'Hondureño/a', 'Mexicano/a', 'Nicaragüense', 'Panameño/a', 'Paraguayo/a', 'Peruano/a', 'Dominicano/a', 'Uruguayo/a', 'Venezolano/a', 'Estadounidense', 'Canadiense', 'Español/a', 'Francés/Francesa', 'Portugués/Portuguesa', 'Italiano/a', 'Alemán/Alemana', 'Británico/a', 'Jamaicano/a', 'Haitiano/a', 'Beliceño/a', 'Guyanés/Guyanesa', 'Surinamés/Surinamesa', 'Trinitense', 'Bahameño/a', 'Otra'],
    'br' => ['Colombiano/a', 'Argentino/a', 'Boliviano/a', 'Brasileiro/a', 'Chileno/a', 'Costarriquenho/a', 'Cubano/a', 'Equatoriano/a', 'Salvadorenho/a', 'Guatemalteco/a', 'Hondurenho/a', 'Mexicano/a', 'Nicaraguense', 'Panamenho/a', 'Paraguaio/a', 'Peruano/a', 'Dominicano/a', 'Uruguaio/a', 'Venezuelano/a', 'Norte-americano/a', 'Canadense', 'Espanhol/a', 'Francês/Francesa', 'Português/Portuguesa', 'Italiano/a', 'Alemão/Alemã', 'Britânico/a', 'Jamaicano/a', 'Haitiano/a', 'Belizenho/a', 'Guianense', 'Surinamês/Surinamesa', 'Trinitário/a', 'Bahamense', 'Outra'],
    'en' => ['Colombian', 'Argentinian', 'Bolivian', 'Brazilian', 'Chilean', 'Costa Rican', 'Cuban', 'Ecuadorian', 'Salvadoran', 'Guatemalan', 'Honduran', 'Mexican', 'Nicaraguan', 'Panamanian', 'Paraguayan', 'Peruvian', 'Dominican', 'Uruguayan', 'Venezuelan', 'American', 'Canadian', 'Spanish', 'French', 'Portuguese', 'Italian', 'German', 'British', 'Jamaican', 'Haitian', 'Belizean', 'Guyanese', 'Surinamese', 'Trinidadian', 'Bahamian', 'Other'],
    'fr' => ['Colombien/ne', 'Argentin/e', 'Bolivien/ne', 'Brésilien/ne', 'Chilien/ne', 'Costaricain/e', 'Cubain/e', 'Équatorien/ne', 'Salvadorien/ne', 'Guatémaltèque', 'Hondurien/ne', 'Mexicain/e', 'Nicaraguayen/ne', 'Panaméen/ne', 'Paraguayen/ne', 'Péruvien/ne', 'Dominicain/e', 'Uruguayen/ne', 'Vénézuélien/ne', 'Américain/e', 'Canadien/ne', 'Espagnol/e', 'Français/e', 'Portugais/e', 'Italien/ne', 'Allemand/e', 'Britannique', 'Jamaïcain/e', 'Haïtien/ne', 'Belizéen/ne', 'Guyanais/e', 'Surinamais/e', 'Trinidadien/ne', 'Bahaméen/ne', 'Autre']
];

// Traitement du formulaire
$mensaje_exito = '';
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['paso_final'])) {
    try {
            $upload_dir = __DIR__ . '/../../uploads/inscripciones/';

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
        }
        
        $archivos_subidos = [];
        $campos_archivos = ['boletin_1', 'boletin_2', 'boletin_3', 'carta_motivacion'];
        
        foreach ($campos_archivos as $campo) {
            if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
                $nombre_seguro = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9.-]/', '_', $_FILES[$campo]['name']);
                $ruta_destino = $upload_dir . $nombre_seguro;
                
                if (move_uploaded_file($_FILES[$campo]['tmp_name'], $ruta_destino)) {
                    $archivos_subidos[$campo] = $ruta_destino;
                }
            }
        }
        
        // Insertion dans la table inscripciones
        $stmt = $pdo->prepare("INSERT INTO inscripciones (
            fecha_inscripcion, idioma_inscripcion,
            alumno_nombres, alumno_apellido1, alumno_apellido2,
            alumno_fecha_nacimiento, alumno_nacionalidad, alumno_grado_inscripcion,
            alumno_anterior_institucion, alumno_anterior_ciudad, alumno_anterior_pais,
            acudiente1_nombres, acudiente1_apellido1, acudiente1_apellido2,
            acudiente1_direccion, acudiente1_ciudad, acudiente1_profesion,
            acudiente1_empresa, acudiente1_pais, acudiente1_prefijo, acudiente1_telefono,
            acudiente1_email, acudiente1_parentesco,
            acudiente2_nombres, acudiente2_apellido1, acudiente2_apellido2,
            acudiente2_direccion, acudiente2_ciudad, acudiente2_profesion,
            acudiente2_empresa, acudiente2_pais, acudiente2_prefijo, acudiente2_telefono,
            acudiente2_email, acudiente2_parentesco,
            archivo_boletin_1, archivo_boletin_2, archivo_boletin_3, archivo_carta_motivacion,
            estado_inscripcion, observaciones
        ) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pendiente', ?)");
        
        $stmt->execute([
            $idioma_actual,
            $_POST['alumno_nombres'] ?? '',
            $_POST['alumno_apellido1'] ?? '',
            $_POST['alumno_apellido2'] ?? '',
            $_POST['alumno_fecha_nacimiento'] ?? null,
            $_POST['alumno_nacionalidad'] ?? '',
            $_POST['alumno_grado'] ?? '',
            $_POST['anterior_institucion'] ?? '',
            $_POST['anterior_ciudad'] ?? '',
            $_POST['anterior_pais'] ?? '',
            $_POST['acudiente1_nombres'] ?? '',
            $_POST['acudiente1_apellido1'] ?? '',
            $_POST['acudiente1_apellido2'] ?? '',
            $_POST['acudiente1_direccion'] ?? '',
            $_POST['acudiente1_ciudad'] ?? '',
            $_POST['acudiente1_profesion'] ?? '',
            $_POST['acudiente1_empresa'] ?? '',
            $_POST['acudiente1_pais'] ?? '',
            $_POST['acudiente1_prefijo'] ?? '',
            $_POST['acudiente1_telefono'] ?? '',
            $_POST['acudiente1_email'] ?? '',
            $_POST['acudiente1_parentesco'] ?? 'Padre/Madre',
            $_POST['acudiente2_nombres'] ?? '',
            $_POST['acudiente2_apellido1'] ?? '',
            $_POST['acudiente2_apellido2'] ?? '',
            $_POST['acudiente2_direccion'] ?? '',
            $_POST['acudiente2_ciudad'] ?? '',
            $_POST['acudiente2_profesion'] ?? '',
            $_POST['acudiente2_empresa'] ?? '',
            $_POST['acudiente2_pais'] ?? '',
            $_POST['acudiente2_prefijo'] ?? '',
            $_POST['acudiente2_telefono'] ?? '',
            $_POST['acudiente2_email'] ?? '',
            $_POST['acudiente2_parentesco'] ?? 'Padre/Madre',
            $archivos_subidos['boletin_1'] ?? null,
            $archivos_subidos['boletin_2'] ?? null,
            $archivos_subidos['boletin_3'] ?? null,
            $archivos_subidos['carta_motivacion'] ?? null,
            $_POST['observaciones'] ?? ''
        ]);
        
        $inscripcion_id = $pdo->lastInsertId();
        
        // Message de confirmation (FAKE - pas d'envoi réel)
        $mensaje_exito = sprintf(
            t('mensaje_exito_inscripcion', 'inscripcion'),
            $inscripcion_id,
            $_POST['acudiente1_email'] ?? ''
        );
        
    } catch (Exception $e) {
        $errores[] = t('error_procesamiento', 'inscripcion') . ': ' . $e->getMessage();
    }
}
?>