<?php

namespace App\Controllers;

use App\Models\Producto_model;
use App\Models\Marca_model;
use App\Models\Categoria_model;

class Producto_controller extends BaseController
{

    public function index()
    {
        $productoModel = new \App\Models\Producto_model();
        $productos = $productoModel
            ->select('productos.*, marca.marca_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca')
            ->where('producto_estado', 1)
            ->where('producto_oferta', 1)
            ->findAll();
        $this->renderizarConNavbar('nueva_plantilla', ['productos' => $productos]);
    }

    public function catalogo()
    {
        $productoModel = new Producto_model();

        $marca = $this->request->getGet('marca');
        $categoria = $this->request->getGet('categoria');
        $precio_max = $this->request->getGet('precio_max');

        $builder = $productoModel->builder()
            ->select('productos.*, marca.marca_nombre, categorias.categoria_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca')
            ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
            ->orderBy('categorias.categoria_nombre', 'ASC')
            ->orderBy('producto_nombre', 'ASC')
            ->where('productos.producto_estado', 1);

        if (!empty($marca)) {
            $builder->like('marca.marca_nombre', $marca);
        }

        if (!empty($categoria)) {
            $builder->like('categorias.categoria_nombre', $categoria);
        }

        if (!empty($precio_max)) {
            $builder->where('productos.producto_precio <=', $precio_max);
        }

        $data['productos'] = $builder->get()->getResultArray();
        $data['marcas'] = (new Marca_model())->findAll();
        $data['categorias'] = (new Categoria_model())->orderBy('categoria_nombre', 'ASC')->findAll();

        $navbar = 'layout/navbar';
        if (session()->has('perfil_id')) {
            if (session('perfil_id') == 1) {
                $navbar = session('modo_cliente') ? 'layout/navbarAdminVisitante' : 'layout/navbarAdmin';
            } elseif (session('perfil_id') == 2) {
                $navbar = 'layout/navbarCliente';
            }
        }

        return view($navbar, ['categorias' => $data['categorias']])
            . view('catalogo', $data)
            . view('layout/footer');
    }


    public function detalle($id)
    {
        $productoModel = new Producto_model();
        $categorias = (new Categoria_model())->orderBy('categoria_nombre', 'ASC')->findAll();
        $producto = $productoModel
            ->select('productos.*, marca.marca_nombre, categorias.categoria_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca')
            ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
            ->where('productos.id_producto', $id)
            ->where('productos.producto_estado', 1)
            ->first();

        if (!$producto) {
            return redirect()->to('/')->with('error', 'Producto no encontrado');
        }

        $navbar = 'layout/navbar';
        if (session()->has('perfil_id')) {
            if (session('perfil_id') == 1) {
                $navbar = session('modo_cliente') ? 'layout/navbarAdminVisitante' : 'layout/navbarAdmin';
            } elseif (session('perfil_id') == 2) {
                $navbar = 'layout/navbarCliente';
            }
        }

        echo view($navbar, ['categorias' => $categorias]);
        echo view('backend/detalle_bebidas', ['producto' => $producto]);
        echo view('layout/footer');
    }


    public function listarBebidas()
    {
        if (session('perfil_id') != 1) {
            return redirect()->to('/');
        }

        $categoriaModel = new Categoria_model();
        $productoModel = new Producto_model();

        // Obtener filtros desde la URL
        $categoriaId = $this->request->getGet('categoria_id');
        $busqueda = $this->request->getGet('busqueda');

        // Construcción de la consulta
        $productos = $productoModel
            ->select('productos.*, marca.marca_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca');

        if (!empty($categoriaId)) {
            $productos->where('productos.categoria_id', $categoriaId);
        }

        if (!empty($busqueda)) {
            $productos->groupStart()
                ->like('productos.producto_nombre', $busqueda)
                ->orLike('marca.marca_nombre', $busqueda)
                ->groupEnd();
        }

        $data['productos'] = $productos->findAll();
        $data['categorias'] = (new Categoria_model())->orderBy('categoria_nombre', 'ASC')->findAll();

        return view('layout/navbarAdmin', $data)
            . view('backend/listar_bebidas', $data)
            . view('layout/footer');
    }


    public function agregarBebida()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');
        $marca = new Marca_model();
        $categoria = new Categoria_model();
        $data['marcas'] = $marca->findAll();
        $data['categorias'] = (new Categoria_model())->orderBy('categoria_nombre', 'ASC')->findAll();
        $data['titulo'] = 'Agregar Bebida';
        
        return view ('layout/navbarAdmin', ['categorias' => $categoria]).view('backend/registrar_bebida', $data).view('layout/footer');
    }

   
    public function registrarBebida()
{
    if (session('perfil_id') != 1) return redirect()->to('/');

    $validation = \Config\Services::validation();
    $request = \Config\Services::request();

    // Obtener si está en oferta y el descuento
    $oferta = $request->getPost('producto_oferta');
    $descuento = $request->getPost('producto_descuento');

    // Reglas básicas
    $reglas = [
    'producto_nombre' => [
        'rules' => 'required|min_length[3]',
        'errors' => [
            'required' => 'El nombre de la bebida es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.'
        ]
    ],
    'producto_descripcion' => [
        'rules' => 'required|min_length[5]',
        'errors' => [
            'required' => 'La descripción es obligatoria.',
            'min_length' => 'La descripción debe tener al menos 5 caracteres.'
        ]
    ],
    'producto_precio' => [
        'rules' => 'required|decimal|greater_than_equal_to[0]',
        'errors' => [
            'required' => 'El precio es obligatorio.',
            'decimal' => 'El precio debe ser un número decimal.',
            'greater_than_equal_to' => 'El precio no puede ser negativo.'
        ]
    ],
    'producto_stock' => [
        'rules' => 'required|integer|greater_than_equal_to[0]',
        'errors' => [
            'required' => 'El stock es obligatorio.',
            'integer' => 'El stock debe ser un número entero.',
            'greater_than_equal_to' => 'El stock no puede ser negativo.'
        ]
    ],
    'producto_volumen' => [
        'rules' => 'required|integer|greater_than_equal_to[0]',
        'errors' => [
            'required' => 'El volumen es obligatorio.',
            'integer' => 'El volumen debe ser un número entero.',
            'greater_than_equal_to' => 'El volumen no puede ser negativo.'
        ]
    ],
    'producto_grado' => [
        'rules' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        'errors' => [
            'required' => 'El grado alcohólico es obligatorio.',
            'decimal' => 'Debe ingresar un número decimal para el grado.',
            'greater_than_equal_to' => 'El grado alcohólico no puede ser menor que 0.',
            'less_than_equal_to' => 'El grado alcohólico no puede ser mayor a 100.'
        ]
    ],
    'marca_id' => [
        'rules' => 'required|is_natural_no_zero',
        'errors' => [
            'required' => 'Debe seleccionar una marca.',
            'is_natural_no_zero' => 'La marca seleccionada no es válida.'
        ]
    ],
    
    'categoria_id' => [
        'rules' => 'required|is_natural_no_zero',
        'errors' => [
            'required' => 'Debe seleccionar una categoría.',
            'is_natural_no_zero' => 'La categoría seleccionada no es válida.'
        ]
    ],
    'producto_imagen' => [
    'rules' => 'uploaded[producto_imagen]|is_image[producto_imagen]|max_size[producto_imagen,2048]',
    'errors' => [
        'uploaded' => 'Debe subir una imagen del producto.',
        'is_image' => 'El archivo debe ser una imagen válida (jpg, png, etc.).',
        'max_size' => 'La imagen no debe superar los 2 MB.'
    ]
    ],
    'producto_oferta' => [
        'rules' => 'required|in_list[0,1]',
        'errors' => [
            'required' => 'Debe indicar si el producto está en oferta.',
            'in_list' => 'Opción de oferta no válida.'
        ]
    ]
];

    // Regla condicional para descuento
    if ($oferta == '1') {
    $reglas['producto_descuento'] = [
        'rules' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[100]',
        'errors' => [
            'required' => 'Debe ingresar un porcentaje de descuento.',
            'integer' => 'El porcentaje de descuento debe ser un número entero.',
            'greater_than_equal_to' => 'El descuento debe ser al menos 1%.',
            'less_than_equal_to' => 'El descuento no puede superar el 100%.'
        ]
    ];
} else {
    $reglas['producto_descuento'] = [
        'rules' => 'permit_empty|integer|greater_than_equal_to[1]|less_than_equal_to[100]',
        'errors' => [
            'integer' => 'El porcentaje de descuento debe ser un número entero válido.',
            'greater_than_equal_to' => 'El descuento debe ser al menos 1%.',
            'less_than_equal_to' => 'El descuento no puede superar el 100%.'
        ]
    ];
}

    $validation->setRules($reglas);

    if (!$validation->withRequest($request)->run()) {
        $data['validation'] = $validation->getErrors();
        $data['marcas'] = (new Marca_model())->findAll();
        $data['categorias'] = (new Categoria_model())->orderBy('categoria_nombre', 'ASC')->findAll();
        return view('layout/navbarAdmin')
            . view('backend/registrar_bebida', $data)
            . view('layout/footer');
    }

    $img = $request->getFile('producto_imagen');
    $nombre_aleatorio = $img->getRandomName();
    $img->move(ROOTPATH . 'assets/upload', $nombre_aleatorio);

    $precio = $request->getPost('producto_precio');

    $precio_oferta = null;
    if ($oferta == '1' && $descuento > 0 && $descuento <= 100) {
        $precio_oferta = round($precio * (1 - $descuento / 100), 2);
    }

    $data = [
        'producto_nombre' => $request->getPost('producto_nombre'),
        'producto_descripcion' => $request->getPost('producto_descripcion'),
        'producto_precio' => $precio,
        'producto_oferta_precio' => $precio_oferta,
        'producto_stock' => $request->getPost('producto_stock'),
        'producto_imagen' => $nombre_aleatorio,
        'marca_id' => $request->getPost('marca_id'),
        'producto_volumen' => $request->getPost('producto_volumen'),
        'producto_grado' => $request->getPost('producto_grado'),
        'categoria_id' => $request->getPost('categoria_id'),
        'producto_oferta' => ($oferta == '1') ? 1 : 0
    ];

    $bebida = new Producto_model();
    $bebida->insert($data);

    return redirect()->to('agregar_bebida')->with('mensaje', "La bebida se registró correctamente!");
}



    public function editar($id)
    {
        if (session('perfil_id') != 1) return redirect()->to('/');
        $productoModel = new Producto_model();
        $marcaModel = new Marca_model();
        $categoriaModel = new Categoria_model();

        $producto = $productoModel->find($id);

        if (!$producto) {
            return redirect()->to(base_url('listar_bebidas'))->with('mensaje', 'Producto no encontrado.');
        }

        return view('layout/navbarAdmin', ['categorias' => $categoriaModel ->findAll()]).view('backend/registrar_bebida', [
            'producto' => $producto,
            'marcas' => $marcaModel->findAll(),
            'categorias' => $categoriaModel->orderBy('categoria_nombre', 'ASC')->findAll(),
            'validation' => []
        ]).view('layout/footer');
    }


    public function eliminar($id)
    {
        if (session('perfil_id') != 1) return redirect()->to('/');

        (new Producto_model())->delete($id);

        return redirect()->to('listar_bebidas')->with('mensaje', 'Producto eliminado correctamente.');
    }

    public function deshabilitar($id)
{
        if (session('perfil_id') != 1) return redirect()->to('/');
        $productoModel = new Producto_model();
        $productoModel->update($id, ['producto_estado' => 0]);
        session()->setFlashdata('mensaje', 'La bebida fue deshabilitada correctamente.');
        session()->setFlashdata('tipo_mensaje', 'warning'); // puede ser success, danger, info, warning
        return redirect()->to('gestionar_bebidas');
    }

    public function habilitar($id)
    {
        if (session('perfil_id') != 1) return redirect()->to('/');
        $productoModel = new Producto_model();
        $productoModel->update($id, ['producto_estado' => 1]);
        session()->setFlashdata('mensaje', 'La bebida fue habilitada correctamente.');
        session()->setFlashdata('tipo_mensaje', 'success'); // puede ser success, danger, info, warning
        return redirect()->to('gestionar_bebidas');
    }

    public function gestionarBebidas()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');

        $productoModel = new \App\Models\Producto_model();
        $categoriaModel = new \App\Models\Categoria_model();

        $busqueda = $this->request->getGet('busqueda');
        $categoriaSeleccionada = $this->request->getGet('categoria');

        $productoModel
            ->select('productos.*, marca.marca_nombre, categorias.categoria_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca')
            ->join('categorias', 'productos.categoria_id = categorias.id_categoria');

        if ($busqueda) {
            $productoModel->groupStart()
                ->like('productos.producto_nombre', $busqueda)
                ->orLike('marca.marca_nombre', $busqueda)
                ->groupEnd();
        }

        if ($categoriaSeleccionada) {
            $productoModel->where('productos.categoria_id', $categoriaSeleccionada);
        }

        $productos = $productoModel->findAll();
        $categorias = $categoriaModel->orderBy('categoria_nombre', 'ASC')->findAll();

        return view('layout/navbarAdmin', ['categorias' => $categorias])
            . view('backend/gestionar_bebidas', [
                'productos' => $productos,
                'categorias' => $categorias,
                'busqueda' => $busqueda,
                'categoriaSeleccionada' => $categoriaSeleccionada
            ])
            . view('layout/footer');
    }

    public function actualizarBebida($id)
{
    helper(['form', 'url']);
    if (session('perfil_id') != 1) return redirect()->to('/');

    $productoModel = new Producto_model();
    $producto = $productoModel->find($id);

    if (!$producto) {
        return redirect()->to('gestionar_bebidas')->with('mensaje', 'Producto no encontrado.');
    }

    // Obtener valores antes de validar
    $request = \Config\Services::request();
    $oferta = $request->getPost('producto_oferta');
    $descuento = $request->getPost('producto_descuento');

    // Reglas comunes
    $reglas = [
    'producto_nombre' => [
        'rules' => 'required|min_length[3]',
        'errors' => [
            'required' => 'El nombre de la bebida es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.'
        ]
    ],
    'producto_descripcion' => [
        'rules' => 'required|min_length[5]',
        'errors' => [
            'required' => 'La descripción es obligatoria.',
            'min_length' => 'La descripción debe tener al menos 5 caracteres.'
        ]
    ],
    'producto_precio' => [
        'rules' => 'required|decimal|greater_than_equal_to[0]',
        'errors' => [
            'required' => 'El precio es obligatorio.',
            'decimal' => 'El precio debe ser un número decimal.',
            'greater_than_equal_to' => 'El precio no puede ser negativo.'
        ]
    ],
    'producto_stock' => [
        'rules' => 'required|integer|greater_than_equal_to[0]',
        'errors' => [
            'required' => 'El stock es obligatorio.',
            'integer' => 'El stock debe ser un número entero.',
            'greater_than_equal_to' => 'El stock no puede ser negativo.'
        ]
    ],
    'producto_volumen' => [
        'rules' => 'required|integer|greater_than_equal_to[0]',
        'errors' => [
            'required' => 'El volumen es obligatorio.',
            'integer' => 'El volumen debe ser un número entero.',
            'greater_than_equal_to' => 'El volumen no puede ser negativo.'
        ]
    ],
    'producto_grado' => [
        'rules' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        'errors' => [
            'required' => 'El grado alcohólico es obligatorio.',
            'decimal' => 'Debe ingresar un número decimal para el grado.',
            'greater_than_equal_to' => 'El grado alcohólico no puede ser menor que 0.',
            'less_than_equal_to' => 'El grado alcohólico no puede ser mayor a 100.'
        ]
    ],
    'producto_imagen' => [
    'rules' => 'permit_empty|is_image[producto_imagen]|max_size[producto_imagen,2048]',
    'errors' => [
        'is_image' => 'El archivo debe ser una imagen válida.',
        'max_size' => 'La imagen no debe superar los 2 MB.'
    ]
    ],
    'producto_oferta' => [
        'rules' => 'required|in_list[0,1]',
        'errors' => [
            'required' => 'Debe indicar si el producto está en oferta.',
            'in_list' => 'Opción de oferta no válida.'
        ]
    ]
];


    // Regla condicional para descuento
    if ($oferta == '1') {
    $reglas['producto_descuento'] = [
        'rules' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[100]',
        'errors' => [
            'required' => 'Debe ingresar un porcentaje de descuento.',
            'integer' => 'El porcentaje de descuento debe ser un número entero.',
            'greater_than_equal_to' => 'El descuento debe ser al menos 1%.',
            'less_than_equal_to' => 'El descuento no puede superar el 100%.'
        ]
    ];
} else {
    $reglas['producto_descuento'] = [
        'rules' => 'permit_empty|integer|greater_than_equal_to[1]|less_than_equal_to[100]',
        'errors' => [
            'integer' => 'El porcentaje de descuento debe ser un número entero válido.',
            'greater_than_equal_to' => 'El descuento debe ser al menos 1%.',
            'less_than_equal_to' => 'El descuento no puede superar el 100%.'
        ]
    ];
}


    // Validar
    if (! $this->validate($reglas)) {
        $data['validation'] = $this->validator->getErrors();
        $data['producto'] = $producto;
        $data['marcas'] = (new Marca_model())->findAll();
        $data['categorias'] = (new Categoria_model())->orderBy('categoria_nombre', 'ASC')->findAll();
        return view('layout/navbarAdmin')
            . view('backend/registrar_bebida', $data)
            . view('layout/footer');
    }

    $precio = (float) $request->getPost('producto_precio');

    $precio_oferta = null;
    if ($oferta == '1' && $descuento > 0 && $descuento <= 100) {
        $precio_oferta = round($precio * (1 - $descuento / 100), 2);
    }

    $datos = [
        'producto_nombre' => $request->getPost('producto_nombre'),
        'producto_descripcion' => $request->getPost('producto_descripcion'),
        'producto_precio' => $precio,
        'producto_stock' => $request->getPost('producto_stock'),
        'producto_volumen' => $request->getPost('producto_volumen'),
        'producto_grado' => $request->getPost('producto_grado'),
        'marca_id' => $request->getPost('marca_id'),
        'categoria_id' => $request->getPost('categoria_id'),
        'producto_oferta' => ($oferta == '1') ? 1 : 0,
        'producto_oferta_precio' => $precio_oferta
    ];

    // Imagen nueva (opcional)
    $imagen = $request->getFile('producto_imagen');
    if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
        $nombreImagen = $imagen->getRandomName();
        $imagen->move('assets/upload', $nombreImagen);

        // Eliminar imagen anterior si existe
        if (!empty($producto['producto_imagen']) && file_exists('assets/upload/' . $producto['producto_imagen'])) {
            unlink('assets/upload/' . $producto['producto_imagen']);
        }

        $datos['producto_imagen'] = $nombreImagen;
    }

    // Actualizar producto
    $productoModel->update($id, $datos);

    return redirect()->to('gestionar_bebidas')->with('mensaje', 'Producto actualizado correctamente.');
}



    public function ofertas()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');
            $productoModel = new Producto_model();
            $categoriaModel = new Categoria_model();
            $categorias = $categoriaModel->orderBy('categoria_nombre', 'ASC')->findAll();
            $productosOferta = $productoModel
                ->select('productos.*, marca.marca_nombre')
                ->join('marca', 'productos.marca_id = marca.id_marca')
                ->where('producto_estado', 1)
                ->where('producto_oferta', 1)
                ->findAll();

        return view('layout/navbarAdmin', ['categorias' => $categorias])
            . view('ofertas', ['productos' => $productosOferta])
            . view('layout/footer');
    }

}
