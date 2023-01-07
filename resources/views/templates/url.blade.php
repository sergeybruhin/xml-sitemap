<url>
    <loc>{{ url($url->url) }}</loc>
    @if (!empty($url->lastModificationDate))
        <lastmod>{{ $url->getLastModificationDate() }}</lastmod>
    @endif
    @if (!empty($url->frequency))
        <changefreq>{{ $url->frequency }}</changefreq>
    @endif
    @if (!empty($url->priority))
        <priority>{{ $url->priority }}</priority>
    @endif
    @if ($url->alternates->count())
        @foreach ($url->alternates as $alternate)
            @include('xml-sitemap::templates.url-alternate')
        @endforeach
    @endif
    @if ($url->images->count())
        @foreach ($url->images as $image)
            @include('xml-sitemap::templates.url-image')
        @endforeach
    @endif
</url>
