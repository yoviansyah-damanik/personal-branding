<header class="header sticky-active">
    <div class="container-fluid">
        <nav class="nav">
            <a href="{{ route('homepage') }}" class="nav__logo">SUBARJA<span>.com</span></a>
            <div class="nav__items">
                <button class="close"><i class="fa-solid fa-xmark"></i></button>
                <ul>
                    <li><a href="{{ route('homepage') }}"
                            class="nav__item {{ Request::routeIs('homepage*') ? 'active' : '' }}">{{ __('Home') }}</a>
                    </li>
                    <li><a href="{{ route('about') }}"
                            class="nav__item {{ Request::routeIs('about*') ? 'active' : '' }}">{{ __('Biography') }}</a>
                    </li>
                    <li><a href="{{ route('company') }}"
                            class="nav__item {{ Request::routeIs('company*') ? 'active' : '' }}">{{ __('Companies') }}</a>
                    </li>
                    <li><a href="{{ route('experience') }}"
                            class="nav__item {{ Request::routeIs('experience*') ? 'active' : '' }}">{{ __('Experiences') }}</a>
                    </li>
                    </li>
                    <li><a href="{{ route('organization') }}"
                            class="nav__item {{ Request::routeIs('organization*') ? 'active' : '' }}">{{ __('Organizations') }}</a>
                    </li>
                    <li><a href="{{ route('social') }}"
                            class="nav__item {{ Request::routeIs('social*') ? 'active' : '' }}">{{ __('Socials') }}</a>
                    </li>
                    <li><a href="{{ route('blog') }}"
                            class="nav__item {{ Request::routeIs('blog*') ? 'active' : '' }}">{{ __('Blogs') }}</a>
                    </li>
                    <li><a href="{{ route('contact') }}"
                            class="nav__item {{ Request::routeIs('contact*') ? 'active' : '' }}">{{ __('Contact') }}</a>
                    </li>
                </ul>
                {{-- <div class="social">
                    <a href="#">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="mailto:someone@example.com">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div> --}}
            </div>
            <div class="nav__uncollapsed">
                {{-- <div class="social">
                    <a href="#">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="mailto:someone@example.com">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div> --}}
                <button class="nav__bar d-block d-xxl-none">
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
            </div>
        </nav>
    </div>
</header>
<div class="backdrop"></div>
