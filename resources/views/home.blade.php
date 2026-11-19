<x-layouts.app title="CITYICONS — India's Premier City Magazine" activeCity="home">

  <!-- ══ 1. HERO BIG BANNER (Dominant Cover Feature) ══════════════ -->
  <x-hero-banner 
    :cover="$coverArticle" 
    primaryBtnUrl="{{ $coverArticle ? url('/article/' . $coverArticle->id) : url('/bhavnagar') }}" 
    secondaryBtnText="Bhavnagar Flagship"
    secondaryBtnUrl="{{ url('/bhavnagar') }}"
    tertiaryBtnText="Nominate an Icon"
    tertiaryBtnUrl="{{ url('/bhavnagar/nominate') }}"
  />

  <!-- ══ 2. CITY NEWS HORIZONTAL CAROUSEL (Dispatch Across India) ══ -->
  <x-city-news-strip :articles="$newsStrip" />

  <!-- ══ 3. SECTION 1: BHAVNAGAR FLAGSHIP EDITION (Lead + 6 Grid) ══ -->
  <x-city-edition-section 
    cityId="bhavnagar" 
    cityName="Bhavnagar" 
    title="Bhavnagar Edition · Flagship Subsite"
    subtitle="Stories of the people, journeys and ideas shaping Bhavnagar. Documented with purpose and responsibility."
    buttonText="Explore Bhavnagar Subsite"
    exploreUrl="{{ url('/bhavnagar') }}"
    :articles="$bhavGrid->prepend($bhavLead)->filter()" 
  />

  <!-- ══ 4. SECTION 2: MUMBAI EDITION (Lead + 6 Grid) ══════════════ -->
  <x-city-edition-section 
    cityId="mumbai" 
    cityName="Mumbai" 
    title="Mumbai Edition · The Metropolis"
    subtitle="From coastal architecture to cultural icons and financial vanguard defining the maximum city."
    buttonText="Explore Mumbai Subsite"
    exploreUrl="{{ url('/mumbai') }}"
    :articles="$mumbaiGrid->prepend($mumbaiLead)->filter()" 
  />

  <!-- ══ 5. SECTION 3: AHMEDABAD CINEMA (Cinematic Visual Journey) ══ -->
  <x-cinema-section 
    cityId="ahmedabad" 
    cityName="Ahmedabad Cinema" 
    exploreUrl="{{ url('/ahmedabad') }}"
    :articles="$ahmdStories->prepend($ahmdBanner)->filter()" 
  />

  <!-- ══ 6. SECTION 4: WEDDINGS & CELEBRATIONS ═════════════════════ -->
  <x-weddings-grid 
    title="Weddings &amp; Living Heritage · India" 
    exploreUrl="{{ url('/bhavnagar/stories') }}"
    :articles="$weddingArticles" 
  />

  <!-- ══ 7. EDITORIAL INTRO STATEMENT ══════════════════════════════ -->
  <x-editorial-intro 
    cityName="India"
    kicker="A CONTINENT IN PEOPLE AND PLACES"
    heading="Selected with purpose. Documented with responsibility."
    body="CityIcons is an independent editorial platform documenting credible people, meaningful journeys and lasting contributions across India's vibrant urban tapestries. We focus on evidence, context, and impact."
  />

  <!-- ══ 8. NOMINATION CTA ═════════════════════════════════════════ -->
  <x-nomination-cta 
    cityName="India" 
    submitUrl="{{ url('/bhavnagar/nominate') }}" 
  />

  <!-- ══ 9. CLOSING STATEMENT ══════════════════════════════════════ -->
  <x-closing-statement cityName="India" />

</x-layouts.app>
