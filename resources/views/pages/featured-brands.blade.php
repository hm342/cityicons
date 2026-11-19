@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
@endphp

<x-layouts.app :title="'Featured Brands — ' . $cName . ' Commercial Storytelling & Collaborations · CITYICONS'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="brands" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ strtoupper($cName) }} · COMMERCIAL CONTENT · PAID PARTNERSHIPS</span>
        <h1 class="rm-page-header-title">Featured Brands</h1>
        <p class="rm-page-header-sub">Professional storytelling for brands with something meaningful to communicate.</p>
        <p class="rm-page-header-desc">
          Featured Brands presents paid collaborations with participating businesses, founders, institutions, organisations and events. Every commercial collaboration is clearly disclosed and remains separate from independent editorial categories.
        </p>
        <div style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-red); margin-top:8px;">
          Commercial participation does not influence selection for Icons or Rising.
        </div>
      </div>

      <!-- Commercial Action Header -->
      <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:clamp(24px, 4vw, 40px); border-radius:4px; margin-bottom:48px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:24px;">
        <div style="max-width:760px;">
          <span class="cat-italic" style="color:var(--vogue-red); font-size:1.15rem; margin-bottom:8px;">Commercial Partnership Desk</span>
          <h2 style="font-family:var(--font-sans); font-size:1.6rem; font-weight:700; color:#ffffff; margin:6px 0 10px;">
            Partner with {{ $cName }} Icons
          </h2>
          <p style="font-size:0.95rem; color:var(--text-muted); line-height:1.6; margin:0;">
            We offer bespoke commercial profiles, corporate features, founder stories and cultural documentation. Connect directly with our business desk to request media kit and rates.
          </p>
        </div>

        <div style="display:flex; gap:12px; flex-wrap:wrap;">
          <a href="{{ url('/' . $cSlug . '/contact') }}" class="btn-pill" style="background:var(--vogue-red); padding:12px 28px; margin-top:0;">
            Advertise With Us
          </a>
        </div>
      </div>

      <!-- Active Brand Partners Showcase -->
      @if($brands && $brands->count() > 0)
        <div>
          <div class="section-head" style="padding:0 0 24px; text-align:left;">
            <span class="section-head-title">PARTICIPATING PARTNERS</span>
            <h3 style="font-family:var(--font-sans); font-size:1.6rem; font-weight:700; color:#fff; margin-top:8px;">Credible Commercial Collaborations</h3>
          </div>

          <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:24px;">
            @foreach($brands as $b)
              <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px; display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                  <span style="font-size:0.65rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-red);">
                    {{ $b->disclosure_text ?? 'COMMERCIAL PARTNER' }}
                  </span>
                  <h4 style="font-family:var(--font-sans); font-size:1.35rem; font-weight:700; margin:8px 0 12px; color:#ffffff;">
                    {{ $b->name }}
                  </h4>
                  <p style="font-size:0.92rem; color:var(--text-muted); line-height:1.6; margin-bottom:18px;">
                    {{ $b->description }}
                  </p>
                </div>

                @if($b->website_url)
                  <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:14px;">
                    <a href="{{ $b->website_url }}" target="_blank" rel="noopener noreferrer" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:#ffffff; text-decoration:underline;">
                      Visit Official Site &rarr;
                    </a>
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </main>

</x-layouts.app>
