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

<section id="appointment-success" class="py-20 bg-image-overlay" dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">
    @php
        $s = session('appointment_summary', []);
        if (empty($s) && isset($appointment)) {
            $s = [
                'name'          => $appointment->name ?? null,
                'phone'         => $appointment->phone ?? null,
                'email'         => $appointment->email ?? null,
                'service_label' => $appointment->service_label
                    ?? (is_string($appointment->service ?? null)
                        ? (json_decode($appointment->service, true)[app()->getLocale()] ?? null)
                        : null),
                'date'          => optional($appointment->date ?? null)->format('Y-m-d') ?? ($appointment->date ?? null),
                'time'          => $appointment->time ?? null,
                'ref'           => $appointment->reference ?? ($appointment->id ?? null),
            ];
        }
        $isAr = app()->getLocale()==='ar';
    @endphp

    <div class="container mx-auto px-4 pt-6">
        <div class="text-center mb-12 {{ $isAr ? 'rtl' : '' }}">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">
                {{ __('appointment.success_title') }}
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ __('appointment.success_subtitle') }}
            </p>
        </div>

        <div class="max-w-3xl mx-auto bg-white shadow-xl p-8">
            <div class="flex items-start gap-4 mb-8">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-check">
                        <path d="M20 6 9 17l-5-5"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">
                        {{ __('appointment.success_box_title') }}
                    </h2>
                    <p class="text-gray-600">
                        {{ __('appointment.success_box_desc') }}
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                @if(!empty($s['ref']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('appointment.reference') }}</div>
                        <div class="font-semibold text-primary">{{ $s['ref'] }}</div>
                    </div>
                @endif

                @if(!empty($s['name']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('appointment.full_name') }}</div>
                        <div class="font-semibold">{{ $s['name'] }}</div>
                    </div>
                @endif

                @if(!empty($s['phone']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('appointment.phone') }}</div>
                        <div class="font-semibold">{{ $s['phone'] }}</div>
                    </div>
                @endif

                @if(!empty($s['email']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('appointment.email') }}</div>
                        <div class="font-semibold">{{ $s['email'] }}</div>
                    </div>
                @endif

                @if(!empty($s['service_label']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('appointment.service') }}</div>
                        <div class="font-semibold">{{ $s['service_label'] }}</div>
                    </div>
                @endif

                @if(!empty($s['date']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('appointment.date') }}</div>
                        <div class="font-semibold">{{ \Carbon\Carbon::parse($s['date'])->format('Y-m-d') }}</div>
                    </div>
                @endif

                @if(!empty($s['time']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('appointment.time') }}</div>
                        <div class="font-semibold">{{ $s['time'] }}</div>
                    </div>
                @endif
            </div>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 {{ $isAr ? 'justify-center sm:flex-row-reverse' : 'justify-center' }} pt-6">
                <a href="{{ route((session('front_locale') ?? app()->getLocale()).'.home') }}"
                   class="bg-accent text-white px-6 py-3 font-semibold hover:bg-primary transition-colors duration-300 text-center">
                    {{ __('appointment.back_home') }}
                </a>

                <a href="{{ route((session('front_locale') ?? app()->getLocale()).'.appointment') }}"
                   class="bg-primary-light text-white px-6 py-3 font-semibold hover:bg-primary hover:text-white transition-colors duration-300 text-center">
                    {{ __('appointment.book_another') }}
                </a>
            </div>
        </div>
    </div>
</section>




@endsection