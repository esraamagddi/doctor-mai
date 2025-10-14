<!-- Before & After Gallery Section -->
<section class="relative py-20 overflow-hidden bg-secondary ">
  <!-- Decorative Circles -->
  <div class="absolute border border-primary rounded-full top-5 left-1/3 w-80 h-80 opacity-20"></div>
  <div class="absolute border border-primary rounded-full bottom-5 left-20 w-80 h-80 opacity-15"></div>
  <div class="container relative z-10 px-6 mx-auto max-w-7xl">
    <div class="grid items-start gap-16 lg:grid-cols-2">
      <!-- ✅ النص الأساسي -->
      <div class="order-1 space-y-8 lg:order-2">
        <!-- النص الأساسي -->
        <div class="space-y-4">
          <h2 class="text-4xl font-bold leading-tight text-gray-900 md:text-5xl capitalize">
            <?php echo e(getLocalized(getSectionHeaders('transformations')['title']) ?? ''); ?>

          </h2>
          <div class="space-y-4 leading-relaxed text-gray-600">
            <?php echo e(getLocalized(getSectionHeaders('transformations')['description']) ?? ''); ?>

          </div>
        </div>

        <!-- ✅ زرار الحجز + ملاحظة التأمين (يظهر هنا على الشاشات الكبيرة فقط) -->
        <div class="flex-col hidden space-y-6 lg:flex">
          <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'appointment' )); ?>"
            class="block px-6 py-3 font-semibold text-center text-white transition-colors duration-300 border border-gray-400 shadow-lg bg-primary rounded-full">
            <?php echo e(__('buttons.book appointment')); ?>

          </a>
          <div class="pt-8 border-t border-gray-200">
            <p class="text-gray-600">
              <span class="font-semibold text-gray-900"><?php echo e(__('appointment.no_insurance')); ?></span>
            </p>
          </div>
        </div>
      </div>
      <!-- ✅ الصور -->
      <div class="order-2 lg:order-1 space-y-10">
        <?php $__currentLoopData = $transformations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transformation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- Before/After Comparison 1 -->
        <div
          class="relative overflow-hidden transition-all duration-500 bg-white shadow-2xl group rounded-3xl hover:shadow-purple-300/30 before-after-container h-[320px]"
          data-slider="1">
          <img src="<?php echo e(asset('storage/' . $transformation->before_image)); ?>"
            alt="Before Treatment" class="object-cover object-bottom w-full h-80" />
          <div class="after-image">
            <img src="<?php echo e(asset('storage/' . $transformation->after_image)); ?>"
 alt="After Treatment" class="object-cover object-bottom w-full h-80" />
          </div>
          <div class="slider-line"></div>
          <div
            class="absolute z-10 px-3 py-1 text-sm font-medium text-white rounded-full top-4 left-4 bg-gray-800/80">
            BEFORE
          </div>
          <div class="absolute z-10 px-3 py-1 text-sm font-medium text-white rounded-full top-4 right-4 bg-primary">
            AFTER
          </div>
          <div class="slider-handle">
            <div
              class="flex items-center justify-center w-12 h-12 transition-colors bg-white border-2 border-gray-200 rounded-full shadow-lg hover:border-pink-400">
              <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5l-7 7 7 7M15 5l7 7-7 7" />
              </svg>
            </div>
          </div>
        </div>





        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- ✅ زرار الحجز + ملاحظة التأمين (يظهر هنا على الشاشات الصغيرة والمتوسطة فقط) -->
        <div class="block space-y-6 lg:hidden">
          <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'appointment' )); ?>"
            class="block px-6 py-3 font-semibold text-center text-white transition-colors duration-300 border border-gray-400 shadow-lg bg-primary rounded-full w-full">
            <?php echo e(__('buttons.book appointment')); ?>

          </a>
          <div class="pt-8 border-t border-gray-200">
            <p class="text-gray-600">
              <?php echo e(__('appointment.no_insurance')); ?>

            </p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Decorative Elements -->
  <div class="absolute w-40 h-40 border-2 border-pink-200 rounded-full top-10 right-10 opacity-20"></div>
  <div class="absolute border-2 border-purple-200 rounded-full bottom-20 left-20 w-60 h-60 opacity-15"></div>
</section><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/front/home/transformations.blade.php ENDPATH**/ ?>