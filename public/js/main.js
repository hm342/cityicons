// ============================================================
// CITYICON — MAIN HOMEPAGE JAVASCRIPT
// Binds data to the exact user homepage architecture
// ============================================================

document.addEventListener('DOMContentLoaded', () => {
  const D = CITYICON_DATA;

  function articleUrl(id) {
    return `/article?id=${id}`;
  }

  function cityUrl(cId) {
    return `/cities/${cId}`;
  }

  function formatDate(dStr) {
    const d = new Date(dStr);
    return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
  }

  function getSlice(arr, count, fallback) {
    let res = [...arr];
    if (res.length < count) {
      res = res.concat(fallback.filter(f => !res.includes(f)));
    }
    return res.slice(0, count);
  }

  // ── 1. BIG BANNER HERO (बड़ा बैनर) ─────────────────────────
  const heroBanner = document.getElementById('hero-banner');
  const coverArticle = D.articles.find(a => a.isCover) || D.articles[0];

  if (heroBanner && coverArticle) {
    heroBanner.innerHTML = `
      <div class="hero-big-banner__img-wrap" onclick="location.href='${articleUrl(coverArticle.id)}'">
        <img src="${coverArticle.image}" alt="${coverArticle.title}">
        <!-- Top gradient for contrast -->
        <div class="hero-big-banner__top-shade"></div>
        <!-- Right side top CITYICONS name inside the image -->
        <div class="hero-big-banner__brand-stamp">CITYICONS</div>
        <!-- Bottom gradient shade for text readability -->
        <div class="hero-big-banner__bottom-shade"></div>

        <!-- Main description INSIDE the image at the bottom -->
        <div class="hero-big-banner__content-overlay">
          <div class="hero-big-banner__content-box">
            <h1 class="hero-big-banner__hed">${coverArticle.title}</h1>
          </div>
        </div>
      </div>

      <!-- Others things OUT of the image (underneath the image) -->
      <div class="hero-big-banner__details" onclick="location.href='${articleUrl(coverArticle.id)}'">
        <span class="vogue-rubric vogue-rubric--red">${coverArticle.category} · Cover Feature</span>
        <p class="hero-big-banner__dek">${coverArticle.excerpt}</p>
        <div class="vogue-byline">
          <span>By ${coverArticle.author}</span>
          <span class="dot"></span>
          <span>${formatDate(coverArticle.date)}</span>
          <span class="dot"></span>
          <span>${coverArticle.readTime || '8 min read'}</span>
        </div>
      </div>
    `;
  }

  // ── 2. CITY NEWS HORIZONTAL CAROUSEL (क्रॉसेल बार) ────────
  const cityNewsTrack = document.getElementById('city-news-track');
  if (cityNewsTrack) {
    // Gather 1 story from each city for the continuous city dispatch
    const cityDispatches = [];
    D.cities.forEach(city => {
      const art = D.articles.find(a => a.city === city.id);
      if (art) {
        cityDispatches.push({ ...art, cityName: city.name });
      }
    });

    cityNewsTrack.innerHTML = cityDispatches.map(a => `
      <div class="city-news-mini-card" onclick="location.href='${articleUrl(a.id)}'">
        <div class="city-news-mini-card__img">
          <img src="${a.image}" alt="${a.title}" loading="lazy">
        </div>
        <span class="city-news-mini-card__city">${a.cityName}</span>
        <h3 class="city-news-mini-card__hed">${a.title}</h3>
      </div>
    `).join('');

    const btnStripPrev = document.getElementById('btn-strip-prev');
    const btnStripNext = document.getElementById('btn-strip-next');
    if (btnStripPrev) btnStripPrev.addEventListener('click', () => cityNewsTrack.scrollBy({ left: -320, behavior: 'smooth' }));
    if (btnStripNext) btnStripNext.addEventListener('click', () => cityNewsTrack.scrollBy({ left: 320, behavior: 'smooth' }));
  }

  // ── 3. CITY SECTION 1: BHAVNAGAR ───────────────────────────
  // Sticky Lead Story (Left) + 6-Story Grid (Right: 2 cols x 3 rows)
  const bhavLead = document.getElementById('bhavnagar-lead');
  const bhavGrid = document.getElementById('bhavnagar-grid-6');
  const bhavArticles = getSlice(D.articles.filter(a => a.city === 'bhavnagar'), 7, D.articles);

  if (bhavLead && bhavGrid && bhavArticles.length >= 1) {
    const mainBhav = bhavArticles[0];
    const sideBhav = bhavArticles.slice(1, 7); // Exactly 6 stories on the right side

    bhavLead.innerHTML = `
      <div class="vogue-sticky-lead__card" onclick="location.href='${articleUrl(mainBhav.id)}'">
        <img class="vogue-sticky-lead__img" src="${mainBhav.image}" alt="${mainBhav.title}" loading="lazy">
        <div class="vogue-sticky-lead__overlay"></div>
        <div class="vogue-sticky-lead__content">
          <span class="vogue-sticky-lead__rubric">${mainBhav.category} · Bhavnagar</span>
          <h2 class="vogue-sticky-lead__hed">${mainBhav.title}</h2>
          <div class="vogue-sticky-lead__byline">BY ${mainBhav.author.toUpperCase()}</div>
        </div>
      </div>
    `;

    bhavGrid.innerHTML = sideBhav.map(a => `
      <article class="vogue-sub-card" onclick="location.href='${articleUrl(a.id)}'">
        <div class="vogue-sub-card__media">
          <img src="${a.image}" alt="${a.title}" loading="lazy">
        </div>
        <span class="vogue-sub-card__rubric">${a.category}</span>
        <h3 class="vogue-sub-card__hed">${a.title}</h3>
        <div class="vogue-sub-card__byline">
          <span>BY ${a.author.toUpperCase()}</span>
          <span class="vogue-sub-card__date">${formatDate(a.date)}</span>
        </div>
      </article>
    `).join('');
  }

  // ── 4. CITY SECTION 2: MUMBAI ──────────────────────────────
  // Sticky Lead Story (Left) + 6-Story Grid (Right: 2 cols x 3 rows)
  const mumbaiLead = document.getElementById('mumbai-lead');
  const mumbaiGrid = document.getElementById('mumbai-grid-6');
  const mumbaiArticles = getSlice(D.articles.filter(a => a.city === 'mumbai'), 7, D.articles);

  if (mumbaiLead && mumbaiGrid && mumbaiArticles.length >= 1) {
    const mainMum = mumbaiArticles[0];
    const sideMum = mumbaiArticles.slice(1, 7); // Exactly 6 stories on the right side

    mumbaiLead.innerHTML = `
      <div class="vogue-sticky-lead__card" onclick="location.href='${articleUrl(mainMum.id)}'">
        <img class="vogue-sticky-lead__img" src="${mainMum.image}" alt="${mainMum.title}" loading="lazy">
        <div class="vogue-sticky-lead__overlay"></div>
        <div class="vogue-sticky-lead__content">
          <span class="vogue-sticky-lead__rubric">${mainMum.category} · Mumbai</span>
          <h2 class="vogue-sticky-lead__hed">${mainMum.title}</h2>
          <div class="vogue-sticky-lead__byline">BY ${mainMum.author.toUpperCase()}</div>
        </div>
      </div>
    `;

    mumbaiGrid.innerHTML = sideMum.map(a => `
      <article class="vogue-sub-card" onclick="location.href='${articleUrl(a.id)}'">
        <div class="vogue-sub-card__media">
          <img src="${a.image}" alt="${a.title}" loading="lazy">
        </div>
        <span class="vogue-sub-card__rubric">${a.category}</span>
        <h3 class="vogue-sub-card__hed">${a.title}</h3>
        <div class="vogue-sub-card__byline">
          <span>BY ${a.author.toUpperCase()}</span>
          <span class="vogue-sub-card__date">${formatDate(a.date)}</span>
        </div>
      </article>
    `).join('');
  }

  // ── 5. CITY SECTION 3: AHMEDABAD (Cinematic Banner + Carousel Below) ──
  const ahmdBanner = document.getElementById('ahmedabad-cinema-banner');
  const ahmdTrack = document.getElementById('ahmedabad-cinema-track');
  const ahmdArticles = getSlice(D.articles.filter(a => a.city === 'ahmedabad'), 6, D.articles);

  if (ahmdBanner && ahmdTrack && ahmdArticles.length >= 2) {
    const cinemaMain = ahmdArticles[0];
    const cinemaOthers = ahmdArticles.slice(1);

    ahmdBanner.innerHTML = `
      <img src="${cinemaMain.image}" alt="${cinemaMain.title}" onclick="location.href='${articleUrl(cinemaMain.id)}'">
      <div class="city-cinema-overlay"></div>
      <div class="city-cinema-content" onclick="location.href='${articleUrl(cinemaMain.id)}'">
        <span class="vogue-rubric">${cinemaMain.category} · Ahmedabad Showcase</span>
        <h2 class="city-cinema-hed">${cinemaMain.title}</h2>
        <p class="city-cinema-dek">${cinemaMain.excerpt}</p>
        <div class="vogue-byline" style="color:rgba(255,255,255,0.8); margin-top:10px;">
          <span>By ${cinemaMain.author}</span>
          <span class="dot"></span>
          <span>${formatDate(cinemaMain.date)}</span>
        </div>
      </div>
    `;

    ahmdTrack.innerHTML = cinemaOthers.map(a => `
      <article class="city-cinema-card" onclick="location.href='${articleUrl(a.id)}'">
        <div class="city-cinema-card__media">
          <img src="${a.image}" alt="${a.title}" loading="lazy">
        </div>
        <span class="vogue-rubric" style="font-size:0.625rem;">${a.category}</span>
        <h3 class="city-cinema-card__hed">${a.title}</h3>
        <div class="vogue-byline">
          <span>By ${a.author}</span>
        </div>
      </article>
    `).join('');

    const btnAhmdPrev = document.getElementById('btn-ahmd-prev');
    const btnAhmdNext = document.getElementById('btn-ahmd-next');
    if (btnAhmdPrev) btnAhmdPrev.addEventListener('click', () => ahmdTrack.scrollBy({ left: -320, behavior: 'smooth' }));
    if (btnAhmdNext) btnAhmdNext.addEventListener('click', () => ahmdTrack.scrollBy({ left: 320, behavior: 'smooth' }));
  }

  // ── 6. LAST SECTION: WEDDINGS & CELEBRATIONS (4-Column Collection Grid) ──
  const weddingsGrid = document.getElementById('weddings-4col-grid') || document.getElementById('jaipur-4col-grid');
  const weddingArticles = D.articles.filter(a => a.id >= 1101 && a.id <= 1104);
  const display4 = weddingArticles.length === 4 
    ? weddingArticles 
    : getSlice(D.articles.filter(a => a.category.toLowerCase() === 'weddings'), 4, D.articles);

  if (weddingsGrid && display4.length >= 4) {
    weddingsGrid.innerHTML = display4.map(a => `
      <article class="vogue-4col-card" onclick="location.href='${articleUrl(a.id)}'">
        <div class="vogue-4col-card__media">
          <img src="${a.image}" alt="${a.title}" loading="lazy">
          ${a.hasGallery ? `
            <span class="vogue-card-badge-gallery" aria-label="Gallery">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="13" height="13" rx="2" ry="2"></rect>
                <path d="M8 21h13V8"></path>
              </svg>
            </span>
          ` : ''}
        </div>
        <span class="vogue-4col-card__rubric">${a.category}</span>
        <h3 class="vogue-4col-card__hed">${a.title}</h3>
        <div class="vogue-4col-card__byline">
          <span class="vogue-4col-card__author">BY ${a.author.toUpperCase()}</span>
          <span class="vogue-4col-card__date">${formatDate(a.date)}</span>
        </div>
      </article>
    `).join('');
  }

  // ── 7. FOOTER & DRAWER CITY LINKS ──────────────────────────
  const footerCities = document.getElementById('footer-cities-list');
  const drawerCities = document.getElementById('drawer-cities-grid');

  if (footerCities) {
    footerCities.innerHTML = D.cities.map(c => `
      <a href="${cityUrl(c.id)}">${c.name}</a>
    `).join(' · ');
  }

  if (drawerCities) {
    drawerCities.innerHTML = D.cities.map(c => `
      <a href="${cityUrl(c.id)}" class="vogue-drawer__city-chip">${c.name}</a>
    `).join('');
  }

  // ── 8. OFFCANVAS DRAWER & SEARCH MODAL ─────────────────────
  const drawer = document.getElementById('vogue-drawer');
  const overlay = document.getElementById('vogue-overlay');
  const btnOpenDrawer = document.getElementById('btn-open-drawer');
  const btnCloseDrawer = document.getElementById('btn-close-drawer');

  function openDrawer() {
    if (drawer) drawer.classList.add('open');
    if (overlay) overlay.classList.add('open');
  }

  function closeDrawer() {
    if (drawer) drawer.classList.remove('open');
    if (overlay) overlay.classList.remove('open');
  }

  if (btnOpenDrawer) btnOpenDrawer.addEventListener('click', openDrawer);
  if (btnCloseDrawer) btnCloseDrawer.addEventListener('click', closeDrawer);
  if (overlay) overlay.addEventListener('click', closeDrawer);

  // Search Modal
  const searchModal = document.getElementById('vogue-search-modal');
  const btnOpenSearch = document.getElementById('btn-open-search');
  const btnCloseSearch = document.getElementById('btn-close-search');
  const searchInput = document.getElementById('vogue-search-input');
  const searchResults = document.getElementById('vogue-search-results');

  if (btnOpenSearch && searchModal) {
    btnOpenSearch.addEventListener('click', () => {
      searchModal.classList.add('open');
      setTimeout(() => searchInput && searchInput.focus(), 150);
    });
  }

  if (btnCloseSearch && searchModal) {
    btnCloseSearch.addEventListener('click', () => {
      searchModal.classList.remove('open');
    });
  }

  if (searchModal) {
    searchModal.addEventListener('click', (e) => {
      if (e.target === searchModal) searchModal.classList.remove('open');
    });
  }

  if (searchInput && searchResults) {
    searchInput.addEventListener('input', () => {
      const q = searchInput.value.toLowerCase().trim();
      if (q.length < 2) {
        searchResults.innerHTML = '';
        return;
      }
      const matches = D.articles.filter(a =>
        a.title.toLowerCase().includes(q) ||
        a.category.toLowerCase().includes(q) ||
        (a.city && a.city.toLowerCase().includes(q)) ||
        (a.excerpt && a.excerpt.toLowerCase().includes(q))
      );

      if (matches.length === 0) {
        searchResults.innerHTML = '<p style="color:#777;text-align:center;padding:1.5rem;font-family:\'Plus Jakarta Sans\',sans-serif;">No stories found.</p>';
        return;
      }

      searchResults.innerHTML = matches.map(a => `
        <div onclick="location.href='${articleUrl(a.id)}'" style="display:flex;gap:1.25rem;align-items:center;padding:1rem 0;border-bottom:1px solid #e2e2e2;cursor:pointer;">
          <img src="${a.image}" alt="" style="width:75px;height:55px;object-fit:cover;flex-shrink:0;">
          <div>
            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:0.65rem;letter-spacing:2px;text-transform:uppercase;color:#e51a24;margin-bottom:0.25rem;">${a.category}${a.city ? ' · ' + a.city.toUpperCase() : ''}</div>
            <div style="font-family:'Bodoni Moda',serif;font-size:1.15rem;color:#000;">${a.title}</div>
          </div>
        </div>
      `).join('');
    });
  }
});
