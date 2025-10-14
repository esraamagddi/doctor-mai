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

<section id="contact-success" class="py-20 bg-image-overlay" dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">
    @php
        // الكنترولر يعمل redirect()->route(...)->with('contact_summary', [...])
        $s = session('contact_summary', []);
        $isAr = app()->getLocale()==='ar';
    @endphp

    <div class="container mx-auto px-4 pt-6">
        {{-- العنوان والوصف --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">
                {{ __('contact.success_title') ?: ($isAr ? 'تم استلام رسالتك' : 'Message received') }}
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ __('contact.success_subtitle') ?: ($isAr ? 'شكرًا لتواصلك معنا! سنرد عليك قريبًا.' : 'Thank you for contacting us! We will get back to you shortly.') }}
            </p>
        </div>

        {{-- بطاقة التأكيد --}}
        <div class="max-w-3xl mx-auto bg-white shadow-xl p-8">
            <div class="flex items-start gap-4 mb-8">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">
                        {{ __('contact.success_box_title') ?: ($isAr ? 'تم إرسال الرسالة' : 'Request submitted') }}
                    </h2>
                    <p class="text-gray-600">
                        {{ __('contact.success_box_desc') ?: ($isAr ? 'تفاصيل رسالتك موضحة بالأسفل.' : 'Your message details are below.') }}
                    </p>
                </div>
            </div>

            {{-- التفاصيل --}}
            <div class="grid md:grid-cols-2 gap-6">
                @if(!empty($s['ref']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('contact.reference') ?: ($isAr ? 'رقم المرجع' : 'Reference') }}</div>
                        <div class="font-semibold text-primary">{{ $s['ref'] }}</div>
                    </div>
                @endif

                @if(!empty($s['name']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('contact.full_name') ?: ($isAr ? 'الاسم الكامل' : 'Full Name') }}</div>
                        <div class="font-semibold">{{ $s['name'] }}</div>
                    </div>
                @endif

                @if(!empty($s['phone']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('contact.phone') ?: ($isAr ? 'رقم الهاتف' : 'Phone Number') }}</div>
                        <div class="font-semibold">{{ $s['phone'] }}</div>
                    </div>
                @endif

                @if(!empty($s['email']))
                    <div>
                        <div class="text-sm text-gray-500">{{ __('contact.email') ?: ($isAr ? 'البريد الإلكتروني' : 'Email') }}</div>
                        <div class="font-semibold">{{ $s['email'] }}</div>
                    </div>
                @endif

                @if(!empty($s['subject']))
                    <div class="md:col-span-2">
                        <div class="text-sm text-gray-500">{{ __('contact.subject') ?: ($isAr ? 'الموضوع' : 'Subject') }}</div>
                        <div class="font-semibold">{{ $s['subject'] }}</div>
                    </div>
                @endif

                @if(!empty($s['message']))
                    <div class="md:col-span-2">
                        <div class="text-sm text-gray-500">{{ __('contact.message') ?: ($isAr ? 'الرسالة' : 'Message') }}</div>
                        <div class="font-semibold whitespace-pre-line leading-7">{{ $s['message'] }}</div>
                    </div>
                @endif
            </div>

            {{-- أزرار الحركة --}}
            <div class="mt-10 flex flex-col sm:flex-row gap-4 {{ $isAr ? 'justify-center sm:flex-row-reverse' : 'justify-center' }} pt-6">
                <a href="{{ route((session('front_locale') ?? app()->getLocale()).'.home') }}"
                   class="bg-accent text-white px-6 py-3 font-semibold hover:bg-primary transition-colors duration-300 text-center">
                    {{ __('contact.back_home') ?: ($isAr ? 'العودة للرئيسية' : 'Back to Home') }}
                </a>

                <a href="{{ route((session('front_locale') ?? app()->getLocale()).'.contact') }}"
                   class="bg-primary-light text-white px-6 py-3 font-semibold hover:bg-primary hover:text-white transition-colors duration-300 text-center">
                    {{ __('contact.send_another') ?: ($isAr ? 'إرسال رسالة أخرى' : 'Send another message') }}
                </a>
            </div>
        </div>
    </div>
</section>




@endsection