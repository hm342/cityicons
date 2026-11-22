<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="CITYICON — India's Premier City Magazine. Curating the best stories in Fashion, Living Culture, Food, and Heritage across India's cities.">
  <title>CITYICONS — India's City Magazine</title>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/logo-cityicons-square.png') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <x-google-analytics />
</head>
<body>

  <!-- ══ OFFCANVAS SLIDEOUT DRAWER ════════════════════════════ -->
  <div class="vogue-overlay" id="vogue-overlay"></div>
  <aside class="vogue-drawer" id="vogue-drawer">
    <button class="vogue-drawer__close" id="btn-close-drawer" aria-label="Close menu">&times;</button>
    <div style="margin-bottom:24px;">
      <a href="{{ url('/') }}" aria-label="CityIcons Home" style="display:inline-block;">
        <img src="{{ asset('images/logo-cityicons.png') }}" alt="CityIcons" style="height:46px; width:auto; display:block; object-fit:contain;">
      </a>
    </div>
    
    <div class="vogue-drawer__title">City Editions</div>
    <div class="vogue-drawer__city-grid" id="drawer-cities-grid">
      @foreach($cities as $c)
        <a href="{{ url('/' . $c->slug) }}" class="vogue-drawer__city-chip">{{ $c->name }}</a>
      @endforeach
    </div>

    <div class="vogue-drawer__title" style="margin-top:30px;">Quick Jump</div>
    <ul class="vogue-drawer__menu">
      <li><a href="#hero-banner">Cover Story</a></li>
      <li><a href="#sec-bhavnagar">Bhavnagar Edition</a></li>
      <li><a href="#sec-mumbai">Mumbai Edition</a></li>
      <li><a href="#sec-ahmedabad">Ahmedabad Cinema</a></li>
      <li><a href="#sec-weddings">Weddings &amp; Celebrations</a></li>
    </ul>
  </aside>

  <!-- ══ 1. SITE MASTER HEADER ════════════════════════════════ -->
  <!-- Left: Menu | Center: CITYICON | Right: Subscribe & Search -->
  <header class="site-master-header">
    <div class="vogue-container">
      <div class="header-main-grid">
        <!-- Left: Menu -->
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

        <!-- Center: CITYICONS Official Brand Masthead -->
        <div class="header-center">
          <a href="{{ url('/') }}" class="cityicon-main-logo" aria-label="CityIcons Home">
            <img src="{{ asset('images/logo-cityicons.png') }}" alt="CityIcons" class="cityicon-logo-img">
          </a>
        </div>

        <!-- Right: Subscribe & Search -->
        <div class="header-right">
          <a href="{{ url('/bhavnagar/nominate') }}" class="btn-header-subscribe">Subscribe</a>
          <button class="btn-header-search" id="btn-open-search" aria-label="Search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- ══ 2. CITY-WISE MENU BAR (Sticky) ═══════════════════════ -->
    <nav class="city-navbar">
      <div class="vogue-container">
        <ul class="city-navbar__list" id="city-nav-list">
          <li class="city-navbar__item active"><a href="{{ url('/') }}">All India</a></li>
          @foreach($cities as $c)
            <li class="city-navbar__item"><a href="{{ url('/' . $c->slug) }}">{{ $c->name }}</a></li>
          @endforeach
        </ul>
      </div>
    </nav>
  </header>

  <!-- ══ 3. HERO BIG BANNER (Inside Unified Container) ═══════ -->
  <section class="hero-section-wrap">
    <div class="vogue-container">
      <div class="hero-big-banner" id="hero-banner">
        @if($coverArticle)
          <div class="hero-big-banner__img-wrap" onclick="location.href='{{ url('/article/' . $coverArticle->id) }}'" style="cursor:pointer;">
            <img src="{{ $coverArticle->cover_image }}" alt="{{ $coverArticle->title }}" loading="eager">
            <!-- Top gradient for contrast -->
            <div class="hero-big-banner__top-shade"></div>
            <!-- Right side top CITYICONS brand stamp inside the image -->
            <div class="hero-big-banner__brand-stamp">
              <img src="{{ asset('images/logo-cityicons-white.png') }}" alt="CityIcons" style="height:clamp(26px, 3.2vw, 38px); width:auto; filter:drop-shadow(0 2px 8px rgba(0,0,0,0.75)); display:block;">
            </div>
            <!-- Bottom gradient shade for text readability -->
            <div class="hero-big-banner__bottom-shade"></div>

            <!-- Main description INSIDE the image at the bottom -->
            <div class="hero-big-banner__content-overlay">
              <div class="hero-big-banner__content-box">
                <h1 class="hero-big-banner__hed">{{ $coverArticle->title }}</h1>
              </div>
            </div>
          </div>

          <!-- Others things OUT of the image (underneath the image) -->
          <div class="hero-big-banner__details" onclick="location.href='{{ url('/article/' . $coverArticle->id) }}'" style="cursor:pointer;">
            <span class="vogue-rubric vogue-rubric--red">
              {{ $coverArticle->category ? $coverArticle->category->name : 'Fashion' }} · Cover Feature
            </span>
            <p class="hero-big-banner__dek">{{ $coverArticle->excerpt }}</p>
            <div class="vogue-byline">
              <span>By {{ $coverArticle->author_name ?? 'Editorial Staff' }}</span>
              <span class="dot"></span>
              <span>{{ $coverArticle->published_at ? $coverArticle->published_at->format('j F Y') : '15 November 2026' }}</span>
              <span class="dot"></span>
              <span>{{ $coverArticle->read_time ?? '8 min read' }}</span>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- ══ 4. CITY NEWS CAROUSEL / TICKER BAR ═══════════════════ -->
  <section class="city-news-strip-section">
    <div class="vogue-container">
      <div class="news-strip-header">
        <span class="news-strip-title">Latest City Dispatch · Across India</span>
        <div class="news-strip-controls">
          <button class="strip-control-btn" id="btn-strip-prev" aria-label="Previous news">&#10094;</button>
          <button class="strip-control-btn" id="btn-strip-next" aria-label="Next news">&#10095;</button>
        </div>
      </div>
      <div class="city-news-track" id="city-news-track">
        @foreach($newsStrip as $art)
          <div class="city-news-mini-card" onclick="location.href='{{ url('/article/' . $art->id) }}'" style="cursor:pointer;">
            <div class="city-news-mini-card__img">
              <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" loading="lazy">
            </div>
            <span class="city-news-mini-card__city">{{ $art->city ? $art->city->name : 'National' }}</span>
            <h3 class="city-news-mini-card__hed">{{ $art->title }}</h3>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <main id="main-content">

    <!-- ══ 5. CITY SECTION 1: BHAVNAGAR ═════════════════════════ -->
    <section id="sec-bhavnagar" class="city-edition-section">
      <div class="vogue-container">
        <div class="section-hed-bar">
          <h2 class="section-hed-title">Bhavnagar</h2>
          <a href="{{ url('/bhavnagar') }}" class="section-hed-link">
            <span>Explore Bhavnagar Edition</span>
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <div class="vogue-sticky-section">
          <!-- Left: Sticky Lead Story -->
          <div class="vogue-sticky-col">
            <article class="vogue-sticky-lead" id="bhavnagar-lead">
              @if($bhavLead)
                <div class="vogue-sticky-lead__card" onclick="location.href='{{ url('/article/' . $bhavLead->id) }}'" style="cursor:pointer;">
                  <img class="vogue-sticky-lead__img" src="{{ $bhavLead->cover_image }}" alt="{{ $bhavLead->title }}" loading="lazy">
                  <div class="vogue-sticky-lead__overlay"></div>
                  <div class="vogue-sticky-lead__content">
                    <span class="vogue-sticky-lead__rubric">{{ $bhavLead->category ? $bhavLead->category->name : 'Events' }} · Bhavnagar</span>
                    <h2 class="vogue-sticky-lead__hed">{{ $bhavLead->title }}</h2>
                    <div class="vogue-sticky-lead__byline">BY {{ strtoupper($bhavLead->author_name ?? 'Editorial Staff') }}</div>
                  </div>
                </div>
              @endif
            </article>
          </div>

          <!-- Right: 6 Stories Grid (2 columns x 3 rows) scrolling naturally with page -->
          <div class="vogue-scroll-right-grid" id="bhavnagar-grid-6">
            @foreach($bhavGrid as $a)
              <article class="vogue-sub-card" onclick="location.href='{{ url('/article/' . $a->id) }}'" style="cursor:pointer;">
                <div class="vogue-sub-card__media">
                  <img src="{{ $a->cover_image }}" alt="{{ $a->title }}" loading="lazy">
                </div>
                <span class="vogue-sub-card__rubric">{{ $a->category ? $a->category->name : 'Story' }}</span>
                <h3 class="vogue-sub-card__hed">{{ $a->title }}</h3>
                <div class="vogue-sub-card__byline">
                  <span>BY {{ strtoupper($a->author_name ?? 'Editorial Staff') }}</span>
                  <span class="vogue-sub-card__date">{{ $a->published_at ? $a->published_at->format('j F Y') : '' }}</span>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <!-- ══ 6. CITY SECTION 2: MUMBAI ════════════════════════════ -->
    <section id="sec-mumbai" class="city-edition-section">
      <div class="vogue-container">
        <div class="section-hed-bar">
          <h2 class="section-hed-title">Mumbai</h2>
          <a href="{{ url('/mumbai') }}" class="section-hed-link">
            <span>Explore Mumbai Edition</span>
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <div class="vogue-sticky-section">
          <!-- Left: Sticky Lead Story -->
          <div class="vogue-sticky-col">
            <article class="vogue-sticky-lead" id="mumbai-lead">
              @if($mumbaiLead)
                <div class="vogue-sticky-lead__card" onclick="location.href='{{ url('/article/' . $mumbaiLead->id) }}'" style="cursor:pointer;">
                  <img class="vogue-sticky-lead__img" src="{{ $mumbaiLead->cover_image }}" alt="{{ $mumbaiLead->title }}" loading="lazy">
                  <div class="vogue-sticky-lead__overlay"></div>
                  <div class="vogue-sticky-lead__content">
                    <span class="vogue-sticky-lead__rubric">{{ $mumbaiLead->category ? $mumbaiLead->category->name : 'Fashion' }} · Mumbai</span>
                    <h2 class="vogue-sticky-lead__hed">{{ $mumbaiLead->title }}</h2>
                    <div class="vogue-sticky-lead__byline">BY {{ strtoupper($mumbaiLead->author_name ?? 'Editorial Staff') }}</div>
                  </div>
                </div>
              @endif
            </article>
          </div>

          <!-- Right: 6 Stories Grid (2 columns x 3 rows) scrolling naturally with page -->
          <div class="vogue-scroll-right-grid" id="mumbai-grid-6">
            @foreach($mumbaiGrid as $a)
              <article class="vogue-sub-card" onclick="location.href='{{ url('/article/' . $a->id) }}'" style="cursor:pointer;">
                <div class="vogue-sub-card__media">
                  <img src="{{ $a->cover_image }}" alt="{{ $a->title }}" loading="lazy">
                </div>
                <span class="vogue-sub-card__rubric">{{ $a->category ? $a->category->name : 'Story' }}</span>
                <h3 class="vogue-sub-card__hed">{{ $a->title }}</h3>
                <div class="vogue-sub-card__byline">
                  <span>BY {{ strtoupper($a->author_name ?? 'Editorial Staff') }}</span>
                  <span class="vogue-sub-card__date">{{ $a->published_at ? $a->published_at->format('j F Y') : '' }}</span>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <!-- ══ 7. CITY SECTION 3: AHMEDABAD (Cinematic Banner + Carousel Below) ══ -->
    <section class="city-cinema-section" id="sec-ahmedabad">
      <div class="vogue-container">
        <div class="section-hed-bar">
          <h2 class="section-hed-title">Ahmedabad</h2>
          <a href="{{ url('/ahmedabad') }}" class="section-hed-link">
            <span>Explore Ahmedabad Edition</span>
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <!-- Big Cinematic Image Banner (Inside same main container) -->
        <div class="city-cinema-banner" id="ahmedabad-cinema-banner">
          @if($ahmdBanner)
            <img src="{{ $ahmdBanner->cover_image }}" alt="{{ $ahmdBanner->title }}" onclick="location.href='{{ url('/article/' . $ahmdBanner->id) }}'" style="cursor:pointer;">
            <div class="city-cinema-overlay"></div>
            <div class="city-cinema-content" onclick="location.href='{{ url('/article/' . $ahmdBanner->id) }}'" style="cursor:pointer;">
              <span class="vogue-rubric">{{ $ahmdBanner->category ? $ahmdBanner->category->name : 'Culture' }} · Ahmedabad Showcase</span>
              <h2 class="city-cinema-hed">{{ $ahmdBanner->title }}</h2>
              <p class="city-cinema-dek">{{ $ahmdBanner->excerpt }}</p>
              <div class="vogue-byline" style="color:rgba(255,255,255,0.8); margin-top:10px;">
                <span>By {{ $ahmdBanner->author_name ?? 'Editorial Staff' }}</span>
                <span class="dot"></span>
                <span>{{ $ahmdBanner->published_at ? $ahmdBanner->published_at->format('j F Y') : '' }}</span>
              </div>
            </div>
          @endif
        </div>

        <!-- Carousel of other Ahmedabad news below -->
        @if($ahmdStories && $ahmdStories->count() > 0)
          <div class="city-cinema-carousel-wrap">
            <div class="city-cinema-carousel-header">
              <span style="font-family:var(--font-sans); font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase;">More From Ahmedabad</span>
              <div class="news-strip-controls">
                <button class="strip-control-btn" id="btn-ahmd-prev" aria-label="Previous">&#10094;</button>
                <button class="strip-control-btn" id="btn-ahmd-next" aria-label="Next">&#10095;</button>
              </div>
            </div>
            <div class="city-cinema-carousel-track" id="ahmedabad-cinema-track">
              @foreach($ahmdStories as $a)
                <article class="city-cinema-card" onclick="location.href='{{ url('/article/' . $a->id) }}'" style="cursor:pointer;">
                  <div class="city-cinema-card__media">
                    <img src="{{ $a->cover_image }}" alt="{{ $a->title }}" loading="lazy">
                  </div>
                  <span class="vogue-rubric" style="font-size:0.625rem;">{{ $a->category ? $a->category->name : 'Story' }}</span>
                  <h3 class="city-cinema-card__hed">{{ $a->title }}</h3>
                  <div class="vogue-byline">
                    <span>By {{ $a->author_name ?? 'Editorial Staff' }}</span>
                  </div>
                </article>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </section>

    <!-- ══ 8. LAST SECTION: WEDDINGS & ROYAL CELEBRATIONS (4-Column Collection Grid) ══ -->
    <section id="sec-weddings" class="vogue-weddings-section">
      <div class="vogue-container">
        <div class="section-hed-bar">
          <h2 class="section-hed-title">Weddings &amp; Celebrations</h2>
          <a href="{{ url('/jaipur') }}" class="section-hed-link">
            <span>Explore Royal Celebrations</span>
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <div class="vogue-4col-grid" id="weddings-4col-grid">
          @foreach($weddingArticles as $a)
            <article class="vogue-4col-card" onclick="location.href='{{ url('/article/' . $a->id) }}'" style="cursor:pointer;">
              <div class="vogue-4col-card__media">
                <img src="{{ $a->cover_image }}" alt="{{ $a->title }}" loading="lazy">
                <span class="vogue-card-badge-gallery" aria-label="Gallery">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="13" height="13" rx="2" ry="2"></rect>
                    <path d="M8 21h13V8"></path>
                  </svg>
                </span>
              </div>
              <span class="vogue-4col-card__rubric">{{ $a->category ? $a->category->name : 'Weddings' }}</span>
              <h3 class="vogue-4col-card__hed">{{ $a->title }}</h3>
              <div class="vogue-4col-card__byline">
                <span class="vogue-4col-card__author">BY {{ strtoupper($a->author_name ?? 'Editorial Staff') }}</span>
                <span class="vogue-4col-card__date">{{ $a->published_at ? $a->published_at->format('j F Y') : '' }}</span>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>

  </main>

  <!-- ══ 9. SITE FOOTER ═══════════════════════════════════════ -->
  <footer class="vogue-footer">
    <div class="vogue-container">
      <div class="vogue-footer__logo-wrap">
        <a href="{{ url('/') }}" aria-label="CityIcons Home" style="display:inline-block;">
          <img src="{{ asset('images/logo-cityicons-white.png') }}" alt="CityIcons" class="vogue-footer-logo-img">
        </a>
      </div>

      <div class="vogue-footer__social">
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
      </div>

      <div class="vogue-footer__cities-title">City Editions of India</div>
      <div class="vogue-footer__cities" id="footer-cities-list">
        @foreach($cities as $idx => $c)
          <a href="{{ url('/' . $c->slug) }}">{{ $c->name }}</a>@if(!$loop->last) · @endif
        @endforeach
      </div>

      <div class="vogue-footer__legal">
        &copy; {{ date('Y') }} CITYICON MAGAZINE. ALL RIGHTS RESERVED.<br>
        Curating India's finest in fashion, culture, living, and architecture across our city editions.
      </div>
    </div>
  </footer>

  <!-- ══ SEARCH MODAL OVERLAY ═════════════════════════════════ -->
  <div class="vogue-search-modal" id="vogue-search-modal">
    <div class="vogue-search-wrap">
      <button class="vogue-search-close" id="btn-close-search" aria-label="Close search">&times;</button>
      <form action="{{ url('/search') }}" method="GET">
        <input type="text" name="q" class="vogue-search-input" id="vogue-search-input" placeholder="Search CITYICON stories..." autofocus>
      </form>
    </div>
  </div>

  <script>
    // Offcanvas Drawer
    (function() {
      const drawer = document.getElementById('vogue-drawer');
      const overlay = document.getElementById('vogue-overlay');
      const btnOpen = document.getElementById('btn-open-drawer');
      const btnClose = document.getElementById('btn-close-drawer');
      const open = () => { drawer?.classList.add('open'); overlay?.classList.add('open'); };
      const close = () => { drawer?.classList.remove('open'); overlay?.classList.remove('open'); };
      btnOpen?.addEventListener('click', open);
      btnClose?.addEventListener('click', close);
      overlay?.addEventListener('click', close);
    })();

    // Search Modal
    (function() {
      const modal = document.getElementById('vogue-search-modal');
      const btnOpen = document.getElementById('btn-open-search');
      const btnClose = document.getElementById('btn-close-search');
      btnOpen?.addEventListener('click', () => {
        modal?.classList.add('open');
        setTimeout(() => document.getElementById('vogue-search-input')?.focus(), 150);
      });
      btnClose?.addEventListener('click', () => modal?.classList.remove('open'));
      modal?.addEventListener('click', (e) => { if (e.target === modal) modal.classList.remove('open'); });
    })();

    // Horizontal Carousel Tracks
    (function() {
      const newsTrack = document.getElementById('city-news-track');
      document.getElementById('btn-strip-prev')?.addEventListener('click', () => newsTrack?.scrollBy({ left: -320, behavior: 'smooth' }));
      document.getElementById('btn-strip-next')?.addEventListener('click', () => newsTrack?.scrollBy({ left: 320, behavior: 'smooth' }));

      const ahmdTrack = document.getElementById('ahmedabad-cinema-track');
      document.getElementById('btn-ahmd-prev')?.addEventListener('click', () => ahmdTrack?.scrollBy({ left: -320, behavior: 'smooth' }));
      document.getElementById('btn-ahmd-next')?.addEventListener('click', () => ahmdTrack?.scrollBy({ left: 320, behavior: 'smooth' }));
    })();
  </script>
</body>
</html>
