@extends('layouts.front.app')
@php
$seo = \App\Http\Controllers\SeoController::index('video');
@endphp

@section('title'){{ $seo['meta_title'][app()->getLocale()] ?? '' }}@endsection
@section('description'){{ $seo['meta_description'][app()->getLocale()] ?? '' }}@endsection
@section('og_title'){{ $seo['meta_title'][app()->getLocale()] ?? '' }}@endsection
@section('og_description'){{ $seo['meta_description'][app()->getLocale()] ?? '' }}@endsection
@section('og_url'){{ $seo['canonical'] ?? '' }}@endsection
@section('og_image'){{ asset('storage/' . $seo['og_image']) }}@endsection
@section('twitter_image'){{ asset('storage/' . $seo['og_image']) }}@endsection
@section('twitter_title'){{ $seo['meta_title'][app()->getLocale()] ?? '' }}@endsection
@section('twitter_description'){{ $seo['meta_description'][app()->getLocale()] ?? '' }}@endsection
@section('canonical'){{ $seo['canonical'] ?? '' }}@endsection
@section('meta')
@endsection

@section('content')

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

<section class="relative py-32 overflow-hidden bg-gradient-to-t from-secondary/80 via-secondary/80 to-transparent">
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-no-repeat bg-center bg-cover"
            style="background-image: url('/assets/images/home-thumb-slider-1.webp')">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/80 to-transparent"></div>
    </div>
    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <div class="mb-16 text-center">
            <h1 class="mb-6 text-4xl font-bold text-gray-900 md:text-5xl lg:text-6xl">
                {{ getSectionHeaders('video')['title'][app()->getLocale()] ?? '' }}
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                {{ getSectionHeaders('video')['description'][app()->getLocale()] ?? '' }}
            </p>
        </div>
    </div>
</section>

<section class="relative py-20 bg-base overflow-hidden">
    <div class="absolute border border-primary rounded-full top-1/4 right-20 w-80 h-80 opacity-10"></div>
    <div class="absolute border border-primary rounded-full bottom-5 left-20 w-80 h-80 opacity-15"></div>
    <!-- Decorative Blobs -->
    <div class="absolute top-10 -left-20 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>

    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <!-- Videos Grid -->
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($videos as $key => $record)
            @php
                // Extract YouTube video ID - Check embed_code first, then video_url
                $videoId = null;
                $urlToCheck = $record->embed_code ?? $record->video_url;
                
                if ($urlToCheck && $urlToCheck != '#') {
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $urlToCheck, $match);
                    $videoId = $match[1] ?? null;
                }
                
                // Determine cover image source
                $coverImage = null;
                if ($record->image) {
                    $coverImage = asset('storage/' . $record->image);
                } elseif ($videoId) {
                    $coverImage = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                }
            @endphp

            @if($videoId)
            <a href="{{ route(app()->getLocale() . '.video.details', $record->id) }}" class="block group">
                <div class="relative rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 bg-white border border-secondary">
                    <div class="relative aspect-video bg-gray-900">
                        <!-- Cover Image -->
                        <img 
                            src="{{ $coverImage }}" 
                            alt="{{ is_array($record->title) ? ($record->title[app()->getLocale()] ?? '') : $record->title }}"
                            class="w-full h-full object-cover transition-opacity duration-300"
                            onerror="this.src='https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg'"
                        >
                        
                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black/30 transition-all duration-300 group-hover:bg-black/40">
                            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 shadow-2xl">
                                <svg class="w-10 h-10 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="transition-all p-6">
                        <h3 class="mb-2 text-lg font-bold text-primary">
                            {{ is_array($record->title) ? ($record->title[app()->getLocale()] ?? '') : $record->title }}
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            {{ is_array($record->description) ? ($record->description[app()->getLocale()] ?? '') : $record->description }}
                        </p>
                    </div>
                </div>
            </a>
            @endif
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $videos->links() }}
        </div>

        <!-- CTA Button -->
        <div class="mt-16 text-center">
            <a href="{{ route( (session('front_locale') ?? app()->getLocale()) . '.' . 'appointment' ) }}"
                class="px-8 py-4 font-semibold text-white transition-all duration-300 rounded-full shadow-lg bg-gradient-to-r from-primary to-primary/90 hover:from-primary/90 hover:to-primary">
                {{ __('buttons.book your consultation') }}
            </a>
        </div>
    </div>
</section>

@endsection