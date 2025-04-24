<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('public/Nosotros', 'quienesSomos::index');
$routes->get('public/Inicio', 'inicio::index');