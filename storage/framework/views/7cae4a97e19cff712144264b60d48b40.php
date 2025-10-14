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

<section id="contact-success" class="py-20 bg-image-overlay" dir="<?php echo e(app()->getLocale()==='ar' ? 'rtl' : 'ltr'); ?>">
    <?php
        // الكنترولر يعمل redirect()->route(...)->with('contact_summary', [...])
        $s = session('contact_summary', []);
        $isAr = app()->getLocale()==='ar';
    ?>

    <div class="container mx-auto px-4 pt-6">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">
                <?php echo e(__('contact.success_title') ?: ($isAr ? 'تم استلام رسالتك' : 'Message received')); ?>

            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                <?php echo e(__('contact.success_subtitle') ?: ($isAr ? 'شكرًا لتواصلك معنا! سنرد عليك قريبًا.' : 'Thank you for contacting us! We will get back to you shortly.')); ?>

            </p>
        </div>

        
        <div class="max-w-3xl mx-auto bg-white shadow-xl p-8">
            <div class="flex items-start gap-4 mb-8">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">
                        <?php echo e(__('contact.success_box_title') ?: ($isAr ? 'تم إرسال الرسالة' : 'Request submitted')); ?>

                    </h2>
                    <p class="text-gray-600">
                        <?php echo e(__('contact.success_box_desc') ?: ($isAr ? 'تفاصيل رسالتك موضحة بالأسفل.' : 'Your message details are below.')); ?>

                    </p>
                </div>
            </div>

            
            <div class="grid md:grid-cols-2 gap-6">
                <?php if(!empty($s['ref'])): ?>
                    <div>
                        <div class="text-sm text-gray-500"><?php echo e(__('contact.reference') ?: ($isAr ? 'رقم المرجع' : 'Reference')); ?></div>
                        <div class="font-semibold text-primary"><?php echo e($s['ref']); ?></div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($s['name'])): ?>
                    <div>
                        <div class="text-sm text-gray-500"><?php echo e(__('contact.full_name') ?: ($isAr ? 'الاسم الكامل' : 'Full Name')); ?></div>
                        <div class="font-semibold"><?php echo e($s['name']); ?></div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($s['phone'])): ?>
                    <div>
                        <div class="text-sm text-gray-500"><?php echo e(__('contact.phone') ?: ($isAr ? 'رقم الهاتف' : 'Phone Number')); ?></div>
                        <div class="font-semibold"><?php echo e($s['phone']); ?></div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($s['email'])): ?>
                    <div>
                        <div class="text-sm text-gray-500"><?php echo e(__('contact.email') ?: ($isAr ? 'البريد الإلكتروني' : 'Email')); ?></div>
                        <div class="font-semibold"><?php echo e($s['email']); ?></div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($s['subject'])): ?>
                    <div class="md:col-span-2">
                        <div class="text-sm text-gray-500"><?php echo e(__('contact.subject') ?: ($isAr ? 'الموضوع' : 'Subject')); ?></div>
                        <div class="font-semibold"><?php echo e($s['subject']); ?></div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($s['message'])): ?>
                    <div class="md:col-span-2">
                        <div class="text-sm text-gray-500"><?php echo e(__('contact.message') ?: ($isAr ? 'الرسالة' : 'Message')); ?></div>
                        <div class="font-semibold whitespace-pre-line leading-7"><?php echo e($s['message']); ?></div>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="mt-10 flex flex-col sm:flex-row gap-4 <?php echo e($isAr ? 'justify-center sm:flex-row-reverse' : 'justify-center'); ?> pt-6">
                <a href="<?php echo e(route((session('front_locale') ?? app()->getLocale()).'.home')); ?>"
                   class="bg-accent text-white px-6 py-3 font-semibold hover:bg-primary transition-colors duration-300 text-center">
                    <?php echo e(__('contact.back_home') ?: ($isAr ? 'العودة للرئيسية' : 'Back to Home')); ?>

                </a>

                <a href="<?php echo e(route((session('front_locale') ?? app()->getLocale()).'.contact')); ?>"
                   class="bg-primary-light text-white px-6 py-3 font-semibold hover:bg-primary hover:text-white transition-colors duration-300 text-center">
                    <?php echo e(__('contact.send_another') ?: ($isAr ? 'إرسال رسالة أخرى' : 'Send another message')); ?>

                </a>
            </div>
        </div>
    </div>
</section>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/contact/success.blade.php ENDPATH**/ ?>