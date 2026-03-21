/**
 * Sahayog Foundation — Donate Page JavaScript
 * Handles: amount selection, custom input, summary update, frequency toggle
 */

(function () {
  'use strict';

  /* ── Frequency Toggle ──────────────────────────────────── */
  const freqBtns = document.querySelectorAll('.freq-btn');
  freqBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      freqBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  /* ── Amount Selection ──────────────────────────────────── */
  const amountBtns    = document.querySelectorAll('.amount-btn');
  const customInput   = document.getElementById('customAmount');
  const summaryAmount = document.getElementById('summaryAmount');
  const summaryTax    = document.getElementById('summaryTax');
  const summaryNet    = document.getElementById('summaryNet');
  const donateBtn     = document.getElementById('donateBtn');

  let selectedAmount = 1000;

  function formatINR(n) {
    return '₹' + Number(n).toLocaleString('en-IN');
  }

  function updateSummary(amount) {
    const n = parseInt(amount, 10);
    if (isNaN(n) || n < 100) return;

    selectedAmount = n;
    const tax = Math.round(n * 0.30);
    const net = n - tax;

    if (summaryAmount) summaryAmount.textContent = formatINR(n);
    if (summaryTax)    summaryTax.textContent    = `- ${formatINR(tax)}`;
    if (summaryNet)    summaryNet.textContent    = formatINR(net);
    if (donateBtn)     donateBtn.textContent = `Proceed to Donate ${formatINR(n)}`;
  }

  amountBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      amountBtns.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-pressed', 'false');
      });
      btn.classList.add('active');
      btn.setAttribute('aria-pressed', 'true');

      if (customInput) customInput.value = '';
      updateSummary(btn.dataset.amount);
    });
  });

  if (customInput) {
    customInput.addEventListener('input', () => {
      const val = parseInt(customInput.value, 10);
      if (val >= 100) {
        amountBtns.forEach(b => {
          b.classList.remove('active');
          b.setAttribute('aria-pressed', 'false');
        });
        updateSummary(val);
      }
    });
  }

  /* ── Donate Button (Static — no real payment) ──────────── */
  if (donateBtn) {
    donateBtn.addEventListener('click', () => {
      const name  = document.getElementById('donorName')?.value.trim();
      const email = document.getElementById('donorEmail')?.value.trim();

      if (!name || !email) {
        alert('Please fill in your name and email before proceeding.');
        return;
      }

      // Simulate a processing state
      const originalText = donateBtn.textContent;
      donateBtn.disabled = true;
      donateBtn.textContent = 'Processing...';

      setTimeout(() => {
        donateBtn.disabled = false;
        donateBtn.textContent = originalText;
        alert(`Thank you, ${name}! This is a demo — no real payment was processed.\n\nIn production, you would be redirected to a secure payment gateway.`);
      }, 1500);
    });
  }

  // Initialize
  updateSummary(1000);

})();
