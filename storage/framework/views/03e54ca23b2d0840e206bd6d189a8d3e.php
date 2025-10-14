<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">
<?php echo $__env->make('layouts.front.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body class="min-h-screen font-sans text-darkText">

  <?php echo $__env->make('layouts.front.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('content'); ?>
  <?php echo $__env->make('layouts.front.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- ✅ Back to Top Button -->
  <button
    id="back-to-top"
    class="fixed z-50 p-3 text-white transition-all duration-300 transform rounded-full shadow-lg opacity-0 pointer-events-none bottom-6 right-6 bg-primary hover:bg-primary hover:scale-110"
    aria-label="<?php echo e(__('buttons.back_to_top')); ?>">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
  </button>


  <!-- ✅ External Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ✅ Custom Scripts -->
  <script src="<?php echo e(asset('assets/js/index.js')); ?>?v=<?php echo e(time()); ?>"></script>
  <script src="<?php echo e(asset('assets/js/script.js')); ?>?v=<?php echo e(time()); ?>"></script>

  <!-- ✅ Swiper + Read More Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      // ✅ Swiper Initialization
      try {
        new Swiper(".testimonials-swiper", {
          slidesPerView: 1,
          spaceBetween: 30,
          loop: true,
          rtl: document.documentElement.dir === "rtl", // auto detect RTL/LTR
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          breakpoints: {
            640: {
              slidesPerView: 1
            },
            768: {
              slidesPerView: 2
            },
            1024: {
              slidesPerView: 3
            },
          },
          speed: 600,
          touchRatio: 1,
          grabCursor: true,
        });
        console.log("🎠 Testimonials slider initialized successfully");
      } catch (error) {
        console.error("❌ Swiper initialization error:", error);
      }

      // ✅ Read More / Read Less Logic
      const buttons = document.querySelectorAll('.read-more-btn');
      const readMoreText = <?php echo json_encode(__('buttons.read_more'), 15, 512) ?>;
      const readLessText = <?php echo json_encode(__('buttons.read_less'), 15, 512) ?>;

      buttons.forEach(button => {
        const text = button.previousElementSibling;
        const originalHeight = text.scrollHeight;

        // Hide button if text is shorter than threshold
        if (originalHeight <= 70) {
          button.textContent = ' ';
          return;
        }

        button.addEventListener('click', () => {
          if (text.classList.contains('h-[70px]')) {
            text.classList.remove('h-[70px]');
            text.classList.add('h-fit');
            button.textContent = readLessText;
          } else {
            text.classList.remove('h-fit');
            text.classList.add('h-[70px]');
            button.textContent = readMoreText;
          }
        });
      });
    });
  </script>
</body>

</html><?php /**PATH D:\Work\corpintech\doctor-mai\resources\views/layouts/front/app.blade.php ENDPATH**/ ?>