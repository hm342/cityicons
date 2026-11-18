@props([
  'title' => 'Weddings & Celebrations',
  'exploreUrl' => null
])

@php
  $exploreUrl = $exploreUrl ?? url('/cities/jaipur');
@endphp

<!-- ══ LAST SECTION: WEDDINGS & ROYAL CELEBRATIONS (4-Column Collection Grid) ══ -->
<section id="sec-weddings" class="vogue-weddings-section">
  <div class="vogue-container">
    <div class="section-hed-bar">
      <h2 class="section-hed-title">{{ $title }}</h2>
      <a href="{{ $exploreUrl }}" class="section-hed-link">
        <span>Explore Royal Celebrations</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <div class="vogue-4col-grid" id="weddings-4col-grid">
      {{ $slot }}
    </div>
  </div>
</section>
