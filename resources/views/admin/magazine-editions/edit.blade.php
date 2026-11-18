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
