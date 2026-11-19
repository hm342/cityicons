<x-layouts.app title="Icons — Bhavnagar Icons: Established work. Proven impact. Lasting relevance.">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <span class="vogue-rubric vogue-rubric--red">BHAVNAGAR ICONS · FLAGSHIP ARCHIVE</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Icons
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          Established work. Proven impact. Lasting relevance.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6;">
          Icons documents individuals with a credible connection to Bhavnagar and an established body of work in their field. Selection is based on verifiable achievement, contribution, influence and long-term editorial relevance.
        </p>
        <div style="font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; color:var(--vogue-red); margin-top:8px;">
          Recognition cannot be purchased.
        </div>
      </div>

      <!-- Categories Filter Bar -->
      <div style="display:flex; flex-wrap:wrap; gap:8px 14px; margin-bottom:36px; padding:16px 0; border-bottom:1px solid var(--vogue-border); font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
        <span style="color:var(--vogue-muted);">Filter by Field:</span>
        <a href="{{ url('/icons') }}" style="{{ !request('category') ? 'color:var(--vogue-red);' : 'color:var(--vogue-black);' }}">All Icons</a>
        @foreach($categories as $cat)
          · <a href="{{ url('/icons?category=' . $cat->slug) }}" style="{{ request('category') === $cat->slug ? 'color:var(--vogue-red);' : 'color:var(--vogue-black);' }}">
            {{ $cat->name }}
          </a>
        @endforeach
      </div>

      <!-- Real Database People Grid (Lead + Grid) -->
      @if($people->count() > 0)
        <div class="vogue-sticky-section">
          <!-- Sticky Lead -->
          @if($lead)
            <div class="vogue-sticky-col">
              <article class="vogue-sticky-lead">
                <div class="vogue-card vogue-card--lead" style="cursor:pointer;" onclick="location.href='{{ url('/stories') }}'">
                  <div class="vogue-card__img-wrap">
                    <img src="{{ $lead->portrait_image ?: $lead->cover_image }}" alt="{{ $lead->name }}" loading="lazy">
                  </div>
                  <div class="vogue-card__body">
                    <span class="vogue-rubric vogue-rubric--red">{{ $lead->category ? $lead->category->name : 'ICON' }}</span>
                    <h2 class="vogue-card__title">{{ $lead->name }}</h2>
                    <p class="vogue-card__excerpt">{{ $lead->tagline }}</p>
                    <div class="vogue-card__byline">{{ $lead->profession }}{{ $lead->organization ? ' · ' . $lead->organization : '' }}</div>
                  </div>
                </div>
              </article>
            </div>
          @endif

          <!-- Rest of People Grid -->
          <div class="vogue-scroll-right-grid">
            @foreach($people->slice(1) as $person)
              <article class="vogue-card vogue-card--sub" style="cursor:pointer;" onclick="location.href='{{ url('/stories') }}'">
                <div class="vogue-card__img-wrap">
                  <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" loading="lazy">
                </div>
                <div class="vogue-card__body">
                  <span class="vogue-rubric">{{ $person->category ? $person->category->name : 'ICON' }}</span>
                  <h3 class="vogue-card__title">{{ $person->name }}</h3>
                  <div class="vogue-card__byline">{{ $person->profession }}</div>
                </div>
              </article>
            @endforeach
          </div>
        </div>

        <div style="margin-top:36px;">
          {{ $people->links() }}
        </div>
      @else
        <div style="text-align:center; padding:60px 20px; color:var(--vogue-muted);">
          <p style="font-family:var(--font-garamond); font-size:1.2rem;">No Icons published under this category yet.</p>
          <a href="{{ url('/icons') }}" style="color:var(--vogue-red); font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin-top:8px; display:inline-block;">View All Icons</a>
        </div>
      @endif

    </div>
  </section>

  <!-- Nomination CTA -->
  <x-nomination-cta />

</x-layouts.app>
