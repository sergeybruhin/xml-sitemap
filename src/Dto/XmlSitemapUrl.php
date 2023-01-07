<?php

namespace SergeyBruhin\XmlSitemap\Dto;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

final class XmlSitemapUrl
{
    public const ALWAYS = "always";
    public const HOURLY = "hourly";
    public const DAILY = "daily";
    public const WEEKLY = "weekly";
    public const MONTHLY = "monthly";
    public const YEARLY = "yearly";
    public const NEVER = "never";

    public string $frequency;
    public string $url;
    public float $priority;
    public Carbon $lastModificationDate;

    /**
     * @var Collection<XmlSitemapAlternate>
     */
    public Collection $alternates;

    /**
     * @var Collection<XmlSitemapImage>
     */
    public Collection $images;

    #[Pure] public function __construct(string $url, float $priority = 0.8)
    {
        $this->url = $url;
        $this->priority = $priority;
        $this->frequency = self::DAILY;
        $this->alternates = new Collection;
        $this->images = new Collection;
    }

    public function setFrequency(string $frequency): XmlSitemapUrl
    {
        $this->frequency = $frequency;
        return $this;
    }

    public function setLastModificationDate(Carbon $lastModificationDate): XmlSitemapUrl
    {
        $this->lastModificationDate = $lastModificationDate;
        return $this;
    }

    /**
     * @param float $priority
     * @return XmlSitemapUrl
     */
    public function setPriority(float $priority): XmlSitemapUrl
    {
        $this->priority = max(0, min($priority, 1));;
        return $this;
    }

    public function addAlternate(string $url, string $locale): XmlSitemapUrl
    {
        $this->alternates->add(new XmlSitemapAlternate($url, $locale));
        return $this;
    }

    public function pushAlternate(XmlSitemapAlternate $alternate): XmlSitemapUrl
    {
        $this->alternates->add($alternate);
        return $this;
    }

    public function pushImage(XmlSitemapImage $image): XmlSitemapUrl
    {
        $this->images->add($image);
        return $this;
    }

    public function addImage(XmlSitemapImage $image): XmlSitemapUrl
    {
        $this->images->add($image);
        return $this;
    }

    public function getLastModificationDate(): string
    {
        return $this->lastModificationDate->toAtomString();
    }


}
