@extends('layouts.admin')

@section('header_title', 'People Directory (Icons & Rising Stars)')

@section('content')

  <div class="card">
    <div class="card-header">
      <div>
        <h2 class="card-title">Documented People Directory</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Manage city icons and rising innovators featured across CityIcons.
        </div>
      </div>
      <a href="{{ route('admin.people.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Add New Profile
      </a>
    </div>

    <!-- Filters & Search -->
    <form method="GET" action="{{ route('admin.people.index') }}" style="display:flex; gap:12px; margin-bottom:20px; flex-wrap:wrap;">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, profession, organization..." class="form-control" style="flex:1; min-width:200px;">
      
      <select name="type" class="form-control" style="width:180px;">
        <option value="">All Tiers (Icons / Rising)</option>
        <option value="icon" {{ request('type') === 'icon' ? 'selected' : '' }}>Icons (Flagship)</option>
        <option value="rising" {{ request('type') === 'rising' ? 'selected' : '' }}>Rising Stars</option>
      </select>

      <select name="city_id" class="form-control" style="width:180px;">
        <option value="">{{ $activeCityId ? 'Active: ' . ($cities->firstWhere('id', $activeCityId)->name ?? '') : 'All Cities' }}</option>
        @foreach($cities as $city)
          <option value="{{ $city->id }}" {{ (request('city_id') ?? $activeCityId) == $city->id ? 'selected' : '' }}>
            {{ $city->name }}
          </option>
        @endforeach
      </select>

      <select name="status" class="form-control" style="width:140px;">
        <option value="">All Statuses</option>
        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
      </select>

      <button type="submit" class="btn btn-dark">
        <i class="fa-solid fa-filter"></i> Filter
      </button>

      @if(request()->anyFilled(['search', 'type', 'city_id', 'status']))
        <a href="{{ route('admin.people.index') }}" class="btn btn-secondary">Clear</a>
      @endif
    </form>

    <!-- Table -->
    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width:60px;">Portrait</th>
            <th>Name &amp; Designation</th>
            <th>Tier</th>
            <th>City</th>
            <th>The List Date</th>
            <th>Featured</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($people as $p)
            <tr>
              <td>
                @if($p->portrait_image)
                  <img src="{{ $p->portrait_image }}" alt="" style="width:48px; height:48px; object-fit:cover; border-radius:50%;">
                @else
                  <div style="width:48px; height:48px; background:#eee; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#999;">
                    <i class="fa-solid fa-user"></i>
                  </div>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.people.edit', $p->id) }}" style="font-weight:700; color:var(--text-dark); text-decoration:none; display:block; font-size:14px; line-height:1.3;">
                  {{ $p->name }}
                </a>
                <div style="font-size:11px; color:var(--text-muted); margin-top:2px;">
                  {{ $p->profession ?? 'Nominee' }} {{ $p->organization ? '· ' . $p->organization : '' }}
                </div>
              </td>
              <td>
                @if($p->type === 'icon')
                  <span class="badge" style="background:#fef2f2; color:var(--primary); font-weight:800;">ICON</span>
                @elseif($p->type === 'rising')
                  <span class="badge" style="background:#eff6ff; color:#2563eb; font-weight:800;">RISING</span>
                @else
                  <span class="badge" style="background:#f0fdf4; color:#16a34a; font-weight:800;">VOICE</span>
                @endif
              </td>
              <td>
                {{ $p->city->name ?? 'Bhavnagar' }}
              </td>
              <td>
                @if($p->year && $p->month)
                  <span style="font-size:12px; font-weight:600; color:#555;">{{ date("F", mktime(0, 0, 0, $p->month, 1)) }} {{ $p->year }}</span>
                @else
                  <span style="color:#aaa;">—</span>
                @endif
              </td>
              <td>
                @if($p->is_featured)
                  <span class="badge badge-info">Featured</span>
                @else
                  <span style="color:#aaa;">—</span>
                @endif
              </td>
              <td>
                @if($p->status === 'published')
                  <span class="badge badge-success">Published</span>
                @else
                  <span class="badge badge-warning">Draft</span>
                @endif
              </td>
              <td style="text-align:right; white-space:nowrap;">
                <a href="{{ route('admin.people.edit', $p->id) }}" class="btn btn-secondary btn-sm" title="Edit Profile">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('admin.people.destroy', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this profile?');">
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
                No profiles found matching criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div style="margin-top:20px;">
      {{ $people->links() }}
    </div>
  </div>

@endsection
