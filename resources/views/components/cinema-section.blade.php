@props([
  'cityId' => 'bhavnagar',
  'cityName' => 'In Bhavnagar',
  'exploreUrl' => null,
  'articles' => collect()
])

@php
  $exploreUrl = $exploreUrl ?? url('/in-bhavnagar');
  $leadArticle = $articles && $articles->count() > 0 ? $articles->first() : null;
  $moreArticles = $articles && $articles->count() > 1 ? $articles->slice(1) : collect();
@endphp

<!-- ══ CINEMATIC CITY SECTION: {{ strtoupper($cityName) }} ══ -->
<section class="city-cinema-section" id="sec-{{ $cityId }}">
  <div class="vogue-container">
    <div class="section-hed-bar">
      <h2 class="section-hed-title">{{ $cityName }}</h2>
      <a href="{{ $exploreUrl }}" class="section-hed-link">
        <span>Explore {{ $cityName }}</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <!-- Big Cinematic Image Banner -->
    <div class="city-cinema-banner" id="{{ $cityId }}-cinema-banner">
      @if($leadArticle)
        <div class="cinema-banner-card" onclick="location.href='{{ url('/article/' . $leadArticle->id) }}'" style="cursor:pointer; position:relative; overflow:hidden; border-radius:4px;">
          <img src="{{ $leadArticle->cover_image ?: 'https://images.unsplash.com/photo-1604480132736-44c188fe4d20?w=1400&q=80' }}" alt="{{ $leadArticle->title }}" style="width:100%; height:clamp(320px, 45vh, 480px); object-fit:cover; display:block;">
          <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 60%);"></div>
          <div style="position:absolute; bottom:0; left:0; right:0; padding:28px; color:#fff;">
            <span class="vogue-rubric vogue-rubric--red" style="color:#ff6b6b; font-weight:800;">
              {{ $leadArticle->category ? strtoupper($leadArticle->category->name) : 'LOCAL FEATURE' }}
            </span>
            <h3 style="font-family:var(--font-didot); font-size:clamp(1.5rem, 2.8vw, 2.4rem); font-weight:400; line-height:1.2; margin:8px 0 10px; color:#fff;">
              {{ $leadArticle->title }}
            </h3>
            <p style="font-family:var(--font-garamond); font-size:1.1rem; line-height:1.5; color:#eee; max-width:720px;">
              {{ $leadArticle->excerpt }}
            </p>
          </div>
        </div>
      @else
        {{ $banner ?? '' }}
      @endif
    </div>

    <!-- Carousel of other stories below -->
    <div class="city-cinema-carousel-wrap">
      <div class="city-cinema-carousel-header">
        <span style="font-family:var(--font-sans); font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase;">More From {{ $cityName }}</span>
        <div class="news-strip-controls">
          <button class="strip-control-btn" id="btn-ahmd-prev" aria-label="Previous">&#10094;</button>
          <button class="strip-control-btn" id="btn-ahmd-next" aria-label="Next">&#10095;</button>
        </div>
      </div>
      <div class="city-cinema-carousel-track" id="{{ $cityId }}-cinema-track">
        @if($moreArticles->count() > 0)
          @foreach($moreArticles as $art)
            <div class="cinema-carousel-item" onclick="location.href='{{ url('/article/' . $art->id) }}'" style="cursor:pointer; flex:0 0 280px;">
              <div style="height:170px; overflow:hidden; border-radius:4px; margin-bottom:10px;">
                <img src="{{ $art->cover_image ?: 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80' }}" alt="{{ $art->title }}" style="width:100%; height:100%; object-fit:cover; transition:transform 0.3s ease;">
              </div>
              <span class="vogue-rubric">{{ $art->category ? $art->category->name : 'STORY' }}</span>
              <h4 style="font-family:var(--font-didot); font-size:1rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">
                {{ Str::limit($art->title, 55) }}
              </h4>
              <div style="font-size:0.75rem; color:var(--vogue-muted);">
                By {{ $art->author_name ?? 'Editorial Staff' }}
              </div>
            </div>
          @endforeach
        @else
          {{ $slot }}
        @endif
      </div>
    </div>
  </div>
</section>
