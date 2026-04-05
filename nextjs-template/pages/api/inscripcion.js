const { Pool } = require('pg');
const nodemailer = require('nodemailer');

const pool = new Pool({
  connectionString: process.env.DATABASE_URL,
  ssl: false,
});

// Create Gmail transporter
const createTransporter = () => {
  return nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: process.env.EMAIL_USER,
      pass: process.env.EMAIL_PASSWORD,
    },
  });
};

export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Method not allowed' });
  }

  try {
    const {
      // Acudiente 1
      ac1_nombres, ac1_apellido1, ac1_apellido2,
      ac1_direccion, ac1_ciudad, ac1_pais,
      ac1_profesion, ac1_empresa,
      ac1_prefijo, ac1_telefono, ac1_email,
      ac1_parentesco,
      // Acudiente 2
      ac2_nombres, ac2_apellido1, ac2_apellido2,
      ac2_direccion, ac2_ciudad, ac2_pais,
      ac2_profesion, ac2_empresa,
      ac2_prefijo, ac2_telefono, ac2_email,
      ac2_parentesco,
      // Estudiante
      est_nombres, est_apellido1, est_apellido2,
      est_tipo_doc, est_numero_doc,
      est_fecha_nac, est_lugar_nac,
      est_grado,
      est_antiguo_colegio, est_antiguo_direccion,
      est_antiguo_telefono, est_motivo_retiro,
      lang, schoolId,
    } = req.body;

    // Validar campos requeridos
    if (!ac1_nombres || !ac1_apellido1 || !ac1_direccion || !ac1_ciudad || 
        !ac1_telefono || !ac1_email || !ac1_parentesco ||
        !est_nombres || !est_apellido1 || !est_numero_doc || !est_fecha_nac || !est_grado) {
      return res.status(400).json({ error: 'Campos requeridos faltantes' });
    }

    // Validar email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(ac1_email)) {
      return res.status(400).json({ error: 'Email inválido' });
    }

    // Construir nombres completos
    const acudiente1_nombre = `${ac1_nombres} ${ac1_apellido1} ${ac1_apellido2 || ''}`.trim();
    const acudiente2_nombre = ac2_nombres ? `${ac2_nombres} ${ac2_apellido1 || ''} ${ac2_apellido2 || ''}`.trim() : null;
    const estudiante_nombre = `${est_nombres} ${est_apellido1} ${est_apellido2 || ''}`.trim();

    // Teléfono completo con prefijo
    const acudiente1_telefono = `${ac1_prefijo || '+57'} ${ac1_telefono}`;
    const acudiente2_telefono = ac2_telefono && ac2_prefijo ? `${ac2_prefijo} ${ac2_telefono}` : 
                                  ac2_telefono ? ac2_telefono : null;

    // Obtener nombre del colegio
    const schoolResult = await pool.query(
      'SELECT nombre, email_director FROM schools WHERE id = $1',
      [schoolId || 1]
    );
    const schoolName = schoolResult.rows[0]?.nombre || 'Colegio';
    const directorEmail = schoolResult.rows[0]?.email_director;

    const query = `
      INSERT INTO inscripciones_estudiantes (
        school_id,
        nombre_estudiante,
        fecha_nacimiento,
        grado,
        tipo_documento,
        numero_documento,
        lugar_nacimiento,
        colegio_procedencia,
        direccion_colegio_anterior,
        telefono_colegio_anterior,
        motivo_retiro,
        nombre_acudiente1,
        email_acudiente1,
        telefono_acudiente1,
        parentesco_acudiente1,
        profesion_acudiente1,
        empresa_acudiente1,
        direccion_acudiente1,
        ciudad_acudiente1,
        pais_acudiente1,
        nombre_acudiente2,
        email_acudiente2,
        telefono_acudiente2,
        parentesco_acudiente2,
        profesion_acudiente2,
        empresa_acudiente2,
        direccion_acudiente2,
        ciudad_acudiente2,
        pais_acudiente2,
        idioma_preferido,
        estado,
        created_at
      ) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19, $20, $21, $22, $23, $24, $25, $26, $27, $28, $29, $30, 'pendiente', NOW())
      RETURNING id
    `;

    const values = [
      schoolId || 1,
      estudiante_nombre,
      est_fecha_nac,
      est_grado,
      est_tipo_doc || 'RC',
      est_numero_doc,
      est_lugar_nac || null,
      est_antiguo_colegio || null,
      est_antiguo_direccion || null,
      est_antiguo_telefono || null,
      est_motivo_retiro || null,
      acudiente1_nombre,
      ac1_email,
      acudiente1_telefono,
      ac1_parentesco,
      ac1_profesion || null,
      ac1_empresa || null,
      ac1_direccion,
      ac1_ciudad,
      ac1_pais || 'CO',
      acudiente2_nombre,
      ac2_email || null,
      acudiente2_telefono,
      ac2_parentesco || null,
      ac2_profesion || null,
      ac2_empresa || null,
      ac2_direccion || null,
      ac2_ciudad || null,
      ac2_pais || null,
      lang || 'es',
    ];

    const result = await pool.query(query, values);
    const inscripcionId = result.rows[0].id;

    // Enviar emails
    try {
      const transporter = createTransporter();
      
      // Email al acudiente (confirmación)
      const emailAcudiente = {
        from: `"${schoolName}" <${process.env.EMAIL_USER}>`,
        to: ac1_email,
        subject: `✅ Inscripción Recibida - ${schoolName}`,
        html: `
          <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
              <div style="text-align: center; margin-bottom: 30px;">
                <div style="font-size: 60px; margin-bottom: 10px;">🎓</div>
                <h1 style="color: #1e293b; margin: 0; font-size: 28px;">¡Inscripción Recibida!</h1>
              </div>
              
              <p style="color: #64748b; font-size: 16px; line-height: 1.6;">
                Estimado/a <strong>${acudiente1_nombre}</strong>,
              </p>
              
              <p style="color: #64748b; font-size: 16px; line-height: 1.6;">
                Hemos recibido correctamente la inscripción de <strong>${estudiante_nombre}</strong> en ${schoolName}.
              </p>
              
              <div style="background: #f0fdf4; border-left: 4px solid #22c55e; padding: 15px; margin: 20px 0; border-radius: 8px;">
                <p style="margin: 0; color: #166534; font-weight: 600;">
                  📋 Número de inscripción: #${inscripcionId}
                </p>
              </div>
              
              <h3 style="color: #1e293b; margin-top: 25px;">Resumen de la inscripción:</h3>
              <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <tr>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">Estudiante:</td>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #1e293b; font-weight: 600;">${estudiante_nombre}</td>
                </tr>
                <tr>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">Grado:</td>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #1e293b; font-weight: 600;">${est_grado}</td>
                </tr>
                <tr>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">Documento:</td>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #1e293b; font-weight: 600;">${est_tipo_doc} ${est_numero_doc}</td>
                </tr>
                <tr>
                  <td style="padding: 10px; color: #6b7280;">Teléfono:</td>
                  <td style="padding: 10px; color: #1e293b; font-weight: 600;">${acudiente1_telefono}</td>
                </tr>
              </table>
              
              <p style="color: #64748b; font-size: 14px; margin-top: 25px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                Nos pondremos en contacto con usted próximamente para continuar con el proceso de inscripción.
              </p>
              
              <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <p style="color: #9ca3af; font-size: 12px; margin: 0;">
                  © ${new Date().getFullYear()} ${schoolName} - Todos los derechos reservados
                </p>
              </div>
            </div>
          </div>
        `,
      };

      // Email al director/colegio (notificación)
      const emailDirector = {
        from: `"${schoolName}" <${process.env.EMAIL_USER}>`,
        to: directorEmail || process.env.EMAIL_USER,
        subject: `🎓 Nueva Inscripción #${inscripcionId} - ${estudiante_nombre}`,
        html: `
          <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border: 1px solid #e5e7eb;">
              <h2 style="color: #1e293b; margin-top: 0;">🎓 Nueva Inscripción Recibida</h2>
              
              <div style="background: #eff6ff; padding: 15px; border-radius: 10px; margin: 20px 0;">
                <p style="margin: 0; color: #1e40af; font-size: 18px; font-weight: 600;">
                  Inscripción #${inscripcionId}
                </p>
              </div>
              
              <h3 style="color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Datos del Estudiante</h3>
              <table style="width: 100%; margin-bottom: 20px;">
                <tr><td style="padding: 8px; color: #6b7280;">Nombre:</td><td style="padding: 8px; font-weight: 600;">${estudiante_nombre}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Documento:</td><td style="padding: 8px; font-weight: 600;">${est_tipo_doc} ${est_numero_doc}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Fecha Nac.:</td><td style="padding: 8px; font-weight: 600;">${est_fecha_nac}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Grado:</td><td style="padding: 8px; font-weight: 600;">${est_grado}</td></tr>
                ${est_lugar_nac ? `<tr><td style="padding: 8px; color: #6b7280;">Lugar Nac.:</td><td style="padding: 8px; font-weight: 600;">${est_lugar_nac}</td></tr>` : ''}
                ${est_antiguo_colegio ? `<tr><td style="padding: 8px; color: #6b7280;">Colegio Anterior:</td><td style="padding: 8px; font-weight: 600;">${est_antiguo_colegio}</td></tr>` : ''}
              </table>
              
              <h3 style="color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Acudiente Principal</h3>
              <table style="width: 100%; margin-bottom: 20px;">
                <tr><td style="padding: 8px; color: #6b7280;">Nombre:</td><td style="padding: 8px; font-weight: 600;">${acudiente1_nombre}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Parentesco:</td><td style="padding: 8px; font-weight: 600;">${ac1_parentesco}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Email:</td><td style="padding: 8px; font-weight: 600;">${ac1_email}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Teléfono:</td><td style="padding: 8px; font-weight: 600;">${acudiente1_telefono}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Dirección:</td><td style="padding: 8px; font-weight: 600;">${ac1_direccion}, ${ac1_ciudad}</td></tr>
                ${ac1_profesion ? `<tr><td style="padding: 8px; color: #6b7280;">Profesión:</td><td style="padding: 8px; font-weight: 600;">${ac1_profesion}</td></tr>` : ''}
                ${ac1_empresa ? `<tr><td style="padding: 8px; color: #6b7280;">Empresa:</td><td style="padding: 8px; font-weight: 600;">${ac1_empresa}</td></tr>` : ''}
              </table>
              
              ${acudiente2_nombre ? `
              <h3 style="color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Acudiente 2</h3>
              <table style="width: 100%; margin-bottom: 20px;">
                <tr><td style="padding: 8px; color: #6b7280;">Nombre:</td><td style="padding: 8px; font-weight: 600;">${acudiente2_nombre}</td></tr>
                ${ac2_parentesco ? `<tr><td style="padding: 8px; color: #6b7280;">Parentesco:</td><td style="padding: 8px; font-weight: 600;">${ac2_parentesco}</td></tr>` : ''}
                ${ac2_email ? `<tr><td style="padding: 8px; color: #6b7280;">Email:</td><td style="padding: 8px; font-weight: 600;">${ac2_email}</td></tr>` : ''}
                ${acudiente2_telefono ? `<tr><td style="padding: 8px; color: #6b7280;">Teléfono:</td><td style="padding: 8px; font-weight: 600;">${acudiente2_telefono}</td></tr>` : ''}
              </table>
              ` : ''}
              
              <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin-top: 20px; border-radius: 8px;">
                <p style="margin: 0; color: #92400e;">
                  <strong>⚠️ Acción requerida:</strong> Revisar y contactar al acudiente para continuar con el proceso de inscripción.
                </p>
              </div>
            </div>
          </div>
        `,
      };

      // Enviar emails
      await transporter.sendMail(emailAcudiente);
      console.log('Email de confirmación enviado a:', ac1_email);
      
      if (directorEmail || process.env.EMAIL_USER) {
        await transporter.sendMail(emailDirector);
        console.log('Email de notificación enviado al director');
      }

    } catch (emailError) {
      console.error('Error enviando emails:', emailError);
      // No fallamos la inscripción si el email falla, solo logueamos
    }

    res.status(200).json({ 
      success: true, 
      message: 'Inscripción registrada correctamente',
      inscripcionId: inscripcionId,
    });

  } catch (error) {
    console.error('Error al guardar inscripción:', error);
    res.status(500).json({ 
      error: 'Error al procesar la inscripción',
      details: error.message 
    });
  }
}
