<?php

// Load Composer Autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Load Environment Variables
use Dotenv\Dotenv;

// We use try-catch so the app doesn't crash if .env is missing (e.g. in production)
try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (Exception $e) {
    // In production, variables might be set in the server config, so we ignore this error.
    // In dev, if .env is missing, this will fail silently, but DB connection will fail later.
}

// Load Global Helpers
// This makes functions like url(), dd(), or view() available everywhere immediately.
require_once __DIR__ . '/src/helpers.php';

// Error Reporting (Useful for Team Dev)
// logical check: If we are on localhost, show errors. If not, hide them.
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0); // Security: Don't show errors to the world
}

// Start Session Globally
// This means you never have to type session_start() again.
App\Auth::init();
