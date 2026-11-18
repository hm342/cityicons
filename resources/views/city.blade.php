@php
  $cityId = $city ?? 'bhavnagar';
  $cityName = ucfirst($cityId);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $cityName }} Moments — Visual Stories, Culture, Food, and Lifestyle in {{ $cityName }}.">
  <title>{{ $cityName }} Moments — CITYICON</title>
  <link rel="stylesheet" href="{{ asset('css/city.css') }}">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏙</text></svg>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body data-city="{{ $cityId }}">

  <!-- ══ OFFCANVAS SLIDEOUT DRAWER ════════════════════════════ -->
  <div class="rm-overlay" id="site-overlay"></div>
  <aside class="rm-offcanvas" id="offcanvas-drawer">
    <button class="rm-offcanvas-close" id="btn-close-offcanvas">&times;</button>
    <div class="rm-logo" style="margin-bottom:20px;">
      <span class="rm-logo-text">{{ strtolower($cityName) }}</span>
      <span class="rm-logo-script">Moments</span>
    </div>
    <div class="rm-offcanvas-title">Categories</div>
    <ul class="rm-offcanvas-menu">
      <li><a href="#sec-culture">Culture &amp; Heritage</a></li>
      <li><a href="#sec-food">Food &amp; Dining</a></li>
      <li><a href="#sec-fashion">Fashion &amp; Style</a></li>
      <li><a href="#sec-street">Street Moments</a></li>
      <li><a href="#sec-blog">Blog Stories</a></li>
      <li><a href="{{ url('/') }}">← All India Magazine</a></li>
    </ul>

    <div class="rm-offcanvas-title">City Editions</div>
    <div class="rm-city-grid">
      @foreach(['bhavnagar', 'mumbai', 'surat', 'ahmedabad', 'rajkot', 'vadodara', 'delhi', 'bengaluru', 'jaipur', 'kolkata'] as $c)
        <a href="{{ url('/cities/' . $c) }}" class="rm-city-link {{ $cityId === $c ? 'active' : '' }}">{{ ucfirst($c) }}</a>
      @endforeach
    </div>
  </aside>

  <!-- ══ HERO SECTION ══════════════════════════════════════════ -->
  <header class="rm-hero-wrap" id="hero-section">
    <!-- Top Floating Header -->
    <div class="rm-header-overlay">
      <div class="rm-header-row">
        <!-- Left: Hamburger -->
        <div class="rm-header-left">
          <button class="rm-menu-btn" id="btn-open-menu" aria-label="Open menu">
            <i class="fas fa-bars"></i>
          </button>
        </div>

        <!-- Center: Logo -->
        <a href="{{ url('/cities/' . $cityId) }}" class="rm-logo">
          <span class="rm-logo-text">{{ strtolower($cityName) }}</span>
          <span class="rm-logo-script">Moments</span>
        </a>

        <!-- Right: Search & All India link -->
        <div class="rm-header-right">
          <a href="{{ url('/') }}" style="font-size:0.75rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;">India</a>
          <button class="rm-menu-btn" id="btn-open-search" aria-label="Search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Submenu Bar under Logo -->
    <nav class="rm-subnav">
      <ul class="rm-subnav-list">
        <li><a href="#sec-culture">Culture</a></li>
        <li><a href="#sec-food">Food</a></li>
        <li><a href="#sec-fashion">Fashion</a></li>
        <li><a href="#sec-street">Street</a></li>
        <li><a href="#sec-blog">Blog</a></li>
        <li><a href="#" id="btn-cities-drawer">Cities ▾</a></li>
      </ul>
    </nav>

    <!-- Hero Slides Container -->
    <div id="hero-slides-wrap">
      <!-- Populated by city.js -->
    </div>

    <!-- Side Navigation Arrows -->
    <button class="rm-hero-arrow prev" id="hero-arrow-prev" aria-label="Previous slide">&#10094;</button>
    <button class="rm-hero-arrow next" id="hero-arrow-next" aria-label="Next slide">&#10095;</button>

    <!-- Slide Dots (Bottom Right) -->
    <div class="rm-hero-dots" id="hero-dots"></div>
  </header>

  <!-- ══ SECTION 1: TILES STYLE 1 ══════════════════════════════ -->
  <section id="sec-culture" class="section-head">
    <div class="section-head-title">— Culture &amp; Heritage —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-1" id="tiles-section-1"></div>
  </div>

  <!-- ══ SECTION 2: TILES STYLE 2 ══════════════════════════════ -->
  <section id="sec-food" class="section-head">
    <div class="section-head-title">— Culinary &amp; Taste —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-2" id="tiles-section-2"></div>
  </div>

  <!-- ══ SECTION 3: TILES STYLE 3 ══════════════════════════════ -->
  <section id="sec-fashion" class="section-head">
    <div class="section-head-title">— Fashion &amp; Craft —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-3-top" id="tiles-section-3-top"></div>
    <div class="rm-tiles-3-bottom" id="tiles-section-3-bottom"></div>
  </div>

  <!-- ══ SECTION 4: GRID STYLE ═════════════════════════════════ -->
  <section id="sec-street" class="section-head">
    <div class="section-head-title">— Street Moments —</div>
  </section>
  <div class="rm-container">
    <div class="rm-grid-cards" id="grid-section-4"></div>
  </div>

  <!-- ══ SECTION 5: BLOG STREAM ════════════════════════════════ -->
  <section id="sec-blog" class="section-head" style="padding-top:80px;">
    <div class="section-head-title" style="letter-spacing:5px;font-size:0.95rem;color:#ffffff;">BLOG</div>
  </section>
  <div class="rm-container-blog">
    <div class="rm-blog-stream" id="blog-stream"></div>
  </div>

  <!-- ══ FOOTER ═══════════════════════════════════════════════ -->
  <footer class="rm-footer">
    <div class="rm-container">
      <a href="{{ url('/cities/' . $cityId) }}" class="rm-footer-logo">
        <span class="rm-logo-text">{{ strtolower($cityName) }}</span>
        <span class="rm-logo-script">Moments</span>
      </a>
      <div class="rm-footer-nav">
        <a href="#hero-section">Home</a>
        <a href="#sec-culture">Culture</a>
        <a href="#sec-food">Food</a>
        <a href="#sec-fashion">Fashion</a>
        <a href="#sec-street">Street</a>
        <a href="#sec-blog">Blog</a>
        <a href="{{ url('/') }}">All India Edition</a>
      </div>
      <div class="rm-footer-copy">
        &copy; {{ date('Y') }} {{ $cityName }} Moments · CITYICON Magazine. Inspired by Authentic Real Moments.
      </div>
    </div>
  </footer>

  <!-- ══ SEARCH MODAL ═════════════════════════════════════════ -->
  <div class="rm-search-modal" id="search-modal">
    <div class="rm-search-wrap">
      <button class="rm-search-close" id="btn-close-search">&times;</button>
      <input type="text" class="rm-search-input" id="search-input" placeholder="Type and hit enter...">
      <div id="search-results" style="margin-top:20px;max-height:350px;overflow-y:auto;"></div>
    </div>
  </div>

  <script src="{{ asset('js/data.js') }}"></script>
  <script src="{{ asset('js/city.js') }}"></script>
</body>
</html>
