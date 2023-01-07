# Laravel Xml Sitemap

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sergeybruhin/xml-sitemap.svg?style=flat-square)](https://packagist.org/packages/sergeybruhin/xml-sitemap)
[![Total Downloads](https://img.shields.io/packagist/dt/sergeybruhin/xml-sitemap.svg?style=flat-square)](https://packagist.org/packages/sergeybruhin/xml-sitemap)

Basic and simple package to help you generate XML sitemap.

## Installation

You can install the package via composer:

```bash
composer require sergeybruhin/xml-sitemap
```

## Compose and store Sitemaps in a Laravel command or wherever you want

```php
<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use SergeyBruhin\XmlSitemap\Dto\XmlSitemapImage;
use SergeyBruhin\XmlSitemap\Dto\XmlSitemapSitemap;
use SergeyBruhin\XmlSitemap\Dto\XmlSitemapUrl;
use SergeyBruhin\XmlSitemap\Facades\XmlSitemap;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'generate:sitemap';

    protected $description = 'Generate sitemap';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $sitemapIndex = XmlSitemap::createIndex();
        $sitemapIndex->addSitemap($this->createPagesSitemap());

        XmlSitemap::storeIndex($sitemapIndex);
        foreach ($sitemapIndex->sitemaps as $sitemap) {
            XmlSitemap::storeSitemap($sitemap);
        }

        return 1;

    }

    private function createPagesSitemap(): XmlSitemapSitemap
    {
        $sitemap = XmlSitemap::createSitemap('pages_sitemap.xml');

        Page::each(function (Page $page) use ($sitemap) {
            $url = new XmlSitemapUrl(route('page', $page->slug), 0.8);
            $url->setLastModificationDate($page->updated_at);
            $url->setFrequency(XmlSitemapUrl::WEEKLY);
            $url->addAlternate(route('page', $page->slug) . '/en', 'en');
            $url->addImage((new XmlSitemapImage('https://some/image/url.png')));

            $sitemap->addUrl($url);
        });
        return $sitemap;
    }
}

```

## Run Command via scheduler every "period of time"

```php
  protected function schedule(Schedule $schedule): void
    {
        $schedule->command('generate:sitemap')->hourly();
    }
```

### Testing (Not yet 💁‍♂️)

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email sundaycreative@gmail.com instead of using the issue tracker.

## Credits

- [Sergey Bruhin](https://github.com/sergeybruhin)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
