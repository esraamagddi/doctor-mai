@extends('layouts.front.app')

@php
$seo = \App\Http\Controllers\SeoController::index('reels') ?: \App\Http\Controllers\SeoController::index('video');
@endphp

@section('title'){{ $seo['meta_title'][app()->getLocale()] ?? '' }}@endsection
@section('description'){{ $seo['meta_description'][app()->getLocale()] ?? '' }}@endsection
@section('og_title'){{ $seo['meta_title'][app()->getLocale()] ?? '' }}@endsection
@section('og_description'){{ $seo['meta_description'][app()->getLocale()] ?? '' }}@endsection
@section('og_url'){{ $seo['canonical'] ?? '' }}@endsection
@section('og_image'){{ isset($seo['og_image']) ? asset('storage/' . $seo['og_image']) : '' }}@endsection
@section('twitter_image'){{ isset($seo['og_image']) ? asset('storage/' . $seo['og_image']) : '' }}@endsection
@section('twitter_title'){{ $seo['meta_title'][app()->getLocale()] ?? '' }}@endsection
@section('twitter_description'){{ $seo['meta_description'][app()->getLocale()] ?? '' }}@endsection
@section('canonical'){{ $seo['canonical'] ?? '' }}@endsection
@section('meta')
@endsection

@section('content')

{{-- Schemas --}}
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "{{ Setting()->site_name[app()->getLocale()] ?? '' }}",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('storage/' . Setting()->logo_light) }}",
    "description": "{{ Setting()->site_description[app()->getLocale()] ?? '' }}"
  }
</script>
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "{{ url('/') }}",
    "name": "{{ Setting()->site_name[app()->getLocale()] ?? '' }}",
    "publisher": {
      "@type": "Organization",
      "name": "{{ Setting()->site_name[app()->getLocale()] ?? '' }}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ asset('storage/' . Setting()->logo_light) }}"
      }
    }
  }
</script>

{{-- ===== Hero ===== --}}
<section class="relative py-32 overflow-hidden bg-gradient-to-t from-secondary/80 via-secondary/80 to-transparent">
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-no-repeat bg-center bg-cover"
      style="background-image: url('/images/home-thumb-slider-1.webp')">
    </div>
    <!-- <div class="absolute inset-0 bg-gradient-to-l from-secondary from-50% via-transparent to-transparent"></div> -->
  </div>
  <div class="container relative z-10 px-6 mx-auto max-w-7xl">
    <div class="mb-16 text-center">
      <h1 class="mb-6 text-4xl font-bold text-gray-900 md:text-5xl lg:text-6xl">
        {{ getSectionHeaders('reels')['title'][app()->getLocale()] ?? '' }}
      </h1>
      <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
        {{ getSectionHeaders('reels')['description'][app()->getLocale()] ?? '' }}
      </p>
    </div>
  </div>
</section>

{{-- ===== Reels Grid ===== --}}
<section class="py-20 bg-image-overlay animate-in" id="reels-page">
  <div class="container mx-auto px-4">

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
      @forelse($reels as $reel)
      @php
      $title = $reel->title[app()->getLocale()] ?? '';
      $thumb = !empty($reel->image) ? asset('storage/' . $reel->image) : null;
      $embed = $reel->embed_code ?? $reel->video_url ?? '';
      @endphp

      <button type="button"
        class="reel-card"
        data-embed='@json($embed)'
        aria-label="Play reel: {{ strip_tags($title) }}">
        <div class="reel-thumb" style="background-image:url('{{ $thumb }}');">
          <span class="reel-badge">REEL</span>
          <span class="reel-play" aria-hidden="true">▶</span>
        </div>
        <div class="reel-caption">{!! $title !!}</div>
      </button>
      @empty
      <div class="col-span-full text-center text-gray-500">
        {{ __('reels.no_items') }}
      </div>
      @endforelse
    </div>

    <div class="text-center mt-12">
      {{ $reels->links() }}
    </div>
  </div>
</section>

{{-- ===== Popup Player (same behaviour as home) ===== --}}
<div id="reelModal" class="reel-modal" hidden>
  <div class="reel-backdrop" data-close></div>
  <div class="reel-dialog" role="dialog" aria-modal="true" aria-label="Reel player">
    <button type="button" class="reel-close" data-close aria-label="{{ __('reels.close') }}">×</button>
    <div class="reel-player">
      <iframe id="reelFrame" src="" frameborder="0"
        allow="autoplay; encrypted-media; picture-in-picture"
        allowfullscreen></iframe>
    </div>
  </div>
</div>


@endsection