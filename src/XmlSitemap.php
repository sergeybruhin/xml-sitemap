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

    public static function storeSitemap(XmlSitemapSitemap $sitemap): void
    {
        $content = self::renderSitemap($sitemap);
        self::storeToFile($content, $sitemap->getPath());
    }

    public static function storeIndex(XmlSitemapIndex $sitemapIndex): void
    {
        $content = self::renderSitemapIndex($sitemapIndex);
        self::storeToFile($content, $sitemapIndex->getPath());
    }

    private static function renderSitemapIndex(XmlSitemapIndex $sitemapIndex): string
    {
        return view('xml-sitemap::pages.index')
            ->with(compact('sitemapIndex'))
            ->render();
    }

    private static function renderSitemap(XmlSitemapSitemap $sitemap): string
    {
        return view('xml-sitemap::pages.sitemap')
            ->with(compact('sitemap'))
            ->render();
    }

    private static function storeToFile(string $content, string $path): void
    {
        file_put_contents($path, $content);
    }
}
