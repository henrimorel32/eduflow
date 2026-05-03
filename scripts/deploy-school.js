import Docker from 'dockerode';
import { existsSync, mkdirSync, cpSync, rmSync, copyFileSync } from 'fs';
import { dirname } from 'path';

const docker = new Docker();

async function ensureImage(imageName) {
  try {
    const image = docker.getImage(imageName);
    await image.inspect();
    console.log(`🖼️  Image ${imageName} déjà présente`);
  } catch (e) {
    console.log(`⬇️  Pull de l'image ${imageName}...`);
    const stream = await docker.pull(imageName);
    await new Promise((resolve, reject) => {
      docker.modem.followProgress(stream, (err, res) => {
        if (err) return reject(err);
        console.log(`✅ Image ${imageName} pullée`);
        resolve(res);
      });
    });
  }
}

export async function deploySchool({ slug, domain, name, logo_url, favicon_url, color_primario, color_secundario }) {
  const containerName = `school_${slug}`;
  const baseDir = process.env.APPS_BASE_DIR || '/opt/docker/apps';
  const schoolDir = `${baseDir}/${slug}`;
  const templatePath = process.env.TEMPLATE_PATH || `${baseDir}/eduflow/nextjs-template`;

  console.log(`🚀 Déploiement ${slug}`);

  // 1. Copier le template dans le dossier de l'école
  if (existsSync(schoolDir)) {
    rmSync(schoolDir, { recursive: true, force: true });
  }
  mkdirSync(schoolDir, { recursive: true });
  cpSync(templatePath, schoolDir, { recursive: true });

  // 1b. Copier le logo et favicon locaux dans public/ s'ils ne sont pas sur un CDN
  const uploadsBaseDir = process.env.UPLOADS_BASE_DIR || '/var/www/html';
  
  if (logo_url && !logo_url.startsWith('http')) {
    const sourcePath = `${uploadsBaseDir}${logo_url}`;
    const destPath = `${schoolDir}/public${logo_url}`;
    if (existsSync(sourcePath)) {
      mkdirSync(dirname(destPath), { recursive: true });
      copyFileSync(sourcePath, destPath);
      console.log(`📁 Logo copié: ${sourcePath} → ${destPath}`);
    } else {
      console.warn(`⚠️ Logo source introuvable: ${sourcePath}`);
    }
  }
  
  if (favicon_url && !favicon_url.startsWith('http')) {
    const sourcePath = `${uploadsBaseDir}${favicon_url}`;
    const destPath = `${schoolDir}/public${favicon_url}`;
    if (existsSync(sourcePath)) {
      mkdirSync(dirname(destPath), { recursive: true });
      copyFileSync(sourcePath, destPath);
      console.log(`📁 Favicon copié: ${sourcePath} → ${destPath}`);
    } else {
      console.warn(`⚠️ Favicon source introuvable: ${sourcePath}`);
    }
  }

  // 2. Vérifier si container existe déjà
  try {
    const existing = docker.getContainer(containerName);
    await existing.inspect();
    throw new Error(`Container ${containerName} existe déjà`);
  } catch (e) {
    // ok s'il n'existe pas
  }

  // 3. S'assurer que l'image Docker est disponible
  await ensureImage('node:20-alpine');

  // 4. Créer container
  const container = await docker.createContainer({
    Image: 'node:20-alpine',
    name: containerName,
    WorkingDir: '/app',
    Cmd: ['sh', '-c', '[ -d node_modules ] || npm install && npm run build && npx next start -H 0.0.0.0'],
    
    Env: [
      `SCHOOL_SLUG=${slug}`,
      `SCHOOL_NAME=${name}`,
      `SCHOOL_DOMAIN=${domain}`,
      `SCHOOL_LOGO_URL=${logo_url || ''}`,
      `SCHOOL_FAVICON_URL=${favicon_url || ''}`,
      `SCHOOL_COLOR_PRIMARY=${color_primario || ''}`,
      `SCHOOL_COLOR_SECONDARY=${color_secundario || ''}`,
      `NODE_ENV=production`,
      `PORT=3000`,
      `DATABASE_URL=postgresql://edu_admin:${process.env.POSTGRES_PASSWORD || 'password'}@postgres:5432/edu_platform`,
      `REDIS_URL=redis://redis:6379`
    ],

    HostConfig: {
      Binds: [`${schoolDir}:/app`],
      RestartPolicy: {
        Name: 'unless-stopped'
      }
    },

    NetworkingConfig: {
      EndpointsConfig: {
        eduflow_edu_internal: {}
      }
    },

    Labels: {
      "traefik.enable": "true",
      [`traefik.http.routers.school-${slug}.rule`]:
        `Host(\`${domain}\`) || Host(\`www.${domain}\`)`,
      [`traefik.http.routers.school-${slug}.entrypoints`]: "websecure",
      [`traefik.http.routers.school-${slug}.tls.certresolver`]: "letsencrypt",
      [`traefik.http.services.school-${slug}.loadbalancer.server.port`]: "3000"
    }
  });

  await container.start();

  // 4. Connecter au réseau proxy pour Traefik (optionnel en local)
  try {
    await docker.getNetwork('edu_proxy').connect({ Container: container.id });
  } catch (netErr) {
    console.warn(`⚠️  Impossible de connecter au réseau edu_proxy: ${netErr.message}`);
  }

  console.log(`✅ Container lancé: ${containerName}`);

  return {
    success: true,
    container: containerName,
    url: `https://${domain}`
  };
}