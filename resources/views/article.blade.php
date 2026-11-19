@php
  $cSlug = $article->city ? $article->city->slug : 'bhavnagar';
  $cName = $article->city ? $article->city->name : 'Bhavnagar';
@endphp

<x-layouts.app title="{{ $article->title }} — CITYICONS" :city="$article->city" :darkTheme="true" :transparentHeader="true">

  <!-- Real Moments Subpage Navigation Header -->
  <x-city-header :city="$article->city" active="stories" />

  <article style="padding: 40px 0 80px;">
    <div class="rm-container">

      <!-- Breadcrumbs -->
      <nav aria-label="Breadcrumb" style="font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--text-dim); margin-bottom:28px;">
        <a href="{{ url('/') }}" style="color:var(--text-dim);">Home</a>
        <span style="margin:0 8px;">/</span>
        <a href="{{ url('/' . $cSlug) }}" style="color:var(--text-dim);">{{ $cName }}</a>
        <span style="margin:0 8px;">/</span>
        <a href="{{ url('/' . $cSlug . '/stories') }}" style="color:var(--text-dim);">Stories</a>
        <span style="margin:0 8px;">/</span>
        <span style="color:var(--vogue-red);">{{ Str::limit($article->title, 35) }}</span>
      </nav>

      <!-- Header Meta -->
      <header style="border-bottom:1px solid rgba(255,255,255,0.08); padding-bottom:24px; margin-bottom:32px;">
        <span class="cat-italic" style="color:var(--vogue-red); font-size:1.15rem; margin-bottom:6px;">
          {{ $article->category ? $article->category->name : 'Editorial Story' }}
        </span>
        <h1 style="font-family:var(--font-sans); font-size:clamp(2.2rem, 4.5vw, 3.6rem); font-weight:700; line-height:1.15; margin:10px 0 16px; color:#ffffff; letter-spacing:-0.5px;">
          {{ $article->title }}
        </h1>
        @if($article->excerpt)
          <p style="font-family:var(--font-italic-cat); font-style:italic; font-size:clamp(1.25rem, 2vw, 1.6rem); line-height:1.45; color:var(--text-white); margin-bottom:20px;">
            {{ $article->excerpt }}
          </p>
        @endif
        
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; font-size:0.8rem; letter-spacing:1px; text-transform:uppercase; font-weight:700; color:var(--text-muted); border-top:1px solid rgba(255,255,255,0.08); padding-top:16px;">
          <div style="display:flex; align-items:center; gap:8px;">
            <span>By {{ $article->author_name ?? 'Editorial Desk' }}</span>
            <span>·</span>
            <span>{{ $article->published_at ? $article->published_at->format('j F Y') : 'Recent' }}</span>
            @if($article->city)
              <span>·</span>
              <span style="color:var(--vogue-red);">{{ $article->city->name }}</span>
            @endif
          </div>
          <div class="post-share-inline" style="margin-top:0;">
            <span class="share-txt">Share:</span>
            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener"><i class="fab fa-x-twitter"></i></a>
            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"><i class="fab fa-pinterest-p"></i></a>
          </div>
        </div>
      </header>

      <!-- Lead Image -->
      @if($article->cover_image)
        <div style="margin-bottom:48px; border-radius:4px; overflow:hidden; border:1px solid rgba(255,255,255,0.08); box-shadow:0 16px 36px rgba(0,0,0,0.5);">
          <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" style="width:100%; height:clamp(380px, 60vh, 650px); object-fit:cover; display:block;">
        </div>
      @endif

      <!-- Article Prose & Sidebar Layout -->
      <div style="display:grid; grid-template-columns:2.2fr 1fr; gap:60px; align-items:start;" class="article-body-layout">
        
        <!-- Story Body -->
        <div style="font-family:var(--font-sans); font-size:1.15rem; line-height:1.85; color:#d6d6d6;">
          @if(strip_tags($article->content) !== $article->content)
            {!! $article->content !!}
          @else
            @foreach(explode("\n", $article->content) as $para)
              @if(trim($para))
                <p style="margin-bottom:24px;">{{ trim($para) }}</p>
              @endif
            @endforeach
          @endif

          <!-- Tags -->
          @if($article->tags && $article->tags->count() > 0)
            <div style="margin-top:48px; padding-top:24px; border-top:1px solid rgba(255,255,255,0.08); display:flex; gap:8px; flex-wrap:wrap; align-items:center;">
              <span style="font-size:0.75rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-dim); margin-right:8px;">Topics:</span>
              @foreach($article->tags as $t)
                <span class="rm-filter-pill" style="font-size:0.7rem; padding:4px 14px;">{{ $t->name }}</span>
              @endforeach
            </div>
          @endif
        </div>

        <!-- Sidebar -->
        <aside>
          <!-- Editorial Box -->
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px; margin-bottom:32px;">
            <span class="cat-italic" style="color:var(--vogue-red); font-size:1.1rem; margin-bottom:8px;">Editorial Dispatch</span>
            <h3 style="font-family:var(--font-sans); font-size:1.35rem; font-weight:700; color:#fff; margin-bottom:10px;">
              {{ $cName }} Icons Platform
            </h3>
            <p style="font-size:0.9rem; line-height:1.6; color:var(--text-muted); margin-bottom:16px;">
              Documenting credible people, meaningful journeys and lasting contributions connected to {{ $cName }}.
            </p>
            <a href="{{ url('/' . $cSlug) }}" class="btn-pill" style="background:#333; margin-top:0;">
              Explore {{ $cName }} Edition
            </a>
          </div>

          <!-- Nominate CTA -->
          <div style="background:#242424; border:1px solid rgba(255,255,255,0.08); padding:28px; border-radius:4px;">
            <div style="font-size:0.6875rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--vogue-red); margin-bottom:8px;">
              Know a Story Worth Documenting?
            </div>
            <p style="font-size:0.9rem; line-height:1.6; color:var(--text-muted); margin-bottom:18px;">
              Nominate yourself or someone whose work, journey or contribution deserves editorial consideration.
            </p>
            <a href="{{ url('/' . $cSlug . '/nominate') }}" class="btn-pill" style="background:var(--vogue-red); margin-top:0;">
              Submit a Nomination
            </a>
          </div>
        </aside>

      </div>

    </div>
  </article>

  <style>
    @media (max-width: 900px) {
      .article-body-layout {
        grid-template-columns: 1fr !important;
        gap: 40px !important;
      }
    }
  </style>

</x-layouts.app>
