<?php

namespace App\Controllers;

class Home extends BaseController
{
    /*Función que permite determinar si se usará el navbar de visitante o el navbar de cliente */
    private function obtenerNavbar(): string
    {
        $perfil = session()->get('perfil_id');

        if (session()->get('logueado') && $perfil == 2) {
                return 'layout/navbarCliente';
        } 
        else{
            return 'layout/navbar'; 
        }
    }

    public function index(): string
    {
        return view($this->obtenerNavbar()).view('nueva_plantilla').view('layout/footer');
    }

    public function nosotros(): string
    {
        return view($this->obtenerNavbar()).view('quienesSomos').view('layout/footer');
    }

    public function inicio(): string
    {
        return view($this->obtenerNavbar()).view('nueva_plantilla').view('layout/footer');
    }

    public function comercializacion(): string
    {
        return view($this->obtenerNavbar()).view('comercializacion').view('layout/footer');
    }

    public function contacto(): string
    {
        return view($this->obtenerNavbar()).view('contacto').view('layout/footer');
    }
    
    public function terminos(): string
    {
        return view($this->obtenerNavbar()).view('terminos').view('layout/footer');
    }
    
    public function login(): string
    {
        return view($this->obtenerNavbar()).view('login').view('layout/footer');
    }

    public function registro(): string
    {
        return view($this->obtenerNavbar()).view('registro').view('layout/footer');
    }

    public function productos(): string
    {
        return view($this->obtenerNavbar()).view('productos').view('layout/footer');
    }

}

