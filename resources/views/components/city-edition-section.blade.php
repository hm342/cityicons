@props([
  'cityId' => 'bhavnagar',
  'cityName' => 'Bhavnagar',
  'exploreUrl' => null
])

@php
  $exploreUrl = $exploreUrl ?? url('/cities/' . $cityId);
@endphp

<!-- ══ CITY SECTION: {{ strtoupper($cityName) }} ═════════════════════════ -->
<section id="sec-{{ $cityId }}" class="city-edition-section">
  <div class="vogue-container">
    <div class="section-hed-bar">
      <h2 class="section-hed-title">{{ $cityName }}</h2>
      <a href="{{ $exploreUrl }}" class="section-hed-link">
        <span>Explore {{ $cityName }} Edition</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <div class="vogue-sticky-section">
      <!-- Left: Sticky Lead Story -->
      <div class="vogue-sticky-col">
        <article class="vogue-sticky-lead" id="{{ $cityId }}-lead">
          {{ $lead ?? '' }}
        </article>
      </div>

      <!-- Right: 6 Stories Grid (2 columns x 3 rows) scrolling naturally with page -->
      <div class="vogue-scroll-right-grid" id="{{ $cityId }}-grid-6">
        {{ $slot }}
      </div>
    </div>
  </div>
</section>
