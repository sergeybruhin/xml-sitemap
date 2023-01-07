<?php

namespace SergeyBruhin\XmlSitemap\Dto;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class XmlSitemapSitemap
{
    private string $fileName;
    private string|null $disk;
    private Carbon $lastModificationDate;

    /**
     * @var Collection<XmlSitemapUrl>
     */
    public Collection $urls;

    public function __construct(string $fileName, Carbon $lastModificationDate = null, string $disk = null)
    {
        $this->fileName = $fileName;
        $this->disk = $disk;
        $this->urls = new Collection;
        $this->lastModificationDate = $lastModificationDate ?? Carbon::now();
    }

    public function addUrl(XmlSitemapUrl $url)
    {
        $this->urls->add($url);
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

    public function getLastModificationDate(): string
    {
        return $this->lastModificationDate->toAtomString();
    }
}
