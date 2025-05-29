<?php

namespace App\Controllers;

use App\Models\contactoform_model;

class contacto_controller extends BaseController{

    public function add_mensaje(){

        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'mensaje_nombre' => 'required|max_length[150]',
                'mensaje_mail' => 'required|valid_email',
                'mensaje_telefono' => 'required|max_length[50]',
                'mensaje_consulta' => 'required|max_length[250]|min_length[10]',
            ],
            [   // Errors
                'mensaje_nombre' => [
                    'required' => 'El nombre es requerido',
                ],

                'mensaje_mail' => [
                    'required' => 'El correo electrónico es obligatorio',
                    'valid_email' => 'La dirección de correo debe ser válida'
                        ],

                'mensaje_telefono'   => [
                    "required"      => 'El telefono es obligatorio',
                        ],

                'mensaje_consulta' => [
                    'required' => 'El comentario es requerido',
                    'min_length' =>'El comentario debe tener como mínimo 10 caracteres',
                    'max_length'    => 'El comentario debe tener como máximo 200 caracteres',
                ],
            ]
        );

        if ($validation->withRequest($request)->run() ){

            $data = [
            'mensaje_nombre' => $request->getPost('mensaje_nombre'),
            'mensaje_mail' => $request->getPost('mensaje_mail'),
            'mensaje_telefono' => $request->getPost('mensaje_telefono'),
            'mensaje_consulta' => $request->getPost('mensaje_consulta') 
            ];

            $consulta = new Contactoform_model();
            $consulta->insert($data);

            /*return redirect()->route('contact')->with('comentario', 'Su consulta se envió exitosamente!');*/
            return /*view('plantillas/encabezado', $data).*/view('layout/navbar').view('contacto').view('layout/footer');
                                
        }else{

            $data['titulo'] = 'Contacto';
            $data['validation'] = $validation->getErrors();
            return /*view('plantillas/encabezado', $data).*/view('layout/navbar').view('contacto').view('layout/footer');
        

        }

    }
}
