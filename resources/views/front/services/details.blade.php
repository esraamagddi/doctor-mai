@extends('layouts.front.app')

@section('title'){{ $services->name[app()->getLocale()] ?? '' }}@endsection
@section('description'){{ $services->description[app()->getLocale()] ?? '' }}@endsection

@section('og_title'){{ $services->name[app()->getLocale()] ?? '' }}@endsection
@section('og_description'){{ $services->description[app()->getLocale()] ?? '' }}@endsection
@section('og_url'){{ route((session('front_locale') ?? app()->getLocale()) . '.services.details', $services->id) }}@endsection
@section('og_image'){{ $services->image ? asset('storage/' . $services->image) : '' }}@endsection

@section('twitter_image'){{ $services->image ? asset('storage/' . $services->image) : '' }}@endsection
@section('twitter_title'){{ $services->name[app()->getLocale()] ?? '' }}@endsection
@section('twitter_description'){{ $services->description[app()->getLocale()] ?? '' }}@endsection

@section('canonical'){{ route((session('front_locale') ?? app()->getLocale()) . '.services.details', $services->id) }}@endsection

@section('css')
    <link rel="stylesheet" href="/assets/css/blog.css?v=5">
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
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- الصورة -->
                    <div class="lg:col-span-1">
                        <div class="bg-white shadow-lg p-6 sticky top-8">
                            <div class="space-y-4">
                                <div class="relative h-64 md:h-80 overflow-hidden">
                                    @if(!empty($services->image))
                                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                             src="{{ asset('storage/' . $services->image) }}"
                                             alt="{{ $services->name[app()->getLocale()] ?? '' }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- المحتوى -->
                    <div class="lg:col-span-2">
                        <article class="bg-white shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                            <div class="p-8">
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                                    {{ $services->name[app()->getLocale()] ?? '' }}
                                </h1>

                                <div class="prose prose-lg max-w-none">
                                    {!! $services->description[app()->getLocale()] ?? '' !!}
                                </div>

                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    @php
                                        $shareUrl = route((session('front_locale') ?? app()->getLocale()) . '.services.details', $services->id);
                                        $shareText = $services->name[app()->getLocale()] ?? '';
                                    @endphp

                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <span class="text-gray-700 font-medium ml-3">{{ __('blog.share_article') }}</span>

                                            {{-- Facebook --}}
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                                               target="_blank"
                                               class="flex items-center justify-center w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>

                                            {{-- Twitter --}}
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}"
                                               target="_blank"
                                               class="flex items-center justify-center w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                <i class="fab fa-twitter"></i>
                                            </a>

                                            {{-- LinkedIn --}}
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}"
                                               target="_blank"
                                               class="flex items-center justify-center w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                <i class="fab fa-linkedin-in"></i>
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
@endsection
