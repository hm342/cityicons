@extends('layouts.admin')

@section('header_title', 'Edit City Edition: ' . $city->name)

@section('content')

  <div style="max-width:800px;">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Edit Edition Settings</h2>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i> Back to Cities
        </a>
      </div>

      <form action="{{ route('admin.cities.update', $city->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="name">City Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $city->name) }}" required class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="state">State / Region *</label>
            <input type="text" id="state" name="state" value="{{ old('state', $city->state) }}" required class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="tagline">Official Tagline</label>
          <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $city->tagline) }}" class="form-control" placeholder="e.g. The Jewel of Saurashtra">
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="accent_color">Accent Color (Hex) *</label>
            <div style="display:flex; gap:10px; align-items:center;">
              <input type="color" id="accent_color" name="accent_color" value="{{ old('accent_color', $city->accent_color) }}" class="form-control" style="width:60px; height:42px; padding:4px;">
              <input type="text" value="{{ old('accent_color', $city->accent_color) }}" class="form-control" style="flex:1;" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $city->sort_order) }}" class="form-control">
          </div>
        </div>

        <!-- Hero Image -->
        <div style="border-top:1px solid var(--border-color); padding-top:20px; margin-top:10px;">
          <h3 style="font-size:13px; font-weight:700; text-transform:uppercase; margin-bottom:14px;">Hero Header Image</h3>

          @if($city->hero_image)
            <div style="margin-bottom:14px;">
              <img src="{{ $city->hero_image }}" alt="" style="width:100%; height:180px; object-fit:cover; border-radius:8px; border:1px solid var(--border-color);">
            </div>
          @endif

          <div class="form-group">
            <label class="form-label" for="hero_image_file">Upload New Hero Image</label>
            <input type="file" id="hero_image_file" name="hero_image_file" accept="image/*" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label" for="hero_image_url">Or Direct Image Link</label>
            <input type="url" id="hero_image_url" name="hero_image_url" value="{{ old('hero_image_url', $city->hero_image) }}" class="form-control">
          </div>
        </div>

        <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:20px;">
          <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $city->is_active) ? 'checked' : '' }} style="accent-color:var(--primary); width:18px; height:18px;">
            <div>
              <strong style="font-size:13px;">Active City Edition</strong>
              <div class="form-text" style="margin:0;">Make this edition accessible via navigation and city switcher</div>
            </div>
          </label>
        </div>

        <div style="margin-top:28px; display:flex; gap:12px;">
          <button type="submit" class="btn btn-primary" style="padding:12px 24px;">
            <i class="fa-solid fa-check"></i> Save City Edition
          </button>
          <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>

@endsection
