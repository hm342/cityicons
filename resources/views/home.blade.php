<x-layouts.app title="Bhavnagar Icons — Selected with purpose. Documented with responsibility.">

  <!-- ══ 1. HERO (Bhavnagar, Documented) ════════════════════════ -->
  <x-hero-banner :cover="$coverArticle" :settings="$settings" />

  <!-- ══ 2. EDITORIAL MANIFESTO (A city is shaped by its people) ══ -->
  <x-editorial-intro />

  <!-- ══ 3. CITY NEWS CAROUSEL / LATEST DISPATCH TICKER ══════════ -->
  <x-city-news-strip :articles="$newsStrip" />

  <!-- ══ 4. FEATURED ICONS (People shaping Bhavnagar and beyond) ══ -->
  <x-city-edition-section city-id="bhavnagar" city-name="Featured Icons" :people="$icons" explore-url="{{ url('/icons') }}" />

  <!-- ══ 5. RISING (The names building what comes next) ═════════ -->
  <x-city-edition-section city-id="mumbai" city-name="Rising Stars" :people="$rising" explore-url="{{ url('/rising') }}" />

  <!-- ══ 6. IN BHAVNAGAR (The city, as it happens — Events & Moments) ══ -->
  <x-cinema-section city-id="bhavnagar" city-name="In Bhavnagar" :articles="$inBhavnagar" explore-url="{{ url('/in-bhavnagar') }}" />

  <!-- ══ 7. VOICES (Conversations worth preserving) ════════════ -->
  <x-weddings-grid title="Voices: Conversations Worth Preserving" :people="$voices" explore-url="{{ url('/voices') }}" />

  <!-- ══ 8. FEATURED BRANDS (Clearly disclosed collaborations) ══ -->
  <x-featured-brands-section :brands="$featuredBrands" />

  <!-- ══ 9. NOMINATION (Know a story worth documenting?) ═══════ -->
  <x-nomination-cta />

  <!-- ══ 10. CLOSING (Not every story needs attention. Some deserve permanence) ══ -->
  <x-closing-statement />

</x-layouts.app>
