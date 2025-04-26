<?php

namespace App\Controllers;

class comercializacion extends BaseController{
    public function index(): string
    {
        return view('comercializacion.php');
    }
}