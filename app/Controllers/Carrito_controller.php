<?php

namespace App\Controllers;

use App\Models\Producto_model;
use App\Models\Categoria_model;
use App\Models\Ventas_model;
use App\Models\Detalle_ventas_model;
use App\Models\Detalle_envio_model;
use App\Models\Usuario_model;
use DateTime;

class Carrito_controller extends BaseController{

    // Ver carrito
    public function ver_carrito()
        {
        if (session('perfil_id') != 2) return redirect()->to('/');
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
        if (session('perfil_id') != 2) return redirect()->to('/');
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
        if (session('perfil_id') != 2) return redirect()->to('/');
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to('ver_carrito');
    }

    public function vaciar_carrito(){
        if (session('perfil_id') != 2) return redirect()->to('/');
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
        return view($navbar).view('backend/confirmar_compra_form').view('layout/footer');
    }

    public function confirmar_compra(){
        if (session('perfil_id') != 2) return redirect()->to('/');

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
            return view($navbar).view('backend/confirmar_compra_form', ['validation' => $validation]).view('layout/footer');
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
        if (session('perfil_id') != 2) return redirect()->to('/');
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

        $usuario = [
            'nombre' => session('nombre'),
            'apellido' => session('apellido'),
            'email' => session('email')
        ];

        return view('layout/navbarCliente')
             . view('backend/confirmacion_compra', [
                    'usuario' => $usuario,
                    'envio' => $datos_envio,
                    'carrito' => $cart1
                ])
             . view('layout/footer');

        }
    
    public function listar_ventas()
    {
        if (session('perfil_id') != 1) return redirect()->to('/');

        $ventaModel = new Ventas_model();
        $detalleVentaModel = new Detalle_ventas_model();
        $detalleEnvioModel = new Detalle_envio_model();
        $productoModel = new Producto_model();
        $usuarioModel = new Usuario_model(); // Asumo que tienes este modelo

        // Obtener parámetros de fecha si existen
        $fechaInicio = $this->request->getGet('fecha_inicio');
        $fechaFin = $this->request->getGet('fecha_fin');

        // Consulta base
        $ventaModel->orderBy('venta_fecha', 'DESC');

        // Aplicar filtros de fecha si existen
        if (!empty($fechaInicio)) {
            $fechaInicioObj = DateTime::createFromFormat('d/m/Y', $fechaInicio);
            if ($fechaInicioObj) {
                $fechaInicio = $fechaInicioObj->format('Y-m-d');
                $ventaModel->where('DATE(venta_fecha) >=', $fechaInicio);
            }
        }

        if (!empty($fechaFin)) {
            $fechaFinObj = DateTime::createFromFormat('d/m/Y', $fechaFin);
            if ($fechaFinObj) {
                $fechaFin = $fechaFinObj->format('Y-m-d 23:59:59'); // incluir todo ese día
                $ventaModel->where('venta_fecha <=', $fechaFin);
            }
        }

        // Obtener todas las ventas
        $ventas = $ventaModel->orderBy('venta_fecha', 'DESC')->findAll();

        $ventasAgrupadas = [];
    
        foreach ($ventas as $venta) {
            // Obtener detalles de envío
            $envio = $detalleEnvioModel->where('id_venta', $venta['id_venta'])->first();
        
            // Obtener detalles de productos vendidos
            $detalles = $detalleVentaModel->where('id_venta', $venta['id_venta'])->findAll();
        
            // Obtener información del cliente
            $cliente = $usuarioModel->find($venta['id_cliente']);
        
            // Procesar productos
            $productosVenta = [];
            $totalVenta = 0;
        
            foreach ($detalles as $detalle) {
                $producto = $productoModel->find($detalle['id_producto']);
                $subtotal = $detalle['detalle_cantidad'] * $detalle['detalle_precio'];
            
                $productosVenta[] = [
                    'id_producto' => $detalle['id_producto'],
                    'nombre' => $producto ? $producto['producto_nombre'] : 'Producto eliminado',
                    'cantidad' => $detalle['detalle_cantidad'],
                    'precio_unitario' => $detalle['detalle_precio'],
                    'subtotal' => $subtotal
                ];
            
                $totalVenta += $subtotal;
            }
        
            $ventasAgrupadas[$venta['id_venta']] = [
                'id_venta' => $venta['id_venta'],
                'fecha' => $venta['venta_fecha'],
                'cliente_nombre' => $cliente ? ($cliente['nombre'] . ' ' . $cliente['apellido']) : 'Cliente no encontrado',
                'cliente_email' => $cliente ? $cliente['email'] : '',
                'envio_mail' => $envio['envio_mail'] ?? '',
                'envio_direccion' => $envio ? 
                    ($envio['envio_direccion'] . ', ' . $envio['envio_ciudad'] . ', ' . $envio['envio_provincia']) : 
                    'Dirección no especificada',
                'envio_codigo' => $envio['envio_codigo'] ?? '',
                'total' => $totalVenta,
                'productos' => $productosVenta
            ];
        }

        $data = [
            'ventasAgrupadas' => $ventasAgrupadas,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin
        ];

        return view('layout/navbarAdmin')
             . view('backend/listar_ventas', $data)
             . view('layout/footer');
    }

    public function actualizar_cantidad()
    {
        if (session('perfil_id') != 2) return redirect()->to('/');
        $cart = \Config\Services::cart();
        $rowid = $this->request->getPost('rowid');
        $accion = $this->request->getPost('accion');

        $item = $cart->getItem($rowid);
        if (!$item) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $nuevaCantidad = $item['qty'];
        if ($accion == 'sumar') {
            $nuevaCantidad += 1;
        } elseif ($accion == 'restar' && $item['qty'] > 1) {
            $nuevaCantidad -= 1;
        }

        $cart->update([
            'rowid' => $rowid,
            'qty' => $nuevaCantidad
        ]);

    return redirect()->back();
    }

}