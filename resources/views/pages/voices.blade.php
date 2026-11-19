<x-layouts.app title="Voices — Perspectives, cultural documentation and lived experience">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <span class="vogue-rubric vogue-rubric--red">ORAL HISTORIES &amp; CULTURAL PERSPECTIVES</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Voices
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          Perspectives, cultural documentation and lived experience.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6;">
          Voices captures interviews, essays, personal reflections and documentation from community figures, cultural practitioners, observers and contributors whose perspectives enrich our understanding of the city.
        </p>
      </div>

      <!-- Categories Filter Bar -->
      <div style="display:flex; flex-wrap:wrap; gap:8px 14px; margin-bottom:36px; padding:16px 0; border-bottom:1px solid var(--vogue-border); font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
        <span style="color:var(--vogue-muted);">Filter by Field:</span>
        <a href="{{ url('/voices') }}" style="{{ !request('category') ? 'color:var(--vogue-red);' : 'color:var(--vogue-black);' }}">All Voices</a>
        @foreach($categories as $cat)
          · <a href="{{ url('/voices?category=' . $cat->slug) }}" style="{{ request('category') === $cat->slug ? 'color:var(--vogue-red);' : 'color:var(--vogue-black);' }}">
            {{ $cat->name }}
          </a>
        @endforeach
      </div>

      <!-- 4-Column Grid of Voices -->
      @if($people->count() > 0)
        <div class="vogue-4col-grid" style="margin-bottom:36px;">
          @foreach($people as $person)
            <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/stories') }}'">
              <div class="vogue-card__img-wrap" style="height:280px; overflow:hidden; border-radius:4px;">
                <img src="{{ $person->portrait_image ?: $person->cover_image }}" alt="{{ $person->name }}" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
              </div>
              <div class="vogue-card__body" style="padding-top:12px;">
                <span class="vogue-rubric vogue-rubric--red">{{ $person->category ? $person->category->name : 'VOICE' }}</span>
                <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.2rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">
                  {{ $person->name }}
                </h3>
                <p style="font-family:var(--font-garamond); font-size:0.95rem; color:#555; line-height:1.4; margin-bottom:8px;">
                  {{ Str::limit($person->tagline, 90) }}
                </p>
                <div class="vogue-card__byline" style="font-size:0.8rem; color:var(--vogue-muted);">
                  {{ $person->profession }}
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div>
          {{ $people->links() }}
        </div>
      @else
        <div style="text-align:center; padding:60px 20px; color:var(--vogue-muted);">
          <p style="font-family:var(--font-garamond); font-size:1.2rem;">No Voices profiles published under this category yet.</p>
          <a href="{{ url('/voices') }}" style="color:var(--vogue-red); font-size:0.8rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin-top:8px; display:inline-block;">View All Voices</a>
        </div>
      @endif

    </div>
  </section>

  <!-- Nomination CTA -->
  <x-nomination-cta />

</x-layouts.app>
