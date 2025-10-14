<?php
$curentLanguage = clanguage();
$activeLocale = activeLangauge(); // بيرجع 'ar' أو 'en'
$toggleTo = $activeLocale === 'ar' ? 'en' : 'ar'; // اللغة اللي هنحوّل ليها
$toggleText = $activeLocale === 'ar' ? 'EN' : 'AR'; // النص الظاهر على الزر
?>

<!-- Transparent Header - Fully Responsive -->
<header
  class="relative top-0 z-50 w-full bg-transparent border-b border-white/10">
  <nav
    class="flex items-center justify-between p-4 sm:px-10 lg:px-20 xl:px-40 lg:gap-10 sm:py-6 md:py-8 lg:py-10">
    <!-- Logo - Responsive Sizing -->
    <a href="<?php echo e(route((session('front_locale') ?? app()->getLocale()).'.home')); ?>"
      class="text-base font-extrabold transition-transform duration-300 md:text-lg lg:text-xl xl:text-xl 2xl:text-3xl">
      <span class="text-primary">Dr. Mai</span>
      <span class="text-primary">El-Hakim</span>
    </a>

    <!-- Desktop Menu - Hidden on mobile/tablet -->
    <ul class="items-center hidden gap-4 lg:flex xl:gap-6">
      <?php $__currentLoopData = getNavbar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li>
        <a
          href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . $record->slug )); ?>"
          class="px-3 py-2 text-sm font-medium text-white transition-all duration-300 transform menu-link active xl:px-4 xl:py-2 xl:!text-primary hover:bg-white/10 hover:text-white hover:-translate-y-1">
          <?php echo e($record->title[$activeLocale] ?? ''); ?>

        </a>
      </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <!-- Desktop Language Button and CTA -->
    <div class="items-center hidden gap-4 lg:flex">
      <a href="<?php echo e(route('language.switch', $toggleTo)); ?>"
        class="flex items-center gap-2 text-sm font-medium text-primary cursor-pointer md:text-lg">
        AR
        <img src="https://flagcdn.com/sa.svg" alt="Arabic" class="object-cover w-5 h-3 sm:w-6 sm:h-4" />
      </a>

      <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'appointment' )); ?>"
        class="px-4 py-2 text-base font-semibold text-white transition-colors duration-300 bg-primary rounded-full border border-gray-300 lg:text-sm xl:px-6 xl:py-3 hover:bg-fff4eb hover:text-white"
        aria-label="Book Appointment">
        <span class="hidden xl:inline"> <?php echo e(__('buttons.book appointment')); ?></span>
        <span class="xl:hidden"><?php echo e(__('buttons.book appointment')); ?></span>
      </a>
    </div>

    <!-- Mobile Controls Container - Language Button + Hamburger -->
    <div class="flex items-center gap-2 lg:hidden">
      <!-- Mobile Language Button -->
      <button onclick="window.location.href='index-ar.html'"
        class="flex items-center gap-2 text-sm font-medium text-white cursor-pointer p-2 transition-all duration-300 rounded-full hover:bg-white/10 touch-manipulation">
        AR
        <img src="https://flagcdn.com/sa.svg" alt="Arabic" class="object-cover w-4 h-3" />
      </button>

      <!-- Mobile Hamburger Button -->
      <button id="mobile-menu-button"
        class="p-2 text-white transition-all duration-300 rounded-full hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/30 group touch-manipulation"
        aria-label="Toggle menu">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="w-5 h-5 transition-transform duration-300 sm:h-6 sm:w-6 group-hover:rotate-90" fill="none"
          viewBox="0 0 24 24" stroke="currentColor" id="menu-icon">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </nav>

  <!-- Mobile Menu Dropdown - Enhanced responsive design -->
  <div
    id="mobile-menu"
    class="hidden px-4 py-4 space-y-3 border-t lg:hidden bg-black/20 backdrop-blur-sm border-white/10 sm:px-6 sm:py-6 sm:space-y-4 animate-fade-in">
    <?php $__currentLoopData = getNavbar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a
      href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . $record->slug )); ?>"
      class="block px-3 py-2 text-base font-medium text-white transition-all duration-300 rounded-lg sm:py-3 sm:px-4 sm:text-lg hover:bg-white/10 hover:text-white sm:rounded-xl hover:scale-105 touch-manipulation">
      <?php echo e($record->title[$activeLocale] ?? ''); ?>

    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</header><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/layouts/front/navbar.blade.php ENDPATH**/ ?>