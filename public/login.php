<?php
require_once '../functions.php';
$token = generate_csrf_token();

$pageTitle = "Kirjaudu sisaan";

?>

<?php include 'templates/html.php'; ?>

<body>
  <main style="margin: auto;">
    <div style="width: 20rem">

      <h1>Kirjaudu</h1>
      <?php include 'templates/flash.php'; ?>

      <form action="login_process.php" method="post" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo
                                                      htmlspecialchars($token); ?>">
        <div class="form-item">
          <label for="email" class="form-label">
            Sähköposti:</label>
          <input type="email" name="email" id="email" required>
        </div>

        <div class="form-item">
          <label for="password" class="form-label">
            Salasana:</label>
          <input type="password" name="password" id="password" required>
        </div>
        <button class="btn btn-ghost" type="submit">Kirjaudu</button>
      </form>
      <p>Ei tiliä? <a class="btn btn-link" href="register.php">Rekisteröidy</a></p>
    </div>
    <?php
    include 'templates/footer.php';
    ?>
