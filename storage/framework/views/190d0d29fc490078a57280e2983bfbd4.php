<?php $__currentLoopData = $mainSlider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
$locale = session('front_locale') ?? app()->getLocale();
$button1Text = getLocalized($record->button1_text) ?? null;
$button2Text = getLocalized($record->button2_text) ?? null;
?>

<!-- ✅ Background Image - Responsive (Fixed on desktop, Absolute on mobile) -->
<div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-no-repeat bg-cover"
        style="background-image: url('<?php echo e(asset('storage/' . $record->background_ar)); ?>')">
    </div>
    <div class="absolute inset-0 bg-gradient-to-l from-secondary from-50% via-transparent to-transparent"></div>
</div>

<!-- Hero Section -->
<section class="flex flex-col w-full lg:justify-between justify-end px-4 sm:px-6 lg:px-8 overflow-x-hidden ">

    <!-- Hero Content Container -->
    <div class="flex items-end justify-center w-full px-4 lg:flex-1 lg:items-start lg:pt-16 md:justify-end rtl:justify-start max-w-7xl m-auto lg:pb-10">

        <!-- Hero Content -->
        <div class="w-full max-w-md text-left lg:hero-content sm:max-w-md xl:max-w-2xl pb-10 ">
            <img src="<?php echo e(asset('storage/' . $record->image)); ?>" alt=" <?php echo e(getLocalized($record->title) ?? ''); ?>"
                class="md:hidden object-cover object-center w-full h-full mb-5" />
            <!-- Title -->
            <h1 class="mb-4 text-4xl font-extrabold leading-tight text-left rtl:text-right text-black md:text-5xl xl:text-6xl sm:mb-6">
                <?php echo e(getLocalized($record->title) ?? ''); ?>

            </h1>

            <!-- Subtitle -->
            <p
                class="px-1 mb-8 text-base leading-relaxed text-left text-black/80 sm:text-lg md:text-xl lg:text-lg xl:text-2xl sm:px-0">
                <?php echo getLocalized($record->description) ?? ''; ?>

            </p>

            <!-- Buttons Container -->
            <div class="flex-col justify-center hidden w-full gap-3 mt-5 lg:flex lg:flex-row lg:justify-start sm:gap-4 lg:gap-6">
                <?php if($button1Text): ?>
                <!-- Button 1 -->
                <a href="<?php echo e(route($locale . '.appointment')); ?>"
                    class="w-full px-6 py-3 text-sm font-semibold text-center transition-all duration-300 border-2 rounded-full sm:w-auto sm:px-8 border-primary text-primary hover:bg-primary hover:text-secondary shadow-lg">
                    <?php echo e($button1Text); ?>

                </a>
                <?php endif; ?>

                <?php if($button2Text): ?>
                <!-- Button 2 -->
                <a href="<?php echo e(route($locale . '.services')); ?>"
                    class="w-full px-6 py-3 text-sm font-semibold text-center text-white transition-all duration-300 rounded-full sm:w-auto sm:px-8 sm:text-base bg-primary hover:bg-black shadow-lg">
                    <?php echo e($button2Text); ?>

                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="flex justify-center w-full px-4 mb-12 lg:mb-16">
        <div class="grid w-full max-w-7xl gap-6 lg:grid-cols-3">

            <!-- Working Hours Card -->
            <a href="<?php echo e(route($locale . '.contact')); ?>"
                class="relative block p-6 sm:p-8 rounded-2xl shadow-lg border border-primary/20 bg-secondary/40 backdrop-blur-md hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group wow animate__animated animate__fadeInUp"
                data-wow-delay="0.1s">

                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="mb-2 text-xl font-bold text-primary sm:text-2xl">
                            <?php echo e(__('contact.working_hours_label')); ?>

                        </h3>
                        <div class="w-12 h-1 bg-primary rounded-full"></div>
                    </div>
                    <div class="p-3 rounded-full bg-primary/10 group-hover:bg-primary transition">
                        <svg class="w-6 h-6 text-primary group-hover:text-secondary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="mr-4 text-primary">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12,6 12,12 16,14"></polyline>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-primary"><?php echo e(getLocalized(Setting()->working_hours) ?? ''); ?></p>
                    </div>
                </div>
            </a>

            <!-- Book Appointment Card -->
            <a href="<?php echo e(route($locale . '.appointment')); ?>"
                class="relative block p-6 sm:p-8 rounded-2xl shadow-lg border border-primary/20 bg-secondary/40 backdrop-blur-md hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group wow animate__animated animate__fadeInUp"
                data-wow-delay="0.2s">

                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="mb-2 text-xl font-bold text-primary sm:text-2xl">
                            <?php echo e(__('buttons.book appointment')); ?>

                        </h3>
                        <div class="w-12 h-1 bg-primary rounded-full"></div>
                    </div>
                    <div class="p-3 rounded-full bg-primary/10 group-hover:bg-primary transition">
                        <svg class="w-6 h-6 text-primary group-hover:text-secondary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="mr-4 text-primary">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-primary"><?php echo e(__('hero.quick_easy')); ?></p>
                    </div>
                </div>
            </a>

            <!-- Contact Us Card -->
            <a href="<?php echo e(route($locale . '.contact')); ?>"
                class="relative block p-6 sm:p-8 rounded-2xl shadow-lg border border-primary/20 bg-secondary/40 backdrop-blur-md hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group wow animate__animated animate__fadeInUp"
                data-wow-delay="0.3s">

                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="mb-2 text-xl font-bold text-primary sm:text-2xl">
                            <?php echo e(__('contact.contact us')); ?>

                        </h3>
                        <div class="w-12 h-1 bg-primary rounded-full"></div>
                    </div>
                    <div class="p-3 rounded-full bg-primary/10 group-hover:bg-primary transition">
                        <svg class="w-6 h-6 text-primary group-hover:text-secondary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="mr-4 text-primary">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-primary"><?php echo e(__('hero.support_24_7')); ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>

</section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/home/hero-section.blade.php ENDPATH**/ ?>