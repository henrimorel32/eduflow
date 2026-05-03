import Head from 'next/head';
import { useState, useEffect } from 'react';

const translations = {
  es: {
    title: 'Inscripción Escolar',
    subtitle: 'Complete el formulario para inscribir a su hijo',
    steps: ['Acudiente Principal', 'Acudiente 2 (Opcional)', 'Datos del Estudiante', 'Documentos'],
    nombres: 'Nombres',
    apellido1: 'Primer Apellido',
    apellido2: 'Segundo Apellido',
    direccion: 'Dirección',
    ciudad: 'Ciudad',
    pais: 'País',
    profesion: 'Profesión',
    empresa: 'Empresa',
    prefijo: 'Prefijo',
    telefono: 'Teléfono',
    email: 'Correo Electrónico',
    parentesco: 'Parentesco',
    principal: 'Principal',
    opcional: 'Opcional',
    info_acudiente2: 'El segundo acudiente es opcional, pero recomendado para emergencias.',
    datos_estudiante: 'Datos del Estudiante',
    tipo_documento: 'Tipo de Documento',
    numero_documento: 'Número de Documento',
    fecha_nacimiento: 'Fecha de Nacimiento',
    lugar_nacimiento: 'Lugar de Nacimiento',
    grado: 'Grado a Cursar',
    antiguo_colegio: 'Colegio de Procedencia',
    direccion_antiguo: 'Dirección del Colegio Anterior',
    telefono_antiguo: 'Teléfono del Colegio Anterior',
    motivo_retiro: 'Motivo del Retiro',
    info_documentos: 'Adjunte los boletines del último año escolar.',
    boletin_1: 'Boletín Periodo 1',
    boletin_2: 'Boletín Periodo 2',
    boletin_3: 'Boletín Periodo 3',
    carta_motivacion: 'Carta de Motivación (Opcional)',
    formatos_aceptados: 'Formatos: PDF, JPG, PNG (Máx 5MB)',
    opcional_recomendado: 'Opcional pero recomendado',
    terminos: 'Acepto los términos y condiciones del proceso de inscripción',
    ver_terminos: 'Ver términos',
    finalizar: 'Finalizar Inscripción',
    siguiente: 'Siguiente',
    anterior: 'Anterior',
    enviar: 'Enviar Inscripción',
    enviando: 'Enviando...',
    success: '¡Inscripción enviada con éxito!',
    success_message: 'Hemos enviado un correo de confirmación a',
    error: 'Error al enviar',
    required: 'Campo requerido',
    invalid_email: 'Correo electrónico inválido',
    invalid_phone: 'Solo números permitidos',
    min_length: 'Mínimo {n} caracteres',
    select: 'Seleccione',
    padre: 'Padre',
    madre: 'Madre',
    tutor: 'Tutor Legal',
    abuelo: 'Abuelo/a',
    tio: 'Tío/a',
    otro: 'Otro',
    rc: 'Registro Civil',
    ti: 'Tarjeta de Identidad',
    cc: 'Cédula de Ciudadanía',
    ce: 'Cédula de Extranjería',
    pasaporte: 'Pasaporte',
    welcome_title: '¡Bienvenido!',
    welcome_text: 'Complete el proceso de inscripción en pocos pasos',
    grades: {
      prejardin: 'Pre-jardín',
      jardin: 'Jardín',
      transicion: 'Transición',
      primero: 'Primero',
      segundo: 'Segundo',
      tercero: 'Tercero',
      cuarto: 'Cuarto',
      quinto: 'Quinto',
      sexto: 'Sexto',
      septimo: 'Séptimo',
      octavo: 'Octavo',
      noveno: 'Noveno',
      decimo: 'Décimo',
      once: 'Undécimo',
    }
  },
  br: {
    title: 'Matrícula Escolar',
    subtitle: 'Preencha o formulário para matricular seu filho',
    steps: ['Responsável Principal', 'Responsável 2 (Opcional)', 'Dados do Aluno', 'Documentos'],
    nombres: 'Nomes',
    apellido1: 'Primeiro Sobrenome',
    apellido2: 'Segundo Sobrenome',
    direccion: 'Endereço',
    ciudad: 'Cidade',
    pais: 'País',
    profesion: 'Profissão',
    empresa: 'Empresa',
    prefijo: 'Prefixo',
    telefono: 'Telefone',
    email: 'E-mail',
    parentesco: 'Parentesco',
    principal: 'Principal',
    opcional: 'Opcional',
    info_acudiente2: 'O segundo responsável é opcional, mas recomendado para emergências.',
    datos_estudiante: 'Dados do Aluno',
    tipo_documento: 'Tipo de Documento',
    numero_documento: 'Número do Documento',
    fecha_nacimiento: 'Data de Nascimento',
    lugar_nacimiento: 'Local de Nascimento',
    grado: 'Série',
    antiguo_colegio: 'Escola de Procedência',
    direccion_antiguo: 'Endereço da Escola Anterior',
    telefono_antiguo: 'Telefone da Escola Anterior',
    motivo_retiro: 'Motivo da Transferência',
    info_documentos: 'Anexe os boletins do último ano letivo.',
    boletin_1: 'Boletim 1º Período',
    boletin_2: 'Boletim 2º Período',
    boletin_3: 'Boletim 3º Período',
    carta_motivacion: 'Carta de Motivação (Opcional)',
    formatos_aceptados: 'Formatos: PDF, JPG, PNG (Máx 5MB)',
    opcional_recomendado: 'Opcional mas recomendado',
    terminos: 'Aceito os termos e condições do processo de matrícula',
    ver_terminos: 'Ver termos',
    finalizar: 'Finalizar Matrícula',
    siguiente: 'Próximo',
    anterior: 'Voltar',
    enviar: 'Enviar Matrícula',
    enviando: 'Enviando...',
    success: 'Matrícula enviada com sucesso!',
    success_message: 'Enviamos um e-mail de confirmação para',
    error: 'Erro ao enviar',
    required: 'Campo obrigatório',
    invalid_email: 'E-mail inválido',
    invalid_phone: 'Apenas números permitidos',
    min_length: 'Mínimo {n} caracteres',
    select: 'Selecione',
    padre: 'Pai',
    madre: 'Mãe',
    tutor: 'Tutor Legal',
    abuelo: 'Avô/Avó',
    tio: 'Tio/Tia',
    otro: 'Outro',
    rc: 'Certidão de Nascimento',
    ti: 'Identidade',
    cc: 'Carteira de Identidade',
    ce: 'Identidade de Estrangeiro',
    pasaporte: 'Passaporte',
    welcome_title: 'Bem-vindo!',
    welcome_text: 'Complete o processo de matrícula em poucos passos',
  },
  en: {
    title: 'School Registration',
    subtitle: 'Complete the form to enroll your child',
    steps: ['Primary Guardian', 'Guardian 2 (Optional)', 'Student Information', 'Documents'],
    nombres: 'First Name',
    apellido1: 'Last Name',
    apellido2: 'Second Last Name',
    direccion: 'Address',
    ciudad: 'City',
    pais: 'Country',
    profesion: 'Profession',
    empresa: 'Company',
    prefijo: 'Prefix',
    telefono: 'Phone',
    email: 'Email',
    parentesco: 'Relationship',
    principal: 'Primary',
    opcional: 'Optional',
    info_acudiente2: 'Second guardian is optional but recommended for emergencies.',
    datos_estudiante: 'Student Information',
    tipo_documento: 'Document Type',
    numero_documento: 'Document Number',
    fecha_nacimiento: 'Date of Birth',
    lugar_nacimiento: 'Place of Birth',
    grado: 'Grade',
    antiguo_colegio: 'Previous School',
    direccion_antiguo: 'Previous School Address',
    telefono_antiguo: 'Previous School Phone',
    motivo_retiro: 'Reason for Leaving',
    info_documentos: 'Attach report cards from the last school year.',
    boletin_1: 'Report Card Period 1',
    boletin_2: 'Report Card Period 2',
    boletin_3: 'Report Card Period 3',
    carta_motivacion: 'Motivation Letter (Optional)',
    formatos_aceptados: 'Formats: PDF, JPG, PNG (Max 5MB)',
    opcional_recomendado: 'Optional but recommended',
    terminos: 'I accept the terms and conditions of the enrollment process',
    ver_terminos: 'View terms',
    finalizar: 'Complete Registration',
    siguiente: 'Next',
    anterior: 'Back',
    enviar: 'Submit Registration',
    enviando: 'Sending...',
    success: 'Registration submitted successfully!',
    success_message: 'We have sent a confirmation email to',
    error: 'Error submitting',
    required: 'Required field',
    invalid_email: 'Invalid email',
    invalid_phone: 'Only numbers allowed',
    min_length: 'Minimum {n} characters',
    select: 'Select',
    padre: 'Father',
    madre: 'Mother',
    tutor: 'Legal Guardian',
    abuelo: 'Grandparent',
    tio: 'Uncle/Aunt',
    otro: 'Other',
    rc: 'Birth Certificate',
    ti: 'Identity Card',
    cc: 'Citizenship ID',
    ce: 'Foreigner ID',
    pasaporte: 'Passport',
    welcome_title: 'Welcome!',
    welcome_text: 'Complete the enrollment process in a few steps',
  },
  fr: {
    title: 'Inscription Scolaire',
    subtitle: 'Remplissez le formulaire pour inscrire votre enfant',
    steps: ['Responsable Principal', 'Responsable 2 (Optionnel)', 'Informations Élève', 'Documents'],
    nombres: 'Prénom',
    apellido1: 'Nom',
    apellido2: 'Deuxième Nom',
    direccion: 'Adresse',
    ciudad: 'Ville',
    pais: 'Pays',
    profesion: 'Profession',
    empresa: 'Entreprise',
    prefijo: 'Indicatif',
    telefono: 'Téléphone',
    email: 'Email',
    parentesco: 'Lien de parenté',
    principal: 'Principal',
    opcional: 'Optionnel',
    info_acudiente2: 'Le deuxième responsable est optionnel mais recommandé pour les urgences.',
    datos_estudiante: 'Informations de l\'Élève',
    tipo_documento: 'Type de Document',
    numero_documento: 'Numéro du Document',
    fecha_nacimiento: 'Date de Naissance',
    lugar_nacimiento: 'Lieu de Naissance',
    grado: 'Classe',
    antiguo_colegio: 'École Précédente',
    direccion_antiguo: 'Adresse de l\'École Précédente',
    telefono_antiguo: 'Téléphone de l\'École Précédente',
    motivo_retiro: 'Motif du Départ',
    info_documentos: 'Joignez les bulletins de la dernière année scolaire.',
    boletin_1: 'Bulletin Période 1',
    boletin_2: 'Bulletin Période 2',
    boletin_3: 'Bulletin Période 3',
    carta_motivacion: 'Lettre de Motivation (Optionnel)',
    formatos_aceptados: 'Formats: PDF, JPG, PNG (Max 5Mo)',
    opcional_recomendado: 'Optionnel mais recommandé',
    terminos: 'J\'accepte les termes et conditions du processus d\'inscription',
    ver_terminos: 'Voir les termes',
    finalizar: 'Terminer l\'Inscription',
    siguiente: 'Suivant',
    anterior: 'Retour',
    enviar: 'Envoyer l\'Inscription',
    enviando: 'Envoi en cours...',
    success: 'Inscription envoyée avec succès!',
    success_message: 'Nous avons envoyé un e-mail de confirmation à',
    error: 'Erreur lors de l\'envoi',
    required: 'Champ requis',
    invalid_email: 'Email invalide',
    invalid_phone: 'Chiffres uniquement',
    min_length: 'Minimum {n} caractères',
    select: 'Sélectionnez',
    padre: 'Père',
    madre: 'Mère',
    tutor: 'Tuteur Légal',
    abuelo: 'Grand-parent',
    tio: 'Oncle/Tante',
    otro: 'Autre',
    rc: 'Acte de Naissance',
    ti: 'Carte d\'Identité',
    cc: 'Carte Nationale',
    ce: 'Carte d\'Étranger',
    pasaporte: 'Passeport',
    welcome_title: 'Bienvenue!',
    welcome_text: 'Complétez le processus d\'inscription en quelques étapes',
  },
};

const countries = {
  CO: { es: 'Colombia', br: 'Colômbia', en: 'Colombia', fr: 'Colombie' },
  BR: { es: 'Brasil', br: 'Brasil', en: 'Brazil', fr: 'Brésil' },
  MX: { es: 'México', br: 'México', en: 'Mexico', fr: 'Mexique' },
  AR: { es: 'Argentina', br: 'Argentina', en: 'Argentina', fr: 'Argentine' },
  PE: { es: 'Perú', br: 'Peru', en: 'Peru', fr: 'Pérou' },
  CL: { es: 'Chile', br: 'Chile', en: 'Chile', fr: 'Chili' },
  EC: { es: 'Ecuador', br: 'Equador', en: 'Ecuador', fr: 'Équateur' },
  VE: { es: 'Venezuela', br: 'Venezuela', en: 'Venezuela', fr: 'Venezuela' },
  BO: { es: 'Bolivia', br: 'Bolívia', en: 'Bolivia', fr: 'Bolivie' },
  PA: { es: 'Panamá', br: 'Panamá', en: 'Panama', fr: 'Panama' },
  CR: { es: 'Costa Rica', br: 'Costa Rica', en: 'Costa Rica', fr: 'Costa Rica' },
  US: { es: 'Estados Unidos', br: 'Estados Unidos', en: 'United States', fr: 'États-Unis' },
};

const phonePrefixes = {
  '+57': { es: 'Colombia (+57)', br: 'Colômbia (+57)', en: 'Colombia (+57)', fr: 'Colombie (+57)' },
  '+55': { es: 'Brasil (+55)', br: 'Brasil (+55)', en: 'Brazil (+55)', fr: 'Brésil (+55)' },
  '+51': { es: 'Perú (+51)', br: 'Peru (+51)', en: 'Peru (+51)', fr: 'Pérou (+51)' },
  '+52': { es: 'México (+52)', br: 'México (+52)', en: 'Mexico (+52)', fr: 'Mexique (+52)' },
  '+54': { es: 'Argentina (+54)', br: 'Argentina (+54)', en: 'Argentina (+54)', fr: 'Argentine (+54)' },
  '+56': { es: 'Chile (+56)', br: 'Chile (+56)', en: 'Chile (+56)', fr: 'Chili (+56)' },
  '+58': { es: 'Venezuela (+58)', br: 'Venezuela (+58)', en: 'Venezuela (+58)', fr: 'Venezuela (+58)' },
  '+593': { es: 'Ecuador (+593)', br: 'Equador (+593)', en: 'Ecuador (+593)', fr: 'Équateur (+593)' },
  '+595': { es: 'Paraguay (+595)', br: 'Paraguai (+595)', en: 'Paraguay (+595)', fr: 'Paraguay (+595)' },
  '+598': { es: 'Uruguay (+598)', br: 'Uruguai (+598)', en: 'Uruguay (+598)', fr: 'Uruguay (+598)' },
  '+591': { es: 'Bolivia (+591)', br: 'Bolívia (+591)', en: 'Bolivia (+591)', fr: 'Bolivie (+591)' },
  '+506': { es: 'Costa Rica (+506)', br: 'Costa Rica (+506)', en: 'Costa Rica (+506)', fr: 'Costa Rica (+506)' },
  '+507': { es: 'Panamá (+507)', br: 'Panamá (+507)', en: 'Panama (+507)', fr: 'Panama (+507)' },
  '+1': { es: 'USA/Canadá (+1)', br: 'EUA/Canadá (+1)', en: 'USA/Canada (+1)', fr: 'USA/Canada (+1)' },
};

const languages = [
  { code: 'es', name: 'Español', flag: '🇨🇴' },
  { code: 'br', name: 'Português', flag: '🇧🇷' },
  { code: 'en', name: 'English', flag: '🇺🇸' },
  { code: 'fr', name: 'Français', flag: '🇫🇷' },
];

// Validation functions
const validators = {
  email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
  phone: (value) => /^[0-9\s\-]{7,15}$/.test(value),
  required: (value) => value && value.trim && value.trim().length > 0,
  minLength: (value, min) => value && value.length >= min,
};

export default function Home({ schoolConfig }) {
  const { school, colors } = schoolConfig;
  const [lang, setLang] = useState('es');
  const [step, setStep] = useState(0);
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState(null);
  const [logoError, setLogoError] = useState(false);
  const [formData, setFormData] = useState({
    // Acudiente 1
    ac1_nombres: '', ac1_apellido1: '', ac1_apellido2: '',
    ac1_direccion: '', ac1_ciudad: '', ac1_pais: 'CO',
    ac1_profesion: '', ac1_empresa: '',
    ac1_prefijo: '+57', ac1_telefono: '', ac1_email: '',
    ac1_parentesco: 'Madre',
    // Acudiente 2
    ac2_nombres: '', ac2_apellido1: '', ac2_apellido2: '',
    ac2_direccion: '', ac2_ciudad: '', ac2_pais: '',
    ac2_profesion: '', ac2_empresa: '',
    ac2_prefijo: '', ac2_telefono: '', ac2_email: '',
    ac2_parentesco: '',
    // Estudiante
    est_nombres: '', est_apellido1: '', est_apellido2: '',
    est_tipo_doc: 'RC', est_numero_doc: '',
    est_fecha_nac: '', est_lugar_nac: '',
    est_grado: '',
    est_antiguo_colegio: '', est_antiguo_direccion: '',
    est_antiguo_telefono: '', est_motivo_retiro: '',
    // Documentos
    boletin1: null, boletin2: null, boletin3: null, carta: null,
    // Confirmación
    aceptaTerminos: false,
  });
  const [errors, setErrors] = useState({});
  const [touched, setTouched] = useState({});

  useEffect(() => {
    if (typeof window !== 'undefined') {
      const urlLang = new URLSearchParams(window.location.search).get('lang');
      if (urlLang && translations[urlLang]) setLang(urlLang);
    }
  }, []);

  const t = translations[lang] || translations.es;

  const validateField = (name, value) => {
    if (name.includes('email')) {
      if (!validators.required(value)) return t.required;
      if (!validators.email(value)) return t.invalid_email;
    }
    if (name.includes('telefono')) {
      if (!validators.required(value)) return t.required;
      if (!validators.phone(value)) return t.invalid_phone;
    }
    if (name.includes('nombres') || name.includes('apellido1') || name.includes('direccion') || name.includes('ciudad')) {
      if (!validators.required(value)) return t.required;
      if (!validators.minLength(value, 2)) return t.min_length.replace('{n}', '2');
    }
    if (name.includes('numero_doc')) {
      if (!validators.required(value)) return t.required;
    }
    if (name.includes('fecha_nac')) {
      if (!validators.required(value)) return t.required;
    }
    if (name === 'est_grado') {
      if (!validators.required(value)) return t.required;
    }
    return null;
  };

  const validateStep = (currentStep) => {
    const newErrors = {};
    let isValid = true;

    if (currentStep === 1) {
      const fields = ['ac1_nombres', 'ac1_apellido1', 'ac1_direccion', 'ac1_ciudad', 'ac1_telefono', 'ac1_email'];
      fields.forEach(field => {
        const error = validateField(field, formData[field]);
        if (error) {
          newErrors[field] = error;
          isValid = false;
        }
      });
    } else if (currentStep === 3) {
      const fields = ['est_nombres', 'est_apellido1', 'est_numero_doc', 'est_fecha_nac', 'est_grado'];
      fields.forEach(field => {
        const error = validateField(field, formData[field]);
        if (error) {
          newErrors[field] = error;
          isValid = false;
        }
      });
    } else if (currentStep === 4) {
      if (!formData.aceptaTerminos) {
        newErrors.aceptaTerminos = t.required;
        isValid = false;
      }
    }

    setErrors(newErrors);
    return isValid;
  };

  const handleBlur = (field) => {
    setTouched(prev => ({ ...prev, [field]: true }));
    const error = validateField(field, formData[field]);
    setErrors(prev => ({ ...prev, [field]: error }));
  };

  const handleNext = () => {
    if (validateStep(step)) {
      setStep(step + 1);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  };

  const handleBack = () => {
    setStep(step - 1);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validateStep(4)) return;

    setLoading(true);
    setMessage(null);

    try {
      const response = await fetch('/api/inscripcion', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ...formData, lang, schoolId: school.id }),
      });

      const data = await response.json();
      if (response.ok) {
        setMessage({ type: 'success', text: t.success });
        setStep(5);
      } else {
        setMessage({ type: 'error', text: data.error || t.error });
      }
    } catch (err) {
      setMessage({ type: 'error', text: t.error });
    } finally {
      setLoading(false);
    }
  };

  const updateField = (field, value) => {
    setFormData(prev => ({ ...prev, [field]: value }));
    if (touched[field]) {
      const error = validateField(field, value);
      setErrors(prev => ({ ...prev, [field]: error }));
    }
  };

  const logoUrl = school.logoUrl && school.logoUrl.startsWith('http') 
    ? school.logoUrl 
    : school.logoUrl || '/logo.png';
  
  const faviconUrl = school.faviconUrl && school.faviconUrl.startsWith('http')
    ? school.faviconUrl
    : school.faviconUrl || '/favicon.ico';

  const renderField = (name, label, type = 'text', required = false, options = null) => {
    const hasError = errors[name] && touched[name];
    const showError = errors[name] && (touched[name] || step > 0);
    
    return (
      <div className={`form-group ${hasError ? 'has-error' : ''}`}>
        <label className="form-label">
          {label} {required && <span className="required">*</span>}
        </label>
        {options ? (
          <select
            className={`form-select ${hasError ? 'error' : ''}`}
            value={formData[name]}
            onChange={(e) => updateField(name, e.target.value)}
            onBlur={() => handleBlur(name)}
          >
            <option value="">{t.select}</option>
            {options}
          </select>
        ) : (
          <input
            type={type}
            className={`form-input ${hasError ? 'error' : ''}`}
            value={formData[name]}
            onChange={(e) => updateField(name, e.target.value)}
            onBlur={() => handleBlur(name)}
            placeholder={type === 'email' ? 'ejemplo@correo.com' : type === 'tel' ? '3001234567' : ''}
          />
        )}
        {showError && <span className="error-text">{errors[name]}</span>}
      </div>
    );
  };

  return (
    <>
      <Head>
        <title>{t.title} | {school.name}</title>
        <meta name="description" content={`${t.subtitle} - ${school.name}`} />
        <link rel="icon" href={faviconUrl} />
        <link rel="shortcut icon" href={faviconUrl} />
        <link rel="apple-touch-icon" href={logoUrl} />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
      </Head>

      <style jsx global>{`
        :root { 
          --color-primary: ${colors.primary}; 
          --color-secondary: ${colors.secondary}; 
          --color-accent: #f59e0b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
          font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
          background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
          min-height: 100vh;
          color: #1e293b;
        }
        .container { max-width: 1000px; margin: 0 auto; padding: 2rem 1rem; }
        
        /* Header Styles */
        .header { 
          text-align: center; 
          margin-bottom: 2rem; 
          position: relative;
          animation: fadeInDown 0.8s ease;
        }
        @keyframes fadeInDown {
          from { opacity: 0; transform: translateY(-20px); }
          to { opacity: 1; transform: translateY(0); }
        }
        .logo-container {
          background: white; 
          border-radius: 50%; 
          width: 120px; 
          height: 120px;
          display: flex; 
          align-items: center; 
          justify-content: center;
          margin: 0 auto 1.5rem; 
          padding: 15px; 
          box-shadow: 0 20px 60px rgba(0,0,0,0.3), 0 0 0 4px rgba(255,255,255,0.2);
          animation: pulse 2s infinite;
        }
        @keyframes pulse {
          0%, 100% { transform: scale(1); }
          50% { transform: scale(1.02); }
        }
        .logo { 
          max-width: 90px; 
          max-height: 90px; 
          object-fit: contain;
          border-radius: 8px;
        }
        .logo-fallback {
          font-size: 3rem;
          color: var(--color-primary);
        }
        .school-name {
          font-size: 2.5rem; 
          font-weight: 700;
          color: white;
          text-shadow: 0 2px 10px rgba(0,0,0,0.2);
          margin-bottom: 0.5rem;
        }
        .subtitle { 
          color: rgba(255,255,255,0.9); 
          font-size: 1.1rem;
          font-weight: 300;
        }
        .language-selector { 
          position: absolute; 
          top: 0; 
          right: 0; 
        }
        .language-btn {
          background: rgba(255,255,255,0.9); 
          border: none;
          color: #1e293b; 
          padding: 0.6rem 1rem; 
          border-radius: 12px; 
          cursor: pointer;
          font-weight: 500;
          box-shadow: 0 4px 15px rgba(0,0,0,0.1);
          transition: all 0.3s;
        }
        .language-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
        
        /* Step Indicator */
        .step-indicator {
          display: flex; 
          justify-content: center; 
          gap: 0.5rem; 
          margin-bottom: 2rem;
          flex-wrap: wrap;
        }
        .step-item { 
          text-align: center; 
          flex: 1;
          min-width: 80px;
          max-width: 150px;
        }
        .step-dot {
          width: 50px; 
          height: 50px; 
          border-radius: 50%; 
          display: flex;
          align-items: center; 
          justify-content: center; 
          font-weight: 600;
          margin: 0 auto 0.5rem;
          transition: all 0.4s;
          border: 3px solid transparent;
        }
        .step-dot.active {
          background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
          color: white;
          box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
          transform: scale(1.1);
        }
        .step-dot.inactive { 
          background: rgba(255,255,255,0.3); 
          color: rgba(255,255,255,0.7);
        }
        .step-dot.completed { 
          background: #10b981; 
          color: white;
          box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        .step-label { 
          font-size: 0.8rem; 
          color: rgba(255,255,255,0.9); 
          font-weight: 500;
        }
        
        /* Form Card */
        .form-card {
          background: white;
          border-radius: 24px; 
          padding: 2.5rem;
          box-shadow: 0 25px 80px rgba(0,0,0,0.15);
          animation: fadeInUp 0.8s ease;
        }
        @keyframes fadeInUp {
          from { opacity: 0; transform: translateY(30px); }
          to { opacity: 1; transform: translateY(0); }
        }
        
        /* Welcome Step */
        .welcome-step {
          text-align: center;
          padding: 3rem 2rem;
        }
        .welcome-icon {
          font-size: 5rem;
          margin-bottom: 1.5rem;
          animation: bounce 2s infinite;
        }
        @keyframes bounce {
          0%, 100% { transform: translateY(0); }
          50% { transform: translateY(-10px); }
        }
        .welcome-title {
          font-size: 2.2rem;
          font-weight: 700;
          color: #1e293b;
          margin-bottom: 1rem;
        }
        .welcome-text {
          font-size: 1.2rem;
          color: #64748b;
          margin-bottom: 2rem;
        }
        .features {
          display: flex;
          justify-content: center;
          gap: 2rem;
          margin-bottom: 2rem;
          flex-wrap: wrap;
        }
        .feature {
          display: flex;
          align-items: center;
          gap: 0.5rem;
          color: #1e293b;
          font-weight: 500;
        }
        .feature-icon {
          width: 40px;
          height: 40px;
          background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          color: white;
        }
        
        /* Section Title */
        .section-title {
          color: #1e293b; 
          font-size: 1.5rem; 
          margin-bottom: 1.5rem;
          padding-bottom: 0.75rem; 
          border-bottom: 3px solid var(--color-primary);
          display: flex; 
          align-items: center; 
          gap: 0.75rem;
        }
        .section-number {
          width: 36px; 
          height: 36px; 
          border-radius: 50%;
          background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
          display: flex; 
          align-items: center; 
          justify-content: center;
          font-size: 1rem;
          color: white;
          font-weight: 600;
        }
        .section-subtitle {
          color: #64748b;
          font-size: 0.95rem;
          margin-top: -1rem;
          margin-bottom: 1.5rem;
          font-weight: 400;
        }
        
        /* Form Grid */
        .form-row { 
          display: grid; 
          grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
          gap: 1.25rem; 
        }
        .form-group { 
          margin-bottom: 1.25rem; 
          position: relative;
        }
        .form-group.has-error .form-input,
        .form-group.has-error .form-select {
          border-color: #ef4444;
          background-color: #fef2f2;
        }
        .form-label { 
          display: block; 
          margin-bottom: 0.5rem; 
          color: #374151; 
          font-weight: 500;
          font-size: 0.95rem;
        }
        .form-label .required {
          color: #ef4444;
          margin-left: 2px;
        }
        .form-input, .form-select {
          width: 100%; 
          padding: 0.875rem 1rem; 
          background: #f9fafb;
          border: 2px solid #e5e7eb; 
          border-radius: 12px;
          color: #1e293b; 
          font-size: 1rem;
          transition: all 0.3s;
          font-family: inherit;
        }
        .form-input:focus, .form-select:focus {
          outline: none; 
          border-color: var(--color-primary); 
          background: white;
          box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        .form-input.error, .form-select.error { 
          border-color: #ef4444; 
        }
        .form-input::placeholder { 
          color: #9ca3af; 
        }
        .error-text { 
          color: #ef4444; 
          font-size: 0.8rem; 
          margin-top: 0.4rem;
          display: flex;
          align-items: center;
          gap: 0.3rem;
        }
        
        /* Info Box */
        .info-box {
          background: linear-gradient(135deg, #fef3c7, #fde68a);
          border-left: 4px solid #f59e0b;
          padding: 1rem 1.25rem; 
          border-radius: 12px; 
          margin-bottom: 1.5rem;
          color: #92400e;
          display: flex;
          align-items: center;
          gap: 0.75rem;
        }
        
        /* Buttons */
        .button-group { 
          display: flex; 
          gap: 1rem; 
          margin-top: 2.5rem; 
        }
        .btn {
          flex: 1; 
          padding: 1rem 2rem; 
          border: none; 
          border-radius: 14px;
          font-size: 1rem; 
          font-weight: 600; 
          cursor: pointer; 
          transition: all 0.3s;
          font-family: inherit;
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 0.5rem;
        }
        .btn-primary {
          background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
          color: white;
          box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        }
        .btn-primary:hover:not(:disabled) { 
          transform: translateY(-3px); 
          box-shadow: 0 15px 40px rgba(99, 102, 241, 0.4);
        }
        .btn-secondary {
          background: #f3f4f6; 
          color: #4b5563; 
          border: 2px solid #e5e7eb;
        }
        .btn-secondary:hover:not(:disabled) {
          background: #e5e7eb;
          transform: translateY(-2px);
        }
        .btn:disabled { 
          opacity: 0.6; 
          cursor: not-allowed;
          transform: none !important;
        }
        
        /* Messages */
        .message { 
          padding: 1rem 1.25rem; 
          border-radius: 12px; 
          margin-bottom: 1.5rem; 
          text-align: center;
          font-weight: 500;
          animation: slideIn 0.5s ease;
        }
        @keyframes slideIn {
          from { opacity: 0; transform: translateX(-20px); }
          to { opacity: 1; transform: translateX(0); }
        }
        .message.success { 
          background: #d1fae5; 
          border: 2px solid #10b981; 
          color: #065f46; 
        }
        .message.error { 
          background: #fee2e2; 
          border: 2px solid #ef4444; 
          color: #991b1b; 
        }
        
        /* Checkbox */
        .checkbox-group {
          display: flex; 
          align-items: flex-start; 
          gap: 0.75rem; 
          margin-top: 1.5rem;
          padding: 1rem;
          background: #f9fafb;
          border-radius: 12px;
          border: 2px solid #e5e7eb;
        }
        .checkbox-group.error {
          border-color: #ef4444;
          background: #fef2f2;
        }
        .checkbox-group input[type="checkbox"] {
          width: 20px;
          height: 20px;
          accent-color: var(--color-primary);
          margin-top: 2px;
        }
        .checkbox-group label {
          color: #374151;
          font-size: 0.95rem;
          line-height: 1.5;
        }
        .checkbox-group a {
          color: var(--color-primary);
          text-decoration: none;
          font-weight: 600;
        }
        .checkbox-group a:hover {
          text-decoration: underline;
        }
        
        /* Success Step */
        .success-step {
          text-align: center; 
          padding: 3rem 2rem;
          animation: fadeIn 0.8s ease;
        }
        @keyframes fadeIn {
          from { opacity: 0; }
          to { opacity: 1; }
        }
        .success-icon { 
          font-size: 6rem; 
          margin-bottom: 1.5rem;
          animation: scaleIn 0.5s ease;
        }
        @keyframes scaleIn {
          from { transform: scale(0); }
          to { transform: scale(1); }
        }
        .success-title {
          font-size: 2rem;
          font-weight: 700;
          color: #1e293b;
          margin-bottom: 1rem;
        }
        .success-message {
          font-size: 1.1rem;
          color: #64748b;
          margin-bottom: 2rem;
        }
        .success-email {
          background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
          color: white;
          padding: 0.5rem 1rem;
          border-radius: 8px;
          font-weight: 600;
          display: inline-block;
        }
        
        /* File Upload */
        .file-upload {
          border: 2px dashed #d1d5db;
          border-radius: 12px;
          padding: 1.5rem;
          text-align: center;
          transition: all 0.3s;
          background: #f9fafb;
        }
        .file-upload:hover {
          border-color: var(--color-primary);
          background: #eff6ff;
        }
        .file-upload input[type="file"] {
          display: none;
        }
        .file-upload-label {
          cursor: pointer;
          color: var(--color-primary);
          font-weight: 600;
        }
        .file-upload-icon {
          font-size: 2rem;
          margin-bottom: 0.5rem;
        }
        
        @media (max-width: 600px) {
          .school-name { font-size: 1.8rem; }
          .step-label { display: none; }
          .form-card { padding: 1.5rem; }
          .features { flex-direction: column; gap: 1rem; }
        }
      `}</style>

      <div className="container">
        <header className="header">
          <div className="language-selector">
            <select className="language-btn" value={lang} onChange={(e) => setLang(e.target.value)}>
              {languages.map((l) => <option key={l.code} value={l.code}>{l.flag} {l.name}</option>)}
            </select>
          </div>
          <div className="logo-container">
            {!logoError ? (
              <img 
                src={logoUrl} 
                alt={school.name} 
                className="logo" 
                onError={() => setLogoError(true)}
              />
            ) : (
              <span className="logo-fallback">🎓</span>
            )}
          </div>
          <h1 className="school-name">{school.name}</h1>
          <p className="subtitle">{t.subtitle}</p>
        </header>

        {step > 0 && step < 5 && (
          <div className="step-indicator">
            {t.steps.map((s, i) => (
              <div key={i} className="step-item">
                <div className={`step-dot ${step === i + 1 ? 'active' : step > i + 1 ? 'completed' : 'inactive'}`}>
                  {step > i + 1 ? '✓' : i + 1}
                </div>
                <div className="step-label">{s}</div>
              </div>
            ))}
          </div>
        )}

        <div className="form-card">
          {message && <div className={`message ${message.type}`}>{message.text}</div>}
          
          {step === 0 && (
            <div className="welcome-step">
              <div className="welcome-icon">🎓</div>
              <h2 className="welcome-title">{t.welcome_title}</h2>
              <p className="welcome-text">{t.welcome_text}</p>
              <div className="features">
                <div className="feature">
                  <div className="feature-icon">✓</div>
                  <span>Rápido y fácil</span>
                </div>
                <div className="feature">
                  <div className="feature-icon">🔒</div>
                  <span>100% Seguro</span>
                </div>
                <div className="feature">
                  <div className="feature-icon">📧</div>
                  <span>Confirmación por email</span>
                </div>
              </div>
              <button className="btn btn-primary" onClick={() => setStep(1)} style={{ maxWidth: 300, margin: '0 auto' }}>
                {t.siguiente} →
              </button>
            </div>
          )}

          {step === 1 && (
            <>
              <h2 className="section-title"><span className="section-number">1</span>{t.steps[0]}</h2>
              <p className="section-subtitle">{t.principal}</p>
              <div className="form-row">
                {renderField('ac1_nombres', t.nombres, 'text', true)}
                {renderField('ac1_apellido1', t.apellido1, 'text', true)}
                {renderField('ac1_apellido2', t.apellido2)}
              </div>
              {renderField('ac1_direccion', t.direccion, 'text', true)}
              <div className="form-row">
                {renderField('ac1_ciudad', t.ciudad, 'text', true)}
                {renderField('ac1_pais', t.pais, 'select', true, 
                  Object.entries(countries).map(([code, names]) => (
                    <option key={code} value={code}>{names[lang] || names.es}</option>
                  )))}
              </div>
              <div className="form-row">
                {renderField('ac1_profesion', t.profesion)}
                {renderField('ac1_empresa', t.empresa)}
              </div>
              <div className="form-row">
                {renderField('ac1_prefijo', t.prefijo, 'select', true,
                  Object.entries(phonePrefixes).map(([code, names]) => (
                    <option key={code} value={code}>{names[lang] || names.es}</option>
                  )))}
                {renderField('ac1_telefono', t.telefono, 'tel', true)}
                {renderField('ac1_email', t.email, 'email', true)}
              </div>
              {renderField('ac1_parentesco', t.parentesco, 'select', true,
                [['Padre', t.padre], ['Madre', t.madre], ['Tutor legal', t.tutor], 
                 ['Abuelo/a', t.abuelo], ['Tío/a', t.tio], ['Otro', t.otro]]
                  .map(([val, label]) => <option key={val} value={val}>{label}</option>))}
              
              <div className="button-group">
                <button type="button" className="btn btn-primary" onClick={handleNext}>{t.siguiente} →</button>
              </div>
            </>
          )}

          {step === 2 && (
            <>
              <h2 className="section-title"><span className="section-number">2</span>{t.steps[1]}</h2>
              <p className="section-subtitle">{t.opcional}</p>
              <div className="info-box">ℹ️ {t.info_acudiente2}</div>
              <div className="form-row">
                {renderField('ac2_nombres', t.nombres)}
                {renderField('ac2_apellido1', t.apellido1)}
                {renderField('ac2_apellido2', t.apellido2)}
              </div>
              {renderField('ac2_direccion', t.direccion)}
              <div className="form-row">
                {renderField('ac2_ciudad', t.ciudad)}
                {renderField('ac2_pais', t.pais, 'select', false,
                  Object.entries(countries).map(([code, names]) => (
                    <option key={code} value={code}>{names[lang] || names.es}</option>
                  )))}
              </div>
              <div className="form-row">
                {renderField('ac2_profesion', t.profesion)}
                {renderField('ac2_empresa', t.empresa)}
              </div>
              <div className="form-row">
                {renderField('ac2_prefijo', t.prefijo, 'select', false,
                  Object.entries(phonePrefixes).map(([code, names]) => (
                    <option key={code} value={code}>{names[lang] || names.es}</option>
                  )))}
                {renderField('ac2_telefono', t.telefono, 'tel')}
                {renderField('ac2_email', t.email, 'email')}
              </div>
              {renderField('ac2_parentesco', t.parentesco, 'select', false,
                [['', t.select], ['Padre', t.padre], ['Madre', t.madre], ['Tutor legal', t.tutor], 
                 ['Abuelo/a', t.abuelo], ['Tío/a', t.tio], ['Otro', t.otro]]
                  .map(([val, label]) => <option key={val || 'empty'} value={val}>{label}</option>))}
              
              <div className="button-group">
                <button type="button" className="btn btn-secondary" onClick={handleBack}>← {t.anterior}</button>
                <button type="button" className="btn btn-primary" onClick={() => setStep(3)}>{t.siguiente} →</button>
              </div>
            </>
          )}

          {step === 3 && (
            <>
              <h2 className="section-title"><span className="section-number">3</span>{t.steps[2]}</h2>
              <p className="section-subtitle">{t.datos_estudiante}</p>
              <div className="form-row">
                {renderField('est_nombres', t.nombres, 'text', true)}
                {renderField('est_apellido1', t.apellido1, 'text', true)}
                {renderField('est_apellido2', t.apellido2)}
              </div>
              <div className="form-row">
                {renderField('est_tipo_doc', t.tipo_documento, 'select', true,
                  [['RC', t.rc], ['TI', t.ti], ['CC', t.cc], ['CE', t.ce], ['Pasaporte', t.pasaporte]]
                    .map(([val, label]) => <option key={val} value={val}>{label}</option>))}
                {renderField('est_numero_doc', t.numero_documento, 'text', true)}
              </div>
              <div className="form-row">
                {renderField('est_fecha_nac', t.fecha_nacimiento, 'date', true)}
                {renderField('est_lugar_nac', t.lugar_nacimiento)}
              </div>
              {renderField('est_grado', t.grado, 'select', true,
                Object.entries(t.grades).map(([key, label]) => (
                  <option key={key} value={key}>{label}</option>
                )))}
              
              <h3 style={{ color: '#64748b', marginTop: '2rem', marginBottom: '1rem', fontSize: '1.1rem' }}>{t.antiguo_colegio}</h3>
              {renderField('est_antiguo_colegio', t.antiguo_colegio)}
              {renderField('est_antiguo_direccion', t.direccion_antiguo)}
              <div className="form-row">
                {renderField('est_antiguo_telefono', t.telefono_antiguo, 'tel')}
                {renderField('est_motivo_retiro', t.motivo_retiro)}
              </div>
              
              <div className="button-group">
                <button type="button" className="btn btn-secondary" onClick={handleBack}>← {t.anterior}</button>
                <button type="button" className="btn btn-primary" onClick={handleNext}>{t.siguiente} →</button>
              </div>
            </>
          )}

          {step === 4 && (
            <form onSubmit={handleSubmit}>
              <h2 className="section-title"><span className="section-number">4</span>{t.steps[3]}</h2>
              <div className="info-box">📎 {t.info_documentos}</div>
              
              <div className="form-group">
                <label className="form-label">{t.boletin_1} <span className="required">*</span></label>
                <div className="file-upload">
                  <div className="file-upload-icon">📄</div>
                  <label className="file-upload-label">
                    {formData.boletin1 ? formData.boletin1.name : 'Haz clic para subir'}
                    <input 
                      type="file" 
                      accept=".pdf,.jpg,.jpeg,.png" 
                      required
                      onChange={(e) => updateField('boletin1', e.target.files[0])} 
                    />
                  </label>
                  <p style={{ fontSize: '0.85rem', color: '#6b7280', marginTop: '0.5rem' }}>{t.formatos_aceptados}</p>
                </div>
              </div>

              <div className="form-group">
                <label className="form-label">{t.boletin_2} <span className="required">*</span></label>
                <div className="file-upload">
                  <div className="file-upload-icon">📄</div>
                  <label className="file-upload-label">
                    {formData.boletin2 ? formData.boletin2.name : 'Haz clic para subir'}
                    <input 
                      type="file" 
                      accept=".pdf,.jpg,.jpeg,.png" 
                      required
                      onChange={(e) => updateField('boletin2', e.target.files[0])} 
                    />
                  </label>
                  <p style={{ fontSize: '0.85rem', color: '#6b7280', marginTop: '0.5rem' }}>{t.formatos_aceptados}</p>
                </div>
              </div>

              <div className="form-group">
                <label className="form-label">{t.boletin_3} <span className="required">*</span></label>
                <div className="file-upload">
                  <div className="file-upload-icon">📄</div>
                  <label className="file-upload-label">
                    {formData.boletin3 ? formData.boletin3.name : 'Haz clic para subir'}
                    <input 
                      type="file" 
                      accept=".pdf,.jpg,.jpeg,.png" 
                      required
                      onChange={(e) => updateField('boletin3', e.target.files[0])} 
                    />
                  </label>
                  <p style={{ fontSize: '0.85rem', color: '#6b7280', marginTop: '0.5rem' }}>{t.formatos_aceptados}</p>
                </div>
              </div>

              <div className="form-group">
                <label className="form-label">{t.carta_motivacion}</label>
                <div className="file-upload" style={{ background: '#fef3c7', borderColor: '#fbbf24' }}>
                  <div className="file-upload-icon">✨</div>
                  <label className="file-upload-label" style={{ color: '#d97706' }}>
                    {formData.carta ? formData.carta.name : 'Haz clic para subir (opcional)'}
                    <input 
                      type="file" 
                      accept=".pdf,.doc,.docx"
                      onChange={(e) => updateField('carta', e.target.files[0])} 
                    />
                  </label>
                  <p style={{ fontSize: '0.85rem', color: '#b45309', marginTop: '0.5rem' }}>⭐ {t.opcional_recomendado}</p>
                </div>
              </div>

              <div className={`checkbox-group ${errors.aceptaTerminos ? 'error' : ''}`}>
                <input 
                  type="checkbox" 
                  id="terms" 
                  checked={formData.aceptaTerminos}
                  onChange={(e) => updateField('aceptaTerminos', e.target.checked)} 
                />
                <label htmlFor="terms">{t.terminos} <a href="#">{t.ver_terminos}</a></label>
              </div>
              
              <div className="button-group">
                <button type="button" className="btn btn-secondary" onClick={handleBack}>← {t.anterior}</button>
                <button type="submit" className="btn btn-primary" disabled={loading}>
                  {loading ? t.enviando : `${t.finalizar} ✓`}
                </button>
              </div>
            </form>
          )}

          {step === 5 && (
            <div className="success-step">
              <div className="success-icon">🎉</div>
              <h2 className="success-title">{t.success}</h2>
              <p className="success-message">
                {t.success_message}<br />
                <span className="success-email">{formData.ac1_email}</span>
              </p>
              <button className="btn btn-primary" onClick={() => window.location.reload()} style={{ maxWidth: 250, margin: '0 auto' }}>
                Nueva inscripción
              </button>
            </div>
          )}
        </div>
      </div>
    </>
  );
}

export async function getServerSideProps({ req }) {
  const host = req.headers.host || '';
  const schoolSlug = process.env.SCHOOL_SLUG || host.split('.')[0] || 'demo';
  
  // Fetch school data from database
  let schoolData = null;
  try {
    const { Pool } = require('pg');
    const pool = new Pool({
      connectionString: process.env.DATABASE_URL,
      ssl: false,
    });
    
    const result = await pool.query(
      'SELECT * FROM schools WHERE slug = $1 OR dominio = $2 LIMIT 1',
      [schoolSlug, host]
    );
    
    if (result.rows.length > 0) {
      schoolData = result.rows[0];
    }
    await pool.end();
  } catch (e) {
    console.error('Error fetching school:', e);
  }
  
  return {
    props: {
      schoolConfig: {
        school: {
          id: schoolData?.id || 1,
          name: schoolData?.nombre || process.env.SCHOOL_NAME || 'Colegio Demo',
          slug: schoolData?.slug || schoolSlug,
          domain: schoolData?.dominio || host,
          logoUrl: schoolData?.logo_url || process.env.SCHOOL_LOGO_URL || '',
        faviconUrl: schoolData?.favicon_url || process.env.SCHOOL_FAVICON_URL || '',
        },
        colors: {
          primary: schoolData?.color_primario || process.env.SCHOOL_COLOR_PRIMARY || '#6366f1',
          secondary: schoolData?.color_secundario || process.env.SCHOOL_COLOR_SECONDARY || '#8b5cf6',
        },
      },
    },
  };
}
