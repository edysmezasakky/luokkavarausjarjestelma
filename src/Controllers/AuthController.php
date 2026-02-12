<?php

namespace App\Controllers;

use App\Auth;
use App\Database;
use App\Flash;
use App\View;

class AuthController
{
    public function showLoginForm()
    {
        // Look how clean this is!
        // We can pass data easily:
        View::render('login', [
            'pageTitle' => 'Login to Dashboard',
            'token' => Auth::generateCsrfToken(),
        ]);
    }

    public function login()
    {

        $csrf = $_POST['csrf_token'] ?? '';
        if (!Auth::validateCsrfToken($csrf)) {
            die('CSRF-tarkistus epäonnistui.');
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($email === '' || $password === '') {
            Flash::make('error', 'Täytä kaikki kentät.');
            redirect('login');
        }
        try {
            $pdo = (new Database()->connect());
            $stmt = $pdo->prepare('SELECT user_id, role, password_hash FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
            if (!$user) {
                Flash::make('error', 'Käyttäjää ei löydy.');
                redirect('login');
            }
            if (!password_verify($password, $user['password_hash'])) {
                Flash::make('error', 'Virheellinen salasana.');
                redirect('login');
            }
            // Kirjautuminen onnistui
            Auth::login($user['user_id'], $user['role']);
            redirect('dashboard');

        } catch (\PDOException $e) {
            Flash::make('error', 'Jotain meni vaarin.');
            // die('Tietokantavirhe: ' . $e->getMessage());
        }

    }

    public function logout()
    {
        Auth::logout();
    }

    public function showRegisterForm()
    {
        // Look how clean this is!
        // We can pass data easily:
        View::render('register', [
            'pageTitle' => 'Register to Dashboard',
            'token' => Auth::generateCsrfToken(),
        ]);

    }

    public function register()
    {


        // CSRF
        $csrf = $_POST['csrf_token'] ?? '';
        if (!Auth::validateCsrfToken($csrf)) {
            die('CSRF-tarkistus epäonnistui.');
        }

        // Syötteiden perusvalidointi
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
            $pdo = (new Database()->connect());
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

            echo '<p>Rekisteröinti onnistui. <a href="/login">Kirjaudu sisään</a></p>';
        } catch (\PDOException $e) {
            // Kehitysvaiheessa virheen tulostus voi auttaa, tuotannossa lokita
            die('Tietokantavirhe:' . $e->getMessage());
        }

    }
}
