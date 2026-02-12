<?php

session_start();

// Tarkista, että käyttäjä on kirjautunut sisään
if (isset($_SESSION['user_id'])) {
    // Kirjaudu sisään, lähetä ne kojelauntaan
    header("Location: dashboard.php");
} else {
    // Ei kirjautunut, lähetä ne kirjaudu sisään sivu.
    header("Location: login.php");
}
exit;
