@props([
  'cityId' => 'bhavnagar',
  'cityName' => 'Bhavnagar',
  'title' => null,
  'subtitle' => null,
  'buttonText' => null,
  'exploreUrl' => null,
  'people' => null,
  'articles' => null,
])

@php
  $sectionTitle = $title ?? $cityName;
  $exploreUrl = $exploreUrl ?? url('/' . $cityId);
  $btnText = $buttonText ?? ('Explore ' . $sectionTitle);
  $items = $people ?? $articles;
  $leadItem = $items && $items->count() > 0 ? $items->first() : null;
  $gridItems = $items && $items->count() > 1 ? $items->slice(1, 6) : collect();
@endphp

<!-- ══ SECTION: {{ strtoupper($sectionTitle) }} ═════════════════════════ -->
<section id="sec-{{ $cityId }}" class="city-edition-section">
  <div class="vogue-container">
    <div class="section-hed-bar" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom:28px;">
      <div style="max-width:850px;">
        <h2 class="section-hed-title" style="margin-bottom:6px;">{{ $sectionTitle }}</h2>
        @if(!empty($subtitle))
          <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; line-height:1.5; margin:0;">
            {{ $subtitle }}
          </p>
        @endif
      </div>
      <a href="{{ $exploreUrl }}" class="section-hed-link" style="flex-shrink:0;">
        <span>{{ $btnText }}</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <div class="vogue-sticky-section">
      <!-- Left: Featured Lead Profile / Story -->
      <div class="vogue-sticky-col">
        <article class="vogue-sticky-lead" id="{{ $cityId }}-lead">
          @if($leadItem)
            @php
              $isPerson = $leadItem instanceof \App\Models\Person;
              $linkUrl = $isPerson ? url('/person/' . ($leadItem->slug ?: $leadItem->id)) : url('/article/' . $leadItem->id);
              $image = $isPerson ? ($leadItem->portrait_image ?: $leadItem->cover_image) : $leadItem->cover_image;
              $itemTitle = $leadItem->name ?? $leadItem->title;
              $itemSubtitle = $isPerson ? ($leadItem->profession . ($leadItem->organization ? ' · ' . $leadItem->organization : '')) : ('By ' . ($leadItem->author_name ?? 'Editorial Staff'));
              $excerpt = $isPerson ? $leadItem->tagline : $leadItem->excerpt;
              $categoryName = $leadItem->category ? $leadItem->category->name : ($isPerson ? strtoupper($leadItem->type) : 'FEATURE');
            @endphp
            <div class="vogue-card vogue-card--lead" onclick="location.href='{{ $linkUrl }}'" style="cursor:pointer;">
              <div class="vogue-card__img-wrap">
                <img src="{{ $image ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&q=80' }}" alt="{{ $itemTitle }}" loading="lazy">
              </div>
              <div class="vogue-card__body">
                <span class="vogue-rubric vogue-rubric--red">{{ $categoryName }}</span>
                <h3 class="vogue-card__title">{{ $itemTitle }}</h3>
                <p class="vogue-card__excerpt">{{ $excerpt }}</p>
                <div class="vogue-card__byline">{{ $itemSubtitle }}</div>
              </div>
            </div>
          @else
            {{ $lead ?? '' }}
          @endif
        </article>
      </div>

      <!-- Right: 6 Stories Grid (2 columns x 3 rows) -->
      <div class="vogue-scroll-right-grid" id="{{ $cityId }}-grid-6">
        @if($gridItems->count() > 0)
          @foreach($gridItems as $item)
            @php
              $isPerson = $item instanceof \App\Models\Person;
              $linkUrl = $isPerson ? url('/person/' . ($item->slug ?: $item->id)) : url('/article/' . $item->id);
              $image = $isPerson ? ($item->portrait_image ?: $item->cover_image) : $item->cover_image;
              $itemTitle = $item->name ?? $item->title;
              $itemSubtitle = $isPerson ? $item->profession : ($item->read_time ?? '4 min read');
              $categoryName = $item->category ? $item->category->name : ($isPerson ? strtoupper($item->type) : 'STORY');
            @endphp
            <article class="vogue-card vogue-card--sub" onclick="location.href='{{ $linkUrl }}'" style="cursor:pointer;">
              <div class="vogue-card__img-wrap">
                <img src="{{ $image ?: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80' }}" alt="{{ $itemTitle }}" loading="lazy">
              </div>
              <div class="vogue-card__body">
                <span class="vogue-rubric">{{ $categoryName }}</span>
                <h4 class="vogue-card__title">{{ $itemTitle }}</h4>
                <div class="vogue-card__byline">{{ $itemSubtitle }}</div>
              </div>
            </article>
          @endforeach
        @else
          {{ $slot }}
        @endif
      </div>
    </div>
  </div>
</section>
