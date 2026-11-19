@props([
  'brands' => collect()
])

<!-- ══ FEATURED BRANDS (Section 9 & 30 of Developer Handoff PDF) ══ -->
<section id="sec-featured-brands" class="city-edition-section" style="margin-bottom:var(--section-gap);">
  <div class="vogue-container">
    <div class="section-hed-bar">
      <div>
        <span class="vogue-rubric" style="color:var(--vogue-muted); font-size:0.6rem; letter-spacing:2px;">COMMERCIAL CONTENT</span>
        <h2 class="section-hed-title" style="margin-top:2px;">Featured Brands</h2>
      </div>
      <a href="{{ url('/featured-brands') }}" class="section-hed-link">
        <span>Explore Commercial Features</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <!-- Editorial Disclosure Header -->
    <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:28px 32px; margin-bottom:28px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
      <div style="max-width:780px;">
        <span style="display:inline-block; font-size:0.625rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:var(--vogue-black); color:#fff; padding:3px 10px; margin-bottom:8px;">
          FEATURED BRAND · PAID PARTNERSHIP
        </span>
        <h3 style="font-family:var(--font-didot); font-size:1.35rem; font-weight:400; margin-bottom:6px;">
          Credible brands. Clearly disclosed collaborations.
        </h3>
        <p style="font-family:var(--font-garamond); font-size:1.05rem; color:#444444; line-height:1.5; margin-bottom:6px;">
          Explore clearly disclosed commercial features and collaborations produced with participating brands, businesses, institutions and organisations.
        </p>
        <p style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-red);">
          Commercial participation does not influence selection for Icons or Rising.
        </p>
      </div>

      <div style="display:flex; gap:10px;">
        <a href="{{ url('/bhavnagar/featured-brands') }}" style="display:inline-block; border:1px solid var(--vogue-black); padding:10px 18px; font-size:0.7rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-black);">
          Explore Brands
        </a>
        <a href="{{ url('/bhavnagar/featured-brands') }}" style="display:inline-block; background:var(--vogue-black); color:#ffffff; padding:10px 18px; font-size:0.7rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
          Advertise With Us
        </a>
      </div>
    </div>

    <!-- Real Database Brand Partners Grid -->
    @if($brands && $brands->count() > 0)
      <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
        @foreach($brands as $b)
          <div style="background:#fff; border:1px solid var(--vogue-border); padding:24px; border-radius:4px; display:flex; flex-direction:column; justify-content:space-between;">
            <div>
              <span class="vogue-rubric" style="font-size:0.65rem; color:var(--vogue-muted);">
                {{ $b->disclosure_text ?? 'PARTNER CONTENT' }}
              </span>
              <h4 style="font-family:var(--font-didot); font-size:1.2rem; font-weight:600; margin:6px 0 10px;">
                {{ $b->name }}
              </h4>
              <p style="font-size:0.85rem; color:#555; line-height:1.6; margin-bottom:14px;">
                {{ $b->description }}
              </p>
            </div>
            @if($b->website_url)
              <a href="{{ $b->website_url }}" target="_blank" rel="noopener noreferrer" style="font-size:0.72rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-red); text-decoration:none;">
                Visit Partner Site <i class="fas fa-arrow-right" style="font-size:9px; margin-left:4px;"></i>
              </a>
            @endif
          </div>
        @endforeach
      </div>
    @endif

  </div>
</section>
