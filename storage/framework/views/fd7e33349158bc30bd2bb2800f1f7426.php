<?php
$seo = \App\Http\Controllers\SeoController::index('video');
?>

<?php $__env->startSection('title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_url'); ?><?php echo e($seo['canonical'] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_image'); ?><?php echo e(asset('storage/' . $seo['og_image'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_image'); ?><?php echo e(asset('storage/' . $seo['og_image'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('canonical'); ?><?php echo e($seo['canonical'] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
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
                <?php echo e(getSectionHeaders('video')['title'][app()->getLocale()] ?? ''); ?>

            </h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                <?php echo e(getSectionHeaders('video')['description'][app()->getLocale()] ?? ''); ?>

            </p>
        </div>
    </div>
</section>

<section class="relative py-20 bg-base overflow-hidden">
    <div class="absolute border border-primary rounded-full top-1/4 right-20 w-80 h-80 opacity-10"></div>
    <div class="absolute border border-primary rounded-full bottom-5 left-20 w-80 h-80 opacity-15"></div>
    <!-- Decorative Blobs -->
    <div class="absolute top-10 -left-20 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>

    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <!-- Header -->
        <div class="mb-16 text-center">
            <h2 class="mb-6 text-4xl font-extrabold leading-tight text-primary md:text-5xl">
                <?php echo e(getLocalized(getSectionHeaders('video')['title'])); ?>

            </h2>
            <p class="max-w-2xl mx-auto text-lg text-gray-600">
                <?php echo e(getLocalized(getSectionHeaders('video')['description'])); ?>

            </p>
        </div>

        <!-- Videos Grid -->
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Video Card -->
            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                class="group relative rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 bg-white border border-secondary">
                <div class="relative aspect-video">
                    <!-- Iframe -->
                    <iframe class="w-full h-full object-cover" src="https://www.youtube.com/embed/ScMzIvxBSi4"
                        title="Laser Hair Removal Process" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <!-- Content -->
                <div class="transition-all p-6">
                    <h3 class="mb-2 text-lg font-bold text-primary"> <?php echo e(getLocalized($record->title)); ?></h3>
                    <p class="text-sm text-gray-600"> <?php echo e(getLocalized($record->description)); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- CTA Button -->
        <div class="mt-16 text-center">
            <a href="Booking.html"
                class="px-8 py-4 font-semibold text-white transition-all duration-300 rounded-full shadow-lg bg-gradient-to-r from-primary to-primary/90 hover:from-primary/90 hover:to-primary">
                <?php echo e(__('buttons.book your consultation')); ?>

            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\Dr. Mai El-Hakim\resources\views/front/video/index.blade.php ENDPATH**/ ?>