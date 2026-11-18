@props(['active' => 'home'])

@php
  $navItems = [
    ['id' => 'home', 'name' => 'Home', 'url' => url('/')],
    ['id' => 'icons', 'name' => 'Icons', 'url' => url('/icons')],
    ['id' => 'rising', 'name' => 'Rising', 'url' => url('/rising')],
    ['id' => 'voices', 'name' => 'Voices', 'url' => url('/voices')],
    ['id' => 'stories', 'name' => 'Stories', 'url' => url('/stories')],
    ['id' => 'the-list', 'name' => 'The List', 'url' => url('/the-list')],
    ['id' => 'magazine', 'name' => 'Magazine', 'url' => url('/magazine')],
    ['id' => 'in-bhavnagar', 'name' => 'In Bhavnagar', 'url' => url('/in-bhavnagar')],
    ['id' => 'featured-brands', 'name' => 'Featured Brands', 'url' => url('/featured-brands')],
    ['id' => 'about', 'name' => 'About', 'url' => url('/about')],
    ['id' => 'nominate', 'name' => 'Nominate', 'url' => url('/nominate')],
  ];
@endphp

<!-- ══ 2. OFFICIAL MAIN MENU BAR (Sticky Subnavigation) ═══════════ -->
<!-- Exact PDF Spec: Home | Icons | Rising | Voices | Stories | The List | Magazine | In Bhavnagar | Featured Brands | About | Nominate -->
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
