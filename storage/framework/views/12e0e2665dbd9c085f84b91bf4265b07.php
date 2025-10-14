<header class="navbar navbar-default">
    <!-- Left Header Navigation -->
    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                <i class="fa fa-bars fa-fw"></i>
            </a>
        </li>
        <!-- END Main Sidebar Toggle Button -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-globe"></i>
                <span class="hidden-xs"><?php echo e(strtoupper(session('admin_locale', app()->getLocale()))); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-custom dropdown-options">
                <li class="dropdown-header text-center"><?php echo e(__('core.language')); ?></li>
                <?php ($current = session('admin_locale', app()->getLocale())); ?>
                <?php $__currentLoopData = \Solutions\Language\Models\Language::where('status', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php echo e($current === $lang->code ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('cp.lang.switch', $lang->code)); ?>">
                            <?php echo e($lang->name ?? strtoupper($lang->code)); ?>

                            <small class="text-muted"><?php echo e(strtoupper($lang->code)); ?></small>
                            <?php if($current === $lang->code): ?>
                                <i class="fa fa-check pull-right"></i>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    </ul>
    <!-- END Left Header Navigation -->
    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">
        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" alt="<?php echo e(auth()->user()->name); ?>"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('img/placeholders/avatars/avatar1.jpg')); ?>';">
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                <li>
                    <a href="<?php echo e(route('profile.edit')); ?>">
                        <i class="fa fa-user fa-fw pull-right"></i>
                        <?php echo e(__('userprofile::messages.profile')); ?>

                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-ban fa-fw pull-right"></i> <?php echo e(__('users::messages.logout')); ?></a>
                </li>
            </ul>
        </li>
        <!-- END User Dropdown -->
    </ul>
    <!-- END Right Header Navigation -->
</header><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Core\src\Providers/../Resources/views/layouts/header.blade.php ENDPATH**/ ?>