<!DOCTYPE html>
<!--[if IE 9]><html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e($dir ?? 'ltr'); ?>"> <!--<![endif]-->
    <?php echo $__env->make('core::layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>
    <div id="page-wrapper">
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>corpintech</strong></h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie10"></div>
            </div>
        </div>

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

            <!-- Main Sidebar -->
            <?php echo $__env->make('core::layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">


                <!-- END Header -->
                <?php echo $__env->make('core::layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- Page content -->
                <div id="page-content">
                    <!-- Dashboard Header -->
                    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- END Page Content -->

                <!-- Footer -->

                <!-- END Footer -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->

    <?php echo $__env->make('core::layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Core\src\Providers/../Resources/views/layouts/backend.blade.php ENDPATH**/ ?>