<?php
$seo = \App\Http\Controllers\SeoController::index('services');
?>

<?php $__env->startSection('title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_url'); ?><?php echo e($seo['canonical']); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_image'); ?><?php echo e(asset('storage/' . $seo['og_image'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_image'); ?><?php echo e(asset('storage/' . $seo['og_image'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('canonical'); ?><?php echo e($seo['canonical']); ?><?php $__env->stopSection(); ?>
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
                <?php echo e(getSectionHeaders('services')->title[app()->getLocale()] ?? ''); ?>


            </h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                <?php echo e(getSectionHeaders('services')->description[app()->getLocale()] ?? ''); ?>


            </p>
        </div>
    </div>
</section>

<section class="relative py-20 overflow-hidden bg-base">
    <!-- Decorative Circles -->
    <div class="absolute border-2 border-secondary rounded-full top-20 left-20 w-80 h-80 opacity-50"></div>
    <div class="absolute border-2 border-secondary rounded-full bottom-20 right-20 w-60 h-60 opacity-55"></div>

    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <!-- Section Header -->
        <div class="mb-16 text-start w-fit">
            <h2 class="mb-4 text-4xl font-bold text-black lg:text-5xl">
                <?php echo e(getLocalized(getSectionHeaders('services')['title']) ?? ''); ?>

            </h2>
            <p class="max-w-2xl mx-auto text-lg text-black">
                <?php echo e(getLocalized(getSectionHeaders('services')['description']) ?? ''); ?>

            </p>
        </div>

        <!-- ✅ Swiper Slider -->
        <div class="relative swiper testimonials-swiper">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <div class="relative overflow-hidden rounded-t-3xl h-80">
                        <img src="<?php echo e(asset('storage/' . $record->image)); ?>"
                            alt="<?php echo e(getLocalized($record->name)); ?>" class="object-cover object-center w-full h-full" />
                    </div>
                    <div class="p-2 flex justify-between items-center gap-3">
                        <div class="text-primary">
                            <div class="text-2xl uppercase"> <?php echo e(getLocalized($record->name)); ?></div>
                            <div class="text-xs uppercase"><?php echo Str::limit(getLocalized($record->description), 100); ?></div>
                        </div>
                        <div class="text-7xl font-bold text-primary">
                            <?php echo e(str_pad($key + 1, 2, '0', STR_PAD_LEFT)); ?>

                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

    </div>
    <!-- ✅ Pagination  -->
    <div class="mb-16 swiper-pagination"></div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\Dr. Mai El-Hakim\resources\views/front/services/index.blade.php ENDPATH**/ ?>