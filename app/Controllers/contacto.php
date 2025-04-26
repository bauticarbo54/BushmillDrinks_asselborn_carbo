<?php

namespace App\Controllers;

class contacto extends BaseController{
    public function index(): string
    {
        return view('contacto.php');
    }
}