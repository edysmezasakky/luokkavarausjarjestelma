<?php

namespace App\Controllers;

use App\Flash;
use App\View;

class HelloController
{

    public function showHelloForm()
    {
        View::render('hello');
    }


    public function sayHello()
    {
        Flash::make('success', 'Hello ' . $_POST['name']);
        View::render('hello');
    }
}
