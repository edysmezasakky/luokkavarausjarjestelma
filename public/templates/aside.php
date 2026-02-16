<?php

$current_page = basename($_SERVER['PHP_SELF']);

?>
<?php include 'html.php'; ?>

<body>
  <header>
    <button id="sidebar-toggle" class="sidebar-toggle">
      <!-- Hamburger icon -->
      <svg style="width: 2rem;height: 2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </header>
  <aside id="sidebar" class="sidebar">
    <!-- Logo / Brand -->
    <div class="nav-brand">
      <span>Luokkavaraus</span>
    </div>

    <!-- Main Nav -->
    <nav class="nav-menu">
      <div class="nav-group-label">Core</div>
      <a href="dashboard.php" class="nav-item <?= $current_page == 'index.php' ? 'nav-item-active' : ''; ?>">
        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="opacity:1;">
          <rect width="7" height="9" x="3" y="3" rx="1" />
          <rect width="7" height="5" x="14" y="3" rx="1" />
          <rect width="7" height="9" x="14" y="12" rx="1" />
          <rect width="7" height="5" x="3" y="16" rx="1" />
        </svg>
        <span class="nav-text">Dashboard</span>
      </a>

      <a href="/users" class="nav-item">
        <span class="nav-text">Users</span>
      </a>
    </nav>


    <!-- Footer / User section -->
    <div class="nav-bottom">
      <button class="btn btn-ghost">
        <span class="nav-text">Log out</span>
      </button>
    </div>
  </aside>
  <main>
