<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');//okey
$routes->get('nosotros', 'Home::nosotros');//okey
$routes->get('inicio', 'Home::index');//okey
$routes->get('comercializacion', 'Home::comercializacion');//okey
$routes->get('contacto', 'Home::contacto');//okey
$routes->get('terminos', 'Home::terminos');//okey
$routes->get('login', 'Home::login');//okey
$routes->get('registro', 'Home::registro');//okey
$routes->get('productos', 'Home::productos');//okey
$routes->post('form_consulta', 'Usuario_controller::add_consulta');
$routes->get('registro', 'Usuario_controller::registro');
$routes->post('form_registro', 'Usuario_controller::add_cliente');
$routes->get('logout', 'Usuario_controller::logout');