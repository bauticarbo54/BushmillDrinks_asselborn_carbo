<?php

namespace App\Controllers;

use App\Models\Mensajes_model;
use App\Models\Usuario_model;

class Usuario_controller extends BaseController
{

    public function registro()
    {
        return view('registro');
    }

    public function add_cliente()
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'nombre' => 'required|max_length[50]',
                'apellido' => 'required|max_length[50]',
                'usuario' => 'required|max_length[20]',
                'email' => 'required|valid_email|max_length[100]',
                'pass' => 'required|max_length[100]',
                /*'perfil_id' => 'required|max_length[11]',
                'baja' => 'required|max_length[2]',*/
            ],
            [   // Errores
                'nombre' => [
                    'required' => 'El nombre es requerido',
                ],

                'apellido' => [
                    'required' => 'El apellido es requerido',
                ],

                'email' => [
                    'required' => 'El correo electrónico es obligatorio',
                    'valid_email' => 'La dirección de correo debe ser válida'
                ],

                'pass'   => [
                    "required"      => 'La contraseña es requerida',
                    "max_length"    => 'La contraseña no debe superar los 100 caracteres'
                ],
                /*
                'perfil_id' => [
                    'required' => 'El tipo de perfil es requerido',
                ],

                'baja' => [
                    'required' => 'No debe superar 2 caracteres',
                ],*/
            ]
        );

        if ($validation->withRequest($request)->run() ){
            $data = [
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'usuario' => $this->request->getPost('usuario'),
                    'email' => $this->request->getPost('email'),
                    'pass' => password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT),
                    'perfil_id' => $this->request->getPost('perfil_id'),
                    'baja' => 'no'
            ];

                    $usuarioModel = new Usuario_model();
                    $usuarioModel->insert($data);

                    session()->set([
                        'id_usuario' => $usuarioModel->getInsertID(),
                        'nombre'     => $data['nombre'],
                        'usuario'    => $data['usuario'],
                        'perfil_id'  => $data['perfil_id'],
                        'logueado'   => true
                    ]);
                    return redirect()->to('/');
                        
        }
        else{
            $data['titulo'] = 'Contacto';
            $data['validation'] = $validation->getErrors();
            return view('layout/navbar', $data).view('registro').view('layout/footer');
        }
    }

    public function logout()
    {
        session()->destroy(); 
        return redirect()->to('/'); 
    }

    public function edit($id)
    {
        $usuariosModel = new Usuario_model();
        $data['usuario'] = $usuariosModel->find($id);
        return view('usuarios/edit', $data);
    }

    public function update($id)
    {
        $usuariosModel = new Usuario_model();
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'usuario' => $this->request->getPost('usuario'),
            'email' => $this->request->getPost('email'),
            'perfil_id' => $this->request->getPost('perfil_id'),
            'baja' => $this->request->getPost('baja')
        ];
        $usuariosModel->update($id, $data);
        return view('layout/navbarCliente', $data).view('nueva_plantilla').view('layout/footer');
    }

    public function delete($id)
    {
        $usuariosModel = new Usuario_model();
        $usuariosModel->delete($id);
        return redirect()->to('/usuarios');
    }

    public function add_consulta()
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        $validation->setRules(
            [
                'mensaje_nombre' => 'required|max_length[50]',
                'mensaje_mail' => 'required|valid_email|max_length[50]',
                'mensaje_telefono' => 'required|max_length[50]',
                'mensaje_consulta' => 'required|max_length[250]|min_length[10]',
            ],
            [   // Errores
                'mensaje_nombre' => [
                    'required' => 'El nombre es requerido',
                ],

                'mensaje_mail' => [
                    'required' => 'El correo electrónico es obligatorio',
                    'valid_email' => 'La dirección de correo debe ser válida'
                ],

                'mensaje_telefono'   => [
                    "required"      => 'El telefono es obligatorio',
                    "max_length"    => 'El telefono no debe superar los 50 caracteres'
                    ],

                'mensaje_consulta' => [
                    'required' => 'La consulta es requerida',
                    'min_length' =>'La consulta debe tener como mínimo 10 caracteres',
                    'max_length'    => 'La consulta debe tener como máximo 250 caracteres',
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

                    $mensajesModel = new Mensajes_model();
                    $mensajesModel->insert($data);

                    return redirect()->route('contacto')->with('mensaje_exito', 'Su consulta se envió exitosamente!');
                        
        }
        else{
            $data['titulo'] = 'Contacto';
            $data['validation'] = $validation->getErrors();
            return view('layout/navbar', $data).view('contacto').view('layout/footer');
        }

    }
}