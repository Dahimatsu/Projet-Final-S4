<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\AccueilController;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', [AccueilController::class, 'index']);
