<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\AccueilController;
use App\Controllers\OperationController;

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
    $routes->get('gains', 'GainController::index');

    $routes->get('autres-operateurs', 'AutreOperateurController::index');
    $routes->post('autres-operateurs/store', 'AutreOperateurController::store');
    $routes->post('autres-operateurs/delete/(:num)', 'AutreOperateurController::delete/$1');

    $routes->get('commissions', 'CommissionController::index');
    $routes->post('commissions/update', 'CommissionController::update');
});

$routes->group('client', function ($routes) {

    $routes->get('login', 'AuthClientController::index');
    $routes->post('login/authenticate', 'AuthClientController::authenticate');
    $routes->post('login/firstAuthenticate', 'AuthClientController::firstAuthenticate');

    $routes->get('dashboard', 'ClientDashboardController::index');

    $routes->get('depot', 'OperationController::vueDepot');
    $routes->post('depot', 'OperationController::depot');

    $routes->get('retrait', 'OperationController::vueRetrait');
    $routes->post('retrait', 'OperationController::retrait');

    $routes->get('transfert', 'OperationController::vueTransfert');
    $routes->post('transfert', 'OperationController::transfert');

    $routes->get('epargne', 'OperationController::vueEpargne');
    $routes->post('epargne', 'OperationController::epargne');

    $routes->get('historique', 'OperationController::historique');
});

$routes->get('logout', 'LogoutController::logout');
