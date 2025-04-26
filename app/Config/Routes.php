<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Nosotros', 'quienesSomos::index');
$routes->get('Inicio', 'inicio::index');
$routes->get('Comercializacion', 'comercializacion::index');