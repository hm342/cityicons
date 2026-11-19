@php
  $cityId = is_object($city) ? $city->slug : ($city ?? 'bhavnagar');
  $cityName = is_object($city) ? $city->name : ucfirst($cityId);
  $isFlagship = ($cityId === 'bhavnagar');
  $heroCover = ($heroArticle && $heroArticle->cover_image)
    ? $heroArticle->cover_image
    : ($city && is_object($city) && $city->hero_image ? $city->hero_image : 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85');
  $pageTitle = $cityName . ' Icons — ' . ($isFlagship ? 'Flagship Edition' : 'City Edition') . ' · CITYICONS';
@endphp

<x-layouts.app :title="$pageTitle" :city="$city" activeCity="city-home" :transparentHeader="true" :darkTheme="true">

  <!-- ════════════════════════════════════════════════════════════
       1. HERO SECTION (Real Moments Full-Bleed Hero & Menu Header)
       ════════════════════════════════════════════════════════════ -->
  <div class="rm-hero-wrap" id="rm-hero-wrap">

    <!-- Top Floating Header Overlay -->
    <header class="rm-header-overlay" id="rm-header-overlay">
      <div class="rm-header-row">
        <!-- Left: Drawer Hamburger Button -->
        <div class="rm-header-left">
          <button class="rm-menu-btn" id="btn-open-drawer" aria-label="Open Navigation Menu">
            <i class="fas fa-bars"></i>
          </button>
        </div>

        <!-- Center: City Brand Editorial Logo -->
        <x-city-logo :city="$city" theme="white" />

        <!-- Right: Nominate Pill & Search Button -->
        <div class="rm-header-right">
          <a href="{{ url('/' . $cityId . '/nominate') }}" class="rm-header-btn-nominate">
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
          <li><a href="{{ url('/' . $cityId) }}" class="is-active">Home</a></li>
          <li><a href="{{ url('/' . $cityId . '/icons') }}">Icons</a></li>
          <li><a href="{{ url('/' . $cityId . '/rising') }}">Rising</a></li>
          <li><a href="{{ url('/' . $cityId . '/stories') }}">Stories</a></li>
          <li><a href="{{ url('/' . $cityId . '/the-list') }}">The List</a></li>
          <li><a href="{{ url('/' . $cityId . '/magazine') }}">Magazine</a></li>
          <li><a href="{{ url('/' . $cityId . '/in-' . $cityId) }}">In {{ $cityName }}</a></li>
          <li><a href="{{ url('/' . $cityId . '/featured-brands') }}">Brands</a></li>
          <li><a href="{{ url('/' . $cityId . '/nominate') }}" style="color:var(--vogue-red); font-weight:800;">Nominate</a></li>
        </ul>
      </nav>
    </header>

    <!-- Slide 1: Primary Flagship Slide -->
    <div class="rm-hero-slide active" style="background-image: url('{{ $heroCover }}');">
      <div class="rm-hero-overlay"></div>
      <div class="rm-hero-content">
        <span class="cat-italic">{{ $isFlagship ? 'Flagship Edition' : 'City Edition' }}</span>
        <h1 class="rm-hero-title">
          {{ $heroArticle ? $heroArticle->title : $cityName . ', Documented.' }}
        </h1>
        <a href="{{ $heroArticle ? url('/article/' . $heroArticle->id) : url('/' . $cityId . '/icons') }}" class="btn-pill">
          View Post
        </a>
      </div>
    </div>

    <!-- Additional Dynamic Slides -->
    @if(isset($heroSlides) && $heroSlides->count() > 0)
      @foreach($heroSlides as $slide)
        <div class="rm-hero-slide" style="background-image: url('{{ $slide->cover_image ?: $heroCover }}');">
          <div class="rm-hero-overlay"></div>
          <div class="rm-hero-content">
            <span class="cat-italic">{{ $slide->category ? $slide->category->name : 'Editorial Story' }}</span>
            <h2 class="rm-hero-title">
              {{ $slide->title }}
            </h2>
            <a href="{{ url('/article/' . $slide->id) }}" class="btn-pill">
              View Post
            </a>
          </div>
        </div>
      @endforeach
    @endif

    <!-- Carousel Edge Navigation Arrows -->
    <div class="rm-hero-arrow prev" id="rm-edge-prev" role="button" aria-label="Previous Slide">
      <i class="fas fa-chevron-left"></i>
    </div>
    <div class="rm-hero-arrow next" id="rm-edge-next" role="button" aria-label="Next Slide">
      <i class="fas fa-chevron-right"></i>
    </div>

    <!-- Slide Indicator Dots -->
    <div class="rm-hero-dots">
      <span class="rm-hero-dot active"></span>
      @if(isset($heroSlides))
        @foreach($heroSlides as $s)
          <span class="rm-hero-dot"></span>
        @endforeach
      @endif
    </div>

  </div>

  <!-- ════════════════════════════════════════════════════════════
       2. EDITORIAL MANIFESTO
       ════════════════════════════════════════════════════════════ -->
  <section style="padding:60px 0 20px;">
    <div class="rm-container">
      <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:clamp(32px, 5vw, 48px) clamp(24px, 4vw, 56px); border-radius:4px; text-align:center;">
        <span class="section-head-title" style="display:block; margin-bottom:12px; color:var(--text-dim); font-size:0.75rem;">EDITORIAL MANIFESTO</span>
        <h2 style="font-family:var(--font-sans); font-size:clamp(1.9rem, 3.4vw, 2.6rem); font-weight:700; color:#ffffff; margin-bottom:12px; line-height:1.2;">
          A city is shaped by its people.
        </h2>
        <p style="font-family:var(--font-sans); font-size:1.05rem; color:var(--text-muted); max-width:820px; margin:0 auto 12px; line-height:1.65;">
          {{ $cityName }} Icons is an independent editorial platform documenting credible people, meaningful journeys and lasting contributions connected to {{ $cityName }}.
        </p>
        <p style="font-family:var(--font-italic-cat); font-style:italic; font-size:1.2rem; color:var(--vogue-red); margin:0;">
          We focus on evidence, context and impact, not popularity alone.
        </p>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       3. FEATURED ICONS (Tiles Style 2: 2 Stacked Left + 1 Tall Center + 2 Stacked Right)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-featured-icons" style="padding-bottom:50px;">
    <div class="section-head">
      <span class="section-head-title">{{ strtoupper($cityName) }} · FEATURED ICONS</span>
      <h2 style="font-family:var(--font-sans); font-size:clamp(1.75rem, 3vw, 2.35rem); font-weight:700; color:#fff; margin-top:8px;">
        People shaping {{ $cityName }} and beyond.
      </h2>
      <p style="font-size:0.95rem; color:var(--text-muted); max-width:680px; margin:8px auto 0;">
        Explore established professionals, creators, entrepreneurs, artists, athletes and changemakers whose work deserves a place in the city’s permanent record.
      </p>
    </div>

    <div class="rm-container">
      @php
        $iconsList = $featuredIcons->values();
        // Slots for 2 stacked left + 1 tall center + 2 stacked right
        $leftTop = $iconsList->get(0);
        $centerTall = $iconsList->get(1) ?? $iconsList->get(0);
        $rightTop = $iconsList->get(2);
        $leftBottom = $iconsList->get(3);
        $rightBottom = $iconsList->get(4);
      @endphp

      <div class="rm-tiles-2">
        <!-- Slot 1: Left Top -->
        @if($leftTop)
          <a href="{{ url('/person/' . ($leftTop->slug ?: $leftTop->id)) }}" class="tile-card">
            <img src="{{ $leftTop->portrait_image ?: $leftTop->cover_image }}" alt="{{ $leftTop->name }}" class="tile-card-img" loading="lazy">
            <div class="tile-card-overlay"></div>
            <div class="tile-card-body">
              <span class="cat-italic">{{ $leftTop->category ? $leftTop->category->name : 'Lifestyle' }}</span>
              <h3 class="tile-title">{{ $leftTop->name }}</h3>
            </div>
          </a>
        @endif

        <!-- Slot 2: Center Tall Dominant Card -->
        @if($centerTall)
          <a href="{{ url('/person/' . ($centerTall->slug ?: $centerTall->id)) }}" class="tile-card tile-tall">
            <img src="{{ $centerTall->portrait_image ?: $centerTall->cover_image }}" alt="{{ $centerTall->name }}" class="tile-card-img" loading="lazy">
            <div class="tile-card-overlay"></div>
            <div class="tile-card-body">
              <span class="cat-italic">{{ $centerTall->category ? $centerTall->category->name : 'Style' }}</span>
              <h3 class="tile-title">{{ $centerTall->tagline ?? $centerTall->name }}</h3>
              <span class="btn-pill">View Post</span>
            </div>
          </a>
        @endif

        <!-- Slot 3: Right Top -->
        @if($rightTop)
          <a href="{{ url('/person/' . ($rightTop->slug ?: $rightTop->id)) }}" class="tile-card">
            <img src="{{ $rightTop->portrait_image ?: $rightTop->cover_image }}" alt="{{ $rightTop->name }}" class="tile-card-img" loading="lazy">
            <div class="tile-card-overlay"></div>
            <div class="tile-card-body">
              <span class="cat-italic">{{ $rightTop->category ? $rightTop->category->name : 'Interior' }}</span>
              <h3 class="tile-title">{{ $rightTop->name }}</h3>
            </div>
          </a>
        @endif

        <!-- Slot 4: Left Bottom -->
        @if($leftBottom)
          <a href="{{ url('/person/' . ($leftBottom->slug ?: $leftBottom->id)) }}" class="tile-card">
            <img src="{{ $leftBottom->portrait_image ?: $leftBottom->cover_image }}" alt="{{ $leftBottom->name }}" class="tile-card-img" loading="lazy">
            <div class="tile-card-overlay"></div>
            <div class="tile-card-body">
              <span class="cat-italic">{{ $leftBottom->category ? $leftBottom->category->name : 'Heritage' }}</span>
              <h3 class="tile-title">{{ $leftBottom->name }}</h3>
            </div>
          </a>
        @endif

        <!-- Slot 5: Right Bottom -->
        @if($rightBottom)
          <a href="{{ url('/person/' . ($rightBottom->slug ?: $rightBottom->id)) }}" class="tile-card">
            <img src="{{ $rightBottom->portrait_image ?: $rightBottom->cover_image }}" alt="{{ $rightBottom->name }}" class="tile-card-img" loading="lazy">
            <div class="tile-card-overlay"></div>
            <div class="tile-card-body">
              <span class="cat-italic">{{ $rightBottom->category ? $rightBottom->category->name : 'Design' }}</span>
              <h3 class="tile-title">{{ $rightBottom->name }}</h3>
            </div>
          </a>
        @endif
      </div>

      <div style="text-align:center; margin-top:36px;">
        <a href="{{ url('/' . $cityId . '/icons') }}" class="btn-pill" style="padding:10px 32px; font-size:0.82rem; background:#2c2c2c;">
          Explore All Icons &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       4. RISING TALENT (Tiles Style 1: 1 Tall Left + 4 Right in a 2x2 Grid)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-rising" style="padding:50px 0; background:#181818; border-top:1px solid rgba(255,255,255,0.06); border-bottom:1px solid rgba(255,255,255,0.06);">
    <div class="section-head">
      <span class="section-head-title">{{ strtoupper($cityName) }} · RISING TALENT</span>
      <h2 style="font-family:var(--font-sans); font-size:clamp(1.75rem, 3vw, 2.35rem); font-weight:700; color:#fff; margin-top:8px;">
        The names building what comes next.
      </h2>
      <p style="font-size:0.95rem; color:var(--text-muted); max-width:680px; margin:8px auto 0;">
        Rising documents emerging individuals with genuine achievement, credible potential and a growing body of work.
      </p>
    </div>

    <div class="rm-container">
      @php
        $risingList = $risingPeople->values();
        $tallLeft = $risingList->get(0);
        $gridRight = $risingList->slice(1, 4);
      @endphp

      <div class="rm-tiles-1">
        <!-- 1 Tall Left -->
        @if($tallLeft)
          <a href="{{ url('/person/' . ($tallLeft->slug ?: $tallLeft->id)) }}" class="tile-card tile-tall">
            <img src="{{ $tallLeft->portrait_image ?: $tallLeft->cover_image }}" alt="{{ $tallLeft->name }}" class="tile-card-img" loading="lazy">
            <div class="tile-card-overlay"></div>
            <div class="tile-card-body">
              <span class="cat-italic">{{ $tallLeft->category ? $tallLeft->category->name : 'Lifestyle' }}</span>
              <h3 class="tile-title">{{ $tallLeft->tagline ?? $tallLeft->name }}</h3>
              <span class="btn-pill">View Post</span>
            </div>
          </a>
        @endif

        <!-- 4 Right in 2x2 Grid -->
        @foreach($gridRight as $person)
          <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="tile-card">
            <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="tile-card-img" loading="lazy">
            <div class="tile-card-overlay"></div>
            <div class="tile-card-body">
              <span class="cat-italic">{{ $person->category ? $person->category->name : 'Style' }}</span>
              <h4 class="tile-title">{{ $person->name }}</h4>
            </div>
          </a>
        @endforeach
      </div>

      <div style="text-align:center; margin-top:36px;">
        <a href="{{ url('/' . $cityId . '/rising') }}" class="btn-pill" style="padding:10px 32px; font-size:0.82rem; background:#2c2c2c;">
          Discover Rising &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       5. EDITORIAL STORIES (Tiles Style 3: 2 Asymmetric Top + 3 Equal Bottom)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-stories" style="padding:50px 0;">
    <div class="section-head">
      <span class="section-head-title">{{ strtoupper($cityName) }} · EDITORIAL FEATURES</span>
      <h2 style="font-family:var(--font-sans); font-size:clamp(1.75rem, 3vw, 2.35rem); font-weight:700; color:#fff; margin-top:8px;">
        The complete story beyond the headline.
      </h2>
      <p style="font-size:0.95rem; color:var(--text-muted); max-width:680px; margin:8px auto 0;">
        Explore profiles, interviews, city stories and editorial features documenting meaningful work and defining journeys.
      </p>
    </div>

    <div class="rm-container">
      @if($stories && $stories->count() > 0)
        @php
          $storiesList = $stories->values();
          $topStories = $storiesList->slice(0, 2);
          $bottomStories = $storiesList->slice(2, 3);
        @endphp

        <!-- Top Asymmetric Grid (60/40) -->
        <div class="rm-tiles-3-top">
          @foreach($topStories as $story)
            <a href="{{ url('/article/' . $story->id) }}" class="tile-card">
              <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="tile-card-img" loading="lazy">
              <div class="tile-card-overlay"></div>
              <div class="tile-card-body">
                <span class="cat-italic">{{ $story->category ? $story->category->name : 'Editorial' }}</span>
                <h3 class="tile-title" style="font-size:1.45rem;">{{ $story->title }}</h3>
              </div>
            </a>
          @endforeach
        </div>

        <!-- Bottom Equal Grid (3 Columns) -->
        <div class="rm-tiles-3-bottom">
          @foreach($bottomStories as $story)
            <a href="{{ url('/article/' . $story->id) }}" class="tile-card">
              <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="tile-card-img" loading="lazy">
              <div class="tile-card-overlay"></div>
              <div class="tile-card-body">
                <span class="cat-italic">{{ $story->category ? $story->category->name : 'Feature' }}</span>
                <h4 class="tile-title" style="font-size:1.15rem;">{{ $story->title }}</h4>
              </div>
            </a>
          @endforeach
        </div>
      @endif

      <div style="text-align:center; margin-top:36px;">
        <a href="{{ url('/' . $cityId . '/stories') }}" class="btn-pill" style="padding:10px 32px; font-size:0.82rem; background:#2c2c2c;">
          Explore Stories &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       6. THE LIST (Signature Blog Split Stream with Diamond Bullet ❖ & Inline Share)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-the-list" style="padding:50px 0; background:#181818; border-top:1px solid rgba(255,255,255,0.06); border-bottom:1px solid rgba(255,255,255,0.06);">
    <div class="section-head">
      <span class="section-head-title">{{ strtoupper($cityName) }} · MONTHLY ARCHIVE</span>
      <h2 style="font-family:var(--font-sans); font-size:clamp(1.75rem, 3vw, 2.35rem); font-weight:700; color:#fff; margin-top:8px;">
        A month in people and stories.
      </h2>
      <p style="font-size:0.95rem; color:var(--text-muted); max-width:680px; margin:8px auto 0;">
        The List is a monthly archive of selected profiles published by {{ $cityName }} Icons. Names are presented alphabetically. It is not a ranking, competition or award.
      </p>
    </div>

    <div class="rm-container-blog">
      <div class="rm-blog-stream">
        @foreach($listPeople as $person)
          <article class="rm-blog-card">
            <!-- Left: Image Box with Video/Play Badge -->
            <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-blog-media" aria-label="{{ $person->name }}">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" loading="lazy">
              <span class="rm-media-badge"><i class="fas fa-play"></i></span>
            </a>

            <!-- Right: Content Box -->
            <div class="rm-blog-content">
              <div>
                <span class="cat-italic">{{ $person->category ? $person->category->name : 'Lifestyle' }}</span>
                <h3 class="rm-blog-title">
                  <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}">{{ $person->name }}</a>
                </h3>
                <div class="rm-blog-excerpt">
                  <span class="bullet">❖</span>
                  <span>
                    {{ $person->bio_summary ?: ($person->profession . ' in ' . $cityName . ' documenting verified achievement and lasting contribution to the permanent record.') }}
                  </span>
                </div>
              </div>

              <div>
                <!-- Share Links -->
                <div class="post-share-inline">
                  <span class="share-txt">Share &rarr;</span>
                  <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url('/person/' . ($person->slug ?: $person->id))) }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                  <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/person/' . ($person->slug ?: $person->id))) }}" target="_blank" rel="noopener" aria-label="Share on X"><i class="fab fa-x-twitter"></i></a>
                  <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url('/person/' . ($person->slug ?: $person->id))) }}" target="_blank" rel="noopener" aria-label="Share on Pinterest"><i class="fab fa-pinterest-p"></i></a>
                </div>

                <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="btn-pill">
                  View Post
                </a>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align:center; margin-top:20px;">
        <a href="{{ url('/' . $cityId . '/the-list') }}" class="btn-pill" style="padding:10px 32px; font-size:0.82rem; background:#2c2c2c;">
          View The List &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       7. MAGAZINE (Curated Editorial Digital Edition)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-magazine" style="padding:60px 0;">
    <div class="rm-container">
      <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:clamp(32px, 5vw, 48px); border-radius:4px;">
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:40px; align-items:center;">
          
          <!-- Magazine 3D Cover Mockup -->
          <div style="text-align:center;">
            <img src="{{ $magazine && $magazine->cover_image ? $magazine->cover_image : asset('images/magazine-cover-sample.jpg') }}" 
                 alt="{{ $cityName }} Magazine" 
                 style="max-width:320px; width:100%; border-radius:4px; box-shadow:0 18px 40px rgba(0,0,0,0.6); margin:0 auto; display:block;">
          </div>

          <!-- Magazine Editorial Copy -->
          <div>
            <span class="cat-italic" style="color:var(--vogue-red); font-size:1.15rem; margin-bottom:12px;">Curated Editorial Edition</span>
            <h2 style="font-family:var(--font-sans); font-size:clamp(1.9rem, 3.4vw, 2.75rem); font-weight:700; color:#ffffff; line-height:1.2; margin-bottom:14px;">
              Stories designed to last beyond the feed.
            </h2>
            <p style="font-family:var(--font-sans); font-size:1.05rem; color:var(--text-muted); line-height:1.65; margin-bottom:20px;">
              Selected profiles, verified journeys and defining stories presented through a curated editorial edition.
            </p>

            @if($magazine)
              <div style="margin-bottom:24px; padding:12px 18px; background:rgba(255,255,255,0.05); border-left:3px solid var(--vogue-red); border-radius:0 3px 3px 0;">
                <div style="font-family:var(--font-sans); font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:#fff;">
                  {{ $magazine->title }} · {{ $magazine->month_name ?? date('F') }} {{ $magazine->year ?? date('Y') }}
                </div>
                <div style="font-size:0.85rem; color:var(--text-muted); margin-top:4px;">{{ $magazine->description }}</div>
              </div>
            @endif

            <a href="{{ url('/' . $cityId . '/magazine') }}" class="btn-pill" style="padding:12px 32px; font-size:0.82rem; background:var(--vogue-red);">
              Read the Magazine &rarr;
            </a>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       8. IN [CITY] (Grid Style 4: 3x2 Vertical Cards with Share Footers)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-in-city" style="padding:50px 0; background:#181818; border-top:1px solid rgba(255,255,255,0.06); border-bottom:1px solid rgba(255,255,255,0.06);">
    <div class="section-head">
      <span class="section-head-title">IN {{ strtoupper($cityName) }} · LIVING CULTURE</span>
      <h2 style="font-family:var(--font-sans); font-size:clamp(1.75rem, 3vw, 2.35rem); font-weight:700; color:#fff; margin-top:8px;">
        The city, as it happens.
      </h2>
      <p style="font-size:0.95rem; color:var(--text-muted); max-width:680px; margin:8px auto 0;">
        Selective coverage of notable events, performances, exhibitions, conversations and cultural moments across {{ $cityName }}.
      </p>
    </div>

    <div class="rm-container">
      <div class="rm-grid-cards">
        @foreach($inCityStories as $art)
          <a href="{{ url('/article/' . $art->id) }}" class="rm-grid-card">
            <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" class="rm-grid-card-img" loading="lazy">
            <div class="rm-grid-card-overlay"></div>
            <div class="rm-grid-card-body">
              <span class="cat-italic">{{ $art->category ? $art->category->name : 'Culture' }}</span>
              <h3 class="rm-grid-card-title">{{ $art->title }}</h3>
              <div class="post-share-inline">
                <span class="share-txt">Share &rarr;</span>
                <span style="color:var(--text-muted);"><i class="fab fa-facebook-f"></i></span>
                <span style="color:var(--text-muted);"><i class="fab fa-x-twitter"></i></span>
                <span style="color:var(--text-muted);"><i class="fab fa-pinterest-p"></i></span>
              </div>
            </div>
          </a>
        @endforeach
      </div>

      <div style="text-align:center; margin-top:36px;">
        <a href="{{ url('/' . $cityId . '/in-' . $cityId) }}" class="btn-pill" style="padding:10px 32px; font-size:0.82rem; background:#2c2c2c;">
          Explore In {{ $cityName }} &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       9. FEATURED BRANDS (Commercial Features & Collaborations)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-featured-brands" style="padding:60px 0;">
    <div class="rm-container">
      <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:20px; margin-bottom:32px; border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:20px;">
        <div style="max-width:800px;">
          <span style="display:inline-block; font-family:var(--font-sans); font-size:0.625rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:var(--vogue-red); color:#fff; padding:3px 10px; border-radius:2px; margin-bottom:10px;">
            FEATURED BRANDS · PAID PARTNERSHIP
          </span>
          <h3 style="font-family:var(--font-sans); font-size:clamp(1.6rem, 2.6vw, 2.1rem); font-weight:700; color:#ffffff; margin-bottom:8px;">
            Credible brands. Clearly disclosed collaborations.
          </h3>
          <p style="font-size:0.95rem; color:var(--text-muted); line-height:1.6; margin-bottom:6px;">
            Explore clearly disclosed commercial features and collaborations produced with participating brands, businesses, institutions and organisations.
          </p>
          <p style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-red); margin:0;">
            Commercial participation does not influence selection for Icons or Rising.
          </p>
        </div>

        <div style="display:flex; gap:12px; flex-wrap:wrap;">
          <a href="{{ url('/' . $cityId . '/featured-brands') }}" class="btn-pill" style="background:#2c2c2c; margin-top:0;">
            Explore Featured Brands
          </a>
          <a href="{{ url('/' . $cityId . '/featured-brands#advertise') }}" class="btn-pill" style="background:#ffffff; color:#000000; margin-top:0;">
            Advertise With Us
          </a>
        </div>
      </div>

      @if($brands && $brands->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
          @foreach($brands as $b)
            <div style="background:#242424; border:1px solid rgba(255,255,255,0.06); padding:24px; border-radius:4px; display:flex; flex-direction:column; justify-content:space-between;">
              <div>
                <span style="font-size:0.65rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-red);">
                  {{ $b->disclosure_text ?? 'PARTNER CONTENT' }}
                </span>
                <h4 style="font-family:var(--font-sans); font-size:1.25rem; font-weight:700; margin:6px 0 10px; color:#ffffff;">
                  {{ $b->name }}
                </h4>
                <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.5; margin-bottom:14px;">
                  {{ $b->description }}
                </p>
              </div>
              <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:12px;">
                <a href="{{ $b->website_url ?? url('/' . $cityId . '/featured-brands') }}" target="_blank" rel="noopener" style="font-size:0.75rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#ffffff; text-decoration:underline;">
                  Visit Brand &rarr;
                </a>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       10. NOMINATION (High-Contrast Editorial Callout Banner)
       ════════════════════════════════════════════════════════════ -->
  <section id="sec-nomination" style="padding-bottom:50px;">
    <div class="rm-container">
      <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:clamp(32px, 5vw, 48px); border-radius:4px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:24px;">
        <div style="max-width:760px;">
          <span class="cat-italic" style="color:var(--vogue-red); font-size:1.1rem; margin-bottom:10px;">Editorial Consideration</span>
          <h2 style="font-family:var(--font-sans); font-size:clamp(1.9rem, 3.2vw, 2.5rem); font-weight:700; line-height:1.2; margin-bottom:12px; color:#ffffff;">
            Know a story worth documenting?
          </h2>
          <p style="font-size:1.05rem; line-height:1.6; color:var(--text-muted); margin-bottom:10px;">
            Nominate yourself or someone whose work, journey or contribution deserves editorial consideration. Every nomination is independently reviewed.
          </p>
          <p style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:var(--text-dim); margin:0;">
            Submission does not guarantee selection or publication.
          </p>
        </div>

        <div>
          <a href="{{ url('/' . $cityId . '/nominate') }}" class="btn-pill" style="font-size:0.82rem; padding:14px 34px; background:var(--vogue-red);">
            Submit a Nomination
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ════════════════════════════════════════════════════════════
       11. CLOSING MANIFESTO
       ════════════════════════════════════════════════════════════ -->
  <section style="padding:30px 0 60px;">
    <div class="rm-container">
      <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:40px; text-align:center;">
        <div style="font-family:var(--font-italic-cat); font-style:italic; font-size:clamp(1.8rem, 3vw, 2.5rem); color:#ffffff; line-height:1.25; margin-bottom:6px;">
          Not every story needs attention.
        </div>
        <div style="font-family:var(--font-sans); font-size:clamp(1.5rem, 2.5vw, 2.1rem); font-weight:700; color:var(--vogue-red); line-height:1.25; margin-bottom:16px;">
          Some deserve permanence.
        </div>
        <p style="font-size:1rem; color:var(--text-muted); max-width:680px; margin:0 auto 12px; line-height:1.6;">
          {{ $cityName }} Icons documents the people helping shape the identity and future of the city.
        </p>
        <div style="font-size:0.75rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--text-dim);">
          Selected with purpose. Documented with responsibility
        </div>
      </div>
    </div>
  </section>

</x-layouts.app>
