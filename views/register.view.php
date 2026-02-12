<?php require __DIR__ . '/partials/header.view.php'; ?>

  <h1>Rekisteröidy</h1>
  <form action="<?= url('register') ?>" method="post"
    novalidate>
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
    <label>
      Sähköposti:
      <input type="email" name="email" required
        maxlength="255">
    </label><br><br>
    <label>
      Salasana:
      <input type="password" name="password" required
        minlength="8">
    </label><br><br>
    <label>
      Vahvista salasana:
      <input type="password" name="password_confirm" required
        minlength="8">
    </label><br><br>
    <button type="submit">Rekisteröidy</button>
  </form>
  <p>Onko sinulla tili? <a href="<?= url('login') ?>">Kirjaudu</a></p>

<?php require __DIR__ . '/partials/footer.view.php'; ?>
