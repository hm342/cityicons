@php
  $cName = isset($city) ? $city->name : 'All India';
  $cSlug = isset($city) ? $city->slug : null;
  $isCitySpecific = !empty($cSlug);
@endphp

<x-layouts.app :title="'Nominate A Story — ' . ($isCitySpecific ? $cName . ' Icons' : 'CityIcons Network')" :city="$city ?? null">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:8px;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ strtoupper($cName) }} · EDITORIAL NOMINATION
          </span>
          @if($isCitySpecific)
            <a href="{{ url('/' . $cSlug) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
              &larr; Back to {{ $cName }} Subsite
            </a>
          @endif
        </div>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 3.8rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Nominate A Story{{ $isCitySpecific ? ' for ' . $cName : '' }}
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 1.8vw, 1.5rem); color:var(--vogue-black); line-height:1.3;">
          Help us discover people worth documenting.
        </p>
      </div>

      @if(session('success'))
        <div style="background:#eaf8ef; border:1px solid #2e7d32; color:#1b5e20; padding:18px 24px; margin-bottom:30px; font-size:0.95rem; font-weight:600;">
          {{ session('success') }}
        </div>
      @endif

      <div style="display:grid; grid-template-columns:1.8fr 1fr; gap:48px; align-items:start;">
        
        <!-- Nomination Form -->
        <div style="background:#ffffff; border:1px solid var(--vogue-border); padding: clamp(24px, 4vw, 44px);">
          <p style="font-family:var(--font-garamond); font-size:1.15rem; line-height:1.6; color:#333; margin-bottom:28px;">
            You may nominate yourself or another individual for editorial consideration by CityIcons. Nominations are reviewed based on city connection, body of work, verifiable achievement, contribution and editorial relevance.
          </p>

          <form action="{{ url('/nominate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <h3 style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-black); margin-bottom:18px; border-bottom:1px solid var(--vogue-border); padding-bottom:8px;">
              1. Nominee Information
            </h3>

            <!-- Nominee Name -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:18px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Nominee's Full Name *</label>
                <input type="text" name="nominee_name" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Preferred Public Name</label>
                <input type="text" name="public_name" style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
            </div>

            <!-- Profession & Connection -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:18px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Profession / Current Designation *</label>
                <input type="text" name="profession" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">City Connection *</label>
                <input type="text" name="city_connection" value="{{ $isCitySpecific ? $cName : '' }}" placeholder="e.g. {{ $isCitySpecific ? $cName : 'Bhavnagar, Mumbai, Surat' }}" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
            </div>

            <!-- Category -->
            <div style="margin-bottom:18px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Category or Field *</label>
              <select name="category" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem; background:#fff;">
                <option value="">Select Category</option>
                <option value="Business">Business</option>
                <option value="Arts">Arts</option>
                <option value="Education">Education</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Sports">Sports</option>
                <option value="Public Service">Public Service</option>
                <option value="Innovation">Innovation</option>
                <option value="Social Impact">Social Impact</option>
              </select>
            </div>

            <!-- About Nominee -->
            <div style="margin-bottom:18px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">About the Nominee *</label>
              <textarea name="about_nominee" rows="4" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;"></textarea>
            </div>

            <!-- Key Achievements -->
            <div style="margin-bottom:18px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Key Achievements *</label>
              <textarea name="achievements" rows="3" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;"></textarea>
            </div>

            <!-- Supporting Links & Website -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:18px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Supporting Links</label>
                <input type="text" name="supporting_links" placeholder="News, citations, articles" style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Official Website or Social Profile</label>
                <input type="text" name="profile_link" style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
            </div>

            <!-- Why should this story be documented -->
            <div style="margin-bottom:24px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Why should this story be documented? *</label>
              <textarea name="why_documented" rows="3" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;"></textarea>
            </div>

            <!-- Photographs or Supporting Documents -->
            <div style="margin-bottom:28px;">
              <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Photographs or Supporting Documents</label>
              <input type="file" name="documents" style="width:100%; padding:8px 0; font-family:inherit; font-size:0.85rem;">
            </div>

            <h3 style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-black); margin-bottom:18px; border-bottom:1px solid var(--vogue-border); padding-bottom:8px;">
              2. Nominator Details
            </h3>

            <!-- Nominator Information -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px; margin-bottom:28px;">
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Nominator's Name *</label>
                <input type="text" name="nominator_name" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Email Address *</label>
                <input type="email" name="email" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
              <div>
                <label style="display:block; font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">Contact Number *</label>
                <input type="tel" name="phone" required style="width:100%; padding:12px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.9rem;">
              </div>
            </div>

            <!-- Consent & Checkboxes -->
            <h3 style="font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-black); margin-bottom:14px;">
              3. Consent &amp; Confirmations
            </h3>

            <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:20px; margin-bottom:24px; font-size:0.85rem; line-height:1.7;">
              <p style="margin-bottom:14px; font-weight:600;">
                By submitting this form, you confirm that the information provided is accurate to the best of your knowledge and that you have permission to share the submitted material.
              </p>
              
              <label style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; cursor:pointer;">
                <input type="checkbox" name="confirm_accurate" required style="margin-top:4px;">
                <span>I confirm that the submitted information is accurate to the best of my knowledge. *</span>
              </label>

              <label style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; cursor:pointer;">
                <input type="checkbox" name="confirm_permission" required style="margin-top:4px;">
                <span>I confirm that I have permission to submit the photographs and supporting material. *</span>
              </label>

              <label style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; cursor:pointer;">
                <input type="checkbox" name="confirm_editorial" required style="margin-top:4px;">
                <span>I consent to the use of this information for editorial review and related communication. *</span>
              </label>

              <label style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; cursor:pointer;">
                <input type="checkbox" name="confirm_privacy" required style="margin-top:4px;">
                <span>I have read and accept the <a href="{{ url('/policies/privacy') }}" target="_blank" style="text-decoration:underline;">Privacy Policy</a>. *</span>
              </label>

              <label style="display:flex; align-items:flex-start; gap:10px; cursor:pointer;">
                <input type="checkbox" name="opt_newsletter">
                <span>Send me CityIcons updates and newsletters. (Optional)</span>
              </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" style="width:100%; background:var(--vogue-black); color:#ffffff; font-size:0.85rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:18px; border:none; cursor:pointer; transition:background 0.2s;">
              Submit Nomination
            </button>
          </form>
        </div>

        <!-- Sidebar Notice -->
        <div>
          <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:28px; margin-bottom:24px;">
            <span class="vogue-rubric vogue-rubric--red" style="font-size:0.65rem;">EDITORIAL POLICY</span>
            <h3 style="font-family:var(--font-didot); font-size:1.4rem; font-weight:400; margin-bottom:10px;">
              Important Notice
            </h3>
            <p style="font-size:0.85rem; line-height:1.6; color:#444; margin-bottom:12px;">
              CityIcons retains complete editorial independence over selection, category, framing, presentation and publication timing.
            </p>
            <p style="font-size:0.85rem; line-height:1.6; color:#444; margin-bottom:12px;">
              A nomination is a starting point, not a promise of publication.
            </p>
            <p style="font-size:0.85rem; line-height:1.6; color:#444;">
              If a submission is primarily promotional or commercial, it may be referred to the <a href="{{ url('/featured-brands') }}" style="text-decoration:underline; font-weight:700;">Featured Brands</a> category.
            </p>
          </div>

          <div style="border:1px solid var(--vogue-border); padding:24px;">
            <h4 style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:10px;">
              Need Help?
            </h4>
            <p style="font-size:0.82rem; color:#666; line-height:1.6;">
              For questions regarding the nomination process or editorial criteria, write to:<br>
              <a href="mailto:editorial@cityicons.in" style="font-weight:700; color:var(--vogue-black); text-decoration:underline;">editorial@cityicons.in</a>
            </p>
          </div>
        </div>

      </div>

    </div>
  </section>

</x-layouts.app>
