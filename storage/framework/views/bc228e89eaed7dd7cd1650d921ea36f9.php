<!-- Testimonials Slider Section -->
<section class="relative py-20 pb-10 overflow-hidden bg-secondary">
  <div class="container relative z-10 px-6 mx-auto max-w-7xl">

    <div class="mb-16 text-center">
      <h2 class="mb-4 text-4xl font-bold text-gray-900 lg:text-5xl">
        <?php echo e(getLocalized(getSectionHeaders('testimonials')['title']) ?? ''); ?>

      </h2>
      <p class="max-w-2xl mx-auto text-lg text-gray-600">
        <?php echo e(getLocalized(getSectionHeaders('testimonials')['description']) ?? ''); ?>

      </p>
    </div>

    <!-- ✅ Swiper Slider -->
    <div class="relative swiper testimonials-swiper pb-20 pt-5">
      <div class="swiper-wrapper">
        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="swiper-slide">
          <div
            class="relative p-6 overflow-hidden transition-all duration-500 bg-white group rounded-2xl hover:shadow-xl sm:p-8">

            <!-- Stars -->
            <div class="flex items-center mb-4 space-x-1 text-yellow-400">
              <?php for($i = 0; $i < $record->rating; $i++): ?>
                ★
                <?php endfor; ?>
            </div>

            <!-- ✅ Fixed height text -->
            <p class="testimonial-text mb-4 text-sm leading-relaxed text-gray-700 text-primary h-[70px] overflow-hidden transition-all duration-500 ease-in-out">
              <?php echo getLocalized($record->description) ?? ''; ?>

            </p>

            <!-- Read More button -->
            <button class="read-more-btn text-sm font-semibold text-primary hover:underline focus:outline-none ">
              <?php echo e(__('buttons.read_more')); ?>

            </button>

            <!-- Client Info -->
            <div class="flex items-center gap-2 mt-6">
              <div class="flex items-center justify-center w-12 h-12 mr-4 text-white bg-pink-500 rounded-full">
                <span class="text-lg font-bold"><?php echo mb_substr(getLocalized($record->name) ?? '', 0, 1); ?></span>
              </div>
              <div>
                <h4 class="text-lg font-bold text-gray-900"><?php echo getLocalized($record->name) ?? ''; ?></h4>
                <p class="text-sm text-gray-600"><?php echo getLocalized($record->service) ?? ''; ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

    </div>

    <!-- Navigation -->
    <div class="swiper-button-prev custom-nav text-primary"></div>
    <div class="swiper-button-next custom-nav text-primary"></div>
  </div>

  <!-- ✅ Pagination -->
  <div class="mb-16 swiper-pagination"></div>
</section><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/home/testimonials.blade.php ENDPATH**/ ?>