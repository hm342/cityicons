@extends('layouts.admin')

@section('header_title', 'Add Brand Partner')

@section('content')

  <div style="max-width:800px;">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">New Commercial Partner</h2>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i> Back to Brands
        </a>
      </div>

      <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label class="form-label" for="name">Brand / Organization Name *</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control" placeholder="e.g. Nilambagh Palace Heritage Hotel">
        </div>

        <div class="form-group">
          <label class="form-label" for="website_url">Official Website URL</label>
          <input type="url" id="website_url" name="website_url" value="{{ old('website_url') }}" class="form-control" placeholder="https://...">
        </div>

        <div class="form-group">
          <label class="form-label" for="description">Brand Profile / Summary</label>
          <textarea id="description" name="description" rows="3" class="form-control" placeholder="Brief description of the brand partnership...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label" for="disclosure_text">Editorial Disclosure Notice *</label>
          <input type="text" id="disclosure_text" name="disclosure_text" value="{{ old('disclosure_text', 'Official Heritage Partner') }}" required class="form-control" placeholder="e.g. Official Heritage Partner or Paid Collaboration">
          <div class="form-text">Mandatory per CityIcons Editorial Policy (Page 20).</div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="logo_image_file">Upload Logo</label>
            <input type="file" id="logo_image_file" name="logo_image_file" accept="image/*" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="logo_image_url">Or Logo URL</label>
            <input type="url" id="logo_image_url" name="logo_image_url" value="{{ old('logo_image_url') }}" class="form-control" placeholder="https://...">
          </div>
        </div>

        <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:16px; display:flex; gap:24px;">
          <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="accent-color:var(--primary);">
            <span style="font-weight:600;">Active Partner</span>
          </label>
          <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', true) ? 'checked' : '' }} style="accent-color:var(--primary);">
            <span style="font-weight:600;">Featured on Homepage</span>
          </label>
        </div>

        <div style="margin-top:28px;">
          <button type="submit" class="btn btn-primary" style="padding:12px 24px;">
            <i class="fa-solid fa-plus"></i> Add Brand Partner
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection
