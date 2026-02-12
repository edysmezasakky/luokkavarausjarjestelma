<?php

/**
 * Generates correct URL even when project is in subfolder
 * Examples:
 *   url('login')     →  /myproject/login
 *   url('assets/style.css') → /myproject/assets/style.css
 */
function url(string $path = ''): string
{
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

    // Remove leading slash from $path if present
    $path = ltrim($path, '/');

    if ($path === '') {
        return $base . '/';
    }

    return $base . '/' . $path;
}

/**
 * Safe redirect – always use this instead of header("Location: /something")
 * Examples:
 *   redirect('dashboard');
 *   redirect('login?error=1');
 */
function redirect(string $path, int $status = 302): never
{
    header('Location: ' . url($path), true, $status);
    exit;
}
