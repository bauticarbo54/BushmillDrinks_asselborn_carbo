<?php

namespace App\Controllers;

use App\Models\Producto_model;
use App\Models\Categoria_model;
use App\Models\Ventas_model;
use App\Models\Detalle_ventas_model;
use App\Models\Detalle_envio_model;

class Carrito_controller extends BaseController{

    // Ver carrito
    public function ver_carrito()
        {
        //navbar personalizado
        $navbar = 'layout/navbar'; // Navbar por defecto (visitante)
        if (session()->has('perfil_id')) {
            if (session('perfil_id') == 1) {
            $navbar = session('modo_cliente') ? 'layout/navbarAdminVisitante' : 'layout/navbarAdmin';
            } elseif (session('perfil_id') == 2) {
            $navbar = 'layout/navbarCliente';
        }
    }
        $cart = \Config\Services::cart();
        $data['titulo']= 'Carrito de Compras';
        return view($navbar).view('carrito').view('layout/footer');

    }

    // Agregar producto al carrito
    public function agregar_carrito()
        {
        $cart = \Config\Services::cart();
        $request= \Config\Services::request();

        $data = array(
            'id'=>$request->getPost('id'),
            'name'=>$request->getPost('nombre'),
            'price'=>$request->getPost('precio'),
            'qty'=>1
        );
        $cart->insert($data);
        //tiene que ir un mensaje de agregado al carrito
        return redirect()->route('ver_carrito');

    }

    public function eliminar_item($rowid){
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to('ver_carrito');
    }

    public function vaciar_carrito(){
        $cart = \Config\Services::cart();
        $cart->destroy();  
        return redirect()->to('ver_carrito'); 
    }

    public function ordenar_compra(): string{
        //navbar personalizado
        $navbar = 'layout/navbar'; // Navbar por defecto (visitante)
        if (session()->has('perfil_id')) {
            if (session('perfil_id') == 1) {
            $navbar = session('modo_cliente') ? 'layout/navbarAdminVisitante' : 'layout/navbarAdmin';
            } elseif (session('perfil_id') == 2) {
            $navbar = 'layout/navbarCliente';
        }
        }       
        return view($navbar).view('confirmar_compra_form').view('layout/footer');
    }

    public function confirmar_compra(){

        $validation = \Config\Services::validation();

        $validation->setRules([
            'envio_mail' => 'required|valid_email|max_length[100]',
            'envio_telefono' => 'regex_match[/^\+?[0-9\s\-\(\)]{7,20}$/]',
            'envio_ciudad' => 'required|max_length[50]|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/]',
            'envio_codigo' => 'required|numeric|exact_length[4]',
            'envio_direccion' => 'required|min_length[5]|max_length[100]|regex_match[/^[a-zA-ZÀ-ÿ0-9\s\.\-ºª#]+$/u]',
            
        ],
        [
            'envio_mail' => [
                'required' => 'El correo electrónico es obligatorio.',
                'valid_email' => 'La dirección de correo debe ser válida.',
                'max_length' => 'El correo electrónico no puede superar los 100 caracteres.',
            ],
            'envio_telefono' => [
                'regex_match' => 'El teléfono solo puede contener números, espacios, paréntesis, guiones y un símbolo "+" opcional. Debe tener entre 7 y 20 caracteres.',
            ],
            'envio_ciudad' => [
                'required' => 'La ciudad es obligatoria.',
                'max_length' => 'La ciudad no puede tener más de 50 caracteres.',
                'regex_match' => 'La ciudad solo puede contener letras y espacios.',
            ],
            'envio_codigo' => [
                'required' => 'El código postal es obligatorio.',
                'numeric' => 'El código postal debe contener solo números.',
                'exact_length' => 'El código postal debe tener exactamente 4 dígitos.',
            ],
            'envio_direccion' => [
                'required' => 'La dirección es obligatoria.',
                'min_length' => 'La dirección debe tener al menos 5 caracteres.',
                'max_length' => 'La dirección no puede tener más de 100 caracteres.',
                'regex_match' => 'La dirección solo puede contener letras, números y símbolos comunes como ".", "-", "#" y espacios.',
            ],
        ]
        );

        if (!$validation->withRequest($this->request)->run()) {
            
            $navbar = 'layout/navbar'; // Navbar por defecto (visitante)
            if (session()->has('perfil_id')) {
                if (session('perfil_id') == 1) {
                $navbar = session('modo_cliente') ? 'layout/navbarAdminVisitante' : 'layout/navbarAdmin';
                } elseif (session('perfil_id') == 2) {
                    $navbar = 'layout/navbarCliente';
                }
            }


            // Devolver la vista con los errores
            return view($navbar).view('confirmar_compra_form', ['validation' => $validation]).view('layout/footer');
        }

        $data = [
            'envio_telefono'   => $this->request->getPost('envio_telefono'),
            'envio_mail' => $this->request->getPost('envio_mail'),
            'envio_provincia' => $this->request->getPost('envio_provincia'),
            'envio_ciudad' => $this->request->getPost('envio_ciudad'),
            'envio_direccion' => $this->request->getPost('envio_direccion'),
            'envio_codigo' => $this->request->getPost('envio_codigo'),
        ];

        session()->set('datos_envio', $data);
        return redirect()->to('guardar_venta');
    }
    
    public function guardar_venta(){
        $cart = \Config\Services::cart();
        $venta = new Ventas_model();
        $detalle = new Detalle_ventas_model();
        $productos = new Producto_model();
        $detalle_envio = new Detalle_envio_model();

        $cart1 = $cart->contents();

        foreach ($cart1 as $item){
            $producto = $productos->where('id_producto', $item['id'])->first();
            if($producto['producto_stock'] < $item['qty']){
                //insertar alert de producto sin stock
                return redirect()->route('ver_carrito');
            }
        }

        $data = array(  
            'id_cliente' => session('id_usuario'),
            'venta_fecha' => date('Y-m-d'),
        );

        $venta_id = $venta->insert($data);

        $datos_envio = session()->get('datos_envio');
        if ($datos_envio && $venta_id) {
            $datos_envio['id_venta'] = $venta_id;
            $detalle_envio->insert($datos_envio);
        }

        $cart1 = $cart->contents();

        foreach($cart1 as $item){
            $detalle_venta = array(
                'id_venta' => $venta_id,
                'id_producto' => $item['id'],
                'detalle_cantidad' => $item['qty'],
                'detalle_precio' => $item['price'],
            );
            
            $producto = $productos->where('id_producto', $item['id'])->first();
            $data = [
                'producto_stock'=>$producto['producto_stock'] - $item['qty'],
            ];

            $productos->update($item['id'], $data);//actualiza stock prod

            $detalle->insert($detalle_venta);//inserta detalle venta
        }

        $cart->destroy();
        return redirect()->route('inicio');
    }
    
    public function listar_ventas()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');

        $ventaModel = new Ventas_model();
        $ventas = $ventaModel
            ->select('ventas.id_venta, ventas.venta_fecha, ventas.id_cliente,
                    detalle_envio.envio_mail, detalle_envio.envio_direccion, detalle_envio.envio_codigo,
                    detalle_ventas.id_producto, detalle_ventas.detalle_cantidad, detalle_ventas.detalle_precio')
            ->join('detalle_envio', 'detalle_envio.id_venta = ventas.id_venta')
            ->join('detalle_ventas', 'detalle_ventas.id_venta = ventas.id_venta')
            ->orderBy('ventas.venta_fecha', 'DESC')
            ->findAll();

        return view('layout/navbarAdmin')
            . view('listar_ventas', ['ventas' => $ventas])
            . view('layout/footer');
    }
}