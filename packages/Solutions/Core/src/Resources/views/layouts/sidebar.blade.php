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
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                            onerror="this.onerror=null;this.src='{{ asset('img/placeholders/avatars/avatar1.jpg') }}';">
                    </a>
                </div>
                <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="sidebar-user-links">
                    <a href="{{ route('profile.edit') }}" data-toggle="tooltip" data-placement="bottom"
                        title="{{ __('userprofile::messages.profile') }}"><i class="gi gi-user"></i></a>
                    <a href="{{ route('profile.edit') }}" data-toggle="tooltip" data-placement="bottom"
                        title="Messages"><i class="gi gi-envelope"></i></a>
                    <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings"
                        onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        data-toggle="tooltip" data-placement="bottom" title="{{ __('users::messages.logout') }}">
                        <i class="gi gi-exit"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @php
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
            @endphp

            <ul class="sidebar-nav">
                @foreach ($groups as $group)
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="{{ $group['label'] }}"
                            data-original-title="Quick Settings">
                            <i class="{{ $group['icon'] }}"></i>
                        </a>
                    </span>
                    <span class="sidebar-header-title">{{ $group['label'] }}</span>
                </li>
                @foreach ($group['items'] as $menu)
                @php
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
                @endphp

                <li class="{{ $isActive ? 'active' : '' }}">
                    @if ($hasChildren)
                    <a href="#" class="sidebar-nav-menu {{ $isActive ? '' : 'collapsed' }}">
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        @if (!empty($menu['icon']))
                            <i class="{{ $menu['icon'] }} sidebar-nav-icon"></i>
                        @endif
                        <span class="sidebar-nav-mini-hide">{{ $menu['title'] }}</span>
                    </a>
                    <ul {!! $isActive ? '' : 'style="display:none"' !!}>
                        @foreach ($menu['children'] as $child)
                        @php($childRoute = $child['route'] ?? null)
                                @continue(!$childRoute || !Route::has($childRoute))
                                <li>
                                    <a  class="{{ Str::startsWith($current, $childRoute) ? 'active' : '' }}" href="{{ route($childRoute) }}">{{ $child['title'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        @elseif ($menuRoute && Route::has($menuRoute))
                            <a href="{{ route($menuRoute) }}">
                                @if (!empty($menu['icon']))
                                    <i class="{{ $menu['icon'] }} sidebar-nav-icon"></i>
                                @endif
                                <span class="sidebar-nav-mini-hide">{{ $menu['title'] }}</span>
                            </a>
                    @endif
                </li>
                @endforeach
                @endforeach
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">{{ __('users::messages.logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>