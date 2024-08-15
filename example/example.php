<?php

require 'vendor/autoload.php';

use Vinex56\SitemapGenerator\SitemapGenerator;

$pages = [
    [
        'loc' => 'https://site.com/',
        'lastmod' => '2020-12-14',
        'priority' => '1.0',
        'changefreq' => 'hourly'
    ],
    [
        'loc' => 'https://site.com/news',
        'lastmod' => '2020-12-10',
        'priority' => '0.5',
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'https://site.com/about',
        'lastmod' => '2020-12-07',
        'priority' => '0.1',
        'changefreq' => 'weekly'
    ]
];

try {
    $sitemap = new SitemapGenerator($pages, 'xml', __DIR__ . '/upload/sitemap.xml');
    $sitemap->generate();
    echo "Sitemap generated successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}