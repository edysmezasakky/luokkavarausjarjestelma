<?php

namespace App;

class Router
{
    protected array $routes = [];

    /**
     * Register a GET route
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register a POST route
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Load the requested route
     */
    public function dispatch($uri, $method)
    {
        // Remove query string
        $uri = parse_url($uri, PHP_URL_PATH) ?: '/';

        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath   = dirname($scriptName);

        // Normalize: remove trailing slash, but keep root as "/"
        if ($basePath === '/' || $basePath === '\\') {
            $basePath = '';
        }

        // Remove the base path prefix from the URI
        if (str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath)) ?: '/';
        }

        // normalize multiple slashes, trailing slash, etc.
        $uri = preg_replace('#/{2,}#', '/', $uri);
        $uri = rtrim($uri, '/') ?: '/';

        // Check if the route exists
        if (array_key_exists($uri, $this->routes[$method])) {
            $controllerAction = $this->routes[$method][$uri];

            // It expects an array like [AuthController::class, 'index']
            $controller = new $controllerAction[0]();
            $method = $controllerAction[1];

            return $controller->$method();
        }

        // Handle 404 Not Found
        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
