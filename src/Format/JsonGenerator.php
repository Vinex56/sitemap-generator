<?php

namespace Vinex56\SitemapGenerator\Format;

class JsonGenerator
{
    private $pages;

    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }

    public function generate(): string
    {
        return json_encode($this->pages, JSON_PRETTY_PRINT);
    }
}
