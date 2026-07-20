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
});

$routes->group('client', function ($routes) {
    $routes->get('login', 'AuthClientController::index');
    $routes->post('login/authenticate', 'AuthClientController::authenticate');
    $routes->post('login/firstAuthenticate', 'AuthClientController::firstAuthenticate');
    $routes->get('dashboard', 'ClientDashboard::index');
    
    $routes->get('solde', 'SoldeCompteController::index');

    $routes->get('depot', 'OperationController::vueDepot'); 
    $routes->post('depot', 'OperationController::depot');

    $routes->get('retrait', 'OperationController::vueRetrait');
    $routes->post('retrait', 'OperationController::retrait');

    $routes->get('transfert', 'OperationController::vueTransfert');
    $routes->post('transfert', 'OperationController::transfert');

    $routes->get('historiques', 'OperationController::historique');
});

$routes->get('logout', 'LogoutController::logout');
