@props([
  'id' => null,
  'title' => '',
  'category' => '',
  'image' => '',
  'author' => '',
  'date' => '',
  'url' => null
])

@php
  $url = $url ?? ($id ? url('/article?id=' . $id) : '#');
@endphp

<article class="vogue-sub-card" onclick="location.href='{{ $url }}'">
  <div class="vogue-sub-card__media">
    <img src="{{ $image }}" alt="{{ $title }}" loading="lazy">
  </div>
  @if($category)
    <span class="vogue-sub-card__rubric">{{ $category }}</span>
  @endif
  <h3 class="vogue-sub-card__hed">{{ $title }}</h3>
  <div class="vogue-sub-card__byline">
    @if($author)
      <span>BY {{ strtoupper($author) }}</span>
    @endif
    @if($date)
      <span class="vogue-sub-card__date">{{ $date }}</span>
    @endif
  </div>
</article>
