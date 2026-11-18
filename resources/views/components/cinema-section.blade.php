@props([
  'cityId' => 'ahmedabad',
  'cityName' => 'Ahmedabad',
  'exploreUrl' => null
])

@php
  $exploreUrl = $exploreUrl ?? url('/cities/' . $cityId);
@endphp

<!-- ══ CINEMATIC CITY SECTION: {{ strtoupper($cityName) }} ══ -->
<section class="city-cinema-section" id="sec-{{ $cityId }}">
  <div class="vogue-container">
    <div class="section-hed-bar">
      <h2 class="section-hed-title">{{ $cityName }}</h2>
      <a href="{{ $exploreUrl }}" class="section-hed-link">
        <span>Explore {{ $cityName }} Edition</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <!-- Big Cinematic Image Banner (Inside same container) -->
    <div class="city-cinema-banner" id="{{ $cityId }}-cinema-banner">
      {{ $banner ?? '' }}
    </div>

    <!-- Carousel of other news below -->
    <div class="city-cinema-carousel-wrap">
      <div class="city-cinema-carousel-header">
        <span style="font-family:var(--font-sans); font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase;">More From {{ $cityName }}</span>
        <div class="news-strip-controls">
          <button class="strip-control-btn" id="btn-ahmd-prev" aria-label="Previous">&#10094;</button>
          <button class="strip-control-btn" id="btn-ahmd-next" aria-label="Next">&#10095;</button>
        </div>
      </div>
      <div class="city-cinema-carousel-track" id="{{ $cityId }}-cinema-track">
        {{ $slot }}
      </div>
    </div>
  </div>
</section>
