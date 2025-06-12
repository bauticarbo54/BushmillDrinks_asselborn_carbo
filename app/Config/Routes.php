<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

 //Paginas Públicas
$routes->get('/', 'Home::index');
$routes->get('nosotros', 'Home::nosotros');
$routes->get('inicio', 'Home::index');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('contacto', 'Home::contacto');
$routes->get('terminos', 'Home::terminos');
$routes->get('productos', 'Home::productos');

//Autenticación
$routes->get('login', 'Home::login');
$routes->post('login', 'Usuario_controller::login');

$routes->get('registro', 'Home::registro');
$routes->get('logout', 'Usuario_controller::logout');
//Formularios
$routes->post('form_consulta', 'Mensaje_controller::add_consulta');
$routes->post('form_registro', 'Usuario_controller::add_cliente');

$routes->get('agregar_bebida', 'Producto_controller::agregarBebida');
$routes->post('insertar_bebida', 'Producto_controller::registrarBebida');
$routes->get('listar_bebidas', 'Producto_controller::listarBebidas');
$routes->get('eliminar_bebida/(:num)', "Producto_controller::eliminar/$1");
$routes->get('gestionar_bebidas', 'Producto_controller::gestionarBebidas');
$routes->get('gestionar_bebidas/(:num)', "Producto_controller::editar/$1");
$routes->post('actualizar_bebida/(:num)', 'Producto_controller::actualizarBebida/$1');
$routes->get('ver_consultas', 'Mensaje_controller::verConsultas');

$routes->get('verComoCliente', 'Home::verComoCliente');
$routes->get('volverAModoAdmin', 'Home::volverAModoAdmin');

