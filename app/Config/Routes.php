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
$routes->post('form_consulta', 'Usuario_controller::add_consulta');
$routes->post('form_registro', 'Usuario_controller::add_cliente');

$routes->get('agregar_bebida', 'Producto_controller::agregarBebida');
$routes->post('insertar_bebida', 'Producto_controller::registrarBebida');

// Mostrar el catálogo (accesible para cualquier usuario)
$routes->get('catalogo', 'Producto_controller::catalogo');

$routes->get('detalle/(:num)', 'Producto_controller::detalle/$1');

$routes->get('verComoCliente', 'Home::verComoCliente');
$routes->get('volverAModoAdmin', 'Home::volverAModoAdmin');

