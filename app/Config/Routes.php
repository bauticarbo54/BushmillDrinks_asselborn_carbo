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
