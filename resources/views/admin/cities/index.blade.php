@extends('layouts.admin')

@section('header_title', 'City Editions Network')

@section('content')

  <div class="card">
    <div class="card-header">
      <div>
        <h2 class="card-title">10 City Editions</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Manage the 10 national and regional city editions, their hero imagery, accent colors, and taglines.
        </div>
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
            <tr>
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
                <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-secondary btn-sm" title="Edit Edition">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <a href="{{ $city->slug === 'bhavnagar' ? url('/') : url('/cities/' . $city->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="View Public Page">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
