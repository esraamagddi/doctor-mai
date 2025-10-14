@extends('layouts.front.app')

@section('title')
    {{ __('FAQs') }}
@endsection

@section('content')
<main>
    <!-- start title section -->
    <section class="padding-section mt-5">
        <div class="container">
            <div class="col-lg-9 mx-auto">
                <h1 class="main-title">
                    Frequently Asked Questions
                </h1>
                <p class="text-gray text-center mb-5 mt-3">
                    In this section, you'll find comprehensive answers to the most frequently asked questions about the forum, its goals, how to register and participate, as well as general information you may be interested in. This section aims to provide information quickly and efficiently to facilitate your experience.
                </p>
            </div>
        </div>
    </section>
    <!-- end title section -->

    <!-- start FAQs section -->
    <section class="FAQS-section padding-section pt-0">
        <div class="container">
            <div class="col-lg-9 mx-auto">
                <div class="accordion bg-white rounded-5 p-4" id="accordionExample">
                    @foreach($faqs as $key => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button @if($key != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $key }}">
                                    {{ $faq->question[$activeLocale] ?? 'Question' }}
                                </button>
                            </h2>
                            <div id="collapse{{ $key }}" class="accordion-collapse collapse @if($key == 0) show @endif" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $faq->answer[$activeLocale] ?? 'Answer content' !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- end FAQs section -->
</main>
@endsection
