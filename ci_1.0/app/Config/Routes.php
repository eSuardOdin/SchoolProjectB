<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\LoginController;
use App\Controllers\MenuController;
use App\Controllers\PlanningController;
use App\Controllers\CoursController;
use App\Controllers\InscriptionController;
/**
 * @var RouteCollection $routes
 */

 /*
  * Routes générales 
  */
// Form de connexion
$routes->get('/', [LoginController::class, 'index']);
// Connexion check
$routes->post('login', [LoginController::class, 'authenticate']);
// Déconnexion
$routes->post('logout', [LoginController::class, 'logout']);
// Menu principal
$routes->get('menu', [MenuController::class, 'index']);
// Planning
$routes->get('planning', [PlanningController::class, 'index']);

/*
 * Routes élève
 */
// Choisir le département
$routes->get('inscription/département', [InscriptionController::class, 'choix_département']);
// Voir la demande d'inscription en cours
$routes->get('inscription/demande/(:num)', [InscriptionController::class, 'voir_demande']);
// Choisir un cycle pour lequel postuler
$routes->post('inscription/cycles', [InscriptionController::class, 'choix_cycle']);
// Validation de l'inscription
$routes->post('inscription/validation', [InscriptionController::class, 'inscrire_eleve']);

/*
 * Routes professeur
 */


/* 
 * Routes chef département
 */
$routes->get('cours', [CoursController::class, 'index']);
$routes->get('eleve', [CoursController::class, 'index']);
// Voir les demandes
$routes->get('demandes', [InscriptionController::class, 'afficher_demandes']);
$routes->post('traiter_demande', [InscriptionController::class, 'traiter_demande']);