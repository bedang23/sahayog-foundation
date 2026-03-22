(function () {
  'use strict';

  const profileBtn = document.getElementById('adminProfileBtn');
  const profileMenu = document.getElementById('adminProfileMenu');
  const profileWrap = document.getElementById('adminProfileMenuWrap');

  if (profileBtn && profileMenu && profileWrap) {
    profileBtn.addEventListener('click', () => {
      const open = profileMenu.classList.toggle('open');
      profileBtn.setAttribute('aria-expanded', String(open));
      profileMenu.setAttribute('aria-hidden', String(!open));
    });

    document.addEventListener('click', (event) => {
      if (!profileWrap.contains(event.target)) {
        profileMenu.classList.remove('open');
        profileBtn.setAttribute('aria-expanded', 'false');
        profileMenu.setAttribute('aria-hidden', 'true');
      }
    });
  }

  const sidebar = document.getElementById('adminSidebar');
  const sidebarToggle = document.getElementById('adminSidebarToggle');

  if (sidebar && sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('open');
    });
  }
})();
