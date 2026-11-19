@props([
  'cover' => null,
  'settings' => []
])

@php
  // Extract cover data with fallback
  if ($cover instanceof \App\Models\Article) {
      $coverTitle = $cover->title;
      $coverExcerpt = $cover->excerpt;
      $coverImage = $cover->cover_image ?: 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85';
      $coverCategory = $cover->category ? strtoupper($cover->category->name) : 'FLAGSHIP EDITION';
      $coverUrl = url('/article/' . $cover->id);
  } elseif (is_array($cover)) {
      $coverTitle = $cover['title'] ?? 'Bhavnagar, Documented.';
      $coverExcerpt = $cover['excerpt'] ?? 'Stories of the people, journeys and ideas shaping the city.';
      $coverImage = $cover['image'] ?? 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85';
      $coverCategory = $cover['category'] ?? 'FLAGSHIP EDITION';
      $coverUrl = url('/icons');
  } else {
      $coverTitle = $settings['hero_headline'] ?? 'Bhavnagar, Documented.';
      $coverExcerpt = 'Stories of the people, journeys and ideas shaping the city.';
      $coverImage = 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85';
      $coverCategory = 'FLAGSHIP EDITION';
      $coverUrl = url('/icons');
  }

  $signature = $settings['hero_subline'] ?? 'Selected with purpose. Documented with responsibility.';
@endphp

<!-- ══ 1. HERO BANNER (1.5x Height, Title Inside Image, Excerpt Below) ══ -->
<section class="hero-section-wrap">
  <div class="vogue-container">
    <div class="hero-big-banner" id="hero-banner">
      
      <!-- In the image: Only main headline + CITYICONS watermark (1.5x height) -->
      <div class="hero-big-banner__img-wrap" onclick="location.href='{{ $coverUrl }}'" style="cursor:pointer;">
        <img src="{{ $coverImage }}" alt="{{ $coverTitle }}">
        <div class="hero-big-banner__top-shade"></div>
        <div class="hero-big-banner__brand-stamp">CITYICONS</div>
        <div class="hero-big-banner__bottom-shade"></div>

        <!-- Main description INSIDE the image at the bottom -->
        <div class="hero-big-banner__content-overlay">
          <div class="hero-big-banner__content-box">
            <h1 class="hero-big-banner__hed">{{ $coverTitle }}</h1>
          </div>
        </div>
      </div>

      <!-- Others things OUT of the image (underneath the image) -->
      <div class="hero-big-banner__details">
        <span class="vogue-rubric vogue-rubric--red">{{ $coverCategory }} · BHAVNAGAR ICONS</span>
        <p class="hero-big-banner__dek">{{ $coverExcerpt }}</p>
        <p style="font-family:var(--font-garamond); font-style:italic; font-size:1.15rem; color:var(--vogue-muted); margin-bottom:18px;">
          {{ $signature }}
        </p>

        <!-- Buttons: Explore Icons | Nominate a Story -->
        <div style="display:flex; gap:14px; flex-wrap:wrap; margin-top:16px;">
          <a href="{{ url('/icons') }}" style="display:inline-block; background:var(--vogue-black); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 24px; transition:all 0.2s ease;">
            Explore Icons
          </a>
          <a href="{{ url('/nominate') }}" style="display:inline-block; border:1px solid var(--vogue-black); color:var(--vogue-black); font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:12px 24px; transition:all 0.2s ease;">
            Nominate a Story
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
