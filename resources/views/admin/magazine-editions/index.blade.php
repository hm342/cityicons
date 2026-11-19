@extends('layouts.admin')

@section('header_title', 'Magazine Editions & Print Archival')

@section('content')

  <div class="card">
    <div class="card-header">
      <div>
        <h2 class="card-title">Published Magazine Editions</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Manage print editions, cover art, and issue descriptions featured in the Magazine showcase.
        </div>
      </div>
      <a href="{{ route('admin.magazine-editions.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Release New Issue
      </a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th style="width:70px;">Cover</th>
            <th>Issue &amp; Title</th>
            <th>City</th>
            <th>Release Date</th>
            <th>Description</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($editions as $ed)
            <tr>
              <td>
                @if($ed->cover_image)
                  <img src="{{ $ed->cover_image }}" alt="" style="width:52px; height:70px; object-fit:cover; border-radius:4px; box-shadow:0 2px 5px rgba(0,0,0,0.15);">
                @else
                  <div style="width:52px; height:70px; background:#eee; border-radius:4px; display:flex; align-items:center; justify-content:center; color:#999;">
                    <i class="fa-solid fa-book"></i>
                  </div>
                @endif
              </td>
              <td>
                <span class="badge" style="background:#111; color:#fff; font-size:10px; margin-bottom:4px;">
                  ISSUE #{{ str_pad($ed->issue_number, 2, '0', STR_PAD_LEFT) }}
                </span>
                <strong style="color:var(--text-dark); font-size:14px; display:block;">{{ $ed->title }}</strong>
              </td>
              <td>
                <span class="badge" style="background:var(--primary-light); color:var(--primary-dark); font-weight:700;">
                  {{ $ed->city ? $ed->city->name : 'All Cities' }}
                </span>
              </td>
              <td>
                <span style="font-size:13px; color:var(--text-muted);">
                  {{ $ed->published_date ? $ed->published_date->format('F Y') : 'Upcoming' }}
                </span>
              </td>
              <td style="max-width:320px; font-size:12px; color:var(--text-muted);">
                {{ Str::limit($ed->description, 100) }}
              </td>
              <td>
                @if($ed->is_active)
                  <span class="badge badge-success">Active Edition</span>
                @else
                  <span class="badge badge-warning">Archived</span>
                @endif
              </td>
              <td style="text-align:right; white-space:nowrap;">
                <a href="{{ route('admin.magazine-editions.edit', $ed->id) }}" class="btn btn-secondary btn-sm" title="Edit">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{ $ed->city ? url('/' . $ed->city->slug . '/magazine') : url('/bhavnagar/magazine') }}" target="_blank" class="btn btn-secondary btn-sm" title="View Public Page">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
                <form action="{{ route('admin.magazine-editions.destroy', $ed->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this magazine edition?');">
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
              <td colspan="6" style="text-align:center; padding:40px; color:var(--text-muted);">
                No magazine editions created yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
