@extends('layouts.admin')

@section('header_title', 'Edit Profile: ' . $person->name)

@section('content')

  <form action="{{ route('admin.people.update', $person->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px; align-items:start;">
      
      <!-- Main Info -->
      <div>
        <div class="card">
          <h2 class="card-title" style="margin-bottom:20px;">Profile Information</h2>

          <div class="form-group">
            <label class="form-label" for="name">Full Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $person->name) }}" required class="form-control" style="font-size:16px; font-weight:700;">
          </div>

          <div class="form-group">
            <label class="form-label" for="slug">Custom URL Slug</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $person->slug) }}" class="form-control">
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label" for="profession">Profession / Title *</label>
              <input type="text" id="profession" name="profession" value="{{ old('profession', $person->profession) }}" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-label" for="organization">Organization / Institution</label>
              <input type="text" id="organization" name="organization" value="{{ old('organization', $person->organization) }}" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="tagline">Editorial One-Liner / Tagline</label>
            <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $person->tagline) }}" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Editorial Biography &amp; Body of Work</label>
            <div id="quill-editor" data-placeholder="Write comprehensive profile bio, heritage context, and achievements..." style="height:320px; background:#fff; font-size:15px;">{!! old('bio', $person->bio) !!}</div>
            <input type="hidden" name="bio" id="bio-input">
          </div>
        </div>

        <!-- Social & Online Presence -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:20px;">Social &amp; Supporting Links</h2>
          <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label" for="social_instagram">Instagram Profile</label>
              <input type="text" id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $person->social_instagram) }}" class="form-control" placeholder="@username">
            </div>
            <div class="form-group">
              <label class="form-label" for="social_linkedin">LinkedIn Profile</label>
              <input type="text" id="social_linkedin" name="social_linkedin" value="{{ old('social_linkedin', $person->social_linkedin) }}" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-label" for="website">Official Website</label>
              <input type="url" id="website" name="website" value="{{ old('website', $person->website) }}" class="form-control">
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
              <option value="icon" {{ old('type', $person->type) === 'icon' ? 'selected' : '' }}>ICON — Flagship Living Legend</option>
              <option value="rising" {{ old('type', $person->type) === 'rising' ? 'selected' : '' }}>RISING — Next-Gen Innovator</option>
              <option value="voice" {{ old('type', $person->type) === 'voice' ? 'selected' : '' }}>VOICE — Cultural / Social Custodian</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="status">Status *</label>
            <select id="status" name="status" class="form-control">
              <option value="published" {{ old('status', $person->status) === 'published' ? 'selected' : '' }}>Published (Live in Directory)</option>
              <option value="draft" {{ old('status', $person->status) === 'draft' ? 'selected' : '' }}>Draft (In Progress)</option>
            </select>
          </div>

          <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:16px;">
            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
              <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $person->is_featured) ? 'checked' : '' }} style="accent-color:var(--primary); width:18px; height:18px;">
              <div>
                <strong style="font-size:13px;">Featured in Homepage Grid</strong>
                <div class="form-text" style="margin:0;">Highlight on homepage directory showcase</div>
              </div>
            </label>
          </div>

          <div style="margin-top:24px; display:flex; gap:10px;">
            <button type="submit" class="btn btn-primary" style="flex:1; justify-content:center; padding:12px;">
              <i class="fa-solid fa-check"></i> Update Profile
            </button>
            <a href="{{ route('admin.people.index') }}" class="btn btn-secondary">Cancel</a>
          </div>
        </div>

        <!-- The List Assignment -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">The List Assignment</h2>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label" for="year">Year</label>
              <input type="number" id="year" name="year" value="{{ old('year', $person->year ?? date('Y')) }}" min="2020" max="2050" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom:0;">
              <label class="form-label" for="month">Month</label>
              <select id="month" name="month" class="form-control">
                @for($m = 1; $m <= 12; $m++)
                  <option value="{{ $m }}" {{ old('month', $person->month ?? date('n')) == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                  </option>
                @endfor
              </select>
            </div>
          </div>
        </div>

        <!-- City & Category -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Classification</h2>

          <div class="form-group">
            <label class="form-label" for="city_id">City</label>
            <select id="city_id" name="city_id" class="form-control">
              @foreach($cities as $c)
                <option value="{{ $c->id }}" {{ old('city_id', $person->city_id) == $c->id ? 'selected' : '' }}>
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
                <option value="{{ $cat->id }}" {{ old('category_id', $person->category_id) == $cat->id ? 'selected' : '' }}>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>

          @php $attachedTagIds = $person->tags->pluck('id')->toArray(); @endphp
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Tags</label>
            <div style="max-height:140px; overflow-y:auto; border:1px solid var(--border-color); border-radius:6px; padding:8px; display:flex; flex-direction:column; gap:4px;">
              @foreach($tags as $tag)
                <label style="display:flex; align-items:center; gap:8px; font-size:12px; cursor:pointer;">
                  <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $attachedTagIds)) ? 'checked' : '' }}>
                  <span>#{{ $tag->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Imagery -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Portrait Photography</h2>

          @if($person->portrait_image)
            <div style="margin-bottom:14px; text-align:center;">
              <img src="{{ $person->portrait_image }}" alt="" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:2px solid var(--border-color);">
              <div class="form-text">Current Portrait</div>
            </div>
          @endif

          <div class="form-group">
            <label class="form-label" for="portrait_image_file">Replace with File</label>
            <input type="file" id="portrait_image_file" name="portrait_image_file" accept="image/*" class="form-control">
          </div>

          <div style="text-align:center; font-size:11px; font-weight:700; color:var(--text-muted); margin:10px 0;">— OR REPLACE URL —</div>

          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" for="portrait_image_url">Image Link</label>
            <input type="url" id="portrait_image_url" name="portrait_image_url" value="{{ old('portrait_image_url', $person->portrait_image) }}" class="form-control">
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
