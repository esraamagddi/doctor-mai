<?php
$seo = \App\Http\Controllers\SeoController::index('services');
$isRTL = app()->getLocale() == 'ar';
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
<style>

</style>
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
                <?php echo e(getSectionHeaders('services')->title[app()->getLocale()] ?? ''); ?>

            </h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                <?php echo e(getSectionHeaders('services')->description[app()->getLocale()] ?? ''); ?>

            </p>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="relative py-20 overflow-hidden bg-base">
    <div class="absolute border-2 border-secondary rounded-full top-20 <?php echo e($isRTL ? 'right-20' : 'left-20'); ?> w-80 h-80 opacity-50"></div>
    <div class="absolute border-2 border-secondary rounded-full bottom-20 <?php echo e($isRTL ? 'left-20' : 'right-20'); ?> w-60 h-60 opacity-55"></div>

    <div class="container relative z-10 px-6 mx-auto max-w-7xl">
        <div class="mb-16 <?php echo e($isRTL ? 'text-right' : 'text-left'); ?>">
            <h2 class="mb-4 text-4xl font-bold text-black lg:text-5xl">
                <?php echo e(getLocalized(getSectionHeaders('services')['title']) ?? ''); ?>

            </h2>
            <p class="max-w-2xl text-lg text-black">
                <?php echo e(getLocalized(getSectionHeaders('services')['description']) ?? ''); ?>

            </p>
        </div>

        <div class="services-swiper-container">
            <!-- Navigation Arrows -->
            <div class="services-navigation">
                <div class="services-button-prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="services-button-next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <div class="swiper services-swiper">
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
            <div class="services-pagination"></div>
        </div>
    </div>
</section>

<script>
// Services Swiper Initialization - Fixed Version
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎠 Initializing Services Swiper...');
    
    // Wait for Swiper to be available
    if (typeof Swiper === 'undefined') {
        console.error('❌ Swiper library not loaded');
        return;
    }

    const swiperEl = document.querySelector('.services-swiper');
    if (!swiperEl) {
        console.error('❌ Services swiper element not found');
        return;
    }

    // Clean up existing instance
    if (swiperEl.swiper) {
        swiperEl.swiper.destroy(true, true);
    }

    const isRTL = document.documentElement.dir === 'rtl';
    console.log('🔄 RTL mode:', isRTL);

    // Initialize Swiper
    const servicesSwiper = new Swiper('.services-swiper', {
        direction: 'horizontal',
        rtl: isRTL,
        
        // Slides configuration
        slidesPerView: 1,
        spaceBetween: 30,
        centeredSlides: false,
        
        // Loop
        loop: true,
        
        // Speed & interaction
        speed: 600,
        grabCursor: true,
        observer: true,
        observeParents: true,
        
        // Autoplay
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        
        // Pagination
        pagination: {
            el: '.services-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        
        // Navigation
        navigation: {
            nextEl: '.services-button-next',
            prevEl: '.services-button-prev',
        },
        
        // Breakpoints
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 25,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        
        // Events
        on: {
            init: function() {
                console.log('✅ Services Swiper initialized successfully');
                console.log('📊 Total slides:', this.slides.length);
                console.log('👁️ Slides per view:', this.params.slidesPerView);
            },
            slideChange: function() {
                console.log('🔄 Slide changed to:', this.realIndex);
            }
        }
    });

    // Expose to global scope for debugging
    window.servicesSwiper = servicesSwiper;
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/services/index.blade.php ENDPATH**/ ?>