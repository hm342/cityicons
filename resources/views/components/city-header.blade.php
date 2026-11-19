@props([
  'city' => null,
  'active' => ''
])

@php
  $cSlug = $city ? (is_object($city) ? $city->slug : $city) : 'bhavnagar';
  $cName = $city ? (is_object($city) ? $city->name : ucfirst($cSlug)) : 'Bhavnagar';
@endphp

<header class="rm-subpage-header" id="rm-subpage-header">
  <div class="rm-container">
    <div class="rm-header-row">
      <!-- Left: Drawer Menu -->
      <div class="rm-header-left">
        <button class="rm-menu-btn" id="btn-open-drawer" aria-label="Open Navigation Menu">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <!-- Center: City Brand Logo with Script Accent -->
      <a href="{{ url('/' . $cSlug) }}" class="rm-logo" aria-label="{{ $cName }} Icons">
        <span class="rm-logo-text">{{ strtolower($cName) }}</span>
        <span class="rm-logo-script">Icons</span>
      </a>

      <!-- Right: Nominate Pill & Search -->
      <div class="rm-header-right">
        <a href="{{ url('/' . $cSlug . '/nominate') }}" class="rm-header-btn-nominate">
          Nominate a Story
        </a>
        <button class="rm-menu-btn" id="btn-open-search" aria-label="Search">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>

    <!-- Submenu Bar under Logo -->
    <nav class="rm-subnav" aria-label="City Navigation">
      <ul class="rm-subnav-list">
        <li><a href="{{ url('/' . $cSlug) }}" class="{{ $active === 'home' ? 'is-active' : '' }}">Home</a></li>
        <li><a href="{{ url('/' . $cSlug . '/icons') }}" class="{{ $active === 'icons' ? 'is-active' : '' }}">Icons</a></li>
        <li><a href="{{ url('/' . $cSlug . '/rising') }}" class="{{ $active === 'rising' ? 'is-active' : '' }}">Rising</a></li>
        <li><a href="{{ url('/' . $cSlug . '/stories') }}" class="{{ $active === 'stories' ? 'is-active' : '' }}">Stories</a></li>
        <li><a href="{{ url('/' . $cSlug . '/the-list') }}" class="{{ $active === 'the-list' ? 'is-active' : '' }}">The List</a></li>
        <li><a href="{{ url('/' . $cSlug . '/magazine') }}" class="{{ $active === 'magazine' ? 'is-active' : '' }}">Magazine</a></li>
        <li><a href="{{ url('/' . $cSlug . '/in-' . $cSlug) }}" class="{{ $active === 'in-city' ? 'is-active' : '' }}">In {{ $cName }}</a></li>
        <li><a href="{{ url('/' . $cSlug . '/featured-brands') }}" class="{{ $active === 'brands' ? 'is-active' : '' }}">Brands</a></li>
        <li><a href="{{ url('/' . $cSlug . '/nominate') }}" class="{{ $active === 'nominate' ? 'is-active' : '' }}" style="color:var(--vogue-red); font-weight:800;">Nominate</a></li>
      </ul>
    </nav>
  </div>
</header>
