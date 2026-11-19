@php
  $cName = isset($city) ? $city->name : 'National';
  $cSlug = isset($city) ? $city->slug : null;
  $isCitySpecific = !empty($cSlug);
  $baseRoute = $isCitySpecific ? url('/' . $cSlug . '/stories') : url('/stories');
@endphp

<x-layouts.app :title="'Stories — ' . ($isCitySpecific ? $cName . ' Editorial Stories' : 'National Editorial Stories')">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:8px;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ strtoupper($cName) }} · LONG-FORM PROFILES &amp; FEATURES
          </span>
          @if($isCitySpecific)
            <a href="{{ url('/' . $cSlug) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
              &larr; Back to {{ $cName }} Subsite
            </a>
          @endif
        </div>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          {{ $isCitySpecific ? $cName . ' Stories' : 'National Stories' }}
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          {{ $isCitySpecific ? 'People, journeys and ideas from ' . $cName . '.' : 'Defining narratives and profiles across Indian cities.' }}
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6;">
          Explore long-form profiles, cultural narratives, city stories and editorial features documenting meaningful work and defining moments.
        </p>
      </div>

      <!-- Search & Filters -->
      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; padding:18px 0; border-bottom:1px solid var(--vogue-border); margin-bottom:36px;">
        <!-- Category & Section Filters -->
        <div style="display:flex; flex-wrap:wrap; gap:12px; font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
          <a href="{{ $baseRoute }}" style="{{ !request('category') ? 'color:var(--vogue-red);' : 'color:var(--vogue-black);' }}">All Stories</a> ·
          @if($isCitySpecific)
            <a href="{{ url('/' . $cSlug . '/icons') }}" style="color:var(--vogue-black);">{{ $cName }} Icons</a> ·
            <a href="{{ url('/' . $cSlug . '/rising') }}" style="color:var(--vogue-black);">{{ $cName }} Rising</a> ·
            <a href="{{ url('/' . $cSlug . '/the-list') }}" style="color:var(--vogue-black);">The List</a>
          @else
            <a href="{{ url('/icons') }}" style="color:var(--vogue-black);">Icons</a> ·
            <a href="{{ url('/rising') }}" style="color:var(--vogue-black);">Rising</a> ·
            <a href="{{ url('/the-list') }}" style="color:var(--vogue-black);">The List</a> ·
            <a href="{{ url('/magazine') }}" style="color:var(--vogue-black);">Magazine</a>
          @endif
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ $baseRoute }}" style="width:100%; max-width:320px; display:flex;">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Search stories..." style="width:100%; padding:10px 14px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.85rem;">
          <button type="submit" style="background:var(--vogue-black); color:#fff; border:none; padding:0 16px; cursor:pointer;"><i class="fas fa-search"></i></button>
        </form>
      </div>

      <!-- Real Database Feed Grid (4 columns) -->
      @if($stories->count() > 0)
        <div class="vogue-4col-grid" style="margin-bottom:40px;">
          @foreach($stories as $story)
            <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/article/' . $story->id) }}'">
              <div class="vogue-card__img-wrap">
                <img src="{{ $story->cover_image ?: 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&q=80' }}" alt="{{ $story->title }}" loading="lazy">
              </div>
              <div class="vogue-card__body" style="padding-top:12px;">
                <div style="display:flex; gap:6px; align-items:center; margin-bottom:4px;">
                  <span class="vogue-rubric vogue-rubric--red">{{ $story->category ? $story->category->name : 'STORY' }}</span>
                  @if($story->city)
                    <span style="font-size:0.625rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">· {{ $story->city->name }}</span>
                  @endif
                </div>
                <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">
                  {{ $story->title }}
                </h3>
                <p style="font-family:var(--font-garamond); font-size:0.95rem; color:#555; line-height:1.4; margin-bottom:8px;">
                  {{ Str::limit($story->excerpt, 90) }}
                </p>
                <div class="vogue-card__byline" style="font-size:0.75rem; color:var(--vogue-muted);">
                  By {{ $story->author_name ?? 'Editorial Staff' }} · {{ $story->read_time ?? '5 min read' }}
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div>
          {{ $stories->links() }}
        </div>
      @else
        <div style="text-align:center; padding:60px 20px; color:var(--vogue-muted);">
          <p style="font-family:var(--font-garamond); font-size:1.2rem;">No stories found matching your query.</p>
          <a href="{{ $baseRoute }}" style="color:var(--vogue-red); font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin-top:8px; display:inline-block;">Reset Search</a>
        </div>
      @endif

    </div>
  </section>

</x-layouts.app>
