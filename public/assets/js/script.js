tailwind.config = {
  theme: {
    extend: {
      colors: {
        primary: "#663130",
        secondary: "#f0eeeb",
        ternary: "#d2cac8",
        base: "#fffdf9",
        dark: "#1e0909",
      },
    },
  },
}

// Global Helpers
const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];

// ===============================================
// SINGLE DOMContentLoaded Listener
// ===============================================
document.addEventListener('DOMContentLoaded', () => {

  // Initialize WOW.js if available
  if (typeof WOW !== 'undefined') {
    new WOW().init();
  }

  // Initialize all functions in order
  initHeaderScroll();
  initMobileMenu();
  initSmoothScroll();
  initBeforeAfterSliders();
  initTestimonials();
  initFormValidation();
  initAnimations();
  initBackToTop();
  initMenuActiveState();
  initHomeServicesSwiper();

  // Load event
  window.addEventListener('load', () => document.body.classList.add('loaded'));
});

// ===============================================
// 1. Header Scroll Functionality
// ===============================================
function initHeaderScroll() {
  const header = $('#header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 50);
    });
  }
}

// ===============================================
// 2. Mobile Menu Functionality - وظائف القائمة المحمولة
// ===============================================
function initMobileMenu() {
  // Try both mobile menu implementations
  const mobileMenuBtn = $('#mobileMenuBtn');
  const nav = $('.nav');
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");

  // Simple toggle implementation
  if (mobileMenuBtn && nav) {
    mobileMenuBtn.addEventListener('click', () => {
      nav.classList.toggle('active');
    });
  }

  // Advanced toggle implementation
  if (mobileMenuButton && mobileMenu) {
    const menuIcon = document.getElementById("menu-icon");

    function toggleMobileMenu() {
      const isMenuVisible = !mobileMenu.classList.contains("hidden");
      isMenuVisible ? closeMobileMenu() : openMobileMenu();
    }

    function openMobileMenu() {
      mobileMenu.classList.remove("hidden");
      if (menuIcon) {
        menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />`;
      }
    }

    function closeMobileMenu() {
      mobileMenu.classList.add("hidden");
      if (menuIcon) {
        menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />`;
      }
    }

    mobileMenuButton.addEventListener("click", toggleMobileMenu);

    // Close menu when clicking outside
    document.addEventListener("click", function (e) {
      const isClickOutside = !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target);
      if (isClickOutside && !mobileMenu.classList.contains("hidden")) {
        closeMobileMenu();
      }
    });

    // Close menu when clicking links
    const mobileLinks = mobileMenu.querySelectorAll("a");
    mobileLinks.forEach((link) => {
      link.addEventListener("click", closeMobileMenu);
    });
  }
}

// ===============================================
// 3. Smooth Scroll Functionality
// ===============================================
function initSmoothScroll() {
  $$('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const href = a.getAttribute('href');
      const target = href && href !== '#' ? $(href) : null;
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Close mobile menus after click
        closeAllMobileMenus();
      }
    });
  });
}

function closeAllMobileMenus() {
  // Close simple nav
  const nav = $('.nav');
  if (nav && nav.classList.contains('active')) {
    nav.classList.remove('active');
  }

  // Close advanced mobile menu
  const mobileMenu = document.getElementById("mobile-menu");
  if (mobileMenu && !mobileMenu.classList.contains("hidden")) {
    mobileMenu.classList.add("hidden");
    const menuIcon = document.getElementById("menu-icon");
    if (menuIcon) {
      menuIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />`;
    }
  }
}

// ===============================================
// 4. Before/After Slider - سلايدر قبل/بعد
// ===============================================
function initBeforeAfterSliders() {
  // Use the robust implementation for multiple sliders
  const sliders = document.querySelectorAll(".before-after-container");

  sliders.forEach((container, index) => {
    const afterImage = container.querySelector(".after-image");
    const sliderLine = container.querySelector(".slider-line");
    const handle = container.querySelector(".slider-handle");

    if (!afterImage || !sliderLine || !handle) {
      // console.warn(`⚠️ عناصر السلايدر ${index + 1} غير مكتملة`);
      return;
    }

    let isDragging = false;

    const updateSlider = (clientX) => {
      const rect = container.getBoundingClientRect();
      let x = clientX - rect.left;
      x = Math.max(0, Math.min(x, rect.width));
      const percentage = (x / rect.width) * 100;

      afterImage.style.clipPath = `inset(0 0 0 ${percentage}%)`;
      sliderLine.style.left = `${percentage}%`;
      handle.style.left = `${percentage}%`;
    };

    // Mouse events
    container.addEventListener('mousedown', (e) => {
      isDragging = true;
      updateSlider(e.clientX);
      e.preventDefault();
    });

    document.addEventListener('mousemove', (e) => {
      if (isDragging) updateSlider(e.clientX);
    });

    document.addEventListener('mouseup', () => {
      isDragging = false;
    });

    // Touch events
    container.addEventListener('touchstart', (e) => {
      isDragging = true;
      updateSlider(e.touches[0].clientX);
      e.preventDefault();
    }, { passive: false });

    document.addEventListener('touchmove', (e) => {
      if (isDragging) {
        updateSlider(e.touches[0].clientX);
        e.preventDefault();
      }
    }, { passive: false });

    document.addEventListener('touchend', () => {
      isDragging = false;
    });

    // Click to set position
    container.addEventListener('click', (e) => {
      updateSlider(e.clientX);
    });

  });
}

// ===============================================
// 5. Testimonials - Smart Implementation
// ===============================================
function initTestimonials() {
  const testimonialsSwiper = document.querySelector(".testimonials-swiper");
  const simpleTestimonials = $$('.testimonial-item');

  // Priority: Use Swiper if available
  if (testimonialsSwiper && typeof Swiper !== "undefined") {
    initSwiperTestimonials();
  }
  // Fallback: Use simple slider if elements exist
  else if (simpleTestimonials.length > 0) {
    initSimpleTestimonials();
  }
}

function initSwiperTestimonials() {
  try {
    new Swiper(".testimonials-swiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
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
        640: { slidesPerView: 1, spaceBetween: 20 },
        768: { slidesPerView: 2, spaceBetween: 30 },
        1024: { slidesPerView: 3, spaceBetween: 30 },
      },
      effect: "slide",
      speed: 600,
      touchRatio: 1,
      grabCursor: true,
    });
  } catch (error) {
    // console.error("❌ خطأ في سلايدر الشهادات:", error);
  }
}

function initSimpleTestimonials() {
  const testimonials = $$('.testimonial-item');
  const prevBtn = $('#prevBtn');
  const nextBtn = $('#nextBtn');
  let currentTestimonial = 0;

  const showTestimonial = idx => {
    testimonials.forEach((t, i) => {
      t.style.display = i === idx ? 'block' : 'none';
    });
  };

  if (testimonials.length) {
    showTestimonial(0);

    if (prevBtn) prevBtn.addEventListener('click', () => {
      currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
      showTestimonial(currentTestimonial);
    });

    if (nextBtn) nextBtn.addEventListener('click', () => {
      currentTestimonial = (currentTestimonial + 1) % testimonials.length;
      showTestimonial(currentTestimonial);
    });

    // Auto-advance
    setInterval(() => {
      currentTestimonial = (currentTestimonial + 1) % testimonials.length;
      showTestimonial(currentTestimonial);
    }, 5000);

  }
}

// ===============================================
// 6. Form Validation
// ===============================================
function initFormValidation() {
  const appointmentForm = $('#appointmentForm');
  if (appointmentForm) {
    appointmentForm.addEventListener('submit', e => {
      e.preventDefault();
      const data = Object.fromEntries(new FormData(appointmentForm));

      // Required fields
      const required = ['name', 'phone', 'service', 'date', 'time'];
      if (required.some(k => !data[k])) {
        alert('يرجى ملء جميع الحقول المطلوبة');
        return;
      }

      // KSA phone validation
      const phoneRegex = /^05\d{8}$/;
      if (!phoneRegex.test(data.phone)) {
        alert('يرجى إدخال رقم هاتف صحيح (05xxxxxxxx)');
        return;
      }

      // Date in future
      const selectedDate = new Date(data.date);
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      if (selectedDate < today) {
        alert('يرجى اختيار تاريخ في المستقبل');
        return;
      }

      alert('تم إرسال طلب الموعد بنجاح! سنتواصل معك خلال 24 ساعة.');
      appointmentForm.reset();
    });

    // Set min date to tomorrow
    const dateInput = appointmentForm.querySelector('input[name="date"]');
    if (dateInput) {
      const t = new Date();
      t.setDate(t.getDate() + 1);
      dateInput.min = t.toISOString().split('T')[0];
    }
  }
}

// ===============================================
// 7. Animations
// ===============================================
function initAnimations() {
  // Element reveal on scroll
  const revealEls = $$('.achievement, .service-item, .testimonial-item, .contact-item');
  if (revealEls.length && 'IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    revealEls.forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(el);
    });
  }

  // Counter animations
  if ('IntersectionObserver' in window) {
    const animateCounter = (el, target) => {
      let current = 0;
      const increment = Math.max(1, target / 100);
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
        const suffix = target > 100 ? '+' : (target === 98 ? '%' : '+');
        el.textContent = `${Math.floor(current)}${suffix}`;
      }, 20);
    };

    const counterObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const numberElement = entry.target.querySelector('.number');
          if (numberElement) {
            const n = parseInt(numberElement.textContent.replace(/\D/g, ''), 10) || 0;
            animateCounter(numberElement, n);
          }
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    $$('.achievement').forEach(a => counterObserver.observe(a));
  }

  // Section reveal
  const sections = $$('section');
  if (sections.length && 'IntersectionObserver' in window) {
    const sectionObserver = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('animate-in');
      });
    }, { threshold: 0.1 });
    sections.forEach(s => sectionObserver.observe(s));
  }

  // Inject minimal CSS
  if (!$('#inline-anim-css')) {
    const style = document.createElement('style');
    style.id = 'inline-anim-css';
    style.textContent = `
      .loaded { opacity: 1; }
      section { opacity: 0; transform: translateY(30px); transition: opacity .8s ease, transform .8s ease; }
      section.animate-in { opacity: 1; transform: translateY(0); }
      @media (max-width: 768px) {
        .nav.active {
          display: flex; flex-direction: column; position: absolute; top: 100%; left: 0; right: 0;
          background: var(--white, #fff); padding: 1rem; box-shadow: var(--shadow, 0 10px 20px rgba(0,0,0,.08));
          border-radius: 0 0 10px 10px;
        }
        .nav.active a { color: var(--primary, #333); padding: 0.5rem 1rem; width: 100%; text-align: center; border-bottom: 1px solid #eee; margin-left: 0 !important; margin-right: 0 !important; }
        .nav.active a:last-child { border-bottom: none; }
      }
    `;
    document.head.appendChild(style);
  }
}

// ===============================================
// 8. Back to Top Button
// ===============================================
function initBackToTop() {
  const backToTopButton = document.getElementById("back-to-top");
  if (!backToTopButton) return;

  function handleScroll() {
    const showThreshold = 300;
    if (window.scrollY > showThreshold) {
      backToTopButton.classList.remove("opacity-0", "pointer-events-none");
      backToTopButton.classList.add("opacity-100");
    } else {
      backToTopButton.classList.remove("opacity-100");
      backToTopButton.classList.add("opacity-0", "pointer-events-none");
    }
  }

  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  window.addEventListener("scroll", handleScroll);
  backToTopButton.addEventListener("click", scrollToTop);
}

// ===============================================
// 9. Menu Active State
// ===============================================
function initMenuActiveState() {
  const menuLinks = document.querySelectorAll(".menu-link");
  if (menuLinks.length === 0) return;

  function setActiveLink(clickedLink) {
    menuLinks.forEach(link => link.classList.remove("active"));
    clickedLink.classList.add("active");
  }

  menuLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      setActiveLink(this);
    });
  });
}

// ===============================================
// 10. Home Services Swiper
// ===============================================
function initHomeServicesSwiper() {
  if (typeof Swiper === 'undefined') {
    // console.error('❌ Swiper library not loaded');
    return;
  }

  const swiperEl = document.querySelector('.home-services-swiper');
  if (!swiperEl) return;

  try {
    const isRTL = document.documentElement.getAttribute('dir') === 'rtl';

    // Destroy existing instance
    if (swiperEl.swiper) {
      swiperEl.swiper.destroy(true, true);
    }

    new Swiper('.home-services-swiper', {
      direction: 'horizontal',
      loop: true,
      speed: 600,
      slidesPerView: 1,
      spaceBetween: 30,
      rtl: isRTL,
      grabCursor: true,
      observer: true,
      observeParents: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.home-services-pagination',
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: '.home-services-button-next',
        prevEl: '.home-services-button-prev',
      },
      breakpoints: {
        320: { slidesPerView: 1, spaceBetween: 20 },
        640: { slidesPerView: 1, spaceBetween: 20 },
        768: { slidesPerView: 2, spaceBetween: 25 },
        1024: { slidesPerView: 3, spaceBetween: 30 },
      }
    });

  } catch (error) {
    // console.error('❌ Home Services Swiper error:', error);
  }
}

// ===============================================
// Error Handling
// ===============================================
window.addEventListener("error", function (e) {
  // console.error("❌ خطأ في الجافا سكريبت:", e.error);
});

window.addEventListener("unhandledrejection", function (e) {
  // console.error("❌ خطأ في Promise غير معالج:", e.reason);
});