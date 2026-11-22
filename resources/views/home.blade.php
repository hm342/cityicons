<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="CITYICON — India's Premier City Magazine. Curating the best stories in Fashion, Living Culture, Food, and Heritage across India's cities.">
  <title>CITYICONS — India's City Magazine</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,500;0,6..96,600;0,6..96,700&family=Caveat:wght@600;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap">
  
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/logo-cityicons-square.png') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <meta property="og:title" content="CITYICONS — India's Premier City Magazine">
  <meta property="og:description" content="Curating the best stories in Fashion, Living Culture, Food, and Heritage across India's cities.">
  <meta property="og:image" content="{{ asset('images/logo-cityicons.png') }}">
  <meta property="og:type" content="website">
  
  <x-google-analytics />
</head>
<body>

  <!-- ══ OFFCANVAS SLIDEOUT DRAWER ════════════════════════════ -->
  <x-drawer />

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
          <a href="{{ url('/nominate') }}" class="btn-header-subscribe" style="background:var(--vogue-red); color:#fff; border-color:var(--vogue-red); font-weight:800; letter-spacing:1.5px;">Nominate a Story</a>
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
  <x-footer />

  <!-- ══ SEARCH MODAL OVERLAY ═════════════════════════════════ -->
  <x-search-modal />

  <!-- Floating Back-to-Top Button -->
  <button class="rm-back-to-top" id="rm-back-to-top" aria-label="Back to Top">
    <i class="fas fa-arrow-up"></i>
  </button>

  <!-- Client-Side Engine -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
