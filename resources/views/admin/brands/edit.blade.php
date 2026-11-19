@extends('layouts.admin')

@section('header_title', 'Edit Brand Partner: ' . $brand->name)

@section('content')

  <div style="max-width:800px;">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Edit Brand Partner</h2>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i> Back to Brands
        </a>
      </div>

      <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label" for="name">Brand / Organization Name *</label>
          <input type="text" id="name" name="name" value="{{ old('name', $brand->name) }}" required class="form-control">
        </div>

        <div class="form-group">
          <label class="form-label" for="city_id">City Edition</label>
          @if($activeAdminCity)
            <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:6px; padding:10px 14px; display:flex; align-items:center; justify-content:space-between;">
              <div>
                <div style="font-size:11px; font-weight:700; text-transform:uppercase; color:#991b1b; letter-spacing:0.5px;">Locked by City Switcher</div>
                <div style="font-size:13px; font-weight:700; color:#1a1a1e; margin-top:2px;">
                  <i class="fas fa-city" style="color:var(--primary); margin-right:4px;"></i> {{ $activeAdminCity->name }} ({{ $activeAdminCity->state }})
                </div>
              </div>
              <input type="hidden" name="city_id" value="{{ $activeAdminCity->id }}">
              <a href="{{ route('admin.switch-city', 'all') }}" style="font-size:11px; color:#2563eb; font-weight:600; text-decoration:underline;">Switch City</a>
            </div>
          @else
            <select id="city_id" name="city_id" class="form-control">
              <option value="">National / All India (All Cities)</option>
              @foreach($cities as $c)
                <option value="{{ $c->id }}" {{ old('city_id', $brand->city_id) == $c->id ? 'selected' : '' }}>
                  {{ $c->name }} ({{ $c->state }})
                </option>
              @endforeach
            </select>
          @endif
        </div>

        <div class="form-group">
          <label class="form-label" for="website_url">Official Website URL</label>
          <input type="url" id="website_url" name="website_url" value="{{ old('website_url', $brand->website_url) }}" class="form-control">
        </div>

        <div class="form-group">
          <label class="form-label" for="description">Brand Profile / Summary</label>
          <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $brand->description) }}</textarea>
        </div>

        <div class="form-group">
          <label class="form-label" for="disclosure_text">Editorial Disclosure Notice *</label>
          <input type="text" id="disclosure_text" name="disclosure_text" value="{{ old('disclosure_text', $brand->disclosure_text) }}" required class="form-control">
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="logo_image_file">Replace Logo File</label>
            <input type="file" id="logo_image_file" name="logo_image_file" accept="image/*" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="logo_image_url">Or Logo URL</label>
            <input type="url" id="logo_image_url" name="logo_image_url" value="{{ old('logo_image_url', $brand->logo_image) }}" class="form-control">
          </div>
        </div>

        <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:16px; display:flex; gap:24px;">
          <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active) ? 'checked' : '' }} style="accent-color:var(--primary);">
            <span style="font-weight:600;">Active Partner</span>
          </label>
          <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $brand->is_featured) ? 'checked' : '' }} style="accent-color:var(--primary);">
            <span style="font-weight:600;">Featured on Homepage</span>
          </label>
        </div>

        <div style="margin-top:28px; display:flex; gap:12px;">
          <button type="submit" class="btn btn-primary" style="padding:12px 24px;">
            <i class="fa-solid fa-check"></i> Update Brand Partner
          </button>
          <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>

@endsection
