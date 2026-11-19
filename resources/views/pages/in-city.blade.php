@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
  $baseRoute = url('/' . $cSlug . '/in-' . $cSlug);
@endphp

<x-layouts.app :title="'In ' . $cName . ' — Events, culture and moments shaping the city · CITYICONS'" :city="$city ?? null" activeCity="in-city">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:8px;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ strtoupper($cName) }} · CULTURAL DISPATCHES &amp; LIVING MOMENTS
          </span>
          <a href="{{ url('/' . $cSlug) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
            &larr; Back to {{ $cName }} Subsite
          </a>
        </div>
        
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          In {{ $cName }}
        </h1>
        
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          The city, as it happens. Selective coverage of notable events, performances, exhibitions, conversations and cultural moments across {{ $cName }}.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6; margin-bottom:8px;">
          In {{ $cName }} documents notable events, performances, exhibitions, conversations and cultural moments through an independent editorial lens. Coverage is selective and based on relevance, public interest, experience and long-term documentation value.
        </p>
        <div style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-red); margin-top:8px;">
          Event coverage may be independent or commercially supported. Paid associations are clearly disclosed.
        </div>
      </div>

      <!-- Search & Category Filters Bar -->
      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; padding:18px 0; border-bottom:1px solid var(--vogue-border); margin-bottom:36px;">
        <!-- Categories Filter -->
        <div style="display:flex; flex-wrap:wrap; gap:12px; font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
          <span style="color:var(--vogue-muted);">Filter:</span>
          <a href="{{ $baseRoute }}" style="{{ !request('category') ? 'color:var(--vogue-red);' : 'color:var(--vogue-black);' }}">All In {{ $cName }}</a>
          @if(isset($categories))
            @foreach($categories->take(6) as $cat)
              · <a href="{{ $baseRoute . '?category=' . $cat->slug }}" style="{{ request('category') === $cat->slug ? 'color:var(--vogue-red);' : 'color:var(--vogue-black);' }}">
                {{ $cat->name }}
              </a>
            @endforeach
          @endif
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ $baseRoute }}" style="width:100%; max-width:320px; display:flex;">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Search in {{ $cName }}..." style="width:100%; padding:10px 14px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.85rem;">
          <button type="submit" style="background:var(--vogue-black); color:#fff; border:none; padding:0 16px; cursor:pointer;"><i class="fas fa-search"></i></button>
        </form>
      </div>

      <!-- Real Database Feed Grid (4 columns) -->
      @if($articles && $articles->count() > 0)
        <div class="vogue-4col-grid" style="margin-bottom:40px;">
          @foreach($articles as $art)
            <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
              <div class="vogue-card__img-wrap">
                <img src="{{ $art->cover_image ?: 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80' }}" alt="{{ $art->title }}" loading="lazy">
              </div>
              <div class="vogue-card__body" style="padding-top:12px;">
                <div style="display:flex; gap:6px; align-items:center; margin-bottom:4px;">
                  <span class="vogue-rubric vogue-rubric--red">{{ $art->category ? $art->category->name : 'DISPATCH' }}</span>
                  <span style="font-size:0.625rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">· {{ $cName }}</span>
                </div>
                <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">
                  {{ $art->title }}
                </h3>
                <p style="font-family:var(--font-garamond); font-size:0.95rem; color:#555; line-height:1.4; margin-bottom:8px;">
                  {{ Str::limit($art->excerpt ?: strip_tags($art->content), 95) }}
                </p>
                <div class="vogue-card__byline" style="font-size:0.75rem; color:var(--vogue-muted);">
                  By {{ $art->author_name ?? 'Editorial Staff' }} · {{ $art->read_time ?? '4 min read' }} · {{ $art->created_at ? $art->created_at->format('M d, Y') : 'Recent' }}
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div>
          {{ $articles->links() }}
        </div>
      @else
        <div style="text-align:center; padding:60px 20px; color:var(--vogue-muted);">
          <p style="font-family:var(--font-garamond); font-size:1.2rem;">No dispatches or moments published for In {{ $cName }} matching your query yet.</p>
          <a href="{{ $baseRoute }}" style="color:var(--vogue-red); font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin-top:8px; display:inline-block;">Reset Filter</a>
        </div>
      @endif

    </div>
  </section>

  <!-- Official Nomination CTA -->
  <x-nomination-cta />

</x-layouts.app>
