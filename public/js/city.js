// ============================================================
// REAL MOMENTS — CITY EDITORIAL JAVASCRIPT
// Populates all 5 section layouts + Hero from user designs
// ============================================================

document.addEventListener('DOMContentLoaded', () => {
  const D = CITYICON_DATA;

  // ── DETECT CITY ────────────────────────────────────────────
  const path = window.location.pathname;
  let cityId = document.body.dataset.city || path.split('/').pop().replace('.html', '');
  if (!cityId || cityId === 'cities') cityId = 'bhavnagar';

  const city = D.cities.find(c => c.id === cityId);
  if (!city) return;

  function articleUrl(id) {
    return `../article.html?id=${id}`;
  }

  // Gather city articles, append national articles to ensure full rich feeds
  let allArticles = D.articles.filter(a => a.city === cityId);
  const nationalArticles = D.articles.filter(a => !a.city);
  allArticles = allArticles.concat(nationalArticles);

  // Group by categories
  const cultureArticles = allArticles.filter(a => a.category === 'Culture' || a.category === 'Events');
  const foodArticles    = allArticles.filter(a => a.category === 'Food');
  const fashionArticles = allArticles.filter(a => a.category === 'Fashion' || a.category === 'Beauty');
  const streetArticles  = allArticles.filter(a => a.category === 'Street Style' || a.category === 'Places');
  const blogArticles    = allArticles.filter(a => a.category === 'People' || a.category === 'Culture' || a.category === 'Fashion');

  // Fallbacks if arrays are short
  function getSlice(arr, count, fallback) {
    let res = [...arr];
    if (res.length < count) {
      res = res.concat(fallback.filter(f => !res.includes(f)));
    }
    return res.slice(0, count);
  }

  // ── 1. HERO SLIDER (Image 6) ───────────────────────────────
  const heroWrap = document.getElementById('hero-slides-wrap');
  const heroDots = document.getElementById('hero-dots');
  const heroArticles = getSlice(allArticles.filter(a => a.isFeatured), 4, allArticles);

  if (heroWrap && heroArticles.length > 0) {
    heroWrap.innerHTML = heroArticles.map((a, i) => `
      <div class="rm-hero-slide ${i === 0 ? 'active' : ''}" style="background-image: url('${a.image}');" data-index="${i}">
        <div class="rm-hero-overlay"></div>
        <div class="rm-hero-content">
          <span class="cat-italic">${a.category}</span>
          <h1 class="rm-hero-title">
            <a href="${articleUrl(a.id)}">${a.title}</a>
          </h1>
          <button class="btn-pill" onclick="location.href='${articleUrl(a.id)}'">View Post</button>
        </div>
      </div>
    `).join('');

    heroDots.innerHTML = heroArticles.map((_, i) => `
      <span class="rm-hero-dot ${i === 0 ? 'active' : ''}" data-index="${i}"></span>
    `).join('');

    let current = 0;
    const slides = heroWrap.querySelectorAll('.rm-hero-slide');
    const dots = heroDots.querySelectorAll('.rm-hero-dot');

    function showSlide(idx) {
      current = (idx + slides.length) % slides.length;
      slides.forEach((s, i) => s.classList.toggle('active', i === current));
      dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }

    dots.forEach((d, i) => d.addEventListener('click', () => showSlide(i)));

    const prevBtn = document.getElementById('hero-arrow-prev');
    const nextBtn = document.getElementById('hero-arrow-next');
    if (prevBtn) prevBtn.addEventListener('click', () => showSlide(current - 1));
    if (nextBtn) nextBtn.addEventListener('click', () => showSlide(current + 1));

    setInterval(() => showSlide(current + 1), 6000);
  }

  // ── 2. SECTION 1: TILES STYLE 1 (Image 2) ──────────────────
  // 1 Tall Left + 4 Right (2x2 Grid)
  const tiles1Wrap = document.getElementById('tiles-section-1');
  const s1Articles = getSlice(cultureArticles, 5, allArticles);

  if (tiles1Wrap && s1Articles.length >= 5) {
    tiles1Wrap.innerHTML = `
      <!-- Tall Left Tile -->
      <article class="tile-card tile-tall" onclick="location.href='${articleUrl(s1Articles[0].id)}'">
        <img class="tile-card-img" src="${s1Articles[0].image}" alt="${s1Articles[0].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s1Articles[0].category}</span>
          <h2 class="tile-title">${s1Articles[0].title}</h2>
          <button class="btn-pill">View Post</button>
        </div>
      </article>

      <!-- 4 Right Grid Tiles -->
      ${s1Articles.slice(1, 5).map(a => `
        <article class="tile-card" onclick="location.href='${articleUrl(a.id)}'">
          <img class="tile-card-img" src="${a.image}" alt="${a.title}" loading="lazy">
          <div class="tile-card-overlay"></div>
          <div class="tile-card-body">
            <span class="cat-italic">${a.category}</span>
            <h3 class="tile-title" style="font-size:1.05rem;">${a.title}</h3>
          </div>
        </article>
      `).join('')}
    `;
  }

  // ── 3. SECTION 2: TILES STYLE 2 (Image 3) ──────────────────
  // 2 Stacked Left + 1 Tall Center + 2 Stacked Right
  const tiles2Wrap = document.getElementById('tiles-section-2');
  const s2Articles = getSlice(foodArticles, 5, allArticles);

  if (tiles2Wrap && s2Articles.length >= 5) {
    tiles2Wrap.innerHTML = `
      <!-- Left Stack 1 -->
      <article class="tile-card" onclick="location.href='${articleUrl(s2Articles[0].id)}'">
        <img class="tile-card-img" src="${s2Articles[0].image}" alt="${s2Articles[0].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s2Articles[0].category}</span>
          <h3 class="tile-title" style="font-size:1.05rem;">${s2Articles[0].title}</h3>
        </div>
      </article>

      <!-- Center Tall Tile -->
      <article class="tile-card tile-tall" onclick="location.href='${articleUrl(s2Articles[1].id)}'">
        <img class="tile-card-img" src="${s2Articles[1].image}" alt="${s2Articles[1].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s2Articles[1].category}</span>
          <h2 class="tile-title">${s2Articles[1].title}</h2>
          <button class="btn-pill">View Post</button>
        </div>
      </article>

      <!-- Right Stack 1 -->
      <article class="tile-card" onclick="location.href='${articleUrl(s2Articles[2].id)}'">
        <img class="tile-card-img" src="${s2Articles[2].image}" alt="${s2Articles[2].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s2Articles[2].category}</span>
          <h3 class="tile-title" style="font-size:1.05rem;">${s2Articles[2].title}</h3>
        </div>
      </article>

      <!-- Left Stack 2 -->
      <article class="tile-card" onclick="location.href='${articleUrl(s2Articles[3].id)}'">
        <img class="tile-card-img" src="${s2Articles[3].image}" alt="${s2Articles[3].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s2Articles[3].category}</span>
          <h3 class="tile-title" style="font-size:1.05rem;">${s2Articles[3].title}</h3>
        </div>
      </article>

      <!-- Right Stack 2 -->
      <article class="tile-card" onclick="location.href='${articleUrl(s2Articles[4].id)}'">
        <img class="tile-card-img" src="${s2Articles[4].image}" alt="${s2Articles[4].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s2Articles[4].category}</span>
          <h3 class="tile-title" style="font-size:1.05rem;">${s2Articles[4].title}</h3>
        </div>
      </article>
    `;
  }

  // ── 4. SECTION 3: TILES STYLE 3 (Image 5) ──────────────────
  // 2 Asymmetric Top (60/40) + 3 Equal Bottom
  const tiles3Top = document.getElementById('tiles-section-3-top');
  const tiles3Bottom = document.getElementById('tiles-section-3-bottom');
  const s3Articles = getSlice(fashionArticles, 5, allArticles);

  if (tiles3Top && tiles3Bottom && s3Articles.length >= 5) {
    tiles3Top.innerHTML = `
      <article class="tile-card" onclick="location.href='${articleUrl(s3Articles[0].id)}'">
        <img class="tile-card-img" src="${s3Articles[0].image}" alt="${s3Articles[0].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s3Articles[0].category}</span>
          <h2 class="tile-title" style="font-size:1.6rem;">${s3Articles[0].title}</h2>
        </div>
      </article>
      <article class="tile-card" onclick="location.href='${articleUrl(s3Articles[1].id)}'">
        <img class="tile-card-img" src="${s3Articles[1].image}" alt="${s3Articles[1].title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${s3Articles[1].category}</span>
          <h3 class="tile-title" style="font-size:1.25rem;">${s3Articles[1].title}</h3>
        </div>
      </article>
    `;

    tiles3Bottom.innerHTML = s3Articles.slice(2, 5).map(a => `
      <article class="tile-card" onclick="location.href='${articleUrl(a.id)}'">
        <img class="tile-card-img" src="${a.image}" alt="${a.title}" loading="lazy">
        <div class="tile-card-overlay"></div>
        <div class="tile-card-body">
          <span class="cat-italic">${a.category}</span>
          <h3 class="tile-title" style="font-size:1.05rem;">${a.title}</h3>
        </div>
      </article>
    `).join('');
  }

  // ── 5. SECTION 4: GRID STYLE (Image 4) ─────────────────────
  // 3 Columns x 2 Rows with Inline Share Footer
  const grid4Wrap = document.getElementById('grid-section-4');
  const s4Articles = getSlice(streetArticles, 6, allArticles);

  if (grid4Wrap && s4Articles.length >= 6) {
    grid4Wrap.innerHTML = s4Articles.map(a => `
      <article class="rm-grid-card" onclick="location.href='${articleUrl(a.id)}'">
        <img class="rm-grid-card-img" src="${a.image}" alt="${a.title}" loading="lazy">
        <div class="rm-grid-card-overlay"></div>
        <div class="rm-grid-card-body">
          <span class="cat-italic">${a.category}</span>
          <h3 class="rm-grid-card-title">${a.title}</h3>
          <div class="post-share-inline" onclick="event.stopPropagation()">
            <span class="share-txt">Share &rarr;</span>
            <a href="https://facebook.com" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank" aria-label="X"><i class="fab fa-x-twitter"></i></a>
            <a href="https://pinterest.com" target="_blank" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
          </div>
        </div>
      </article>
    `).join('');
  }

  // ── 6. SECTION 5: BLOG STREAM (Image 1) ────────────────────
  // Horizontal 50/50 Split Cards with Video Badge & Diamond Bullet
  const blogStream = document.getElementById('blog-stream');
  const s5Articles = getSlice(blogArticles, 4, allArticles);

  if (blogStream && s5Articles.length > 0) {
    blogStream.innerHTML = s5Articles.map((a, i) => `
      <article class="rm-blog-card">
        <!-- Media Side with video icon -->
        <div class="rm-blog-media" onclick="location.href='${articleUrl(a.id)}'" style="cursor:pointer;">
          <div class="rm-media-badge"><i class="fas fa-video"></i></div>
          <img src="${a.image}" alt="${a.title}" loading="lazy">
        </div>

        <!-- Content Side -->
        <div class="rm-blog-content">
          <span class="cat-italic">${a.category}</span>
          <h2 class="rm-blog-title">
            <a href="${articleUrl(a.id)}">${a.title}</a>
          </h2>
          <div class="rm-blog-excerpt">
            <span class="bullet">&#10022;</span>
            <span>${a.excerpt}</span>
          </div>
          <div>
            <button class="btn-pill" onclick="location.href='${articleUrl(a.id)}'">View Post</button>
          </div>
          <div class="post-share-inline">
            <span class="share-txt">Share &rarr;</span>
            <a href="https://facebook.com" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank" aria-label="X"><i class="fab fa-x-twitter"></i></a>
            <a href="https://pinterest.com" target="_blank" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
          </div>
        </div>
      </article>
    `).join('');
  }

  // ── 7. OFFCANVAS DRAWER ────────────────────────────────────
  const offcanvas = document.getElementById('offcanvas-drawer');
  const overlay = document.getElementById('site-overlay');
  const btnOpenMenu = document.getElementById('btn-open-menu');
  const btnCloseOffcanvas = document.getElementById('btn-close-offcanvas');
  const btnCitiesDrawer = document.getElementById('btn-cities-drawer');

  function openDrawer() {
    if (offcanvas) offcanvas.classList.add('open');
    if (overlay) overlay.classList.add('open');
  }

  function closeDrawer() {
    if (offcanvas) offcanvas.classList.remove('open');
    if (overlay) overlay.classList.remove('open');
  }

  if (btnOpenMenu) btnOpenMenu.addEventListener('click', openDrawer);
  if (btnCitiesDrawer) btnCitiesDrawer.addEventListener('click', (e) => { e.preventDefault(); openDrawer(); });
  if (btnCloseOffcanvas) btnCloseOffcanvas.addEventListener('click', closeDrawer);
  if (overlay) overlay.addEventListener('click', closeDrawer);

  // ── 8. SEARCH MODAL ────────────────────────────────────────
  const searchModal = document.getElementById('search-modal');
  const btnOpenSearch = document.getElementById('btn-open-search');
  const btnCloseSearch = document.getElementById('btn-close-search');
  const searchInput = document.getElementById('search-input');
  const searchResults = document.getElementById('search-results');

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
      const matches = allArticles.filter(a =>
        a.title.toLowerCase().includes(q) ||
        a.category.toLowerCase().includes(q) ||
        (a.excerpt && a.excerpt.toLowerCase().includes(q))
      );

      if (matches.length === 0) {
        searchResults.innerHTML = '<p style="color:#888;text-align:center;padding:1.5rem;">No stories found.</p>';
        return;
      }

      searchResults.innerHTML = matches.map(a => `
        <div onclick="location.href='${articleUrl(a.id)}'" style="display:flex;gap:1.25rem;align-items:center;padding:1rem 0;border-bottom:1px solid rgba(255,255,255,0.1);cursor:pointer;">
          <img src="${a.image}" alt="" style="width:75px;height:55px;object-fit:cover;flex-shrink:0;">
          <div>
            <div style="font-family:'Cormorant Garamond',serif;font-style:italic;font-size:0.95rem;color:#aaa;margin-bottom:0.25rem;">${a.category}</div>
            <div style="font-size:1.15rem;font-weight:700;color:#fff;">${a.title}</div>
          </div>
        </div>
      `).join('');
    });
  }
});
