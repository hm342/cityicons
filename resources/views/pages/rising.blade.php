@php
  $cName = isset($city) ? $city->name : 'Bhavnagar';
  $cSlug = isset($city) ? $city->slug : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
  $baseRoute = url('/' . $cSlug . '/rising');
@endphp

<x-layouts.app :title="'Rising — ' . $cName . ' Rising Talent: The names building what comes next.'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="rising" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ strtoupper($cName) }} RISING · {{ $isFlagship ? 'FLAGSHIP ARCHIVE' : 'CITY EDITION' }}</span>
        <h1 class="rm-page-header-title">{{ $cName }} Rising</h1>
        <p class="rm-page-header-sub">The names building what comes next.</p>
        <p class="rm-page-header-desc">
          Rising documents emerging individuals with genuine achievement, credible potential and a growing body of work. Documenting the future changemakers, artists, creators, and entrepreneurs of {{ $cName }}.
        </p>
        <div style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-red); margin-top:8px;">
          Editorial Selection · Zero Commercial Influence
        </div>
      </div>

      <!-- Categories Filter Bar -->
      <div class="rm-filter-bar">
        <a href="{{ $baseRoute }}" class="rm-filter-pill {{ !request('category') ? 'is-active' : '' }}">All Rising</a>
        @foreach($categories as $cat)
          <a href="{{ $baseRoute . '?category=' . $cat->slug }}" class="rm-filter-pill {{ request('category') === $cat->slug ? 'is-active' : '' }}">
            {{ $cat->name }}
          </a>
        @endforeach
      </div>

      <!-- Real Database People Grid in Real Moments Grid Cards -->
      @if($people->count() > 0)
        <div class="rm-grid-cards">
          @foreach($people as $person)
            <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-grid-card">
              <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" class="rm-grid-card-img" loading="lazy">
              <div class="rm-grid-card-overlay"></div>
              <div class="rm-grid-card-body">
                <span class="cat-italic">{{ $person->category ? $person->category->name : 'Rising' }}</span>
                <h3 class="rm-grid-card-title">{{ $person->name }}</h3>
                <p style="font-size:0.82rem; color:var(--text-muted); margin-bottom:10px;">{{ $person->profession ?? 'Emerging Contributor' }}</p>
                <div class="post-share-inline">
                  <span class="share-txt">View Profile &rarr;</span>
                </div>
              </div>
            </a>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="rm-pagination">
          {{ $people->links() }}
        </div>
      @else
        <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:48px; border-radius:4px; text-align:center; color:var(--text-muted);">
          <p style="font-size:1.1rem; margin-bottom:14px;">No rising talent found matching this field in {{ $cName }}.</p>
          <a href="{{ $baseRoute }}" class="btn-pill" style="background:var(--vogue-red);">View All Rising</a>
        </div>
      @endif

    </div>
  </main>

</x-layouts.app>
