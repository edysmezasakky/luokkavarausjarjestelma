<?php
require_once '../functions.php';
$token = generate_csrf_token();
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Rekisteröidy</title>
</head>

<body>
  <h1>Rekisteröidy</h1>
  <form action="register_process.php" method="post"
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
  <p>Onko sinulla tili? <a href="login.php">Kirjaudu</a></p>
</body>

</html>
