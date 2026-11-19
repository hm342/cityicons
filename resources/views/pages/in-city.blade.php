@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
  $baseRoute = url('/' . $cSlug . '/in-' . $cSlug);
@endphp

<x-layouts.app :title="'In ' . $cName . ' — Events, culture and moments shaping the city · CITYICONS'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="in-city" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ strtoupper($cName) }} · CULTURAL DISPATCHES &amp; LIVING MOMENTS</span>
        <h1 class="rm-page-header-title">In {{ $cName }}</h1>
        <p class="rm-page-header-sub">The city, as it happens.</p>
        <p class="rm-page-header-desc">
          Selective coverage of notable events, performances, exhibitions, conversations and cultural moments across {{ $cName }}. Documented through an independent editorial lens.
        </p>
        <div style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-red); margin-top:8px;">
          Paid associations are clearly disclosed.
        </div>
      </div>

      <!-- Search & Category Filters Bar -->
      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-bottom:36px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,0.08);">
        <div class="rm-filter-bar" style="margin-bottom:0;">
          <a href="{{ $baseRoute }}" class="rm-filter-pill {{ !request('category') ? 'is-active' : '' }}">All In {{ $cName }}</a>
          @if(isset($categories))
            @foreach($categories->take(6) as $cat)
              <a href="{{ $baseRoute . '?category=' . $cat->slug }}" class="rm-filter-pill {{ request('category') === $cat->slug ? 'is-active' : '' }}">
                {{ $cat->name }}
              </a>
            @endforeach
          @endif
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ $baseRoute }}" style="width:100%; max-width:320px; display:flex;">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Search in {{ $cName }}..." 
                 style="width:100%; padding:10px 14px; background:#242424; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.85rem; border-radius:4px 0 0 4px; outline:none;">
          <button type="submit" style="background:var(--vogue-red); color:#fff; border:none; padding:0 18px; cursor:pointer; border-radius:0 4px 4px 0;">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>

      <!-- Real Moments 3-Column Card Grid -->
      @if($articles->count() > 0)
        <div class="rm-grid-cards">
          @foreach($articles as $art)
            <a href="{{ url('/article/' . $art->id) }}" class="rm-grid-card">
              <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" class="rm-grid-card-img" loading="lazy">
              <div class="rm-grid-card-overlay"></div>
              <div class="rm-grid-card-body">
                <span class="cat-italic">{{ $art->category ? $art->category->name : 'Culture' }}</span>
                <h3 class="rm-grid-card-title">{{ $art->title }}</h3>
                <div class="post-share-inline">
                  <span class="share-txt">Explore Moment &rarr;</span>
                  <span style="margin-left:auto; font-size:0.75rem; color:var(--text-dim);">
                    {{ $art->published_at ? $art->published_at->format('M d, Y') : 'Recent' }}
                  </span>
                </div>
              </div>
            </a>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="rm-pagination">
          {{ $articles->links() }}
        </div>
      @else
        <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:48px; border-radius:4px; text-align:center; color:var(--text-muted);">
          <p style="font-size:1.1rem; margin-bottom:14px;">No living culture moments found matching your query.</p>
          <a href="{{ $baseRoute }}" class="btn-pill" style="background:var(--vogue-red);">Reset Filters</a>
        </div>
      @endif

    </div>
  </main>

</x-layouts.app>
