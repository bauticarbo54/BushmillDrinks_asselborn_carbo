<?php

namespace App\Controllers;

use App\Models\Mensajes_model;
use App\Models\Usuario_model;
use App\Models\Categoria_model;

class Usuario_controller extends BaseController
{

    public function index()
    {
        $this->renderizarConNavbar('nueva_plantilla');
    }


    public function add_cliente()
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules(
            [
                'nombre' => 'required|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
                'apellido' => 'required|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
                'usuario' => 'required|max_length[20]|is_unique[usuarios.usuario]',
                'email' => 'required|valid_email|max_length[100]|is_unique[usuarios.email]',
                'pass' => 'required|min_length[5]|max_length[100]',
            ],
            [   // Errores
                'nombre' => [
                    'required' => 'El nombre es requerido',
                    'regex_match'  => 'El nombre solo puede contener letras y espacios',
                ],

                'apellido' => [
                    'required' => 'El apellido es requerido',
                    'regex_match'  => 'El apellido solo puede contener letras y espacios',
                ],

                'usuario' => [
                    'required' => 'El usuario es requerido',
                    'max_length'  => 'El usuario no puede contener mas de 20 caracteres',
                    'is_unique' => 'El nombre de usuario no esta disponible',
                ],

                'email' => [
                    'required' => 'El correo electrónico es obligatorio',
                    'valid_email' => 'La dirección de correo debe ser válida',
                    'is_unique' => 'Ya existe una cuenta con este correo electronico'
                ],

                'pass'   => [
                    "required"      => 'La contraseña es requerida',
                    "max_length"    => 'La contraseña no debe superar los 100 caracteres',
                    "min_length" => 'La contraseña debe tener al menos 5 caracteres',
                ],
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
        else {
            $data['titulo'] = 'Contacto';
            $data['validation'] = $validation; // PASÁS EL OBJETO, no el array
            return view('layout/navbar', $data) . view('registro', $data) . view('layout/footer');
        }

    }

    public function login()
{
    $validation = \Config\Services::validation();
    $request = \Config\Services::request();

    $validation->setRules([
        'email' => 'required|valid_email',
        'password' => 'required'
    ], [
        'email' => [
            'required' => 'El correo electrónico es obligatorio',
            'valid_email' => 'Debe ingresar un correo válido'
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria'
        ]
    ]);

    if (!$validation->withRequest($request)->run()) {
        return view('layout/navbar').view('login', [
            'validation' => $validation
        ]).view('layout/footer');
    }

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $usuarioModel = new \App\Models\Usuario_model();
    $usuario = $usuarioModel->where('email', $email)->first();

    if ($usuario && password_verify($password, $usuario['pass'])) {
        if ($usuario['baja'] === 'si') {
            return redirect()->to('/login')->with('error', 'Su cuenta está suspendida. Contacte al administrador.');
        }

        session()->set([
            'id_usuario' => $usuario['id_usuario'],
            'nombre'     => $usuario['nombre'],
            'usuario'    => $usuario['usuario'],
            'perfil_id'  => $usuario['perfil_id'],
            'logueado'   => true
        ]);

        return redirect()->to('/');
    } else {
        return redirect()->to('/login')->with('error', 'Correo o contraseña inválidos.');
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

    public function listarUsuarios()
    {
        if (session('perfil_id') != 1) {
            return redirect()->to('/');
        }
        $usuarioModel = new Usuario_model();
        $perfil = $this->request->getGet('perfil');
        $email = $this->request->getGet('email');

        $query = $usuarioModel;

        if (!empty($perfil)) {
            $query = $query->where('perfil_id', $perfil);
        }

        if (!empty($email)) {
            $query = $query->like('email', $email);
        }

        $data['usuarios'] = $query->findAll();

        return view('layout/navbarAdmin')
            . view('backend/listar_usuarios', $data)
            . view('layout/footer');
    }


    public function suspenderUsuario($id)
    {
        if (session('perfil_id') != 1) {
            return redirect()->to('/');
        }
        $usuarioModel = new Usuario_model();
        $usuarioModel->update($id, ['baja' => 'si']);
        return redirect()->to('/usuarios');
    }

    public function habilitarUsuario($id)
    {
        if (session('perfil_id') != 1) {
            return redirect()->to('/');
        }
        $usuarioModel = new Usuario_model();
        $usuarioModel->update($id, ['baja' => 'no']);
        return redirect()->to('/usuarios');
    }

    public function cambiarTipo($id)
    {
        if (session('perfil_id') != 1) {
            return redirect()->to('/');
        }
        $usuarioModel = new Usuario_model();
        $usuario = $usuarioModel->find($id);
    
        // Cambiar entre admin (1) y usuario (2)
        $nuevoTipo = ($usuario['perfil_id'] == 1) ? 2 : 1;
        $usuarioModel->update($id, ['perfil_id' => $nuevoTipo]);
        return redirect()->to('/usuarios');
    }

    public function eliminarUsuario($id)
    {
        if (session('perfil_id') != 1) {
            return redirect()->to('/');
        }
        // Evita que un admin se elimine a sí mismo
        if (session('id_usuario') == $id) {
            return redirect()->to('/usuarios')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuarioModel = new Usuario_model();
        $usuarioModel->delete($id);
        return redirect()->to('/usuarios');
    }

    public function editar_perfil()
    {
        $usuarioModel = new \App\Models\Usuario_model();
        $id = session('id_usuario');
        $usuario = $usuarioModel->find($id);

        return view('layout/navbarCliente')
            . view('backend/editar_perfil', ['usuario' => $usuario])
            . view('layout/footer');
    }

    public function actualizar_perfil()
    {
        $session = session();
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $usuarioModel = new \App\Models\Usuario_model();

        $id_usuario = $request->getPost('id_usuario');
        $nombre     = trim($request->getPost('nombre'));
        $apellido   = trim($request->getPost('apellido'));
        $usuario    = trim($request->getPost('usuario'));
        $email      = trim($request->getPost('email'));
        $pass       = $request->getPost('pass');

        // Reglas de validación
        $validation->setRules([
            'nombre'   => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            'apellido' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            'usuario'  => 'required|min_length[3]|max_length[30]',
            'email'    => 'required|valid_email',
            'pass'     => 'permit_empty|min_length[5]|max_length[100]',
        ],
        [   // Mensajes personalizados
            'nombre' => [
                'required' => 'El nombre es obligatorio',
                'regex_match' => 'El nombre solo debe contener letras y espacios',
            ],
            'apellido' => [
                'required' => 'El apellido es obligatorio',
                'regex_match' => 'El apellido solo debe contener letras y espacios',
            ],
            'usuario' => [
                'required'    => 'El nombre de usuario es obligatorio',
                'min_length'  => 'El nombre de usuario no debe ser menor a 3 caracteres',
                'max_length'  => 'El nombre de usuario no debe superar los 30 caracteres'
            ],
            'email' => [
                'required'     => 'El correo electrónico es obligatorio',
                'valid_email'  => 'La dirección de correo debe ser válida'
            ],
            'pass' => [
                'min_length'   => 'La contraseña debe tener al menos 5 caracteres',
                'max_length'   => 'La contraseña no debe superar los 100 caracteres'
            ],
        ]);

        if ($validation->withRequest($request)->run()) {

            // Verificar si el usuario ya existe
            $existeUsuario = $usuarioModel->where('usuario', $usuario)
                                          ->where('id_usuario !=', $id_usuario)
                                          ->first();
            if ($existeUsuario) {
                $data['error'] = 'El nombre de usuario ya está en uso.';
                $data['validation'] = [];
                $data['usuario'] = $usuarioModel->find($id_usuario);
                return view('layout/navbarCliente', $data)
                    .view('backend/editar_perfil', $data)
                    .view('layout/footer');
            }

            $existeEmail = $usuarioModel->where('email', $email)
                                        ->where('id_usuario !=', $id_usuario)
                                        ->first();
            if ($existeEmail) {
                $data['error'] = 'El correo electrónico ya está registrado.';
                $data['validation'] = [];
                $data['usuario'] = $usuarioModel->find($id_usuario);
                return view('layout/navbarCliente', $data)
                    .view('backend/editar_perfil', $data)
                    .view('layout/footer');
            }

            // Preparar datos
            $datosActualizar = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'email' => $email,
            ];

            if (!empty($pass)) {
                $datosActualizar['pass'] = password_hash($pass, PASSWORD_DEFAULT);
            }

            $usuarioModel->update($id_usuario, $datosActualizar);
            $session->set([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'email' => $email,  
                ]);
            return redirect()->to('editar_perfil')->with('success', 'Perfil actualizado correctamente.');

        } else {
            $data['validation'] = $validation->getErrors();
            $data['usuario'] = $usuarioModel->find($id_usuario);
            $data['categorias'] = (new Categoria_model())->orderBy('categoria_nombre', 'ASC')->findAll();
            return view('layout/navbarCliente', $data)
                .view('backend/editar_perfil', $data)
                .view('layout/footer');
        }
    }

}