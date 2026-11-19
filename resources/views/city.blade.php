@php
  $cityId = is_object($city) ? $city->slug : ($city ?? 'bhavnagar');
  $cityName = is_object($city) ? $city->name : ucfirst($cityId);
  $isFlagship = ($cityId === 'bhavnagar');
  $heroCover = ($heroArticle && $heroArticle->cover_image)
    ? $heroArticle->cover_image
    : 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85';
  $pageTitle = $cityName . ' Icons — ' . ($isFlagship ? 'Flagship Edition' : 'City Edition') . ' · CITYICONS';
@endphp

<x-layouts.app :title="$pageTitle" :city="$city" activeCity="city-home">

  <!-- ══ 1. HERO ════════════════════════════════════════════════ -->
  <section class="hero-section-wrap" style="padding-top:20px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <div class="hero-big-banner" id="hero-banner">
        
        <!-- Cover Image with Balanced Proportions -->
        <div class="hero-big-banner__img-wrap" onclick="location.href='{{ url('/' . $cityId . '/icons') }}'" style="cursor:pointer;">
          <img src="{{ $heroCover }}" alt="{{ $cityName }}, Documented." loading="eager">
          <div class="hero-big-banner__top-shade"></div>
          <div class="hero-big-banner__brand-stamp">{{ strtoupper($cityName) }} ICONS</div>
          <div class="hero-big-banner__bottom-shade"></div>

          <!-- Main headline INSIDE the image at the bottom -->
          <div class="hero-big-banner__content-overlay">
            <div class="hero-big-banner__content-box">
              <h1 class="hero-big-banner__hed">{{ $cityName }}, Documented.</h1>
            </div>
          </div>
        </div>

        <!-- Description and Actions Below Image -->
        <div class="hero-big-banner__details">
          <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} ICONS · {{ $isFlagship ? 'FLAGSHIP EDITION' : 'CITY EDITION' }}</span>
          <p class="hero-big-banner__dek">Stories of the people, journeys and ideas shaping the city.</p>
          <p style="font-family:var(--font-garamond); font-style:italic; font-size:1.15rem; color:var(--vogue-muted); margin-bottom:18px;">
            Selected with purpose. Documented with responsibility.
          </p>

          <!-- Action Buttons -->
          <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:16px;">
            <a href="{{ url('/' . $cityId . '/icons') }}" class="vogue-btn-solid">
              Explore Icons &rarr;
            </a>
            <a href="{{ url('/' . $cityId . '/nominate') }}" class="vogue-btn-red">
              Nominate a Story
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ══ 2. INTRODUCTION ════════════════════════════════════════ -->
  <x-editorial-intro
    rubric="EDITORIAL MANIFESTO"
    title="A city is shaped by its people."
    lead="{{ $cityName }} Icons is an independent editorial platform documenting credible people, meaningful journeys and lasting contributions connected to {{ $cityName }}."
    tagline="We focus on evidence, context and impact, not popularity alone."
  />

  <!-- ══ 3. FEATURED ICONS ══════════════════════════════════════ -->
  <section class="city-edition-section" id="sec-featured-icons" style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <div class="section-hed-bar" style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <div>
          <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · FEATURED ICONS</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(2rem, 3.8vw, 3rem); font-weight:400; line-height:1.15; margin:6px 0 8px;">
            People shaping {{ $cityName }} and beyond.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#555; max-width:850px; line-height:1.5;">
            Explore established professionals, creators, entrepreneurs, artists, athletes and changemakers whose work deserves a place in the city’s permanent record.
          </p>
        </div>
      </div>

      <div class="vogue-4col-grid" style="margin-bottom:28px;">
        @foreach($featuredIcons as $person)
          <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/person/' . ($person->slug ?: $person->id)) }}'">
            <div class="vogue-card__img-wrap" style="aspect-ratio:4/5;">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" loading="lazy" style="object-fit:cover !important;">
            </div>
            <div class="vogue-card__body" style="padding-top:12px;">
              <span class="vogue-rubric vogue-rubric--red">{{ $person->category ? $person->category->name : 'ICON' }}</span>
              <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.2rem; font-weight:600; line-height:1.25; margin:4px 0 6px;">{{ $person->name }}</h3>
              <div class="vogue-card__byline" style="font-size:0.8rem; color:var(--vogue-muted);">{{ $person->profession ?? ($person->organization ?: 'Established Contributor') }}</div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/icons') }}" class="vogue-btn-outline">
          Explore All Icons &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 4. RISING ══════════════════════════════════════════════ -->
  <section class="city-edition-section" id="sec-rising" style="margin-bottom:var(--section-gap); background:var(--vogue-bg-light); padding:48px 0; border-top:1px solid var(--vogue-border); border-bottom:1px solid var(--vogue-border);">
    <div class="vogue-container">
      <div class="section-hed-bar" style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <div>
          <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · RISING TALENT</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(2rem, 3.8vw, 3rem); font-weight:400; line-height:1.15; margin:6px 0 8px;">
            The names building what comes next.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#555; max-width:850px; line-height:1.5;">
            Rising documents emerging individuals with genuine achievement, credible potential and a growing body of work.
          </p>
        </div>
      </div>

      <div class="vogue-4col-grid" style="margin-bottom:28px;">
        @foreach($risingPeople as $person)
          <article class="vogue-card" style="cursor:pointer; background:#fff; border:1px solid var(--vogue-border); padding-bottom:14px;" onclick="location.href='{{ url('/person/' . ($person->slug ?: $person->id)) }}'">
            <div class="vogue-card__img-wrap" style="aspect-ratio:4/5;">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" loading="lazy" style="object-fit:cover !important;">
            </div>
            <div class="vogue-card__body" style="padding:12px 14px 0;">
              <span class="vogue-rubric vogue-rubric--red">{{ $person->category ? $person->category->name : 'RISING' }}</span>
              <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.2rem; font-weight:600; line-height:1.25; margin:4px 0 6px;">{{ $person->name }}</h3>
              <div class="vogue-card__byline" style="font-size:0.8rem; color:var(--vogue-muted);">{{ $person->profession ?? 'Emerging Innovator' }}</div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/rising') }}" class="vogue-btn-outline">
          Discover Rising &rarr;
        </a>
      </div>
    </div>
  </section>



  <!-- ══ 6. STORIES ═════════════════════════════════════════════ -->
  <section class="city-edition-section" id="sec-stories" style="margin-bottom:var(--section-gap); background:var(--vogue-bg-light); padding:48px 0; border-top:1px solid var(--vogue-border); border-bottom:1px solid var(--vogue-border);">
    <div class="vogue-container">
      <div class="section-hed-bar" style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <div>
          <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · EDITORIAL FEATURES</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(2rem, 3.8vw, 3rem); font-weight:400; line-height:1.15; margin:6px 0 8px;">
            The complete story beyond the headline.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#555; max-width:850px; line-height:1.5;">
            Explore profiles, interviews, city stories and editorial features documenting meaningful work and defining journeys.
          </p>
        </div>
      </div>

      <div class="vogue-4col-grid" style="margin-bottom:28px;">
        @foreach($stories as $story)
          <article class="vogue-card" style="cursor:pointer; background:#fff; border:1px solid var(--vogue-border); padding-bottom:14px;" onclick="location.href='{{ url('/article/' . $story->id) }}'">
            <div class="vogue-card__img-wrap">
              <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" loading="lazy">
            </div>
            <div class="vogue-card__body" style="padding:12px 14px 0;">
              <span class="vogue-rubric vogue-rubric--red">{{ $story->category ? $story->category->name : 'STORY' }}</span>
              <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">{{ $story->title }}</h3>
              <p style="font-family:var(--font-garamond); font-size:0.95rem; color:#555; line-height:1.4; margin-bottom:8px;">
                {{ Str::limit($story->excerpt ?: strip_tags($story->content), 90) }}
              </p>
              <div class="vogue-card__byline" style="font-size:0.75rem; color:var(--vogue-muted);">
                By {{ $story->author_name ?? 'Editorial Staff' }} · {{ $story->read_time ?? '5 min' }}
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/stories') }}" class="vogue-btn-outline">
          Explore Stories &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 7. THE LIST ════════════════════════════════════════════ -->
  <section class="city-edition-section" id="sec-the-list" style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <div class="section-hed-bar" style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <div>
          <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($cityName) }} · MONTHLY ARCHIVE</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(2rem, 3.8vw, 3rem); font-weight:400; line-height:1.15; margin:6px 0 8px;">
            A month in people and stories.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#555; max-width:850px; line-height:1.5;">
            The List is a monthly archive of selected profiles published by {{ $cityName }} Icons. Names are presented alphabetically. It is not a ranking, competition or award.
          </p>
        </div>
      </div>

      <!-- Alphabetical Table / Grid Preview -->
      <div style="background:#fff; border:1px solid var(--vogue-border); padding:24px 28px; margin-bottom:28px;">
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:18px;">
          @foreach($listPeople as $person)
            <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" style="display:flex; align-items:center; gap:14px; padding:10px 12px; border-bottom:1px solid #f0f0f0; text-decoration:none; color:inherit; transition:background 0.2s ease;">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" style="width:48px; height:48px; border-radius:50%; object-fit:cover;">
              <div>
                <div style="font-family:var(--font-didot); font-size:1.05rem; font-weight:600; color:var(--vogue-black);">{{ $person->name }}</div>
                <div style="font-size:0.75rem; color:var(--vogue-muted);">{{ $person->profession }} · <span style="color:var(--vogue-red);">{{ $person->category ? $person->category->name : 'ICON' }}</span></div>
              </div>
            </a>
          @endforeach
        </div>
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/the-list') }}" class="vogue-btn-outline">
          View The List &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 8. MAGAZINE ════════════════════════════════════════════ -->
  <section class="city-edition-section" id="sec-magazine" style="margin-bottom:var(--section-gap); background:var(--vogue-black); color:#ffffff; padding:56px 0;">
    <div class="vogue-container">
      <div style="display:grid; grid-template-columns:1fr 1.3fr; gap:48px; align-items:center;">
        <!-- Magazine Cover Preview -->
        <div style="text-align:center;">
          <img src="{{ $magazine && $magazine->cover_image ? $magazine->cover_image : asset('images/magazine-cover-sample.jpg') }}" alt="{{ $cityName }} Magazine" style="max-height:460px; width:auto; margin:0 auto; box-shadow:0 12px 36px rgba(0,0,0,0.5); border:1px solid rgba(255,255,255,0.15);">
        </div>

        <!-- Magazine Editorial Details -->
        <div>
          <span class="vogue-rubric vogue-rubric--red" style="color:var(--vogue-red); letter-spacing:2.5px; margin-bottom:12px;">CURATED EDITORIAL EDITION</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(2.2rem, 3.8vw, 3.2rem); font-weight:400; line-height:1.15; margin-bottom:12px; color:#ffffff;">
            Stories designed to last beyond the feed.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.2rem; line-height:1.6; color:rgba(255,255,255,0.85); margin-bottom:20px;">
            Selected profiles, verified journeys and defining stories presented through a curated editorial edition.
          </p>
          @if($magazine)
            <div style="margin-bottom:24px; padding:14px 18px; background:rgba(255,255,255,0.06); border-left:3px solid var(--vogue-red);">
              <div style="font-family:var(--font-sans); font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:#fff;">
                {{ $magazine->title }} · {{ $magazine->month_name }} {{ $magazine->year }}
              </div>
              <div style="font-size:0.85rem; color:rgba(255,255,255,0.7); margin-top:4px;">{{ $magazine->description }}</div>
            </div>
          @endif
          <a href="{{ url('/' . $cityId . '/magazine') }}" class="vogue-btn-red">
            Read the Magazine &rarr;
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ 9. IN BHAVNAGAR / IN [CITY] ════════════════════════════ -->
  <section class="city-edition-section" id="sec-in-city" style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <div class="section-hed-bar" style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <div>
          <span class="vogue-rubric vogue-rubric--red">IN {{ strtoupper($cityName) }} · LIVING CULTURE</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(2rem, 3.8vw, 3rem); font-weight:400; line-height:1.15; margin:6px 0 8px;">
            The city, as it happens.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#555; max-width:850px; line-height:1.5;">
            Selective coverage of notable events, performances, exhibitions, conversations and cultural moments across {{ $cityName }}.
          </p>
        </div>
      </div>

      <div class="vogue-4col-grid" style="margin-bottom:28px;">
        @foreach($inCityStories as $art)
          <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
            <div class="vogue-card__img-wrap">
              <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" loading="lazy">
            </div>
            <div class="vogue-card__body" style="padding-top:12px;">
              <span class="vogue-rubric vogue-rubric--red">{{ $art->category ? $art->category->name : 'MOMENT' }}</span>
              <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">{{ $art->title }}</h3>
              <p style="font-family:var(--font-garamond); font-size:0.95rem; color:#555; line-height:1.4; margin-bottom:8px;">
                {{ Str::limit($art->excerpt ?: strip_tags($art->content), 90) }}
              </p>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align:center;">
        <a href="{{ url('/' . $cityId . '/in-' . $cityId) }}" class="vogue-btn-outline">
          Explore In {{ $cityName }} &rarr;
        </a>
      </div>
    </div>
  </section>

  <!-- ══ 10. FEATURED BRANDS ════════════════════════════════════ -->
  <section class="city-edition-section" id="sec-featured-brands" style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <!-- Editorial Disclosure Header -->
      <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:32px 36px; margin-bottom:28px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:24px;">
        <div style="max-width:820px;">
          <span style="display:inline-block; font-size:0.625rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:var(--vogue-black); color:#fff; padding:3px 10px; margin-bottom:10px;">
            FEATURED BRAND · PAID PARTNERSHIP
          </span>
          <h3 style="font-family:var(--font-didot); font-size:clamp(1.5rem, 2.8vw, 2.2rem); font-weight:400; margin-bottom:8px;">
            Credible brands. Clearly disclosed collaborations.
          </h3>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444444; line-height:1.55; margin-bottom:8px;">
            Explore clearly disclosed commercial features and collaborations produced with participating brands, businesses, institutions and organisations.
          </p>
          <p style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-red);">
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
            <div style="background:#fff; border:1px solid var(--vogue-border); padding:24px; border-radius:3px; display:flex; flex-direction:column; justify-content:space-between;">
              <div>
                <span class="vogue-rubric" style="font-size:0.65rem; color:var(--vogue-muted);">{{ $b->disclosure_text ?? 'PARTNER CONTENT' }}</span>
                <h4 style="font-family:var(--font-didot); font-size:1.25rem; font-weight:600; margin:6px 0 10px;">{{ $b->name }}</h4>
                <p style="font-family:var(--font-garamond); font-size:1rem; color:#555; line-height:1.5; margin-bottom:14px;">{{ $b->description }}</p>
              </div>
              <div style="border-top:1px solid #f0f0f0; padding-top:12px;">
                <a href="{{ $b->website_url ?? url('/' . $cityId . '/featured-brands') }}" target="_blank" rel="noopener" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
                  Visit Brand &rarr;
                </a>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <!-- ══ 11. NOMINATION ═════════════════════════════════════════ -->
  <section class="city-edition-section" id="sec-nomination" style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <div style="background:var(--vogue-black); color:#ffffff; padding:clamp(40px, 6vw, 64px) clamp(24px, 4vw, 56px); display:grid; grid-template-columns:1.4fr 1fr; gap:36px; align-items:center;">
        <div>
          <span class="vogue-rubric" style="color:var(--vogue-red); letter-spacing:2.5px; margin-bottom:12px;">EDITORIAL CONSIDERATION</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(1.8rem, 3.2vw, 2.7rem); font-weight:400; line-height:1.2; margin-bottom:14px; color:#ffffff;">
            Know a story worth documenting?
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; line-height:1.6; color:rgba(255,255,255,0.85); margin-bottom:12px;">
            Nominate yourself or someone whose work, journey or contribution deserves editorial consideration. Every nomination is independently reviewed.
          </p>
          <p style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.5);">
            Submission does not guarantee selection or publication.
          </p>
        </div>

        <div style="text-align:right;">
          <a href="{{ url('/' . $cityId . '/nominate') }}" class="vogue-btn-red" style="font-size:0.8rem; padding:16px 36px;">
            Submit a Nomination
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ 12. CLOSING ════════════════════════════════════════════ -->
  <section class="city-edition-section" style="margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      <div style="border-top:1px solid var(--vogue-border); border-bottom:1px solid var(--vogue-border); padding:56px clamp(20px, 4vw, 60px); text-align:center;">
        <div style="font-family:var(--font-didot); font-size:clamp(2rem, 3.5vw, 3.2rem); font-weight:400; line-height:1.2; color:var(--vogue-black); margin-bottom:8px;">
          Not every story needs attention.
        </div>
        <div style="font-family:var(--font-didot); font-size:clamp(2rem, 3.5vw, 3.2rem); font-style:italic; font-weight:400; line-height:1.2; color:var(--vogue-red); margin-bottom:20px;">
          Some deserve permanence.
        </div>
        <p style="font-family:var(--font-garamond); font-size:1.25rem; color:#333333; max-width:700px; margin:0 auto 14px;">
          {{ $cityName }} Icons documents the people helping shape the identity and future of the city.
        </p>
        <div style="font-family:var(--font-sans); font-size:0.75rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-muted);">
          Selected with purpose. Documented with responsibility
        </div>
      </div>
    </div>
  </section>

</x-layouts.app>
