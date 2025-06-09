<?php

namespace App\Controllers;

use App\Models\Mensajes_model;

class Mensaje_controller extends BaseController
{

    public function add_consulta()
    {
        // Cargar modelo Mensajes_model
        $mensajeModel = new \App\Models\Mensajes_model();

        // Obtener datos enviados por POST
        $data = [
            'mensaje_nombre'   => $this->request->getPost('mensaje_nombre'),
            'mensaje_mail'     => $this->request->getPost('mensaje_mail'),
            'mensaje_telefono' => $this->request->getPost('mensaje_telefono'),
            'mensaje_consulta' => $this->request->getPost('mensaje_consulta'),
        ];

        // Guardar en la base de datos
        $mensajeModel->insert($data);

        // Redirigir o mostrar mensaje
        return redirect()->to('/contacto')->with('mensaje', 'Consulta enviada correctamente');
    }

    public function verConsultas()
        {
            if (session('perfil_id') != 1) return redirect()->to('/');
            $mensajeModel = new Mensajes_model();
            $mensajes = $mensajeModel->findAll();

            return view('layout/navbarAdmin')
                  .view('ver_consultas', ['mensajes' => $mensajes])
                  .view('layout/footer');
        }
}
