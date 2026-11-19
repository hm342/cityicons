@props(['city' => null])

@php
  $cSlug = $city ? (is_object($city) ? $city->slug : $city) : null;
  $cName = $city ? (is_object($city) ? $city->name : ucfirst($cSlug)) : null;
  $cityTarget = $cSlug ?: 'bhavnagar';
@endphp

<!-- ══ OFFCANVAS SLIDEOUT DRAWER ════════════════════════════ -->
<div class="vogue-overlay" id="vogue-overlay"></div>
<aside class="vogue-drawer" id="vogue-drawer">
  <button class="vogue-drawer__close" id="btn-close-drawer" aria-label="Close menu">&times;</button>
  
  <div style="margin-bottom:14px;">
    <a href="{{ url('/') }}" aria-label="CityIcons Home">
      <img src="{{ asset('images/logo-cityicons.png') }}" alt="City Icons" style="height:46px; width:auto; display:block; object-fit:contain;">
    </a>
  </div>
  <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:4px;">
    {{ $cName ? $cName . ' Icons · ' . ($cSlug === 'bhavnagar' ? 'Flagship Edition' : 'City Edition') : 'Bhavnagar Icons · Flagship Edition' }}
  </div>
  <p style="font-family:var(--font-garamond); font-size:0.95rem; font-style:italic; color:var(--vogue-muted); margin-bottom:24px;">Selected with purpose. Documented with responsibility.</p>
  
  <!-- Main Navigation -->
  <div class="vogue-drawer__title">Editorial Sections</div>
  <ul class="vogue-drawer__menu">
    <li><a href="{{ url('/') }}">National Home</a></li>
    <li><a href="{{ url('/' . $cityTarget) }}" style="color:var(--vogue-red); font-weight:700;">{{ $cName ?: 'Bhavnagar' }} Subsite</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/icons') }}">Icons Directory</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/rising') }}">Rising Talent</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/stories') }}">Editorial Stories</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/the-list') }}">The List</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/magazine') }}">Magazine Archive</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/in-' . $cityTarget) }}">In {{ $cName ?: 'Bhavnagar' }}</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/featured-brands') }}">Featured Brands</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/about') }}">About {{ $cName ?: 'Bhavnagar' }} Icons</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/nominate') }}" style="color:var(--vogue-red); font-weight:700;">Nominate a Story</a></li>
  </ul>

  <!-- City Editions Directory -->
  <div class="vogue-drawer__title" style="margin-top:20px;">City Editions · Network</div>
  <div class="vogue-drawer__city-grid" id="drawer-cities-grid">
    @foreach($navCities ?? [] as $cityItem)
      @php
        $ciSlug = is_object($cityItem) ? $cityItem->slug : (is_array($cityItem) ? ($cityItem['slug'] ?? '') : (string)$cityItem);
        $ciName = is_object($cityItem) ? $cityItem->name : (is_array($cityItem) ? ($cityItem['name'] ?? ucfirst($ciSlug)) : ucfirst($ciSlug));
      @endphp
      <a href="{{ url('/' . $ciSlug) }}" class="vogue-drawer__city-chip" style="{{ $ciSlug === 'bhavnagar' ? 'border-color:var(--vogue-red); font-weight:800; color:var(--vogue-red);' : '' }}">
        {{ $ciName }} {{ $ciSlug === 'bhavnagar' ? '(Flagship)' : '' }}
      </a>
    @endforeach
  </div>

  <!-- Editorial Policies -->
  <div class="vogue-drawer__title" style="margin-top:30px;">Standards &amp; Policies</div>
  <ul style="list-style:none; font-size:0.75rem; line-height:2.2; text-transform:uppercase; letter-spacing:1px; font-weight:600; color:var(--vogue-muted);">
    <li><a href="{{ url('/' . $cityTarget . '/policies/editorial') }}">Editorial Policy</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/policies/selection') }}">Selection Policy</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/policies/fact-checking') }}">Fact-Checking Policy</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/policies/paid-content') }}">Commercial Disclosures</a></li>
    <li><a href="{{ url('/' . $cityTarget . '/contact') }}">Contact &amp; Submissions</a></li>
  </ul>
</aside>
