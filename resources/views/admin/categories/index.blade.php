@extends('layouts.admin')

@section('header_title', 'Category Taxonomy')

@section('content')

  <div style="display:grid; grid-template-columns:1.8fr 1fr; gap:24px; align-items:start;">
    
    <!-- Left: Categories List -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Existing Categories</h2>
        <span style="font-size:12px; color:var(--text-muted);">{{ $categories->count() }} Categories</span>
      </div>

      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Color</th>
              <th>Category Name</th>
              <th>City Scope</th>
              <th>Type</th>
              <th>Usage</th>
              <th style="text-align:right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($categories as $cat)
              <tr>
                <td>
                  <span style="display:inline-block; width:18px; height:18px; border-radius:50%; background:{{ $cat->color ?? '#999' }}; border:1px solid rgba(0,0,0,0.1);"></span>
                </td>
                <td>
                  <strong style="color:var(--text-dark); font-size:14px;">{{ $cat->name }}</strong>
                  <div style="font-size:11px; color:var(--text-muted);">Slug: /{{ $cat->slug }}</div>
                </td>
                <td>
                  @if($cat->city)
                    <span class="badge" style="background:var(--primary-light); color:var(--primary-dark); font-weight:700;">
                      <i class="fas fa-city" style="font-size:9px;"></i> {{ $cat->city->name }}
                    </span>
                  @else
                    <span class="badge" style="background:#e5e7eb; color:#374151; font-weight:600;">
                      Global (All Cities)
                    </span>
                  @endif
                </td>
                <td>
                  <span class="badge" style="background:#f4f4f7; color:#333;">
                    {{ ucfirst($cat->type) }}
                  </span>
                </td>
                <td>
                  <span style="font-size:12px; color:var(--text-muted);">
                    {{ $cat->articles_count }} Articles · {{ $cat->people_count }} People
                  </span>
                </td>
                <td style="text-align:right;">
                  <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete category?');">
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
                <td colspan="6" style="text-align:center; padding:32px; color:var(--text-muted);">
                  No categories found.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Right: Add New Category Form -->
    <div class="card">
      <h2 class="card-title" style="margin-bottom:16px;">Add New Category</h2>

      <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label" for="name">Category Name *</label>
          <input type="text" id="name" name="name" required class="form-control" placeholder="e.g. Architecture">
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

        <div class="form-group">
          <label class="form-label" for="type">Category Target *</label>
          <select id="type" name="type" class="form-control">
            <option value="article">Editorial Articles</option>
            <option value="person">People Directory</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="color">Accent Color (Hex)</label>
          <input type="color" id="color" name="color" value="#B51622" class="form-control" style="height:44px; padding:4px;">
        </div>

        <div class="form-group">
          <label class="form-label" for="sort_order">Display Sort Order</label>
          <input type="number" id="sort_order" name="sort_order" value="0" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px;">
          <i class="fa-solid fa-plus"></i> Create Category
        </button>
      </form>
    </div>

  </div>

@endsection
