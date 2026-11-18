@extends('layouts.admin')

@section('header_title', 'Editorial Platform Overview')

@section('content')

  <!-- Stats Grid -->
  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:20px; margin-bottom:28px;">
    
    <div class="card" style="margin-bottom:0; display:flex; align-items:center; gap:16px;">
      <div style="width:48px; height:48px; border-radius:10px; background:#eff6ff; color:#2563eb; display:flex; align-items:center; justify-content:center; font-size:20px;">
        <i class="fa-solid fa-newspaper"></i>
      </div>
      <div>
        <div style="font-size:24px; font-weight:800; color:var(--text-dark); line-height:1.1;">{{ $stats['articles_count'] }}</div>
        <div style="font-size:12px; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Articles &amp; Stories</div>
        <div style="font-size:11px; color:#16a34a; margin-top:2px;">{{ $stats['published_articles'] }} Published</div>
      </div>
    </div>

    <div class="card" style="margin-bottom:0; display:flex; align-items:center; gap:16px;">
      <div style="width:48px; height:48px; border-radius:10px; background:#fef2f2; color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:20px;">
        <i class="fa-solid fa-users"></i>
      </div>
      <div>
        <div style="font-size:24px; font-weight:800; color:var(--text-dark); line-height:1.1;">{{ $stats['people_count'] }}</div>
        <div style="font-size:12px; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Documented People</div>
        <div style="font-size:11px; color:var(--text-muted); margin-top:2px;">{{ $stats['icons_count'] }} Icons · {{ $stats['rising_count'] }} Rising · {{ $stats['voices_count'] }} Voices</div>
      </div>
    </div>

    <div class="card" style="margin-bottom:0; display:flex; align-items:center; gap:16px;">
      <div style="width:48px; height:48px; border-radius:10px; background:#fef9c3; color:#ca8a04; display:flex; align-items:center; justify-content:center; font-size:20px;">
        <i class="fa-solid fa-inbox"></i>
      </div>
      <div>
        <div style="font-size:24px; font-weight:800; color:var(--text-dark); line-height:1.1;">{{ $stats['nominations_count'] }}</div>
        <div style="font-size:12px; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Nominations</div>
        <div style="font-size:11px; color:{{ $stats['pending_nominations'] > 0 ? 'var(--primary)' : '#16a34a' }}; font-weight:700; margin-top:2px;">
          {{ $stats['pending_nominations'] }} Pending Review
        </div>
      </div>
    </div>

    <div class="card" style="margin-bottom:0; display:flex; align-items:center; gap:16px;">
      <div style="width:48px; height:48px; border-radius:10px; background:#f0fdf4; color:#16a34a; display:flex; align-items:center; justify-content:center; font-size:20px;">
        <i class="fa-solid fa-envelope-open-text"></i>
      </div>
      <div>
        <div style="font-size:24px; font-weight:800; color:var(--text-dark); line-height:1.1;">{{ $stats['subscribers_count'] }}</div>
        <div style="font-size:12px; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Subscribers</div>
        <div style="font-size:11px; color:var(--text-muted); margin-top:2px;">Newsletter network</div>
      </div>
    </div>

  </div>

  <!-- Quick Action Bar -->
  <div class="card" style="padding:16px 24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
    <div style="font-weight:700; font-size:13px; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px;">
      <i class="fa-solid fa-bolt" style="color:var(--primary); margin-right:6px;"></i> Quick Actions:
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
      <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus"></i> New Article
      </a>
      <a href="{{ route('admin.people.create') }}" class="btn btn-dark btn-sm">
        <i class="fa-solid fa-user-plus"></i> Add Profile
      </a>
      <a href="{{ route('admin.nominations.index') }}" class="btn btn-secondary btn-sm">
        <i class="fa-solid fa-inbox"></i> Review Submissions
      </a>
      <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary btn-sm">
        <i class="fa-solid fa-sliders"></i> Edit Settings
      </a>
    </div>
  </div>

  <div style="display:grid; grid-template-columns:1.6fr 1fr; gap:24px;">
    
    <!-- Recent Articles -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><i class="fa-solid fa-newspaper" style="color:var(--primary); margin-right:8px;"></i> Recent Stories &amp; Articles</h2>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm">View All ({{ $stats['articles_count'] }})</a>
      </div>

      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Story</th>
              <th>Category</th>
              <th>Status</th>
              <th style="text-align:right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentArticles as $art)
              <tr>
                <td>
                  <div style="display:flex; align-items:center; gap:12px;">
                    @if($art->cover_image)
                      <img src="{{ $art->cover_image }}" alt="" style="width:42px; height:42px; object-fit:cover; border-radius:4px; flex-shrink:0;">
                    @else
                      <div style="width:42px; height:42px; background:#eee; border-radius:4px; display:flex; align-items:center; justify-content:center; color:#999; flex-shrink:0;">
                        <i class="fa-solid fa-image"></i>
                      </div>
                    @endif
                    <div>
                      <a href="{{ route('admin.articles.edit', $art->id) }}" style="font-weight:700; color:var(--text-dark); text-decoration:none; display:block; line-height:1.3;">
                        {{ Str::limit($art->title, 48) }}
                      </a>
                      <span style="font-size:11px; color:var(--text-muted);">
                        By {{ $art->author_name ?? 'Editorial Staff' }} · {{ $art->created_at->diffForHumans() }}
                      </span>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge" style="background:#f4f4f7; color:#333;">
                    {{ $art->category->name ?? 'General' }}
                  </span>
                </td>
                <td>
                  @if($art->status === 'published')
                    <span class="badge badge-success">Published</span>
                  @else
                    <span class="badge badge-warning">Draft</span>
                  @endif
                </td>
                <td style="text-align:right;">
                  <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-secondary btn-sm" title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" style="text-align:center; padding:32px; color:var(--text-muted);">
                  No articles created yet. <a href="{{ route('admin.articles.create') }}">Create first article</a>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Recent Nominations -->
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><i class="fa-solid fa-inbox" style="color:var(--primary); margin-right:8px;"></i> Recent Nominations</h2>
        <a href="{{ route('admin.nominations.index') }}" class="btn btn-secondary btn-sm">All</a>
      </div>

      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Nominee</th>
              <th>Status</th>
              <th style="text-align:right;">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentNominations as $nom)
              <tr>
                <td>
                  <div style="font-weight:700; color:var(--text-dark);">{{ $nom->nominee_name }}</div>
                  <div style="font-size:11px; color:var(--text-muted);">{{ $nom->nominee_profession }} · {{ $nom->nominee_city }}</div>
                </td>
                <td>
                  @if($nom->status === 'pending')
                    <span class="badge badge-danger">Pending</span>
                  @elseif($nom->status === 'approved')
                    <span class="badge badge-success">Approved</span>
                  @elseif($nom->status === 'converted')
                    <span class="badge badge-info">Profile</span>
                  @else
                    <span class="badge badge-warning">{{ $nom->status }}</span>
                  @endif
                </td>
                <td style="text-align:right;">
                  <a href="{{ route('admin.nominations.show', $nom->id) }}" class="btn btn-secondary btn-sm">
                    Review
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" style="text-align:center; padding:32px; color:var(--text-muted);">
                  No nominations submitted yet.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>

@endsection
