document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('sidebar-toggle');
  const sidebar = document.getElementById('sidebar');
  const body = document.body;
  document.getElementsByName;

  // Open sidebar
  function openSidebar() {
    body.classList.add('sidebar-open');
    backdrop.classList.remove('hidden');
    body.classList.add('overflow-hidden'); // prevent scrolling behind
  }

  // Events
  if (toggleBtn) {
    toggleBtn.addEventListener('click', openSidebar);
  }

  // close sidebar when clicking a link
  const navLinks = sidebar.querySelectorAll('a');
  navLinks.forEach((link) => {
    link.addEventListener('click', () => {
      if (window.innerWidth < 769) {
        // only on mobile
        closeSidebar();
      }
    });
  });
});
