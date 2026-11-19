@props(['city' => null])

@php
  $cSlug = $city ? (is_object($city) ? $city->slug : $city) : null;
  $cName = $city ? (is_object($city) ? $city->name : ucfirst($cSlug)) : null;
@endphp

<!-- ══ 1. SITE MASTER HEADER ════════════════════════════════ -->
<!-- Left: Menu | Center: CITYICONS (City Edition) | Right: Nominate a Story & Search -->
<header class="site-master-header {{ $cSlug ? 'site-master-header--subcity' : '' }}">
  <div class="vogue-container">
    <div class="header-main-grid">
      <!-- Left: Menu Toggle -->
      <div class="header-left">
        <button class="menu-toggle-btn" id="btn-open-drawer" aria-label="Open navigation menu">
          <div class="burger-icon">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <span>Menu</span>
        </button>
      </div>

      <!-- Center: Brand Logo & Edition -->
      <div class="header-center">
        <a href="{{ url('/') }}" class="cityicon-main-logo" aria-label="CityIcons Home">
          <img src="{{ asset('images/logo-cityicons.png') }}" alt="City Icons" class="cityicon-logo-img">
        </a>
        @if($cSlug)
          <a href="{{ url('/' . $cSlug) }}" class="cityicon-header-tagline" title="Enter {{ $cName }} Icons Subsite" style="text-decoration:none; transition:color 0.2s ease;">
            {{ $cName }} Icons <span style="color:var(--vogue-red); margin:0 4px;">·</span> {{ $cSlug === 'bhavnagar' ? 'Flagship Edition' : 'City Edition' }} <i class="fas fa-arrow-right" style="font-size:8px; margin-left:3px; opacity:0.7;"></i>
          </a>
        @else
          <a href="{{ url('/bhavnagar') }}" class="cityicon-header-tagline" title="Enter Bhavnagar Icons Subsite" style="text-decoration:none; transition:color 0.2s ease;">
            Bhavnagar Icons <span style="color:var(--vogue-red); margin:0 4px;">·</span> Flagship Edition <i class="fas fa-arrow-right" style="font-size:8px; margin-left:3px; opacity:0.7;"></i>
          </a>
        @endif
      </div>

      <!-- Right: Nominate a Story (Official PDF Spec) & Search -->
      <div class="header-right">
        <a href="{{ $cSlug ? url('/' . $cSlug . '/nominate') : url('/nominate') }}" class="btn-header-subscribe" style="background:var(--vogue-red); color:#fff; border-color:var(--vogue-red); font-weight:800; letter-spacing:1.5px;">
          Nominate a Story
        </a>
        <button class="btn-header-search" id="btn-open-search" aria-label="Search">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </div>
</header>
