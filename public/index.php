<?php


// 1. Load Bootstrap (Autoload + .env + Session)
require_once __DIR__ . '/../bootstrap.php';

use App\Router;

// You'd need to create this too

// 1. Initialize the Router
$router = new Router();


// 2. Load the Routes
// The $router variable is automatically available inside routes.php
require_once __DIR__ . '/../routes.php';

// 4. Dispatch (Run the app)
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);
