@extends('layouts.admin')

@section('header_title', 'Editorial Nominations Inbox')

@section('content')

  <div class="card">
    <div class="card-header">
      <div>
        <h2 class="card-title">Editorial Nominations &amp; Story Leads</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Public nominations submitted via the 15-field editorial nomination form.
        </div>
      </div>
    </div>

    <!-- Filters & Search -->
    <form method="GET" action="{{ route('admin.nominations.index') }}" style="display:flex; gap:12px; margin-bottom:20px; flex-wrap:wrap;">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by nominee, nominator, city..." class="form-control" style="flex:1; min-width:200px;">
      
      <select name="status" class="form-control" style="width:180px;">
        <option value="">All Statuses</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending Review</option>
        <option value="reviewed" {{ request('status') === 'reviewed' ? 'selected' : '' }}>Under Review</option>
        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
        <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Converted to Profile</option>
      </select>

      <button type="submit" class="btn btn-dark">
        <i class="fa-solid fa-filter"></i> Filter
      </button>

      @if(request()->anyFilled(['search', 'status']))
        <a href="{{ route('admin.nominations.index') }}" class="btn btn-secondary">Clear</a>
      @endif
    </form>

    <!-- Table -->
    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Nominee Information</th>
            <th>Field / Category</th>
            <th>Nominator Details</th>
            <th>Submitted</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($nominations as $nom)
            <tr>
              <td>
                <div style="font-weight:700; color:var(--text-dark); font-size:14px;">{{ $nom->nominee_name }}</div>
                <div style="font-size:12px; color:var(--text-muted);">
                  {{ $nom->nominee_profession }} · <strong>{{ $nom->nominee_city }}</strong>
                </div>
              </td>
              <td>
                <span class="badge" style="background:#f4f4f7; color:#333;">
                  {{ $nom->category->name ?? 'General' }}
                </span>
              </td>
              <td>
                <div style="font-size:13px; font-weight:600;">{{ $nom->nominator_name }}</div>
                <div style="font-size:11px; color:var(--text-muted);">{{ $nom->nominator_email }} · {{ $nom->nominator_phone }}</div>
              </td>
              <td>
                <span style="font-size:12px; color:var(--text-muted);">
                  {{ $nom->submitted_at ? $nom->submitted_at->diffForHumans() : $nom->created_at->diffForHumans() }}
                </span>
              </td>
              <td>
                @if($nom->status === 'pending')
                  <span class="badge badge-danger">Pending</span>
                @elseif($nom->status === 'approved')
                  <span class="badge badge-success">Approved</span>
                @elseif($nom->status === 'converted')
                  <span class="badge badge-info">Profile Created</span>
                @elseif($nom->status === 'rejected')
                  <span class="badge" style="background:#eee; color:#666;">Rejected</span>
                @else
                  <span class="badge badge-warning">{{ $nom->status }}</span>
                @endif
              </td>
              <td style="text-align:right; white-space:nowrap;">
                <a href="{{ route('admin.nominations.show', $nom->id) }}" class="btn btn-primary btn-sm">
                  <i class="fa-solid fa-eye"></i> View Full Details
                </a>
                <form action="{{ route('admin.nominations.destroy', $nom->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this nomination permanently?');">
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
                No nominations found matching criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div style="margin-top:20px;">
      {{ $nominations->links() }}
    </div>
  </div>

@endsection
