@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isCitySpecific = !empty($cSlug);
  $baseRoute = url('/' . $cSlug . '/stories');
@endphp

<x-layouts.app :title="'Stories — ' . $cName . ' Editorial Profiles & Features · CITYICONS'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="stories" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ strtoupper($cName) }} · LONG-FORM PROFILES &amp; FEATURES</span>
        <h1 class="rm-page-header-title">{{ $cName }} Stories</h1>
        <p class="rm-page-header-sub">The complete story beyond the headline.</p>
        <p class="rm-page-header-desc">
          Explore profiles, cultural narratives, city stories and editorial features documenting meaningful work and defining journeys connected to {{ $cName }}.
        </p>
      </div>

      <!-- Search & Filters -->
      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-bottom:36px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,0.08);">
        <div class="rm-filter-bar" style="margin-bottom:0;">
          <a href="{{ $baseRoute }}" class="rm-filter-pill {{ !request('category') ? 'is-active' : '' }}">All Stories</a>
          <a href="{{ url('/' . $cSlug . '/icons') }}" class="rm-filter-pill">Icons</a>
          <a href="{{ url('/' . $cSlug . '/rising') }}" class="rm-filter-pill">Rising</a>
          <a href="{{ url('/' . $cSlug . '/the-list') }}" class="rm-filter-pill">The List</a>
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ $baseRoute }}" style="width:100%; max-width:320px; display:flex;">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Search stories..." 
                 style="width:100%; padding:10px 14px; background:#242424; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.85rem; border-radius:4px 0 0 4px; outline:none;">
          <button type="submit" style="background:var(--vogue-red); color:#fff; border:none; padding:0 18px; cursor:pointer; border-radius:0 4px 4px 0;">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>

      <!-- Real Database Feed Grid (3 columns Real Moments grid) -->
      @if($stories->count() > 0)
        <div class="rm-grid-cards">
          @foreach($stories as $story)
            <a href="{{ url('/article/' . $story->id) }}" class="rm-grid-card">
              <img src="{{ $story->cover_image ?: 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&q=80' }}" alt="{{ $story->title }}" class="rm-grid-card-img" loading="lazy">
              <div class="rm-grid-card-overlay"></div>
              <div class="rm-grid-card-body">
                <span class="cat-italic">{{ $story->category ? $story->category->name : 'Story' }}</span>
                <h3 class="rm-grid-card-title">{{ $story->title }}</h3>
                <div class="post-share-inline">
                  <span class="share-txt">Read Story &rarr;</span>
                  <span style="margin-left:auto; font-size:0.75rem; color:var(--text-dim);">{{ $story->read_time ?? '5 min' }}</span>
                </div>
              </div>
            </a>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="rm-pagination">
          {{ $stories->links() }}
        </div>
      @else
        <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:48px; border-radius:4px; text-align:center; color:var(--text-muted);">
          <p style="font-size:1.1rem; margin-bottom:14px;">No stories found matching your query.</p>
          <a href="{{ $baseRoute }}" class="btn-pill" style="background:var(--vogue-red);">View All Stories</a>
        </div>
      @endif

    </div>
  </main>

</x-layouts.app>
