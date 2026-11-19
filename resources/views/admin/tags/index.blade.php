@extends('layouts.admin')

@section('header_title', 'Tags Taxonomy')

@section('content')

  <div style="display:grid; grid-template-columns:1.8fr 1fr; gap:24px; align-items:start;">
    
    <!-- Left: Tags Cloud & List -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Editorial Tags</h2>
        <span style="font-size:12px; color:var(--text-muted);">{{ $tags->total() }} Total Tags</span>
      </div>

      <!-- Tag Search -->
      <form method="GET" action="{{ route('admin.tags.index') }}" style="margin-bottom:20px; display:flex; gap:10px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search tag by name..." class="form-control" style="flex:1;">
        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-search"></i></button>
        @if(request('search'))
          <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Clear</a>
        @endif
      </form>

      <!-- Tag Cloud -->
      <div style="display:flex; flex-wrap:wrap; gap:8px; margin-bottom:24px; padding:16px; background:#fafafc; border:1px solid var(--border-color); border-radius:8px;">
        @foreach($tags as $t)
          <div style="display:inline-flex; align-items:center; gap:6px; background:#fff; border:1px solid #d5d5de; padding:4px 10px; border-radius:20px; font-size:12px; font-weight:600;">
            <span>#{{ $t->name }}</span>
            @if($t->city)
              <span style="font-size:9px; background:var(--primary-light); color:var(--primary-dark); font-weight:700; padding:1px 5px; border-radius:10px;">
                {{ $t->city->name }}
              </span>
            @endif
            <span style="font-size:10px; background:#f0f0f4; color:#666; padding:1px 6px; border-radius:10px;">
              {{ $t->articles_count + $t->people_count }}
            </span>
            <form action="{{ route('admin.tags.destroy', $t->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete #{{ $t->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit" style="background:none; border:none; color:#dc2626; cursor:pointer; font-size:10px; padding:0 2px;">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </form>
          </div>
        @endforeach
      </div>

      <div>
        {{ $tags->links() }}
      </div>
    </div>

    <!-- Right: Add New Tag Form -->
    <div class="card">
      <h2 class="card-title" style="margin-bottom:16px;">Create New Tag</h2>

      <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label" for="name">Tag Name *</label>
          <input type="text" id="name" name="name" required class="form-control" placeholder="e.g. Sustainable Fashion">
          <div class="form-text">Will be automatically formatted and slugified.</div>
        </div>

        @if($activeAdminCity)
          <div class="form-group">
            <label class="form-label">City Scope</label>
            <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:6px; padding:8px 12px; margin-bottom:8px;">
              <div style="font-size:12px; font-weight:700; color:#1a1a1e;">
                <i class="fas fa-city" style="color:var(--primary); margin-right:4px;"></i> {{ $activeAdminCity->name }} Exclusive
              </div>
            </div>
            <label style="display:flex; align-items:center; gap:6px; font-size:12px; cursor:pointer;">
              <input type="checkbox" name="is_global" value="1" style="accent-color:var(--primary);">
              <span>Make available globally across all cities</span>
            </label>
          </div>
        @endif

        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px;">
          <i class="fa-solid fa-plus"></i> Add Tag
        </button>
      </form>
    </div>

  </div>

@endsection
