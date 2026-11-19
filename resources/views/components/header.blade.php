<!-- ══ 1. SITE MASTER HEADER ════════════════════════════════ -->
<!-- Left: Menu | Center: CITYICONS (Bhavnagar Icons) | Right: Nominate a Story & Search -->
<header class="site-master-header">
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
        <div class="cityicon-header-tagline">
          Bhavnagar Icons <span style="color:var(--vogue-red); margin:0 4px;">·</span> Flagship Edition
        </div>
      </div>

      <!-- Right: Nominate a Story (Official PDF Spec) & Search -->
      <div class="header-right">
        <a href="{{ url('/nominate') }}" class="btn-header-subscribe" style="background:var(--vogue-red); color:#fff; border-color:var(--vogue-red); font-weight:800; letter-spacing:1.5px;">
          Nominate a Story
        </a>
        <button class="btn-header-search" id="btn-open-search" aria-label="Search">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </div>
</header>
