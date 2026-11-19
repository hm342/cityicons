@props([
  'title' => 'Voices: Conversations Worth Preserving',
  'exploreUrl' => null,
  'people' => null,
  'articles' => null,
])

@php
  $exploreUrl = $exploreUrl ?? url('/voices');
  $items = $people ?? $articles;
@endphp

<!-- ══ VOICES / 4-COLUMN CURATED GRID ══ -->
<section id="sec-weddings" class="vogue-weddings-section">
  <div class="vogue-container">
    <div class="section-hed-bar">
      <h2 class="section-hed-title">{{ $title }}</h2>
      <a href="{{ $exploreUrl }}" class="section-hed-link">
        <span>Explore All Voices</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <div class="vogue-4col-grid" id="weddings-4col-grid">
      @if($items && $items->count() > 0)
        @foreach($items as $item)
          @php
            $isPerson = $item instanceof \App\Models\Person;
            $linkUrl = $isPerson ? url('/person/' . ($item->slug ?: $item->id)) : url('/article/' . $item->id);
            $image = $isPerson ? ($item->portrait_image ?: $item->cover_image) : $item->cover_image;
            $title = $item->name ?? $item->title;
            $subtitle = $isPerson ? ($item->profession . ($item->organization ? ' · ' . $item->organization : '')) : ('By ' . ($item->author_name ?? 'Editorial Staff'));
            $tag = $item->category ? $item->category->name : ($isPerson ? 'VOICE' : 'STORY');
          @endphp
          <article class="vogue-card" onclick="location.href='{{ $linkUrl }}'" style="cursor:pointer;">
            <div class="vogue-card__img-wrap" style="height:260px; overflow:hidden; border-radius:4px;">
              <img src="{{ $image ?: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&q=80' }}" alt="{{ $title }}" style="width:100%; height:100%; object-fit:cover; transition:transform 0.3s ease;">
            </div>
            <div class="vogue-card__body" style="padding-top:12px;">
              <span class="vogue-rubric vogue-rubric--red">{{ $tag }}</span>
              <h4 class="vogue-card__title" style="font-family:var(--font-didot); font-size:1.15rem; font-weight:600; line-height:1.3; margin:4px 0 6px;">
                {{ $title }}
              </h4>
              <div class="vogue-card__byline" style="font-size:0.8rem; color:var(--vogue-muted);">
                {{ $subtitle }}
              </div>
            </div>
          </article>
        @endforeach
      @else
        {{ $slot }}
      @endif
    </div>
  </div>
</section>
