@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
@endphp

<x-layouts.app :title="$cName . ' Icons Magazine — Stories designed to outlast the feed · CITYICONS'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="magazine" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ strtoupper($cName) }} · CURATED PRINT &amp; DIGITAL EDITION</span>
        <h1 class="rm-page-header-title">{{ $cName }} Icons Magazine</h1>
        <p class="rm-page-header-sub">Stories designed to last beyond the feed.</p>
        <p class="rm-page-header-desc">
          {{ $cName }} Icons Magazine presents selected profiles, verified journeys and defining stories from the city in a curated editorial format. Each edition contributes to a permanent archive of {{ $cName }} and its people.
        </p>
      </div>

      <!-- Current Magazine Showcase Banner -->
      @if($currentIssue)
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:48px; background:#242424; border:1px solid rgba(255,255,255,0.08); padding:clamp(32px, 5vw, 56px); border-radius:4px; margin-bottom:60px; align-items:center;">
          <div>
            <span class="cat-italic" style="color:var(--vogue-red); font-size:1.15rem; margin-bottom:12px;">
              Current Edition · Issue #{{ str_pad($currentIssue->issue_number, 2, '0', STR_PAD_LEFT) }}
            </span>
            <h2 style="font-family:var(--font-sans); font-size:clamp(2rem, 3.2vw, 2.8rem); font-weight:700; line-height:1.2; margin:10px 0 16px; color:#ffffff;">
              {{ $currentIssue->title }}
            </h2>
            <p style="font-family:var(--font-sans); font-size:1.05rem; line-height:1.65; color:var(--text-muted); margin-bottom:24px;">
              {{ $currentIssue->description }}
            </p>

            <div style="display:flex; gap:14px; flex-wrap:wrap;">
              <a href="{{ url('/' . $cSlug . '/stories') }}" class="btn-pill" style="background:var(--vogue-red); padding:12px 28px; margin-top:0;">
                Explore {{ $cName }} Stories
              </a>
              <a href="{{ url('/' . $cSlug . '/nominate') }}" class="btn-pill" style="background:#333333; padding:12px 28px; margin-top:0;">
                Nominate for Next Issue
              </a>
            </div>
          </div>

          <div style="text-align:center;">
            <div style="position:relative; aspect-ratio:3/4; max-width:340px; margin:0 auto; overflow:hidden; box-shadow:0 18px 40px rgba(0,0,0,0.6); background:#000; border-radius:4px;">
              <img src="{{ $currentIssue->cover_image ?: 'https://images.unsplash.com/photo-1706285654021-4b2f69f0e773?w=1000&q=85' }}" alt="{{ $currentIssue->title }}" style="width:100%; height:100%; object-fit:cover;">
              <div style="position:absolute; top:20px; right:20px; font-family:var(--font-sans); font-size:1.3rem; font-weight:800; letter-spacing:4px; color:#fff; text-shadow:0 2px 8px rgba(0,0,0,0.6);">CITYICONS</div>
            </div>
          </div>
        </div>
      @endif

      <!-- Previous Archive Editions -->
      @if(isset($pastIssues) && $pastIssues->count() > 0)
        <div>
          <div class="section-head" style="padding:0 0 24px;">
            <span class="section-head-title">ARCHIVE EDITIONS</span>
            <h3 style="font-family:var(--font-sans); font-size:1.6rem; font-weight:700; color:#fff; margin-top:8px;">Explore Past Issues</h3>
          </div>

          <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:24px;">
            @foreach($pastIssues as $issue)
              <div style="background:#242424; border:1px solid rgba(255,255,255,0.06); border-radius:4px; overflow:hidden;">
                <div style="aspect-ratio:3/4; overflow:hidden; position:relative;">
                  <img src="{{ $issue->cover_image ?: 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=600&q=80' }}" alt="{{ $issue->title }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div style="padding:16px;">
                  <span class="cat-italic" style="font-size:0.9rem;">Issue #{{ $issue->issue_number }}</span>
                  <h4 style="font-family:var(--font-sans); font-size:1.05rem; font-weight:700; margin:4px 0 8px; color:#fff;">{{ $issue->title }}</h4>
                  <div style="font-size:0.75rem; color:var(--text-dim);">{{ $issue->month_name }} {{ $issue->year }}</div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </main>

</x-layouts.app>
