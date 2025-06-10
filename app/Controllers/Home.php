<?php

namespace App\Controllers;

class Home extends BaseController
{
    /*Función que permite determinar si se usará el navbar de visitante o el navbar de cliente */
    private function obtenerNavbar(): string
{
    $perfil = session()->get('perfil_id');

    if (session()->get('logueado')) {
        if ($perfil == 1) {
            // Admin en modo cliente
            if (session()->get('modo_cliente')) {
                return 'layout/navbarAdminVisitante';
            }
            // Admin en modo normal
            return 'layout/navbarAdmin';
        } elseif ($perfil == 2) {
            return 'layout/navbarCliente';
        }
    }

    return 'layout/navbar'; // Navbar visitante
}


    public function verComoCliente()
    {
        if (session()->get('perfil_id') == 1) {
            session()->set('modo_cliente', true);
        }

        return redirect()->to('/');
    }

    public function volverAModoAdmin()
    {
        if (session()->get('perfil_id') == 1) {
            session()->remove('modo_cliente');
        }

        return redirect()->to('/');
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
        return view($this->obtenerNavbar()).view('catalogo').view('layout/footer');
    }

}

