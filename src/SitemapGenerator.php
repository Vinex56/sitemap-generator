<?php

namespace Vinex56\SitemapGenerator;

use Vinex56\SitemapGenerator\Exception\InvalidArgumentException;
use Vinex56\SitemapGenerator\Exception\FileWriteException;

class SitemapGenerator
{
    private $pages;
    private $format;
    private $filePath;

    public function __construct(array $pages, string $format, string $filePath)
    {
        $this->validatePages($pages);
        $this->validateFormat($format);
        $this->pages = $pages;
        $this->format = $format;
        $this->filePath = $filePath;

        $this->createDirectoryIfNotExists();
    }

    public function generate()
    {
        switch ($this->format) {
            case 'xml':
                $generator = new Format\XmlGenerator($this->pages);
                break;
            case 'csv':
                $generator = new Format\CsvGenerator($this->pages);
                break;
            case 'json':
                $generator = new Format\JsonGenerator($this->pages);
                break;
            default:
                throw new InvalidArgumentException("Unsupported format: {$this->format}");
        }

        $content = $generator->generate();
        if (file_put_contents($this->filePath, $content) === false) {
            throw new FileWriteException("Failed to write to file: {$this->filePath}");
        }
    }

    private function validatePages(array $pages)
    {
        foreach ($pages as $page) {
            if (!isset($page['loc'], $page['lastmod'], $page['priority'], $page['changefreq'])) {
                throw new InvalidArgumentException("Invalid page data: " . json_encode($page));
            }
        }
    }

    private function validateFormat(string $format)
    {
        $validFormats = ['xml', 'csv', 'json'];
        if (!in_array($format, $validFormats, true)) {
            throw new InvalidArgumentException("Invalid format: {$format}");
        }
    }

    private function createDirectoryIfNotExists()
    {
        $directory = dirname($this->filePath);
        if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            throw new FileWriteException("Failed to create directory: {$directory}");
        }
    }
}
