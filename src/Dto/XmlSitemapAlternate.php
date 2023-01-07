<?php

namespace SergeyBruhin\XmlSitemap\Dto;

class XmlSitemapAlternate
{
    public string $locale;

    public string $url;

    public function __construct(string $url, string $locale)
    {
        $this->locale = $locale;
        $this->url = $url;
    }
}
