/* ==========================================================================
   CITYICONS — Main Website JavaScript & Seamless AJAX Filter Engine
   High-performance, zero-bloat vanilla JS for drawer, search & AJAX filtering.
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {

  // ── 1. TOP PROGRESS BAR ─────────────────────────────────────────
  const progressBar = document.getElementById('site-progress-bar');
  let progressTimer = null;
  let currentAbortController = null;

  function startProgress() {
    if (!progressBar) return;
    clearTimeout(progressTimer);
    progressBar.style.opacity = '1';
    progressBar.style.width = '30%';
    progressTimer = setTimeout(() => {
      progressBar.style.width = '75%';
    }, 150);
  }

  function finishProgress() {
    if (!progressBar) return;
    clearTimeout(progressTimer);
    progressBar.style.width = '100%';
    setTimeout(() => {
      progressBar.style.opacity = '0';
      setTimeout(() => {
        progressBar.style.width = '0%';
      }, 200);
    }, 200);
  }

  // ── 2. OFFCANVAS SLIDEOUT DRAWER ────────────────────────────────
  const drawer = document.getElementById('vogue-drawer');
  const overlay = document.getElementById('vogue-overlay');
  const btnOpenDrawer = document.getElementById('btn-open-drawer');
  const btnCloseDrawer = document.getElementById('btn-close-drawer');

  function openDrawer() {
    if (drawer) drawer.classList.add('open');
    if (overlay) overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeDrawer() {
    if (drawer) drawer.classList.remove('open');
    if (overlay) overlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  if (btnOpenDrawer) btnOpenDrawer.addEventListener('click', openDrawer);
  if (btnCloseDrawer) btnCloseDrawer.addEventListener('click', closeDrawer);
  if (overlay) overlay.addEventListener('click', closeDrawer);

  // Close drawer on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeDrawer();
      closeSearch();
    }
  });

  // ── 3. SEARCH MODAL & LIVE DATABASE SEARCH ──────────────────────
  const searchModal = document.getElementById('vogue-search-modal');
  const btnOpenSearch = document.getElementById('btn-open-search');
  const btnCloseSearch = document.getElementById('btn-close-search');
  const searchInput = document.getElementById('vogue-search-input');
  const searchResults = document.getElementById('vogue-search-results');
  let searchDebounceTimer = null;

  function openSearch() {
    if (searchModal) {
      searchModal.classList.add('open');
      setTimeout(() => searchInput && searchInput.focus(), 150);
    }
  }

  function closeSearch() {
    if (searchModal) searchModal.classList.remove('open');
  }

  if (btnOpenSearch) btnOpenSearch.addEventListener('click', openSearch);
  if (btnCloseSearch) btnCloseSearch.addEventListener('click', closeSearch);
  if (searchModal) {
    searchModal.addEventListener('click', (e) => {
      if (e.target === searchModal) closeSearch();
    });
  }

  if (searchInput && searchResults) {
    searchInput.addEventListener('input', () => {
      clearTimeout(searchDebounceTimer);
      const q = searchInput.value.trim();

      if (q.length < 2) {
        searchResults.innerHTML = '';
        return;
      }

      searchResults.innerHTML = '<div style="text-align:center;padding:1.5rem;color:#888;font-size:0.85rem;"><i class="fas fa-spinner fa-spin"></i> Searching editorial archive...</div>';

      searchDebounceTimer = setTimeout(async () => {
        try {
          const res = await fetch(`/search?q=${encodeURIComponent(q)}&json=1`, {
            headers: { 'Accept': 'application/json' }
          });
          if (!res.ok) throw new Error('Search failed');
          const data = await res.json();

          const allMatches = [];

          if (data.articles && data.articles.length > 0) {
            data.articles.forEach(a => {
              allMatches.push(`
                <div onclick="location.href='${a.url}'" style="display:flex;gap:1.25rem;align-items:center;padding:1rem 0;border-bottom:1px solid #e2e2e2;cursor:pointer;">
                  <img src="${a.image || 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=200&q=80'}" alt="" style="width:75px;height:55px;object-fit:cover;flex-shrink:0;border-radius:2px;">
                  <div>
                    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:0.65rem;letter-spacing:2px;text-transform:uppercase;color:#e51a24;margin-bottom:0.25rem;">
                      ${a.category}${a.city ? ' · ' + a.city.toUpperCase() : ''}
                    </div>
                    <div style="font-family:'Bodoni Moda',serif;font-size:1.1rem;color:#000;line-height:1.2;">
                      ${a.title}
                    </div>
                  </div>
                </div>
              `);
            });
          }

          if (data.people && data.people.length > 0) {
            data.people.forEach(p => {
              allMatches.push(`
                <div onclick="location.href='${p.url}'" style="display:flex;gap:1.25rem;align-items:center;padding:1rem 0;border-bottom:1px solid #e2e2e2;cursor:pointer;">
                  <img src="${p.image || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&q=80'}" alt="" style="width:75px;height:55px;object-fit:cover;flex-shrink:0;border-radius:2px;">
                  <div>
                    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:0.65rem;letter-spacing:2px;text-transform:uppercase;color:#555;margin-bottom:0.25rem;">
                      ${p.category} · DOCUMENTED PERSON
                    </div>
                    <div style="font-family:'Bodoni Moda',serif;font-size:1.1rem;color:#000;line-height:1.2;">
                      ${p.name}
                    </div>
                    <div style="font-size:0.75rem;color:#777;margin-top:2px;">${p.profession || ''}</div>
                  </div>
                </div>
              `);
            });
          }

          if (allMatches.length === 0) {
            searchResults.innerHTML = `<p style="color:#777;text-align:center;padding:1.5rem;font-family:'Plus Jakarta Sans',sans-serif;font-size:0.85rem;">No stories or people found matching "${q}".</p>`;
          } else {
            searchResults.innerHTML = allMatches.join('') + `
              <div style="text-align:center;padding:1rem 0;">
                <a href="/search?q=${encodeURIComponent(q)}" style="font-family:'Plus Jakarta Sans',sans-serif;font-size:0.75rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#e51a24;text-decoration:none;">
                  View All Archive Results →
                </a>
              </div>
            `;
          }
        } catch (err) {
          searchResults.innerHTML = '<p style="color:#777;text-align:center;padding:1.5rem;font-size:0.85rem;">Press Enter to search.</p>';
        }
      }, 250);
    });

    searchInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        const q = searchInput.value.trim();
        if (q) window.location.href = `/search?q=${encodeURIComponent(q)}`;
      }
    });
  }

  // ── 4. CITY NEWS TICKER CAROUSEL ────────────────────────────────
  const cityNewsTrack = document.getElementById('city-news-track');
  const btnStripPrev = document.getElementById('btn-strip-prev');
  const btnStripNext = document.getElementById('btn-strip-next');

  if (cityNewsTrack) {
    if (btnStripPrev) {
      btnStripPrev.addEventListener('click', () => {
        cityNewsTrack.scrollBy({ left: -320, behavior: 'smooth' });
      });
    }
    if (btnStripNext) {
      btnStripNext.addEventListener('click', () => {
        cityNewsTrack.scrollBy({ left: 320, behavior: 'smooth' });
      });
    }
  }

  // ── 5. SEAMLESS AJAX FILTER & PAGINATION ENGINE ──────────────────
  // Loads filtered content smoothly without reloading header, city navbar, or footer
  async function loadFrontendContent(url, pushState = true) {
    if (currentAbortController) {
      currentAbortController.abort();
    }
    currentAbortController = new AbortController();

    const mainContent = document.getElementById('main-content');
    if (!mainContent) {
      window.location.href = url;
      return;
    }

    startProgress();
    mainContent.classList.add('is-filtering');

    try {
      const response = await fetch(url, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-Frontend-AJAX': 'true',
          'Accept': 'text/html, application/xhtml+xml, */*'
        },
        signal: currentAbortController.signal
      });

      if (!response.ok) {
        window.location.href = url;
        return;
      }

      const html = await response.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');

      const newMain = doc.getElementById('main-content');
      if (!newMain) {
        window.location.href = url;
        return;
      }

      // Update Page Title
      if (doc.title) {
        document.title = doc.title;
      }

      // Smoothly replace the main content area
      mainContent.innerHTML = newMain.innerHTML;

      // Re-evaluate script tags within newly injected content if any
      const scripts = mainContent.querySelectorAll('script');
      scripts.forEach(oldScript => {
        const newScript = document.createElement('script');
        Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
        newScript.textContent = oldScript.textContent;
        oldScript.parentNode.replaceChild(newScript, oldScript);
      });

      // Update URL in browser bar
      if (pushState) {
        window.history.pushState({ ajax: true, url }, '', url);
      }

      // Scroll smoothly to top of filter section if scrolled down
      const section = mainContent.querySelector('.city-edition-section') || mainContent;
      const rect = section.getBoundingClientRect();
      if (rect.top < 0) {
        window.scrollTo({
          top: window.pageYOffset + rect.top - 80,
          behavior: 'smooth'
        });
      }

      // Re-bind ticker carousel if present on newly loaded page
      const newTrack = document.getElementById('city-news-track');
      const newPrev = document.getElementById('btn-strip-prev');
      const newNext = document.getElementById('btn-strip-next');
      if (newTrack && newPrev && newNext) {
        newPrev.onclick = () => newTrack.scrollBy({ left: -320, behavior: 'smooth' });
        newNext.onclick = () => newTrack.scrollBy({ left: 320, behavior: 'smooth' });
      }

    } catch (err) {
      if (err.name === 'AbortError') return;
      console.error('AJAX Filter load error, falling back:', err);
      window.location.href = url;
    } finally {
      mainContent.classList.remove('is-filtering');
      finishProgress();
    }
  }

  // Intercept Filter Tabs & Pagination Click Events
  document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link) return;

    // Ignore modified keys (Ctrl, Cmd, Shift, Alt)
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

    // Ignore external or new tab links
    if (link.target && link.target !== '_self') return;
    if (link.hasAttribute('download')) return;
    if (link.closest('[data-no-ajax]') || link.hasAttribute('data-no-ajax')) return;

    const href = link.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;

    let targetUrl;
    try {
      targetUrl = new URL(link.href, window.location.href);
    } catch (err) {
      return;
    }

    // Must be same origin and NOT admin
    if (targetUrl.origin !== window.location.origin) return;
    if (targetUrl.pathname.startsWith('/admin')) return;

    // Check if this is a filter link or pagination link inside main-content
    const isInsideMain = !!link.closest('#main-content');
    const hasFilterParams = targetUrl.searchParams.has('category') ||
                            targetUrl.searchParams.has('section') ||
                            targetUrl.searchParams.has('sort') ||
                            targetUrl.searchParams.has('year') ||
                            targetUrl.searchParams.has('month') ||
                            targetUrl.searchParams.has('q') ||
                            targetUrl.searchParams.has('page');

    const isPagination = !!link.closest('.pagination') || !!link.closest('nav[role="navigation"]') || link.classList.contains('page-link');
    const isFilterBar = !!link.closest('.vogue-filter-bar') || (isInsideMain && link.parentElement && link.parentElement.textContent.includes('Filter'));

    // If it's a filter click, pagination click, or category tab inside main-content
    if (isInsideMain && (hasFilterParams || isPagination || isFilterBar)) {
      e.preventDefault();
      loadFrontendContent(targetUrl.href, true);
    }
  });

  // Intercept Filter & Search Form Submissions (GET forms)
  document.addEventListener('submit', (e) => {
    const form = e.target.closest('form');
    if (!form) return;

    if (form.hasAttribute('data-no-ajax') || form.closest('[data-no-ajax]')) return;

    const method = (form.getAttribute('method') || 'GET').toUpperCase();
    if (method !== 'GET') return; // Let POST mutations (nominate, newsletter) run natively

    let targetUrl;
    try {
      targetUrl = new URL(form.action || window.location.href, window.location.href);
    } catch (err) {
      return;
    }

    if (targetUrl.origin !== window.location.origin || targetUrl.pathname.startsWith('/admin')) {
      return;
    }

    const isInsideMain = !!form.closest('#main-content');
    if (isInsideMain) {
      e.preventDefault();
      const formData = new FormData(form);
      const params = new URLSearchParams();
      for (const [key, value] of formData.entries()) {
        if (value !== '') {
          params.append(key, value);
        }
      }
      const cleanUrl = targetUrl.pathname + (params.toString() ? '?' + params.toString() : '');
      loadFrontendContent(cleanUrl, true);
    }
  });

  // Handle browser Back / Forward Navigation
  window.addEventListener('popstate', () => {
    loadFrontendContent(window.location.href, false);
  });

});
