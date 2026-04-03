<?php
declare(strict_types=1);

$pages = [
    ['url' => '/', 'priority' => '1.0', 'freq' => 'weekly'],
    ['url' => '/soluciones', 'priority' => '0.9', 'freq' => 'monthly'],
    ['url' => '/icfes', 'priority' => '0.9', 'freq' => 'weekly'],
    ['url' => '/contacto', 'priority' => '0.7', 'freq' => 'monthly'],
];

$baseUrl = 'https://henrimorel.com';
$lastMod = date('Y-m-d');

header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $page): ?>
  <url>
    <loc><?= htmlspecialchars($baseUrl . $page['url']) ?></loc>
    <lastmod><?= $lastMod ?></lastmod>
    <changefreq><?= $page['freq'] ?></changefreq>
    <priority><?= $page['priority'] ?></priority>
  </url>
<?php endforeach; ?>
</urlset>