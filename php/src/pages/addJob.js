import { Queue } from 'bullmq';
import IORedis from 'ioredis';

const connection = new IORedis();

const queue = new Queue('deploy-school', { connection });

const job = await queue.add('deploy', {
  slug: process.argv[2],
  domain: process.argv[3],
  name: process.argv[4]
}, {
  attempts: 3,
  backoff: {
    type: 'exponential',
    delay: 5000
  }
});

console.log("Job ajouté:", job.id);
process.exit(0);