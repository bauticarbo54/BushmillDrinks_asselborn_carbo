<?php

namespace App\Controllers;

class quienesSomos extends BaseController{
    public function index(): string
    {
        return view('quienesSomos.php');
    }
}