<?php

namespace App\Controllers;

use App\Models\Producto_model;
use App\Models\Marca_model;
use App\Models\Categoria_model;

class Producto_controller extends BaseController
{
    public function catalogo()
    {
        $productoModel = new Producto_model();

        $marca = $this->request->getGet('marca');
        $categoria = $this->request->getGet('categoria');
        $precio_max = $this->request->getGet('precio_max');

        $builder = $productoModel->builder()
            ->select('productos.*, marca.marca_nombre, categorias.categoria_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca')
            ->join('categorias', 'productos.categoria_id = categorias.id_categoria');

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
        $data['categorias'] = (new Categoria_model())->findAll();

        $navbar = 'layout/navbar'; // Por defecto (visitante)
        if (session()->has('perfil_id')) {
            $navbar = (session('perfil_id') == 1) ? 'layout/navbarAdmin' : 'layout/navbarCliente';
        }

        return view($navbar)
            . view('catalogo', $data)
            . view('layout/footer');
    }

    public function detalle($id)
{
    $productoModel = new Producto_model();
    $producto = $productoModel
        ->select('productos.*, marca.marca_nombre, categorias.categoria_nombre')
        ->join('marca', 'productos.marca_id = marca.id_marca')
        ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
        ->where('productos.id_producto', $id)
        ->first();

    if (!$producto) {
        return redirect()->to('/')->with('error', 'Producto no encontrado');
    }

    $navbar = 'layout/navbar'; // Navbar por defecto (visitante)
    if (session()->has('perfil_id')) {
        $navbar = (session('perfil_id') == 1) ? 'layout/navbarAdmin' : 'layout/navbarCliente';
    }

    echo view($navbar);
    echo view('detalle_bebidas', ['producto' => $producto]);
    echo view('layout/footer');
}


    public function listarBebidas()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');

        $productoModel = new Producto_model();
        $productos = $productoModel
            ->select('productos.*, marca.marca_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca')
            ->findAll();

        return view('layout/navbarAdmin')
            . view('listar_bebidas', ['productos' => $productos])
            . view('layout/footer');
    }

    public function agregarBebida()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');
        $marca = new Marca_model();
        $categoria = new Categoria_model();
        $data['marcas'] = $marca->findAll();
        $data['categorias'] = $categoria->findAll();
        $data['titulo'] = 'Agregar Bebida';
        
        return view ('layout/navbarAdmin').view('registrar_bebida', $data).view('layout/footer');
    }

   
    public function registrarBebida()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules([
            'producto_nombre'     => 'required|max_length[50]',
            'producto_descripcion'=> 'required',
            'producto_precio'     => 'required|decimal',
            'producto_stock'      => 'required|integer',
            'producto_imagen'     => 'uploaded[producto_imagen]|is_image[producto_imagen]|max_size[producto_imagen,2048]',
            'marca_id'            => 'required|integer',
            'producto_volumen'    => 'required|integer',
            'producto_grado'      => 'required|decimal',
            'categoria_id'        => 'required|integer'
        ]);

        if ($validation->withRequest($request)->run() == false) {
            // Validación falló: mostrar formulario con errores
            $marca = new Marca_model();
            $categoria = new Categoria_model();

            $data['validation'] = $validation->getErrors();
            $data['categorias'] = $categoria->findAll();
            $data['marcas'] = $marca->findAll();
            $data['titulo'] = 'Agregar bebida';

            return view('layout/navbarAdmin').view('registrar_bebida', $data).view('layout/footer');
        } else {
        // Validación OK: procesar imagen, insertar y redirigir
            $img = $this->request->getFile('producto_imagen');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/upload', $nombre_aleatorio);

            $data = [
                'producto_nombre'     => $this->request->getPost('producto_nombre'),
                'producto_descripcion'=> $this->request->getPost('producto_descripcion'),
                'producto_precio'     => $this->request->getPost('producto_precio'),
                'producto_stock'      => $this->request->getPost('producto_stock'),
                'producto_imagen'     => $nombre_aleatorio,
                'marca_id'            => $this->request->getPost('marca_id'),
                'producto_volumen'    => $this->request->getPost('producto_volumen'),
                'producto_grado'      => $this->request->getPost('producto_grado'),
                'categoria_id'        => $this->request->getPost('categoria_id')
            ];

            $bebida = new Producto_model();
            $bebida->insert($data);

            return redirect()->to('agregar_bebida')->with('mensaje', "La bebida se registró correctamente!");
        }

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

        return view('layout/navbarAdmin').view('registrar_bebida', [
            'producto' => $producto,
            'marcas' => $marcaModel->findAll(),
            'categorias' => $categoriaModel->findAll(),
            'validation' => []
        ]).view('layout/footer');
    }


    public function eliminar($id)
    {
        if (session('perfil_id') != 1) return redirect()->to('/');

        (new Producto_model())->delete($id);

        return redirect()->to('listarBebidas');
    }

    public function deshabilitar($id)
    {
        if (session('perfil_id') != 1) return redirect()->to('/');

        $productoModel = new Producto_model();
        $productoModel->update($id, ['activo' => 0]);

        return redirect()->to('gestionar_bebidas')->with('mensaje', 'Producto deshabilitado.');
    }

    public function gestionarBebidas(){
        if (session('perfil_id') != 1) return redirect()->to('/');

            $productoModel = new Producto_model();
            $productos = $productoModel
            ->select('productos.*, marca.marca_nombre, categorias.categoria_nombre')
            ->join('marca', 'productos.marca_id = marca.id_marca')
            ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
            ->findAll();

        return view('layout/navbarAdmin')
            .view('gestionar_bebidas', ['productos' => $productos])
            .view('layout/footer');
        }

    public function actualizarBebida($id)
    {
        helper(['form', 'url']);

        $productoModel = new \App\Models\Producto_model();

        $producto = $productoModel->find($id);
        if (!$producto) {
            return redirect()->to('listar_bebidas')->with('mensaje', 'Producto no encontrado.');
        }

        $validacion = $this->validate([
            'producto_nombre' => 'required|min_length[3]',
            'producto_descripcion' => 'required|min_length[5]',
            'producto_precio' => 'required|decimal',
            'producto_stock' => 'required|is_natural',
            'producto_volumen' => 'required|integer',
            'producto_grado' => 'required|decimal',
            'marca_id' => 'required|integer',
            'categoria_id' => 'required|integer',
            'producto_imagen' => [
            'uploaded[producto_imagen]',
            'max_size[producto_imagen,2048]',
            'is_image[producto_imagen]',
            'mime_in[producto_imagen,image/jpg,image/jpeg,image/png,image/webp]'
        ]
        ]);

        $datos = [
            'producto_nombre' => $this->request->getPost('producto_nombre'),
            'producto_descripcion' => $this->request->getPost('producto_descripcion'),
            'producto_precio' => $this->request->getPost('producto_precio'),
            'producto_stock' => $this->request->getPost('producto_stock'),
            'producto_volumen' => $this->request->getPost('producto_volumen'),
            'producto_grado' => $this->request->getPost('producto_grado'),
            'marca_id' => $this->request->getPost('marca_id'),
            'categoria_id' => $this->request->getPost('categoria_id'),
        ];

        if (!$validacion) {
            // Si no se subió nueva imagen, quitar validación de imagen
            if ($this->request->getFile('producto_imagen')->getError() == 4) {
                unset($_POST['producto_imagen']);
                $productoModel->update($id, $datos);
                return redirect()->to('listar_bebidas')->with('mensaje', 'Producto actualizado sin cambiar imagen.');
            } else {
                return view('layout/navbarAdmin').view('registrar_bebida', [
                    'validation' => $this->validator->getErrors(),
                    'producto' => $producto,
                    'marcas' => (new Marca_model())->findAll(),
                    'categorias' => (new Categoria_model())->findAll()
                ]).view('layout/footer');
            }
        }

        // Procesar imagen nueva si fue subida
        $imagen = $this->request->getFile('producto_imagen');
        if ($imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move('assets/upload', $nombreImagen);

            // Opcional: eliminar imagen anterior si existe
            if (!empty($producto['producto_imagen']) && file_exists('assets/upload/' . $producto['producto_imagen'])) {
                unlink('assets/upload/' . $producto['producto_imagen']);
            }

            $datos['producto_imagen'] = $nombreImagen;
        }

        $productoModel->update($id, $datos);

        return redirect()->to('listar_bebidas')->with('mensaje', 'Producto actualizado correctamente.');
    }

}
