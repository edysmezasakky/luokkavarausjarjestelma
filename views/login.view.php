<?php require __DIR__ . '/partials/header.view.php'; ?>

  <h1>Kirjaudu</h1>
  <form action="<?= url('login') ?>" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo
                                                  htmlspecialchars($token); ?>">
    <label>
      Sähköposti:
      <input type="email" name="email" required>
    </label><br><br>
    <label>
      Salasana:
      <input type="password" name="password" required>
    </label><br><br>
    <button class="btn btn-primary" type="submit">Kirjaudu</button>
  </form>
  <p>Ei tiliä? <a href="<?= url('register') ?>">Rekisteröidy</a></p>

<?php require __DIR__ . '/partials/footer.view.php'; ?>
