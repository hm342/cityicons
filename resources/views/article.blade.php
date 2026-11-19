<x-layouts.app title="{{ $article->title }} — CITYICONS">

  @push('styles')
  <style>
    .article-reader-wrap {
      padding: 40px 0 80px;
    }
    .article-header-meta {
      border-bottom: 2px solid var(--vogue-black);
      padding-bottom: 20px;
      margin-bottom: 32px;
    }
    .article-main-title {
      font-family: var(--font-didot);
      font-size: clamp(2.2rem, 4.5vw, 3.8rem);
      font-weight: 400;
      line-height: 1.15;
      margin: 12px 0 16px;
      color: var(--vogue-black);
    }
    .article-dek {
      font-family: var(--font-garamond);
      font-size: clamp(1.2rem, 2vw, 1.5rem);
      line-height: 1.5;
      color: #333;
      margin-bottom: 20px;
    }
    .article-byline-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
      font-size: 0.8rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      font-weight: 700;
      color: var(--vogue-muted);
      border-top: 1px solid var(--vogue-border);
      padding-top: 16px;
    }
    .article-lead-image {
      margin-bottom: 48px;
    }
    .article-lead-image img {
      width: 100%;
      height: clamp(380px, 60vh, 650px);
      object-fit: cover;
      display: block;
    }
    .article-body-layout {
      display: grid;
      grid-template-columns: 2.2fr 1fr;
      gap: 60px;
      align-items: start;
    }
    .article-prose {
      font-family: var(--font-garamond);
      font-size: 1.25rem;
      line-height: 1.8;
      color: #222;
    }
    .article-prose p {
      margin-bottom: 24px;
    }
    .article-prose h2, .article-prose h3 {
      font-family: var(--font-didot);
      font-size: 1.8rem;
      font-weight: 400;
      margin: 40px 0 16px;
      color: var(--vogue-black);
      line-height: 1.25;
    }
    .article-prose blockquote {
      border-left: 3px solid var(--vogue-red);
      padding-left: 24px;
      margin: 36px 0;
      font-style: italic;
      font-size: 1.4rem;
      color: var(--vogue-black);
      line-height: 1.5;
    }
    .article-sidebar {
      position: sticky;
      top: 100px;
      display: flex;
      flex-direction: column;
      gap: 32px;
    }
    @media (max-width: 900px) {
      .article-body-layout {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      .article-sidebar {
        position: static;
      }
    }
  </style>
  @endpush

  <article class="article-reader-wrap">
    <div class="vogue-container">

      <!-- Header Meta -->
      <div class="article-header-meta">
        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ $article->category ? $article->category->name : 'EDITORIAL' }}
          </span>
          @if($article->city)
            <span style="font-size:0.75rem; letter-spacing:1px; text-transform:uppercase; font-weight:700; color:var(--vogue-muted);">
              · {{ $article->city->name }} Edition
            </span>
          @endif
        </div>

        <h1 class="article-main-title">{{ $article->title }}</h1>
        <p class="article-dek">{{ $article->excerpt }}</p>

        <div class="article-byline-bar">
          <div>
            By <strong style="color:var(--vogue-black);">{{ $article->author_name ?? 'Editorial Staff' }}</strong>
            · <span>{{ $article->published_at ? $article->published_at->format('F d, Y') : $article->created_at->format('F d, Y') }}</span>
            · <span>{{ $article->read_time ?? '5 min read' }}</span>
          </div>

          <!-- Social Share -->
          <div style="display:flex; gap:12px; align-items:center; font-size:14px;">
            <span style="font-size:0.7rem; color:var(--vogue-muted);">Share:</span>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener" style="color:var(--vogue-black);" title="Share on X">
              <i class="fa-brands fa-x-twitter"></i>
            </a>
            <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->url()) }}" target="_blank" rel="noopener" style="color:#25d366;" title="Share on WhatsApp">
              <i class="fa-brands fa-whatsapp"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" style="color:#1877f2;" title="Share on Facebook">
              <i class="fa-brands fa-facebook"></i>
            </a>
            <button onclick="navigator.clipboard.writeText(window.location.href); alert('Article URL copied to clipboard!');" style="background:none; border:none; color:var(--vogue-black); cursor:pointer;" title="Copy Link">
              <i class="fa-solid fa-link"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Hero Lead Image -->
      @if($article->cover_image)
        <div class="article-lead-image">
          <img src="{{ $article->cover_image }}" alt="{{ $article->title }}">
        </div>
      @endif

      <!-- Body & Sidebar Layout -->
      <div class="article-body-layout">
        
        <!-- Main Body -->
        <div class="article-prose">
          {!! $article->body ?: '<p>' . e($article->excerpt) . '</p><p>Selected with purpose. Documented with responsibility. CityIcons documents the individuals, cultural custodians, and visionary minds building the fabric of our cities.</p>' !!}

          <!-- Tags Cloud -->
          @if($article->tags && $article->tags->count() > 0)
            <div style="margin-top:40px; padding-top:24px; border-top:1px solid var(--vogue-border); display:flex; flex-wrap:wrap; gap:8px; align-items:center;">
              <span style="font-family:var(--font-sans); font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-muted);">Filed Under:</span>
              @foreach($article->tags as $t)
                <a href="{{ url('/stories?q=' . urlencode($t->name)) }}" style="font-family:var(--font-sans); font-size:0.75rem; font-weight:700; color:var(--vogue-black); text-decoration:none; background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:4px 10px; border-radius:3px;">
                  #{{ $t->name }}
                </a>
              @endforeach
            </div>
          @endif
        </div>

        <!-- Sidebar -->
        <aside class="article-sidebar">
          
          <!-- Author Card -->
          <div style="background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:24px;">
            <span class="vogue-rubric" style="font-size:0.65rem;">EDITORIAL BYLINE</span>
            <h3 style="font-family:var(--font-didot); font-size:1.3rem; margin:6px 0 8px;">
              {{ $article->author_name ?? 'CityIcons Editorial Staff' }}
            </h3>
            <p style="font-family:var(--font-garamond); font-size:1rem; color:#555; line-height:1.5;">
              {{ $article->author_bio ?? 'Selected with purpose. Documented with responsibility. The editorial desk at CityIcons.' }}
            </p>
          </div>

          <!-- Related Stories -->
          @if($related && $related->count() > 0)
            <div>
              <div style="font-family:var(--font-sans); font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; border-bottom:2px solid var(--vogue-black); padding-bottom:8px; margin-bottom:16px;">
                Related Documentation
              </div>
              <div style="display:flex; flex-direction:column; gap:20px;">
                @foreach($related as $rel)
                  <article onclick="location.href='{{ url('/article/' . $rel->id) }}'" style="cursor:pointer; display:flex; gap:14px; align-items:center;">
                    @if($rel->cover_image)
                      <img src="{{ $rel->cover_image }}" alt="{{ $rel->title }}" style="width:72px; height:72px; object-fit:cover; flex-shrink:0; border-radius:3px;">
                    @endif
                    <div>
                      <span class="vogue-rubric" style="font-size:0.6rem;">{{ $rel->category ? $rel->category->name : 'STORY' }}</span>
                      <h4 style="font-family:var(--font-didot); font-size:0.95rem; font-weight:600; line-height:1.3; margin:4px 0;">
                        {{ Str::limit($rel->title, 55) }}
                      </h4>
                      <div style="font-size:0.7rem; color:var(--vogue-muted);">{{ $rel->read_time ?? '4 min read' }}</div>
                    </div>
                  </article>
                @endforeach
              </div>
            </div>
          @endif

        </aside>

      </div>

    </div>
  </article>

  <!-- Nomination CTA -->
  <x-nomination-cta />

</x-layouts.app>
