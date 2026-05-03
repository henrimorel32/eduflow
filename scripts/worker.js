import { Worker } from 'bullmq';
import IORedis from 'ioredis';
import { deploySchool } from './deploy-school.js';

const connection = new IORedis({
  host: process.env.REDIS_HOST || 'localhost',
  port: parseInt(process.env.REDIS_PORT || '6379', 10),
  maxRetriesPerRequest: null
});

const worker = new Worker('deploy-school', async job => {
  const { slug } = job.data;

  console.log(`📥 Job reçu: ${slug}`);

  try {
    const result = await deploySchool(job.data);
    console.log(`✅ ${slug} déployé`);
    return result;
  } catch (err) {
    console.error(`❌ Erreur déploiement ${slug}:`, err.message);
    throw err; // BullMQ gère le retry automatiquement
  }
}, {
  connection,
  concurrency: parseInt(process.env.WORKER_CONCURRENCY || '2', 10)
});

console.log('👷 Worker démarré (queue: deploy-school)');