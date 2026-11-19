@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
@endphp

<x-layouts.app :title="'Contact — ' . $cName . ' Icons: Editorial & Advertising Offices'" :city="$city ?? null">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:8px;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ strtoupper($cName) }} ICONS · COMMUNICATION &amp; ENQUIRIES
          </span>
          <a href="{{ url('/' . $cSlug) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
            &larr; Back to {{ $cName }} Subsite
          </a>
        </div>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Contact
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3;">
          For editorial communication, advertising, factual corrections or general enquiries, contact the appropriate team.
        </p>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; margin-bottom:48px;">
        
        <!-- Editorial Desk -->
        <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:36px;">
          <span class="vogue-rubric vogue-rubric--red" style="font-size:0.65rem;">EDITORIAL OFFICE</span>
          <h2 style="font-family:var(--font-didot); font-size:1.6rem; font-weight:400; margin-bottom:12px;">
            Editorial, Nominations &amp; Corrections
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.1rem; color:#444; line-height:1.6; margin-bottom:20px;">
            Reach our editorial research desk to submit story tips, nominate candidates, provide factual updates, or request corrections under our transparent Corrections Policy.
          </p>
          <div style="margin-top:auto;">
            <div style="font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted); margin-bottom:4px;">Direct Email:</div>
            <a href="mailto:editorial@cityicons.in" style="font-family:var(--font-didot); font-size:1.4rem; color:var(--vogue-black); text-decoration:underline;">
              editorial@cityicons.in
            </a>
          </div>
        </div>

        <!-- Advertising Desk -->
        <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:36px;">
          <span class="vogue-rubric" style="color:var(--vogue-black); font-size:0.65rem;">COMMERCIAL DESK</span>
          <h2 style="font-family:var(--font-didot); font-size:1.6rem; font-weight:400; margin-bottom:12px;">
            Advertising &amp; Brand Collaborations
          </h2>
          <p style="font-family:var(--font-garamond); font-size:1.1rem; color:#444; line-height:1.6; margin-bottom:20px;">
            Discuss commercial partnerships, founder stories, brand features, magazine advertising, and custom storytelling for brands looking to reach {{ $cName }}'s most influential decision-makers.
          </p>
          <div style="margin-top:auto;">
            <div style="font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted); margin-bottom:4px;">Direct Email:</div>
            <a href="mailto:advertise@cityicons.in" style="font-family:var(--font-didot); font-size:1.4rem; color:var(--vogue-black); text-decoration:underline;">
              advertise@cityicons.in
            </a>
          </div>
        </div>

      </div>

      <!-- Response Notice (Page 17) -->
      <div style="background:#ffffff; border-left:3px solid var(--vogue-red); border:1px solid var(--vogue-border); border-left-width:3px; padding:24px 30px;">
        <h3 style="font-family:var(--font-didot); font-size:1.3rem; margin-bottom:6px;">Response Notice</h3>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#333; line-height:1.6; margin-bottom:6px;">
          We review all relevant communication, but response times may vary.
        </p>
        <p style="font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-muted);">
          Sending information, photographs or supporting material does not guarantee coverage or publication.
        </p>
      </div>

    </div>
  </section>

</x-layouts.app>
