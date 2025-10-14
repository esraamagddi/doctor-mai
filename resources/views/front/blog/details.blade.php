@extends('layouts.front.app')
@section('title'){{ $post->title[app()->getLocale()] ?? '' }}@endsection
@section('description'){{ $post->description[app()->getLocale()] ?? '' }}@endsection

@section('og_title'){{ $post->title[app()->getLocale()] ?? '' }}@endsection
@section('og_description'){{ $post->description[app()->getLocale()] ?? '' }}@endsection
@section('og_url'){{ route((session('front_locale') ?? app()->getLocale()) . '.blog.details', $post->id) }}@endsection
@section('og_image'){{ $post->image ? asset('storage/' . $post->image) : '' }}@endsection

@section('twitter_image'){{ $post->image ? asset('storage/' . $post->image) : '' }}@endsection
@section('twitter_title'){{ $post->title[app()->getLocale()] ?? '' }}@endsection
@section('twitter_description'){{ $post->description[app()->getLocale()] ?? '' }}@endsection

@section('canonical'){{ route((session('front_locale') ?? app()->getLocale()) . '.blog.details', $post->id) }}@endsection

@section('meta')
@endsection

@section('css')
    <link rel="stylesheet" href="/assets/css/blog.css?v=6">
@endsection


@section('content'){{-- Schema.org Organization --}}
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
    {{-- Schema.org Article --}}
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsArticle",
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ route((session('front_locale') ?? app()->getLocale()) . '.blog.details', $post->id) }}"
          },
          "headline": "{{ $post->title[app()->getLocale()] ?? '' }}",
          "description": "{{ $post->description[app()->getLocale()] ?? '' }}",
          "image": [
            @if($post->image)
                  "{{ asset('storage/' . $post->image) }}"
            @else
                  "{{ asset('storage/' . Setting()->logo_light) }}"
            @endif
          ],
          "datePublished": "{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->toIso8601String() : now()->toIso8601String() }}",
          "dateModified": "{{ $post->updated_at ? \Carbon\Carbon::parse($post->updated_at)->toIso8601String() : ($post->published_at ? \Carbon\Carbon::parse($post->published_at)->toIso8601String() : now()->toIso8601String()) }}",
          "author": {
            "@type": "Person",
            "name": "{{ $post->author[app()->getLocale()] ?? '' }}"
          },
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

    <section id="news" class="py-20 bg-base animate-in">
        <div class="container mx-auto px-4">
            <div class="min-h-screen bg-gradient-to-br">
                <div class="max-w-7xl mx-auto px-4 py-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2">
                            <article class="bg-secondary shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl rounded-3xl">
                                <div class="relative h-64 md:h-80 overflow-hidden">
                                    @if(!empty($post->image))
                                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                            src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title[app()->getLocale()] ?? '' }}">
                                    @endif
                                </div>
                                <div class="p-8">
                                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                                        {{ $post->title[app()->getLocale()] ?? '' }}
                                    </h1>
                                    <div class="flex flex-wrap items-center gap-6 mb-8 text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user w-5 h-5 text-primary">
                                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <span class="font-medium">
                                                {{ $post->author[app()->getLocale()] ?? '' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-calendar w-5 h-5 text-primary">
                                                <path d="M8 2v4"></path>
                                                <path d="M16 2v4"></path>
                                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                <path d="M3 10h18"></path>
                                            </svg>
                                            <span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="prose prose-lg max-w-none">
                                        {!! $post->content[app()->getLocale()] ?? '' !!}
                                    </div>
                                    <div class="mt-8 pt-6 border-t border-gray-200">
                                        @php
                                            $shareUrl = route((session('front_locale') ?? app()->getLocale()) . '.blog.details', $post->id);
                                            $shareText = $post->title[app()->getLocale()] ?? '';
                                        @endphp

                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                            <div class="flex items-center gap-3">
                                                <span class="text-gray-700 font-medium ml-3">{{ __('blog.share_article') }}</span>

                                                {{-- Facebook --}}
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank"
                                                    class="flex items-center justify-center w-10 h-10 bg-primary hover:bg-primary text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-facebook w-5 h-5">
                                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                    </svg>
                                                </a>

                                                {{-- Twitter --}}
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}" target="_blank"
                                                    class="flex items-center justify-center w-10 h-10 bg-primary hover:bg-primary text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-twitter w-5 h-5">
                                                        <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                                                    </svg>
                                                </a>

                                                {{-- LinkedIn --}}
                                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank"
                                                    class="flex items-center justify-center w-10 h-10 bg-primary hover:bg-primary text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
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
                        <div class="lg:col-span-1">
                            <div class="bg-secondary rounded-3xl shadow-lg p-6 sticky top-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('blog.related_articles') }}</h2>
                                <div class="space-y-4">
                                    @foreach ($relatedPosts as $record)
                                        <div class="group cursor-pointer p-4 rounded-xl hover:bg-gray-50 transition-all duration-200 border border-transparent hover:border-gray-200">
                                            <a href="{{ route((session('front_locale') ?? app()->getLocale()) . '.blog.details', $record->id) }}"
                                                title="{{ $record->title[app()->getLocale()] ?? '' }}">
                                                <div class="flex gap-4">
                                                    <img src="{{ asset('storage/' . $record->image) }}"
                                                        alt="{{ $record->title[app()->getLocale()] ?? '' }}"
                                                        class="w-20 h-20 object-cover rounded-lg group-hover:scale-105 transition-transform duration-200">
                                                    <div class="flex-1">
                                                        <h3 class="font-semibold text-gray-400 mb-2 leading-tight group-hover:text-blue-600 transition-colors duration-200">
                                                            {{ $record->title[app()->getLocale()] ?? '' }}
                                                        </h3>
                                                        <div class="mt-1">
                                                            <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                                                                {{ $record->author[app()->getLocale()] ?? '' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
