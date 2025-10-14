<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
@include('layouts.front.head')

<body class="min-h-screen font-sans text-darkText">

  @include('layouts.front.navbar')
  @yield('content')
  @include('layouts.front.footer')

  <!-- ✅ Back to Top Button -->
  <button
    id="back-to-top"
    class="fixed z-50 p-3 text-white transition-all duration-300 transform rounded-full shadow-lg opacity-0 pointer-events-none bottom-6 right-6 bg-primary hover:bg-primary hover:scale-110"
    aria-label="{{ __('buttons.back_to_top') }}">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
  </button>


  <!-- ✅ External Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ✅ Custom Scripts -->
  <script src="{{ asset('assets/js/index.js') }}?v={{ time() }}"></script>
  <script src="{{ asset('assets/js/script.js') }}?v={{ time() }}"></script>

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
      const readMoreText = @json(__('buttons.read_more'));
      const readLessText = @json(__('buttons.read_less'));

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

</html>