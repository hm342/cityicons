<x-layouts.app title="Stories — People, journeys and ideas from Bhavnagar">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:30px;">
        <span class="vogue-rubric vogue-rubric--red">LONG-FORM PROFILES &amp; FEATURES</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Stories
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.25rem, 2vw, 1.6rem); color:var(--vogue-black); line-height:1.3; margin-bottom:8px;">
          People, journeys and ideas from Bhavnagar.
        </p>
        <p style="font-family:var(--font-garamond); font-size:1.15rem; color:#444; max-width:850px; line-height:1.6;">
          Explore long-form profiles, interviews, city stories and editorial features documenting meaningful work and defining moments.
        </p>
      </div>

      <!-- Search & Filters (Page 10) -->
      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; padding:18px 0; border-bottom:1px solid var(--vogue-border); margin-bottom:36px;">
        <!-- Filters -->
        <div style="display:flex; flex-wrap:wrap; gap:12px; font-size:0.75rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
          <a href="#all" style="color:var(--vogue-red);">All Stories</a> ·
          <a href="#icons">Icons</a> ·
          <a href="#rising">Rising</a> ·
          <a href="#voices">Voices</a> ·
          <a href="#in-bhavnagar">In Bhavnagar</a> ·
          <a href="#featured-brands">Featured Brands</a>
        </div>

        <!-- Search Input -->
        <div style="width:100%; max-width:320px;">
          <input type="text" id="stories-search" placeholder="Search people, stories or subjects" style="width:100%; padding:10px 14px; border:1px solid var(--vogue-border); font-family:inherit; font-size:0.85rem;">
        </div>
      </div>

      <!-- Feed Grid -->
      <div class="vogue-4col-grid" id="weddings-4col-grid">
        <!-- Populated by main.js -->
      </div>

    </div>
  </section>

</x-layouts.app>
