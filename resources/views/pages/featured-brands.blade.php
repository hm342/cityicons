<x-layouts.app title="Featured Brands — Commercial Storytelling & Collaborations">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <span class="vogue-rubric" style="color:var(--vogue-muted); font-size:0.6rem; letter-spacing:2px;">COMMERCIAL CONTENT · PAID PARTNERSHIPS</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Featured Brands
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:12px;">
          Professional storytelling for brands with something meaningful to communicate.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6; margin-bottom:14px;">
          Featured Brands presents paid collaborations with participating businesses, founders, institutions, organisations and events. Every commercial collaboration is clearly disclosed and remains separate from independent editorial categories.
        </p>
        <p style="font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-red);">
          A paid founder or leadership feature remains commercial brand content and does not confer personal selection as an Icon, Rising profile or Voice.
        </p>
      </div>

      <!-- Active Database Brand Partners Showcase -->
      @if($brands && $brands->count() > 0)
        <div style="margin-bottom:48px;">
          <h2 style="font-family:var(--font-didot); font-size:1.8rem; font-weight:400; margin-bottom:20px;">
            Participating Commercial &amp; Heritage Partners
          </h2>
          <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:24px;">
            @foreach($brands as $b)
              <div style="background:#fff; border:1px solid var(--vogue-border); padding:24px; border-radius:4px; display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                  <span class="vogue-rubric" style="font-size:0.65rem; color:var(--vogue-muted);">
                    {{ $b->disclosure_text ?? 'COMMERCIAL PARTNER' }}
                  </span>
                  <h3 style="font-family:var(--font-didot); font-size:1.35rem; font-weight:600; margin:6px 0 10px;">
                    {{ $b->name }}
                  </h3>
                  <p style="font-size:0.9rem; color:#555; line-height:1.6; margin-bottom:16px;">
                    {{ $b->description }}
                  </p>
                </div>
                @if($b->website_url)
                  <a href="{{ $b->website_url }}" target="_blank" rel="noopener noreferrer" style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-red); text-decoration:none;">
                    Visit Official Site <i class="fas fa-arrow-right" style="font-size:9px; margin-left:4px;"></i>
                  </a>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Formats & Commercial Options -->
      <div style="display:grid; grid-template-columns:1.5fr 1fr; gap:48px; align-items:start; margin-bottom:48px;">
        
        <div>
          <h2 style="font-family:var(--font-didot); font-size:1.6rem; font-weight:400; margin-bottom:16px;">
            Available Partnership Formats
          </h2>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:32px;">
            @foreach([
              'Brand Features' => 'Professionally produced commercial stories created in collaboration with your brand.',
              'Founder & Leadership' => 'In-depth storytelling covering entrepreneurship and organizational milestones.',
              'Business Journeys' => 'Documenting corporate expansion, heritage craftsmanship, and manufacturing scale.',
              'Institutional Profiles' => 'Dedicated features for educational, civic, and hospital institutions.',
              'Sponsored Editorial' => 'Clearly disclosed thematic coverage aligned with industry expertise.',
              'Event Partnerships' => 'Comprehensive multi-platform coverage for summits, galas, and exhibitions.',
              'Website Advertising' => 'Prominent, clutter-free banner placements across our high-intent readership.',
              'Magazine Advertising' => 'Full-page, luxury print & digital magazine placements designed for longevity.'
            ] as $title => $desc)
              <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:20px;">
                <div style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; margin-bottom:6px;">{{ $title }}</div>
                <div style="font-size:0.82rem; color:#555; line-height:1.5;">{{ $desc }}</div>
              </div>
            @endforeach
          </div>

          <!-- Commercial Disclosure Box (Page 14 & 37) -->
          <div style="border-left:3px solid var(--vogue-red); background:#fcfcfc; padding:24px; border:1px solid var(--vogue-border); border-left-width:3px;">
            <span class="vogue-rubric vogue-rubric--red" style="font-size:0.6rem;">STANDARDS &amp; INTEGRITY</span>
            <h3 style="font-family:var(--font-didot); font-size:1.3rem; margin-bottom:8px;">Commercial Disclosure</h3>
            <p style="font-family:var(--font-garamond); font-size:1.1rem; line-height:1.6; color:#333; margin-bottom:10px;">
              {{ $disclosure ?? 'Featured Brands is a paid commercial category. Payment provides visibility only. It does not provide Icon, Rising or Voices status.' }}
            </p>
            <p style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-muted);">
              Every commercial feature carries unambiguous labels: FEATURED BRAND · PAID PARTNERSHIP · SPONSORED · ADVERTISEMENT · EVENT PARTNER.
            </p>
          </div>
        </div>

        <!-- Right Side: Contact & Media Kit (Page 15) -->
        <div id="advertise" style="background:var(--vogue-black); color:#ffffff; padding: clamp(28px, 4vw, 44px);">
          <span class="vogue-rubric" style="color:var(--vogue-red); letter-spacing:2px; margin-bottom:12px;">COLLABORATE</span>
          <h3 style="font-family:var(--font-didot); font-size:1.8rem; font-weight:400; color:#fff; line-height:1.2; margin-bottom:16px;">
            Discuss a Collaboration
          </h3>
          <p style="font-family:var(--font-garamond); font-size:1.1rem; color:rgba(255,255,255,0.85); line-height:1.6; margin-bottom:24px;">
            To discuss sponsored storytelling, brand features, advertising placements, or to request our official Media Kit, get in touch with our partnerships desk.
          </p>

          <div style="margin-bottom:28px;">
            <div style="font-size:0.7rem; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,0.5); margin-bottom:4px;">Direct Email:</div>
            <a href="mailto:advertise@cityicons.in" style="font-family:var(--font-didot); font-size:1.35rem; color:#ffffff; text-decoration:underline;">
              advertise@cityicons.in
            </a>
          </div>

          <div style="display:flex; flex-direction:column; gap:12px;">
            <a href="mailto:advertise@cityicons.in?subject=Collaboration%20Inquiry" style="display:block; text-align:center; background:var(--vogue-red); color:#fff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px; text-decoration:none;">
              Discuss Collaboration
            </a>
            <a href="mailto:advertise@cityicons.in?subject=Media%20Kit%20Request" style="display:block; text-align:center; border:1px solid rgba(255,255,255,0.3); color:#fff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px; text-decoration:none;">
              Request Media Kit
            </a>
          </div>
        </div>

      </div>

    </div>
  </section>

</x-layouts.app>
