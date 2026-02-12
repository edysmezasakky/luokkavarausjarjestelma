<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ClassController;

// Define Routes (The Map)
// Format: URL -> [Controller Class, Method Name]


// public routes
$router->get('/', [AuthController::class, 'showLoginForm']);
$router->get('/login', [AuthController::class, 'showLoginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/register', [AuthController::class, 'showRegisterForm']);
$router->post('/register', [AuthController::class, 'register']);


// student routes
$router->get('/dashboard', [DashboardController::class, 'index']);

// admin routes
$router->get('/admin/classes/create', [ClassController::class, 'create']);
$router->post('/admin/classes', [ClassController::class, 'store']);
