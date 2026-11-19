@extends('layouts.admin')

@section('header_title', 'Featured Brand Partners')

@section('content')

  <div class="card">
    <div class="card-header">
      <div>
        <h2 class="card-title">Commercial &amp; Heritage Brand Partners</h2>
        <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
          Strict editorial separation: brand partners appear under clearly marked Featured Partners disclosures.
        </div>
      </div>
      <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Brand Partner
      </a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Brand Name</th>
            <th>Website</th>
            <th>Disclosure Label</th>
            <th>Featured</th>
            <th>Status</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($brands as $brand)
            <tr>
              <td>
                <strong style="color:var(--text-dark); font-size:14px;">{{ $brand->name }}</strong>
                <span class="badge" style="background:{{ $brand->city ? '#fef3c7' : '#e0e7ff' }}; color:{{ $brand->city ? '#92400e' : '#3730a3' }}; font-size:10px; margin-left:6px;">
                  {{ $brand->city ? $brand->city->name : 'National' }}
                </span>
                <div style="font-size:11px; color:var(--text-muted); margin-top:2px;">
                  {{ Str::limit($brand->description, 60) }}
                </div>
              </td>
              <td>
                @if($brand->website_url)
                  <a href="{{ $brand->website_url }}" target="_blank" style="color:var(--primary); font-size:12px; font-weight:600;">
                    Visit Link <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:10px;"></i>
                  </a>
                @else
                  <span style="color:#aaa;">—</span>
                @endif
              </td>
              <td>
                <span style="font-size:11px; background:#f4f4f7; padding:3px 8px; border-radius:4px; font-weight:600;">
                  {{ $brand->disclosure_text ?? 'Partner Content' }}
                </span>
              </td>
              <td>
                @if($brand->is_featured)
                  <span class="badge badge-info">Featured</span>
                @else
                  <span style="color:#aaa;">—</span>
                @endif
              </td>
              <td>
                @if($brand->is_active)
                  <span class="badge badge-success">Active</span>
                @else
                  <span class="badge badge-warning">Inactive</span>
                @endif
              </td>
              <td style="text-align:right; white-space:nowrap;">
                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-secondary btn-sm" title="Edit">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this brand partner?');">
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
                No brand partners added yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
