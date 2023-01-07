<?php

namespace SergeyBruhin\XmlSitemap\Facades;

use Illuminate\Support\Facades\Facade;

class XmlSitemap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'xml-sitemap';
    }
}
