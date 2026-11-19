@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
@endphp

<x-layouts.app :title="'About ' . $cName . ' Icons — Selected with purpose. Documented with responsibility.'" :city="$city ?? null">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:8px;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ strtoupper($cName) }} ICONS · {{ $isFlagship ? 'FLAGSHIP EDITION' : 'CITY EDITION' }}
          </span>
          <a href="{{ url('/' . $cSlug) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
            &larr; Back to {{ $cName }} Subsite
          </a>
        </div>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 3.8rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          About {{ $cName }} Icons
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.3rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3;">
          Documenting the people who shape the city.
        </p>
      </div>

      <!-- Main Editorial Body -->
      <div style="display:grid; grid-template-columns:1.6fr 1fr; gap:48px; align-items:start;">
        
        <div>
          <div style="font-family:var(--font-garamond); font-size:1.35rem; line-height:1.7; color:#222; margin-bottom:28px;">
            <p style="margin-bottom:20px;">
              <strong>{{ $cName }} Icons</strong> is an independent editorial platform dedicated to documenting credible people, meaningful journeys and lasting contributions connected to {{ $cName }}.
            </p>
            <p style="margin-bottom:20px;">
              We believe recognition should be supported by work, evidence and impact. Our purpose is not to create promotional titles, but to build a responsible editorial record of the city and its people.
            </p>
            <p style="color:var(--vogue-muted); font-size:1.15rem;">
              {{ $cName }} Icons is {{ $isFlagship ? 'the flagship city edition' : 'an official city edition' }} of <strong>CityIcons</strong>, a city-focused editorial publishing platform.
            </p>
          </div>

          <!-- Editorial Principles (Page 15) -->
          <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:32px 36px; margin-bottom:36px;">
            <h2 style="font-family:var(--font-didot); font-size:1.6rem; font-weight:400; margin-bottom:18px;">
              Our Editorial Principles
            </h2>
            <ul style="list-style:none; line-height:2.2; font-size:0.95rem; font-weight:600; color:#222;">
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> Selection over submission</li>
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> Evidence over adjectives</li>
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> Context over résumé</li>
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> Permanence over temporary attention</li>
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> Editorial independence over paid recognition</li>
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> City relevance over follower count</li>
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> Verification before publication</li>
              <li><span style="color:var(--vogue-red); margin-right:8px;">—</span> Clear separation between editorial and commercial content</li>
            </ul>
          </div>

          <!-- What We Are Not (Page 15) -->
          <div style="border-left:3px solid var(--vogue-red); padding-left:24px; margin-bottom:36px;">
            <h3 style="font-family:var(--font-didot); font-size:1.35rem; margin-bottom:10px;">What We Are Not</h3>
            <p style="font-family:var(--font-garamond); font-size:1.15rem; line-height:1.6; color:#444; margin-bottom:10px;">
              {{ $cName }} Icons is not an award programme, ranking platform, membership club or paid recognition service.
            </p>
            <p style="font-size:0.85rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-muted);">
              Being nominated, advertised or commercially associated with us does not guarantee editorial selection.
            </p>
          </div>

          <!-- Our Purpose (Page 15) -->
          <div>
            <h3 style="font-family:var(--font-didot); font-size:1.35rem; margin-bottom:8px;">Our Purpose</h3>
            <p style="font-family:var(--font-garamond); font-size:1.25rem; line-height:1.6; color:#222; margin-bottom:8px;">
              To document credible work and meaningful journeys with accuracy, context and responsibility.
            </p>
            <p style="font-family:var(--font-garamond); font-size:1.15rem; font-style:italic; color:var(--vogue-muted);">
              Selected with purpose. Documented with responsibility.
            </p>
          </div>

        </div>

        <!-- Right Side Sidebar -->
        <div style="background:#ffffff; border:1px solid var(--vogue-border); padding:32px;">
          <h3 style="font-family:var(--font-sans); font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-black); margin-bottom:16px;">
            Quick Facts
          </h3>
          <ul style="list-style:none; font-size:0.85rem; line-height:2; color:#555; margin-bottom:28px;">
            <li><strong>Parent Brand:</strong> CityIcons</li>
            <li><strong>Edition:</strong> {{ $cName }} Icons ({{ $isFlagship ? 'Flagship Edition' : 'City Edition' }})</li>
            <li><strong>Domain:</strong> cityicons.in</li>
            <li><strong>Editorial Contact:</strong> editorial@cityicons.in</li>
            <li><strong>Advertising:</strong> advertise@cityicons.in</li>
          </ul>

          <div style="border-top:1px solid var(--vogue-border); padding-top:20px;">
            <span class="vogue-rubric vogue-rubric--red" style="font-size:0.6rem;">GET INVOLVED</span>
            <p style="font-size:0.85rem; color:#444; line-height:1.5; margin-bottom:16px;">
              Help us discover individuals with genuine achievement and credible contributions.
            </p>
            <a href="{{ url('/' . $cSlug . '/nominate') }}" style="display:block; text-align:center; background:var(--vogue-black); color:#fff; font-size:0.7rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:12px; transition:opacity 0.2s;">
              Nominate a Story for {{ $cName }}
            </a>
          </div>
        </div>

      </div>

    </div>
  </section>

</x-layouts.app>
