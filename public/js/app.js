/**
 * Sahayog Foundation — Main JavaScript
 * Handles: sticky header, mobile menu, scroll animations, stat counters
 */

(function () {
  'use strict';

  /* ── Sticky Header ─────────────────────────────────────── */
  const header = document.getElementById('site-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('scrolled', window.scrollY > 20);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ── Mobile Menu ───────────────────────────────────────── */
  const toggle   = document.getElementById('mobileToggle');
  const mobileMenu = document.getElementById('mobileMenu');
  let menuOpen = false;

  if (toggle && mobileMenu) {
    toggle.addEventListener('click', () => {
      menuOpen = !menuOpen;
      toggle.classList.toggle('open', menuOpen);
      toggle.setAttribute('aria-expanded', menuOpen);
      mobileMenu.classList.toggle('open', menuOpen);
      mobileMenu.setAttribute('aria-hidden', !menuOpen);
      document.body.style.overflow = menuOpen ? 'hidden' : '';
    });

    // Close on link click
    mobileMenu.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', () => {
        menuOpen = false;
        toggle.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.remove('open');
        mobileMenu.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      });
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
      if (menuOpen && !mobileMenu.contains(e.target) && !toggle.contains(e.target)) {
        menuOpen = false;
        toggle.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.remove('open');
        mobileMenu.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      }
    });
  }

  /* ── Scroll Reveal Animations ──────────────────────────── */
  const revealEls = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right');

  if (revealEls.length && 'IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          revealObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.12,
      rootMargin: '0px 0px -40px 0px'
    });

    revealEls.forEach(el => revealObserver.observe(el));
  } else {
    // Fallback: show all immediately
    revealEls.forEach(el => el.classList.add('in-view'));
  }

  /* ── Animated Stat Counters ────────────────────────────── */
  const statNumbers = document.querySelectorAll('.stat-number[data-target]');

  if (statNumbers.length && 'IntersectionObserver' in window) {
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    statNumbers.forEach(el => counterObserver.observe(el));
  }

  function animateCounter(el) {
    const target   = parseInt(el.dataset.target, 10);
    const suffix   = el.dataset.suffix || '';
    const duration = 1800;
    const startTime = performance.now();

    function easeOut(t) { return 1 - Math.pow(1 - t, 3); }

    function update(currentTime) {
      const elapsed  = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const value    = Math.round(easeOut(progress) * target);

      el.textContent = formatNumber(value) + suffix;

      if (progress < 1) {
        requestAnimationFrame(update);
      }
    }

    requestAnimationFrame(update);
  }

  function formatNumber(n) {
    if (n >= 1000) return (n / 1000).toFixed(n % 1000 === 0 ? 0 : 0) + (n >= 1000 ? ',' + String(n % 1000).padStart(3, '0') : '');
    return n.toLocaleString('en-IN');
  }

  /* ── Programs Subnav Active State ──────────────────────── */
  const subnavLinks = document.querySelectorAll('.subnav-link');
  if (subnavLinks.length) {
    const sections = [...subnavLinks].map(link => {
      const id = link.getAttribute('href').replace('#', '');
      return document.getElementById(id);
    }).filter(Boolean);

    const sectionObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const id = entry.target.id;
          subnavLinks.forEach(link => {
            link.style.color = link.getAttribute('href') === `#${id}`
              ? 'var(--color-primary)'
              : '';
            link.style.borderColor = link.getAttribute('href') === `#${id}`
              ? 'var(--color-primary)'
              : '';
          });
        }
      });
    }, { threshold: 0.4 });

    sections.forEach(s => sectionObserver.observe(s));
  }

  /* ── Smooth Anchor Scroll ──────────────────────────────── */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const headerH = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-h')) || 72;
        const offset  = target.getBoundingClientRect().top + window.scrollY - headerH - 16;
        window.scrollTo({ top: offset, behavior: 'smooth' });
      }
    });
  });

})();
