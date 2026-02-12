<?php
require_once '../functions.php';
$token = generate_csrf_token();

include 'header.php';
?>

<h1>Kirjaudu</h1>
<form action="login_process.php" method="post">
  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
  <label class="mb-3">
    Sähköposti:
    <input type="email" class="form-control" name="email" required>
  </label><br>
  <label class="mb-3">
    Salasana:
    <input type="password" class="form-control" name="password" required>
  </label class="mb-3"><br>
  <button class="btn btn-primary" type="submit">Kirjaudu</button>
</form>
<p>Ei tiliä? <a href="register.php">Rekisteröidy</a></p>

<?php include 'footer.php' ?>