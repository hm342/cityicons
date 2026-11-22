@php
  $cSlug = $person->city ? $person->city->slug : 'bhavnagar';
  $cName = $person->city ? $person->city->name : 'Bhavnagar';
  $tierSlug = $person->type === 'rising' ? 'rising' : 'icons';
  $tierName = $person->type === 'rising' ? 'Rising' : 'Icons';
@endphp

<x-layouts.app title="{{ $person->name }} — {{ $person->category ? $person->category->name : 'Icon' }} · {{ $cName }} Icons" :city="$person->city" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$person->city" :active="$tierSlug" />

  <article style="padding: 40px 0 80px;">
    <div class="rm-container">

      <!-- Breadcrumbs -->
      <nav aria-label="Breadcrumb" style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--text-dim); margin-bottom:28px;">
        <a href="{{ url('/') }}" style="color:var(--text-dim);">Home</a>
        <span style="margin:0 8px;">/</span>
        <a href="{{ url('/' . $cSlug) }}" style="color:var(--text-dim);">{{ $cName }}</a>
        <span style="margin:0 8px;">/</span>
        <a href="{{ url('/' . $cSlug . '/' . $tierSlug) }}" style="color:var(--text-dim);">{{ $tierName }}</a>
        <span style="margin:0 8px;">/</span>
        <span style="color:var(--vogue-red);">{{ $person->name }}</span>
      </nav>

      <!-- Profile Header Block -->
      <header style="border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:28px; margin-bottom:36px;">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px; flex-wrap:wrap;">
          <span class="cat-italic" style="color:var(--vogue-red); font-size:1.15rem; margin-bottom:0;">
            {{ $person->category ? $person->category->name : 'Featured' }}
          </span>
          <span style="color:var(--text-dim);">·</span>
          <span style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:rgba(255,255,255,0.1); color:#fff; padding:3px 10px; border-radius:2px;">
            {{ strtoupper($person->type === 'rising' ? 'Rising Star' : 'Flagship Icon') }}
          </span>
          <span style="color:var(--text-dim);">·</span>
          <span style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--text-muted);">
            {{ $cName }}
          </span>
        </div>

        <h1 style="font-family:var(--font-sans); font-size:clamp(2.5rem, 5vw, 4rem); font-weight:700; line-height:1.1; color:#ffffff; margin-bottom:14px; letter-spacing:-0.5px;">
          {{ $person->name }}
        </h1>

        <p style="font-family:var(--font-italic-cat); font-size:clamp(1.35rem, 2.2vw, 1.85rem); font-style:italic; line-height:1.35; color:var(--text-white); max-width:920px; margin-bottom:16px;">
          {{ $person->tagline ?: ($person->profession . ($person->organization ? ' with ' . $person->organization : '')) }}
        </p>

        <div style="display:flex; align-items:center; gap:16px; font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--text-muted); flex-wrap:wrap;">
          <span>{{ $person->profession }}</span>
          @if($person->organization)
            <span>·</span>
            <span>{{ $person->organization }}</span>
          @endif
          <span>·</span>
          <span>Permanent Archive Record</span>
        </div>
      </header>

      <!-- Main Profile Layout Grid -->
      <div style="display:grid; grid-template-columns:1.8fr 1fr; gap:48px; align-items:start;" class="person-layout-grid">
        
        <!-- Left Column: Media & Editorial Biography -->
        <div>
          <!-- Master Portrait Photo -->
          <div style="width:100%; max-width:540px; aspect-ratio:4 / 5; overflow:hidden; background-color:#181818; margin-bottom:32px; position:relative; border:1px solid rgba(255,255,255,0.08); border-radius:4px; box-shadow:0 16px 36px rgba(0,0,0,0.5);">
            <img src="{{ $person->portrait_image ?: ($person->cover_image ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=1200&q=85') }}" 
                 alt="{{ $person->name }}" 
                 style="width:100%; height:100%; object-fit:cover; object-position:center 15%; display:block;">
            <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.85) 100%); padding:20px 24px; color:#ffffff;">
              <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red);">
                Documented Record · {{ $cName }} Icons
              </div>
              <div style="font-family:var(--font-sans); font-size:1.15rem; font-weight:700; margin-top:4px;">
                {{ $person->name }}
              </div>
            </div>
          </div>

          <!-- Editorial Signature Quote -->
          <blockquote style="border-left:3px solid var(--vogue-red); padding-left:22px; margin:32px 0; font-family:var(--font-italic-cat); font-size:1.45rem; font-style:italic; line-height:1.5; color:#ffffff;">
            “Selected with purpose. Documented with responsibility.”
          </blockquote>

          <!-- Long-Form Biography / Profile Story -->
          <div style="font-family:var(--font-sans); font-size:1.1rem; line-height:1.8; color:#d8d8d8; margin-bottom:40px;">
            @if($person->bio)
              @if(strip_tags($person->bio) !== $person->bio)
                {!! $person->bio !!}
              @else
                @foreach(explode("\n", $person->bio) as $para)
                  @if(trim($para))
                    <p style="margin-bottom:20px;">{{ trim($para) }}</p>
                  @endif
                @endforeach
              @endif
            @else
              <p style="margin-bottom:20px;">
                {{ $person->name }} is recognized within {{ $cName }} Icons for exemplary work, enduring dedication, and demonstrable impact in {{ $person->category ? strtolower($person->category->name) : 'their field' }}. 
                Serving as {{ $person->profession }}{{ $person->organization ? ' at ' . $person->organization : '' }}, their contribution forms part of the city's living intellectual and cultural heritage.
              </p>
              <p style="margin-bottom:20px;">
                Through disciplined practice and principled leadership, their journey exemplifies the standards of verifiable achievement and lasting relevance prioritized by this platform.
              </p>
            @endif
          </div>

          <!-- Official Standards Notice -->
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:24px 28px; border-radius:4px; margin-top:36px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:8px;">
              Editorial Independence Notice
            </div>
            <p style="font-size:0.95rem; line-height:1.6; color:var(--text-muted); margin:0;">
              Icons documents individuals with a credible connection to {{ $cName }} and an established body of work in their field. Selection is based on verifiable achievement, contribution, influence and long-term editorial relevance. <strong>Recognition cannot be purchased.</strong>
            </p>
          </div>
        </div>

        <!-- Right Column: Sidebar Factsheet & Context -->
        <div>
          <!-- Factsheet Box -->
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px; margin-bottom:32px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:#ffffff; border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:12px; margin-bottom:18px;">
              Profile Factsheet
            </div>

            <dl style="font-size:0.9rem; line-height:1.8;">
              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-dim);">Field of Practice</dt>
              <dd style="font-weight:700; color:#ffffff; margin-bottom:14px;">{{ $person->category ? $person->category->name : 'General' }}</dd>

              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-dim);">Designation / Role</dt>
              <dd style="font-weight:600; color:var(--text-white); margin-bottom:14px;">{{ $person->profession }}</dd>

              @if($person->organization)
                <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-dim);">Affiliation / Enterprise</dt>
                <dd style="font-weight:600; color:var(--text-white); margin-bottom:14px;">{{ $person->organization }}</dd>
              @endif

              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-dim);">City Jurisdiction</dt>
              <dd style="font-weight:600; color:var(--text-white); margin-bottom:14px;">{{ $cName }}</dd>

              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-dim);">Archival Tier</dt>
              <dd style="font-weight:700; color:var(--vogue-red); margin-bottom:14px; text-transform:uppercase;">
                {{ $person->type === 'rising' ? 'Rising Stars' : 'Flagship Icon' }}
              </dd>
            </dl>

            <!-- Social Links -->
            @if($person->website || $person->social_linkedin || $person->social_instagram)
              <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:16px; margin-top:16px;">
                <div style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-dim); margin-bottom:10px;">
                  Official References
                </div>
                <div style="display:flex; flex-direction:column; gap:8px; font-size:0.85rem; font-weight:600;">
                  @if($person->website)
                    <a href="{{ $person->website }}" target="_blank" rel="noopener" style="color:#ffffff; text-decoration:underline;">
                      <i class="fas fa-globe" style="margin-right:6px; color:var(--vogue-red);"></i> Official Website
                    </a>
                  @endif
                  @if($person->social_linkedin)
                    <a href="{{ $person->social_linkedin }}" target="_blank" rel="noopener" style="color:#ffffff; text-decoration:underline;">
                      <i class="fab fa-linkedin" style="margin-right:6px; color:var(--vogue-red);"></i> LinkedIn Verification
                    </a>
                  @endif
                  @if($person->social_instagram)
                    <a href="{{ $person->social_instagram }}" target="_blank" rel="noopener" style="color:#ffffff; text-decoration:underline;">
                      <i class="fab fa-instagram" style="margin-right:6px; color:var(--vogue-red);"></i> Instagram Portfolio
                    </a>
                  @endif
                </div>
              </div>
            @endif

            <!-- Share Profile -->
            <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:16px; margin-top:16px;">
              <div class="post-share-inline" style="margin-top:0;">
                <span class="share-txt">Share Profile:</span>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($person->name . ' — ' . $cName . ' Icons: ' . url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on WhatsApp" style="color:#25d366;"><i class="fab fa-whatsapp"></i></a>
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($person->name . ' — ' . $cName . ' Icons') }}" target="_blank" rel="noopener" aria-label="Share on X"><i class="fab fa-x-twitter"></i></a>
                <a href="https://linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>

          <!-- Nomination Box -->
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px; margin-bottom:32px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:8px;">
              Know a Story Worth Documenting?
            </div>
            <p style="font-size:0.95rem; line-height:1.55; color:var(--text-muted); margin-bottom:18px;">
              Nominate yourself or someone whose work, journey or contribution deserves editorial consideration.
            </p>
            <a href="{{ url('/' . $cSlug . '/nominate') }}" class="btn-pill" style="background:var(--vogue-red); padding:10px 24px; margin-top:0;">
              Submit a Nomination
            </a>
          </div>

          <!-- Related Stories -->
          @if($relatedArticles && $relatedArticles->count() > 0)
            <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:24px; border-radius:4px;">
              <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:#ffffff; border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:10px; margin-bottom:16px;">
                Related Editorial Stories
              </div>
              <div style="display:flex; flex-direction:column; gap:16px;">
                @foreach($relatedArticles as $art)
                  <article style="display:flex; gap:12px; align-items:center; cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
                    <div style="width:72px; height:54px; flex-shrink:0; overflow:hidden; background:#181818; border-radius:2px;">
                      <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div>
                      <span style="font-size:0.625rem; font-weight:700; color:var(--vogue-red); text-transform:uppercase; letter-spacing:1px;">
                        {{ $art->category ? $art->category->name : 'Story' }}
                      </span>
                      <h4 style="font-family:var(--font-sans); font-size:0.95rem; font-weight:600; line-height:1.25; margin:2px 0 0; color:#fff;">
                        {{ Str::limit($art->title, 55) }}
                      </h4>
                    </div>
                  </article>
                @endforeach
              </div>
            </div>
          @endif

        </div>

      </div>

      <!-- More Documented Profiles -->
      @if($morePeople && $morePeople->count() > 0)
        <section style="margin-top:64px; border-top:1px solid rgba(255,255,255,0.08); padding-top:40px;">
          <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px;">
            <div>
              <span class="cat-italic" style="color:var(--vogue-red); font-size:1.15rem; margin-bottom:4px;">Archival Continuity</span>
              <h2 style="font-family:var(--font-sans); font-size:clamp(1.6rem, 2.5vw, 2.2rem); font-weight:700; color:#fff; margin:0;">
                More {{ $person->type === 'rising' ? 'Rising Stars' : 'Documented Icons' }}
              </h2>
            </div>
            <a href="{{ url('/' . $cSlug . '/' . $tierSlug) }}" class="btn-pill" style="margin-top:0;">
              View All {{ $person->type === 'rising' ? 'Rising' : 'Icons' }} &rarr;
            </a>
          </div>

          <div class="rm-grid-cards">
            @foreach($morePeople as $other)
              <a href="{{ url('/person/' . ($other->slug ?: $other->id)) }}" class="rm-grid-card">
                <img src="{{ $other->portrait_image ?: $other->cover_image }}" alt="{{ $other->name }}" class="rm-grid-card-img" loading="lazy">
                <div class="rm-grid-card-overlay"></div>
                <div class="rm-grid-card-body">
                  <span class="cat-italic">{{ $other->category ? $other->category->name : 'Archive' }}</span>
                  <h3 class="rm-grid-card-title">{{ $other->name }}</h3>
                  <p style="font-size:0.8rem; color:var(--text-muted); margin-bottom:8px;">{{ $other->profession }}</p>
                </div>
              </a>
            @endforeach
          </div>
        </section>
      @endif

    </div>
  </article>

  <style>
    @media (max-width: 900px) {
      .person-layout-grid {
        grid-template-columns: 1fr !important;
        gap: 32px !important;
      }
    }
  </style>

</x-layouts.app>
