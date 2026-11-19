<!-- ══ OFFCANVAS SLIDEOUT DRAWER ════════════════════════════ -->
<div class="vogue-overlay" id="vogue-overlay"></div>
<aside class="vogue-drawer" id="vogue-drawer">
  <button class="vogue-drawer__close" id="btn-close-drawer" aria-label="Close menu">&times;</button>
  
  <div style="margin-bottom:14px;">
    <a href="{{ url('/') }}" aria-label="CityIcons Home">
      <img src="{{ asset('images/logo-cityicons.png') }}" alt="City Icons" style="height:46px; width:auto; display:block; object-fit:contain;">
    </a>
  </div>
  <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:4px;">Bhavnagar Icons · Flagship Edition</div>
  <p style="font-family:var(--font-garamond); font-size:0.95rem; font-style:italic; color:var(--vogue-muted); margin-bottom:24px;">Selected with purpose. Documented with responsibility.</p>
  
  <!-- Main Navigation -->
  <div class="vogue-drawer__title">Editorial Sections</div>
  <ul class="vogue-drawer__menu">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/icons') }}">Icons</a></li>
    <li><a href="{{ url('/rising') }}">Rising</a></li>
    <li><a href="{{ url('/voices') }}">Voices</a></li>
    <li><a href="{{ url('/stories') }}">Stories</a></li>
    <li><a href="{{ url('/the-list') }}">The List</a></li>
    <li><a href="{{ url('/magazine') }}">Magazine</a></li>
    <li><a href="{{ url('/in-bhavnagar') }}">In Bhavnagar (Dispatch)</a></li>
    <li><a href="{{ url('/cities/bhavnagar') }}" style="color:var(--vogue-red); font-weight:700;">Bhavnagar City Subsite</a></li>
    <li><a href="{{ url('/featured-brands') }}">Featured Brands</a></li>
    <li><a href="{{ url('/about') }}">About Platform</a></li>
    <li><a href="{{ url('/nominate') }}" style="color:var(--vogue-red); font-weight:700;">Nominate a Story</a></li>
  </ul>

  <!-- City Editions Directory -->
  <div class="vogue-drawer__title" style="margin-top:20px;">City Editions · Network</div>
  <div class="vogue-drawer__city-grid" id="drawer-cities-grid">
    <a href="{{ url('/cities/bhavnagar') }}" class="vogue-drawer__city-chip" style="border-color:var(--vogue-red); font-weight:800; color:var(--vogue-red);">Bhavnagar (Flagship)</a>
    <a href="{{ url('/cities/mumbai') }}" class="vogue-drawer__city-chip">Mumbai</a>
    <a href="{{ url('/cities/ahmedabad') }}" class="vogue-drawer__city-chip">Ahmedabad</a>
    <a href="{{ url('/cities/surat') }}" class="vogue-drawer__city-chip">Surat</a>
    <a href="{{ url('/cities/rajkot') }}" class="vogue-drawer__city-chip">Rajkot</a>
    <a href="{{ url('/cities/vadodara') }}" class="vogue-drawer__city-chip">Vadodara</a>
    <a href="{{ url('/cities/delhi') }}" class="vogue-drawer__city-chip">Delhi</a>
    <a href="{{ url('/cities/bengaluru') }}" class="vogue-drawer__city-chip">Bengaluru</a>
    <a href="{{ url('/cities/jaipur') }}" class="vogue-drawer__city-chip">Jaipur</a>
    <a href="{{ url('/cities/kolkata') }}" class="vogue-drawer__city-chip">Kolkata</a>
  </div>

  <!-- Editorial Policies -->
  <div class="vogue-drawer__title" style="margin-top:30px;">Standards &amp; Policies</div>
  <ul style="list-style:none; font-size:0.75rem; line-height:2.2; text-transform:uppercase; letter-spacing:1px; font-weight:600; color:var(--vogue-muted);">
    <li><a href="{{ url('/policies/editorial') }}">Editorial Policy</a></li>
    <li><a href="{{ url('/policies/selection') }}">Selection Policy</a></li>
    <li><a href="{{ url('/policies/fact-checking') }}">Fact-Checking Policy</a></li>
    <li><a href="{{ url('/policies/paid-content') }}">Commercial Disclosures</a></li>
    <li><a href="{{ url('/contact') }}">Contact &amp; Submissions</a></li>
  </ul>
</aside>
