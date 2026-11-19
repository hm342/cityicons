@php
  $cityId = is_object($city) ? $city->slug : ($city ?? 'bhavnagar');
  $cityName = is_object($city) ? $city->name : ucfirst($cityId);
  $heroSlides = collect([$lead])->concat($gridStories->take(3))->filter();
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
          <a href="{{ url('/') }}" style="font-size:0.75rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#fff;text-decoration:none;">India</a>
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

    <!-- Hero Slides Container (Server-Rendered) -->
    <div id="hero-slides-wrap">
      @forelse($heroSlides as $idx => $slide)
        <div class="rm-hero-slide {{ $idx === 0 ? 'active' : '' }}" style="background-image: url('{{ $slide->cover_image ?: 'https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1600&q=85' }}');" data-index="{{ $idx }}">
          <div class="rm-hero-overlay"></div>
          <div class="rm-hero-content">
            <div class="cat-italic">{{ $slide->category ? $slide->category->name : 'Feature Story' }}</div>
            <h1 class="rm-hero-title">{{ $slide->title }}</h1>
            <a href="{{ url('/article/' . $slide->id) }}" class="btn-pill">View Post</a>
          </div>
        </div>
      @empty
        <div class="rm-hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1600&q=85');">
          <div class="rm-hero-overlay"></div>
          <div class="rm-hero-content">
            <div class="cat-italic">{{ $cityName }} Editorial</div>
            <h1 class="rm-hero-title">Documenting Life, Culture, and Stories in {{ $cityName }}</h1>
            <a href="{{ url('/stories') }}" class="btn-pill">Explore Stories</a>
          </div>
        </div>
      @endforelse
    </div>

    <!-- Side Navigation Arrows -->
    @if($heroSlides->count() > 1)
      <button class="rm-hero-arrow prev" id="hero-arrow-prev" aria-label="Previous slide">&#10094;</button>
      <button class="rm-hero-arrow next" id="hero-arrow-next" aria-label="Next slide">&#10095;</button>
      <div class="rm-hero-dots" id="hero-dots">
        @foreach($heroSlides as $i => $s)
          <div class="rm-hero-dot {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}"></div>
        @endforeach
      </div>
    @endif
  </header>

  <!-- ══ SECTION 1: CULTURE & HERITAGE ═══════════════════════════ -->
  <section id="sec-culture" class="section-head">
    <div class="section-head-title">— Culture &amp; Heritage —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-1" id="tiles-section-1">
      @foreach($gridStories->slice(0, 2) as $story)
        <div class="rm-tile rm-tile-1" style="background-image: url('{{ $story->cover_image }}');">
          <div class="rm-tile-overlay"></div>
          <div class="rm-tile-content">
            <div class="cat-italic">{{ $story->category->name ?? 'Heritage' }}</div>
            <h2 class="rm-tile-title">{{ $story->title }}</h2>
            <a href="{{ url('/article/' . $story->id) }}" class="btn-pill">View Post</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ══ SECTION 2: CULINARY & TASTE ═════════════════════════════ -->
  <section id="sec-food" class="section-head">
    <div class="section-head-title">— Culinary &amp; Taste —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-2" id="tiles-section-2">
      @foreach($gridStories->slice(2, 2) as $story)
        <div class="rm-tile rm-tile-2" style="background-image: url('{{ $story->cover_image }}');">
          <div class="rm-tile-overlay"></div>
          <div class="rm-tile-content">
            <div class="cat-italic">{{ $story->category->name ?? 'Living' }}</div>
            <h2 class="rm-tile-title">{{ $story->title }}</h2>
            <a href="{{ url('/article/' . $story->id) }}" class="btn-pill">View Post</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ══ SECTION 3: FASHION & CRAFT ══════════════════════════════ -->
  <section id="sec-fashion" class="section-head">
    <div class="section-head-title">— Fashion &amp; Craft —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-3-top" id="tiles-section-3-top">
      @if($story = $gridStories->skip(4)->first())
        <div class="rm-tile rm-tile-3-hero" style="background-image: url('{{ $story->cover_image }}');">
          <div class="rm-tile-overlay"></div>
          <div class="rm-tile-content">
            <div class="cat-italic">{{ $story->category->name ?? 'Fashion' }}</div>
            <h2 class="rm-tile-title">{{ $story->title }}</h2>
            <a href="{{ url('/article/' . $story->id) }}" class="btn-pill">View Post</a>
          </div>
        </div>
      @endif
    </div>
  </div>

  <!-- ══ SECTION 4: DOCUMENTED CITIZENS & PEOPLE ═══════════════════ -->
  <section id="sec-street" class="section-head">
    <div class="section-head-title">— {{ $cityName }} People &amp; Voices —</div>
  </section>
  <div class="rm-container">
    <div class="rm-grid-cards" id="grid-section-4">
      @foreach($people->take(4) as $person)
        <div class="rm-card" onclick="location.href='{{ url('/stories') }}'" style="cursor:pointer;">
          <div class="rm-card-img" style="background-image: url('{{ $person->portrait_image ?: $person->cover_image }}');"></div>
          <div class="rm-card-content">
            <div class="cat-italic">{{ $person->category->name ?? strtoupper($person->type) }}</div>
            <h3 class="rm-card-title">{{ $person->name }}</h3>
            <p style="font-size:0.85rem;color:#ccc;margin-top:4px;">{{ $person->profession }}</p>
            <a href="{{ url('/stories') }}" class="btn-pill">View Profile</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ══ SECTION 5: BLOG STREAM ════════════════════════════════ -->
  <section id="sec-blog" class="section-head" style="padding-top:80px;">
    <div class="section-head-title" style="letter-spacing:5px;font-size:0.95rem;color:#ffffff;">EDITORIAL DISPATCHES</div>
  </section>
  <div class="rm-container-blog">
    <div class="rm-blog-stream" id="blog-stream">
      @foreach($gridStories->take(3) as $art)
        <article class="rm-blog-post">
          <div class="rm-blog-img" style="background-image: url('{{ $art->cover_image }}');"></div>
          <div class="rm-blog-body">
            <div class="cat-italic">{{ $art->category->name ?? 'Dispatch' }}</div>
            <h2 class="rm-blog-title"><a href="{{ url('/article/' . $art->id) }}">{{ $art->title }}</a></h2>
            <p class="rm-blog-excerpt">{{ Str::limit($art->excerpt, 140) }}</p>
            <a href="{{ url('/article/' . $art->id) }}" class="btn-pill">Continue Reading</a>
          </div>
        </article>
      @endforeach
    </div>
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
        <a href="#sec-street">People</a>
        <a href="#sec-blog">Blog</a>
        <a href="{{ url('/') }}">All India Edition</a>
      </div>
      <div class="rm-footer-copy">
        &copy; {{ date('Y') }} {{ $cityName }} Moments · CITYICON Magazine.
      </div>
    </div>
  </footer>

  <!-- ══ SEARCH MODAL ═════════════════════════════════════════ -->
  <div class="rm-search-modal" id="search-modal">
    <div class="rm-search-wrap">
      <button class="rm-search-close" id="btn-close-search">&times;</button>
      <form action="{{ url('/search') }}" method="GET">
        <input type="text" name="q" class="rm-search-input" id="search-input" placeholder="Type and hit enter...">
      </form>
    </div>
  </div>

  <!-- Lightweight Inline Controls -->
  <script>
    // Hero Slider
    (function () {
      const slides = document.querySelectorAll('.rm-hero-slide');
      const dots = document.querySelectorAll('.rm-hero-dot');
      let current = 0;
      function show(idx) {
        if (!slides.length) return;
        slides.forEach((s, i) => s.classList.toggle('active', i === idx));
        dots.forEach((d, i) => d.classList.toggle('active', i === idx));
        current = idx;
      }
      document.getElementById('hero-arrow-next')?.addEventListener('click', () => show((current + 1) % slides.length));
      document.getElementById('hero-arrow-prev')?.addEventListener('click', () => show((current - 1 + slides.length) % slides.length));
      dots.forEach((d, i) => d.addEventListener('click', () => show(i)));
      if (slides.length > 1) setInterval(() => show((current + 1) % slides.length), 6000);
    })();

    // Offcanvas Drawer
    (function () {
      const drawer = document.getElementById('offcanvas-drawer');
      const overlay = document.getElementById('site-overlay');
      const open = () => { drawer?.classList.add('open'); overlay?.classList.add('open'); };
      const close = () => { drawer?.classList.remove('open'); overlay?.classList.remove('open'); };
      document.getElementById('btn-open-menu')?.addEventListener('click', open);
      document.getElementById('btn-cities-drawer')?.addEventListener('click', (e) => { e.preventDefault(); open(); });
      document.getElementById('btn-close-offcanvas')?.addEventListener('click', close);
      overlay?.addEventListener('click', close);
    })();

    // Search Modal
    (function () {
      const modal = document.getElementById('search-modal');
      document.getElementById('btn-open-search')?.addEventListener('click', () => {
        modal?.classList.add('open');
        setTimeout(() => document.getElementById('search-input')?.focus(), 150);
      });
      document.getElementById('btn-close-search')?.addEventListener('click', () => modal?.classList.remove('open'));
      modal?.addEventListener('click', (e) => { if (e.target === modal) modal.classList.remove('open'); });
    })();
  </script>
</body>
</html>
