@extends('layouts.front.app')
@php
$seo = \App\Http\Controllers\SeoController::index('home');
@endphp
@section('title'){{ $seo['meta_title'][app()->getLocale()] }}@endsection
@section('description'){{ $seo['meta_description'][app()->getLocale()] }}@endsection
@section('og_title'){{ $seo['meta_title'][app()->getLocale()] }}@endsection
@section('og_description'){{ $seo['meta_description'][app()->getLocale()] }}@endsection
@section('og_url'){{ $seo['canonical'] }}@endsection
@section('og_image'){{ asset('storage/' . $seo['og_image']) }}@endsection
@section('twitter_image'){{ asset('storage/' . $seo['og_image']) }}@endsection
@section('twitter_title'){{ $seo['meta_title'][app()->getLocale()] }}@endsection
@section('twitter_description'){{ $seo['meta_description'][app()->getLocale()] }}@endsection
@section('canonical'){{ $seo['canonical'] }}@endsection
@section('meta')
@endsection

@php
$isAr = (session('front_locale') ?? app()->getLocale()) === 'ar';
@endphp

@section('title', $title ?: Setting()->site_name[app()->getLocale()] ?? '')
@section('description', \Illuminate\Support\Str::limit(strip_tags($content), 160))
@section('canonical', url()->current())

@section('content')
<section class="py-20 bg-image-overlay" dir="{{ $isAr ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto px-4 pt-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">
                {{ $title }}
            </h1>

            @if(!empty($page->updated_at))
            <p class="text-sm text-gray-500">
                {{ __('page.last_updated') }}:
                {{ \Carbon\Carbon::parse($page->updated_at)->format('Y-m-d') }}
            </p>
            @endif
        </div>

        <div class="max-w-4xl mx-auto bg-secondary rounded-2xl shadow-xl p-8 leading-relaxed text-gray-700">
            {!! $content !!}
        </div>

        @if(!empty($page->image))
        <div class="max-w-4xl mx-auto mt-6">
            <img src="{{ asset('storage/'.$page->image) }}"
                alt="{{ $title }}" class="w-full h-auto object-cover">
        </div>
        @endif

        <div class="max-w-4xl mx-auto mt-8 flex {{ $isAr ? 'justify-start' : 'justify-end' }}">
            <a href="{{ route((session('front_locale') ?? app()->getLocale()).'.home') }}"
                class="px-6 py-3 bg-primary rounded-full text-white font-semibold hover:bg-primary transition-colors duration-300">
                {{ __('page.back_home') }}
            </a>
        </div>
    </div>
</section>
@endsection