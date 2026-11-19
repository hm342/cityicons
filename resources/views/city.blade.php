@php
  $cityId = is_object($city) ? $city->slug : ($city ?? 'bhavnagar');
  $cityName = is_object($city) ? $city->name : ucfirst($cityId);
  $heroSlides = $heroSlides ?? collect();
  $cultureStories = $cultureStories ?? collect();
  $culinaryStories = $culinaryStories ?? collect();
  $fashionStories = $fashionStories ?? collect();
  $people = $people ?? collect();
  $blogStories = $blogStories ?? collect();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $cityName }} Moments — Visual Stories, Culture, Food, and Lifestyle in {{ $cityName }}.">
  <title>{{ $cityId === 'bhavnagar' ? 'Bhavnagar Icons — Flagship Edition · CITYICONS' : $cityName . ' Moments — CITYICONS' }}</title>
  <link rel="stylesheet" href="{{ asset('css/city.css') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/logo-cityicons-square.png') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body data-city="{{ $cityId }}">

  <!-- ══ OFFCANVAS SLIDEOUT DRAWER ════════════════════════════ -->
  <div class="rm-overlay" id="site-overlay"></div>
  <aside class="rm-offcanvas" id="offcanvas-drawer">
    <button class="rm-offcanvas-close" id="btn-close-offcanvas">&times;</button>
    <div class="rm-logo" style="margin-bottom:20px;">
      @if($cityId === 'bhavnagar')
        <a href="{{ url('/bhavnagar') }}" style="display:inline-block; text-decoration:none;">
          <img src="{{ asset('images/logo-bhavnagar.png') }}" alt="Bhavnagar Icons" class="rm-logo-img">
        </a>
      @else
        <span class="rm-logo-text">{{ strtolower($cityName) }}</span>
        <span class="rm-logo-script">Moments</span>
      @endif
    </div>
    <div class="rm-offcanvas-title">Categories</div>
    <ul class="rm-offcanvas-menu">
      <li><a href="#sec-culture">Culture &amp; Heritage</a></li>
      <li><a href="#sec-food">Culinary &amp; Taste</a></li>
      <li><a href="#sec-fashion">Fashion &amp; Craft</a></li>
      <li><a href="#sec-people">People &amp; Voices</a></li>
      <li><a href="#sec-dispatches">Editorial Dispatches</a></li>
      <li><a href="{{ url('/') }}">← All India Magazine</a></li>
    </ul>

    <div class="rm-offcanvas-title">City Editions</div>
    <div class="rm-city-grid">
      @foreach(['bhavnagar', 'mumbai', 'surat', 'ahmedabad', 'rajkot', 'vadodara', 'delhi', 'bengaluru', 'jaipur', 'kolkata'] as $c)
        <a href="{{ url('/' . $c) }}" class="rm-city-link {{ $cityId === $c ? 'active' : '' }}">{{ ucfirst($c) }}</a>
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
        <a href="{{ url('/' . $cityId) }}" class="rm-logo" aria-label="{{ $cityName }} Icons">
          @if($cityId === 'bhavnagar')
            <img src="{{ asset('images/logo-bhavnagar-white.png') }}" alt="Bhavnagar Icons" class="rm-logo-img">
          @else
            <span class="rm-logo-text">{{ strtolower($cityName) }}</span>
            <span class="rm-logo-script">Moments</span>
          @endif
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
        <li><a href="#sec-people">People</a></li>
        <li><a href="#sec-dispatches">Dispatches</a></li>
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

  <!-- ══ SECTION 1: CULTURE & HERITAGE (Tiles Style 1: 1 Tall Left + 4 Right 2x2) ══ -->
  <section id="sec-culture" class="section-head">
    <div class="section-head-title">— Culture &amp; Heritage —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-1" id="tiles-section-1">
      @foreach($cultureStories->take(5) as $idx => $story)
        <div class="tile-card {{ $idx === 0 ? 'tile-tall' : '' }}" onclick="location.href='{{ url('/article/' . $story->id) }}'">
          <img class="tile-card-img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
          <div class="tile-card-overlay"></div>
          <div class="tile-card-body">
            <div class="cat-italic">{{ $story->category->name ?? 'Heritage' }}</div>
            @if($idx === 0)
              <h2 class="tile-title">{{ $story->title }}</h2>
              <a href="{{ url('/article/' . $story->id) }}" class="btn-pill">View Post</a>
            @else
              <h3 class="tile-title">{{ $story->title }}</h3>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ══ SECTION 2: CULINARY & TASTE (Tiles Style 2: 2 Left + 1 Center Tall + 2 Right) ══ -->
  <section id="sec-food" class="section-head">
    <div class="section-head-title">— Culinary &amp; Taste —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-2" id="tiles-section-2">
      @foreach($culinaryStories->take(5) as $idx => $story)
        {{-- Index 2 is the 3rd child, which is placed in the center column spanning 2 rows --}}
        <div class="tile-card {{ $idx === 2 ? 'tile-tall' : '' }}" onclick="location.href='{{ url('/article/' . $story->id) }}'">
          <img class="tile-card-img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
          <div class="tile-card-overlay"></div>
          <div class="tile-card-body">
            <div class="cat-italic">{{ $story->category->name ?? 'Living' }}</div>
            @if($idx === 2)
              <h2 class="tile-title">{{ $story->title }}</h2>
              <a href="{{ url('/article/' . $story->id) }}" class="btn-pill">View Post</a>
            @else
              <h3 class="tile-title">{{ $story->title }}</h3>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ══ SECTION 3: FASHION & CRAFT (Tiles Style 3: 2 Asymmetric Top + 3 Equal Bottom) ══ -->
  <section id="sec-fashion" class="section-head">
    <div class="section-head-title">— Fashion &amp; Craft —</div>
  </section>
  <div class="rm-container">
    <div class="rm-tiles-3-top" id="tiles-section-3-top">
      @foreach($fashionStories->take(2) as $story)
        <div class="tile-card" onclick="location.href='{{ url('/article/' . $story->id) }}'">
          <img class="tile-card-img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
          <div class="tile-card-overlay"></div>
          <div class="tile-card-body">
            <div class="cat-italic">{{ $story->category->name ?? 'Fashion' }}</div>
            <h3 class="tile-title">{{ $story->title }}</h3>
          </div>
        </div>
      @endforeach
    </div>
    <div class="rm-tiles-3-bottom" id="tiles-section-3-bottom">
      @foreach($fashionStories->skip(2)->take(3) as $story)
        <div class="tile-card" onclick="location.href='{{ url('/article/' . $story->id) }}'">
          <img class="tile-card-img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
          <div class="tile-card-overlay"></div>
          <div class="tile-card-body">
            <div class="cat-italic">{{ $story->category->name ?? 'Craft' }}</div>
            <h3 class="tile-title">{{ $story->title }}</h3>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ══ SECTION 4: DOCUMENTED CITIZENS & PEOPLE (3x2 Grid with Share Footers) ══ -->
  <section id="sec-people" class="section-head">
    <div class="section-head-title">— {{ $cityName }} People &amp; Voices —</div>
  </section>
  <div class="rm-container">
    <div class="rm-grid-cards" id="grid-section-4">
      @foreach($people->take(6) as $person)
        @php $pUrl = url('/person/' . ($person->slug ?: $person->id)); @endphp
        <div class="rm-grid-card" onclick="location.href='{{ $pUrl }}'">
          <img class="rm-grid-card-img" src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" loading="lazy">
          <div class="rm-grid-card-overlay"></div>
          <div class="rm-grid-card-body">
            <div class="cat-italic">{{ $person->category->name ?? strtoupper($person->type) }}</div>
            <h3 class="rm-grid-card-title">{{ $person->name }}</h3>
            <div class="post-share-inline">
              <span class="share-txt">Share &rarr;</span>
              <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode($pUrl) }}" target="_blank" rel="noopener" onclick="event.stopPropagation();">Facebook</a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode($pUrl) }}" target="_blank" rel="noopener" onclick="event.stopPropagation();">X</a>
              <a href="https://pinterest.com/pin/create/button/?url={{ urlencode($pUrl) }}" target="_blank" rel="noopener" onclick="event.stopPropagation();">Pinterest</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ══ SECTION 5: BLOG STREAM (50/50 Horizontal Split Cards with Video Badge) ══ -->
  <section id="sec-dispatches" class="section-head" style="padding-top:80px;">
    <div class="section-head-title" style="letter-spacing:5px;font-size:0.95rem;color:#ffffff;">EDITORIAL DISPATCHES</div>
  </section>
  <div class="rm-container-blog">
    <div class="rm-blog-stream" id="blog-stream">
      @foreach($blogStories->take(4) as $art)
        <article class="rm-blog-card">
          <div class="rm-blog-media" onclick="location.href='{{ url('/article/' . $art->id) }}'" style="cursor:pointer;">
            <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" loading="lazy">
            <div class="rm-media-badge"><i class="fas fa-video"></i></div>
          </div>
          <div class="rm-blog-content">
            <div>
              <div class="cat-italic">{{ $art->category->name ?? 'Dispatch' }}</div>
              <h2 class="rm-blog-title"><a href="{{ url('/article/' . $art->id) }}">{{ $art->title }}</a></h2>
              <p class="rm-blog-excerpt">
                <span class="bullet">&#10070;</span>
                <span>{{ Str::limit($art->excerpt ?: strip_tags($art->content), 150) }}</span>
              </p>
              <a href="{{ url('/article/' . $art->id) }}" class="btn-pill">View Post</a>
            </div>
            <div class="post-share-inline">
              <span class="share-txt">Share &rarr;</span>
              <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url('/article/' . $art->id)) }}" target="_blank" rel="noopener">Facebook</a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/article/' . $art->id)) }}&text={{ urlencode($art->title) }}" target="_blank" rel="noopener">X</a>
              <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url('/article/' . $art->id)) }}" target="_blank" rel="noopener">Pinterest</a>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>

  <!-- ══ FOOTER ═══════════════════════════════════════════════ -->
  <footer class="rm-footer">
    <div class="rm-container">
      <a href="{{ url('/' . $cityId) }}" class="rm-footer-logo" aria-label="{{ $cityName }} Icons">
        @if($cityId === 'bhavnagar')
          <img src="{{ asset('images/logo-bhavnagar-white.png') }}" alt="Bhavnagar Icons" class="rm-footer-logo-img">
        @else
          <span class="rm-logo-text">{{ strtolower($cityName) }}</span>
          <span class="rm-logo-script">Moments</span>
        @endif
      </a>
      <div class="rm-footer-nav">
        <a href="#hero-section">Home</a>
        <a href="#sec-culture">Culture</a>
        <a href="#sec-food">Food</a>
        <a href="#sec-fashion">Fashion</a>
        <a href="#sec-people">People</a>
        <a href="#sec-dispatches">Dispatches</a>
        <a href="{{ url('/') }}">All India Edition</a>
      </div>
      <div class="rm-footer-copy">
        &copy; {{ date('Y') }} {{ $cityId === 'bhavnagar' ? 'Bhavnagar Icons' : $cityName . ' Moments' }} · CITYICONS Magazine.
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
