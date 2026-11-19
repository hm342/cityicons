@props([
  'articles' => collect()
])

<!-- ══ CITY NEWS CAROUSEL / TICKER BAR ═══════════════════ -->
<section class="city-news-strip-section">
  <div class="vogue-container">
    <div class="news-strip-header">
      <span class="news-strip-title">Latest City Dispatch · Across India</span>
      <div class="news-strip-controls">
        <button class="strip-control-btn" id="btn-strip-prev" aria-label="Previous news">&#10094;</button>
        <button class="strip-control-btn" id="btn-strip-next" aria-label="Next news">&#10095;</button>
      </div>
    </div>
    <div class="city-news-track" id="city-news-track">
      @if($articles && $articles->count() > 0)
        @foreach($articles as $art)
          <div class="city-news-item" onclick="location.href='{{ url('/article/' . $art->id) }}'" style="cursor:pointer;">
            <span class="news-item-city">{{ $art->category ? $art->category->name : 'DISPATCH' }}</span>
            <span class="news-item-headline">{{ $art->title }}</span>
            <span class="news-item-time">{{ $art->created_at->diffForHumans(null, true) }}</span>
          </div>
        @endforeach
      @else
        {{ $slot }}
      @endif
    </div>
  </div>
</section>
