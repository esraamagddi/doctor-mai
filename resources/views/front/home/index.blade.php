@extends('layouts.front.app')

@php
    $seo = \App\Http\Controllers\SeoController::index('home');
@endphp

@section('title'){{ getLocalized($seo['meta_title']) }}@endsection
@section('description'){{ getLocalized($seo['meta_description']) }}@endsection

@section('og_title'){{ getLocalized($seo['meta_title']) }}@endsection
@section('og_description'){{ getLocalized($seo['meta_description']) }}@endsection
@section('og_url'){{ $seo['canonical'] ?? url('/') }}@endsection
@section('og_image'){{ !empty($seo['og_image']) ? asset('storage/' . $seo['og_image']) : '' }}@endsection

@section('twitter_image'){{ !empty($seo['og_image']) ? asset('storage/' . $seo['og_image']) : '' }}@endsection
@section('twitter_title'){{ getLocalized($seo['meta_title']) }}@endsection
@section('twitter_description'){{ getLocalized($seo['meta_description']) }}@endsection

@section('canonical'){{ $seo['canonical'] ?? url('/') }}@endsection

@section('meta')
@endsection

@section('content')
    {{-- Organization Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "{{ getLocalized(Setting()->site_name) }}",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('storage/' . Setting()->logo_light) }}",
      "description": "{{ getLocalized(Setting()->site_description) }}"
    }
    </script>

    {{-- Website Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "{{ url('/') }}",
      "name": "{{ getLocalized(Setting()->site_name) }}",
      "publisher": {
        "@type": "Organization",
        "name": "{{ getLocalized(Setting()->site_name) }}",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('storage/' . Setting()->logo_light) }}"
        }
      }
    }
    </script>

    @include('front.home.hero-section')
    @include('front.home.about')
    @include('front.home.services')
    @include('front.home.transformations')
    @include('front.home.video')
    @include('front.home.gallery')
    @include('front.home.blog')
    @include('front.home.testimonials')
    @include('front.home.appointment')
@endsection
