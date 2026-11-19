@php
  $cityId = is_object($city) ? $city->slug : ($city ?? 'bhavnagar');
  $cityName = is_object($city) ? $city->name : ucfirst($cityId);
  $isFlagship = ($cityId === 'bhavnagar');
  $heroSlides = $heroSlides ?? collect();
  $cultureStories = $cultureStories ?? collect();
  $culinaryStories = $culinaryStories ?? collect();
  $fashionStories = $fashionStories ?? collect();
  $people = $people ?? collect();
  $blogStories = $blogStories ?? collect();
  $pageTitle = $cityName . ' Icons — ' . ($isFlagship ? 'Flagship Edition' : 'City Edition') . ' · CITYICONS';
@endphp

<x-layouts.app :title="$pageTitle" :city="$city" activeCity="city-home">

  <!-- ══ 1. HERO CAROUSEL SLIDER SHOWCASE ══════════════════════ -->
  <section class="city-home-section" style="padding-top:24px; padding-bottom:12px;">
    <div class="vogue-container">
      <div class="city-hero-slider" id="city-hero-slider">
        @forelse($heroSlides as $idx => $slide)
          <div class="city-hero-slide {{ $idx === 0 ? 'active' : '' }}" style="background-image: url('{{ $slide->cover_image ?: 'https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1600&q=85' }}');" data-index="{{ $idx }}">
            <div class="city-hero-overlay"></div>
            <div class="city-hero-content">
              <span class="vogue-rubric vogue-rubric--red" style="color:#ff5252; margin-bottom:8px; display:inline-block;">
                {{ strtoupper($slide->category ? $slide->category->name : ($cityName . ' FEATURE STORY')) }} · {{ $isFlagship ? 'FLAGSHIP EDITION' : 'CITY EDITION' }}
              </span>
              <h1 class="city-hero-title">{{ $slide->title }}</h1>
              <p class="city-hero-excerpt">
                {{ Str::limit($slide->excerpt ?: strip_tags($slide->content), 170) }}
              </p>
              <a href="{{ url('/article/' . $slide->id) }}" class="city-hero-btn">
                Read Story &rarr;
              </a>
            </div>
          </div>
        @empty
          <div class="city-hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1600&q=85');">
            <div class="city-hero-overlay"></div>
            <div class="city-hero-content">
              <span class="vogue-rubric vogue-rubric--red" style="color:#ff5252; margin-bottom:8px; display:inline-block;">
                {{ strtoupper($cityName) }} EDITORIAL · CITY EDITION
              </span>
              <h1 class="city-hero-title">Documenting Life, Culture, and Stories in {{ $cityName }}</h1>
              <p class="city-hero-excerpt">
                Explore long-form profiles, cultural narratives, city stories and editorial features documenting meaningful work and defining moments.
              </p>
              <a href="{{ url('/' . $cityId . '/stories') }}" class="city-hero-btn">
                Explore Stories &rarr;
              </a>
            </div>
          </div>
        @endforelse

        <!-- Side Navigation Arrows -->
        @if($heroSlides->count() > 1)
          <button class="city-hero-arrow prev" id="hero-arrow-prev" aria-label="Previous slide">&#10094;</button>
          <button class="city-hero-arrow next" id="hero-arrow-next" aria-label="Next slide">&#10095;</button>
          <div class="city-hero-dots" id="hero-dots">
            @foreach($heroSlides as $i => $s)
              <div class="city-hero-dot {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}"></div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- ══ 2. SECTION 1: CULTURE & HERITAGE (Tiles Style 1: 1 Tall Left + 4 Right 2x2) ══ -->
  <section class="city-home-section" id="sec-culture">
    <div class="vogue-container">
      <div class="city-home-head">
        <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · CULTURE &amp; HERITAGE</span>
        <h2 class="city-home-head__hed">Culture &amp; Heritage</h2>
        <p class="city-home-head__dek">
          Timeless traditions, living arts, and architectural treasures of {{ $cityName }}.
        </p>
      </div>

      <div class="city-tiles-1">
        @foreach($cultureStories->take(5) as $idx => $story)
          <div class="city-tile-card {{ $idx === 0 ? 'city-tile-tall' : '' }}" onclick="location.href='{{ url('/article/' . $story->id) }}'">
            <img class="city-tile-card__img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
            <div class="city-tile-card__overlay"></div>
            <div class="city-tile-card__body">
              <div class="city-tile-card__rubric">{{ $story->category->name ?? 'Culture' }}</div>
              @if($idx === 0)
                <h3 class="city-tile-card__title">{{ $story->title }}</h3>
                <p style="font-family:var(--font-garamond); font-size:1.05rem; line-height:1.45; color:rgba(255,255,255,0.85); margin:8px 0 14px;">
                  {{ Str::limit($story->excerpt ?: strip_tags($story->content), 120) }}
                </p>
                <span class="city-hero-btn" style="padding:8px 18px; font-size:0.6875rem;">Read Story &rarr;</span>
              @else
                <h4 class="city-tile-card__title">{{ $story->title }}</h4>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      <div style="text-align:right; margin-top:16px;">
        <a href="{{ url('/' . $cityId . '/stories?category=culture') }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
          Explore More Culture &amp; Heritage &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 3. SECTION 2: CULINARY & TASTE (Tiles Style 2: 2 Left + 1 Center Tall + 2 Right) ══ -->
  <section class="city-home-section city-home-section--alt" id="sec-culinary">
    <div class="vogue-container">
      <div class="city-home-head">
        <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · CULINARY &amp; TASTE</span>
        <h2 class="city-home-head__hed">Culinary &amp; Taste</h2>
        <p class="city-home-head__dek">
          Generational flavors, iconic local fare, and defining dining culture in {{ $cityName }}.
        </p>
      </div>

      <div class="city-tiles-2">
        @foreach($culinaryStories->take(5) as $idx => $story)
          {{-- Index 2 is the 3rd child, which spans 2 rows in the center column --}}
          <div class="city-tile-card {{ $idx === 2 ? 'city-tile-tall' : '' }}" onclick="location.href='{{ url('/article/' . $story->id) }}'">
            <img class="city-tile-card__img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
            <div class="city-tile-card__overlay"></div>
            <div class="city-tile-card__body">
              <div class="city-tile-card__rubric">{{ $story->category->name ?? 'Taste' }}</div>
              @if($idx === 2)
                <h3 class="city-tile-card__title">{{ $story->title }}</h3>
                <p style="font-family:var(--font-garamond); font-size:1.05rem; line-height:1.45; color:rgba(255,255,255,0.85); margin:8px 0 14px;">
                  {{ Str::limit($story->excerpt ?: strip_tags($story->content), 120) }}
                </p>
                <span class="city-hero-btn" style="padding:8px 18px; font-size:0.6875rem;">Read Story &rarr;</span>
              @else
                <h4 class="city-tile-card__title">{{ $story->title }}</h4>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      <div style="text-align:right; margin-top:16px;">
        <a href="{{ url('/' . $cityId . '/stories?category=food') }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
          Explore More Food &amp; Dining &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 4. SECTION 3: FASHION, CRAFT & LIVING (Tiles Style 3: 2 Top Asymmetric + 3 Equal Bottom) ══ -->
  <section class="city-home-section" id="sec-fashion">
    <div class="vogue-container">
      <div class="city-home-head">
        <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · FASHION &amp; LIVING CRAFT</span>
        <h2 class="city-home-head__hed">Fashion, Craft &amp; Living</h2>
        <p class="city-home-head__dek">
          Artisanal legacies, contemporary fashion, and modern lifestyles in {{ $cityName }}.
        </p>
      </div>

      <div class="city-tiles-3-top">
        @foreach($fashionStories->take(2) as $story)
          <div class="city-tile-card" onclick="location.href='{{ url('/article/' . $story->id) }}'">
            <img class="city-tile-card__img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
            <div class="city-tile-card__overlay"></div>
            <div class="city-tile-card__body">
              <div class="city-tile-card__rubric">{{ $story->category->name ?? 'Fashion' }}</div>
              <h3 class="city-tile-card__title">{{ $story->title }}</h3>
            </div>
          </div>
        @endforeach
      </div>

      <div class="city-tiles-3-bottom">
        @foreach($fashionStories->skip(2)->take(3) as $story)
          <div class="city-tile-card" onclick="location.href='{{ url('/article/' . $story->id) }}'">
            <img class="city-tile-card__img" src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
            <div class="city-tile-card__overlay"></div>
            <div class="city-tile-card__body">
              <div class="city-tile-card__rubric">{{ $story->category->name ?? 'Craft' }}</div>
              <h4 class="city-tile-card__title">{{ $story->title }}</h4>
            </div>
          </div>
        @endforeach
      </div>

      <div style="text-align:right; margin-top:16px;">
        <a href="{{ url('/' . $cityId . '/stories?category=fashion') }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
          Explore Fashion &amp; Living Archive &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 5. SECTION 4: DOCUMENTED CITIZENS & ICONS (3x2 Grid) ═════ -->
  <section class="city-home-section city-home-section--alt" id="sec-people">
    <div class="vogue-container">
      <div class="city-home-head">
        <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · DOCUMENTED CITIZENS</span>
        <h2 class="city-home-head__hed">{{ $cityName }} Icons &amp; Notable People</h2>
        <p class="city-home-head__dek">
          Documenting individuals shaping {{ $cityName }}'s cultural, business, and civic life. Selection based on verifiable achievement; recognition cannot be purchased.
        </p>
      </div>

      <div class="city-people-grid">
        @foreach($people->take(6) as $person)
          @php $pUrl = url('/person/' . ($person->slug ?: $person->id)); @endphp
          <article class="city-person-card" onclick="location.href='{{ $pUrl }}'">
            <div class="city-person-card__img-wrap">
              <img class="city-person-card__img" src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" loading="lazy">
            </div>
            <div class="city-person-card__body">
              <div>
                <span class="vogue-rubric vogue-rubric--red">{{ $person->category ? $person->category->name : 'ICON' }}</span>
                <h3 class="city-person-card__name">{{ $person->name }}</h3>
                <div class="city-person-card__profession">{{ $person->profession ?? ($person->organization ? $person->organization : 'Featured Citizen') }}</div>
              </div>
              <div class="city-share-inline">
                <span>Share &rarr;</span>
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode($pUrl) }}" target="_blank" rel="noopener" onclick="event.stopPropagation();">Facebook</a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($pUrl) }}" target="_blank" rel="noopener" onclick="event.stopPropagation();">X</a>
                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode($pUrl) }}" target="_blank" rel="noopener" onclick="event.stopPropagation();">Pinterest</a>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align:center; margin-top:36px;">
        <a href="{{ url('/' . $cityId . '/icons') }}" style="display:inline-block; border:1px solid var(--vogue-black); color:var(--vogue-black); font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px 32px; text-decoration:none; transition:all 0.2s ease;">
          View All {{ $cityName }} Icons &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 6. SECTION 5: RECENT EDITORIAL DISPATCHES (50/50 Horizontal Stream) ══ -->
  <section class="city-home-section" id="sec-dispatches">
    <div class="vogue-container">
      <div class="city-home-head">
        <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · EDITORIAL DISPATCHES</span>
        <h2 class="city-home-head__hed">Recent City Dispatches</h2>
        <p class="city-home-head__dek">
          Latest reportage, features, and stories from across {{ $cityName }}.
        </p>
      </div>

      <div class="city-dispatches-stream">
        @foreach($blogStories->take(4) as $art)
          <article class="city-dispatch-card">
            <div class="city-dispatch-media" onclick="location.href='{{ url('/article/' . $art->id) }}'">
              <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" loading="lazy">
              <div class="city-dispatch-badge"><i class="fas fa-video"></i></div>
            </div>
            <div class="city-dispatch-content">
              <div>
                <span class="vogue-rubric vogue-rubric--red">{{ $art->category->name ?? 'Dispatch' }}</span>
                <h3 class="city-dispatch-title"><a href="{{ url('/article/' . $art->id) }}">{{ $art->title }}</a></h3>
                <p class="city-dispatch-excerpt">
                  <span style="color:var(--vogue-red); margin-right:6px;">&#10070;</span>
                  {{ Str::limit($art->excerpt ?: strip_tags($art->content), 150) }}
                </p>
                <a href="{{ url('/article/' . $art->id) }}" style="display:inline-block; font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
                  Read Full Story &rarr;
                </a>
              </div>
              <div class="city-share-inline" style="margin-top:16px;">
                <span>Share &rarr;</span>
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url('/article/' . $art->id)) }}" target="_blank" rel="noopener">Facebook</a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/article/' . $art->id)) }}&text={{ urlencode($art->title) }}" target="_blank" rel="noopener">X</a>
                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url('/article/' . $art->id)) }}" target="_blank" rel="noopener">Pinterest</a>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align:center; margin-top:36px;">
        <a href="{{ url('/' . $cityId . '/stories') }}" style="display:inline-block; background:var(--vogue-black); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px 32px; text-decoration:none; transition:all 0.2s ease;">
          Explore All {{ $cityName }} Stories &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 7. OFFICIAL NOMINATION CTA ═════════════════════════════ -->
  <x-nomination-cta />

  @push('scripts')
  <script>
    // Hero Slider Carousel
    (function () {
      const slides = document.querySelectorAll('.city-hero-slide');
      const dots = document.querySelectorAll('.city-hero-dot');
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
      if (slides.length > 1) {
        setInterval(() => show((current + 1) % slides.length), 6000);
      }
    })();
  </script>
  @endpush

</x-layouts.app>
