<?php
$seo = \App\Http\Controllers\SeoController::index('blog');
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
<?php $__env->startSection('meta'); ?><?php $__env->stopSection(); ?>

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
                <?php echo e(getSectionHeaders('blog')->title[app()->getLocale()] ?? ''); ?>

            </h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                <?php echo e(getSectionHeaders('blog')->description[app()->getLocale()] ?? ''); ?>

            </p>
        </div>
    </div>
</section>


<section class="relative py-20 overflow-hidden bg-base">
    <div class="absolute border border-primary rounded-full top-1/4 right-20 w-80 h-80 opacity-10"></div>
    <div class="absolute border border-primary rounded-full bottom-5 left-20 w-80 h-80 opacity-15"></div>
    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <!-- Section Header -->
        <div class="mb-16 text-center">
            <h2 class="mb-6 text-4xl font-black text-gray-900 lg:text-6xl">
                <?php echo e(getLocalized(getSectionHeaders('blogs')['title']) ?? ''); ?>

            </h2>
            <p class="max-w-3xl mx-auto text-xl leading-relaxed text-gray-600">
                <?php echo e(getLocalized(getSectionHeaders('blogs')['description']) ?? ''); ?>

            </p>
        </div>

        <!-- Blogs Section -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Blog Card 1 -->
            <article
                class="relative overflow-hidden transition-all duration-500 bg-white shadow-lg cursor-pointer blog-card flex flex-col h-full group rounded-2xl hover:shadow-xl hover:-translate-y-2">
                <div class="relative h-48">
                    <img
                        src="<?php echo e(asset('storage/' . $record->image)); ?>"
                        alt="skincare routine image" class="object-cover w-full h-full" />
                    <div class="absolute px-3 py-1 text-xs font-bold bg-white rounded-full text-primary top-3 right-3">
                        <?php echo e(getLocalized($record->category->name)); ?>

                    </div>
                </div>

                <div class="blog-card-content flex flex-col justify-between flex-1 p-4">
                    <div class="blog-card-main flex-1">
                        <div class="flex items-center mb-3 space-x-2 text-xs text-gray-500">
                            <span><?php echo e($record->published_at ? \Carbon\Carbon::parse($record->published_at)->format('M d, Y') : ''); ?></span>
                        </div>

                        <h3 class="mb-3 text-lg font-bold leading-tight text-gray-900 transition-colors group-hover:text-primary">


                        </h3>

                        <p class="mb-4 text-sm leading-relaxed text-gray-600">
                            <?php echo e(getLocalized($record->description)); ?>

                        </p>
                    </div>

                    <div class="blog-card-footer flex justify-between items-center pb-3">
                        <a href="<?php echo e(route((session('front_locale') ?? app()->getLocale()).'.blog.details', $record->id)); ?>" class="inline-flex items-center text-sm font-semibold text-primary hover:text-ternary group">
                            <span><?php echo e(__('blog.read_more')); ?></span>
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                    </div>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <!-- Browse All Blogs CTA -->
        <div class="mt-16 text-center">
            <div class="inline-flex flex-col items-center space-y-6">
                <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'blog' )); ?>"
                    class="px-6 py-3 font-semibold text-center text-secondary rounded-full transition-colors duration-300 shadow-lg bg-primary">
                    <?php echo e(__('buttons.browse all blog posts')); ?>

                </a>
                <p class="text-sm text-gray-600">
                    <?php echo e(__('blog.join readers')); ?>

                </p>
            </div>
        </div>
    </div>


</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/blog/index.blade.php ENDPATH**/ ?>