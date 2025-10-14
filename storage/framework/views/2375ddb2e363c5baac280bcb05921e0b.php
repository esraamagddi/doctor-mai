<?php
$isRTL = app()->getLocale() == 'ar';
?>
<!-- Services Section for Home Page -->
<section class="relative py-20 overflow-hidden bg-base">
    <!-- Decorative Circles -->
    <div class="absolute border-2 border-secondary rounded-full top-20 <?php echo e($isRTL ? 'right-20' : 'left-20'); ?> w-80 h-80 opacity-50"></div>
    <div class="absolute border-2 border-secondary rounded-full bottom-20 <?php echo e($isRTL ? 'left-20' : 'right-20'); ?> w-60 h-60 opacity-55"></div>

    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <!-- Section Header -->
        <div class="mb-16 <?php echo e($isRTL ? 'text-right' : 'text-left'); ?>">
            <h2 class="mb-4 text-4xl font-bold text-black lg:text-5xl">
                <?php echo e(getLocalized(getSectionHeaders('services')['title']) ?? ''); ?>

            </h2>
            <p class="max-w-2xl text-lg text-black">
                <?php echo e(getLocalized(getSectionHeaders('services')['description']) ?? ''); ?>

            </p>
        </div>

        <!-- Swiper Container -->
        <div class="home-services-swiper-container">
            <!-- Navigation Arrows -->
            <div class="home-services-navigation">
                <div class="home-services-button-prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="home-services-button-next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>

            <!-- Swiper -->
            <div class="swiper home-services-swiper py-8">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="service-card">
                            <div class="service-image">
                                <img src="<?php echo e(asset('storage/' . $record->image)); ?>"
                                    alt="<?php echo e(getLocalized($record->name)); ?>"
                                    loading="lazy">
                            </div>
                            <div class="service-content">
                                <div class="service-text">
                                    <div class="service-title">
                                        <?php echo e(getLocalized($record->name)); ?>

                                    </div>
                                    <div class="service-description">
                                        <?php echo Str::limit(strip_tags(getLocalized($record->description)), 100); ?>

                                    </div>
                                </div>
                                <div class="service-number">
                                    <?php echo e(str_pad($key + 1, 2, '0', STR_PAD_LEFT)); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Pagination -->
            <div class="home-services-pagination"></div>
        </div>
    </div>
</section><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/home/services.blade.php ENDPATH**/ ?>