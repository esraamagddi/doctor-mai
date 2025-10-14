<!-- ✅ Footer -->
<footer class="relative text-white bg-[#1e0909]" <?php if(app()->getLocale() === 'ar'): ?> dir="rtl" <?php endif; ?>>
    <div class="container px-6 mx-auto max-w-7xl">
        <!-- Grid -->
        <div class="grid gap-10 py-16 md:grid-cols-4">
            <!-- Brand -->
            <div>
                <h3 class="mb-4 text-2xl font-extrabold tracking-wide <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>">
                    <span class="text-secondary"><?php echo e(Setting()->site_name[app()->getLocale()] ?? ''); ?></span>
                </h3>
                <p class="mb-6 text-gray-300 <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>">
                    <?php echo Setting()->site_description[app()->getLocale()] ?? ''; ?>

                </p>
                <!-- Socials -->
                <div class="flex gap-4 <?php if(app()->getLocale() === 'ar'): ?> flex-row-reverse <?php endif; ?>">
                    <a
                        href="<?php echo e(Setting()->social['instagram'] ?? '#'); ?>"
                        class="p-2 transition bg-gray-700 rounded-full hover:bg-sky-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg>
                    </a>
                    <a
                        href="<?php echo e(Setting()->social['facebook'] ?? '#'); ?>"
                        class="p-2 transition bg-gray-700 rounded-full hover:bg-sky-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                    <a
                        href="<?php echo e(Setting()->social['youtube'] ?? '#'); ?>"
                        class="p-2 transition bg-gray-700 rounded-full hover:bg-sky-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-youtube">
                            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"></path>
                            <path d="m10 15 5-3-5-3z"></path>
                        </svg>
                    </a>
                    <a
                        href="<?php echo e(Setting()->social['twitter'] ?? '#'); ?>"
                        class="p-2 transition bg-gray-700 rounded-full hover:bg-sky-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter">
                            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                        </svg>
                    </a>
                </div>
            </div>


            <!-- Contact -->
            <div>
                <h3 class="mb-4 text-lg font-semibold text-secondary <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>"><?php echo e(__('footer.contact')); ?></h3>
                <ul class="space-y-2 text-gray-300 <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>">
                    <li><?php echo e(Setting()->address[app()->getLocale()] ?? ''); ?></li>
                    <li><?php echo e(__('footer.email')); ?>: <?php echo e(Setting()->contact_emails ?? ''); ?></li>
                    <li><?php echo e(__('footer.phone')); ?>: <?php echo e(Setting()->contact_phones ?? ''); ?></li>
                </ul>
            </div>


            <!-- Links -->
            <div>
                <h3 class="mb-4 text-lg font-semibold text-secondary <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>"><?php echo e(__('footer.quick_links')); ?></h3>
                <ul class="space-y-2 <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>">
                    <?php $__currentLoopData = getNavbar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . $record->slug )); ?>" class="transition text-secondary hover:text-white"><?php echo e($record->title[app()->getLocale()] ?? ''); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>


            <!-- Info -->
            <div>
                <h3 class="mb-4 text-lg font-semibold text-secondary <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>"><?php echo e(__('footer.information')); ?></h3>
                <?php
                use Solutions\Pages\Models\Page;


                $locale = session('front_locale') ?? app()->getLocale();
                $policySlugs = ['privacy','terms','disclaimer','refund'];
                $pages = Page::where('status', true)
                ->whereIn('slug', $policySlugs)
                ->orderByRaw("FIELD(slug,'privacy','terms','disclaimer','refund')")
                ->get(['slug','title']);
                ?>
                <ul class="space-y-2 <?php if(app()->getLocale() === 'ar'): ?> text-end <?php endif; ?>">
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                    <?php
                    $title = is_array($p->title ?? null)
                    ? ($p->title[$locale] ?? (reset($p->title) ?: ucfirst($p->slug)))
                    : ($p->title ?: ucfirst($p->slug));


                    $routeName = $locale . '.' . $p->slug;


                    try {
                    $href = route($routeName);
                    } catch (\Throwable $e) {
                    $href = url($locale . '/' . $p->slug);
                    }
                    ?>


                    <li><a href="<?php echo e($href); ?>" class="transition text-secondary hover:text-white"><?php echo e($title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>


        <!-- Divider -->
        <div
            class="pt-6 pb-8 text-sm text-center flex justify-center gap-2 text-gray-400 border-t border-gray-700 <?php if(app()->getLocale() === 'ar'): ?> flex-row-reverse <?php endif; ?>">
            <span><?php echo e(__("footer.Powered By")); ?>:</span> <a style="font-weight: 600; display: flex; gap:0.2rem" href="https://corpintech.com/"><img style="width: 1rem;" src="<?php echo e(asset('assets/frontend/images/corpintech-logo.png')); ?>" alt="Corpintech">Corpintech</a>
        </div>
    </div>
</footer><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/layouts/front/footer.blade.php ENDPATH**/ ?>