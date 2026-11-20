@extends('layouts.admin')

@section('header_title', 'Platform Settings & Configuration')

@section('content')

  <div style="max-width:900px;">
    <form action="{{ route('admin.settings.update') }}" method="POST">
      @csrf

      <!-- Platform Branding -->
      <div class="card">
        <h2 class="card-title" style="margin-bottom:20px;">
          <i class="fa-solid fa-flag" style="color:var(--primary); margin-right:8px;"></i> Brand Identity
        </h2>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="site_name">Site Brand Name</label>
            <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'CITYICONS') }}" class="form-control" style="font-weight:700;">
          </div>
          <div class="form-group">
            <label class="form-label" for="tagline">Official Tagline</label>
            <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? "India's City Magazine") }}" class="form-control">
          </div>
        </div>
      </div>

      <!-- Homepage Hero Section -->
      <div class="card">
        <h2 class="card-title" style="margin-bottom:20px;">
          <i class="fa-solid fa-image" style="color:var(--primary); margin-right:8px;"></i> Homepage Hero Banner (Bhavnagar Icons)
        </h2>

        <div class="form-group">
          <label class="form-label" for="hero_headline">Hero Headline *</label>
          <input type="text" id="hero_headline" name="hero_headline" value="{{ old('hero_headline', $settings['hero_headline'] ?? 'Bhavnagar, Documented.') }}" class="form-control" style="font-size:16px; font-weight:700;">
          <div class="form-text">Rendered inside the hero banner across desktop and mobile.</div>
        </div>

        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label" for="hero_subline">Hero Excerpt / Philosophy Statement *</label>
          <textarea id="hero_subline" name="hero_subline" rows="2" class="form-control">{{ old('hero_subline', $settings['hero_subline'] ?? 'Selected with purpose. Documented with responsibility.') }}</textarea>
          <div class="form-text">Appears directly below the hero banner.</div>
        </div>
      </div>

      <!-- Editorial & Commercial Disclosure -->
      <div class="card">
        <h2 class="card-title" style="margin-bottom:20px;">
          <i class="fa-solid fa-scale-balanced" style="color:var(--primary); margin-right:8px;"></i> Editorial Standards &amp; Mandatory Disclosure
        </h2>

        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label" for="disclosure_text">Legal &amp; Commercial Disclosure Statement *</label>
          <textarea id="disclosure_text" name="disclosure_text" rows="4" class="form-control">{{ old('disclosure_text', $settings['disclosure_text'] ?? 'CityIcons operates under strict independent editorial guidelines. Editorial recognition cannot be purchased. Commercial partnerships are clearly labeled as Paid Collaboration or Partner Content.') }}</textarea>
          <div class="form-text">Rendered across footer, nomination confirmations, and partner pages (Pages 18-31 of Specifications).</div>
        </div>
      </div>

      <!-- Contact & Channels -->
      <div class="card">
        <h2 class="card-title" style="margin-bottom:20px;">
          <i class="fa-solid fa-address-book" style="color:var(--primary); margin-right:8px;"></i> Editorial Communication
        </h2>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="contact_email">Public Editorial Email</label>
            <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? 'editorial@cityicons.in') }}" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="instagram_url">Instagram Channel URL</label>
            <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? 'https://instagram.com/cityicons.in') }}" class="form-control">
          </div>
        </div>
      </div>

      <!-- Analytics & Tracking -->
      <div class="card">
        <h2 class="card-title" style="margin-bottom:20px;">
          <i class="fa-solid fa-chart-line" style="color:var(--primary); margin-right:8px;"></i> Analytics &amp; Tracking
        </h2>

        <div class="form-group" style="margin-bottom:0;">
          <label class="form-label" for="google_analytics_id">Google Analytics 4 Measurement ID (GA4)</label>
          <input type="text" id="google_analytics_id" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? env('GOOGLE_ANALYTICS_ID', '')) }}" class="form-control" placeholder="G-XXXXXXXXXX" style="font-family:monospace; max-width:320px;">
          <div class="form-text">Enter your Google Analytics 4 Measurement ID (e.g. <code>G-XXXXXXXXXX</code>). When saved, tracking is active across all city and national pages. You can also configure it in <code>.env</code> using <code>GOOGLE_ANALYTICS_ID</code>.</div>
        </div>
      </div>

      <div style="margin-bottom:40px;">
        <button type="submit" class="btn btn-primary" style="padding:14px 32px; font-size:14px;">
          <i class="fa-solid fa-check"></i> Save All Platform Settings
        </button>
      </div>

    </form>
  </div>

@endsection
