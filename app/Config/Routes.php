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
