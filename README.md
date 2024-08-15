# Sitemap Generator

Sitemap Generator is a PHP library for generating sitemaps in XML, CSV, and JSON formats. This library allows you to easily create sitemaps for your website and save them in the desired format.

## Installation

You can install the library via Composer. Run the following command in your project directory:

```bash
composer require vinex56/sitemap-generator
```

# Usage

Here is an example of how to use the Sitemap Generator:

```php
require 'vendor/autoload.php';
use Vinex56\SitemapGenerator\SitemapGenerator;
$pages = [
    [
        'loc' => 'https://site.ru/',
        'lastmod' => '2020-12-14',
        'priority' => '1',
        'changefreq' => 'hourly'
    ],
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-10',
        'priority' => '0.5',
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'https://site.ru/about',
        'lastmod' => '2020-12-07',
        'priority' => '0.1',
        'changefreq' => 'weekly'
    ]
];
try {
    $sitemap = new SitemapGenerator($pages, 'json', __DIR__ . '/upload/sitemap.json');
    $sitemap->generate();
    echo "Sitemap generated successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
```

# Features

Supports generating sitemaps in XML, CSV, and JSON formats.
Automatically creates the directory for the sitemap file if it doesn't exist.
Validates input data to ensure proper sitemap generation.
Throws custom exceptions for various errors (e.g., invalid data, file write errors).

# Requirements

- PHP 7.4 or higher
- Composer

# License

This library is licensed under the MIT License. See the LICENSE file for more details.