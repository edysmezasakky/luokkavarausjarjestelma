<?php

namespace App;

class Flash
{
    public const SESSION_KEY = 'flash_messages';

    /**
     * Create a flash message
     * @param string $type  'success', 'error', 'warning', 'info'
     * @param string $message The text to display
     */
    public static function make(string $type, string $message): void
    {
        // We use a specific key in the session array to store these
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }

        // Append the message
        $_SESSION[self::SESSION_KEY][] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    /**
     * Retrieve and clear all flash messages
     * @return array
     */
    public static function get(): array
    {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return [];
        }

        // Get the messages
        $messages = $_SESSION[self::SESSION_KEY];

        // Delete them immediately so they don't show up again
        unset($_SESSION[self::SESSION_KEY]);

        return $messages;
    }
}
