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

<!-- uncomment this when background image is available -->
<!-- example: background image container -->
<div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-no-repeat bg-cover"
        style="background-image: url('<?php echo e(asset('storage/' . ($slider->background_ar ?? '') )); ?>')">
    </div>
    <div class="absolute inset-0 bg-gradient-to-l from-secondary from-50% via-transparent to-transparent"></div>
</div>


<!-- ✅ Modern Creative Booking Form Section -->
<section class="relative py-20 bg-transparent flex flex-col justify-end overflow-hidden">
    <div class="mb-12 text-center">
        <h1 class="mb-4 text-3xl font-bold text-primary md:text-4xl lg:text-5xl">
            <?php echo e(getLocalized(getSectionHeaders('appointment')['title']) ?? ''); ?>

        </h1>
        <p class="max-w-2xl mx-auto text-base text-primary md:text-lg">
            <?php echo e(getLocalized(getSectionHeaders('appointment')['description']) ?? ''); ?>

        </p>
    </div>

    <div class="relative z-10 flex items-center container justify-end rtl:justify-start">

        <!-- ✅ Booking Form -->
        <div
            class="p-6 md:p-8 transition-all duration-500 transform border shadow-2xl bg-white/70 backdrop-blur-md rounded-3xl border-white/20 hover:shadow-xl hover:-translate-y-2 wow animate__animated animate__fadeInRight"
            data-wow-delay="0.1s">

            <form class="grid gap-6 md:grid-cols-2" method="POST" action="<?php echo e(route('appointment.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="_lang" value="<?php echo e(session('front_locale') ?? app()->getLocale()); ?>">

                <!-- Name -->
                <div class="relative group">
                    <label for="booking-name" class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-800">
                        <?php echo e(__('appointment.full_name')); ?>

                    </label>
                    <input type="text" id="booking-name" name="name" value="<?php echo e(old('name')); ?>" required
                        placeholder="<?php echo e(__('appointment.full_name_placeholder')); ?>"
                        class="w-full px-4 py-3 text-gray-800 placeholder-gray-400 transition-all duration-300 bg-white border-2 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-xl focus:outline-none focus:ring-4 focus:ring-sky-300/30 focus:border-primary">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div class="relative group">
                    <label for="booking-email" class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-800">
                        <?php echo e(__('appointment.email')); ?>

                    </label>
                    <input type="email" id="booking-email" name="email" value="<?php echo e(old('email')); ?>"
                        placeholder="<?php echo e(__('appointment.email_placeholder')); ?>"
                        class="w-full px-4 py-3 text-gray-800 placeholder-gray-400 transition-all duration-300 bg-white border-2 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-xl focus:outline-none focus:ring-4 focus:ring-sky-300/30 focus:border-primary">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Phone -->
                <div class="relative group">
                    <label for="booking-phone" class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-800">
                        <?php echo e(__('appointment.phone')); ?>

                    </label>
                    <input type="tel" id="booking-phone" name="phone" value="<?php echo e(old('phone')); ?>" required
                        placeholder="<?php echo e(__('appointment.phone_placeholder')); ?>"
                        class="w-full px-4 py-3 text-gray-800 placeholder-gray-400 transition-all duration-300 bg-white border-2 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-xl focus:outline-none focus:ring-4 focus:ring-sky-300/30 focus:border-primary">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Service -->
                <div class="relative group">
                    <label for="booking-service" class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-800">
                        <?php echo e(__('appointment.service')); ?>

                    </label>
                    <select id="booking-service" name="service" required
                        class="w-full px-4 py-3 text-gray-800 bg-white border-2 <?php $__errorArgs = ['service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-xl transition-all duration-300 appearance-none focus:outline-none focus:ring-4 focus:ring-sky-300/30 focus:border-primary">
                        <option value=""><?php echo e(__('appointment.select_service')); ?></option>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($record->id); ?>" <?php echo e(old('service') == $record->id ? 'selected' : ''); ?>>
                            <?php echo e(getLocalized($record->name)); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Date -->
                <div class="relative group">
                    <label for="booking-date" class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-800">
                        <?php echo e(__('appointment.date')); ?>

                    </label>
                    <input type="date" id="booking-date" name="date" value="<?php echo e(old('date')); ?>"
                        min="<?php echo e(now()->toDateString()); ?>" required
                        class="w-full px-4 py-3 text-gray-800 bg-white border-2 <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> rounded-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-sky-300/30 focus:border-primary">
                    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Time -->
                <div class="relative group">
                    <label for="booking-time" class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-800">
                        <?php echo e(__('appointment.time')); ?>

                    </label>
                    <select id="booking-time" name="time" disabled required
                        class="w-full px-4 py-3 text-gray-800 bg-white border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-sky-300/30 focus:border-primary">
                        <option value=""><?php echo e(__('appointment.select_time')); ?></option>
                        <?php $__currentLoopData = $time_slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(\Carbon\Carbon::parse($record->start_time)->format('H:i')); ?>"
                            day="<?php echo e($record->weekday); ?>">
                            <?php echo e(\Carbon\Carbon::parse($record->start_time)->format('h:i A')); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Notes -->
                <div class="relative group md:col-span-2">
                    <label for="booking-notes" class="flex items-center gap-2 mb-2 text-sm font-semibold text-gray-800">
                        <?php echo e(__('appointment.extra_notes')); ?>

                    </label>
                    <textarea id="booking-notes" name="message" rows="3"
                        placeholder="<?php echo e(__('appointment.extra_notes_placeholder')); ?>"
                        class="w-full px-4 py-3 text-gray-800 placeholder-gray-400 bg-white border-2 border-gray-300 resize-none rounded-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-sky-300/30 focus:border-primary"><?php echo e(old('message')); ?></textarea>
                </div>

                <!-- Submit -->
                <div class="pt-4 text-center md:col-span-2">
                    <button type="submit"
                        class="w-full px-6 py-3 font-semibold text-white bg-primary rounded-xl shadow-lg hover:bg-ternary hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        <?php echo e(__('appointment.submit')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- ✅ Script: Time Slots Filter -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dateInput = document.querySelector('input[name="date"]');
        const timeSelect = document.querySelector('select[name="time"]');
        const allOptions = Array.from(timeSelect.querySelectorAll("option[day]"));

        const selectTimeText = <?php echo json_encode(__('appointment.select_time'), 15, 512) ?>;
        const noSlotsText = <?php echo json_encode(__('appointment.no_slots'), 15, 512) ?>;

        timeSelect.innerHTML = `<option value="">${selectTimeText}</option>`;

        dateInput.addEventListener("change", function() {
            const selectedDate = new Date(this.value);
            let day = selectedDate.getDay();
            day = (day === 0) ? 1 : day + 1;

            timeSelect.innerHTML = `<option value="">${selectTimeText}</option>`;
            let hasOptions = false;

            allOptions.forEach(option => {
                if (parseInt(option.getAttribute("day")) === day) {
                    timeSelect.appendChild(option.cloneNode(true));
                    hasOptions = true;
                }
            });

            timeSelect.disabled = !hasOptions;
            if (!hasOptions) alert(noSlotsText);
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/appointment/index.blade.php ENDPATH**/ ?>