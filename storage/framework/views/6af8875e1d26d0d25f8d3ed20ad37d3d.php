<!-- Videos Section -->
<section class="relative py-20 bg-base overflow-hidden">
  <div class="absolute border border-primary rounded-full top-1/4 right-20 w-80 h-80 opacity-10"></div>
  <div class="absolute border border-primary rounded-full bottom-5 left-20 w-80 h-80 opacity-15"></div>
  <!-- Decorative Blobs -->
  <div class="absolute top-10 -left-20 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>

  <div class="container relative z-10 px-6 mx-auto max-w-7xl">
    <!-- Header -->
    <div class="mb-16 text-center">
      <h2 class="mb-6 text-4xl font-extrabold leading-tight text-primary md:text-5xl">
        <?php echo e(getLocalized(getSectionHeaders('video')['title'])); ?>

      </h2>
      <p class="max-w-2xl mx-auto text-lg text-gray-600">
        <?php echo e(getLocalized(getSectionHeaders('video')['description'])); ?>

      </p>
    </div>

    <!-- Videos Grid -->
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
      <!-- Video Card -->
      <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        // Extract YouTube video ID - Check embed_code first, then video_url
        $videoId = null;
        $urlToCheck = $record->embed_code ?? $record->video_url;
        
        if ($urlToCheck && $urlToCheck != '#') {
          preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $urlToCheck, $match);
          $videoId = $match[1] ?? null;
        }
        
        // Determine cover image source
        $coverImage = null;
        if ($record->image) {
          $coverImage = asset('storage/' . $record->image);
        } elseif ($videoId) {
          $coverImage = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
        }
      ?>

      <?php if($videoId): ?>
      <div class="group relative rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 bg-white border border-secondary">
        <div class="relative aspect-video bg-gray-900">
          <!-- Cover Image -->
          <img 
            src="<?php echo e($coverImage); ?>" 
            alt="<?php echo e(getLocalized($record->title)); ?>"
            class="video-cover-<?php echo e($key); ?> w-full h-full object-cover cursor-pointer transition-opacity duration-300"
            onerror="this.src='https://img.youtube.com/vi/<?php echo e($videoId); ?>/hqdefault.jpg'"
            onclick="playVideo<?php echo e($key); ?>()"
          >
          
          <!-- Play Button Overlay -->
          <div class="video-play-btn-<?php echo e($key); ?> absolute inset-0 flex items-center justify-center bg-black/30 cursor-pointer transition-all duration-300 group-hover:bg-black/40"
            onclick="playVideo<?php echo e($key); ?>()">
            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 shadow-2xl">
              <svg class="w-10 h-10 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
              </svg>
            </div>
          </div>
          
          <!-- YouTube Iframe (hidden by default) -->
          <iframe 
            id="video-iframe-<?php echo e($key); ?>"
            class="hidden w-full h-full" 
            data-src="https://www.youtube.com/embed/<?php echo e($videoId); ?>?autoplay=1&rel=0"
            title="<?php echo e(getLocalized($record->title)); ?>" 
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
        
        <!-- Content -->
        <div class="transition-all p-6">
          <h3 class="mb-2 text-lg font-bold text-primary"><?php echo e(getLocalized($record->title)); ?></h3>
          <p class="text-sm text-gray-600"><?php echo e(getLocalized($record->description)); ?></p>
        </div>
      </div>

      <script>
        function playVideo<?php echo e($key); ?>() {
          const cover = document.querySelector('.video-cover-<?php echo e($key); ?>');
          const playBtn = document.querySelector('.video-play-btn-<?php echo e($key); ?>');
          const iframe = document.getElementById('video-iframe-<?php echo e($key); ?>');
          
          if(cover) cover.classList.add('hidden');
          if(playBtn) playBtn.classList.add('hidden');
          if(iframe) {
            iframe.classList.remove('hidden');
            iframe.src = iframe.dataset.src;
          }
        }
      </script>
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- CTA Button -->
    <div class="mt-16 text-center">
      <a href="<?php echo e(route( (session('front_locale') ?? app()->getLocale()) . '.' . 'appointment' )); ?>"
        class="px-8 py-4 font-semibold text-white transition-all duration-300 rounded-full shadow-lg bg-gradient-to-r from-primary to-primary/90 hover:from-primary/90 hover:to-primary">
        <?php echo e(__('buttons.book your consultation')); ?>

      </a>
    </div>
  </div>
</section><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/home/video.blade.php ENDPATH**/ ?>