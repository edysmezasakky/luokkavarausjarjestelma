<?php
require_once '../functions.php';
$token = generate_csrf_token();
include 'header.php';
?>
<h1>Rekisteröidy</h1>
<form action="register_process.php" method="post"
  novalidate>
  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
  <label class="mb-3">
    Sähköposti:
    <input type="email" class="form-control" name="email" required
      maxlength="255">
  </label><br>
  <label class="mb-3">
    Salasana:
    <input type="password" class="form-control" name="password" required
      minlength="8">
  </label><br>
  <label class="mb-3">
    Vahvista salasana:
    <input type="password" class="form-control" name="password_confirm" required
      minlength="8">
  </label><br>
  <button class="btn btn-primary" type="submit">Rekisteröidy</button>
</form>
<p>Onko sinulla tili? <a href="login.php">Kirjaudu</a></p>
<?php include 'footer.php' ?>