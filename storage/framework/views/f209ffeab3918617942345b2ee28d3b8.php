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
                <?php echo e(getLocalized(getSectionHeaders('contact')['title'])); ?>

            </h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600 md:text-xl">
                <?php echo e(getLocalized(getSectionHeaders('contact')['description'])); ?>

            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="relative py-24 bg-secondary">
    <div class="absolute border border-primary rounded-full top-10 left-80 w-80 h-80 opacity-10"></div>
    <div class="absolute border border-primary rounded-full bottom-10 left-20 w-80 h-80 opacity-15"></div>
    <div class="container px-6 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
            <!-- Contact Info -->
            <div class="space-y-8">
                <div>
                    <h2 class="mb-6 text-3xl font-bold text-gray-900">
                        <?php echo e(__('contact.info_heading')); ?>

                    </h2>
                </div>

                <div class="space-y-6">
                    <!-- Address -->
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-4 rounded-full bg-base">
                            <svg class="w-6 h-6 text-dprimary " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="mb-1 text-lg font-semibold text-gray-900">
                                <?php echo e(__('contact.our_location')); ?>

                            </h3>
                            <p class="text-gray-600">
                                <?php echo e(Setting()->address[app()->getLocale()] ?? ''); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-4 rounded-full bg-base">
                            <svg class="w-6 h-6 text-dprimary " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="mb-1 text-lg font-semibold text-gray-900">
                                <?php echo e(__('contact.phone_label')); ?>


                            </h3>
                            <p class="text-gray-600"><?php echo e(Setting()->phones ?? ''); ?></p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-4 rounded-full bg-base">
                            <svg class="w-6 h-6 text-dprimary " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="mb-1 text-lg font-semibold text-gray-900">
                                <?php echo e(__('contact.email_label')); ?>

                            </h3>
                            <p class="text-gray-600"><?php echo e(Setting()->contact_emails ?? ''); ?></p>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-4 rounded-full bg-base">
                            <svg class="w-6 h-6 text-dprimary " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="mb-1 text-lg font-semibold text-gray-900">
                                <?php echo e(__('contact.working_hours_label')); ?>

                            </h3>
                            <p class="text-gray-600">
                                <?php echo e(Setting()->working_hours[app()->getLocale()] ?? ''); ?>

                            </p>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Contact Form -->
            <div class="p-6 shadow-inner bg-base/40 backdrop-blur-lg rounded-2xl">

                <!-- Contact Form -->
                <div class="p-6 shadow-inner bg-base/40 backdrop-blur-lg rounded-2xl">
                    <form class="space-y-6" method="POST" action="<?php echo e(route('front.contact.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_lang" value="<?php echo e(session('front_locale') ?? app()->getLocale()); ?>">

                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
                                <?php echo e(__('contact.full_name')); ?>

                            </label>
                            <input type="text" id="name" name="name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                value="<?php echo e(old('name')); ?>" required
                                placeholder="<?php echo e(__('contact.full_name_placeholder')); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                                <?php echo e(__('contact.email')); ?>

                            </label>
                            <input type="email" id="email" name="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                value="<?php echo e(old('email')); ?>"
                                placeholder="<?php echo e(__('contact.email_placeholder')); ?>" required />
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">
                                <?php echo e(__('contact.phone')); ?>

                            </label>
                            <input type="tel" id="phone" name="phone"
                                value="<?php echo e(old('phone')); ?>"
                                placeholder="<?php echo e(__('contact.phone_placeholder')); ?>"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                required />
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-700">
                                <?php echo e(__('contact.message')); ?>

                            </label>
                            <textarea id="message" name="message" rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="<?php echo e(__('contact.message_placeholder')); ?>" required><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit"
                            class="w-full px-6 py-3 text-white transition-colors duration-300 rounded-lg bg-primary hover:bg-primary">
                            <?php echo e(__('contact.submit')); ?>

                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Placeholder (Optional: Embed Google Maps later) -->
<section class="py-12 bg-base">
    <div class="container px-6 mx-auto max-w-7xl">
        <div class="overflow-hidden shadow-lg rounded-2xl h-80">
            <?php echo Setting()->google_map_embed ?? ''; ?>

        </div>
    </div>
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/contact/index.blade.php ENDPATH**/ ?>