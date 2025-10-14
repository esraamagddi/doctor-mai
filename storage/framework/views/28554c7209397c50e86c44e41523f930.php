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

                <!-- Social Links -->
                <div>
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">
                        <?php echo e(__('contact.follow_us')); ?>

                    </h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-dprimary  ">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-dprimary  ">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.566-1.35 2.14-2.21z" />
                            </svg>
                        </a>
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
            class="w-full px-6 py-3 text-white transition-colors duration-300 rounded-lg bg-dprimary hover:bg-primary">
            <?php echo e(__('contact.submit')); ?>

        </button>
    </form>
</div>            </div>
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
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/contact/index.blade.php ENDPATH**/ ?>