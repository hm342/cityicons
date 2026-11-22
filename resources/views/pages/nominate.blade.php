@php
  $isCitySpecific = !empty($city);
  $cName = $isCitySpecific ? (is_object($city) ? $city->name : ucfirst($city)) : 'CityIcons';
  $cSlug = $isCitySpecific ? (is_object($city) ? $city->slug : strtolower($city)) : '';
@endphp

<x-layouts.app :title="'Nominate A Story — ' . ($isCitySpecific ? $cName . ' Icons' : 'CityIcons Network') . ' · CITYICONS'" :city="$city ?? null" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$city" active="nominate" />

  <main style="padding: 40px 0 80px;">
    <div class="rm-container">
      
      <!-- Page Header -->
      <div class="rm-page-header">
        <span class="section-head-title">{{ $isCitySpecific ? strtoupper($cName) : 'ALL-INDIA' }} · EDITORIAL NOMINATION</span>
        <h1 class="rm-page-header-title">Nominate A Story{{ $isCitySpecific ? ' for ' . $cName : '' }}</h1>
        <p class="rm-page-header-sub">Help us discover people worth documenting.</p>
        <p class="rm-page-header-desc">
          You may nominate yourself or another individual for editorial consideration by CityIcons. Nominations are reviewed based on city connection, body of work, verifiable achievement, contribution and lasting relevance.
        </p>
      </div>

      @if(session('success'))
        <div style="background:#1b3d22; border:1px solid #2e7d32; color:#a5d6a7; padding:18px 24px; border-radius:4px; margin-bottom:30px; font-size:0.95rem; font-weight:600;">
          {{ session('success') }}
        </div>
      @endif

      <div style="display:grid; grid-template-columns:1.8fr 1fr; gap:48px; align-items:start;">
        
        <!-- Nomination Form -->
        <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:clamp(24px, 4vw, 44px); border-radius:4px;">
          <form action="{{ url('/nominate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <h3 style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:#ffffff; margin-bottom:18px; border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:8px;">
              1. Nominee Information
            </h3>

            <!-- Nominee Name -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:18px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Nominee's Full Name *</label>
                <input type="text" name="nominee_name" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Preferred Public Name</label>
                <input type="text" name="public_name" style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
            </div>

            <!-- Profession & Connection -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:18px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Profession / Current Designation *</label>
                <input type="text" name="profession" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">City Connection *</label>
                <input type="text" name="city_connection" value="{{ $isCitySpecific ? $cName : '' }}" placeholder="e.g. {{ $isCitySpecific ? $cName : 'Bhavnagar, Mumbai' }}" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
            </div>

            <!-- Category -->
            <div style="margin-bottom:18px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Category or Field *</label>
              <select name="category" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
                <option value="" style="background:#191919;">Select Category</option>
                <option value="Business" style="background:#191919;">Business</option>
                <option value="Arts" style="background:#191919;">Arts & Culture</option>
                <option value="Education" style="background:#191919;">Education</option>
                <option value="Healthcare" style="background:#191919;">Healthcare</option>
                <option value="Sports" style="background:#191919;">Sports</option>
                <option value="Public Service" style="background:#191919;">Public Service</option>
                <option value="Innovation" style="background:#191919;">Innovation & Tech</option>
                <option value="Social Impact" style="background:#191919;">Social Impact</option>
              </select>
            </div>

            <!-- About Nominee -->
            <div style="margin-bottom:18px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">About the Nominee *</label>
              <textarea name="about_nominee" rows="4" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;"></textarea>
            </div>

            <!-- Key Achievements -->
            <div style="margin-bottom:18px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Key Achievements *</label>
              <textarea name="achievements" rows="3" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;"></textarea>
            </div>

            <!-- Supporting Links & Website -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:18px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Supporting Links</label>
                <input type="text" name="supporting_links" placeholder="News, citations, articles" style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Official Website or Social Profile</label>
                <input type="text" name="profile_link" style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
            </div>

            <!-- Why should this story be documented -->
            <div style="margin-bottom:24px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Why should this story be documented? *</label>
              <textarea name="why_documented" rows="3" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;"></textarea>
            </div>

            <h3 style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:#ffffff; margin-bottom:18px; border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:8px;">
              2. Nominator Details
            </h3>

            <!-- Nominator Information -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px; margin-bottom:28px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Nominator's Name *</label>
                <input type="text" name="nominator_name" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Email Address *</label>
                <input type="email" name="email" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px; color:var(--text-muted);">Contact Number *</label>
                <input type="tel" name="phone" required style="width:100%; padding:12px; background:#191919; border:1px solid rgba(255,255,255,0.12); color:#fff; font-family:inherit; font-size:0.9rem; border-radius:4px;">
              </div>
            </div>

            <!-- Consent & Checkboxes -->
            <h3 style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:#ffffff; margin-bottom:14px;">
              3. Consent &amp; Confirmations
            </h3>

            <div style="background:#1a1a1a; border:1px solid rgba(255,255,255,0.08); padding:20px; border-radius:4px; margin-bottom:24px; font-size:0.85rem; line-height:1.7; color:var(--text-muted);">
              <label style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; cursor:pointer;">
                <input type="checkbox" name="confirm_accurate" required style="margin-top:4px;">
                <span>I confirm that the submitted information is accurate to the best of my knowledge. *</span>
              </label>

              <label style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; cursor:pointer;">
                <input type="checkbox" name="confirm_permission" required style="margin-top:4px;">
                <span>I confirm that I have permission to submit the supporting material. *</span>
              </label>

              <label style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; cursor:pointer;">
                <input type="checkbox" name="confirm_editorial" required style="margin-top:4px;">
                <span>I consent to the use of this information for editorial review. *</span>
              </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-pill" style="width:100%; padding:16px; font-size:0.85rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:var(--vogue-red); color:#fff; border-radius:4px; margin-top:0;">
              Submit Nomination
            </button>
          </form>
        </div>

        <!-- Sidebar Notice -->
        <div>
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px; margin-bottom:24px;">
            <span class="cat-italic" style="color:var(--vogue-red); font-size:1.1rem; margin-bottom:8px;">Editorial Policy</span>
            <h3 style="font-family:var(--font-sans); font-size:1.4rem; font-weight:700; color:#fff; margin-bottom:10px;">
              Important Notice
            </h3>
            <p style="font-size:0.88rem; line-height:1.6; color:var(--text-muted); margin-bottom:12px;">
              CityIcons retains complete editorial independence over selection, category, framing, presentation and publication timing.
            </p>
            <p style="font-size:0.88rem; line-height:1.6; color:var(--text-muted); margin-bottom:12px;">
              A nomination is a starting point, not a guarantee of publication.
            </p>
            <p style="font-size:0.88rem; line-height:1.6; color:var(--text-muted);">
              Commercial profiles are handled separately through our <a href="{{ url('/' . $cSlug . '/featured-brands') }}" style="text-decoration:underline; font-weight:700; color:#fff;">Featured Brands</a> desk.
            </p>
          </div>

          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:24px; border-radius:4px;">
            <h4 style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:#fff; margin-bottom:8px;">
              Need Assistance?
            </h4>
            <p style="font-size:0.85rem; color:var(--text-muted); line-height:1.6; margin:0;">
              For inquiries regarding the nomination process or editorial criteria, write to:<br>
              <a href="mailto:editorial@cityicons.in" style="font-weight:700; color:#ffffff; text-decoration:underline;">editorial@cityicons.in</a>
            </p>
          </div>
        </div>

      </div>

    </div>
  </main>

</x-layouts.app>
