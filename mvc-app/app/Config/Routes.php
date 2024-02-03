<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Utilisateurs;
use App\Controllers\Login;
use App\Controllers\Home;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Login::class, 'index']);
// Connexion check
$routes->post('/', [Login::class, 'authenticate']);
