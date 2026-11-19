@props([
  'title' => 'Every city has people worth remembering.',
  'rubric' => 'EDITORIAL MANIFESTO',
  'lead' => 'CityIcons is an independent pan-India editorial platform documenting credible people, meaningful journeys and lasting contributions across India’s defining cities.',
  'tagline' => 'We focus on evidence, context and impact, not popularity alone.'
])

<!-- ══ INTRODUCTION MANIFESTO ══════════════════════════════════ -->
<section class="city-edition-section" style="margin-bottom:var(--section-gap);">
  <div class="vogue-container">
    <div style="border-top:2px solid var(--vogue-black); border-bottom:1px solid var(--vogue-border); padding:44px clamp(20px, 4vw, 60px); background:var(--vogue-bg-light); text-align:center;">
      <span class="vogue-rubric vogue-rubric--red" style="margin-bottom:12px;">{{ $rubric }}</span>
      <h2 style="font-family:var(--font-didot); font-size:clamp(1.8rem, 3.2vw, 2.8rem); font-weight:400; line-height:1.2; color:var(--vogue-black); margin-bottom:16px;">
        {{ $title }}
      </h2>
      <p style="font-family:var(--font-garamond); font-size:clamp(1.15rem, 1.4vw, 1.35rem); line-height:1.65; color:#333333; max-width:850px; margin:0 auto 16px;">
        {{ $lead }}
      </p>
      <p style="font-family:var(--font-sans); font-size:0.875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black);">
        {{ $tagline }}
      </p>
    </div>
  </div>
</section>
