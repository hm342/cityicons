<!-- ══ 31. OFFICIAL FOOTER (As Specified in Developer Handoff PDF) ══ -->
<footer class="vogue-footer">
  <div class="vogue-container">
    
    <!-- Top Brand Block -->
    <div class="vogue-footer__logo-wrap" style="margin-bottom:24px; text-align:center;">
      <a href="{{ url('/') }}" style="display:inline-block; margin-bottom:12px;" aria-label="CityIcons Home">
        <img src="{{ asset('images/logo-cityicons-white.png') }}" alt="City Icons" style="height:clamp(48px, 5.5vw, 68px); width:auto; display:block; margin:0 auto; object-fit:contain;">
      </a>
      <a href="{{ url('/cities/bhavnagar') }}" style="display:inline-block; text-decoration:none;" title="Enter Bhavnagar Icons Subsite">
        <div style="font-family:var(--font-sans); font-size:0.75rem; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:6px;">
          Bhavnagar Icons · Flagship Edition <i class="fas fa-arrow-right" style="font-size:9px; margin-left:3px;"></i>
        </div>
      </a>
      <p style="font-family:var(--font-garamond); font-size:1.15rem; color:rgba(255,255,255,0.7); max-width:600px; margin:0 auto 6px;">
        Independent city-focused editorial documentation.
      </p>
      <p style="font-family:var(--font-garamond); font-size:1rem; font-style:italic; color:rgba(255,255,255,0.5);">
        Selected with purpose. Documented with responsibility.
      </p>
    </div>

    <!-- Social Media Links (Page 32 & 38) -->
    <div class="vogue-footer__social" style="margin-bottom:35px;">
      <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="https://linkedin.com" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      <a href="https://x.com" target="_blank" rel="noopener" aria-label="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
      <a href="https://threads.net" target="_blank" rel="noopener" aria-label="Threads"><i class="fa-brands fa-threads"></i></a>
      <a href="https://pinterest.com" target="_blank" rel="noopener" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
    </div>

    <!-- Navigation Columns Grid -->
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:32px; border-top:1px solid rgba(255,255,255,0.12); border-bottom:1px solid rgba(255,255,255,0.12); padding:36px 0; margin-bottom:30px; text-align:left;">
      
      <!-- Explore -->
      <div>
        <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2.5px; text-transform:uppercase; color:#ffffff; margin-bottom:14px;">Explore</div>
        <ul style="list-style:none; font-size:0.8rem; line-height:2.2; color:rgba(255,255,255,0.65);">
          <li><a href="{{ url('/icons') }}">Icons</a></li>
          <li><a href="{{ url('/rising') }}">Rising</a></li>
          <li><a href="{{ url('/voices') }}">Voices</a></li>
          <li><a href="{{ url('/stories') }}">Stories</a></li>
          <li><a href="{{ url('/the-list') }}">The List</a></li>
          <li><a href="{{ url('/magazine') }}">Magazine</a></li>
          <li><a href="{{ url('/in-bhavnagar') }}">In Bhavnagar (Dispatch)</a></li>
          <li><a href="{{ url('/cities/bhavnagar') }}" style="color:var(--vogue-red); font-weight:700;">Bhavnagar City Subsite</a></li>
          <li><a href="{{ url('/featured-brands') }}">Featured Brands</a></li>
        </ul>
      </div>

      <!-- Information -->
      <div>
        <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2.5px; text-transform:uppercase; color:#ffffff; margin-bottom:14px;">Information</div>
        <ul style="list-style:none; font-size:0.8rem; line-height:2.2; color:rgba(255,255,255,0.65);">
          <li><a href="{{ url('/about') }}">About Bhavnagar Icons</a></li>
          <li><a href="{{ url('/nominate') }}">Nominate a Story</a></li>
          <li><a href="{{ url('/featured-brands') }}">Advertise with Us</a></li>
          <li><a href="{{ url('/contact') }}">Contact Team</a></li>
        </ul>
      </div>

      <!-- Policies -->
      <div>
        <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2.5px; text-transform:uppercase; color:#ffffff; margin-bottom:14px;">Policies &amp; Standards</div>
        <ul style="list-style:none; font-size:0.8rem; line-height:2.2; color:rgba(255,255,255,0.65);">
          <li><a href="{{ url('/policies/editorial') }}">Editorial Policy</a></li>
          <li><a href="{{ url('/policies/selection') }}">Selection Policy</a></li>
          <li><a href="{{ url('/policies/fact-checking') }}">Fact-Checking Policy</a></li>
          <li><a href="{{ url('/policies/editorial-integrity') }}">Editorial Integrity</a></li>
          <li><a href="{{ url('/policies/political') }}">Political Policy</a></li>
          <li><a href="{{ url('/policies/corrections') }}">Corrections Policy</a></li>
          <li><a href="{{ url('/policies/paid-content') }}">Paid Content Disclosure</a></li>
          <li><a href="{{ url('/policies/privacy') }}">Privacy Policy</a></li>
          <li><a href="{{ url('/policies/cookies') }}">Cookie Policy</a></li>
          <li><a href="{{ url('/policies/terms') }}">Terms Of Use</a></li>
          <li><a href="{{ url('/policies/accessibility') }}">Accessibility Statement</a></li>
        </ul>
      </div>

      <!-- Contact & Editorial Office -->
      <div>
        <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2.5px; text-transform:uppercase; color:#ffffff; margin-bottom:14px;">Contact Office</div>
        <p style="font-size:0.8rem; line-height:1.8; color:rgba(255,255,255,0.65); margin-bottom:14px;">
          <strong style="color:#ffffff;">Editorial, Nominations &amp; Corrections:</strong><br>
          <a href="mailto:editorial@cityicons.in" style="color:#ffffff; text-decoration:underline;">editorial@cityicons.in</a>
        </p>
        <p style="font-size:0.8rem; line-height:1.8; color:rgba(255,255,255,0.65); margin-bottom:16px;">
          <strong style="color:#ffffff;">Advertising &amp; Collaborations:</strong><br>
          <a href="mailto:advertise@cityicons.in" style="color:#ffffff; text-decoration:underline;">advertise@cityicons.in</a>
        </p>
        <div style="border-top:1px solid rgba(255,255,255,0.1); padding-top:12px; font-size:0.75rem; color:var(--vogue-red); font-weight:700; letter-spacing:1px; text-transform:uppercase;">
          Recognition cannot be bought. Visibility can.
        </div>
      </div>

    </div>

    <!-- City Network Strip -->
    <div class="vogue-footer__cities-title">City Editions Network · India</div>
    <div class="vogue-footer__cities" style="margin-bottom:30px;">
      <a href="{{ url('/') }}" style="color:var(--vogue-white); font-weight:700;">Bhavnagar (Flagship)</a> ·
      <a href="{{ url('/cities/mumbai') }}">Mumbai</a> ·
      <a href="{{ url('/cities/ahmedabad') }}">Ahmedabad</a> ·
      <a href="{{ url('/cities/surat') }}">Surat</a> ·
      <a href="{{ url('/cities/rajkot') }}">Rajkot</a> ·
      <a href="{{ url('/cities/vadodara') }}">Vadodara</a> ·
      <a href="{{ url('/cities/delhi') }}">Delhi</a> ·
      <a href="{{ url('/cities/bengaluru') }}">Bengaluru</a> ·
      <a href="{{ url('/cities/jaipur') }}">Jaipur</a> ·
      <a href="{{ url('/cities/kolkata') }}">Kolkata</a>
    </div>

    <!-- Final Brand Line & Copyright -->
    <div class="vogue-footer__legal">
      <div style="font-family:var(--font-didot); font-size:1.15rem; color:#ffffff; letter-spacing:2px; margin-bottom:8px;">
        Every city has people worth remembering.
      </div>
      &copy; {{ date('Y') }} CityIcons. All rights reserved. Selected with purpose. Documented with responsibility.
    </div>
  </div>
</footer>
