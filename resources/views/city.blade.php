@php
  $cityId = is_object($city) ? $city->slug : ($city ?? 'bhavnagar');
  $cityName = is_object($city) ? $city->name : ucfirst($cityId);
  $isFlagship = ($cityId === 'bhavnagar');
  $heroCover = ($heroArticle && $heroArticle->cover_image)
    ? $heroArticle->cover_image
    : ($city && is_object($city) && $city->hero_image ? $city->hero_image : 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85');
  $pageTitle = $cityName . ' Icons — ' . ($isFlagship ? 'Flagship Edition' : 'City Edition') . ' · CITYICONS';
@endphp

<x-layouts.app :title="$pageTitle" :city="$city" activeCity="city-home">

  <!-- ══ 1. REAL MOMENTS HERO FEATURED SLIDER ════════════════════ -->
  <section class="rm-hero-wrap">
    <div class="vogue-container">
      <div class="rm-hero-slider" id="rm-hero-slider">

        <!-- Slide 1: Main City Edition Featured Showcase -->
        <div class="rm-hero-slide is-active">
          <img src="{{ $heroCover }}" alt="{{ $cityName }}, Documented." class="rm-hero-slide__bg" loading="eager">
          <div class="rm-hero-slide__overlay"></div>
          <div class="rm-hero-slide__content">
            <span class="rm-badge">
              {{ strtoupper($cityName) }} ICONS · {{ $isFlagship ? 'FLAGSHIP EDITION' : 'CITY EDITION' }}
            </span>
            <h1 class="rm-hero-slide__title">{{ $cityName }}, Documented.</h1>
            <p class="rm-hero-slide__dek">Stories of the people, journeys and ideas shaping the city.</p>
            <div class="rm-hero-slide__meta">
              <span>Selected with purpose. Documented with responsibility.</span>
            </div>
            <div class="rm-hero-slide__actions">
              <a href="{{ url('/' . $cityId . '/icons') }}" class="rm-btn-accent">
                Explore Icons &rarr;
              </a>
              <a href="{{ url('/' . $cityId . '/nominate') }}" class="rm-btn-ghost">
                Nominate a Story
              </a>
            </div>
          </div>
        </div>

        <!-- Additional Featured Slides from City Stories -->
        @if(isset($heroSlides) && $heroSlides->count() > 0)
          @foreach($heroSlides as $slide)
            <div class="rm-hero-slide">
              <img src="{{ $slide->cover_image ?: $heroCover }}" alt="{{ $slide->title }}" class="rm-hero-slide__bg" loading="lazy">
              <div class="rm-hero-slide__overlay"></div>
              <div class="rm-hero-slide__content">
                <span class="rm-badge rm-badge--dark">
                  {{ $slide->category ? strtoupper($slide->category->name) : 'FEATURED STORY' }} · {{ strtoupper($cityName) }}
                </span>
                <h2 class="rm-hero-slide__title">{{ $slide->title }}</h2>
                @if($slide->excerpt)
                  <p class="rm-hero-slide__dek">{{ Str::limit($slide->excerpt, 140) }}</p>
                @endif
                <div class="rm-hero-slide__meta">
                  <span>By {{ $slide->author_name ?? 'Editorial Desk' }}</span>
                  <span>·</span>
                  <span>{{ $slide->read_time ?? '5 min read' }}</span>
                  <span>·</span>
                  <span>{{ $slide->published_at ? $slide->published_at->format('M d, Y') : 'Recent Dispatch' }}</span>
                </div>
                <div class="rm-hero-slide__actions">
                  <a href="{{ url('/article/' . $slide->id) }}" class="rm-btn-accent">
                    Read Complete Story &rarr;
                  </a>
                  <a href="{{ url('/' . $cityId . '/stories') }}" class="rm-btn-ghost">
                    All City Stories
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        @endif

        <!-- Slide Navigation Arrows (Desktop) -->
        <button class="rm-slider-btn rm-slider-btn--prev" id="rm-slide-prev" aria-label="Previous Slide">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="rm-slider-btn rm-slider-btn--next" id="rm-slide-next" aria-label="Next Slide">
          <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slide Pagination Dots -->
        <div class="rm-slider-dots">
          <button class="rm-slider-dot is-active" aria-label="Slide 1"></button>
          @if(isset($heroSlides))
            @foreach($heroSlides as $idx => $s)
              <button class="rm-slider-dot" aria-label="Slide {{ $idx + 2 }}"></button>
            @endforeach
          @endif
        </div>

      </div>
    </div>
  </section>

  <!-- ══ 2. EDITORIAL MANIFESTO (REAL MOMENTS INTRO) ════════════ -->
  <section style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <div style="background:var(--rm-light); border:1px solid var(--rm-border); padding:clamp(32px, 5vw, 56px) clamp(24px, 4vw, 64px); border-radius:3px; text-align:center;">
        <span class="rm-heading-eyebrow" style="margin-bottom:12px;">EDITORIAL MANIFESTO</span>
        <h2 style="font-family:var(--rm-font-serif); font-size:clamp(2rem, 3.8vw, 3rem); font-weight:500; color:var(--rm-dark); margin-bottom:14px; line-height:1.2;">
          A city is shaped by its people.
        </h2>
        <p style="font-family:var(--rm-font-sans); font-size:1.15rem; color:var(--rm-gray); max-width:820px; margin:0 auto 12px; line-height:1.65;">
          {{ $cityName }} Icons is an independent editorial platform documenting credible people, meaningful journeys and lasting contributions connected to {{ $cityName }}.
        </p>
        <p style="font-family:var(--rm-font-serif); font-style:italic; font-size:1.15rem; color:var(--vogue-red); margin:0;">
          We focus on evidence, context and impact, not popularity alone.
        </p>
      </div>
    </div>
  </section>

  <!-- ══ 3. FEATURED ICONS (REAL MOMENTS 4-COL PORTRAIT GRID) ════ -->
  <section class="city-edition-section" id="sec-featured-icons" style="margin-bottom:var(--section-gap);">
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

      <!-- 4-Column Portrait Grid -->
      <div class="rm-portrait-grid">
        @foreach($featuredIcons as $person)
          <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-portrait-card">
            <div class="rm-portrait-card__media">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="rm-portrait-card__img" loading="lazy">
              <span class="rm-portrait-card__badge">
                {{ $person->category ? $person->category->name : 'ICON' }}
              </span>
            </div>
            <div class="rm-portrait-card__body">
              <h3 class="rm-portrait-card__title">{{ $person->name }}</h3>
              <p class="rm-portrait-card__meta">
                {{ $person->profession ?? ($person->organization ?: 'Established Contributor') }}
              </p>
            </div>
          </a>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/icons') }}" class="vogue-btn-outline">
          Explore All Icons &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 4. RISING (REAL MOMENTS 4-COL SPOTLIGHT GRID) ═══════════ -->
  <section class="city-edition-section" id="sec-rising" style="margin-bottom:var(--section-gap); background:var(--rm-light); padding:56px 0; border-top:1px solid var(--rm-border); border-bottom:1px solid var(--rm-border);">
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

      <!-- 4-Column Portrait Grid -->
      <div class="rm-portrait-grid">
        @foreach($risingPeople as $person)
          <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-portrait-card" style="background:#ffffff; border:1px solid var(--rm-border); border-radius:3px; padding-bottom:16px;">
            <div class="rm-portrait-card__media" style="border-radius:3px 3px 0 0;">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="rm-portrait-card__img" loading="lazy">
              <span class="rm-portrait-card__badge" style="background:var(--vogue-red);">
                {{ $person->category ? $person->category->name : 'RISING' }}
              </span>
            </div>
            <div class="rm-portrait-card__body" style="padding:14px 16px 0;">
              <h3 class="rm-portrait-card__title">{{ $person->name }}</h3>
              <p class="rm-portrait-card__meta">
                {{ $person->profession ?? 'Emerging Innovator' }}
              </p>
            </div>
          </a>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/rising') }}" class="vogue-btn-outline">
          Discover Rising &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 5. EDITORIAL STORIES (REAL MOMENTS "TILES-6" COLLAGE) ═══ -->
  <section class="city-edition-section" id="sec-stories" style="margin-bottom:var(--section-gap);">
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

        <!-- Real Moments Signature Tiles-6 Collage -->
        <div class="rm-tiles-collage">
          
          <!-- Left: Large Lead Featured Story -->
          @if($leadStory)
            <a href="{{ url('/article/' . $leadStory->id) }}" class="rm-tile-lead">
              <div class="rm-tile-lead__media">
                <img src="{{ $leadStory->cover_image }}" alt="{{ $leadStory->title }}" class="rm-tile-lead__img" loading="lazy">
                <span class="rm-portrait-card__badge">
                  {{ $leadStory->category ? $leadStory->category->name : 'LEAD STORY' }}
                </span>
              </div>
              <div class="rm-tile-lead__body">
                <div>
                  <h3 class="rm-tile-lead__title">{{ $leadStory->title }}</h3>
                  <p class="rm-tile-lead__excerpt">
                    {{ Str::limit($leadStory->excerpt ?: strip_tags($leadStory->body ?? $leadStory->content), 180) }}
                  </p>
                </div>
                <div class="rm-tile-lead__footer">
                  <span>By {{ $leadStory->author_name ?? 'Editorial Desk' }}</span>
                  <span style="color:var(--vogue-red); font-weight:700;">Read Story &rarr;</span>
                </div>
              </div>
            </a>
          @endif

          <!-- Right: Stack of Secondary Stories -->
          <div class="rm-tiles-stack">
            @foreach($stackStories as $story)
              <a href="{{ url('/article/' . $story->id) }}" class="rm-tile-card">
                <div class="rm-tile-card__media">
                  <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="rm-tile-card__img" loading="lazy">
                </div>
                <div class="rm-tile-card__body">
                  <span class="rm-heading-eyebrow" style="font-size:0.625rem; margin-bottom:2px;">
                    {{ $story->category ? $story->category->name : 'STORY' }}
                  </span>
                  <h4 class="rm-tile-card__title">{{ $story->title }}</h4>
                  <div class="rm-tile-card__meta">
                    {{ $story->author_name ?? 'Staff' }} · {{ $story->read_time ?? '5 min' }}
                  </div>
                </div>
              </a>
            @endforeach
          </div>

        </div>
      @endif

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/stories') }}" class="vogue-btn-outline">
          Explore Stories &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 6. THE LIST (REAL MOMENTS MONTHLY ARCHIVE) ══════════════ -->
  <section class="city-edition-section" id="sec-the-list" style="margin-bottom:var(--section-gap);">
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

      <!-- Real Moments Alphabetical Index Grid -->
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
            <i class="fas fa-chevron-right" style="margin-left:auto; font-size:10px; color:var(--vogue-muted);"></i>
          </a>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/the-list') }}" class="vogue-btn-outline">
          View The List &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 7. MAGAZINE (REAL MOMENTS CURATED SPREAD) ═══════════════ -->
  <section class="city-edition-section" id="sec-magazine">
    <div class="vogue-container">
      <div class="rm-magazine-spread">
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

  <!-- ══ 8. IN [CITY] (REAL MOMENTS 3-COLUMN VISUAL STREAM) ══════ -->
  <section class="city-edition-section" id="sec-in-city" style="margin-bottom:var(--section-gap);">
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
          <a href="{{ url('/article/' . $art->id) }}" class="rm-stream-card">
            <div class="rm-stream-card__media">
              <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" class="rm-stream-card__img" loading="lazy">
              <span class="rm-portrait-card__badge">
                {{ $art->category ? $art->category->name : 'MOMENT' }}
              </span>
            </div>
            <div class="rm-stream-card__body">
              <div>
                <h3 class="rm-stream-card__title">{{ $art->title }}</h3>
                <p class="rm-stream-card__desc">
                  {{ Str::limit($art->excerpt ?: strip_tags($art->body ?? $art->content), 110) }}
                </p>
              </div>
              <div class="rm-stream-card__footer">
                <span>By {{ $art->author_name ?? 'Editorial Desk' }}</span>
                <span>·</span>
                <span>{{ $art->published_at ? $art->published_at->format('M d') : 'Recent' }}</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/in-' . $cityId) }}" class="vogue-btn-outline">
          Explore In {{ $cityName }} &rarr;
        </a>
      </div>

    </div>
  </section>

  <!-- ══ 9. FEATURED BRANDS (REAL MOMENTS PARTNERSHIPS) ══════════ -->
  <section class="city-edition-section" id="sec-featured-brands" style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Editorial Disclosure Header -->
      <div class="rm-brands-disclosure">
        <div style="max-width:820px;">
          <span style="display:inline-block; font-family:var(--rm-font-meta); font-size:0.625rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:var(--rm-dark); color:#fff; padding:3px 10px; border-radius:2px; margin-bottom:10px;">
            FEATURED BRAND · PAID PARTNERSHIP
          </span>
          <h3 style="font-family:var(--rm-font-serif); font-size:clamp(1.6rem, 2.8vw, 2.2rem); font-weight:500; margin-bottom:8px; color:var(--rm-dark);">
            Credible brands. Clearly disclosed collaborations.
          </h3>
          <p style="font-family:var(--rm-font-sans); font-size:1.05rem; color:var(--rm-gray); line-height:1.55; margin-bottom:8px;">
            Explore clearly disclosed commercial features and collaborations produced with participating brands, businesses, institutions and organisations.
          </p>
          <p style="font-family:var(--rm-font-meta); font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-red); margin:0;">
            Commercial participation does not influence selection for Icons or Rising.
          </p>
        </div>

        <div style="display:flex; gap:12px; flex-wrap:wrap;">
          <a href="{{ url('/' . $cityId . '/featured-brands') }}" class="vogue-btn-outline">
            Explore Featured Brands
          </a>
          <a href="{{ url('/' . $cityId . '/featured-brands#advertise') }}" class="vogue-btn-solid">
            Advertise With Us
          </a>
        </div>
      </div>

      @if($brands && $brands->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
          @foreach($brands as $b)
            <div style="background:#fff; border:1px solid var(--rm-border); padding:24px; border-radius:3px; display:flex; flex-direction:column; justify-content:space-between;">
              <div>
                <span class="rm-heading-eyebrow" style="font-size:0.65rem; color:var(--vogue-muted);">
                  {{ $b->disclosure_text ?? 'PARTNER CONTENT' }}
                </span>
                <h4 style="font-family:var(--rm-font-serif); font-size:1.35rem; font-weight:600; margin:6px 0 10px; color:var(--rm-dark);">{{ $b->name }}</h4>
                <p style="font-family:var(--rm-font-sans); font-size:0.95rem; color:var(--rm-gray); line-height:1.5; margin-bottom:14px;">{{ $b->description }}</p>
              </div>
              <div style="border-top:1px solid #f0f0f0; padding-top:12px;">
                <a href="{{ $b->website_url ?? url('/' . $cityId . '/featured-brands') }}" target="_blank" rel="noopener" style="font-family:var(--rm-font-meta); font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--rm-dark); text-decoration:underline;">
                  Visit Brand &rarr;
                </a>
              </div>
            </div>
          @endforeach
        </div>
      @endif

    </div>
  </section>

  <!-- ══ 10. NOMINATION (REAL MOMENTS SUBMISSION BANNER) ═════════ -->
  <section class="city-edition-section" id="sec-nomination">
    <div class="vogue-container">
      <div class="rm-nomination-banner">
        <div>
          <span class="rm-badge" style="background:var(--vogue-red); margin-bottom:12px;">EDITORIAL CONSIDERATION</span>
          <h2 style="font-family:var(--rm-font-serif); font-size:clamp(1.9rem, 3.2vw, 2.75rem); font-weight:500; line-height:1.2; margin-bottom:14px; color:#ffffff;">
            Know a story worth documenting?
          </h2>
          <p style="font-family:var(--rm-font-sans); font-size:1.1rem; line-height:1.6; color:rgba(255,255,255,0.85); margin-bottom:12px;">
            Nominate yourself or someone whose work, journey or contribution deserves editorial consideration. Every nomination is independently reviewed.
          </p>
          <p style="font-family:var(--rm-font-meta); font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.5); margin:0;">
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

  <!-- ══ 11. CLOSING (REAL MOMENTS EDITORIAL MANIFESTO) ══════════ -->
  <section class="city-edition-section">
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
