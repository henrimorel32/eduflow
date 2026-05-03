import { Pool } from 'pg';

// Connexion PostgreSQL
const pool = new Pool({
  connectionString: process.env.DATABASE_URL,
});

export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Method not allowed' });
  }

  const { schoolName, email, phone, adminName, lang, schoolSlug } = req.body;

  // Validation
  if (!schoolName || !email || !phone || !adminName) {
    return res.status(400).json({ error: 'Todos los campos son requeridos' });
  }

  try {
    // Générer un slug unique
    const slug = schoolName.toLowerCase()
      .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/^-|-$/g, '');

    const domain = `${slug}.henrimorel.com`;

    // Sauvegarder dans PostgreSQL
    await pool.query(`
      INSERT INTO schools (slug, name, domain, email, phone, admin_name, lang, status, created_at)
      VALUES ($1, $2, $3, $4, $5, $6, $7, 'pending', NOW())
      ON CONFLICT (slug) DO UPDATE SET
        name = $2, email = $4, phone = $5, admin_name = $6, lang = $7, updated_at = NOW()
    `, [slug, schoolName, domain, email, phone, adminName, lang || 'es']);

    // TODO: Déclencher la création du container via un service externe
    // Pour l'instant, on retourne succès
    
    return res.status(200).json({ 
      success: true, 
      message: 'Colegio registrado exitosamente',
      slug,
      domain
    });

  } catch (error) {
    console.error('Error creating school:', error);
    return res.status(500).json({ error: 'Error al crear el colegio' });
  }
}
