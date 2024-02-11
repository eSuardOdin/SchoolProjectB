<?php
declare(strict_types = 1);
namespace App\Controllers;

use App\View;

class UtilisateurController
{
  private ?int $id_utilisateur;
  private string $nom_utilisateur;
  private string $prénom_utilisateur;
  private string $pwd_utilisateur;
  private string $login_utilisateur;
  // Constructor
  public function __construct(
      int $id_utilisateur,
      string $nom_utilisateur,
      string $prénom_utilisateur,
      string $pwd_utilisateur,
      string $login_utilisateur
    ) {
    $this->id_utilisateur = $id_utilisateur;
    $this->nom_utilisateur = $nom_utilisateur;
    $this->prénom_utilisateur = $prénom_utilisateur;
    $this->pwd_utilisateur = $pwd_utilisateur;
    $this->login_utilisateur = $login_utilisateur;  
  }

  // Main user menu
  public function menu(): View
  {
    return View::make('/utilisateurs/index');
  }

  // Create user
  public function create(): View
  {
    return View::make('/utilisateurs/create');
  }

  // Store user
  public function store()
  {
    $nom_utilisateur =    $_POST['nom_utilisateur'];
    $prénom_utilisateur = $_POST['prénom_utilisateur'];
    $pwd_utilisateur =    $_POST['pwd_utilisateur'];
    $login_utilisateur =  $_POST['login_utilisateur'];
    echo '<pre>';
    var_dump(
      $_POST['nom_utilisateur'],
      $_POST['prénom_utilisateur'],
      $_POST['pwd_utilisateur'],
      $_POST['login_utilisateur']
    );
    echo '</pre>';
  }
}