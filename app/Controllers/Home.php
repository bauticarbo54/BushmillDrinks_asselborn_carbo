<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('layout/navbar').view('nueva_plantilla').view('layout/footer');
    }

    public function nosotros(): string
    {
        return view('layout/navbar').view('quienesSomos').view('layout/footer');
    }

    public function inicio(): string
    {
        return view('layout/navbar').view('nueva_plantilla').view('layout/footer');
    }

    public function comercializacion(): string
    {
        return view('layout/navbar').view('comercializacion').view('layout/footer');
    }

    public function contacto(): string
    {
        return view('layout/navbar').view('contacto').view('layout/footer');
    }
    
    public function terminos(): string
    {
        return view('layout/navbar').view('terminos').view('layout/footer');
    }
    
    public function login(): string
    {
        return view('layout/navbar').view('login').view('layout/footer');
    }

    public function registro(): string
    {
        return view('layout/navbar').view('registro').view('layout/footer');
    }

    public function productos(): string
    {
        return view('layout/navbar').view('productos').view('layout/footer');
    }

}

