<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\AccueilController;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [AccueilController::class, 'index']);

$routes->group('admin', function ($routes) {
    $routes->get('login', 'AuthAdminController::index');
    $routes->post('login/authenticate', 'AuthAdminController::authenticate');
    $routes->get('dashboard', 'AdminDashboard::index');

    $routes->group('prefixes', function ($routes) {
        $routes->get('/', 'PrefixeController::index');
        $routes->post('store', 'PrefixeController::store');
        $routes->post('delete/(:num)', 'PrefixeController::delete/$1');
    });

    $routes->group('baremes', function ($routes) {
        $routes->get('/', 'BaremeController::index');
        $routes->post('store', 'BaremeController::store');
        $routes->post('delete/(:num)', 'BaremeController::delete/$1');
        });

    $routes->get('clients', 'ClientController::index');
});

$routes->group('client', function ($routes) {
    $routes->get('login', 'AuthClientController::index');
    $routes->post('login/authenticate', 'AuthClientController::authenticate');
    $routes->post('login/firstAuthenticate', 'AuthClientController::firstAuthenticate');
    $routes->get('dashboard', 'ClientDashboard::index');
});

$routes->get('logout', 'LogoutController::logout');
