@extends('layouts.admin')

@section('header_title', 'Edit Issue: ' . $edition->title)

@section('content')

  <div style="max-width:800px;">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Edit Magazine Edition</h2>
        <a href="{{ route('admin.magazine-editions.index') }}" class="btn btn-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i> Back to Editions
        </a>
      </div>

      <form action="{{ route('admin.magazine-editions.update', $edition->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="form-label" for="city_id">City Edition *</label>
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
            <select id="city_id" name="city_id" required class="form-control">
              <option value="">Select City</option>
              @foreach($cities as $c)
                <option value="{{ $c->id }}" {{ old('city_id', $edition->city_id) == $c->id ? 'selected' : '' }}>
                  {{ $c->name }} ({{ $c->state }})
                </option>
              @endforeach
            </select>
          @endif
        </div>

        <div style="display:grid; grid-template-columns:1fr 2fr; gap:16px;">
          <div class="form-group">
            <label class="form-label" for="issue_number">Issue Number *</label>
            <input type="number" id="issue_number" name="issue_number" value="{{ old('issue_number', $edition->issue_number) }}" min="1" required class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="title">Edition Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $edition->title) }}" required class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="published_date">Publication Date</label>
          <input type="date" id="published_date" name="published_date" value="{{ old('published_date', $edition->published_date ? $edition->published_date->format('Y-m-d') : '') }}" class="form-control">
        </div>

        <div class="form-group">
          <label class="form-label" for="description">Issue Curatorial Statement / Description</label>
          <textarea id="description" name="description" rows="4" class="form-control">{{ old('description', $edition->description) }}</textarea>
        </div>

        <!-- Cover Image -->
        <div style="border-top:1px solid var(--border-color); padding-top:20px; margin-top:10px;">
          <h3 style="font-size:13px; font-weight:700; text-transform:uppercase; margin-bottom:14px;">Print Cover Artwork</h3>

          @if($edition->cover_image)
            <div style="margin-bottom:14px;">
              <img src="{{ $edition->cover_image }}" alt="" style="width:120px; height:160px; object-fit:cover; border-radius:4px; box-shadow:0 3px 8px rgba(0,0,0,0.2);">
            </div>
          @endif

          <div class="form-group">
            <label class="form-label" for="cover_image_file">Replace with Cover File</label>
            <input type="file" id="cover_image_file" name="cover_image_file" accept="image/*" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label" for="cover_image_url">Or Direct Image Link</label>
            <input type="url" id="cover_image_url" name="cover_image_url" value="{{ old('cover_image_url', $edition->cover_image) }}" class="form-control">
          </div>
        </div>

        <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:20px;">
          <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $edition->is_active) ? 'checked' : '' }} style="accent-color:var(--primary);">
            <span style="font-weight:600;">Active / Public Issue</span>
          </label>
        </div>

        <div style="margin-top:28px; display:flex; gap:12px;">
          <button type="submit" class="btn btn-primary" style="padding:12px 24px;">
            <i class="fa-solid fa-check"></i> Update Magazine Edition
          </button>
          <a href="{{ route('admin.magazine-editions.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>

@endsection
