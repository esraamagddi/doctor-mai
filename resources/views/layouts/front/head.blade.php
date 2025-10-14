@php
use App\Http\Controllers\FrontLanguageController;
$activeLanguages = FrontLanguageController::getActiveLanguages();
$curentLanguage = clanguage();
$activeLocale = activeLangauge();
@endphp

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('storage/' . Setting()->favicon) }}">
  <meta name="description" content="@yield('description')">


  <meta property="og:type" content="website" />
  <meta property="og:title" content="@yield('og_title')" />
  <meta property="og:description" content="@yield('og_description')" />
  <meta property="og:url" content="@yield('og_url')" />
  <meta property="og:site_name" content="{{ getLocalized(Setting()->site_name) }}" />
  <meta property="og:image" content="@yield('og_image')" />

  @php
  $twitterUrl = Setting()->social['twitter'] ?? '';
  $twitterUrl = trim($twitterUrl);
  $twitterUrl = rtrim($twitterUrl, '/');
  $twitterHandle = $twitterUrl ? '@' . basename($twitterUrl) : '';
  @endphp

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:image" content="@yield('twitter_image')" />
  <meta name="twitter:title" content="@yield('twitter_title')" />
  <meta name="twitter:description" content="@yield('twitter_description')" />
  @if(!empty($twitterHandle))
  <meta name="twitter:site" content="{{ $twitterHandle }}" />
  @endif

  <link rel="canonical" href="@yield('canonical')" />
  @yield('meta')
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- WOW.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('assets/js/script.js') }}?v={{ time() }}"></script>


  @yield('css')
</head>