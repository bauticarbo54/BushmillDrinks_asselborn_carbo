<?php

namespace App\Controllers;

class Home extends BaseController
{
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
        return $this->renderizarConNavbar('nueva_plantilla');
    }

    public function nosotros(): string
    {
        return $this->renderizarConNavbar('quienesSomos');
    }

    public function inicio(): string
    {
        return $this->renderizarConNavbar('nueva_plantilla');
    }

    public function comercializacion(): string
    {
        return $this->renderizarConNavbar('comercializacion');
    }

    public function contacto(): string
    {
        return $this->renderizarConNavbar('contacto');
    }

    public function terminos(): string
    {
        return $this->renderizarConNavbar('terminos');
    }

    public function login(): string
    {
        return $this->renderizarConNavbar('login');
    }

    public function registro(): string
    {
        return $this->renderizarConNavbar('registro');
    }

    public function productos(): string
    {
        return $this->renderizarConNavbar('catalogo');
    }
}
