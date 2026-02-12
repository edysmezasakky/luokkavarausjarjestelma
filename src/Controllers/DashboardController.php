<?php

namespace App\Controllers;

use App\Auth;
use App\View;

class DashboardController
{
    public function index()
    {
        Auth::requireLogin();

        // Example of passing user data
        $user = ['name' => 'Alex', 'role' => 'Admin']; // Pretend this came from DB

        View::render('dashboard', [
            'user' => $user,
        ]);
    }
}
