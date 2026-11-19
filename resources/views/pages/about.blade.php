@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
@endphp

<x-layouts.app :title="'About ' . $cName . ' Icons — Selected with purpose. Documented with responsibility. · CITYICONS'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="about" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ strtoupper($cName) }} ICONS · {{ $isFlagship ? 'FLAGSHIP EDITION' : 'CITY EDITION' }}</span>
        <h1 class="rm-page-header-title">About {{ $cName }} Icons</h1>
        <p class="rm-page-header-sub">Documenting the people who shape the city.</p>
        <p class="rm-page-header-desc">
          An independent editorial platform documenting credible people, meaningful journeys and lasting contributions connected to {{ $cName }}.
        </p>
      </div>

      <!-- Main Editorial Body -->
      <div style="display:grid; grid-template-columns:1.6fr 1fr; gap:48px; align-items:start;">
        
        <div style="font-family:var(--font-sans); font-size:1.15rem; line-height:1.8; color:#d6d6d6;">
          <p style="margin-bottom:20px;">
            <strong>{{ $cName }} Icons</strong> is an independent editorial platform dedicated to documenting credible people, meaningful journeys and lasting contributions connected to {{ $cName }}.
          </p>
          <p style="margin-bottom:20px;">
            We believe recognition should be supported by work, evidence and impact. Our purpose is not to create promotional titles, but to build a responsible editorial record of the city and its people.
          </p>
          <p style="color:var(--text-muted); font-size:1rem; margin-bottom:28px;">
            {{ $cName }} Icons is {{ $isFlagship ? 'the flagship city edition' : 'an official city edition' }} of <strong>CityIcons</strong>, an independent city-focused editorial publishing network.
          </p>

          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px; margin-bottom:32px;">
            <span class="cat-italic" style="color:var(--vogue-red); font-size:1.1rem; margin-bottom:8px;">Core Editorial Principles</span>
            <ul style="list-style:disc; padding-left:20px; line-height:1.8; font-size:1rem; color:var(--text-muted); margin-top:8px;">
              <li><strong>Evidence Over Popularity:</strong> Every profile is verified against demonstrable work and credible contribution.</li>
              <li><strong>Zero Commercial Influence:</strong> Editorial selection cannot be bought. Commercial collaborations are clearly isolated and labeled.</li>
              <li><strong>Permanence:</strong> Curated to outlast transient social media feeds and preserve the city's historical continuity.</li>
            </ul>
          </div>
        </div>

        <aside>
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px; margin-bottom:24px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:10px;">
              Get In Touch
            </div>
            <h3 style="font-family:var(--font-sans); font-size:1.35rem; font-weight:700; color:#fff; margin-bottom:10px;">
              Editorial Desk
            </h3>
            <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6; margin-bottom:16px;">
              For submissions, feedback, or factual inquiries:
            </p>
            <a href="mailto:editorial@cityicons.in" style="color:#ffffff; font-weight:700; text-decoration:underline;">
              editorial@cityicons.in
            </a>
          </div>

          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:10px;">
              Participate
            </div>
            <h4 style="font-family:var(--font-sans); font-size:1.25rem; font-weight:700; color:#fff; margin-bottom:10px;">
              Nominate a Story
            </h4>
            <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6; margin-bottom:18px;">
              Know an individual or achievement worth documenting in {{ $cName }}?
            </p>
            <a href="{{ url('/' . $cSlug . '/nominate') }}" class="btn-pill" style="background:var(--vogue-red); margin-top:0;">
              Submit Nomination
            </a>
          </div>
        </aside>

      </div>

    </div>
  </main>

</x-layouts.app>
