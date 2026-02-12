<?php

namespace App;

class View
{
    /**
     * Render a view file
     * * @param string $viewName  The name of the file (without .view.php)
     * @param array  $data      Data to pass to the view (['user' => 'John'])
     */
    public static function render(string $viewName, array $data = [])
    {
        // Convert array keys to variables
        // e.g., ['title' => 'Home'] becomes $title = 'Home';
        extract($data);

        //Define the path to the views folder
        // We assume /views is in the project root, one level up from /src
        $path = __DIR__ . '/../views/' . $viewName . '.view.php';

        // Check if file exists to prevent ugly errors
        if (!file_exists($path)) {
            // In a real app, you might log this and show a generic 500 error
            throw new \Exception("View file not found: " . $path);
        }

        // Include the file
        // The variables created by extract() are now available inside this file
        require $path;
    }
}
