<x-layouts.app title="Bhavnagar Icons Magazine — Stories designed to outlast the feed">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <span class="vogue-rubric vogue-rubric--red">CURATED PRINT &amp; DIGITAL EDITION</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Bhavnagar Icons Magazine
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          Stories designed to outlast the feed.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6;">
          Bhavnagar Icons Magazine presents selected profiles, verified journeys and defining stories from the city in a curated editorial format. Each edition contributes to a growing archive of Bhavnagar and its people.
        </p>
      </div>

      <!-- Current Magazine Showcase Banner (From Database) -->
      @if($currentIssue)
        <div style="display:grid; grid-template-columns:1.2fr 1fr; gap:48px; background:var(--vogue-bg-light); border:1px solid var(--vogue-border); padding:clamp(28px, 4vw, 56px); margin-bottom:48px; align-items:center;">
          <div>
            <span class="vogue-rubric vogue-rubric--red" style="margin-bottom:12px;">
              CURRENT ISSUE · ISSUE #{{ str_pad($currentIssue->issue_number, 2, '0', STR_PAD_LEFT) }}
            </span>
            <h2 style="font-family:var(--font-didot); font-size:clamp(2rem, 3.2vw, 2.8rem); font-weight:400; line-height:1.15; margin-bottom:16px;">
              {{ $currentIssue->title }}
            </h2>
            <p style="font-family:var(--font-garamond); font-size:1.2rem; line-height:1.65; color:#333; margin-bottom:24px;">
              {{ $currentIssue->description }}
            </p>

            <div style="display:flex; gap:14px; flex-wrap:wrap;">
              <a href="{{ url('/stories') }}" style="display:inline-block; background:var(--vogue-black); color:#ffffff; font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px 28px; text-decoration:none;">
                Explore Edition Stories
              </a>
              <a href="{{ url('/nominate') }}" style="display:inline-block; border:1px solid var(--vogue-black); color:var(--vogue-black); font-size:0.75rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:14px 28px; text-decoration:none;">
                Nominate for Next Issue
              </a>
            </div>
          </div>

          <div>
            <div style="position:relative; aspect-ratio:3/4; overflow:hidden; box-shadow:0 16px 36px rgba(0,0,0,0.18); background:#000; border-radius:4px;">
              <img src="{{ $currentIssue->cover_image ?: 'https://images.unsplash.com/photo-1706285654021-4b2f69f0e773?w=1000&q=85' }}" alt="{{ $currentIssue->title }}" style="width:100%; height:100%; object-fit:cover;">
              <div style="position:absolute; top:24px; right:24px; font-family:var(--font-didot); font-size:1.6rem; font-weight:700; letter-spacing:6px; color:#fff; text-shadow:0 2px 8px rgba(0,0,0,0.5);">CITYICONS</div>
              <div style="position:absolute; bottom:24px; left:24px; right:24px; color:#fff; text-shadow:0 2px 8px rgba(0,0,0,0.7);">
                <span style="font-size:0.6rem; letter-spacing:2px; text-transform:uppercase; background:var(--vogue-red); padding:3px 10px;">ISSUE {{ $currentIssue->issue_number }}</span>
                <div style="font-family:var(--font-didot); font-size:1.4rem; margin-top:8px;">{{ $currentIssue->published_date ? $currentIssue->published_date->format('F Y') : 'Flagship Edition' }}</div>
              </div>
            </div>
          </div>
        </div>
      @endif

      <!-- Previous Issues Archive Grid -->
      @if($previousIssues && $previousIssues->count() > 0)
        <div style="margin-bottom:48px;">
          <h3 style="font-family:var(--font-didot); font-size:1.8rem; margin-bottom:20px;">Previous Print Issues</h3>
          <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:24px;">
            @foreach($previousIssues as $prev)
              <div style="background:#fff; border:1px solid var(--vogue-border); padding:16px; border-radius:4px;">
                <div style="aspect-ratio:3/4; overflow:hidden; border-radius:3px; margin-bottom:12px;">
                  <img src="{{ $prev->cover_image }}" alt="{{ $prev->title }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <span class="badge" style="background:#111; color:#fff; font-size:0.65rem;">ISSUE #{{ $prev->issue_number }}</span>
                <h4 style="font-family:var(--font-didot); font-size:1.1rem; margin:6px 0;">{{ $prev->title }}</h4>
                <div style="font-size:0.75rem; color:var(--vogue-muted);">{{ $prev->published_date ? $prev->published_date->format('F Y') : '' }}</div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Disclaimer (Page 12) -->
      <div style="border-left:3px solid var(--vogue-red); padding-left:20px; font-size:0.85rem; color:#666; line-height:1.6;">
        <strong style="color:var(--vogue-black); text-transform:uppercase; letter-spacing:1px; display:block; margin-bottom:4px;">Editorial Selection Policy</strong>
        Magazine inclusion is based on editorial relevance, available space and publication planning. A previously published digital profile does not guarantee magazine inclusion.
      </div>

    </div>
  </section>

</x-layouts.app>
