<?php
require_once '../functions.php';
require_login();

$pageTitle = "Oma Dashboard";
?>

<?php include 'templates/aside.php'; ?>

<h1>Tervetuloa</h1>
<p>Tämä sivu vaatii kirjautumisen.</p>
<p><a href="logout.php">Kirjaudu ulos</a></p>

<?php
include 'templates/footer.php';
?>
