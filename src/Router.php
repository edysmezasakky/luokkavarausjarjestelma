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
        // Strip query strings (e.g., ?id=1) from the URI
        $uri = parse_url($uri, PHP_URL_PATH);

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
