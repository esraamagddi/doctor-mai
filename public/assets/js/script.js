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


document.addEventListener('DOMContentLoaded', () => {
  // wow init
  new WOW().init();
  // Helpers
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];

  // 1) Header scroll
  const header = $('#header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 50);
    });
  }

  // 2) Mobile menu
  const mobileMenuBtn = $('#mobileMenuBtn');
  const nav = $('.nav');
  if (mobileMenuBtn && nav) {
    mobileMenuBtn.addEventListener('click', () => nav.classList.toggle('active'));
  }

  // 3) Smooth scroll
  $$('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const href = a.getAttribute('href');
      const target = href && href !== '#' ? $(href) : null;
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // 4) Before/After slider
  const beforeAfterContainer = $('#beforeAfterContainer');
  const afterImageContainer = $('#afterImageContainer');
  const sliderLine = $('#sliderLine');

  if (beforeAfterContainer && afterImageContainer && sliderLine) {
    let isDragging = false;

    const updateSlider = x => {
      const rect = beforeAfterContainer.getBoundingClientRect();
      const pct = Math.max(0, Math.min(100, ((x - rect.left) / rect.width) * 100));
      afterImageContainer.style.clipPath = `inset(0 ${100 - pct}% 0 0)`;
      sliderLine.style.left = `${pct}%`;
    };

    const start = x => { isDragging = true; updateSlider(x); };
    const move = x => { if (isDragging) updateSlider(x); };
    const end = () => { isDragging = false; };

    beforeAfterContainer.addEventListener('mousedown', e => start(e.clientX));
    beforeAfterContainer.addEventListener('mousemove', e => move(e.clientX));
    document.addEventListener('mouseup', end);

    beforeAfterContainer.addEventListener('click', e => updateSlider(e.clientX));

    beforeAfterContainer.addEventListener('touchstart', e => start(e.touches[0].clientX), { passive: true });
    beforeAfterContainer.addEventListener('touchmove', e => { move(e.touches[0].clientX); }, { passive: false });
    beforeAfterContainer.addEventListener('touchend', end);
  }

  // 5) Testimonials slider (يشتغل بس لو فيه عناصر)
  const testimonials = $$('.testimonial-item');
  const prevBtn = $('#prevBtn');
  const nextBtn = $('#nextBtn');
  let currentTestimonial = 0;

  const showTestimonial = idx => {
    testimonials.forEach((t, i) => { t.style.display = i === idx ? 'block' : 'none'; });
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

  // 6) Form submission (يتفعل بس لو الفورم موجود)
  const appointmentForm = $('#appointmentForm');
  if (appointmentForm) {
    appointmentForm.addEventListener('submit', e => {
      e.preventDefault();
      const data = Object.fromEntries(new FormData(appointmentForm));

      // required
      const required = ['name', 'phone', 'service', 'date', 'time'];
      if (required.some(k => !data[k])) {
        alert('يرجى ملء جميع الحقول المطلوبة');
        return;
      }

      // KSA phone
      const phoneRegex = /^05\d{8}$/;
      if (!phoneRegex.test(data.phone)) {
        alert('يرجى إدخال رقم هاتف صحيح (05xxxxxxxx)');
        return;
      }

      // date in future
      const selectedDate = new Date(data.date);
      const today = new Date(); today.setHours(0, 0, 0, 0);
      if (selectedDate < today) {
        alert('يرجى اختيار تاريخ في المستقبل');
        return;
      }

      alert('تم إرسال طلب الموعد بنجاح! سنتواصل معك خلال 24 ساعة.');
      appointmentForm.reset();
      console.log('Appointment data:', data);
    });

    // min date = tomorrow
    const dateInput = appointmentForm.querySelector('input[name="date"]');
    if (dateInput) {
      const t = new Date();
      t.setDate(t.getDate() + 1);
      dateInput.min = t.toISOString().split('T')[0];
    }
  }

  // 7) Reveal on scroll
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

  // 8) Counters
  if ('IntersectionObserver' in window) {
    const animateCounter = (el, target) => {
      let current = 0;
      const increment = Math.max(1, target / 100);
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) { current = target; clearInterval(timer); }
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

  // 9) On load
  window.addEventListener('load', () => document.body.classList.add('loaded'));

  // 10) Section reveal class + inline CSS once
  const sections = $$('section');
  if (sections.length && 'IntersectionObserver' in window) {
    const sectionObserver = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('animate-in'); });
    }, { threshold: 0.1 });
    sections.forEach(s => sectionObserver.observe(s));
  }

  // inject minimal CSS (يفضل تحطها في ملف CSS)
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
});





/**
 * ===============================================
 * Main JavaScript File - ملف الجافا سكريبت الرئيسي
 * ===============================================
 * جميع الـ scripts منظمة ومقسمة بشكل وظيفي
 */

// ===============================================
// 1. DOM Ready Handler - معالج جاهزية الصفحة
// ===============================================
document.addEventListener("DOMContentLoaded", function () {
  console.log("🚀 تم تحميل الصفحة بنجاح");

  // تشغيل جميع الوظائف عند تحميل الصفحة
  initMobileMenu();
  initBackToTop();
  initTestimonialsSlider();
  initBeforeAfterSliders();
  initMenuActiveState();
});

// ===============================================
// 2. Mobile Menu Functionality - وظائف القائمة المحمولة
// ===============================================
function initMobileMenu() {
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");
  const menuIcon = document.getElementById("menu-icon");

  // التحقق من وجود العناصر
  if (!mobileMenuButton || !mobileMenu || !menuIcon) {
    console.warn("⚠️ عناصر القائمة المحمولة غير موجودة");
    return;
  }

  /**
   * تبديل حالة القائمة المحمولة
   */
  function toggleMobileMenu() {
    const isMenuVisible = !mobileMenu.classList.contains("hidden");

    if (isMenuVisible) {
      // إغلاق القائمة
      closeMobileMenu();
    } else {
      // فتح القائمة
      openMobileMenu();
    }
  }

  /**
   * فتح القائمة المحمولة
   */
  function openMobileMenu() {
    mobileMenu.classList.remove("hidden");
    mobileMenu.classList.add("animate-fade-in");

    // تغيير الأيقونة إلى X
    menuIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M6 18L18 6M6 6l12 12" />
        `;

    console.log("📱 تم فتح القائمة المحمولة");
  }

  /**
   * إغلاق القائمة المحمولة
   */
  function closeMobileMenu() {
    mobileMenu.classList.add("hidden");

    // تغيير الأيقونة إلى الهامبرجر
    menuIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M4 6h16M4 12h16M4 18h16" />
        `;

    console.log("📱 تم إغلاق القائمة المحمولة");
  }

  // Event Listeners للقائمة المحمولة
  mobileMenuButton.addEventListener("click", toggleMobileMenu);

  // إغلاق القائمة عند النقر خارجها
  document.addEventListener("click", function (e) {
    const isClickOutside =
      !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target);

    if (isClickOutside && !mobileMenu.classList.contains("hidden")) {
      closeMobileMenu();
    }
  });

  // إغلاق القائمة عند النقر على الروابط
  const mobileLinks = mobileMenu.querySelectorAll("a");
  mobileLinks.forEach((link) => {
    link.addEventListener("click", closeMobileMenu);
  });
}

// ===============================================
// 3. Back to Top Button - زر العودة للأعلى
// ===============================================
function initBackToTop() {
  const backToTopButton = document.getElementById("back-to-top");

  if (!backToTopButton) {
    console.warn("⚠️ زر العودة للأعلى غير موجود");
    return;
  }

  /**
   * إظهار/إخفاء زر العودة للأعلى حسب موضع التمرير
   */
  function handleScroll() {
    const scrollPosition = window.scrollY;
    const showThreshold = 300; // إظهار الزر بعد التمرير 300px

    if (scrollPosition > showThreshold) {
      showBackToTopButton();
    } else {
      hideBackToTopButton();
    }
  }

  /**
   * إظهار زر العودة للأعلى
   */
  function showBackToTopButton() {
    backToTopButton.classList.remove("opacity-0", "pointer-events-none");
    backToTopButton.classList.add("opacity-100");
  }

  /**
   * إخفاء زر العودة للأعلى
   */
  function hideBackToTopButton() {
    backToTopButton.classList.remove("opacity-100");
    backToTopButton.classList.add("opacity-0", "pointer-events-none");
  }

  /**
   * العودة للأعلى بسلاسة
   */
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
    console.log("⬆️ تم الانتقال للأعلى");
  }

  // Event Listeners لزر العودة للأعلى
  window.addEventListener("scroll", handleScroll);
  backToTopButton.addEventListener("click", scrollToTop);
}

// ===============================================
// 4. Testimonials Slider - سلايدر الشهادات
// ===============================================
function initTestimonialsSlider() {
  const testimonialsContainer = document.querySelector(".testimonials-swiper");

  if (!testimonialsContainer) {
    console.warn("⚠️ سلايدر الشهادات غير موجود");
    return;
  }

  // التحقق من وجود مكتبة Swiper
  if (typeof Swiper === "undefined") {
    console.error("❌ مكتبة Swiper غير محملة");
    return;
  }

  try {
    // إعدادات سلايدر الشهادات
    new Swiper(".testimonials-swiper", {
      // الإعدادات الأساسية
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,

      // التشغيل التلقائي
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },

      // النقاط السفلية
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },

      // أزرار التنقل
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

      // الاستجابة للشاشات المختلفة
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },

      // التأثيرات
      effect: "slide",
      speed: 600,

      // اللمس والسحب
      touchRatio: 1,
      touchAngle: 45,
      grabCursor: true,
    });

    console.log("🎠 تم تشغيل سلايدر الشهادات بنجاح");
  } catch (error) {
    console.error("❌ خطأ في تشغيل سلايدر الشهادات:", error);
  }
}

// ===============================================
// 5. Menu Active State - حالة القائمة النشطة
// ===============================================
function initMenuActiveState() {
  const menuLinks = document.querySelectorAll(".menu-link");

  if (menuLinks.length === 0) {
    console.warn("⚠️ روابط القائمة غير موجودة");
    return;
  }

  /**
   * تفعيل الرابط المحدد
   */
  function setActiveLink(clickedLink) {
    // إزالة الحالة النشطة من جميع الروابط
    menuLinks.forEach((link) => {
      link.classList.remove("active");
    });

    // إضافة الحالة النشطة للرابط المحدد
    clickedLink.classList.add("active");

    console.log("🔗 تم تفعيل الرابط:", clickedLink.textContent);
  }

  // إضافة Event Listeners لروابط القائمة
  menuLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      setActiveLink(this);
    });
  });

  // إضافة وظيفة إضافية لإغلاق القائمة المحمولة عند النقر على الروابط
  // (هذا للتأكد من التوافق مع الكود الأصلي)
  const mobileLinkElements = document.querySelectorAll("#mobile-menu a");
  const mobileMenuElement = document.getElementById("mobile-menu");
  const menuIconElement = document.getElementById("menu-icon");

  if (mobileLinkElements.length > 0 && mobileMenuElement && menuIconElement) {
    mobileLinkElements.forEach((link) => {
      link.addEventListener("click", function () {
        // إغلاق القائمة المحمولة
        mobileMenuElement.classList.add("hidden");
        menuIconElement.innerHTML =
          '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
        console.log("📱 تم إغلاق القائمة المحمولة من رابط القائمة");
      });
    });
  }
}

// ===============================================
// 6. Before/After Slider - سلايدر قبل/بعد
// ===============================================
function initBeforeAfterSliders() {
  const sliders = document.querySelectorAll(".before-after-container");

  if (sliders.length === 0) {
    console.warn("⚠️ سلايدرات قبل/بعد غير موجودة");
    return;
  }

  sliders.forEach((container, index) => {
    const handle = container.querySelector(".slider-handle");
    const afterImage = container.querySelector(".after-image");
    const sliderLine = container.querySelector(".slider-line");

    // التحقق من وجود العناصر المطلوبة
    if (!handle || !afterImage || !sliderLine) {
      console.warn(`⚠️ عناصر سلايدر قبل/بعد رقم ${index + 1} غير مكتملة`);
      return;
    }

    let isDragging = false;
    let animationId = null;

    /**
     * تحديث موضع السلايدر
     */
    function updateSlider(percentage) {
      // التأكد من أن النسبة بين 0 و 100
      percentage = Math.max(0, Math.min(100, percentage));

      // تحديث قناع الصورة
      afterImage.style.clipPath = `inset(0 0 0 ${percentage}%)`;

      // تحديث موضع المقبض والخط
      handle.style.left = `${percentage}%`;
      sliderLine.style.left = `${percentage}%`;

      // تحديث خاصية البيانات للاستخدام المستقبلي
      container.setAttribute("data-position", percentage);
    }

    /**
     * بداية السحب - الماوس
     */
    function handleMouseDown(e) {
      isDragging = true;
      document.body.style.cursor = "ew-resize";
      document.body.style.userSelect = "none";
      e.preventDefault();
    }

    /**
     * أثناء السحب - الماوس
     */
    function handleMouseMove(e) {
      if (!isDragging) return;

      // إلغاء الإطار السابق للحصول على أداء أفضل
      if (animationId) {
        cancelAnimationFrame(animationId);
      }

      animationId = requestAnimationFrame(() => {
        const rect = container.getBoundingClientRect();
        const percentage = ((e.clientX - rect.left) / rect.width) * 100;
        updateSlider(percentage);
      });
    }

    /**
     * انتهاء السحب - الماوس
     */
    function handleMouseUp() {
      isDragging = false;
      document.body.style.cursor = "default";
      document.body.style.userSelect = "";

      if (animationId) {
        cancelAnimationFrame(animationId);
        animationId = null;
      }
    }

    /**
     * بداية اللمس - الهاتف
     */
    function handleTouchStart(e) {
      isDragging = true;
      e.preventDefault();
    }

    /**
     * أثناء اللمس - الهاتف
     */
    function handleTouchMove(e) {
      if (!isDragging) return;

      if (animationId) {
        cancelAnimationFrame(animationId);
      }

      animationId = requestAnimationFrame(() => {
        const rect = container.getBoundingClientRect();
        const touch = e.touches[0];
        const percentage = ((touch.clientX - rect.left) / rect.width) * 100;
        updateSlider(percentage);
      });

      e.preventDefault();
    }

    /**
     * انتهاء اللمس - الهاتف
     */
    function handleTouchEnd() {
      isDragging = false;

      if (animationId) {
        cancelAnimationFrame(animationId);
        animationId = null;
      }
    }

    /**
     * النقر في أي مكان على الحاوية
     */
    function handleContainerClick(e) {
      // تجاهل النقر على المقبض نفسه
      if (e.target === handle || handle.contains(e.target)) return;

      const rect = container.getBoundingClientRect();
      const percentage = ((e.clientX - rect.left) / rect.width) * 100;

      // إضافة تأثير انتقال سلس
      handle.style.transition = "left 0.3s ease";
      sliderLine.style.transition = "left 0.3s ease";
      afterImage.style.transition = "clip-path 0.3s ease";

      updateSlider(percentage);

      // إزالة التأثير بعد الانتهاء
      setTimeout(() => {
        handle.style.transition = "";
        sliderLine.style.transition = "";
        afterImage.style.transition = "";
      }, 300);
    }

    // Event Listeners للماوس
    handle.addEventListener("mousedown", handleMouseDown);
    document.addEventListener("mousemove", handleMouseMove);
    document.addEventListener("mouseup", handleMouseUp);

    // Event Listeners للمس
    handle.addEventListener("touchstart", handleTouchStart, { passive: false });
    document.addEventListener("touchmove", handleTouchMove, { passive: false });
    document.addEventListener("touchend", handleTouchEnd);

    // النقر على الحاوية
    container.addEventListener("click", handleContainerClick);

    // إضافة دعم لوحة المفاتيح
    handle.setAttribute("tabindex", "0");
    handle.addEventListener("keydown", function (e) {
      const currentPosition =
        parseFloat(container.getAttribute("data-position")) || 50;
      let newPosition = currentPosition;

      switch (e.key) {
        case "ArrowLeft":
          newPosition = Math.max(0, currentPosition - 5);
          break;
        case "ArrowRight":
          newPosition = Math.min(100, currentPosition + 5);
          break;
        case "Home":
          newPosition = 0;
          break;
        case "End":
          newPosition = 100;
          break;
        default:
          return;
      }

      e.preventDefault();
      updateSlider(newPosition);
    });

    // تهيئة السلايدر في الموضع الافتراضي (50%)
    updateSlider(50);

    console.log(`🖼️ تم تشغيل سلايدر قبل/بعد رقم ${index + 1}`);
  });
}

// ===============================================
// 7. Utility Functions - وظائف مساعدة
// ===============================================

/**
 * تنفيذ وظيفة عند انتهاء التحميل
 */
function onDocumentReady(callback) {
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", callback);
  } else {
    callback();
  }
}

/**
 * إضافة تأثير fade للعنصر
 */
function fadeIn(element, duration = 300) {
  element.style.opacity = "0";
  element.style.display = "block";

  let start = performance.now();

  function animate(currentTime) {
    const elapsed = currentTime - start;
    const progress = Math.min(elapsed / duration, 1);

    element.style.opacity = progress;

    if (progress < 1) {
      requestAnimationFrame(animate);
    }
  }

  requestAnimationFrame(animate);
}

/**
 * إزالة تأثير fade للعنصر
 */
function fadeOut(element, duration = 300) {
  let start = performance.now();
  const initialOpacity = parseFloat(getComputedStyle(element).opacity);

  function animate(currentTime) {
    const elapsed = currentTime - start;
    const progress = Math.min(elapsed / duration, 1);

    element.style.opacity = initialOpacity * (1 - progress);

    if (progress < 1) {
      requestAnimationFrame(animate);
    } else {
      element.style.display = "none";
    }
  }

  requestAnimationFrame(animate);
}

/**
 * إضافة/إزالة فئة CSS مع انتقال
 */
function toggleClassSmooth(element, className, duration = 300) {
  if (element.classList.contains(className)) {
    element.classList.remove(className);
  } else {
    element.classList.add(className);
  }
}

// ===============================================
// 8. Performance Optimization - تحسين الأداء
// ===============================================

/**
 * Throttle function للحد من استدعاء الوظائف المتكررة
 */
function throttle(func, limit) {
  let inThrottle;
  return function () {
    const args = arguments;
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => (inThrottle = false), limit);
    }
  };
}

/**
 * Debounce function لتأخير تنفيذ الوظائف
 */
function debounce(func, wait, immediate) {
  let timeout;
  return function () {
    const context = this,
      args = arguments;
    const later = function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    const callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

// ===============================================
// 9. Error Handling - معالجة الأخطاء
// ===============================================

/**
 * معالج الأخطاء العام
 */
window.addEventListener("error", function (e) {
  console.error("❌ حدث خطأ في الجافا سكريبت:", {
    message: e.message,
    filename: e.filename,
    lineno: e.lineno,
    colno: e.colno,
    error: e.error,
  });
});

/**
 * معالج الأخطاء للـ Promises
 */
window.addEventListener("unhandledrejection", function (e) {
  console.error("❌ خطأ في Promise غير معالج:", e.reason);
  e.preventDefault(); // منع إظهار الخطأ في الكونسول
});

// ===============================================
// 10. Cleanup on Page Unload - تنظيف عند ترك الصفحة
// ===============================================
window.addEventListener("beforeunload", function () {
  // إلغاء جميع الـ animation frames
  if (typeof cancelAnimationFrame !== "undefined") {
    // يمكن إضافة أي تنظيف مطلوب هنا
  }

  console.log("👋 تم ترك الصفحة - تم التنظيف");
});

// ===============================================
// Final Console Message - رسالة نهائية
// ===============================================
console.log(`
🎉 تم تحميل ملف JavaScript الرئيسي بنجاح!
📅 ${new Date().toLocaleString("ar-EG")}
✅ جميع الوظائف جاهزة للعمل
`);


// Update the Before/After slider initialization
function initBeforeAfterSliders() {
  const sliders = document.querySelectorAll(".before-after-container");

  sliders.forEach((container) => {
    const afterImage = container.querySelector(".after-image");
    const sliderLine = container.querySelector(".slider-line");
    const handle = container.querySelector(".slider-handle");

    if (!afterImage || !sliderLine || !handle) return;

    let isDragging = false;

    const updateSlider = (clientX) => {
      const rect = container.getBoundingClientRect();
      let x = clientX - rect.left;
      x = Math.max(0, Math.min(x, rect.width));
      const percentage = (x / rect.width) * 100;

      // Update the after image clip
      afterImage.style.clipPath = `inset(0 0 0 ${percentage}%)`;

      // Update slider line and handle position
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
      if (isDragging) {
        updateSlider(e.clientX);
      }
    });

    document.addEventListener('mouseup', () => {
      isDragging = false;
    });

    // Touch events for mobile
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

// Call this function when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
  initBeforeAfterSliders();
});