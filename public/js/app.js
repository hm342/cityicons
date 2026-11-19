/**
 * CITYICONS — Primary Client-Side Interactive Engine
 * Lightweight, accessible, zero-dependency controller for offcanvas drawer,
 * search modal, and news dispatch carousel.
 */
document.addEventListener('DOMContentLoaded', () => {
  // ── 1. OFFCANVAS SLIDEOUT DRAWER ──────────────────────────────
  const drawer = document.getElementById('vogue-drawer');
  const overlay = document.getElementById('vogue-overlay');
  const btnOpenDrawer = document.getElementById('btn-open-drawer');
  const btnCloseDrawer = document.getElementById('btn-close-drawer');

  function openDrawer() {
    if (drawer && overlay) {
      drawer.classList.add('open');
      overlay.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeDrawer() {
    if (drawer && overlay) {
      drawer.classList.remove('open');
      overlay.classList.remove('open');
      document.body.style.overflow = '';
    }
  }

  if (btnOpenDrawer) btnOpenDrawer.addEventListener('click', openDrawer);
  if (btnCloseDrawer) btnCloseDrawer.addEventListener('click', closeDrawer);
  if (overlay) overlay.addEventListener('click', closeDrawer);

  // ── 2. SEARCH MODAL ───────────────────────────────────────────
  const searchModal = document.getElementById('vogue-search-modal');
  const btnOpenSearch = document.getElementById('btn-open-search');
  const btnCloseSearch = document.getElementById('btn-close-search');
  const searchInput = document.getElementById('vogue-search-input');

  function openSearch() {
    if (searchModal) {
      searchModal.classList.add('open');
      document.body.style.overflow = 'hidden';
      if (searchInput) setTimeout(() => searchInput.focus(), 150);
    }
  }

  function closeSearch() {
    if (searchModal) {
      searchModal.classList.remove('open');
      document.body.style.overflow = '';
    }
  }

  if (btnOpenSearch) btnOpenSearch.addEventListener('click', openSearch);
  if (btnCloseSearch) btnCloseSearch.addEventListener('click', closeSearch);

  // ── 3. KEYBOARD SHORTCUTS (Escape to close modals) ────────────
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeDrawer();
      closeSearch();
    }
  });

  // ── 4. CITY NEWS DISPATCH CAROUSEL TRACK ──────────────────────
  const newsTrack = document.getElementById('city-news-track');
  const btnPrev = document.getElementById('btn-strip-prev');
  const btnNext = document.getElementById('btn-strip-next');

  if (newsTrack) {
    if (btnPrev) {
      btnPrev.addEventListener('click', () => {
        newsTrack.scrollBy({ left: -320, behavior: 'smooth' });
      });
    }
    if (btnNext) {
      btnNext.addEventListener('click', () => {
        newsTrack.scrollBy({ left: 320, behavior: 'smooth' });
      });
    }
  }
});
