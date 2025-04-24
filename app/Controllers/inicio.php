<?php

namespace App\Controllers;

class inicio extends BaseController
{
    public function index(): string
    {
        return view('nueva_plantilla.php');
    }
}