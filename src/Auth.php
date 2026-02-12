<?php

namespace App;

class Auth
{
    /**
     * Start the session safely.
     * Checks if a session is already active to avoid PHP warnings.
     */
    public static function init()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Generate a CSRF token and store it in the session.
     */
    public static function generateCsrfToken(): string
    {
        self::init(); // Ensure session is started
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validate a submitted CSRF token.
     */
    public static function validateCsrfToken(?string $token): bool
    {
        self::init();
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string) $token);
    }

    /**
     * Check if the user is logged in.
     */
    public static function isLoggedIn(): bool
    {
        self::init();
        return !empty($_SESSION['user_id']);
    }

    /**
     * Force login requirement. Redirects if not logged in.
     */
    public static function requireLogin()
    {
        if (!self::isLoggedIn()) {
            redirect('login');
        }
    }

    /**
     * Helper to log a user in (saves you from manually setting $_SESSION everywhere)
     */
    public static function login(int $userId, string $userRole)
    {
        self::init();
        session_regenerate_id(true); // Security: Prevent session fixation
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_role'] = $userRole;
    }

    /**
     * Helper to log out
     */
    public static function logout()
    {
        self::init();
        // Clear all session data
        $_SESSION = [];

        // Destroy the session file/data on server
        session_destroy();

        // Delete the session cookie from browser
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params ["path"],
                $params["domain"],
                $params["secure"],
                $params ["httponly"]
            );
        }

        // Redirect to login
        redirect('login');

    }

    public static function isAdmin(): bool
    {
        self::init(); // Ensure session is started
        // Assuming you store the role in session upon login
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    public static function requireAdmin()
    {
        if (!self::isAdmin()) {
            http_response_code(403); // Forbidden
            echo "Access Denied: Admins Only";
            exit;
        }
    }
}
