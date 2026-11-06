<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('login', 'Admin\Auth::index');

    $routes->post('login', 'Admin\Auth::login');
});

$routes->group('admin', ['filter' => 'adminlogin'], function ($routes) {
    $routes->get('vehicles', "Admin\Vehicle::index");
    $routes->get('vehicles/new', "Admin\Vehicle::new");
});
