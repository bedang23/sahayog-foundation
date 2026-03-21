/**
 * Sahayog Foundation — Contact Page JavaScript
 * Handles: form validation, submission simulation
 */

(function () {
  'use strict';

  const submitBtn  = document.getElementById('contactSubmitBtn');
  const formSuccess = document.getElementById('formSuccess');

  if (!submitBtn) return;

  submitBtn.addEventListener('click', () => {
    const name    = document.getElementById('contactName')?.value.trim();
    const email   = document.getElementById('contactEmail')?.value.trim();
    const subject = document.getElementById('contactSubject')?.value;
    const message = document.getElementById('contactMessage')?.value.trim();

    // Basic validation
    if (!name) { showError('contactName', 'Please enter your name.'); return; }
    if (!email || !isValidEmail(email)) { showError('contactEmail', 'Please enter a valid email.'); return; }
    if (!subject) { showError('contactSubject', 'Please select a subject.'); return; }
    if (!message) { showError('contactMessage', 'Please enter your message.'); return; }

    // Simulate submission
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending...';

    setTimeout(() => {
      submitBtn.disabled = false;
      submitBtn.innerHTML = 'Send Message <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';

      if (formSuccess) {
        formSuccess.hidden = false;
        formSuccess.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }

      // Reset form
      ['contactName','contactEmail','contactPhone','contactSubject','contactMessage'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
      });
    }, 1500);
  });

  function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    if (!field) return;
    field.focus();
    field.style.borderColor = 'var(--color-error)';
    field.addEventListener('input', () => { field.style.borderColor = ''; }, { once: true });
    // Could add an inline error label here for full a11y
    alert(message);
  }

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

})();
