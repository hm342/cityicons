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

  <!-- ══ 1. EXACT IMAGE 1: TRANSPARENT FLOATING HEADER & FULLSCREEN HERO ══ -->
  <section class="rm-hero-fullscreen" id="rm-hero-fullscreen">

    <!-- Transparent Floating Navigation Header (Image 1) -->
    <header class="rm-floating-header" id="rm-floating-header">
      <div class="rm-header-grid">
        <!-- Left: Hamburger Menu Icon -->
        <div class="rm-header-left">
          <button class="rm-header-burger" id="btn-open-drawer" aria-label="Open Navigation Menu">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>

        <!-- Center: Logo & Horizontal Navigation Links -->
        <div class="rm-header-center">
          <a href="{{ url('/' . $cityId) }}" class="rm-header-logo" aria-label="{{ $cityName }} Icons">
            <span class="rm-header-logo__main">{{ strtolower($cityName) }}</span>
            <span class="rm-header-logo__script">Icons</span>
            <span class="rm-header-logo__tag">· {{ $isFlagship ? 'Flagship' : 'City' }}</span>
          </a>

          <!-- Main Nav Links -->
          <ul class="rm-header-nav">
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
        </div>

        <!-- Right: Action Button & Search Icon -->
        <div class="rm-header-right">
          <a href="{{ url('/' . $cityId . '/nominate') }}" class="rm-header-pill-btn">
            Nominate
          </a>
          <button class="rm-header-search-btn" id="btn-open-search" aria-label="Search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </header>

    <!-- Carousel Slides Container -->
    <!-- Slide 1: Main Flagship Showcase -->
    <div class="rm-hero-slide is-active">
      <img src="{{ $heroCover }}" alt="{{ $cityName }}, Documented." class="rm-hero-slide__bg" loading="eager">
      <div class="rm-hero-slide__overlay"></div>
      <div class="rm-hero-caption">
        <span class="rm-hero-rubric">
          <em>{{ $isFlagship ? 'Flagship Edition' : 'City Edition' }}</em>
        </span>
        <h1 class="rm-hero-hed">
          {{ $heroArticle ? $heroArticle->title : $cityName . ', Documented.' }}
        </h1>
        <a href="{{ $heroArticle ? url('/article/' . $heroArticle->id) : url('/' . $cityId . '/icons') }}" class="rm-hero-pill-btn">
          View Post
        </a>
      </div>
    </div>

    <!-- Additional Slides from City Stories -->
    @if(isset($heroSlides) && $heroSlides->count() > 0)
      @foreach($heroSlides as $slide)
        <div class="rm-hero-slide">
          <img src="{{ $slide->cover_image ?: $heroCover }}" alt="{{ $slide->title }}" class="rm-hero-slide__bg" loading="lazy">
          <div class="rm-hero-slide__overlay"></div>
          <div class="rm-hero-caption">
            <span class="rm-hero-rubric">
              <em>{{ $slide->category ? $slide->category->name : 'Editorial Story' }}</em>
            </span>
            <h2 class="rm-hero-hed">
              {{ $slide->title }}
            </h2>
            <a href="{{ url('/article/' . $slide->id) }}" class="rm-hero-pill-btn">
              View Post
            </a>
          </div>
        </div>
      @endforeach
    @endif

    <!-- Carousel Edge Navigation Controls (Image 1) -->
    <button class="rm-hero-edge-btn rm-hero-edge-btn--prev" id="rm-edge-prev" aria-label="Previous Slide">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button class="rm-hero-edge-btn rm-hero-edge-btn--next" id="rm-edge-next" aria-label="Next Slide">
      <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Bottom-Right 3-Dots Pagination (Image 1) -->
    <div class="rm-hero-dots-wrap">
      <button class="rm-hero-dot-item is-active" aria-label="Slide 1"></button>
      @if(isset($heroSlides))
        @foreach($heroSlides as $idx => $s)
          <button class="rm-hero-dot-item" aria-label="Slide {{ $idx + 2 }}"></button>
        @endforeach
      @endif
    </div>

  </section>

  <!-- ══ 2. EDITORIAL MANIFESTO ══════════════════════════════════ -->
  <section style="padding:64px 0 32px;">
    <div class="vogue-container">
      <div style="background:#1a1a1a; border:1px solid rgba(255,255,255,0.08); padding:clamp(32px, 5vw, 48px) clamp(24px, 4vw, 56px); border-radius:4px; text-align:center;">
        <span class="rm-heading-eyebrow" style="margin-bottom:10px;">EDITORIAL MANIFESTO</span>
        <h2 style="font-family:var(--rm-font-serif); font-size:clamp(1.9rem, 3.4vw, 2.75rem); font-weight:500; color:#ffffff; margin-bottom:12px; line-height:1.2;">
          A city is shaped by its people.
        </h2>
        <p style="font-family:var(--rm-font-sans); font-size:1.1rem; color:rgba(255,255,255,0.7); max-width:820px; margin:0 auto 12px; line-height:1.65;">
          {{ $cityName }} Icons is an independent editorial platform documenting credible people, meaningful journeys and lasting contributions connected to {{ $cityName }}.
        </p>
        <p style="font-family:var(--rm-font-serif); font-style:italic; font-size:1.15rem; color:var(--vogue-red); margin:0;">
          We focus on evidence, context and impact, not popularity alone.
        </p>
      </div>
    </div>
  </section>

  <!-- ══ 3. EXACT IMAGE 2: FEATURED ICONS (3-COLUMN ASYMMETRIC TILES) ═ -->
  <section class="city-edition-section" id="sec-featured-icons" style="padding:40px 0;">
    <div class="vogue-container">
      
      <!-- Section Heading -->
      <div class="rm-section-heading">
        <div>
          <span class="rm-heading-eyebrow">{{ strtoupper($cityName) }} · FEATURED ICONS</span>
          <h2 class="rm-heading-title">People shaping {{ $cityName }} and beyond.</h2>
          <p class="rm-heading-desc">
            Explore established professionals, creators, entrepreneurs, artists, athletes and changemakers whose work deserves a place in the city’s permanent record.
          </p>
        </div>
        <a href="{{ url('/' . $cityId . '/icons') }}" class="rm-heading-link">
          Explore All Icons <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      @php
        $iconsList = $featuredIcons->values();
        $leftIcons = $iconsList->slice(0, 2);
        $centerIcon = $iconsList->get(2) ?? $iconsList->first();
        $rightIcons = $iconsList->slice(3, 2);
        if ($rightIcons->isEmpty() && $iconsList->count() > 1) {
          $rightIcons = $iconsList->slice(1, 2);
        }
      @endphp

      <!-- Image 2 3-Column Asymmetric Tiles Collage -->
      <div class="rm-tiles-3col">

        <!-- Left Column: 2 Stacked Cards -->
        <div class="rm-col-stack">
          @foreach($leftIcons as $person)
            <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-tile-card-dark">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="rm-tile-card-dark__img" loading="lazy">
              <div class="rm-tile-card-dark__overlay"></div>
              <span class="rm-tile-card-dark__rubric">
                <em>{{ $person->category ? $person->category->name : 'Lifestyle' }}</em>
              </span>
              <div class="rm-tile-card-dark__content">
                <h3 class="rm-tile-card-dark__title">{{ $person->name }}</h3>
                <p class="rm-tile-card-dark__meta">{{ $person->profession ?? 'Established Contributor' }}</p>
              </div>
            </a>
          @endforeach
        </div>

        <!-- Center Column: Tall Dominant Featured Card (Image 2) -->
        <div class="rm-col-center">
          @if($centerIcon)
            <a href="{{ url('/person/' . ($centerIcon->slug ?: $centerIcon->id)) }}" class="rm-tile-card-dominant">
              <img src="{{ $centerIcon->portrait_image ?: $centerIcon->cover_image }}" alt="{{ $centerIcon->name }}" class="rm-tile-card-dominant__img" loading="lazy">
              <div class="rm-tile-card-dominant__overlay"></div>
              <span class="rm-tile-card-dominant__rubric">
                <em>{{ $centerIcon->category ? $centerIcon->category->name : 'Style' }}</em>
              </span>
              <div class="rm-tile-card-dominant__content">
                <h3 class="rm-tile-card-dominant__title">{{ $centerIcon->tagline ?? $centerIcon->name }}</h3>
                <span class="rm-tile-pill-btn">View Post</span>
              </div>
            </a>
          @endif
        </div>

        <!-- Right Column: 2 Stacked Cards -->
        <div class="rm-col-stack">
          @foreach($rightIcons as $person)
            <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-tile-card-dark">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="rm-tile-card-dark__img" loading="lazy">
              <div class="rm-tile-card-dark__overlay"></div>
              <span class="rm-tile-card-dark__rubric">
                <em>{{ $person->category ? $person->category->name : 'Interior' }}</em>
              </span>
              <div class="rm-tile-card-dark__content">
                <h3 class="rm-tile-card-dark__title">{{ $person->name }}</h3>
                <p class="rm-tile-card-dark__meta">{{ $person->profession ?? 'Innovator' }}</p>
              </div>
            </a>
          @endforeach
        </div>

      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/icons') }}" class="vogue-btn-outline" style="border-color:rgba(255,255,255,0.25); color:#fff;">
          Explore All Icons &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 4. EXACT IMAGE 3: RISING TALENT (ASYMMETRIC 1 + 4 COLLAGE) ═ -->
  <section class="city-edition-section" id="sec-rising" style="padding:40px 0; background:#111111; border-top:1px solid rgba(255,255,255,0.06); border-bottom:1px solid rgba(255,255,255,0.06);">
    <div class="vogue-container">

      <!-- Section Heading -->
      <div class="rm-section-heading">
        <div>
          <span class="rm-heading-eyebrow">{{ strtoupper($cityName) }} · RISING TALENT</span>
          <h2 class="rm-heading-title">The names building what comes next.</h2>
          <p class="rm-heading-desc">
            Rising documents emerging individuals with genuine achievement, credible potential and a growing body of work.
          </p>
        </div>
        <a href="{{ url('/' . $cityId . '/rising') }}" class="rm-heading-link">
          Discover Rising <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      @php
        $risingList = $risingPeople->values();
        $leadRising = $risingList->first();
        $gridRising = $risingList->slice(1, 4);
      @endphp

      <!-- Image 3 Asymmetric 1 + 4 Collage -->
      <div class="rm-tiles-2col-asym">

        <!-- Left Column: Tall Dominant Featured Card (Image 3) -->
        <div>
          @if($leadRising)
            <a href="{{ url('/person/' . ($leadRising->slug ?: $leadRising->id)) }}" class="rm-tile-card-dominant">
              <img src="{{ $leadRising->portrait_image ?: $leadRising->cover_image }}" alt="{{ $leadRising->name }}" class="rm-tile-card-dominant__img" loading="lazy">
              <div class="rm-tile-card-dominant__overlay"></div>
              <span class="rm-tile-card-dominant__rubric">
                <em>{{ $leadRising->category ? $leadRising->category->name : 'Lifestyle' }}</em>
              </span>
              <div class="rm-tile-card-dominant__content">
                <h3 class="rm-tile-card-dominant__title">{{ $leadRising->tagline ?? $leadRising->name }}</h3>
                <span class="rm-tile-pill-btn">View Post</span>
              </div>
            </a>
          @endif
        </div>

        <!-- Right Column: 2x2 Grid of 4 Cards (Image 3) -->
        <div class="rm-2x2-grid">
          @foreach($gridRising as $person)
            <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-tile-card-dark">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="rm-tile-card-dark__img" loading="lazy">
              <div class="rm-tile-card-dark__overlay"></div>
              <span class="rm-tile-card-dark__rubric">
                <em>{{ $person->category ? $person->category->name : 'Style' }}</em>
              </span>
              <div class="rm-tile-card-dark__content">
                <h4 class="rm-tile-card-dark__title" style="font-size:1.15rem;">{{ $person->name }}</h4>
                <p class="rm-tile-card-dark__meta">{{ $person->profession ?? 'Emerging Innovator' }}</p>
              </div>
            </a>
          @endforeach
        </div>

      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/rising') }}" class="vogue-btn-outline" style="border-color:rgba(255,255,255,0.25); color:#fff;">
          Discover Rising &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 5. EDITORIAL STORIES (TILES COLLAGE IN DARK THEME) ═══════ -->
  <section class="city-edition-section" id="sec-stories" style="padding:40px 0;">
    <div class="vogue-container">

      <!-- Section Heading -->
      <div class="rm-section-heading">
        <div>
          <span class="rm-heading-eyebrow">{{ strtoupper($cityName) }} · EDITORIAL FEATURES</span>
          <h2 class="rm-heading-title">The complete story beyond the headline.</h2>
          <p class="rm-heading-desc">
            Explore profiles, interviews, city stories and editorial features documenting meaningful work and defining journeys.
          </p>
        </div>
        <a href="{{ url('/' . $cityId . '/stories') }}" class="rm-heading-link">
          Explore Stories <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      @if($stories && $stories->count() > 0)
        @php
          $leadStory = $stories->first();
          $stackStories = $stories->slice(1, 3);
        @endphp

        <div class="rm-tiles-collage">
          
          <!-- Left: Dominant Story Tile -->
          @if($leadStory)
            <a href="{{ url('/article/' . $leadStory->id) }}" class="rm-tile-lead" style="background:#181818; border-color:rgba(255,255,255,0.08);">
              <div class="rm-tile-lead__media">
                <img src="{{ $leadStory->cover_image }}" alt="{{ $leadStory->title }}" class="rm-tile-lead__img" loading="lazy">
                <span class="rm-portrait-card__badge" style="background:rgba(0,0,0,0.8);">
                  {{ $leadStory->category ? $leadStory->category->name : 'STORY' }}
                </span>
              </div>
              <div class="rm-tile-lead__body">
                <div>
                  <h3 class="rm-tile-lead__title" style="color:#ffffff;">{{ $leadStory->title }}</h3>
                  <p class="rm-tile-lead__excerpt" style="color:rgba(255,255,255,0.7);">
                    {{ Str::limit($leadStory->excerpt ?: strip_tags($leadStory->body ?? $leadStory->content), 170) }}
                  </p>
                </div>
                <div class="rm-tile-lead__footer" style="border-top-color:rgba(255,255,255,0.08); color:rgba(255,255,255,0.6);">
                  <span>By {{ $leadStory->author_name ?? 'Editorial Desk' }} · {{ $leadStory->read_time ?? '5 min' }}</span>
                  <span style="color:var(--vogue-red); font-weight:700;">Read Story &rarr;</span>
                </div>
              </div>
            </a>
          @endif

          <!-- Right: Secondary Tiles Stack -->
          <div class="rm-tiles-stack">
            @foreach($stackStories as $story)
              <a href="{{ url('/article/' . $story->id) }}" class="rm-tile-card" style="background:#181818; border-color:rgba(255,255,255,0.08);">
                <div class="rm-tile-card__media">
                  <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="rm-tile-card__img" loading="lazy">
                </div>
                <div class="rm-tile-card__body">
                  <span class="rm-heading-eyebrow" style="font-size:0.625rem; margin-bottom:2px;">
                    {{ $story->category ? $story->category->name : 'STORY' }}
                  </span>
                  <h4 class="rm-tile-card__title" style="color:#ffffff;">{{ $story->title }}</h4>
                  <div class="rm-tile-card__meta" style="color:rgba(255,255,255,0.5);">
                    {{ $story->author_name ?? 'Staff' }} · {{ $story->read_time ?? '5 min' }}
                  </div>
                </div>
              </a>
            @endforeach
          </div>

        </div>
      @endif

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/stories') }}" class="vogue-btn-outline" style="border-color:rgba(255,255,255,0.25); color:#fff;">
          Explore Stories &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 6. THE LIST (MONTHLY ARCHIVE IN DARK THEME) ═════════════ -->
  <section class="city-edition-section" id="sec-the-list" style="padding:40px 0;">
    <div class="vogue-container">

      <!-- Section Heading -->
      <div class="rm-section-heading">
        <div>
          <span class="rm-heading-eyebrow">{{ strtoupper($cityName) }} · MONTHLY ARCHIVE</span>
          <h2 class="rm-heading-title">A month in people and stories.</h2>
          <p class="rm-heading-desc">
            The List is a monthly archive of selected profiles published by {{ $cityName }} Icons. Names are presented alphabetically. It is not a ranking, competition or award.
          </p>
        </div>
        <a href="{{ url('/' . $cityId . '/the-list') }}" class="rm-heading-link">
          View The List <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <!-- Real Moments Dark Alpha Grid -->
      <div class="rm-alpha-grid">
        @foreach($listPeople as $person)
          <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-alpha-card">
            <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="rm-alpha-card__avatar">
            <div style="overflow:hidden;">
              <div class="rm-alpha-card__name">{{ $person->name }}</div>
              <div class="rm-alpha-card__role">
                {{ $person->profession }} · <span style="color:var(--vogue-red); font-weight:700;">{{ $person->category ? $person->category->name : 'ICON' }}</span>
              </div>
            </div>
            <i class="fas fa-chevron-right" style="margin-left:auto; font-size:10px; color:rgba(255,255,255,0.35);"></i>
          </a>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/the-list') }}" class="vogue-btn-outline" style="border-color:rgba(255,255,255,0.25); color:#fff;">
          View The List &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 7. MAGAZINE (CURATED EDITORIAL SPREAD) ══════════════════ -->
  <section class="city-edition-section" id="sec-magazine">
    <div class="vogue-container">
      <div class="rm-magazine-spread" style="background:#0e0e0e; border:1px solid rgba(255,255,255,0.06);">
        <div class="vogue-container">
          <div class="rm-magazine-grid">
            
            <!-- 3D Magazine Cover -->
            <div class="rm-magazine-cover-wrap">
              <img src="{{ $magazine && $magazine->cover_image ? $magazine->cover_image : asset('images/magazine-cover-sample.jpg') }}" alt="{{ $cityName }} Magazine" class="rm-magazine-cover">
            </div>

            <!-- Magazine Editorial Manifesto -->
            <div>
              <span class="rm-badge" style="background:var(--vogue-red); margin-bottom:14px;">CURATED EDITORIAL EDITION</span>
              <h2 style="font-family:var(--rm-font-serif); font-size:clamp(2.2rem, 3.8vw, 3.2rem); font-weight:500; line-height:1.15; color:#ffffff; margin-bottom:14px;">
                Stories designed to last beyond the feed.
              </h2>
              <p style="font-family:var(--rm-font-sans); font-size:1.15rem; line-height:1.65; color:rgba(255,255,255,0.85); margin-bottom:22px;">
                Selected profiles, verified journeys and defining stories presented through a curated editorial edition.
              </p>
              @if($magazine)
                <div style="margin-bottom:26px; padding:14px 18px; background:rgba(255,255,255,0.06); border-left:3px solid var(--vogue-red); border-radius:0 3px 3px 0;">
                  <div style="font-family:var(--rm-font-meta); font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:#fff;">
                    {{ $magazine->title }} · {{ $magazine->month_name ?? date('F') }} {{ $magazine->year ?? date('Y') }}
                  </div>
                  <div style="font-size:0.85rem; color:rgba(255,255,255,0.7); margin-top:4px;">{{ $magazine->description }}</div>
                </div>
              @endif
              <a href="{{ url('/' . $cityId . '/magazine') }}" class="rm-btn-accent" style="padding:14px 32px;">
                Read the Magazine &rarr;
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ 8. IN [CITY] (LIVING CULTURE PHOTOJOURNALISM) ═══════════ -->
  <section class="city-edition-section" id="sec-in-city" style="padding:40px 0;">
    <div class="vogue-container">

      <!-- Section Heading -->
      <div class="rm-section-heading">
        <div>
          <span class="rm-heading-eyebrow">IN {{ strtoupper($cityName) }} · LIVING CULTURE</span>
          <h2 class="rm-heading-title">The city, as it happens.</h2>
          <p class="rm-heading-desc">
            Selective coverage of notable events, performances, exhibitions, conversations and cultural moments across {{ $cityName }}.
          </p>
        </div>
        <a href="{{ url('/' . $cityId . '/in-' . $cityId) }}" class="rm-heading-link">
          Explore In {{ $cityName }} <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <!-- 3-Column Stream Grid -->
      <div class="rm-stream-grid">
        @foreach($inCityStories as $art)
          <a href="{{ url('/article/' . $art->id) }}" class="rm-stream-card" style="background:#181818; border-color:rgba(255,255,255,0.08);">
            <div class="rm-stream-card__media">
              <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" class="rm-stream-card__img" loading="lazy">
              <span class="rm-portrait-card__badge">
                {{ $art->category ? $art->category->name : 'MOMENT' }}
              </span>
            </div>
            <div class="rm-stream-card__body">
              <div>
                <h3 class="rm-stream-card__title" style="color:#ffffff;">{{ $art->title }}</h3>
                <p class="rm-stream-card__desc" style="color:rgba(255,255,255,0.7);">
                  {{ Str::limit($art->excerpt ?: strip_tags($art->body ?? $art->content), 110) }}
                </p>
              </div>
              <div class="rm-stream-card__footer" style="border-top-color:rgba(255,255,255,0.07); color:rgba(255,255,255,0.5);">
                <span>By {{ $art->author_name ?? 'Editorial Desk' }}</span>
                <span>·</span>
                <span>{{ $art->published_at ? $art->published_at->format('M d') : 'Recent' }}</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/in-' . $cityId) }}" class="vogue-btn-outline" style="border-color:rgba(255,255,255,0.25); color:#fff;">
          Explore In {{ $cityName }} &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 9. FEATURED BRANDS (COMMERCIAL COLLABORATIONS) ══════════ -->
  <section class="city-edition-section" id="sec-featured-brands" style="padding:40px 0;">
    <div class="vogue-container">
      
      <!-- Editorial Disclosure Header -->
      <div class="rm-brands-disclosure">
        <div style="max-width:820px;">
          <span style="display:inline-block; font-family:var(--rm-font-meta); font-size:0.625rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:var(--vogue-red); color:#fff; padding:3px 10px; border-radius:2px; margin-bottom:10px;">
            FEATURED BRAND · PAID PARTNERSHIP
          </span>
          <h3 style="font-family:var(--rm-font-serif); font-size:clamp(1.6rem, 2.8vw, 2.2rem); font-weight:500; margin-bottom:8px; color:#ffffff;">
            Credible brands. Clearly disclosed collaborations.
          </h3>
          <p style="font-family:var(--rm-font-sans); font-size:1.05rem; color:rgba(255,255,255,0.7); line-height:1.55; margin-bottom:8px;">
            Explore clearly disclosed commercial features and collaborations produced with participating brands, businesses, institutions and organisations.
          </p>
          <p style="font-family:var(--rm-font-meta); font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-red); margin:0;">
            Commercial participation does not influence selection for Icons or Rising.
          </p>
        </div>

        <div style="display:flex; gap:12px; flex-wrap:wrap;">
          <a href="{{ url('/' . $cityId . '/featured-brands') }}" class="vogue-btn-outline" style="border-color:rgba(255,255,255,0.25); color:#fff;">
            Explore Featured Brands
          </a>
          <a href="{{ url('/' . $cityId . '/featured-brands#advertise') }}" class="vogue-btn-solid" style="background:#fff; color:#000;">
            Advertise With Us
          </a>
        </div>
      </div>

      @if($brands && $brands->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
          @foreach($brands as $b)
            <div class="rm-brand-card-dark">
              <div>
                <span class="rm-heading-eyebrow" style="font-size:0.65rem; color:var(--vogue-red);">
                  {{ $b->disclosure_text ?? 'PARTNER CONTENT' }}
                </span>
                <h4 style="font-family:var(--rm-font-serif); font-size:1.35rem; font-weight:600; margin:6px 0 10px; color:#ffffff;">{{ $b->name }}</h4>
                <p style="font-family:var(--rm-font-sans); font-size:0.95rem; color:rgba(255,255,255,0.65); line-height:1.5; margin-bottom:14px;">{{ $b->description }}</p>
              </div>
              <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:12px;">
                <a href="{{ $b->website_url ?? url('/' . $cityId . '/featured-brands') }}" target="_blank" rel="noopener" style="font-family:var(--rm-font-meta); font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:#ffffff; text-decoration:underline;">
                  Visit Brand &rarr;
                </a>
              </div>
            </div>
          @endforeach
        </div>
      @endif

    </div>
  </section>

  <!-- ══ 10. NOMINATION (HIGH-CONTRAST SUBMISSION BANNER) ════════ -->
  <section class="city-edition-section" id="sec-nomination">
    <div class="vogue-container">
      <div class="rm-nomination-banner" style="background:#181818; border:1px solid rgba(255,255,255,0.08);">
        <div>
          <span class="rm-badge" style="background:var(--vogue-red); margin-bottom:12px;">EDITORIAL CONSIDERATION</span>
          <h2 style="font-family:var(--rm-font-serif); font-size:clamp(1.9rem, 3.2vw, 2.75rem); font-weight:500; line-height:1.2; margin-bottom:14px; color:#ffffff;">
            Know a story worth documenting?
          </h2>
          <p style="font-family:var(--rm-font-sans); font-size:1.1rem; line-height:1.6; color:rgba(255,255,255,0.8); margin-bottom:12px;">
            Nominate yourself or someone whose work, journey or contribution deserves editorial consideration. Every nomination is independently reviewed.
          </p>
          <p style="font-family:var(--rm-font-meta); font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.45); margin:0;">
            Submission does not guarantee selection or publication.
          </p>
        </div>

        <div style="text-align:right;">
          <a href="{{ url('/' . $cityId . '/nominate') }}" class="rm-btn-accent" style="font-size:0.8rem; padding:16px 36px;">
            Submit a Nomination
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ 11. CLOSING (SIGNATURE MANIFESTO QUOTE) ═════════════════ -->
  <section class="city-edition-section" style="padding-bottom:20px;">
    <div class="vogue-container">
      <div class="rm-closing-manifesto">
        <div class="rm-closing-hed">
          Not every story needs attention.
        </div>
        <div class="rm-closing-subhed">
          Some deserve permanence.
        </div>
        <p class="rm-closing-dek">
          {{ $cityName }} Icons documents the people helping shape the identity and future of the city.
        </p>
        <div class="rm-closing-tag">
          Selected with purpose. Documented with responsibility
        </div>
      </div>
    </div>
  </section>

</x-layouts.app>
