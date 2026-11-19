@extends('layouts.admin')

@section('header_title', 'Compose New Editorial Story')

@section('content')

  <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px; align-items:start;">
      
      <!-- Main Content Column -->
      <div>
        <div class="card">
          <h2 class="card-title" style="margin-bottom:20px;">Story Content</h2>

          <div class="form-group">
            <label class="form-label" for="title">Headline / Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-control" style="font-size:16px; font-weight:700;" placeholder="e.g. The Renaissance of Handloom: Bridging Tradition and Modernity">
          </div>

          <div class="form-group">
            <label class="form-label" for="slug">Custom URL Slug (Optional)</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="auto-generated-from-title">
            <div class="form-text">Leave blank to automatically generate from headline.</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="excerpt">Excerpt / Standfirst *</label>
            <textarea id="excerpt" name="excerpt" rows="3" class="form-control" placeholder="A compelling 1-2 sentence introduction that appears on cards and previews...">{{ old('excerpt') }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Full Story Body</label>
            <div id="quill-editor" data-placeholder="Write the complete editorial article here..." style="height:320px; background:#fff; font-size:15px;">{!! old('body') !!}</div>
            <input type="hidden" name="body" id="body-input">
          </div>
        </div>

        <!-- Author Information -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:20px;">Byline &amp; Attribution</h2>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
              <label class="form-label" for="author_name">Author Name</label>
              <input type="text" id="author_name" name="author_name" value="{{ old('author_name', 'CityIcons Staff') }}" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-label" for="read_time">Estimated Read Time</label>
              <input type="text" id="read_time" name="read_time" value="{{ old('read_time', '5 min read') }}" class="form-control" placeholder="e.g. 6 min read">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" for="author_bio">Author Bio (Optional)</label>
            <input type="text" id="author_bio" name="author_bio" value="{{ old('author_bio') }}" class="form-control" placeholder="e.g. Contributing Cultural Editor based in Bhavnagar">
          </div>
        </div>
      </div>

      <!-- Sidebar Options Column -->
      <div>
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Publishing Options</h2>

          <div class="form-group">
            <label class="form-label" for="status">Publication Status *</label>
            <select id="status" name="status" class="form-control">
              <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Live immediately)</option>
              <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft (Review state)</option>
              <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="type">Story Type *</label>
            <select id="type" name="type" class="form-control">
              <option value="article" selected>Standard Article</option>
              <option value="story">Spotlight Story</option>
              <option value="in-bhavnagar">In Bhavnagar Local Feature</option>
              <option value="the-list">The List Archive Entry</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="section">Section Placement *</label>
            <select id="section" name="section" class="form-control">
              <option value="general" selected>General Editorial</option>
              <option value="icons">Icons Flagship Feature</option>
              <option value="rising">Rising Stars Spotlight</option>
            </select>
          </div>

          <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:16px;">
            <label style="display:flex; align-items:center; gap:10px; margin-bottom:12px; cursor:pointer;">
              <input type="checkbox" name="is_cover" value="1" {{ old('is_cover') ? 'checked' : '' }} style="accent-color:var(--primary); width:18px; height:18px;">
              <div>
                <strong style="font-size:13px;">Hero Cover Feature</strong>
                <div class="form-text" style="margin:0;">Make this the massive primary homepage cover story</div>
              </div>
            </label>

            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
              <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', true) ? 'checked' : '' }} style="accent-color:var(--primary); width:18px; height:18px;">
              <div>
                <strong style="font-size:13px;">Featured Story</strong>
                <div class="form-text" style="margin:0;">Pin in high-visibility homepage grids</div>
              </div>
            </label>
          </div>

          <div style="margin-top:24px;">
            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px;">
              <i class="fa-solid fa-cloud-arrow-up"></i> Save &amp; Publish Story
            </button>
          </div>
        </div>

        <!-- Categorization & City -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Classification</h2>

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
                <option value="">National / All Cities</option>
                @foreach($cities as $c)
                  <option value="{{ $c->id }}" {{ old('city_id', $selectedCityId ?? '') == $c->id ? 'selected' : '' }}>
                    {{ $c->name }} ({{ $c->state }})
                  </option>
                @endforeach
              </select>
            @endif
          </div>

          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label">Editorial Tags</label>
            <div style="max-height:160px; overflow-y:auto; border:1px solid var(--border-color); border-radius:6px; padding:10px; display:flex; flex-direction:column; gap:6px;">
              @foreach($tags as $tag)
                <label style="display:flex; align-items:center; gap:8px; font-size:12px; cursor:pointer;">
                  <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                  <span>#{{ $tag->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Cover Image -->
        <div class="card">
          <h2 class="card-title" style="margin-bottom:16px;">Imagery</h2>

          <div class="form-group">
            <label class="form-label" for="cover_image_file">Upload Cover Photo</label>
            <input type="file" id="cover_image_file" name="cover_image_file" accept="image/*" class="form-control">
            <div class="form-text">Recommended: 1800x1200 high-resolution photograph.</div>
          </div>

          <div style="text-align:center; font-size:11px; font-weight:700; color:var(--text-muted); margin:10px 0;">— OR IMAGE URL —</div>

          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" for="cover_image_url">Direct Image Link (Unsplash, CDN)</label>
            <input type="url" id="cover_image_url" name="cover_image_url" value="{{ old('cover_image_url') }}" class="form-control" placeholder="https://images.unsplash.com/...">
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
