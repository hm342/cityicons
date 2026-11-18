@extends('layouts.admin')

@section('header_title', 'Newsletter Subscribers')

@section('content')

  <div class="card">
    <div class="card-header">
      <div>
        <h2 class="card-title">Editorial Newsletter Network</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Subscribers who have opted in for CityIcons weekly dispatches and issue releases.
        </div>
      </div>
      <a href="{{ route('admin.subscribers.export') }}" class="btn btn-dark">
        <i class="fa-solid fa-file-csv"></i> Export to CSV
      </a>
    </div>

    <!-- Filters & Search -->
    <form method="GET" action="{{ route('admin.subscribers.index') }}" style="display:flex; gap:12px; margin-bottom:20px; flex-wrap:wrap;">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by email or name..." class="form-control" style="flex:1; min-width:200px;">
      
      <select name="source" class="form-control" style="width:180px;">
        <option value="">All Sources</option>
        <option value="footer" {{ request('source') === 'footer' ? 'selected' : '' }}>Footer Signup</option>
        <option value="homepage" {{ request('source') === 'homepage' ? 'selected' : '' }}>Homepage Strip</option>
        <option value="article" {{ request('source') === 'article' ? 'selected' : '' }}>Article Reader</option>
        <option value="nominate" {{ request('source') === 'nominate' ? 'selected' : '' }}>Nomination Opt-in</option>
      </select>

      <button type="submit" class="btn btn-dark">
        <i class="fa-solid fa-filter"></i> Filter
      </button>

      @if(request()->anyFilled(['search', 'source']))
        <a href="{{ route('admin.subscribers.index') }}" class="btn btn-secondary">Clear</a>
      @endif
    </form>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Email Address</th>
            <th>Name</th>
            <th>Source</th>
            <th>Subscribed Date</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($subscribers as $sub)
            <tr>
              <td>
                <strong style="color:var(--text-dark); font-size:14px;">{{ $sub->email }}</strong>
              </td>
              <td>
                {{ $sub->name ?? '—' }}
              </td>
              <td>
                <span class="badge" style="background:#f4f4f7; color:#333;">
                  {{ ucfirst($sub->source) }}
                </span>
              </td>
              <td>
                <span style="font-size:12px; color:var(--text-muted);">
                  {{ $sub->subscribed_at ? $sub->subscribed_at->format('M d, Y · H:i') : $sub->created_at->format('M d, Y') }}
                </span>
              </td>
              <td>
                @if($sub->is_active)
                  <span class="badge badge-success">Active</span>
                @else
                  <span class="badge badge-warning">Unsubscribed</span>
                @endif
              </td>
              <td style="text-align:right;">
                <form action="{{ route('admin.subscribers.destroy', $sub->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Remove subscriber?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" title="Remove">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center; padding:40px; color:var(--text-muted);">
                No subscribers recorded yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div style="margin-top:20px;">
      {{ $subscribers->links() }}
    </div>
  </div>

@endsection
