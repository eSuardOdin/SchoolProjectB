<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Login;
/**
 * @var RouteCollection $routes
 */
// Form de connexion
$routes->get('/', [Login::class, 'index']);
// Connexion check
$routes->post('/login', [Login::class, 'authenticate']);
// Déconnexion
$routes->post('/logout', [Login::class, 'logout']);


// Menu principal
$routes->get('/menu', [Menu::class, 'init_menu']);