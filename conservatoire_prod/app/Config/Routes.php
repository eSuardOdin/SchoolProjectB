<?php

use App\Controllers\EffectifController;
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
$routes->get('login', [LoginController::class, 'authenticate']);
// Déconnexion
$routes->post('logout', [LoginController::class, 'logout']);
// Menu principal
$routes->get('menu', [MenuController::class, 'index']);
// Planning
$routes->get('planning', [PlanningController::class, 'index']);
// Inscription (élève)
$routes->get('inscription', [InscriptionController::class, 'index']);
$routes->post('inscription/utilisateur', [InscriptionController::class, 'inscrire_utilisateur']);
// Get les choix d'instrument (AJAX inscription élève)
$routes->post('inscription/get_instruments', [InscriptionController::class, 'get_instruments']);
// Check la non duplication du login (AJAX inscription élève)
$routes->post('inscription/check_login', [InscriptionController::class, 'check_login']);
/*
 * Routes élève
 */
// Choisir le département
$routes->get('inscription/département', [InscriptionController::class, 'choix_département']);
// Voir la demande d'inscription en cours
$routes->get('inscription/demande/(:num)', [InscriptionController::class, 'voir_demande']);
// Voir infos cycle et demande de promotion
$routes->get('cycle', [InscriptionController::class, 'voir_cycle']);
// Choisir un cycle pour lequel postuler
$routes->post('inscription/cycles', [InscriptionController::class, 'choix_cycle']);
// Validation de l'inscription
$routes->post('inscription/validation', [InscriptionController::class, 'inscrire_eleve']);
// Traiter une demande de promotion
$routes->post('inscription/demande_promotion', [InscriptionController::class, 'demande_promotion']);

/*
 * Routes professeur
 */


/* 
 * Routes chef département
 */
$routes->get('cours', [CoursController::class, 'index']);
$routes->post('cours', [CoursController::class, 'index']);
$routes->get('eleves', [EffectifController::class, 'index']);
$routes->post('cours/add_matière', [CoursController::class, 'show_matière_form']);
$routes->post('cours/add_matière/traitement', [CoursController::class, 'traiter_ajout_matière']);
// Création de créneau
$routes->post('cours/créer_créneau', [CoursController::class, 'show_creneau_form']);
$routes->get('show_matières', [CoursController::class, 'show_matières']);
$routes->get('show_horaires', [CoursController::class, 'show_horaires']);
$routes->get('show_profs', [CoursController::class, 'show_profs']);
$routes->post('cours/créer_créneau/traitement', [CoursController::class, 'traiter_ajout_créneau']);


$routes->get('eleve', [CoursController::class, 'index']);
// Voir les demandes
$routes->get('demandes', [InscriptionController::class, 'afficher_demandes']);
$routes->post('traiter_demande', [InscriptionController::class, 'traiter_demande']);