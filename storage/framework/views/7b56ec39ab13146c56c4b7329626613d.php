<?php
    $seo = \App\Http\Controllers\SeoController::index('home');
?>

<?php $__env->startSection('title'); ?><?php echo e(getLocalized($seo['meta_title'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo e(getLocalized($seo['meta_description'])); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('og_title'); ?><?php echo e(getLocalized($seo['meta_title'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_description'); ?><?php echo e(getLocalized($seo['meta_description'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_url'); ?><?php echo e($seo['canonical'] ?? url('/')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_image'); ?><?php echo e(!empty($seo['og_image']) ? asset('storage/' . $seo['og_image']) : ''); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('twitter_image'); ?><?php echo e(!empty($seo['og_image']) ? asset('storage/' . $seo['og_image']) : ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_title'); ?><?php echo e(getLocalized($seo['meta_title'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_description'); ?><?php echo e(getLocalized($seo['meta_description'])); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('canonical'); ?><?php echo e($seo['canonical'] ?? url('/')); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?php echo e(getLocalized(Setting()->site_name)); ?>",
      "url": "<?php echo e(url('/')); ?>",
      "logo": "<?php echo e(asset('storage/' . Setting()->logo_light)); ?>",
      "description": "<?php echo e(getLocalized(Setting()->site_description)); ?>"
    }
    </script>

    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "<?php echo e(url('/')); ?>",
      "name": "<?php echo e(getLocalized(Setting()->site_name)); ?>",
      "publisher": {
        "@type": "Organization",
        "name": "<?php echo e(getLocalized(Setting()->site_name)); ?>",
        "logo": {
          "@type": "ImageObject",
          "url": "<?php echo e(asset('storage/' . Setting()->logo_light)); ?>"
        }
      }
    }
    </script>

    <?php echo $__env->make('front.home.hero-section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.about', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.services', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.transformations', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.testimonials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('front.home.appointment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/home/index.blade.php ENDPATH**/ ?>