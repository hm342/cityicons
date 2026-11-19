@props([
  'active' => 'home',
  'city' => null
])

@php
  $cSlug = $city ? (is_object($city) ? $city->slug : $city) : null;
  $cName = $city ? (is_object($city) ? $city->name : ucfirst($cSlug)) : null;
  $cBase = $cSlug ? url('/' . $cSlug) : '';

  if ($cSlug) {
    // City-scoped navigation (Matching PDF Page 3)
    $navItems = [
      ['id' => 'city-home', 'name' => 'Home', 'url' => $cBase],
      ['id' => 'icons', 'name' => 'Icons', 'url' => $cBase . '/icons'],
      ['id' => 'rising', 'name' => 'Rising', 'url' => $cBase . '/rising'],
      ['id' => 'stories', 'name' => 'Stories', 'url' => $cBase . '/stories'],
      ['id' => 'the-list', 'name' => 'The List', 'url' => $cBase . '/the-list'],
      ['id' => 'magazine', 'name' => 'Magazine', 'url' => $cBase . '/magazine'],
      ['id' => 'in-city', 'name' => 'In ' . $cName, 'url' => $cBase . '/in-' . $cSlug],
      ['id' => 'featured-brands', 'name' => 'Brands', 'url' => $cBase . '/featured-brands'],
      ['id' => 'about', 'name' => 'About', 'url' => $cBase . '/about'],
      ['id' => 'nominate', 'name' => 'Nominate', 'url' => $cBase . '/nominate'],
    ];
  } else {
    // National Main Site Navigation
    $navItems = [
      ['id' => 'home', 'name' => 'Home', 'url' => url('/')],
      ['id' => 'cities', 'name' => 'Cities Network', 'url' => url('/#drawer-cities-grid')],
      ['id' => 'bhavnagar', 'name' => 'Bhavnagar (Flagship)', 'url' => url('/bhavnagar')],
      ['id' => 'stories', 'name' => 'Stories', 'url' => url('/bhavnagar/stories')],
      ['id' => 'the-list', 'name' => 'The List', 'url' => url('/bhavnagar/the-list')],
      ['id' => 'magazine', 'name' => 'Magazine', 'url' => url('/bhavnagar/magazine')],
      ['id' => 'featured-brands', 'name' => 'Brands', 'url' => url('/bhavnagar/featured-brands')],
      ['id' => 'about', 'name' => 'About', 'url' => url('/about')],
      ['id' => 'nominate', 'name' => 'Nominate a Story', 'url' => url('/bhavnagar/nominate')],
    ];
  }
@endphp

<!-- ══ OFFICIAL MAIN MENU BAR (Sticky Subnavigation) ═══════════ -->
<nav class="city-navbar {{ $cSlug ? 'city-navbar--subcity' : '' }}">
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
