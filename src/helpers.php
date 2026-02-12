<?php

/**
 * Generates a full application URL for the given path.
 *
 * Examples:
 *   url()            →  "https://example.com/" or "https://localhost/mysite/"
 *   url('about')     →  "https://example.com/about" or ".../mysite/about"
 */
function url(string $path = ''): string
{
    // Base path from SCRIPT_NAME (most reliable cross-server method)
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $basePath   = dirname($scriptName);

    // Normalize basePath: "" for root, no trailing slash
    if ($basePath === '/' || $basePath === '\\') {
        $basePath = '';
    }

    // Clean the input path
    $path = trim($path, '/ ');

    // Build result
    if ($path === '') {
        // Root of the application
        return $basePath === ''
            ? rtrim(getBaseUrlWithoutPath(), '/') . '/'
            : $basePath . '/';
    }

    return $basePath . '/' . $path;
}

/**
 * Helper: scheme + host + port (without any path)
 * Falls back gracefully if some server vars are missing
 */
function getBaseUrlWithoutPath(): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        ? 'https'
        : 'http';

    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // Include port only if non-standard
    $port = $_SERVER['SERVER_PORT'] ?? 80;
    $portPart = ($port == 80 && $scheme === 'http') || ($port == 443 && $scheme === 'https')
        ? ''
        : ":$port";

    return $scheme . '://' . $host . $portPart;
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
