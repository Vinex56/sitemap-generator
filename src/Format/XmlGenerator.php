<?php

namespace Vinex56\SitemapGenerator\Format;

class XmlGenerator
{
    private $pages;

    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }

    public function generate(): string
    {
        $xml = new \SimpleXMLElement('<urlset/>');
        $xml->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->addAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        foreach ($this->pages as $page) {
            $url = $xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($page['loc']));
            $url->addChild('lastmod', $page['lastmod']);
            $url->addChild('priority', $page['priority']);
            $url->addChild('changefreq', $page['changefreq']);
        }

        return $xml->asXML();
    }
}
