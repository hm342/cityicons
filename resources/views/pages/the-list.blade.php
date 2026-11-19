@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
  $baseRoute = url('/' . $cSlug . '/the-list');
@endphp

<x-layouts.app :title="'The List — ' . $cName . ' Monthly Editorial Archive · CITYICONS'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="the-list" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ strtoupper($cName) }} · MONTHLY EDITORIAL ARCHIVE</span>
        <h1 class="rm-page-header-title">The List · {{ $cName }}</h1>
        <p class="rm-page-header-sub">A month in people and stories.</p>
        <p class="rm-page-header-desc">
          The List brings together profiles published by {{ $cName }} Icons during each month. Names are presented alphabetically. Inclusion is based on editorial selection and does not represent a ranking, competition, award or comparative judgment.
        </p>
      </div>

      <!-- Archive Selectors Form -->
      <form method="GET" action="{{ $baseRoute }}" 
            style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:20px 28px; border-radius:4px; margin-bottom:40px; display:flex; align-items:center; justify-content:center; gap:16px; flex-wrap:wrap;">
        <span style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--text-muted);">Select Archive:</span>
        
        <select name="year" style="padding:8px 16px; background:#181818; border:1px solid rgba(255,255,255,0.15); color:#ffffff; font-family:inherit; font-size:0.85rem; border-radius:4px;">
          @for($y = date('Y'); $y >= 2024; $y--)
            <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>Year {{ $y }}</option>
          @endfor
        </select>

        <select name="month" style="padding:8px 16px; background:#181818; border:1px solid rgba(255,255,255,0.15); color:#ffffff; font-family:inherit; font-size:0.85rem; border-radius:4px;">
          @for($m = 1; $m <= 12; $m++)
            <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
              {{ date('F', mktime(0, 0, 0, $m, 1)) }}
            </option>
          @endfor
        </select>

        <button type="submit" class="btn-pill" style="margin-top:0; background:var(--vogue-red); padding:9px 24px;">
          View Archive Record
        </button>
      </form>

      <!-- Signature Blog Stream Layout -->
      <div class="rm-container-blog">
        <div style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--text-dim); text-align:center; margin-bottom:32px;">
          {{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }} {{ $selectedYear }} Edition · {{ $cName }} Record ({{ $entries->count() }} Profiles)
        </div>

        @if($entries->count() > 0)
          <div class="rm-blog-stream">
            @foreach($entries as $person)
              <article class="rm-blog-card">
                <!-- Left: Media Box -->
                <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="rm-blog-media" aria-label="{{ $person->name }}">
                  <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" loading="lazy">
                  <span class="rm-media-badge"><i class="fas fa-play"></i></span>
                </a>

                <!-- Right: Content Box -->
                <div class="rm-blog-content">
                  <div>
                    <span class="cat-italic">{{ $person->category ? $person->category->name : 'Icon' }}</span>
                    <h3 class="rm-blog-title">
                      <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}">{{ $person->name }}</a>
                    </h3>
                    <div class="rm-blog-excerpt">
                      <span class="bullet">❖</span>
                      <span>
                        {{ $person->bio_summary ?: ($person->profession . ' in ' . $cName . ' documenting verified achievement and lasting contribution to the permanent record.') }}
                      </span>
                    </div>
                  </div>

                  <div>
                    <div class="post-share-inline">
                      <span class="share-txt">Share &rarr;</span>
                      <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url('/person/' . ($person->slug ?: $person->id))) }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                      <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/person/' . ($person->slug ?: $person->id))) }}" target="_blank" rel="noopener"><i class="fab fa-x-twitter"></i></a>
                      <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url('/person/' . ($person->slug ?: $person->id))) }}" target="_blank" rel="noopener"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                    <a href="{{ url('/person/' . ($person->slug ?: $person->id)) }}" class="btn-pill">
                      View Post
                    </a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        @else
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:48px; border-radius:4px; text-align:center; color:var(--text-muted);">
            <p style="font-size:1.1rem; margin-bottom:14px;">No published records found for {{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }} {{ $selectedYear }}.</p>
            <a href="{{ $baseRoute }}" class="btn-pill" style="background:var(--vogue-red);">Reset to Current Month</a>
          </div>
        @endif
      </div>

    </div>
  </main>

</x-layouts.app>
