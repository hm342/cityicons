@php
  $cName = isset($city) ? (is_object($city) ? $city->name : ucfirst($city)) : 'Bhavnagar';
  $cSlug = isset($city) ? (is_object($city) ? $city->slug : strtolower($city)) : 'bhavnagar';
  $isFlagship = ($cSlug === 'bhavnagar');
@endphp

<x-layouts.app :title="'In ' . $cName . ' — Events, culture and moments shaping the city'">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:20px; margin-bottom:30px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:8px;">
          <span class="vogue-rubric vogue-rubric--red">
            {{ strtoupper($cName) }} · CULTURAL DISPATCH · LIVE CITY COVERAGE
          </span>
          <a href="{{ url('/' . $cSlug) }}" style="font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; color:var(--vogue-black); text-decoration:underline;">
            &larr; Back to {{ $cName }} Subsite
          </a>
        </div>
        
        <div style="margin:16px 0 16px;">
          @if($isFlagship)
            <a href="{{ url('/in-bhavnagar') }}" style="display:inline-block; text-decoration:none;">
              <img src="{{ asset('images/logo-bhavnagar.png') }}" alt="Bhavnagar Icons" style="height:clamp(48px, 6vw, 70px); width:auto; display:block; object-fit:contain;">
            </a>
          @else
            <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
              In {{ $cName }}
            </h1>
          @endif
        </div>
        
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          Events, culture and moments shaping the city.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6; margin-bottom:8px;">
          In {{ $cName }} documents notable events, performances, exhibitions, conversations and cultural moments through an independent editorial lens. Coverage is selective and based on relevance, public interest, experience and long-term documentation value.
        </p>
        <p style="font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; color:var(--vogue-muted); margin-bottom:14px;">
          Event coverage may be independent or commercially supported. Paid associations are clearly disclosed.
        </p>
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
          <a href="{{ url('/' . $cSlug . '/stories') }}" style="display:inline-flex; align-items:center; gap:8px; background:var(--vogue-black); color:#ffffff; padding:10px 22px; font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; text-decoration:none; border-radius:30px; transition:all 0.2s ease;">
            <span>Explore City Stories</span>
            <i class="fas fa-arrow-right" style="font-size:10px;"></i>
          </a>
          <a href="{{ url('/' . $cSlug) }}" style="display:inline-flex; align-items:center; gap:8px; background:#fff; color:var(--vogue-black); border:1px solid var(--vogue-black); padding:10px 22px; font-size:0.75rem; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; text-decoration:none; border-radius:30px; transition:all 0.2s ease;">
            <span>Explore Full {{ $cName }} Subsite</span>
          </a>
        </div>
      </div>

      <!-- Cinematic Banner + Carousel Component -->
      <x-cinema-section :city-id="$cSlug" :city-name="$cName . ' Cultural Showcase'" :articles="$articles" />

      <!-- All In-[City] Stories Grid -->
      @if($articles && $articles->count() > 0)
        <div style="margin-top:48px;">
          <h2 style="font-family:var(--font-didot); font-size:1.8rem; font-weight:400; border-bottom:1px solid var(--vogue-border); padding-bottom:12px; margin-bottom:28px;">
            Documented Moments &amp; Features in {{ $cName }}
          </h2>
          <div class="vogue-4col-grid">
            @foreach($articles as $art)
              <article class="vogue-card" style="cursor:pointer;" onclick="location.href='{{ url('/article/' . $art->id) }}'">
                <div class="vogue-card__img-wrap">
                  <img src="{{ $art->cover_image ?: 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80' }}" alt="{{ $art->title }}" loading="lazy">
                </div>
                <div class="vogue-card__body" style="padding-top:10px;">
                  <span class="vogue-rubric">{{ $art->category ? $art->category->name : 'DISPATCH' }}</span>
                  <h3 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.05rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">
                    {{ $art->title }}
                  </h3>
                  <div class="vogue-card__byline" style="font-size:0.75rem; color:var(--vogue-muted);">
                    {{ $art->read_time ?? '4 min read' }} · {{ $art->created_at ? $art->created_at->format('M d, Y') : 'Recent' }}
                  </div>
                </div>
              </article>
            @endforeach
          </div>

          <div style="margin-top:32px;">
            {{ $articles->links() }}
          </div>
        </div>
      @endif

    </div>
  </section>

</x-layouts.app>
