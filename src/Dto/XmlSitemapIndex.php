<?php

namespace SergeyBruhin\XmlSitemap\Dto;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\Pure;

final class XmlSitemapIndex
{
    private string $fileName;
    private string|null $disk;

    /**
     * @var Collection<XmlSitemapSitemap>
     */
    public Collection $sitemaps;

    #[Pure] public function __construct(string $fileName = 'sitemap_index.xml', string $disk = null)
    {
        $this->fileName = $fileName;
        $this->disk = $disk;
        $this->sitemaps = new Collection;
    }

    public function addSitemap(XmlSitemapSitemap $sitemap): XmlSitemapIndex
    {
        $this->sitemaps->add($sitemap);
        return $this;
    }

    public function getUrl(): string
    {
        if ($this->disk !== null) {
            return Storage::disk($this->disk)->url($this->fileName);
        }
        return url($this->fileName);
    }

    public function getPath(): string
    {
        if ($this->disk !== null) {
            return Storage::disk($this->disk)->path($this->fileName);
        }
        return public_path($this->fileName);
    }
}
