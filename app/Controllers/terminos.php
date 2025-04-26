<?php

namespace App\Controllers;

class terminos extends BaseController{
    public function index(): string
    {
        return view('terminos.php');
    }
}