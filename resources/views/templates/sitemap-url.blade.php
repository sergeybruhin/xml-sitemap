@php
    /** @var SergeyBruhin\XmlSitemap\Dto\XmlSitemapSitemap $sitemap */
@endphp
<sitemap>
    <loc>{{ $sitemap->getUrl() }}</loc>
    <lastmod>{{ $sitemap->getLastModificationDate() }}</lastmod>
</sitemap>
