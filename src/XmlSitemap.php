<?php

namespace SergeyBruhin\XmlSitemap;

use Carbon\Carbon;
use JetBrains\PhpStorm\Pure;
use SergeyBruhin\XmlSitemap\Dto\XmlSitemapIndex;
use SergeyBruhin\XmlSitemap\Dto\XmlSitemapSitemap;

class XmlSitemap
{
    #[Pure] public static function createIndex(
        string $fileName = 'sitemap_index.xml',
        string $disk = null
    ): XmlSitemapIndex
    {
        return new XmlSitemapIndex($fileName, $disk);
    }

    public static function createSitemap(
        string $fileName = 'sitemap.xml',
        Carbon $lastModificationDate = null,
        string $disk = null
    ): XmlSitemapSitemap
    {
        return new XmlSitemapSitemap($fileName, $lastModificationDate, $disk);
    }

    public function storeSitemap(XmlSitemapSitemap $sitemap): void
    {
        $content = $this->renderSitemap($sitemap);
        $this->storeToFile($content, $sitemap->getPath());
    }

    public function storeIndex(XmlSitemapIndex $sitemapIndex): void
    {
        $content = $this->renderSitemapIndex($sitemapIndex);
        $this->storeToFile($content, $sitemapIndex->getPath());
    }

    private function renderSitemapIndex(XmlSitemapIndex $sitemapIndex): string
    {
        return view('xml-sitemap::pages.index')
            ->with(compact('sitemapIndex'))
            ->render();
    }

    private function renderSitemap(XmlSitemapSitemap $sitemap): string
    {
        return view('xml-sitemap::pages.sitemap')
            ->with(compact('sitemap'))
            ->render();
    }

    private function storeToFile(string $content, string $path): void
    {
        file_put_contents($path, $content);
    }
}
