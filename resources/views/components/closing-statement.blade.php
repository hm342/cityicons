@props(['cityName' => 'Bhavnagar'])

<!-- ══ CLOSING BRAND STATEMENT (As Specified in Section 1 of PDF) ══ -->
<section class="city-edition-section" style="margin-bottom:var(--section-gap);">
  <div class="vogue-container">
    <div style="border-top:1px solid var(--vogue-border); border-bottom:1px solid var(--vogue-border); padding:56px clamp(20px, 4vw, 60px); text-align:center;">
      <div style="font-family:var(--font-didot); font-size:clamp(2rem, 3.5vw, 3.2rem); font-weight:400; line-height:1.2; color:var(--vogue-black); margin-bottom:8px;">
        Not every story needs attention.
      </div>
      <div style="font-family:var(--font-didot); font-size:clamp(2rem, 3.5vw, 3.2rem); font-style:italic; font-weight:400; line-height:1.2; color:var(--vogue-red); margin-bottom:20px;">
        Some deserve permanence.
      </div>
      <p style="font-family:var(--font-garamond); font-size:1.25rem; color:#333333; max-width:700px; margin:0 auto 14px;">
        {{ $cityName === 'India' ? "CityIcons documents the people and stories helping shape the identity and future of India's cities." : $cityName . ' Icons documents the people helping shape the identity and future of the city.' }}
      </p>
      <div style="font-family:var(--font-sans); font-size:0.75rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-muted);">
        Selected with purpose. Documented with responsibility.
      </div>
    </div>
  </div>
</section>
