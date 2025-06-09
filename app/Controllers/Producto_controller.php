<?php

namespace App\Controllers;

use App\Models\Producto_Model;
use App\Models\Marca_Model;
use App\Models\Categoria_Model;

class Producto_controller extends BaseController
{

public function add_consulta(){

$validation = \Config\Services::validation();
$request = \Config\Services::request();

$validation->setRules(
    [
        'nombre' => 'required|max_length[150]',
         'correo' => 'required|valid_email',
         'motivo' => 'required|max_length[100]',
         'consulta' => 'required|max_length[250]|min_length[10]',
    ],
    [   // Errors
        'nombre' => [
            'required' => 'El nombre es requerido',
        ],

         'correo' => [
            'required' => 'El correo electrónico es obligatorio',
            'valid_email' => 'La dirección de correo debe ser válida'
                ],

          'motivo'   => [
            "required"      => 'El motivo es obligatorio',
            "max_length"    => 'El motivo de la consulta debe tener como máximo 100 caracteres'
                ],

        'consulta' => [
            'required' => 'La consulta es requerido',
            'min_length' =>'La consulta debe tener como mínimo 10 caracteres',
            'max_length'    => 'La consulta debe tener como máximo 200 caracteres',
        ],
    ]
);

if ($validation->withRequest($request)->run() ){

     $data = [
        'mensaje_nombre' => $request->getPost('nombre'),
        'mensaje_correo' => $request->getPost('correo'),
        'mensaje_motivo' => $request->getPost('motivo'),
        'mensaje_consulta' => $request->getPost('consulta') 
            ];

                
               $consulta->insert($data);

              return redirect()->route('contact')->with('mensaje_consulta', 'Su consulta se envió exitosamente!');
                        
                }else{

                 $data['titulo'] = 'Contacto';
                $data['validation'] = $validation->getErrors();
                return view('plantillas/encabezado', $data).view('plantillas/nav').view('contenido/contacto_view').view('plantillas/footer.php');
 

                }

        }
}