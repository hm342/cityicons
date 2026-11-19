@extends('layouts.admin')

@section('header_title', 'Create New Person Profile')

@section('content')

  <form action="{{ route('admin.people.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px; align-items:start;">
      
      <!-- Main Info -->
      <div>
        <div class="card">
          <h2 class="card-title" style="margin-bottom:20px;">Profile Information</h2>

          <div class="form-group">
            <label class="form-label" for="name">Full Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control" style="font-size:16px; font-weight:700;" placeholder="e.g. Dr. Hitesh Vaghela">
          </div>

          <div class="form-group">
            <label class="form-label" for="slug">Custom URL Slug (Optional)</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="auto-generated-from-name">
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label" for="profession">Profession / Title *</label>
              <input type="text" id="profession" name="profession" value="{{ old('profession') }}" class="form-control" placeholder="e.g. Master Textile Designer">
            </div>
            <div class="form-group">
              <label class="form-label" for="organization">Organization / Institution</label>
              <input type="text" id="organization" name="organization" value="{{ old('organization') }}" class="form-control" placeholder="e.g. Raichura Weaves Studio">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="tagline">Editorial One-Liner / Tagline</label>
            <input type="text" id="tagline" name="tagline" value="{{ old('tagline') }}" class="form-control" placeholder="e.g. Preserving Saurashtra Bandhani for the Modern Wardrobe">
          </div>

          <div class="form-group">
            <label class="form-label">Editorial Biography &amp; Body of Work</label>
            <div id="quill-editor" data-placeholder="Write comprehensive profile bio, heritage context, and achievements..." style="height:320px; background:#fff; font-size:15px;">{!! old('bio') !!}</div>
            <input type="hidden" name="bio" id="bio-input">
          </div>
        </div>

        <!-- Social & Online Presence -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:20px;">Social &amp; Supporting Links</h2>
          <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label" for="social_instagram">Instagram Profile</label>
              <input type="text" id="social_instagram" name="social_instagram" value="{{ old('social_instagram') }}" class="form-control" placeholder="@username">
            </div>
            <div class="form-group">
              <label class="form-label" for="social_linkedin">LinkedIn Profile</label>
              <input type="text" id="social_linkedin" name="social_linkedin" value="{{ old('social_linkedin') }}" class="form-control" placeholder="linkedin.com/in/...">
            </div>
            <div class="form-group">
              <label class="form-label" for="website">Official Website</label>
              <input type="url" id="website" name="website" value="{{ old('website') }}" class="form-control" placeholder="https://...">
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar Options -->
      <div>
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Tier &amp; Status</h2>

          <div class="form-group">
            <label class="form-label" for="type">Editorial Tier *</label>
            <select id="type" name="type" class="form-control" style="font-weight:700;">
              <option value="icon" {{ old('type') === 'icon' ? 'selected' : '' }}>ICON — Flagship Living Legend</option>
              <option value="rising" {{ old('type') === 'rising' ? 'selected' : '' }}>RISING — Next-Gen Innovator</option>
            </select>
            <div class="form-text">Determines whether profile appears in Icons or Rising page.</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="status">Status *</label>
            <select id="status" name="status" class="form-control">
              <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Live in Directory)</option>
              <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft (In Progress)</option>
            </select>
          </div>

          <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:16px;">
            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
              <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', true) ? 'checked' : '' }} style="accent-color:var(--primary); width:18px; height:18px;">
              <div>
                <strong style="font-size:13px;">Featured in Homepage Grid</strong>
                <div class="form-text" style="margin:0;">Highlight on homepage directory showcase</div>
              </div>
            </label>
          </div>

          <div style="margin-top:24px;">
            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px;">
              <i class="fa-solid fa-check"></i> Save &amp; Publish Profile
            </button>
          </div>
        </div>

        <!-- The List Assignment -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">The List Assignment</h2>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label" for="year">Year</label>
              <input type="number" id="year" name="year" value="{{ old('year', date('Y')) }}" min="2020" max="2050" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label" for="month">Month</label>
              <select id="month" name="month" class="form-control">
                @for($m = 1; $m <= 12; $m++)
                  <option value="{{ $m }}" {{ old('month', date('n')) == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                  </option>
                @endfor
              </select>
            </div>
          </div>
          <div class="form-text" style="margin-top:8px;">Assigns which monthly archive this profile belongs to in The List.</div>
        </div>

        <!-- City & Category -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Classification</h2>

          <div class="form-group">
            <label class="form-label" for="city_id">City</label>
            <select id="city_id" name="city_id" class="form-control">
              @foreach($cities as $c)
                <option value="{{ $c->id }}" {{ old('city_id', $selectedCityId ?? '') == $c->id || (old('city_id', $selectedCityId ?? '') == '' && $c->slug == 'bhavnagar') ? 'selected' : '' }}>
                  {{ $c->name }} ({{ $c->state }})
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-control">
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Tags</label>
            <div style="max-height:140px; overflow-y:auto; border:1px solid var(--border-color); border-radius:6px; padding:8px; display:flex; flex-direction:column; gap:4px;">
              @foreach($tags as $tag)
                <label style="display:flex; align-items:center; gap:8px; font-size:12px; cursor:pointer;">
                  <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                  <span>#{{ $tag->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Imagery -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Portrait Photography</h2>

          <div class="form-group">
            <label class="form-label" for="portrait_image_file">Upload Portrait Photo</label>
            <input type="file" id="portrait_image_file" name="portrait_image_file" accept="image/*" class="form-control">
          </div>

          <div style="text-align:center; font-size:11px; font-weight:700; color:var(--text-muted); margin:10px 0;">— OR IMAGE URL —</div>

          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" for="portrait_image_url">Direct Image Link</label>
            <input type="url" id="portrait_image_url" name="portrait_image_url" value="{{ old('portrait_image_url') }}" class="form-control" placeholder="https://images.unsplash.com/...">
          </div>
        </div>

      </div>

    </div>
  </form>

@endsection

@push('scripts')
<script>
  if (typeof initAdminQuill === 'function') {
    initAdminQuill();
  }
</script>
@endpush
