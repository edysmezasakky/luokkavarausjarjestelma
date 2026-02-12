<?php

require_once '../db.php';
require_once '../functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$csrf = $_POST['csrf_token'] ?? '';
if (!validate_csrf_token($csrf)) {
    die('CSRF-tarkistus epäonnistui.');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
if ($email === '' || $password === '') {
    die('Täytä kaikki kentät. <a
href="login.php">Takaisin</a>');
}

try {
    $stmt = $pdo->prepare('SELECT user_id, password_hash FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if (!$user) {
        die('Käyttäjää ei löydy. <a
href="login.php">Takaisin</a>');
    }
    if (!password_verify($password, $user['password_hash'])) {
        die('Virheellinen salasana. <a
ef="login.php">Takaisin</a>');
    }
    // Kirjautuminen onnistui
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['user_id'];
    header('Location: dashboard.php');
    exit;
} catch (PDOException $e) {
    die('Tietokantavirhe: ' . $e->getMessage());
}
