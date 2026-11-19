<x-layouts.app title="Bhavnagar Icons — Selected with purpose. Documented with responsibility.">

  <!-- ══ 1. HERO (Bhavnagar, Documented) ════════════════════════ -->
  <x-hero-banner :cover="$coverArticle" :settings="$settings" />

  <!-- ══ 2. EDITORIAL MANIFESTO (A city is shaped by its people) ══ -->
  <x-editorial-intro />

  <!-- ══ 3. CITY NEWS CAROUSEL / LATEST DISPATCH TICKER ══════════ -->
  <x-city-news-strip :articles="$newsStrip" />

  <!-- ══ 4. FEATURED ICONS (People shaping Bhavnagar and beyond) ══ -->
  <x-city-edition-section 
    city-id="bhavnagar-icons" 
    title="Featured Icons" 
    subtitle="People shaping Bhavnagar and beyond. Explore established professionals, creators, entrepreneurs, artists, athletes and changemakers whose work deserves a place in the city's permanent record." 
    button-text="Explore All Icons" 
    explore-url="{{ url('/icons') }}" 
    :people="$icons" 
  />

  <!-- ══ 5. RISING (The names building what comes next) ═════════ -->
  <x-city-edition-section 
    city-id="bhavnagar-rising" 
    title="Rising" 
    subtitle="The names building what comes next. Rising documents emerging individuals with genuine achievement, credible potential and a growing body of work." 
    button-text="Discover Rising" 
    explore-url="{{ url('/rising') }}" 
    :people="$rising" 
  />

  <!-- ══ 6. VOICES (Conversations worth preserving) ════════════ -->
  <x-weddings-grid title="Voices: Conversations Worth Preserving" explore-url="{{ url('/voices') }}" :people="$voices" />

  <!-- ══ 7. STORIES (The complete story, beyond the headline) ══ -->
  <section id="sec-stories" class="city-edition-section">
    <div class="vogue-container">
      <div class="section-hed-bar" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
        <div style="max-width:850px;">
          <h2 class="section-hed-title" style="margin-bottom:6px;">Stories</h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; line-height:1.5; margin:0;">
            The complete story, beyond the headline. Explore profiles, interviews, city stories and editorial features documenting meaningful work and defining journeys.
          </p>
        </div>
        <a href="{{ url('/stories') }}" class="section-hed-link" style="flex-shrink:0;">
          <span>Explore Stories</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      @if($latestStories && $latestStories->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:28px;">
          @foreach($latestStories as $art)
            <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
              <div class="vogue-card__img-wrap" style="margin-bottom:14px;">
                <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" loading="lazy">
              </div>
              <span class="vogue-rubric vogue-rubric--red">{{ $art->category ? strtoupper($art->category->name) : 'STORY' }}</span>
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

  <!-- ══ 8. THE LIST (A month in people and stories) ════════════ -->
  <section id="sec-the-list" class="city-edition-section">
    <div class="vogue-container">
      <div class="section-hed-bar" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
        <div style="max-width:850px;">
          <h2 class="section-hed-title" style="margin-bottom:6px;">The List</h2>
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; line-height:1.5; margin:0;">
            A month in people and stories. The List is a monthly archive of selected profiles published by Bhavnagar Icons. Names are presented alphabetically. It is not a ranking, competition or award.
          </p>
        </div>
        <a href="{{ url('/the-list') }}" class="section-hed-link" style="flex-shrink:0;">
          <span>View The List</span>
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
                  <div style="font-size:0.75rem; color:var(--vogue-muted); margin-top:2px;">{{ $person->profession }}</div>
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

  <!-- ══ 9. MAGAZINE (Stories designed to last beyond the feed) ══ -->
  <section id="sec-magazine" class="city-edition-section">
    <div class="vogue-container">
      <div style="background:var(--vogue-black); color:#ffffff; padding:clamp(36px, 5vw, 56px); display:grid; grid-template-columns:1.5fr 1fr; gap:40px; align-items:center; border-radius:2px;" class="magazine-feature-box">
        <div>
          <span class="vogue-rubric vogue-rubric--red" style="letter-spacing:2.5px;">CURATED PRINT &amp; DIGITAL EDITION</span>
          <h2 style="font-family:var(--font-didot); font-size:clamp(1.8rem, 3.2vw, 2.8rem); font-weight:400; line-height:1.15; margin:10px 0 14px; color:#ffffff;">
            Stories designed to last beyond the feed.
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.2rem; line-height:1.6; color:rgba(255,255,255,0.85); margin-bottom:20px;">
            Bhavnagar Icons Magazine presents selected profiles, verified journeys and defining stories from the city in a curated editorial format. Each edition contributes to a growing archive of Bhavnagar and its people.
          </p>
          <div style="display:flex; gap:14px; flex-wrap:wrap;">
            <a href="{{ url('/magazine') }}" style="display:inline-block; background:var(--vogue-red); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 26px;">
              Read the Magazine
            </a>
            <a href="{{ url('/magazine') }}" style="display:inline-block; border:1px solid rgba(255,255,255,0.5); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 26px;">
              View Magazine Archive
            </a>
          </div>
        </div>

        <div style="text-align:center;">
          <div style="width:230px; max-width:100%; height:310px; margin:0 auto; background:#1c1c1c; border:1px solid rgba(255,255,255,0.2); box-shadow:0 12px 30px rgba(0,0,0,0.6); overflow:hidden; position:relative; border-radius:2px;">
            @if($magazineEdition && $magazineEdition->cover_image)
              <img src="{{ $magazineEdition->cover_image }}" alt="Bhavnagar Icons Magazine" style="width:100%; height:100%; object-fit:cover;">
            @else
              <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?w=600&q=80" alt="Bhavnagar Icons Magazine" style="width:100%; height:100%; object-fit:cover;">
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ══ 10. IN BHAVNAGAR (The city, as it happens — Events & Moments) ══ -->
  <x-cinema-section city-id="bhavnagar" cityName="In Bhavnagar" explore-url="{{ url('/in-bhavnagar') }}" :articles="$inBhavnagar" />

  <!-- ══ 11. FEATURED BRANDS (Clearly disclosed collaborations) ══ -->
  <x-featured-brands-section :brands="$featuredBrands" />

  <!-- ══ 12. NOMINATION (Know a story worth documenting?) ═══════ -->
  <x-nomination-cta />

  <!-- ══ 13. CLOSING (Not every story needs attention. Some deserve permanence) ══ -->
  <x-closing-statement />

</x-layouts.app>
