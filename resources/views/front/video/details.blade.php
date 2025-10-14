@extends('layouts.front.app')

@section('title'){{ $video->title[app()->getLocale()] ?? '' }}@endsection
@section('description'){{ $video->description[app()->getLocale()] ?? '' }}@endsection

@section('og_title'){{ $video->title[app()->getLocale()] ?? '' }}@endsection
@section('og_description'){{ $video->description[app()->getLocale()] ?? '' }}@endsection
@section('og_url'){{ route(app()->getLocale() . '.video.details', $video->id) }}@endsection
@section('og_image'){{ $video->image ? asset('storage/' . $video->image) : '' }}@endsection

@section('twitter_image'){{ $video->image ? asset('storage/' . $video->image) : '' }}@endsection
@section('twitter_title'){{ $video->title[app()->getLocale()] ?? '' }}@endsection
@section('twitter_description'){{ $video->description[app()->getLocale()] ?? '' }}@endsection

@section('canonical'){{ route(app()->getLocale() . '.video.details', $video->id) }}@endsection

@section('meta')@endsection

@section('css')
    <link rel="stylesheet" href="/assets/css/blog.css?v=5">
    <style>
        iframe {
            width: 100% !important;
            height: 100% !important;
            aspect-ratio: 16/9;
        }
    </style>
@endsection

@section('content')

{{-- Schema.org Organization --}}
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

{{-- Schema.org Website --}}
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

<section id="news" class="py-20 bg-image-overlay animate-in">
    <div class="container mx-auto px-4">
        <div class="min-h-screen bg-gradient-to-br">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-8">
                    <div class="lg:col-span-2">
                        <article class="bg-white shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                            <div class="p-8">
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                                    {{ $video->title[app()->getLocale()] ?? '' }}
                                </h1>

                                @php
                                    // Extract YouTube video ID
                                    $videoId = null;
                                    $urlToCheck = $video->embed_code ?? $video->video_url;
                                    
                                    if ($urlToCheck && $urlToCheck != '#') {
                                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $urlToCheck, $match);
                                        $videoId = $match[1] ?? null;
                                    }
                                @endphp

                                <div class="relative aspect-video overflow-hidden bg-gray-900">
                                    @if($videoId)
                                        <iframe 
                                            src="https://www.youtube.com/embed/{{ $videoId }}"
                                            title="{{ $video->title[app()->getLocale()] ?? '' }}" 
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen
                                            class="w-full h-full">
                                        </iframe>
                                    @else
                                        <div class="flex items-center justify-center h-full text-white">
                                            <p>{{ __('video.no_video_available') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-6">
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $video->description[app()->getLocale()] ?? '' }}
                                    </p>
                                </div>

                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    @php
                                        $shareUrl = route(app()->getLocale() . '.video.details', $video->id);
                                        $shareText = $video->title[app()->getLocale()] ?? __('video.watch_this_article');
                                    @endphp

                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <span class="text-gray-700 font-medium ml-3">{{ __('video.share_article') }}</span>

                                            {{-- Facebook --}}
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank"
                                               class="flex items-center justify-center w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="lucide lucide-facebook w-5 h-5">
                                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                </svg>
                                            </a>

                                            {{-- Twitter --}}
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}" target="_blank"
                                               class="flex items-center justify-center w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="lucide lucide-twitter w-5 h-5">
                                                    <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                                                </svg>
                                            </a>

                                            {{-- LinkedIn --}}
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank"
                                               class="flex items-center justify-center w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="lucide lucide-linkedin w-5 h-5">
                                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                                    <rect width="4" height="12" x="2" y="9"></rect>
                                                    <circle cx="4" cy="4" r="2"></circle>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-image-overlay container mx-auto px-4 py-4">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-primary mb-8 text-center">{{ __('video.related_videos') }}</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedvideos as $key => $record)
                @php
                    $videoId = null;
                    $urlToCheck = $record->embed_code ?? $record->video_url;
                    
                    if ($urlToCheck && $urlToCheck != '#') {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $urlToCheck, $match);
                        $videoId = $match[1] ?? null;
                    }
                    
                    $coverImage = null;
                    if ($record->image) {
                        $coverImage = asset('storage/' . $record->image);
                    } elseif ($videoId) {
                        $coverImage = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                    }
                @endphp

                @if($videoId)
                <a href="{{ route(app()->getLocale() . '.video.details', $record->id) }}" 
                   title="{{ is_array($record->title) ? ($record->title[app()->getLocale()] ?? '') : $record->title }}">
                    <div class="group cursor-pointer">
                        <div class="relative overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <img src="{{ $coverImage }}" 
                                 alt="{{ is_array($record->title) ? ($record->title[app()->getLocale()] ?? '') : $record->title }}"
                                 onerror="this.src='https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg'"
                                 class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-primary/40 group-hover:bg-primary/20 transition-colors duration-300"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center group-hover:bg-accent group-hover:scale-110 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="lucide lucide-play w-6 h-6 text-primary group-hover:text-white ml-1">
                                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-bold text-primary mb-2 group-hover:text-accent transition-colors">
                                {{ is_array($record->title) ? ($record->title[app()->getLocale()] ?? '') : $record->title }}
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-2">
                                {{ is_array($record->description) ? ($record->description[app()->getLocale()] ?? '') : $record->description }}
                            </p>
                        </div>
                    </div>
                </a>
                @endif
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route(app()->getLocale().'.video') }}"
               class="bg-accent text-white text-center px-8 py-4 text-lg font-semibold hover:bg-primary transition-colors duration-300 inline-block rounded-lg">
               {{ __('video.view_all_posts') }}
            </a>
        </div>
    </div>
</section>

@endsection