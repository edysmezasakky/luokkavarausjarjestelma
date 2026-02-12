<?php require __DIR__ . '/partials/header.view.php'; ?>


<div class="flex min-h-screen bg-base-200">

  <aside class="w-64 bg-base-100 shadow-xl hidden lg:block">
    <div class="p-4 text-xl font-bold text-primary">ClassRes</div>
    <ul class="menu p-4 w-full text-base-content">
      <li><a href="/dashboard" class="active">Dashboard</a></li>

      <?php if (App\Auth::isAdmin()): ?>
        <li class="menu-title"><span>Admin</span></li>
        <li><a href="/admin/classes/create">Create Class</a></li>
        <li><a href="/admin/reservations">All Bookings</a></li>
      <?php endif; ?>

      <div class="divider"></div>
      <li><a href="/logout">Logout</a></li>
    </ul>
  </aside>

  <main class="flex-1 p-6">
    <div class="navbar bg-base-100 lg:hidden mb-4 rounded-box shadow">
      <div class="flex-1"><a class="btn btn-ghost text-xl">ClassRes</a></div>
      <div class="flex-none">
        <a href="/logout" class="btn btn-square btn-ghost">Exit</a>
      </div>
    </div>

    <h1>Dashboard!</h1>

    <h2>Tervetuloa <?= $user['name'] ?>!</h2>
    <p>Tämä sivu vaatii kirjautumisen.</p>
    <p><a href="<?= url('logout') ?>">Kirjaudu ulos</a></p>
    <?php require __DIR__ . '/partials/footer.view.php'; ?>
  </main>

</div>
