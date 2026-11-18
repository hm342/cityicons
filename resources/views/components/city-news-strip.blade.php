<!-- ══ 4. CITY NEWS CAROUSEL / TICKER BAR ═══════════════════ -->
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
      {{ $slot }}
    </div>
  </div>
</section>
