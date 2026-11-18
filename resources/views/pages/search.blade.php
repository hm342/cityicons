<x-layouts.app title="Search CityIcons — People, stories, categories or subjects">

  <section class="city-edition-section" style="padding-top:40px; margin-bottom:var(--section-gap);">
    <div class="vogue-container">
      
      <!-- Section Header -->
      <div style="border-bottom:2px solid var(--vogue-black); padding-bottom:16px; margin-bottom:36px;">
        <span class="vogue-rubric vogue-rubric--red">ARCHIVE DISCOVERY</span>
        <h1 style="font-family:var(--font-didot); font-size:clamp(2.4rem, 4.5vw, 4rem); font-weight:400; line-height:1.1; margin:8px 0 12px;">
          Search CityIcons
        </h1>
        <p style="font-family:var(--font-didot); font-size:clamp(1.2rem, 1.8vw, 1.5rem); color:var(--vogue-black); line-height:1.3;">
          Search people, stories, categories or subjects.
        </p>
      </div>

      <!-- Search Box (Page 34) -->
      <div style="max-width:750px; margin-bottom:48px;">
        <div style="display:flex; border-bottom:2px solid var(--vogue-black); padding-bottom:8px;">
          <input type="text" id="page-search-input" placeholder="Search CityIcons" autofocus style="width:100%; border:none; font-family:var(--font-didot); font-size:1.8rem; outline:none; background:transparent;">
          <button style="border:none; background:none; font-size:1.4rem; cursor:pointer; color:var(--vogue-black);"><i class="fas fa-search"></i></button>
        </div>
      </div>

      <!-- Search Results Container -->
      <div id="search-page-results">
        <!-- Results or No Results Message: "No matching stories were found. Try another name, subject or category." -->
        <div class="vogue-4col-grid" id="weddings-4col-grid">
          <!-- Populated by main.js -->
        </div>
      </div>

    </div>
  </section>

</x-layouts.app>
