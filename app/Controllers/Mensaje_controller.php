<?php

namespace App\Controllers;

use App\Models\Mensajes_model;

class Mensaje_controller extends BaseController
{   

    protected $helpers = ['form'];  
    
    public function add_consulta()
    {
        // Cargar modelo Mensajes_model
        $mensajeModel = new \App\Models\Mensajes_model();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'mensaje_nombre' => 'required|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            'mensaje_mail' => 'required|valid_email|max_length[100]',
            'mensaje_telefono' => 'permit_empty|regex_match[/^\+?[0-9\s\-\(\)]{7,20}$/]',
            'mensaje_consulta' => 'required|max_length[254]|min_length[10]',
        ],
        [   // Errores
            'mensaje_nombre' => [
                    'required' => 'El nombre es obligatorio',
                    'regex_match'  => 'El nombre solo puede contener letras y espacios',
            ],
            'mensaje_mail' => [
                'required' => 'El correo electrónico es obligatorio',
                'valid_email' => 'La dirección de correo debe ser válida',
            ],
            'mensaje_telefono' => [
                'required' => 'El telefono es obligatorio',
                'regex_match' => 'El teléfono solo puede contener números, espacios, paréntesis, guiones y un símbolo "+" opcional.',
            ],
            'mensaje_consulta' => [
                'required' => 'El mensaje es obligatorio',
                'min_length' => 'El mensaje es muy corto',
            ],
        ],
        );
        
        // Validar
        if (!$validation->withRequest($this->request)->run()) {
            // Devolver la vista con los errores
            return view('layout/navbar').view('contacto', [
                'validation' => $validation]).view('layout/footer');
        }


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

    public function eliminarConsulta($id)
    {
        $mensajesModel = new Mensajes_model();
        $mensajesModel->delete($id);
        return redirect()->to('/ver_consultas')->with('mensaje', 'Consulta eliminada exitosamente.');
    }
}
