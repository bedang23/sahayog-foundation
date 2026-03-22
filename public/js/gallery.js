/**
 * Sahayog Foundation — Gallery Page JavaScript
 * Handles: category filtering and lightbox modal
 */

(function () {
  'use strict';

  const filterButtons = document.querySelectorAll('.gallery-filter-btn');
  const cards = document.querySelectorAll('.gallery-card');

  if (filterButtons.length && cards.length) {
    filterButtons.forEach((button) => {
      button.addEventListener('click', () => {
        const filter = button.dataset.filter || 'all';

        filterButtons.forEach((btn) => {
          btn.classList.remove('active');
          btn.setAttribute('aria-pressed', 'false');
        });

        button.classList.add('active');
        button.setAttribute('aria-pressed', 'true');

        cards.forEach((card) => {
          const category = card.dataset.category || '';
          const visible = filter === 'all' || category === filter;
          card.classList.toggle('is-hidden', !visible);
        });
      });
    });
  }

  const lightbox = document.getElementById('galleryLightbox');
  const lightboxImage = document.getElementById('galleryLightboxImage');
  const lightboxCaption = document.getElementById('galleryLightboxCaption');
  const lightboxClose = document.getElementById('galleryLightboxClose');
  const imageButtons = document.querySelectorAll('.gallery-image-btn');

  if (!lightbox || !lightboxImage || !lightboxCaption || !lightboxClose || !imageButtons.length) {
    return;
  }

  let lastFocused = null;

  imageButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const src = button.dataset.lightboxSrc || '';
      const alt = button.dataset.lightboxAlt || '';
      const caption = button.dataset.lightboxCaption || '';

      lastFocused = button;
      lightboxImage.src = src;
      lightboxImage.alt = alt;
      lightboxCaption.textContent = caption;
      lightbox.classList.add('open');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      lightboxClose.focus();
    });
  });

  function closeLightbox() {
    lightbox.classList.remove('open');
    lightbox.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    lightboxImage.src = '';
    lightboxCaption.textContent = '';
    if (lastFocused) {
      lastFocused.focus();
    }
  }

  lightboxClose.addEventListener('click', closeLightbox);

  lightbox.addEventListener('click', (event) => {
    if (event.target === lightbox) {
      closeLightbox();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && lightbox.classList.contains('open')) {
      closeLightbox();
    }
  });
})();
