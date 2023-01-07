<?php

namespace SergeyBruhin\XmlSitemap\Dto;

class XmlSitemapImage
{
    public string $url;

    public ?string $caption;

    public ?string $geoLocation;

    public ?string $title;

    public ?string $license;

    public function __construct(string $url, string $caption = null, string $geo_location = null, string $title = null, string $license = null)
    {
        $this->setUrl($url);
        $this->setCaption($caption);
        $this->setGeoLocation($geo_location);
        $this->setTitle($title);
        $this->setLicense($license);
    }

    /**
     * @param string $url
     * @return XmlSitemapImage
     */
    public function setUrl(string $url): XmlSitemapImage
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string|null $caption
     * @return XmlSitemapImage
     */
    public function setCaption(?string $caption): XmlSitemapImage
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @param string|null $geoLocation
     * @return XmlSitemapImage
     */
    public function setGeoLocation(?string $geoLocation): XmlSitemapImage
    {
        $this->geoLocation = $geoLocation;
        return $this;
    }

    /**
     * @param string|null $title
     * @return XmlSitemapImage
     */
    public function setTitle(?string $title): XmlSitemapImage
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string|null $license
     * @return XmlSitemapImage
     */
    public function setLicense(?string $license): XmlSitemapImage
    {
        $this->license = $license;
        return $this;
    }

}
