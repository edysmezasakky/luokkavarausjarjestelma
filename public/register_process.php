<?php

require_once '../db.php';
require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
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

    $errors [] = 'Virheellinen sähköpostiosoite.';
}
if (strlen($password) < 8) {
    $errors[] = 'Salasanan tulee olla vähintään 8 merkkiä
pitkä.';
}

if ($password !== $password_confirm) {
    $errors[] = 'Salasanat eivät täsmää.';
}

if ($errors) {
    foreach ($errors as $e) {
        echo '<p>' . htmlspecialchars($e) . '</p>';
    }

    echo '<p><a href="register.php">Palaa takaisin</a></p>';
    exit;
}

// Tarkista, onko käyttäjänimi tai sähköposti jo käytössä
try {
    $stmt = $pdo->prepare('SELECT user_id FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $existing = $stmt->fetch();
    if ($existing) {
        die('Käyttäjänimi tai sähköposti on jo käytössä. <a href="register.php">Takaisin</a>');
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

    echo '<p>Rekisteröinti onnistui. <a href="login.php">Kirjaudu sisään</a></p>';
} catch (PDOException $e) {
    // Kehitysvaiheessa virheen tulostus voi auttaa, tuotannossa lokita
    die('Tietokantavirhe:' . $e->getMessage());
}
