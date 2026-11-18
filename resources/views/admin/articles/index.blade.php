@extends('layouts.admin')

@section('header_title', 'Articles & Stories Management')

@section('content')

  <div class="card">
    <div class="card-header">
      <div>
        <h2 class="card-title">All Editorial Stories</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Manage covers, features, city stories, and editorial features.
        </div>
      </div>
      <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Write New Story
      </a>
    </div>

    <!-- Filters & Search -->
    <form method="GET" action="{{ route('admin.articles.index') }}" style="display:flex; gap:12px; margin-bottom:20px; flex-wrap:wrap;">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, author, excerpt..." class="form-control" style="flex:1; min-width:200px;">
      
      <select name="category_id" class="form-control" style="width:180px;">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
          </option>
        @endforeach
      </select>

      <select name="city_id" class="form-control" style="width:180px;">
        <option value="">All Cities / National</option>
        @foreach($cities as $city)
          <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
            {{ $city->name }}
          </option>
        @endforeach
      </select>

      <select name="status" class="form-control" style="width:140px;">
        <option value="">All Statuses</option>
        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
      </select>

      <button type="submit" class="btn btn-dark">
        <i class="fa-solid fa-filter"></i> Filter
      </button>

      @if(request()->anyFilled(['search', 'category_id', 'city_id', 'status']))
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Clear</a>
      @endif
    </form>

    <!-- Table -->
    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width:60px;">Image</th>
            <th>Story Title</th>
            <th>Category</th>
            <th>City</th>
            <th>Tags</th>
            <th>Badges</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($articles as $art)
            <tr>
              <td>
                @if($art->cover_image)
                  <img src="{{ $art->cover_image }}" alt="" style="width:48px; height:48px; object-fit:cover; border-radius:4px;">
                @else
                  <div style="width:48px; height:48px; background:#eee; border-radius:4px; display:flex; align-items:center; justify-content:center; color:#999;">
                    <i class="fa-solid fa-image"></i>
                  </div>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.articles.edit', $art->id) }}" style="font-weight:700; color:var(--text-dark); text-decoration:none; display:block; font-size:14px; line-height:1.3;">
                  {{ $art->title }}
                </a>
                <div style="font-size:11px; color:var(--text-muted); margin-top:3px;">
                  By {{ $art->author_name ?? 'Editorial Staff' }} · {{ $art->read_time ?? '5 min read' }} · {{ $art->created_at->format('M d, Y') }}
                </div>
              </td>
              <td>
                <span class="badge" style="background:#f4f4f7; color:#333;">
                  {{ $art->category->name ?? 'General' }}
                </span>
              </td>
              <td>
                {{ $art->city->name ?? 'National' }}
              </td>
              <td>
                <div style="display:flex; gap:4px; flex-wrap:wrap; max-width:180px;">
                  @foreach($art->tags->take(3) as $t)
                    <span style="font-size:10px; background:#eef; color:#336; padding:2px 6px; border-radius:3px;">#{{ $t->name }}</span>
                  @endforeach
                </div>
              </td>
              <td>
                @if($art->is_cover)
                  <span class="badge" style="background:#111; color:#fff;">Cover</span>
                @endif
                @if($art->is_featured)
                  <span class="badge" style="background:#e0f2fe; color:#0369a1;">Featured</span>
                @endif
              </td>
              <td>
                @if($art->status === 'published')
                  <span class="badge badge-success">Published</span>
                @elseif($art->status === 'draft')
                  <span class="badge badge-warning">Draft</span>
                @else
                  <span class="badge badge-danger">Archived</span>
                @endif
              </td>
              <td style="text-align:right; white-space:nowrap;">
                <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-secondary btn-sm" title="Edit Story">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{ url('/article/' . $art->id) }}" target="_blank" class="btn btn-secondary btn-sm" title="Preview Public">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
                <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this story?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" style="text-align:center; padding:40px; color:var(--text-muted);">
                No articles found matching criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div style="margin-top:20px;">
      {{ $articles->links() }}
    </div>
  </div>

@endsection
