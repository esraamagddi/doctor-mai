<section class="relative py-20 overflow-hidden bg-base">
    <div class="absolute border border-primary rounded-full top-1/4 right-20 w-80 h-80 opacity-10"></div>
    <div class="absolute border border-primary rounded-full bottom-5 left-20 w-80 h-80 opacity-15"></div>
    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <!-- Section Header -->
        <div class="mb-16 text-center">
            <h2 class="mb-6 text-4xl font-black text-gray-900 lg:text-6xl">
                {{ getLocalized(getSectionHeaders('blogs')['title']) ?? '' }}
            </h2>
            <p class="max-w-3xl mx-auto text-xl leading-relaxed text-gray-600">
                {{ getLocalized(getSectionHeaders('blogs')['description']) ?? '' }}
            </p>
        </div>

        <!-- Blogs Section -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($blogs as $key => $record)
            <!-- Blog Card -->
            <article
                class="relative overflow-hidden transition-all duration-500 bg-white shadow-lg cursor-pointer blog-card flex flex-col h-full group rounded-2xl hover:shadow-xl hover:-translate-y-2">
                <div class="relative h-48">
                    <!-- ✅ Image is already correct with asset() -->
                    <img
                        src="{{ asset('storage/' . $record->image) }}"
                        alt="{{ getLocalized($record->title) ?? 'Blog post image' }}" 
                        class="object-cover w-full h-full"
                        onerror="this.src='/assets/images/placeholder.jpg'" />
                    <div class="absolute px-3 py-1 text-xs font-bold bg-white rounded-full text-primary top-3 right-3">
                        {{ getLocalized($record->category->name) }}
                    </div>
                </div>

                <div class="blog-card-content flex flex-col justify-between flex-1 p-4">
                    <div class="blog-card-main flex-1">
                        <div class="flex items-center mb-3 space-x-2 text-xs text-gray-500">
                            <span>{{ $record->published_at ? \Carbon\Carbon::parse($record->published_at)->format('M d, Y') : '' }}</span>
                        </div>

                        <h3 class="mb-3 text-lg font-bold leading-tight text-gray-900 transition-colors group-hover:text-primary">
                            {{ getLocalized($record->title) }}
                        </h3>

                        <p class="mb-4 text-sm leading-relaxed text-gray-600">
                            {{ Str::limit(strip_tags(getLocalized($record->description)), 120) }}
                        </p>
                    </div>

                    <div class="blog-card-footer flex justify-between items-center pb-3">
                        <a href="{{ route((session('front_locale') ?? app()->getLocale()).'.blog.details', $record->id) }}" class="inline-flex items-center text-sm font-semibold text-primary hover:text-ternary group">
                            <span>{{ __('blog.read_more') }}</span>
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Browse All Blogs CTA -->
        <div class="mt-16 text-center">
            <div class="inline-flex flex-col items-center space-y-6">
                <a href="{{ route( (session('front_locale') ?? app()->getLocale()) . '.' . 'blog' ) }}"
                    class="px-6 py-3 font-semibold text-center text-secondary rounded-full transition-colors duration-300 shadow-lg bg-primary">
                    {{ __('buttons.browse all blog posts') }}
                </a>
                <p class="text-sm text-gray-600">
                    {{ __('blog.join readers') }}
                </p>
            </div>
        </div>
    </div>
</section>