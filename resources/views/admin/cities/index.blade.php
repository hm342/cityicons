@extends('layouts.admin')

@section('header_title', 'City Editions Network')

@section('content')

  <div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
      <div>
        <h2 class="card-title">{{ $cities->count() }} City Editions</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Manage national and regional city editions, their hero imagery, accent colors, and taglines.
        </div>
      </div>
      <div>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-plus"></i> Add New City Edition
        </a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width:70px;">Hero</th>
            <th>City &amp; State</th>
            <th>Tagline</th>
            <th>Accent</th>
            <th>Content Volume</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cities as $city)
            <tr style="{{ session('admin_city_id') == $city->id ? 'background:#fff8f8;' : '' }}">
              <td>
                @if($city->hero_image)
                  <img src="{{ $city->hero_image }}" alt="" style="width:60px; height:42px; object-fit:cover; border-radius:4px;">
                @else
                  <div style="width:60px; height:42px; background:#eee; border-radius:4px; display:flex; align-items:center; justify-content:center; color:#999;">
                    <i class="fa-solid fa-city"></i>
                  </div>
                @endif
              </td>
              <td>
                <strong style="color:var(--text-dark); font-size:14px;">{{ $city->name }}</strong>
                <span style="font-size:12px; color:var(--text-muted);">({{ $city->state }})</span>
                @if($city->slug === 'bhavnagar')
                  <span class="badge" style="background:#fef2f2; color:var(--primary); margin-left:6px;">Flagship</span>
                @endif
                @if(session('admin_city_id') == $city->id)
                  <span class="badge" style="background:#dcfce7; color:#15803d; margin-left:6px;"><i class="fa-solid fa-check"></i> Active Workspace</span>
                @endif
              </td>
              <td style="color:var(--text-muted); font-size:13px; font-style:italic;">
                "{{ $city->tagline ?? '—' }}"
              </td>
              <td>
                <div style="display:flex; align-items:center; gap:8px;">
                  <span style="width:18px; height:18px; border-radius:50%; background:{{ $city->accent_color }}; border:1px solid rgba(0,0,0,0.1);"></span>
                  <span style="font-family:monospace; font-size:11px;">{{ $city->accent_color }}</span>
                </div>
              </td>
              <td>
                <span style="font-size:12px; font-weight:600;">
                  {{ $city->articles_count }} Stories · {{ $city->people_count }} People
                </span>
              </td>
              <td>
                @if($city->is_active)
                  <span class="badge badge-success">Active Edition</span>
                @else
                  <span class="badge badge-warning">Inactive</span>
                @endif
              </td>
              <td style="text-align:right; white-space:nowrap;">
                @if(session('admin_city_id') != $city->id)
                  <a href="{{ route('admin.switch-city', $city->id) }}" class="btn btn-sm" style="background:#e0f2fe; color:#0369a1;" title="Switch workspace to this city">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i> Switch
                  </a>
                @endif
                <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-secondary btn-sm" title="Edit Edition">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <a href="{{ url('/' . $city->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="View Public Page">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
                @if($city->slug !== 'bhavnagar')
                  <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete {{ $city->name }} edition?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary btn-sm" style="color:#ef4444;" title="Delete Edition">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
