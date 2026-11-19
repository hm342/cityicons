@extends('layouts.admin')

@section('header_title', 'Add New City Edition')

@section('content')

  <div style="max-width:800px;">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Create City Edition</h2>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i> Back to Cities
        </a>
      </div>

      <form action="{{ route('admin.cities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="name">City Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control" placeholder="e.g. Pune, Hyderabad, Chandigarh">
          </div>
          <div class="form-group">
            <label class="form-label" for="slug">URL Slug (Optional)</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="e.g. pune (auto-generated if empty)">
            <div class="form-text">Will be accessible at: /your-slug</div>
          </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="state">State / Region *</label>
            <input type="text" id="state" name="state" value="{{ old('state') }}" required class="form-control" placeholder="e.g. Maharashtra, Telangana, Punjab">
          </div>
          <div class="form-group">
            <label class="form-label" for="tagline">Official Tagline</label>
            <input type="text" id="tagline" name="tagline" value="{{ old('tagline') }}" class="form-control" placeholder="e.g. The Cultural Hub of Maharashtra">
          </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="accent_color">Accent Color (Hex) *</label>
            <div style="display:flex; gap:10px; align-items:center;">
              <input type="color" id="accent_color" name="accent_color" value="{{ old('accent_color', '#E50914') }}" class="form-control" style="width:60px; height:42px; padding:4px;" onchange="document.getElementById('accent_hex').value = this.value">
              <input type="text" id="accent_hex" value="{{ old('accent_color', '#E50914') }}" class="form-control" style="flex:1;" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 11) }}" class="form-control" placeholder="e.g. 11">
          </div>
        </div>

        <!-- Hero Image -->
        <div style="border-top:1px solid var(--border-color); padding-top:20px; margin-top:10px;">
          <h3 style="font-size:13px; font-weight:700; text-transform:uppercase; margin-bottom:14px;">Hero Header Image</h3>

          <div class="form-group">
            <label class="form-label" for="hero_image_file">Upload Hero Image</label>
            <input type="file" id="hero_image_file" name="hero_image_file" accept="image/*" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label" for="hero_image_url">Or Direct Image Link</label>
            <input type="url" id="hero_image_url" name="hero_image_url" value="{{ old('hero_image_url') }}" class="form-control" placeholder="https://images.unsplash.com/...">
          </div>
        </div>

        <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:20px;">
          <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="accent-color:var(--primary); width:18px; height:18px;">
            <div>
              <strong style="font-size:13px;">Active City Edition</strong>
              <div class="form-text" style="margin:0;">Make this edition accessible via navigation, subsite routes and city switcher</div>
            </div>
          </label>
        </div>

        <div style="margin-top:28px; display:flex; gap:12px;">
          <button type="submit" class="btn btn-primary" style="padding:12px 24px;">
            <i class="fa-solid fa-plus"></i> Create City Edition
          </button>
          <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>

@endsection
