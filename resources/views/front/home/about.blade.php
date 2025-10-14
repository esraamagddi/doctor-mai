@foreach ($founder as $key => $record)
<!-- About Section -->
<section id="about" class="relative py-20 overflow-hidden sm:py-24 lg:py-0 bg-secondary">
    <div class=" relative z-10 px-4 mx-auto sm:px-6 lg:px-8 lg:pe-0 ">
        <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">

            <!-- Text Content -->
            <div
                class="order-2 space-y-6 text-center animate-fade-in-left lg:text-left lg:order-1 max-w-xl justify-self-end lg:py-20 rtl:text-right">

                <!-- Title -->
                <h2 class="text-3xl font-extrabold leading-tight text-black sm:text-4xl md:text-5xl">
                    <span class="relative inline-block">
                        <span class="relative">

                            <span
                                class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full animate-pulse-underline"></span>
                            {{ getLocalized($record->name) ?? '' }}
                        </span>
                    </span>
                </h2>

                <!-- Subtitle -->
                <h3 class="text-xl font-semibold text-primary sm:text-2xl lg:text-3xl ">
                    {{ getLocalized($record->position) ?? '' }}
                </h3>

                <!-- Description -->
                <p class="max-w-2xl mx-auto text-base leading-relaxed text-black/80 sm:text-lg lg:mx-0">
                    {!! getLocalized($record->speech) ?? '' !!}
                </p>

                <!-- CTA Button -->
                <div class="pt-4">
                    <a href="{{ route( (session('front_locale') ?? app()->getLocale()) . '.' . 'aboutus' ) }}"
                        class="inline-block px-6 py-3 text-sm font-semibold text-white transition-all duration-300 rounded-full shadow-lg sm:text-base bg-primary hover:bg-black">
                        {{ __('buttons.learn_more') }}
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="order-1 lg:order-2">
                <div class="relative w-full">
                    <!-- Glow Background -->
                    <div class="absolute inset-0 rounded-2xl bg-primary/10 blur-xl"></div>

                    <div class="relative w-full h-72 sm:h-96 lg:h-screen  overflow-hidden ">
                        <img src="{{ asset('storage/' . $record->image) }}" alt=" {{ getLocalized($record->name) ?? '' }}"
                            class="object-cover object-center w-full h-full" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endforeach