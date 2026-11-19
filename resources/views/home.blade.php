<x-layouts.app title="CityIcons — India, Documented. Pan-India Editorial Network">

  <!-- ══ 1. HERO (India, Documented) ═════════════════════════════ -->
  <x-hero-banner 
    :cover="$coverArticle" 
    :settings="$settings" 
    title="India, Documented."
    rubric="CITYICONS · ALL-INDIA EDITORIAL NETWORK"
    dek="Documenting the people, journeys and cultural moments shaping India's defining cities."
    signature="Selected with purpose. Documented with responsibility."
    primaryBtnText="Explore Cities Network"
    primaryBtnUrl="#sec-cities"
    secondaryBtnText="Bhavnagar Flagship"
    :secondaryBtnUrl="url('/bhavnagar')"
    tertiaryBtnText="Nominate an Icon"
    :tertiaryBtnUrl="url('/nominate')"
  />

  <!-- ══ 2. EDITORIAL MANIFESTO (Every city has people worth remembering) ══ -->
  <x-editorial-intro 
    title="Every city has people worth remembering."
    rubric="EDITORIAL MANIFESTO"
    lead="CityIcons is an independent pan-India editorial platform documenting credible people, meaningful journeys and lasting contributions across India’s defining cities."
    tagline="We focus on evidence, context and impact, not popularity alone."
  />

  <!-- ══ 3. CITY NEWS CAROUSEL / LATEST DISPATCHES TICKER ════════ -->
  <x-city-news-strip :articles="$newsStrip" />

  <!-- ══ 4. CITIES NETWORK EXPLORER (Direct City Gateway) ════════ -->
  <section id="sec-cities" class="city-edition-section">
    <div class="vogue-container">
      <div class="section-hed-bar" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
        <div style="max-width:850px;">
          <h2 class="section-hed-title" style="margin-bottom:6px;">Cities Network</h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; line-height:1.5; margin:0;">
            Independent city-focused editorial documentation across Indian cities. Select any city to enter its dedicated visual subsite, local dispatches, and permanent record.
          </p>
        </div>
        <a href="{{ url('/bhavnagar') }}" class="section-hed-link" style="flex-shrink:0;">
          <span>Enter Flagship Edition (Bhavnagar)</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="cities-network-grid">
        @foreach($cities as $c)
          @php
            $isFlagship = ($c->slug === 'bhavnagar');
            $cityUrl = url('/' . $c->slug);
            $imgUrl = $c->hero_image ?: 'https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?w=1200&q=80';
          @endphp
          <article class="city-network-card" onclick="location.href='{{ $cityUrl }}'" aria-label="Explore {{ $c->name }} City Subsite">
            <img class="city-network-card__img" src="{{ $imgUrl }}" alt="{{ $c->name }} Editorial Edition" loading="lazy">
            <div class="city-network-card__overlay"></div>

            <div class="city-network-card__badge {{ $isFlagship ? 'city-network-card__badge--flagship' : '' }}">
              <span class="vogue-rubric" style="{{ !$isFlagship ? 'color:#ffffff;' : '' }}">
                {{ $isFlagship ? 'FLAGSHIP EDITION' : 'ACTIVE EDITION' }}
              </span>
            </div>

            <div class="city-network-card__body">
              <span class="city-network-card__state">{{ strtoupper($c->state) }}</span>
              <h3 class="city-network-card__name">{{ $c->name }}</h3>
              <div class="city-network-card__meta">
                {{ $c->people_count ?? 0 }} Documented Icons · {{ $c->articles_count ?? 0 }} Stories
              </div>
              <div class="city-network-card__cta">
                <span>Enter {{ $c->name }} Subsite</span>
                <i class="fas fa-arrow-right"></i>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ══ 5. DOCUMENTED ICONS (People shaping India and beyond) ═══ -->
  <x-city-edition-section 
    city-id="pan-india-icons" 
    title="Documented Icons" 
    subtitle="People shaping India and beyond. Explore established professionals, creators, entrepreneurs, artists and changemakers whose work deserves permanence." 
    button-text="Explore Bhavnagar Icons" 
    explore-url="{{ url('/bhavnagar/icons') }}" 
    :people="$featuredIcons" 
  />

  <!-- ══ 6. CURATED EDITORIAL STORIES ════════════════════════════ -->
  <section id="sec-stories" class="city-edition-section">
    <div class="vogue-container">
      <div class="section-hed-bar" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
        <div style="max-width:850px;">
          <h2 class="section-hed-title" style="margin-bottom:6px;">National Stories</h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; line-height:1.5; margin:0;">
            The complete story, beyond the headline. Explore profiles, cultural narratives, and editorial features across Indian cities.
          </p>
        </div>
        <a href="{{ url('/stories') }}" class="section-hed-link" style="flex-shrink:0;">
          <span>Explore All Stories</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      @if($featuredStories && $featuredStories->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:28px;">
          @foreach($featuredStories as $art)
            <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
              <div class="vogue-card__img-wrap" style="margin-bottom:14px;">
                <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" loading="lazy">
              </div>
              <div style="display:flex; gap:8px; align-items:center; margin-bottom:4px;">
                <span class="vogue-rubric vogue-rubric--red">{{ $art->category ? strtoupper($art->category->name) : 'STORY' }}</span>
                @if($art->city)
                  <span style="font-size:0.625rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-muted);">· {{ $art->city->name }}</span>
                @endif
              </div>
              <h3 style="font-family:var(--font-didot); font-size:1.2rem; font-weight:600; line-height:1.25; margin:4px 0 8px; color:var(--vogue-black);">
                {{ $art->title }}
              </h3>
              <p style="font-family:var(--font-garamond); font-size:1.05rem; color:#555; line-height:1.5; margin-bottom:10px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                {{ $art->excerpt }}
              </p>
              <div class="vogue-byline" style="margin-top:auto;">
                {{ $art->author_name ?? 'Editorial Staff' }} · {{ $art->read_time ?? '4 min read' }}
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <!-- ══ 7. THE LIST (A month in people and stories) ════════════ -->
  <section id="sec-the-list" class="city-edition-section">
    <div class="vogue-container">
      <div class="section-hed-bar" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
        <div style="max-width:850px;">
          <h2 class="section-hed-title" style="margin-bottom:6px;">The List</h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; line-height:1.5; margin:0;">
            A month in people and stories. The List is a monthly archive of selected profiles published by CityIcons. Names are presented alphabetically. It is not a ranking, competition or award.
          </p>
        </div>
        <a href="{{ url('/the-list') }}" class="section-hed-link" style="flex-shrink:0;">
          <span>View The List Archive</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      @if($theListPreview && $theListPreview->count() > 0)
        <div style="border-top:2px solid var(--vogue-black); border-bottom:1px solid var(--vogue-border); padding:8px 0;">
          <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:12px 28px;">
            @foreach($theListPreview as $person)
              <div style="display:flex; align-items:center; justify-content:space-between; padding:12px 0; border-bottom:1px solid var(--vogue-border); cursor:pointer;" onclick="location.href='{{ url('/person/' . ($person->slug ?: $person->id)) }}'">
                <div>
                  <span style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; color:var(--vogue-black);">{{ $person->name }}</span>
                  <div style="font-size:0.75rem; color:var(--vogue-muted); margin-top:2px;">
                    {{ $person->profession }} @if($person->city) · {{ $person->city->name }} @endif
                  </div>
                </div>
                <span style="font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-red);">
                  {{ strtoupper($person->type) }} &rarr;
                </span>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </section>

  <!-- ══ 8. MAGAZINE (Stories designed to last beyond the feed) ══ -->
  <section id="sec-magazine" class="city-edition-section">
    <div class="vogue-container">
      <div style="background:var(--vogue-black); color:#ffffff; padding:clamp(36px, 5vw, 56px); display:grid; grid-template-columns:1.5fr 1fr; gap:40px; align-items:center; border-radius:2px;" class="magazine-feature-box">
        <div>
          <span class="vogue-rubric vogue-rubric--red" style="letter-spacing:2.5px;">CURATED PRINT &amp; DIGITAL EDITION</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(1.8rem, 3.2vw, 2.8rem); font-weight:400; line-height:1.15; margin:10px 0 14px; color:#ffffff;">
            Stories designed to last beyond the feed.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.2rem; line-height:1.6; color:rgba(255,255,255,0.85); margin-bottom:20px;">
            CityIcons Magazine presents selected profiles, verified journeys and defining stories from across India in a curated editorial format. Each edition contributes to a permanent cultural archive.
          </p>
          <div style="display:flex; gap:14px; flex-wrap:wrap;">
            <a href="{{ url('/magazine') }}" style="display:inline-block; background:var(--vogue-red); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 26px;">
              Read Latest Issue
            </a>
            <a href="{{ url('/bhavnagar/magazine') }}" style="display:inline-block; border:1px solid rgba(255,255,255,0.5); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 26px;">
              Bhavnagar Edition
            </a>
          </div>
        </div>

        <div style="text-align:center;">
          <div style="width:230px; max-width:100%; height:310px; margin:0 auto; background:#1c1c1c; border:1px solid rgba(255,255,255,0.2); box-shadow:0 12px 30px rgba(0,0,0,0.6); overflow:hidden; position:relative; border-radius:2px;">
            @if($magazineEdition && $magazineEdition->cover_image)
              <img src="{{ $magazineEdition->cover_image }}" alt="CityIcons Magazine" style="width:100%; height:100%; object-fit:cover;">
            @else
              <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?w=600&q=80" alt="CityIcons Magazine" style="width:100%; height:100%; object-fit:cover;">
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ 9. FEATURED BRANDS (Clearly disclosed collaborations) ══ -->
  <x-featured-brands-section :brands="$featuredBrands" />

  <!-- ══ 10. NOMINATION (Know a story worth documenting?) ═══════ -->
  <x-nomination-cta />

  <!-- ══ 11. CLOSING (Not every story needs attention. Some deserve permanence) ══ -->
  <x-closing-statement />

</x-layouts.app>
