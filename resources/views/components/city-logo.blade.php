@props([
  'city' => null,
  'theme' => 'white', // 'white' (default on dark city header) or 'dark' (on light bg)
  'size' => 'normal',  // 'sm', 'normal', 'lg'
  'href' => null,
  'class' => ''
])

@php
  $cSlug = $city ? (is_object($city) ? $city->slug : (string)$city) : 'bhavnagar';
  $cName = $city ? (is_object($city) ? $city->name : ucfirst($cSlug)) : 'Bhavnagar';
  $url = $href ?? url('/' . $cSlug);
  
  $isWhite = ($theme === 'white' || $theme === 'light-text');
  $suffix = $isWhite ? '-white' : '';
  $imageRelPath = 'images/logo-' . $cSlug . $suffix . '.png';
  $imageExists = file_exists(public_path($imageRelPath));
  
  $themeClass = $isWhite ? 'rm-city-brand-logo--white' : 'rm-city-brand-logo--dark';
@endphp

<a href="{{ $url }}" class="rm-city-brand-logo {{ $themeClass }} rm-city-brand-logo--{{ $size }} {{ $class }}" aria-label="{{ $cName }} Icons">
  @if($imageExists)
    <img src="{{ asset($imageRelPath) }}" alt="{{ $cName }} Icons" class="rm-city-brand-logo__img" loading="eager" decoding="async">
  @else
    {{-- Dynamic Typographic Editorial Lockup Fallback for Any Newly Added City --}}
    <span class="rm-city-brand-logo__lockup">
      <span class="rm-city-brand-logo__cap-i">I</span>
      <span class="rm-city-brand-logo__col">
        <span class="rm-city-brand-logo__city">{{ strtoupper($cName) }}</span>
        <span class="rm-city-brand-logo__cons">cons</span>
      </span>
    </span>
  @endif
</a>
