<div id="sidebar">

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="/cp" class="sidebar-brand">
                <img src="/assets/backend/img/app-logo.svg" title="corpintech">
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="javascript:void(0)">
                        <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" alt="<?php echo e(auth()->user()->name); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e(asset('img/placeholders/avatars/avatar1.jpg')); ?>';">
                    </a>
                </div>
                <div class="sidebar-user-name"><?php echo e(auth()->user()->name); ?></div>
                <div class="sidebar-user-links">
                    <a href="<?php echo e(route('profile.edit')); ?>" data-toggle="tooltip" data-placement="bottom"
                        title="<?php echo e(__('userprofile::messages.profile')); ?>"><i class="gi gi-user"></i></a>
                    <a href="<?php echo e(route('profile.edit')); ?>" data-toggle="tooltip" data-placement="bottom"
                        title="Messages"><i class="gi gi-envelope"></i></a>
                    <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings"
                        onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        data-toggle="tooltip" data-placement="bottom" title="<?php echo e(__('users::messages.logout')); ?>">
                        <i class="gi gi-exit"></i>
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
            <?php
                use Illuminate\Support\Str;

                $menus = \Solutions\Core\Facades\SidebarCollector::get();

                $groupMeta = [
                    'core' => ['label' => __('core::messages.core'), 'order' => 3, 'icon' => 'gi gi-settings'],
                    'modules' => ['label' => __('core::messages.modules'), 'order' => 2, 'icon' => 'gi gi-refresh'],
                    'website' => ['label' => __('core::messages.website'), 'order' => 1, 'icon' => 'gi gi-lightbulb'],
                ];

                $menus = collect($menus)
                    ->map(function ($item) {
                        $item['group'] = $item['group'] ?? ($item['gruop'] ?? 'core');
                        if (!empty($item['children']) && is_array($item['children'])) {
                            $item['children'] = collect($item['children'])
                                ->sortBy(fn($c) => $c['order'] ?? 9999)
                                ->values()
                                ->all();
                        }
                        return $item;
                    })
                    ->sortBy(fn($m) => $m['order'] ?? 9999)
                    ->groupBy('group');

                $groups = collect($groupMeta)
                    ->sortBy('order')
                    ->map(function ($meta, $key) use ($menus) {
                        return [
                            'key' => $key,
                            'label' => $meta['label'],
                            'icon' => $meta['icon'],
                            'items' => $menus->get($key, collect())->values()->all(),
                        ];
                    })
                    ->merge(
                        $menus->keys()
                            ->reject(fn($k) => array_key_exists($k, $groupMeta))
                            ->mapWithKeys(fn($k) => [
                                $k => [
                                    'key' => $k,
                                    'label' => ucfirst($k),
                                    'items' => $menus->get($k)->values()->all()
                                ]
                            ])
                    )
                    ->values();

                $current = Route::currentRouteName();
            ?>

            <ul class="sidebar-nav">
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="<?php echo e($group['label']); ?>"
                            data-original-title="Quick Settings">
                            <i class="<?php echo e($group['icon']); ?>"></i>
                        </a>
                    </span>
                    <span class="sidebar-header-title"><?php echo e($group['label']); ?></span>
                </li>
                <?php $__currentLoopData = $group['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $hasChildren = !empty($menu['children']);
                    $menuRoute = $menu['route'] ?? null;

                    $menuActive = $menuRoute && Str::startsWith($current, $menuRoute);
                    $childActive = false;

                    if ($hasChildren) {
                        foreach ($menu['children'] as $c) {
                            if (!empty($c['route']) && Str::startsWith($current, $c['route'])) {
                                $childActive = true;
                                break;
                            }
                        }
                    }

                    $isActive = $menuActive || $childActive;
                ?>

                <li class="<?php echo e($isActive ? 'active' : ''); ?>">
                    <?php if($hasChildren): ?>
                    <a href="#" class="sidebar-nav-menu <?php echo e($isActive ? '' : 'collapsed'); ?>">
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <?php if(!empty($menu['icon'])): ?>
                            <i class="<?php echo e($menu['icon']); ?> sidebar-nav-icon"></i>
                        <?php endif; ?>
                        <span class="sidebar-nav-mini-hide"><?php echo e($menu['title']); ?></span>
                    </a>
                    <ul <?php echo $isActive ? '' : 'style="display:none"'; ?>>
                        <?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($childRoute = $child['route'] ?? null); ?>
                                <?php if(!$childRoute || !Route::has($childRoute)) continue; ?>
                                <li>
                                    <a  class="<?php echo e(Str::startsWith($current, $childRoute) ? 'active' : ''); ?>" href="<?php echo e(route($childRoute)); ?>"><?php echo e($child['title']); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php elseif($menuRoute && Route::has($menuRoute)): ?>
                            <a href="<?php echo e(route($menuRoute)); ?>">
                                <?php if(!empty($menu['icon'])): ?>
                                    <i class="<?php echo e($menu['icon']); ?> sidebar-nav-icon"></i>
                                <?php endif; ?>
                                <span class="sidebar-nav-mini-hide"><?php echo e($menu['title']); ?></span>
                            </a>
                    <?php endif; ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide"><?php echo e(__('users::messages.logout')); ?></span>
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Dr-Mai-El-Hakim\packages\Solutions\Core\src\Providers/../Resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>