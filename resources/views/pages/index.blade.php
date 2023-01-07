@extends('xml-sitemap::layouts.index')
@section('content')
    @php
        /** @var SergeyBruhin\XmlSitemap\Dto\XmlSitemapIndex $sitemapIndex **/
    @endphp
    @foreach($sitemapIndex->sitemaps as $sitemap)
        @include('xml-sitemap::templates.sitemap-url')
    @endforeach
@endsection
