<?php

require_once '../db.php';
require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('register.php');
}

// CSRF
$csrf = $_POST['csrf_token'] ?? '';
if (!validate_csrf_token($csrf)) {
    die('CSRF-tarkistus epäonnistui.');
}

// Syötteiden perusvalidointi
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';
$errors = [];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash_make('error', 'Virheellinen sähköpostiosoite.');
    redirect('register.php');
}
if (strlen($password) < 8) {
    flash_make('error', 'Salasanan tulee olla vähintään 8 merkkiä
pitkä.');
    redirect('register.php');
}

if ($password !== $password_confirm) {
    flash_make('error', 'Salasanat eivät täsmää.');
    redirect('register.php');
}

// Tarkista, onko käyttäjänimi tai sähköposti jo käytössä
try {
    $stmt = $pdo->prepare('SELECT user_id FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $existing = $stmt->fetch();
    if ($existing) {
        flash_make('error', 'Käyttäjänimi tai sähköposti on jo käytössä.');
        redirect('register.php');
    }
    // Tallenna uusi käyttäjä
    $password_hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $insert = $pdo->prepare('INSERT INTO users (email, password_hash) VALUES (:email, :password_hash)');
    $insert->execute([
        'email' => $email,
        'password_hash' => $password_hash,
    ]);

    flash_make('success', 'Rekisteröinti onnistui. Kirjaudu sisään<');
    redirect('login.php');
} catch (PDOException $e) {
    // Kehitysvaiheessa virheen tulostus voi auttaa, tuotannossa lokita
    flash_make('error', 'Joku meni väärin.');
    redirect('login.php');
}
