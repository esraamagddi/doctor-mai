<section class="relative py-20 bg-secondary overflow-hidden">
     <div class="container relative z-10 px-6 mx-auto max-w-7xl">
         <!-- Header -->
         <div class="mb-16 text-center">
             <h2 class="mt-6 mb-4 text-4xl font-extrabold sm:text-5xl text-black ">
                 <?php echo e(getLocalized(getSectionHeaders('photos')['title'])); ?>

             </h2>
             <p class="max-w-2xl mx-auto text-base text-gray-600">
                 <?php echo e(getLocalized(getSectionHeaders('photos')['description'])); ?>

             </p>
         </div>

         <!-- Gallery Grid -->
         <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
             <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

             <!-- Card -->
             <div
                 class="relative group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                 <!-- ✅ FIXED: Changed from getLocalized() to asset() -->
                 <img src="<?php echo e(asset('storage/' . $record->image)); ?>" 
                      alt="<?php echo e(getLocalized($record->title) ?? 'Gallery Image ' . ($key + 1)); ?>"
                      class="object-cover w-full h-56 sm:h-72 duration-700 group-hover:scale-110" 
                      onerror="this.src='/assets/images/placeholder.jpg'" />
                 <div
                     class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                 </div>
                 <div
                     class="absolute bottom-4 left-4 right-4 transform translate-y-[200%] group-hover:translate-y-0 transition duration-500">
                     <h3 class="text-lg font-bold text-white"><?php echo e(getLocalized($record->title)); ?></h3>
                 </div>
             </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

         </div>
     </div>
 </section><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\resources\views/front/home/gallery.blade.php ENDPATH**/ ?>