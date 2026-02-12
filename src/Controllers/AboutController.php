<?php

namespace App\Controllers;

use App\View;

class AboutController
{

    public function index()
    {
        View::render('about');
    }
}
