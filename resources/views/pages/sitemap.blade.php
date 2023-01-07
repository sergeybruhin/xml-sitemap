@extends('xml-sitemap::layouts.sitemap')
@section('content')
    @foreach($sitemap->urls as $url)
        @include('xml-sitemap::templates.url')
    @endforeach
@endsection
