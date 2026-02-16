<?php
require_once '../functions.php';
$token = generate_csrf_token();
?>

<?php include 'templates/html.php'; ?>

<body>
  <main style="margin: auto;">
    <div style="width: 20rem">

      <h1>Rekisteröidy</h1>
      <?php include 'templates/flash.php'; ?>
      <form action="register_process.php" method="post"
        novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
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
        <div class="form-item">
          <label for="password_confirm" class="form-label">
            Salasana:</label>
          <input type="password" name="password_confirm" id="password_confirm" required>
        </div>
        <button class="btn btn-default" type="submit">Rekisteröidy</button>
      </form>
      <p>Onko sinulla tili? <a class="btn btn-link" href="login.php">Kirjaudu</a></p>

      <?php include 'templates/footer.php'; ?>
