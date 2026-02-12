<?php

$host = 'db';
$db = 'db';
$user = 'db';
$pass = 'db';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host; dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Kehitysvaiheessa voi tulostaa virheen, tuotannossa ei.
    die('DB connection failed: ' . $e->getMessage());
}
