<?php

namespace App\Controllers;

use App\Auth;
use App\View;

class ClassController
{
    public function create()
    {
        Auth::requireAdmin();

        // If we pass, show the form
        View::render('admin/create_class');
    }

    public function store()
    {
        Auth::requireAdmin();

        // ... logic to save the new class to DB ...
    }
}
