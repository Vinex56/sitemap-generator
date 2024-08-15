<?php

namespace Vinex56\SitemapGenerator\Format;

class CsvGenerator
{
    private $pages;

    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }

    public function generate(): string
    {
        $output = fopen('php://temp', 'r+');
        fputcsv($output, ['loc', 'lastmod', 'priority', 'changefreq'], ';');

        foreach ($this->pages as $page) {
            fputcsv($output, [
                $page['loc'],
                $page['lastmod'],
                $page['priority'],
                $page['changefreq']
            ], ';');
        }

        rewind($output);
        return stream_get_contents($output);
    }
}
