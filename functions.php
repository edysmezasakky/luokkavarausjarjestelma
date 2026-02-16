<?php

session_start();

function generate_csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) &&
        hash_equals($_SESSION['csrf_token'], $token);
}

function is_logged_in()
{
    return !empty($_SESSION['user_id']);
}

function require_login()
{
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function redirect(string $path, int $status = 302): never
{
    header('Location: ' . $path, true, $status);
    exit;
}

function flash_make(string $type, string $message)
{
    // We use a specific key in the session array to store these
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }

    // Append the message
    $_SESSION['flash_messages'][] = [
        'type' => $type,
        'message' => $message,
    ];
}

function flash_get(): array
{
    if (!isset($_SESSION['flash_messages'])) {
        return [];
    }

    // Get the messages
    $messages = $_SESSION['flash_messages'];

    // Delete them immediately so they don't show up again
    unset($_SESSION['flash_messages']);

    return $messages;
}
