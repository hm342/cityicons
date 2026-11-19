@props([
  'cover' => null,
  'settings' => [],
  'title' => null,
  'rubric' => null,
  'dek' => null,
  'signature' => null,
  'primaryBtnText' => 'Explore Cities',
  'primaryBtnUrl' => '#sec-cities',
  'secondaryBtnText' => 'Bhavnagar Flagship',
  'secondaryBtnUrl' => null,
  'tertiaryBtnText' => 'Nominate an Icon',
  'tertiaryBtnUrl' => null,
])

@php
  $coverImage = ($cover instanceof \App\Models\Article && $cover->cover_image)
    ? $cover->cover_image
    : 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85';
  
  $coverTitle = $title ?? ($settings['hero_headline'] ?? 'India, Documented.');
  $coverExcerpt = $dek ?? ($settings['hero_subheadline'] ?? 'Stories of the people, journeys and ideas shaping the city.');
  $sigText = $signature ?? ($settings['hero_subline'] ?? 'Selected with purpose. Documented with responsibility.');
  $rubricText = $rubric ?? 'CITYICONS · ALL-INDIA EDITORIAL NETWORK';
  $secUrl = $secondaryBtnUrl ?? url('/bhavnagar');
  $tertUrl = $tertiaryBtnUrl ?? url('/nominate');
@endphp

<!-- ══ 1. HERO BANNER ════════════════════════════════════════════ -->
<section class="hero-section-wrap">
  <div class="vogue-container">
    <div class="hero-big-banner" id="hero-banner">
      
      <!-- Cover Image with Balanced Proportions -->
      <div class="hero-big-banner__img-wrap" onclick="location.href='{{ $primaryBtnUrl }}'" style="cursor:pointer;">
        <img src="{{ $coverImage }}" alt="{{ $coverTitle }}" loading="eager">
        <div class="hero-big-banner__top-shade"></div>
        <div class="hero-big-banner__brand-stamp">CITYICONS</div>
        <div class="hero-big-banner__bottom-shade"></div>

        <!-- Main headline INSIDE the image at the bottom -->
        <div class="hero-big-banner__content-overlay">
          <div class="hero-big-banner__content-box">
            <h1 class="hero-big-banner__hed">{{ $coverTitle }}</h1>
          </div>
        </div>
      </div>

      <!-- Description and Actions Below Image -->
      <div class="hero-big-banner__details">
        <span class="vogue-rubric vogue-rubric--red">{{ $rubricText }}</span>
        <p class="hero-big-banner__dek">{{ $coverExcerpt }}</p>
        <p style="font-family:var(--font-garamond); font-style:italic; font-size:1.15rem; color:var(--vogue-muted); margin-bottom:18px;">
          {{ $sigText }}
        </p>

        <!-- Action Buttons -->
        <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:16px;">
          <a href="{{ $primaryBtnUrl }}" style="display:inline-block; background:var(--vogue-black); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 24px; transition:all 0.2s ease;">
            {{ $primaryBtnText }} &darr;
          </a>
          <a href="{{ $secUrl }}" style="display:inline-block; background:var(--vogue-red); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 24px; transition:all 0.2s ease;">
            {{ $secondaryBtnText }} &rarr;
          </a>
          <a href="{{ $tertUrl }}" style="display:inline-block; border:1px solid var(--vogue-black); color:var(--vogue-black); font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 24px; transition:all 0.2s ease;">
            {{ $tertiaryBtnText }}
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
