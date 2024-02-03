<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\LoginController;
use App\Controllers\MenuController;
/**
 * @var RouteCollection $routes
 */
// Form de connexion
$routes->get('/', [LoginController::class, 'index']);
// $routes->post('/', [LoginController::class, 'index']);
// Connexion check
$routes->post('login', [LoginController::class, 'authenticate']);
// Déconnexion
$routes->post('logout', [LoginController::class, 'logout']);


// Menu principal
$routes->get('menu', [MenuController::class, 'index']);