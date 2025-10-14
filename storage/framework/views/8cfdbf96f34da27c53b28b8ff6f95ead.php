<?php
use App\Http\Controllers\FrontLanguageController;
$activeLanguages = FrontLanguageController::getActiveLanguages();
$curentLanguage = clanguage();
$activeLocale = activeLangauge();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('storage/' . Setting()->favicon)); ?>">
  <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">


  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php echo $__env->yieldContent('og_title'); ?>" />
  <meta property="og:description" content="<?php echo $__env->yieldContent('og_description'); ?>" />
  <meta property="og:url" content="<?php echo $__env->yieldContent('og_url'); ?>" />
  <meta property="og:site_name" content="<?php echo e(getLocalized(Setting()->site_name)); ?>" />
  <meta property="og:image" content="<?php echo $__env->yieldContent('og_image'); ?>" />

  <?php
  $twitterUrl = Setting()->social['twitter'] ?? '';
  $twitterUrl = trim($twitterUrl);
  $twitterUrl = rtrim($twitterUrl, '/');
  $twitterHandle = $twitterUrl ? '@' . basename($twitterUrl) : '';
  ?>

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:image" content="<?php echo $__env->yieldContent('twitter_image'); ?>" />
  <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title'); ?>" />
  <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description'); ?>" />
  <?php if(!empty($twitterHandle)): ?>
  <meta name="twitter:site" content="<?php echo e($twitterHandle); ?>" />
  <?php endif; ?>

  <link rel="canonical" href="<?php echo $__env->yieldContent('canonical'); ?>" />
  <?php echo $__env->yieldContent('meta'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>?v=<?php echo e(time()); ?>" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- WOW.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="<?php echo e(asset('assets/js/script.js')); ?>?v=<?php echo e(time()); ?>"></script>


  <?php echo $__env->yieldContent('css'); ?>
</head><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/layouts/front/head.blade.php ENDPATH**/ ?>