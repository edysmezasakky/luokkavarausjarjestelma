<?php

require_once '../db.php';
require_once '../functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('login.php');
}

$csrf = $_POST['csrf_token'] ?? '';
if (!validate_csrf_token($csrf)) {
    die('CSRF-tarkistus epäonnistui.');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
if ($email === '' || $password === '') {
    flash_make('error', 'Täytä kaikki kentät.');
    redirect('login.php');
}

try {
    $stmt = $pdo->prepare('SELECT user_id, password_hash FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if (!$user) {
        flash_make('error', 'Käyttäjää ei löydy.');
        redirect('login.php');
    }
    if (!password_verify($password, $user['password_hash'])) {
        flash_make('error', 'Virheellinen salasana.');
        redirect('login.php');
    }
    // Kirjautuminen onnistui
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['user_id'];
    header('Location: dashboard.php');
    exit;
} catch (PDOException $e) {
    flash_make('error', 'Joku meni vaarin.');
    redirect('login.php');
}
