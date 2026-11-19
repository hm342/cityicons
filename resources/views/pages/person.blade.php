<x-layouts.app title="{{ $person->name }} — {{ $person->category ? $person->category->name : 'Icon' }} · Bhavnagar Icons">

  <article class="person-profile-page" style="padding-top:36px; padding-bottom:var(--section-gap);">
    <div class="vogue-container">

      <!-- Breadcrumbs -->
      <nav aria-label="Breadcrumb" style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-muted); margin-bottom:28px;">
        <a href="{{ url('/') }}" style="color:var(--vogue-muted);">Home</a>
        <span style="margin:0 8px;">/</span>
        <a href="{{ url('/' . ($person->type === 'voice' ? 'voices' : ($person->type === 'rising' ? 'rising' : 'icons'))) }}" style="color:var(--vogue-muted);">
          {{ $person->type === 'voice' ? 'Voices' : ($person->type === 'rising' ? 'Rising' : 'Icons') }}
        </a>
        <span style="margin:0 8px;">/</span>
        <span style="color:var(--vogue-red);">{{ $person->name }}</span>
      </nav>

      <!-- Profile Header Block -->
      <header style="border-bottom:2px solid var(--vogue-black); padding-bottom:24px; margin-bottom:36px;">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px; flex-wrap:wrap;">
          <span class="vogue-rubric vogue-rubric--red" style="font-size:0.75rem; letter-spacing:2.5px;">
            {{ $person->category ? strtoupper($person->category->name) : 'FEATURED' }}
          </span>
          <span style="color:var(--vogue-muted);">·</span>
          <span style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; background:var(--vogue-black); color:#fff; padding:3px 10px; border-radius:2px;">
            {{ strtoupper($person->type === 'voice' ? 'Voice' : ($person->type === 'rising' ? 'Rising Star' : 'Icon')) }}
          </span>
          <span style="color:var(--vogue-muted);">·</span>
          <span style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-muted);">
            {{ $person->city ? $person->city->name : 'Bhavnagar' }}
          </span>
        </div>

        <h1 style="font-family:var(--font-didot); font-size:clamp(2.5rem, 5.5vw, 4.5rem); font-weight:400; line-height:1.08; color:var(--vogue-black); margin-bottom:14px; letter-spacing:-0.5px;">
          {{ $person->name }}
        </h1>

        <p style="font-family:var(--font-garamond); font-size:clamp(1.35rem, 2.2vw, 1.85rem); font-style:italic; line-height:1.35; color:#2c2c2c; max-width:920px; margin-bottom:16px;">
          {{ $person->tagline ?: ($person->profession . ($person->organization ? ' with ' . $person->organization : '')) }}
        </p>

        <div style="display:flex; align-items:center; gap:18px; font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-muted); flex-wrap:wrap;">
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
          <!-- Master Portrait Photo (Standard 4:5 Editorial Portrait Ratio) -->
          <div class="person-portrait-box" style="width:100%; max-width:520px; aspect-ratio:4 / 5; overflow:hidden; background-color:#181818; margin-bottom:28px; position:relative; border:1px solid var(--vogue-border); border-radius:2px;">
            <img src="{{ $person->portrait_image ?: ($person->cover_image ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=1200&q=85') }}" 
                 alt="{{ $person->name }}" 
                 style="width:100%; height:100%; object-fit:cover; object-position:center 15%; display:block;">
            <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.72) 100%); padding:16px 22px; color:#ffffff;">
              <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red);">
                Documented Record · Bhavnagar Icons
              </div>
              <div style="font-family:var(--font-didot); font-size:1.15rem; font-weight:400; margin-top:2px;">
                {{ $person->name }}
              </div>
            </div>
          </div>

          <!-- Editorial Signature Pull Quote -->
          <blockquote style="border-left:3px solid var(--vogue-red); padding-left:22px; margin:32px 0; font-family:var(--font-garamond); font-size:1.4rem; font-style:italic; line-height:1.5; color:var(--vogue-black);">
            “Selected with purpose. Documented with responsibility.”
          </blockquote>

          <!-- Long-Form Biography / Profile Story -->
          <div class="editorial-bio-prose" style="font-family:var(--font-garamond); font-size:1.25rem; line-height:1.8; color:#222; margin-bottom:36px;">
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
                {{ $person->name }} is recognized within Bhavnagar Icons for exemplary work, enduring dedication, and demonstrable impact in {{ $person->category ? strtolower($person->category->name) : 'their field' }}. 
                Serving as {{ $person->profession }}{{ $person->organization ? ' at ' . $person->organization : '' }}, their contribution forms part of the city's living intellectual and cultural heritage.
              </p>
              <p style="margin-bottom:20px;">
                Through disciplined practice and principled leadership, their journey exemplifies the standards of verifiable achievement and lasting relevance prioritized by this platform.
              </p>
            @endif
          </div>

          <!-- Gallery Images (if available) -->
          @if(!empty($person->gallery_images) && is_array($person->gallery_images))
            <div style="margin:36px 0;">
              <h3 style="font-family:var(--font-sans); font-size:0.75rem; font-weight:800; letter-spacing:2.5px; text-transform:uppercase; margin-bottom:16px;">
                Archival Visuals
              </h3>
              <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
                @foreach($person->gallery_images as $gImg)
                  <div style="height:180px; overflow:hidden; background:#eee;">
                    <img src="{{ $gImg }}" alt="{{ $person->name }}" style="width:100%; height:100%; object-fit:cover;">
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Official Standards & Non-Commercial Notice (PDF Page 7, 18, 19) -->
          <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:24px 28px; margin-top:36px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:8px;">
              Editorial Independence Notice
            </div>
            <p style="font-family:var(--font-garamond); font-size:1.05rem; line-height:1.6; color:#555; margin:0;">
              Icons documents individuals with a credible connection to Bhavnagar and an established body of work in their field. Selection is based on verifiable achievement, contribution, influence and long-term editorial relevance. <strong>Recognition cannot be purchased.</strong>
            </p>
          </div>
        </div>

        <!-- Right Column: Sidebar Factsheet & Context -->
        <div>
          <!-- Factsheet Box -->
          <div style="background:#ffffff; border:1px solid var(--vogue-border); padding:28px; margin-bottom:32px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-black); border-bottom:1px solid var(--vogue-border); padding-bottom:12px; margin-bottom:18px;">
              Profile Factsheet
            </div>

            <dl style="font-size:0.85rem; line-height:1.8;">
              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">Field of Practice</dt>
              <dd style="font-weight:700; color:var(--vogue-black); margin-bottom:14px;">{{ $person->category ? $person->category->name : 'General' }}</dd>

              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">Designation / Role</dt>
              <dd style="font-weight:600; color:var(--vogue-black); margin-bottom:14px;">{{ $person->profession }}</dd>

              @if($person->organization)
                <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">Affiliation / Enterprise</dt>
                <dd style="font-weight:600; color:var(--vogue-black); margin-bottom:14px;">{{ $person->organization }}</dd>
              @endif

              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">City Jurisdiction</dt>
              <dd style="font-weight:600; color:var(--vogue-black); margin-bottom:14px;">{{ $person->city ? $person->city->name : 'Bhavnagar' }}</dd>

              <dt style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">Archival Tier</dt>
              <dd style="font-weight:700; color:var(--vogue-red); margin-bottom:14px; text-transform:uppercase;">
                {{ $person->type === 'voice' ? 'Voices (Conversations)' : ($person->type === 'rising' ? 'Rising Stars' : 'Flagship Icon') }}
              </dd>
            </dl>

            <!-- Social & Official Links -->
            @if($person->website || $person->social_linkedin || $person->social_instagram)
              <div style="border-top:1px solid var(--vogue-border); padding-top:16px; margin-top:16px;">
                <div style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted); margin-bottom:10px;">
                  Official References
                </div>
                <div style="display:flex; flex-direction:column; gap:8px; font-size:0.8rem; font-weight:600;">
                  @if($person->website)
                    <a href="{{ $person->website }}" target="_blank" rel="noopener" style="color:var(--vogue-black); text-decoration:underline;">
                      <i class="fas fa-globe" style="margin-right:6px; color:var(--vogue-red);"></i> Official Website
                    </a>
                  @endif
                  @if($person->social_linkedin)
                    <a href="{{ $person->social_linkedin }}" target="_blank" rel="noopener" style="color:var(--vogue-black); text-decoration:underline;">
                      <i class="fab fa-linkedin" style="margin-right:6px; color:var(--vogue-red);"></i> LinkedIn Verification
                    </a>
                  @endif
                  @if($person->social_instagram)
                    <a href="{{ $person->social_instagram }}" target="_blank" rel="noopener" style="color:var(--vogue-black); text-decoration:underline;">
                      <i class="fab fa-instagram" style="margin-right:6px; color:var(--vogue-red);"></i> Instagram Portfolio
                    </a>
                  @endif
                </div>
              </div>
            @endif

            <!-- Share Profile -->
            <div style="border-top:1px solid var(--vogue-border); padding-top:16px; margin-top:16px;">
              <div style="font-size:0.6875rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted); margin-bottom:10px;">
                Share Documented Profile
              </div>
              <div style="display:flex; gap:12px; font-size:1.1rem; color:var(--vogue-black);">
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($person->name . ' — Bhavnagar Icons') }}" target="_blank" rel="noopener" aria-label="Share on X"><i class="fab fa-x-twitter"></i></a>
                <a href="https://linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>

          <!-- Nomination Box -->
          <div style="background:var(--vogue-black); color:#ffffff; padding:28px; margin-bottom:32px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:8px;">
              Know a Story Worth Documenting?
            </div>
            <p style="font-family:var(--font-garamond); font-size:1.05rem; line-height:1.5; color:rgba(255,255,255,0.8); margin-bottom:18px;">
              Nominate yourself or someone whose work, journey or contribution deserves editorial consideration.
            </p>
            <a href="{{ url('/nominate') }}" style="display:inline-block; background:var(--vogue-red); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:10px 20px;">
              Submit a Nomination
            </a>
          </div>

          <!-- Related Stories (if available) -->
          @if($relatedArticles && $relatedArticles->count() > 0)
            <div style="border:1px solid var(--vogue-border); padding:24px;">
              <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-black); border-bottom:1px solid var(--vogue-border); padding-bottom:10px; margin-bottom:16px;">
                Related Editorial Coverage
              </div>
              <div style="display:flex; flex-direction:column; gap:16px;">
                @foreach($relatedArticles as $art)
                  <article style="display:flex; gap:12px; align-items:center; cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
                    <div style="width:72px; height:54px; flex-shrink:0; overflow:hidden; background:#eee;">
                      <img src="{{ $art->cover_image }}" alt="{{ $art->title }}" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div>
                      <span style="font-size:0.625rem; font-weight:700; color:var(--vogue-red); text-transform:uppercase; letter-spacing:1px;">
                        {{ $art->category ? $art->category->name : 'Story' }}
                      </span>
                      <h4 style="font-family:var(--font-didot); font-size:0.95rem; font-weight:500; line-height:1.25; margin:2px 0 0;">
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

      <!-- More Documented Profiles Strip -->
      @if($morePeople && $morePeople->count() > 0)
        <section style="margin-top:64px; border-top:2px solid var(--vogue-black); padding-top:36px;">
          <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px;">
            <div>
              <span class="vogue-rubric vogue-rubric--red">ARCHIVAL CONTINUITY</span>
              <h2 style="font-family:var(--font-didot); font-size:clamp(1.6rem, 2.5vw, 2.2rem); font-weight:400; margin:4px 0 0;">
                More {{ $person->type === 'voice' ? 'Voices' : ($person->type === 'rising' ? 'Rising Stars' : 'Documented Icons') }}
              </h2>
            </div>
            <a href="{{ url('/' . ($person->type === 'voice' ? 'voices' : ($person->type === 'rising' ? 'rising' : 'icons'))) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-black);">
              View All {{ $person->type === 'voice' ? 'Voices' : ($person->type === 'rising' ? 'Rising' : 'Icons') }} &rarr;
            </a>
          </div>

          <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:24px;">
            @foreach($morePeople as $other)
              <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/person/' . ($other->slug ?: $other->id)) }}'">
                <div class="vogue-card__img-wrap" style="width:100%; aspect-ratio:4 / 5; overflow:hidden; background:#181818; margin-bottom:12px; border-radius:2px;">
                  <img src="{{ $other->portrait_image ?: $other->cover_image }}" alt="{{ $other->name }}" style="width:100%; height:100%; object-fit:cover; object-position:center 15%;">
                </div>
                <span class="vogue-rubric">{{ $other->category ? $other->category->name : 'ARCHIVE' }}</span>
                <h3 style="font-family:var(--font-didot); font-size:1.25rem; font-weight:500; line-height:1.2; margin:4px 0 6px;">
                  {{ $other->name }}
                </h3>
                <div class="vogue-byline">{{ $other->profession }}</div>
              </article>
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
