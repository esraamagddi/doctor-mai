<?php
$seo = \App\Http\Controllers\SeoController::index('home');
?>
<?php $__env->startSection('title'); ?><?php echo e($seo['meta_title'][app()->getLocale()]); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo e($seo['meta_description'][app()->getLocale()]); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()]); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()]); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_url'); ?><?php echo e($seo['canonical']); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_image'); ?><?php echo e(asset('storage/' . $seo['og_image'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_image'); ?><?php echo e(asset('storage/' . $seo['og_image'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_title'); ?><?php echo e($seo['meta_title'][app()->getLocale()]); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_description'); ?><?php echo e($seo['meta_description'][app()->getLocale()]); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('canonical'); ?><?php echo e($seo['canonical']); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta'); ?>
<?php $__env->stopSection(); ?>

<?php
$isAr = (session('front_locale') ?? app()->getLocale()) === 'ar';
?>

<?php $__env->startSection('title', $title ?: Setting()->site_name[app()->getLocale()] ?? ''); ?>
<?php $__env->startSection('description', \Illuminate\Support\Str::limit(strip_tags($content), 160)); ?>
<?php $__env->startSection('canonical', url()->current()); ?>

<?php $__env->startSection('content'); ?>
<section class="py-20 bg-image-overlay" dir="<?php echo e($isAr ? 'rtl' : 'ltr'); ?>">
    <div class="container mx-auto px-4 pt-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">
                <?php echo e($title); ?>

            </h1>

            <?php if(!empty($page->updated_at)): ?>
            <p class="text-sm text-gray-500">
                <?php echo e(__('page.last_updated')); ?>:
                <?php echo e(\Carbon\Carbon::parse($page->updated_at)->format('Y-m-d')); ?>

            </p>
            <?php endif; ?>
        </div>

        <div class="max-w-4xl mx-auto bg-secondary rounded-2xl shadow-xl p-8 leading-relaxed text-gray-700">
            <?php echo $content; ?>

        </div>

        <?php if(!empty($page->image)): ?>
        <div class="max-w-4xl mx-auto mt-6">
            <img src="<?php echo e(asset('storage/'.$page->image)); ?>"
                alt="<?php echo e($title); ?>" class="w-full h-auto object-cover">
        </div>
        <?php endif; ?>

        <div class="max-w-4xl mx-auto mt-8 flex <?php echo e($isAr ? 'justify-start' : 'justify-end'); ?>">
            <a href="<?php echo e(route((session('front_locale') ?? app()->getLocale()).'.home')); ?>"
                class="px-6 py-3 bg-primary rounded-full text-white font-semibold hover:bg-primary transition-colors duration-300">
                <?php echo e(__('page.back_home')); ?>

            </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/pages/page.blade.php ENDPATH**/ ?>