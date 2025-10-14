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
                <span class="hidden-xs">{{ strtoupper(session('admin_locale', app()->getLocale())) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-custom dropdown-options">
                <li class="dropdown-header text-center">{{ __('core.language') }}</li>
                @php($current = session('admin_locale', app()->getLocale()))
                @foreach(\Solutions\Language\Models\Language::where('status', 1)->orderBy('order')->get() as $lang)
                    <li class="{{ $current === $lang->code ? 'active' : '' }}">
                        <a href="{{ route('cp.lang.switch', $lang->code) }}">
                            {{ $lang->name ?? strtoupper($lang->code) }}
                            <small class="text-muted">{{ strtoupper($lang->code) }}</small>
                            @if($current === $lang->code)
                                <i class="fa fa-check pull-right"></i>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
    <!-- END Left Header Navigation -->
    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">
        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                    onerror="this.onerror=null;this.src='{{ asset('img/placeholders/avatars/avatar1.jpg') }}';">
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                <li>
                    <a href="{{ route('profile.edit') }}">
                        <i class="fa fa-user fa-fw pull-right"></i>
                        {{ __('userprofile::messages.profile') }}
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-ban fa-fw pull-right"></i> {{__('users::messages.logout')}}</a>
                </li>
            </ul>
        </li>
        <!-- END User Dropdown -->
    </ul>
    <!-- END Right Header Navigation -->
</header>