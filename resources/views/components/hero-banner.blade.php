@props([
  'cover' => [
    'title' => 'Bhavnagar, Documented.',
    'excerpt' => 'Stories of the people, journeys and ideas shaping the city.',
    'signature' => 'Selected with purpose. Documented with responsibility.',
    'image' => 'https://images.unsplash.com/photo-1598511757337-fe2cafc31ba0?w=1600&q=85',
    'category' => 'FLAGSHIP EDITION',
  ]
])

<!-- ══ 1. HERO (As Specified in Section 1 of Developer Handoff PDF) ══ -->
<section class="hero-section-wrap">
  <div class="vogue-container">
    <div class="hero-big-banner" id="hero-banner">
      
      <!-- In the image: Only main headline + CITYICONS watermark (1.5x height) -->
      <div class="hero-big-banner__img-wrap" onclick="location.href='{{ url('/icons') }}'">
        <img src="{{ $cover['image'] }}" alt="{{ $cover['title'] }}">
        <div class="hero-big-banner__top-shade"></div>
        <div class="hero-big-banner__brand-stamp">CITYICONS</div>
        <div class="hero-big-banner__bottom-shade"></div>

        <!-- Main description INSIDE the image at the bottom -->
        <div class="hero-big-banner__content-overlay">
          <div class="hero-big-banner__content-box">
            <h1 class="hero-big-banner__hed">{{ $cover['title'] }}</h1>
          </div>
        </div>
      </div>

      <!-- Others things OUT of the image (underneath the image) -->
      <div class="hero-big-banner__details">
        <span class="vogue-rubric vogue-rubric--red">{{ $cover['category'] }} · BHAVNAGAR ICONS</span>
        <p class="hero-big-banner__dek">{{ $cover['excerpt'] }}</p>
        <p style="font-family:var(--font-garamond); font-style:italic; font-size:1.1rem; color:var(--vogue-muted); margin-bottom:18px;">
          {{ $cover['signature'] }}
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
