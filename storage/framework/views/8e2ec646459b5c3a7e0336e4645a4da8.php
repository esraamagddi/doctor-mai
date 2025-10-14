<?php $__env->startSection('title'); ?><?php echo e($video->title[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?><?php echo e($video->description[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('og_title'); ?><?php echo e($video->title[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_description'); ?><?php echo e($video->description[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_url'); ?><?php echo e(route(app()->getLocale() . '.video.details', $video->id)); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('og_image'); ?><?php echo e($video->image ? asset('storage/' . $video->image) : ''); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('twitter_image'); ?><?php echo e($video->image ? asset('storage/' . $video->image) : ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_title'); ?><?php echo e($video->title[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('twitter_description'); ?><?php echo e($video->description[app()->getLocale()] ?? ''); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('canonical'); ?><?php echo e(route(app()->getLocale() . '.video.details', $video->id)); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="/assets/css/blog.css?v=5">
<style>
    iframe {
        width: 100% !important;
        height: 100% !important;
        aspect-ratio: 16/9;
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

<section id="news" class="py-20 bg-image-overlay animate-in">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 gap-8">
                <div class="lg:col-span-2">
                    <article class="bg-secondary rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                        <div class="p-8">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                                <?php echo e($video->title[app()->getLocale()] ?? ''); ?>

                            </h1>

                            <?php
                            // Extract YouTube video ID
                            $videoId = null;
                            $urlToCheck = $video->embed_code ?? $video->video_url;

                            if ($urlToCheck && $urlToCheck != '#') {
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $urlToCheck, $match);
                            $videoId = $match[1] ?? null;
                            }
                            ?>

                            <div class="relative aspect-video overflow-hidden bg-gray-900 rounded-xl">
                                <?php if($videoId): ?>
                                <iframe
                                    src="https://www.youtube.com/embed/<?php echo e($videoId); ?>"
                                    title="<?php echo e($video->title[app()->getLocale()] ?? ''); ?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    class="w-full h-full">
                                </iframe>
                                <?php else: ?>
                                <div class="flex items-center justify-center h-full text-white">
                                    <p><?php echo e(__('video.no_video_available')); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-6">
                                <p class="text-gray-700 leading-relaxed">
                                    <?php echo e($video->description[app()->getLocale()] ?? ''); ?>

                                </p>
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <?php
                                $shareUrl = route(app()->getLocale() . '.video.details', $video->id);
                                $shareText = $video->title[app()->getLocale()] ?? __('video.watch_this_article');
                                ?>

                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-gray-700 font-medium ml-3"><?php echo e(__('video.share_article')); ?></span>

                                        
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode($shareUrl)); ?>" target="_blank"
                                            class="flex items-center justify-center w-10 h-10 bg-primary hover:bg-primary text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-facebook w-5 h-5">
                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                            </svg>
                                        </a>

                                        
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode($shareUrl)); ?>&text=<?php echo e(urlencode($shareText)); ?>" target="_blank"
                                            class="flex items-center justify-center w-10 h-10 bg-primary hover:bg-primary text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-twitter w-5 h-5">
                                                <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                                            </svg>
                                        </a>

                                        
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode($shareUrl)); ?>" target="_blank"
                                            class="flex items-center justify-center w-10 h-10 bg-primary hover:bg-primary text-white rounded-full transition-all duration-200 hover:scale-110 shadow-md hover:shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-linkedin w-5 h-5">
                                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                                <rect width="4" height="12" x="2" y="9"></rect>
                                                <circle cx="4" cy="4" r="2"></circle>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-image-overlay container mx-auto px-4 py-4">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-primary mb-8 text-center"><?php echo e(__('video.related_videos')); ?></h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $relatedvideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $videoId = null;
            $urlToCheck = $record->embed_code ?? $record->video_url;

            if ($urlToCheck && $urlToCheck != '#') {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $urlToCheck, $match);
            $videoId = $match[1] ?? null;
            }

            $coverImage = null;
            if ($record->image) {
            $coverImage = asset('storage/' . $record->image);
            } elseif ($videoId) {
            $coverImage = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
            }
            ?>

            <?php if($videoId): ?>
            <a href="<?php echo e(route(app()->getLocale() . '.video.details', $record->id)); ?>" class="block group">
                <div class="relative rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 bg-white border border-secondary">
                    <div class="relative aspect-video bg-gray-900">
                        <!-- Cover Image -->
                        <img
                            src="<?php echo e($coverImage); ?>"
                            alt="<?php echo e(is_array($record->title) ? ($record->title[app()->getLocale()] ?? '') : $record->title); ?>"
                            class="w-full h-full object-cover transition-opacity duration-300"
                            onerror="this.src='https://img.youtube.com/vi/<?php echo e($videoId); ?>/hqdefault.jpg'">

                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black/30 transition-all duration-300 group-hover:bg-black/40">
                            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 shadow-2xl">
                                <svg class="w-10 h-10 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="transition-all p-6">
                        <h3 class="mb-2 text-lg font-bold text-primary">
                            <?php echo e(is_array($record->title) ? ($record->title[app()->getLocale()] ?? '') : $record->title); ?>

                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            <?php echo e(is_array($record->description) ? ($record->description[app()->getLocale()] ?? '') : $record->description); ?>

                        </p>
                    </div>
                </div>
            </a>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo e(route(app()->getLocale().'.video')); ?>"
                class="bg-primary text-white text-center px-8 py-4 text-lg font-semibold hover:bg-primary transition-colors duration-300 inline-block rounded-lg">
                <?php echo e(__('video.view_all_posts')); ?>

            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/video/details.blade.php ENDPATH**/ ?>