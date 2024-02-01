<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Utilisateurs;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);
// Connexion check
$routes->post('/', [Utilisateurs::class, 'connect']);
