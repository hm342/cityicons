@props([
  'active' => 'home',
  'city' => null
])

@php
  $cSlug = $city ? (is_object($city) ? $city->slug : $city) : null;
  $cBase = $cSlug ? url('/' . $cSlug) : '';

  if ($cSlug) {
    // City-scoped navigation
    $navItems = [
      ['id' => 'city-home', 'name' => ucfirst($cSlug) . ' Home', 'url' => $cBase],
      ['id' => 'icons', 'name' => 'Icons', 'url' => $cBase . '/icons'],
      ['id' => 'rising', 'name' => 'Rising', 'url' => $cBase . '/rising'],
      ['id' => 'stories', 'name' => 'Stories', 'url' => $cBase . '/stories'],
      ['id' => 'the-list', 'name' => 'The List', 'url' => $cBase . '/the-list'],
      ['id' => 'magazine', 'name' => 'Magazine', 'url' => $cBase . '/magazine'],
      ['id' => 'featured-brands', 'name' => 'Brands', 'url' => $cBase . '/featured-brands'],
      ['id' => 'about', 'name' => 'About', 'url' => url('/about')],
      ['id' => 'nominate', 'name' => 'Nominate', 'url' => $cBase . '/nominate'],
      ['id' => 'all-cities', 'name' => '← All Cities', 'url' => url('/')],
    ];
  } else {
    // National Main Site Navigation
    $navItems = [
      ['id' => 'home', 'name' => 'Home', 'url' => url('/')],
      ['id' => 'cities', 'name' => 'Cities Network', 'url' => url('/#sec-cities')],
      ['id' => 'bhavnagar', 'name' => 'Bhavnagar (Flagship)', 'url' => url('/bhavnagar')],
      ['id' => 'stories', 'name' => 'National Stories', 'url' => url('/stories')],
      ['id' => 'the-list', 'name' => 'The List', 'url' => url('/bhavnagar/the-list')],
      ['id' => 'magazine', 'name' => 'Magazine', 'url' => url('/bhavnagar/magazine')],
      ['id' => 'featured-brands', 'name' => 'Brands', 'url' => url('/featured-brands')],
      ['id' => 'about', 'name' => 'About', 'url' => url('/about')],
      ['id' => 'nominate', 'name' => 'Nominate', 'url' => url('/nominate')],
    ];
  }
@endphp

<!-- ══ OFFICIAL MAIN MENU BAR (Sticky Subnavigation) ═══════════ -->
<nav class="city-navbar">
  <div class="vogue-container">
    <ul class="city-navbar__list" id="city-nav-list">
      @foreach ($navItems as $item)
        <li class="city-navbar__item {{ $active === $item['id'] ? 'active' : '' }}">
          <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
        </li>
      @endforeach
    </ul>
  </div>
</nav>
