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

  // ── 4B. CINEMA SECTION CAROUSEL TRACK ────────────────────────
  const ahmdTrack = document.getElementById('ahmedabad-cinema-track');
  const btnAhmdPrev = document.getElementById('btn-ahmd-prev');
  const btnAhmdNext = document.getElementById('btn-ahmd-next');

  if (ahmdTrack) {
    if (btnAhmdPrev) {
      btnAhmdPrev.addEventListener('click', () => {
        ahmdTrack.scrollBy({ left: -320, behavior: 'smooth' });
      });
    }
    if (btnAhmdNext) {
      btnAhmdNext.addEventListener('click', () => {
        ahmdTrack.scrollBy({ left: 320, behavior: 'smooth' });
      });
    }
  }

  // ── 5. REAL MOMENTS HERO SLIDER ───────────────────────────────
  const rmSlider = document.getElementById('rm-hero-slider');
  if (rmSlider) {
    const slides = rmSlider.querySelectorAll('.rm-hero-slide');
    const dots = document.querySelectorAll('.rm-slider-dot');
    const btnSlidePrev = document.getElementById('rm-slide-prev');
    const btnSlideNext = document.getElementById('rm-slide-next');

    let currentSlide = 0;
    let slideInterval = null;
    const totalSlides = slides.length;

    function goToSlide(index) {
      if (totalSlides === 0) return;
      slides[currentSlide].classList.remove('is-active');
      if (dots[currentSlide]) dots[currentSlide].classList.remove('is-active');

      currentSlide = (index + totalSlides) % totalSlides;

      slides[currentSlide].classList.add('is-active');
      if (dots[currentSlide]) dots[currentSlide].classList.add('is-active');
    }

    function nextSlide() {
      goToSlide(currentSlide + 1);
    }

    function prevSlide() {
      goToSlide(currentSlide - 1);
    }

    if (btnSlideNext) btnSlideNext.addEventListener('click', () => {
      nextSlide();
      resetTimer();
    });

    if (btnSlidePrev) btnSlidePrev.addEventListener('click', () => {
      prevSlide();
      resetTimer();
    });

    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => {
        goToSlide(idx);
        resetTimer();
      });
    });

    function startTimer() {
      if (totalSlides > 1) {
        slideInterval = setInterval(nextSlide, 6500);
      }
    }

    function stopTimer() {
      if (slideInterval) clearInterval(slideInterval);
    }

    function resetTimer() {
      stopTimer();
      startTimer();
    }

    rmSlider.addEventListener('mouseenter', stopTimer);
    rmSlider.addEventListener('mouseleave', startTimer);

    startTimer();
  }

  // ── 6. REAL MOMENTS HERO SLIDER & STICKY HEADER ───────────────
  const rmHero = document.querySelector('.rm-hero-wrap') || document.getElementById('rm-hero-fullscreen');
  if (rmHero) {
    const slides = rmHero.querySelectorAll('.rm-hero-slide');
    const dots = rmHero.querySelectorAll('.rm-hero-dot, .rm-hero-dot-item');
    const btnPrev = rmHero.querySelector('.rm-hero-arrow.prev') || document.getElementById('rm-edge-prev');
    const btnNext = rmHero.querySelector('.rm-hero-arrow.next') || document.getElementById('rm-edge-next');

    let current = 0;
    let timer = null;
    const total = slides.length;

    function activateSlide(idx) {
      if (total === 0) return;
      slides[current].classList.remove('active', 'is-active');
      if (dots[current]) dots[current].classList.remove('active', 'is-active');

      current = (idx + total) % total;

      slides[current].classList.add('active', 'is-active');
      if (dots[current]) dots[current].classList.add('active', 'is-active');
    }

    function next() {
      activateSlide(current + 1);
    }

    function prev() {
      activateSlide(current - 1);
    }

    if (btnNext) btnNext.addEventListener('click', (e) => {
      e.preventDefault();
      next();
      resetTimer();
    });

    if (btnPrev) btnPrev.addEventListener('click', (e) => {
      e.preventDefault();
      prev();
      resetTimer();
    });

    dots.forEach((dot, idx) => {
      dot.addEventListener('click', (e) => {
        e.preventDefault();
        activateSlide(idx);
        resetTimer();
      });
    });

    function startTimer() {
      if (total > 1) {
        timer = setInterval(next, 7000);
      }
    }

    function stopTimer() {
      if (timer) clearInterval(timer);
    }

    function resetTimer() {
      stopTimer();
      startTimer();
    }

    rmHero.addEventListener('mouseenter', stopTimer);
    rmHero.addEventListener('mouseleave', startTimer);

    startTimer();
  }

  // ── 7. AUTHENTIC REAL MOMENTS SMART STICKY NAVIGATION ───────────
  const rmHeaders = document.querySelectorAll('.rm-header-overlay, .rm-subpage-header');
  if (rmHeaders.length > 0) {
    let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
    let scrollDelta = 0;
    const scrollThreshold = 80;

    window.addEventListener('scroll', () => {
      const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;
      const isDown = currentScrollY > lastScrollY;

      rmHeaders.forEach(header => {
        if (currentScrollY > 50) {
          header.classList.add('is-sticky');
        } else {
          header.classList.remove('is-sticky', 'sticky-nav-hidden', 'sticky-nav-visible');
        }

        if (currentScrollY > 180) {
          if (isDown) {
            scrollDelta = 0;
            header.classList.add('sticky-nav-hidden');
            header.classList.remove('sticky-nav-visible');
          } else {
            scrollDelta += (lastScrollY - currentScrollY);
            if (scrollDelta > scrollThreshold) {
              header.classList.remove('sticky-nav-hidden');
              header.classList.add('sticky-nav-visible');
            }
          }
        } else {
          header.classList.remove('sticky-nav-hidden');
        }
      });

      lastScrollY = Math.max(0, currentScrollY);
    }, { passive: true });
  }

  // ── 8. PARALLAX SCROLL ON HERO & EDITORIAL MEDIA ─────────────────
  const parallaxMedia = document.querySelectorAll('.rm-hero-slide-bg img, .slide-parallax img');
  if (parallaxMedia.length > 0) {
    let ticking = false;
    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          const scrollY = window.pageYOffset || document.documentElement.scrollTop;
          if (scrollY < window.innerHeight * 1.5) {
            const offset = scrollY * 0.22;
            parallaxMedia.forEach(img => {
              img.style.transform = `scale(1.05) translate3d(0, ${offset}px, 0)`;
            });
          }
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  // ── 9. FLOATING BACK TO TOP BUTTON ──────────────────────────────
  const btnBackToTop = document.getElementById('rm-back-to-top');
  if (btnBackToTop) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 350) {
        btnBackToTop.classList.add('is-visible');
      } else {
        btnBackToTop.classList.remove('is-visible');
      }
    }, { passive: true });

    btnBackToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ── 10. GLOBAL IMAGE ERROR & FALLBACK RESILIENCE ────────────────
  document.querySelectorAll('img').forEach((img) => {
    img.addEventListener('error', function() {
      if (this.dataset.fallbackApplied) return;
      this.dataset.fallbackApplied = 'true';
      this.src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 500' width='800' height='500'%3E%3Crect width='800' height='500' fill='%231a1a1a'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%23555555' font-family='sans-serif' font-size='16' letter-spacing='3'%3ECITYICONS EDITORIAL ARCHIVE%3C/text%3E%3C/svg%3E";
      this.style.objectFit = 'cover';
    });
  });
});



