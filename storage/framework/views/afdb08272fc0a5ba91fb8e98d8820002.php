<!-- ✅ Add this CSS in your home page layout head or custom CSS -->
<style>
/* Services Swiper Styles */
.home-services-swiper-container {
    width: 100%;
    position: relative;
    padding: 20px 0 60px;
}

.home-services-swiper {
    width: 100%;
    height: auto;
    overflow: hidden;
    position: relative;
}

.home-services-swiper .swiper-wrapper {
    display: flex;
    align-items: stretch;
}

.home-services-swiper .swiper-slide {
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
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
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

/* Pagination */
.home-services-pagination {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 8px;
    padding-top: 30px;
}

.home-services-pagination .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: #000;
    opacity: 0.3;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.home-services-pagination .swiper-pagination-bullet-active {
    opacity: 1;
    transform: scale(1.2);
}

/* Navigation Arrows */
.home-services-navigation {
    position: absolute;
    top: 40%;
    transform: translateY(-50%);
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 10;
    pointer-events: none;
}

.home-services-button-prev,
.home-services-button-next {
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
    pointer-events: auto;
}

.home-services-button-prev:hover,
.home-services-button-next:hover {
    background: #f8f8f8;
    transform: scale(1.1);
}

.home-services-button-prev.swiper-button-disabled,
.home-services-button-next.swiper-button-disabled {
    opacity: 0.35;
    cursor: not-allowed;
}

/* Responsive */
@media (max-width: 768px) {
    .home-services-navigation {
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
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="home-services-button-next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- Swiper -->
            <div class="swiper home-services-swiper">
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
</section>

<!-- ✅ Swiper Initialization Script for Home Page -->
<script>
(function() {
    'use strict';

    function initHomeServicesSwiper() {
        // Check if Swiper is loaded
        if (typeof Swiper === 'undefined') {
            console.error('❌ Swiper library not loaded for home services');
            return;
        }

        // Check if element exists
        const swiperEl = document.querySelector('.home-services-swiper');
        if (!swiperEl) {
            console.warn('⚠️ Home services swiper element not found');
            return;
        }

        try {
            const isRTL = document.documentElement.getAttribute('dir') === 'rtl';
            console.log('🏠 Initializing Home Services Swiper (RTL:', isRTL, ')');

            // Destroy existing instance if any
            if (swiperEl.swiper) {
                swiperEl.swiper.destroy(true, true);
            }

            // Initialize Swiper
            const homeServicesSwiper = new Swiper('.home-services-swiper', {
                // Basic settings
                direction: 'horizontal',
                loop: true,
                speed: 600,
                
                // Slides settings
                slidesPerView: 1,
                spaceBetween: 30,
                centeredSlides: false,
                
                // RTL support
                rtl: isRTL,
                
                // Interaction
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
                    el: '.home-services-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                
                // Navigation
                navigation: {
                    nextEl: '.home-services-button-next',
                    prevEl: '.home-services-button-prev',
                },
                
                // Responsive breakpoints
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 25
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                },
                
                // Performance
                watchOverflow: true,
                watchSlidesProgress: true,
                
                // Events
                on: {
                    init: function() {
                        console.log('✅ Home Services Swiper initialized successfully');
                        console.log('📊 Total slides:', this.slides.length);
                        console.log('👁️ Slides per view:', this.params.slidesPerView);
                    },
                    slideChange: function() {
                        console.log('🔄 Home Services - Slide changed to:', this.realIndex);
                    },
                    error: function(swiper, error) {
                        console.error('❌ Home Services Swiper error:', error);
                    }
                }
            });

            // Manual RTL update if needed
            if (isRTL && homeServicesSwiper) {
                setTimeout(() => {
                    homeServicesSwiper.changeLanguageDirection('rtl');
                    homeServicesSwiper.update();
                    console.log('🔄 Home Services RTL direction applied');
                }, 100);
            }

            // Expose to global scope for debugging
            window.homeServicesSwiper = homeServicesSwiper;

        } catch (error) {
            console.error('❌ Home Services Swiper initialization error:', error);
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHomeServicesSwiper);
    } else {
        initHomeServicesSwiper();
    }

    // Fallback initialization
    setTimeout(initHomeServicesSwiper, 500);
})();
</script><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/home/services.blade.php ENDPATH**/ ?>