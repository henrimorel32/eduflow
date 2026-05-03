import express from 'express';
import { Queue } from 'bullmq';
import IORedis from 'ioredis';

const app = express();
app.use(express.json());

const connection = new IORedis({
  host: process.env.REDIS_HOST || 'localhost',
  port: parseInt(process.env.REDIS_PORT || '6379', 10),
  maxRetriesPerRequest: null
});

const queue = new Queue('deploy-school', { connection });

app.post('/deploy', async (req, res) => {
  const { school_id, slug, domain, name, logo_url, favicon_url, color_primario, color_secundario } = req.body;

  if (!slug || !domain || !name) {
    return res.status(400).json({
      success: false,
      error: 'Champs requis manquants: slug, domain, name'
    });
  }

  try {
    const job = await queue.add('deploy', { school_id, slug, domain, name, logo_url, favicon_url, color_primario, color_secundario });
    console.log(`📤 Job ajouté - ID: ${job.id}, slug: ${slug}`);
    return res.json({ success: true, jobId: job.id });
  } catch (err) {
    console.error('❌ Erreur queue:', err.message);
    return res.status(500).json({ success: false, error: err.message });
  }
});

app.get('/health', (_req, res) => {
  res.json({ status: 'ok', queue: 'deploy-school' });
});

const PORT = process.env.QUEUE_API_PORT || 3001;
app.listen(PORT, () => {
  console.log(`🌐 Queue API écoute sur le port ${PORT}`);
});
