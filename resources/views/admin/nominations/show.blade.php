@extends('layouts.admin')

@section('header_title', 'Nomination Review: ' . $nomination->nominee_name)

@section('content')

  <div style="display:grid; grid-template-columns:2fr 1.2fr; gap:24px; align-items:start;">
    
    <!-- Left Column: Full Nomination Details -->
    <div>
      <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; border-bottom:1px solid var(--border-color); padding-bottom:18px; margin-bottom:20px;">
          <div>
            <span class="badge" style="background:#f4f4f7; color:#333; margin-bottom:6px;">
              {{ $nomination->category->name ?? 'Category Unspecified' }}
            </span>
            <h1 style="font-size:24px; font-weight:800; color:var(--text-dark); margin:0;">
              {{ $nomination->nominee_name }}
            </h1>
            <div style="font-size:14px; color:var(--text-muted); margin-top:4px;">
              {{ $nomination->nominee_profession }} · <strong>{{ $nomination->nominee_city }}</strong>
            </div>
          </div>
          <div>
            @if($nomination->status === 'pending')
              <span class="badge badge-danger" style="font-size:13px; padding:6px 12px;">Pending Review</span>
            @elseif($nomination->status === 'approved')
              <span class="badge badge-success" style="font-size:13px; padding:6px 12px;">Approved</span>
            @elseif($nomination->status === 'converted')
              <span class="badge badge-info" style="font-size:13px; padding:6px 12px;">Converted to Profile</span>
            @else
              <span class="badge badge-warning" style="font-size:13px; padding:6px 12px;">{{ ucfirst($nomination->status) }}</span>
            @endif
          </div>
        </div>

        <h3 style="font-size:12px; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:12px;">
          Nomination Narrative &amp; Justification
        </h3>
        <div style="background:#f9f9fb; border:1px solid var(--border-color); border-radius:8px; padding:18px; line-height:1.7; font-size:14px; white-space:pre-line; margin-bottom:24px;">
          {{ $nomination->nominee_description }}
        </div>

        @if($nomination->nominee_website)
          <div style="margin-bottom:24px;">
            <strong style="font-size:12px; text-transform:uppercase; color:var(--text-muted);">Website / Social Link:</strong>
            <div style="margin-top:4px;">
              <a href="{{ $nomination->nominee_website }}" target="_blank" style="color:var(--primary); font-weight:600;">
                {{ $nomination->nominee_website }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:11px;"></i>
              </a>
            </div>
          </div>
        @endif

        @if($nomination->nominee_image_path)
          <div style="margin-bottom:24px;">
            <strong style="font-size:12px; text-transform:uppercase; color:var(--text-muted); display:block; margin-bottom:8px;">Supporting Attachment:</strong>
            <img src="{{ $nomination->nominee_image_path }}" alt="" style="max-width:100%; max-height:280px; object-fit:cover; border-radius:8px; border:1px solid var(--border-color);">
          </div>
        @endif

        <!-- Nominator Info -->
        <h3 style="font-size:12px; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:12px; border-top:1px solid var(--border-color); padding-top:20px;">
          Submitted By
        </h3>
        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; font-size:13px;">
          <div>
            <div style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Nominator Name</div>
            <strong style="color:var(--text-dark);">{{ $nomination->nominator_name }}</strong>
          </div>
          <div>
            <div style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Email</div>
            <a href="mailto:{{ $nomination->nominator_email }}" style="color:var(--primary); font-weight:600;">{{ $nomination->nominator_email }}</a>
          </div>
          <div>
            <div style="color:var(--text-muted); font-size:11px; text-transform:uppercase;">Phone</div>
            <strong style="color:var(--text-dark);">{{ $nomination->nominator_phone ?? 'Not provided' }}</strong>
          </div>
        </div>

      </div>

      <!-- Legal & Consent Verification (Page 16 of Handover PDF) -->
      <div class="card">
        <h2 class="card-title" style="margin-bottom:16px;">Verified Consent &amp; Commitments</h2>
        <div style="display:flex; flex-direction:column; gap:10px; font-size:13px;">
          <div style="display:flex; align-items:center; gap:10px; color:#15803d;">
            <i class="fa-solid fa-circle-check"></i>
            <span>Confirmed accuracy of submitted materials</span>
          </div>
          <div style="display:flex; align-items:center; gap:10px; color:#15803d;">
            <i class="fa-solid fa-circle-check"></i>
            <span>Confirmed permission to share media and documentation</span>
          </div>
          <div style="display:flex; align-items:center; gap:10px; color:#15803d;">
            <i class="fa-solid fa-circle-check"></i>
            <span>Consented to editorial review and verification contact</span>
          </div>
          <div style="display:flex; align-items:center; gap:10px; color:#15803d;">
            <i class="fa-solid fa-circle-check"></i>
            <span>Acknowledged that editorial recognition cannot be purchased</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column: Status & Conversion Workflow -->
    <div>
      
      <!-- One-Click Convert to Profile -->
      <div class="card" style="border:2px solid var(--primary); background:#fffdfd;">
        <h2 class="card-title" style="color:var(--primary); margin-bottom:10px;">
          <i class="fa-solid fa-wand-magic-sparkles"></i> Convert to Profile
        </h2>
        <p style="font-size:13px; color:var(--text-dark); line-height:1.5; margin-bottom:18px;">
          Approved this nomination? Automatically generate a complete People profile draft pre-filled with this nominee's details.
        </p>

        @if($nomination->converted_to_person_id)
          <div class="alert alert-info" style="margin-bottom:0;">
            <i class="fa-solid fa-circle-info"></i>
            <div>
              Already converted!
              <a href="{{ route('admin.people.edit', $nomination->converted_to_person_id) }}" style="font-weight:700; text-decoration:underline;">
                View Created Profile →
              </a>
            </div>
          </div>
        @else
          <form action="{{ route('admin.nominations.convert', $nomination->id) }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-label" for="convert_type">Select Profile Tier *</label>
              <select name="type" id="convert_type" class="form-control" style="font-weight:700;">
                <option value="icon">ICON — Flagship Living Legend</option>
                <option value="rising" selected>RISING — Next-Gen Innovator</option>
                <option value="voice">VOICE — Cultural / Social Custodian</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px;">
              <i class="fa-solid fa-user-plus"></i> Convert to Profile Draft
            </button>
          </form>
        @endif
      </div>

      <!-- Editorial Status & Notes -->
      <div class="card">
        <h2 class="card-title" style="margin-bottom:16px;">Editorial Decision &amp; Notes</h2>

        <form action="{{ route('admin.nominations.status', $nomination->id) }}" method="POST">
          @csrf

          <div class="form-group">
            <label class="form-label" for="status_select">Review Status *</label>
            <select name="status" id="status_select" class="form-control" style="font-weight:700;">
              <option value="pending" {{ $nomination->status === 'pending' ? 'selected' : '' }}>Pending Review</option>
              <option value="reviewed" {{ $nomination->status === 'reviewed' ? 'selected' : '' }}>Under Review</option>
              <option value="approved" {{ $nomination->status === 'approved' ? 'selected' : '' }}>Approved</option>
              <option value="rejected" {{ $nomination->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
              <option value="converted" {{ $nomination->status === 'converted' ? 'selected' : '' }}>Converted to Profile</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="admin_notes">Internal Editorial Notes</label>
            <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control" placeholder="Add confidential verification notes, contact log, or reasons for decision...">{{ old('admin_notes', $nomination->admin_notes) }}</textarea>
          </div>

          <button type="submit" class="btn btn-dark" style="width:100%; justify-content:center; padding:11px;">
            <i class="fa-solid fa-save"></i> Save Status &amp; Notes
          </button>
        </form>

        <div style="border-top:1px solid var(--border-color); padding-top:16px; margin-top:20px; display:flex; justify-content:space-between; align-items:center;">
          <a href="{{ route('admin.nominations.index') }}" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Back to Inbox
          </a>

          <form action="{{ route('admin.nominations.destroy', $nomination->id) }}" method="POST" onsubmit="return confirm('Permanently delete this nomination?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="fa-solid fa-trash"></i> Delete
            </button>
          </form>
        </div>
      </div>

    </div>

  </div>

@endsection
