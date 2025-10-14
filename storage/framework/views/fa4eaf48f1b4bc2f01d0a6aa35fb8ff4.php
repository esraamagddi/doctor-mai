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
/* Services Swiper - Fixed Styles */
.services-swiper-container {
    width: 100%;
    position: relative;
    padding: 20px 0 80px;
}

.services-swiper {
    width: 100%;
    height: auto;
    overflow: visible !important;
}

.services-swiper .swiper-wrapper {
    display: flex;
    align-items: stretch;
}

.services-swiper .swiper-slide {
    height: auto;
    display: flex;
}

.service-card {
    width: 100%;
    height: 100%;
    background: white;
    border-radius: 24px 24px 0 0;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
}

.service-image {
    width: 100%;
    height: 320px;
    overflow: hidden;
    flex-shrink: 0;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.service-card:hover .service-image img {
    transform: scale(1.05);
}

.service-content {
    padding: 24px;
    display: flex;
    gap: 20px;
    align-items: flex-start;
    flex: 1;
}

/* RTL Support */
html[dir="rtl"] .service-content {
    flex-direction: row-reverse;
}

html[dir="ltr"] .service-content {
    flex-direction: row;
}

.service-text {
    flex: 1;
    min-width: 0;
}

html[dir="rtl"] .service-text {
    text-align: right;
}

html[dir="ltr"] .service-text {
    text-align: left;
}

.service-title {
    font-size: 1.5rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
    color: #333;
}

.service-description {
    font-size: 0.875rem;
    line-height: 1.6;
    color: #666;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.service-number {
    font-size: 4rem;
    font-weight: 700;
    line-height: 1;
    color: #333;
    flex-shrink: 0;
    opacity: 0.7;
}

/* Pagination - Fixed */
.services-pagination {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 8px;
}

.services-pagination .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: #000;
    opacity: 0.3;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.services-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    transform: scale(1.2);
}

/* Navigation Arrows */
.services-navigation {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 10;
}

.services-button-prev,
.services-button-next {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.services-button-prev:hover,
.services-button-next:hover {
    background: #f8f8f8;
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
    .services-navigation {
        display: none;
    }
    
    .service-number {
        font-size: 3rem;
    }
    
    .service-title {
        font-size: 1.25rem;
    }
    
    .service-content {
        padding: 16px;
        gap: 12px;
    }
    
    .service-image {
        height: 250px;
    }
}
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
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/services/index.blade.php ENDPATH**/ ?>