<header class="site-header" id="site-header" role="banner">
    <div class="container header-inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="logo" aria-label="Sahayog Foundation Home">
            <span class="logo-mark" aria-hidden="true">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="16" cy="16" r="15" stroke="currentColor" stroke-width="2"/>
                    <path d="M10 20 C10 14, 22 14, 22 20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <circle cx="16" cy="11" r="3" fill="currentColor"/>
                </svg>
            </span>
            <span class="logo-text">
                <span class="logo-name">Sahayog</span>
                <span class="logo-sub">Foundation</span>
            </span>
        </a>

        {{-- Desktop Navigation --}}
        <nav class="nav-desktop" role="navigation" aria-label="Main Navigation">
            <ul class="nav-list" role="list">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('programs') }}" class="nav-link {{ request()->routeIs('programs') ? 'active' : '' }}">Programs</a></li>
                <li><a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </nav>

        {{-- CTA + Mobile Toggle --}}
        <div class="header-actions">
            <a href="{{ route('donate') }}" class="btn btn-primary btn-sm">Donate Now</a>
            <button class="mobile-toggle" id="mobileToggle" aria-expanded="false" aria-controls="mobileMenu" aria-label="Toggle navigation">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>
        </div>

    </div>

    {{-- Mobile Menu --}}
    <div class="mobile-menu" id="mobileMenu" role="dialog" aria-label="Mobile Navigation" aria-hidden="true">
        <nav>
            <ul class="mobile-nav-list" role="list">
                <li><a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ route('programs') }}" class="mobile-nav-link {{ request()->routeIs('programs') ? 'active' : '' }}">Programs</a></li>
                <li><a href="{{ route('gallery') }}" class="mobile-nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                <li><a href="{{ route('donate') }}" class="mobile-nav-link mobile-nav-cta">Donate Now</a></li>
            </ul>
        </nav>
    </div>
</header>
