<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.homepage') }}">{{ config('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.homepage') }}">{{ config('app.abb_name') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Dashboard') }}</li>
            {{-- BELOW IF ACTIVE --}}
            <li class="nav-item {{ Request::routeIs('dashboard.homepage') ? 'active' : '' }}">
                <a href="{{ route('dashboard.homepage') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Master Data') }}</li>
            <li
                class="nav-item dropdown {{ Request::routeIs('dashboard.blog*') || Request::routeIs('dashboard.tag*') || Request::routeIs('dashboard.category*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i>
                    <span>{{ __('Blogs') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('dashboard.blog*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.blog') }}">
                            </i>{{ __('Blogs') }}</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.tag*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.tag') }}">
                            </i>{{ __('Tags') }}</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.category*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.category') }}">
                            </i>{{ __('Categories') }}</a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item dropdown {{ Request::routeIs('dashboard.company*') || Request::routeIs('dashboard.project*') || Request::routeIs('dashboard.sector*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-building-user"></i>
                    <span>{{ __('Companies') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('dashboard.company*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.company') }}">
                            {{ __('Companies') }}</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.sector*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.sector') }}">
                            {{ __('Sectors') }}</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.project*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.project') }}">
                            {{ __('Projects') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Request::routeIs('dashboard.experience*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.experience') }}" class="nav-link">
                    <i class="fas fa-person-walking-luggage"></i><span>{{ __('Experiences') }}</span></a>
            </li>
            <li class="nav-item {{ Request::routeIs('dashboard.organization*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.organization') }}" class="nav-link">
                    <i class="fas fa-users-rays"></i><span>{{ __('Organizations') }}</span></a>
            </li>
            <li class="nav-item {{ Request::routeIs('dashboard.social*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.social') }}" class="nav-link">
                    <i class="fas fa-people-carry-box"></i><span>{{ __('Socials') }}</span></a>
            </li>
            {{-- CONTACT HEADER --}}
            <li class="menu-header">{{ __('Responses') }}</li>
            <li class="nav-item {{ Request::routeIs('dashboard.contact*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.contact') }}" class="nav-link">
                    <i class="fas fa-book"></i><span>{{ __('Contact') }}</span></a>
            </li>
            {{-- SETTINGS HEADER --}}
            <li class="menu-header">{{ __('Settings') }}</li>
            <li class="nav-item {{ Request::routeIs('dashboard.account') ? 'active' : '' }}">
                <a href="{{ route('dashboard.account') }}" class="nav-link"><i
                        class="fas fa-user"></i><span>{{ __('Account') }}</span></a>
            </li>
            <li class="nav-item {{ Request::routeIs('dashboard.general*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.general') }}" class="nav-link"><i
                        class="fas fa-wrench"></i><span>{{ __('General') }}</span></a>
            </li>
        </ul>
    </aside>
</div>
