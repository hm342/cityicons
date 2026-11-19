<x-layouts.app title="Search CityIcons — People, stories, categories or subjects">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <span class="vogue-rubric vogue-rubric--red">ARCHIVE DISCOVERY</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Search CityIcons
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.2rem, 1.8vw, 1.5rem); color:var(--vogue-black); line-height:1.3;">
          Search people, stories, categories or subjects.
        </p>
      </div>

      <!-- Search Box (SQL injection protected) -->
      <form method="GET" action="{{ url('/search') }}" style="max-width:750px; margin-bottom:48px;">
        <div style="display:flex; border-bottom:2px solid var(--vogue-black); padding-bottom:8px;">
          <input type="text" name="q" value="{{ $term ?? '' }}" placeholder="Search people, stories or categories..." autofocus style="width:100%; border:none; font-family:var(--font-didot); font-size:1.8rem; outline:none; background:transparent;">
          <button type="submit" style="border:none; background:none; font-size:1.4rem; cursor:pointer; color:var(--vogue-black);"><i class="fas fa-search"></i></button>
        </div>
      </form>

      @if(!empty($term))
        <div style="margin-bottom:32px; font-size:1rem; color:var(--vogue-muted);">
          Search results for: <strong style="color:var(--vogue-black);">"{{ $term }}"</strong> ({{ $articles->count() + $people->count() }} matches)
        </div>

        <!-- Documented People Matches -->
        @if($people->count() > 0)
          <div style="margin-bottom:48px;">
            <h2 style="font-family:var(--font-didot); font-size:1.6rem; font-weight:400; margin-bottom:20px; border-bottom:1px solid var(--vogue-border); padding-bottom:8px;">
              Documented People ({{ $people->count() }})
            </h2>
            <div class="vogue-4col-grid">
              @foreach($people as $p)
                <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/stories') }}'">
                  <div class="vogue-card__img-wrap" style="height:240px; overflow:hidden; border-radius:4px;">
                    <img src="{{ $p->portrait_image ?: $p->cover_image }}" alt="{{ $p->name }}" style="width:100%; height:100%; object-fit:cover;">
                  </div>
                  <div class="vogue-card__body" style="padding-top:10px;">
                    <span class="vogue-rubric vogue-rubric--red">{{ strtoupper($p->type) }}</span>
                    <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; margin:4px 0;">
                      {{ $p->name }}
                    </h3>
                    <div style="font-size:0.8rem; color:var(--vogue-muted);">{{ $p->profession }} · {{ $p->city->name ?? 'Bhavnagar' }}</div>
                  </div>
                </article>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Editorial Stories Matches -->
        @if($articles->count() > 0)
          <div style="margin-bottom:48px;">
            <h2 style="font-family:var(--font-didot); font-size:1.6rem; font-weight:400; margin-bottom:20px; border-bottom:1px solid var(--vogue-border); padding-bottom:8px;">
              Editorial Stories ({{ $articles->count() }})
            </h2>
            <div class="vogue-4col-grid">
              @foreach($articles as $art)
                <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
                  <div class="vogue-card__img-wrap" style="height:220px; overflow:hidden; border-radius:4px;">
                    <img src="{{ $art->cover_image ?: 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&q=80' }}" alt="{{ $art->title }}" style="width:100%; height:100%; object-fit:cover;">
                  </div>
                  <div class="vogue-card__body" style="padding-top:10px;">
                    <span class="vogue-rubric">{{ $art->category ? $art->category->name : 'STORY' }}</span>
                    <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.1rem; font-weight:600; margin:4px 0;">
                      {{ $art->title }}
                    </h3>
                    <div style="font-size:0.75rem; color:var(--vogue-muted);">
                      By {{ $art->author_name ?? 'Editorial Staff' }} · {{ $art->read_time ?? '5 min read' }}
                    </div>
                  </div>
                </article>
              @endforeach
            </div>
          </div>
        @endif

        @if($articles->count() === 0 && $people->count() === 0)
          <div style="padding:60px 0; text-align:center; color:var(--vogue-muted);">
            <p style="font-family:var(--font-garamond); font-size:1.3rem;">No matching stories or profiles were found for "{{ $term }}".</p>
            <p style="font-size:0.85rem; margin-top:8px;">Try searching for another individual's name, craft, or category.</p>
          </div>
        @endif

      @endif

    </div>
  </section>

</x-layouts.app>
