<?php
$seo = \App\Http\Controllers\SeoController::index('aboutus') ?? [];
?>
<?php $__env->startSection('title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? Setting()->site_name[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? Setting()->site_description[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? Setting()->site_name[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? Setting()->site_description[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_url'); ?><?php echo e($seo['canonical'] ?? url()->current()); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_image'); ?><?php echo e(!empty($seo['og_image']) ? asset('storage/' . $seo['og_image']) : asset('storage/' . Setting()->logo_light)); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_image'); ?><?php echo e(!empty($seo['og_image']) ? asset('storage/' . $seo['og_image']) : asset('storage/' . Setting()->logo_light)); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? Setting()->site_name[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? Setting()->site_description[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('canonical'); ?><?php echo e($seo['canonical'] ?? url()->current()); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="/assets/css/blog.css?v=6">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "<?php echo e(Setting()->site_name[app()->getLocale()] ?? ''); ?>",
        "url": "<?php echo e(url('/')); ?>",
        "logo": "<?php echo e(asset('storage/' . Setting()->logo_light)); ?>",
        "description": "<?php echo e(Setting()->site_description[app()->getLocale()] ?? ''); ?>"
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "<?php echo e(url('/')); ?>",
        "name": "<?php echo e(Setting()->site_name[app()->getLocale()] ?? ''); ?>",
        "publisher": {
            "@type": "Organization",
            "name": "<?php echo e(Setting()->site_name[app()->getLocale()] ?? ''); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo e(asset('storage/' . Setting()->logo_light)); ?>"
            }
        }
    }
</script>

<!-- Hero Section -->
<section class="relative py-32 overflow-hidden bg-gradient-to-t from-secondary/80 via-secondary/80 to-transparent">
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-no-repeat bg-center bg-cover"
            style="background-image: url('/assets/images/home-thumb-slider-1.webp')">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/80 to-transparent"></div>
    </div>
    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <div class="mb-16 text-center">
            <h1 class="mb-6 text-4xl font-bold text-gray-900 md:text-5xl lg:text-6xl">
                <?php echo e(getSectionHeaders('aboutus')->title[app()->getLocale()] ?? ''); ?>

            </h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                <?php echo e(getSectionHeaders('aboutus')->description[app()->getLocale()] ?? ''); ?>

            </p>
        </div>
    </div>
</section>

<?php $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- About Section -->
<section id="about" class="relative py-20 overflow-hidden sm:py-24 lg:py-0 bg-secondary">
    <div class="relative z-10 px-4 mx-auto sm:px-6 lg:px-8 lg:pe-0">
        <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">

            <!-- Text Content -->
            <div class="order-2 space-y-6 text-center animate-fade-in-left lg:text-left lg:order-1 max-w-xl justify-self-end lg:py-20 rtl:text-right">

                <!-- Title -->
                <h2 class="text-3xl font-extrabold leading-tight text-black sm:text-4xl md:text-5xl">
                    <span class="relative inline-block">
                        <span class="relative">
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full animate-pulse-underline"></span>
                            <?php echo e(getLocalized($record->name) ?? ''); ?>

                        </span>
                    </span>
                </h2>

                <!-- Subtitle -->
                <h3 class="text-xl font-semibold text-primary sm:text-2xl lg:text-3xl">
                    <?php echo e(getLocalized($record->position) ?? ''); ?>

                </h3>

                <!-- Description -->
                <div class="max-w-2xl mx-auto text-base leading-relaxed text-black/80 sm:text-lg lg:mx-0">
                    <?php echo getLocalized($record->speech) ?? ''; ?>

                </div>

                <!-- CTA Button -->
                <div class="pt-4">
                    <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'aboutus' )); ?>"
                        class="inline-block px-6 py-3 text-sm font-semibold text-white transition-all duration-300 rounded-full shadow-lg sm:text-base bg-primary hover:bg-black">
                        <?php echo e(__('buttons.learn_more')); ?>

                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="order-1 lg:order-2">
                <div class="relative w-full">
                    <!-- Glow Background -->
                    <div class="absolute inset-0 rounded-2xl bg-primary/10 blur-xl"></div>

                    <div class="relative w-full h-72 sm:h-96 lg:h-screen overflow-hidden">
                        <img src="<?php echo e(asset('storage/' . $record->image)); ?>" 
                             alt="<?php echo e(getLocalized($record->name) ?? ''); ?>"
                             class="object-cover object-center w-full h-full" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($aboutUs && ($aboutUs->education_description[app()->getLocale()] ?? false)): ?>
<!-- Qualifications Section -->
<section class="py-24 bg-gradient-to-br from-base to-secondary">
    <div class="container px-6 mx-auto max-w-7xl">
        <div class="mb-16 text-center">
            <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">
                <?php echo e(__('aboutus.education_qualifications')); ?>

            </h2>
            <p class="max-w-2xl mx-auto text-lg text-gray-600">
                <?php echo $aboutUs->education_description[app()->getLocale()] ?? ''; ?>

            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php if($aboutUs->education_degree[app()->getLocale()] ?? false): ?>
            <!-- Education Card -->
            <div class="p-8 bg-white shadow-lg rounded-2xl hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex items-center justify-center w-16 h-16 mr-4 rounded-full bg-secondary">
                        <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72L5.18 9L12 5.28L18.82 9zM17 15.99l-5 2.73l-5-2.73v-3.72L12 15l5-2.73v3.72z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">
                        <?php echo e($aboutUs->education_degree[app()->getLocale()] ?? ''); ?>

                    </h3>
                </div>
                <p class="text-gray-600">
                    <?php echo e($aboutUs->education_degree_description[app()->getLocale()] ?? ''); ?>

                </p>
            </div>
            <?php endif; ?>

            <!-- Add more education cards here if you have additional degrees -->
        </div>
    </div>
</section>
<?php endif; ?>

<?php if($aboutUs && (($aboutUs->experience_years ?? false) || ($aboutUs->philosophy_quote[app()->getLocale()] ?? false))): ?>
<!-- Experience & Philosophy Section -->
<section class="py-24 bg-base">
    <div class="container px-6 mx-auto max-w-7xl">
        <div class="grid gap-16 lg:grid-cols-2">
            
            <?php if($aboutUs->experience_years ?? false): ?>
            <!-- Experience -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">
                    <span class="text-primary"><?php echo e($aboutUs->experience_years ?? ''); ?></span> <?php echo e(__('aboutus.years_of_excellence')); ?>

                </h2>
                
                <?php if($aboutUs->treatment_techniques[app()->getLocale()] ?? false): ?>
                <div class="space-y-4">
                    <div class="flex items-start space-x-4 rtl:space-x-reverse">
                        <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-1 rounded-full bg-secondary">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-gray-700 leading-relaxed prose prose-sm max-w-none">
                                <?php echo $aboutUs->treatment_techniques[app()->getLocale()] ?? ''; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if($aboutUs->philosophy_quote[app()->getLocale()] ?? false): ?>
            <!-- Philosophy -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">
                    <?php echo e(__('aboutus.our_philosophy')); ?>

                </h2>
                <div class="p-6 border-l-4 border-primary bg-ternary/30 rtl:border-l-0 rtl:border-r-4 rounded-lg">
                    <blockquote class="text-lg italic text-gray-700 leading-relaxed">
                        <?php echo nl2br(e($aboutUs->philosophy_quote[app()->getLocale()] ?? '')); ?>

                    </blockquote>
                    <?php if($aboutUs->philosophy_author[app()->getLocale()] ?? false): ?>
                    <cite class="block mt-4 text-sm font-semibold text-primary not-italic">
                        - <?php echo e($aboutUs->philosophy_author[app()->getLocale()] ?? ''); ?>

                    </cite>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-24 bg-gradient-to-br from-secondary to-base">
    <div class="container max-w-4xl px-6 mx-auto text-center">
        <h2 class="mb-6 text-3xl font-bold text-primary md:text-4xl">
            <?php echo e(__('aboutus.cta_title')); ?>

        </h2>
        <p class="mb-8 text-lg text-primary md:text-xl">
            <?php echo e(__('aboutus.cta_description')); ?>

        </p>
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
            <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'appointment' )); ?>"
                class="px-8 py-4 text-lg font-semibold transition-colors duration-300 bg-primary rounded-lg text-white hover:bg-primary/80">
                <?php echo e(__('buttons.book appointment')); ?>

            </a>
            <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'contact' )); ?>"
                class="px-8 py-4 text-lg font-semibold text-primary transition-colors duration-300 border-2 border-primary rounded-lg hover:bg-white hover:text-primary">
                <?php echo e(__('contact.contact us')); ?>

            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/aboutus/index.blade.php ENDPATH**/ ?>