<?php
declare(strict_types = 1);
namespace App\Classes;

class Utilisateur
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
  public function menu(): string
  {
    // // Session unset test
    // unset($_SESSION['count']);
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';

    return 'Menu utilisateur';
  }

  // Create user
  public function create(): string
  {
    return '
      <form method="post" action="/utilisateur/create">
        <label for="nom_utilisateur">Nom</label>
        <input type="text" name="nom_utilisateur"/>
        <br />

        <label for="prénom_utilisateur">Prénom</label>
        <input type="text" name="prénom_utilisateur"/>
        <br />

        <label for="pwd_utilisateur">Mot de passe</label>
        <input type="password" name="pwd_utilisateur"/>
        <br />

        <label for="login_utilisateur">Login</label>
        <input type="text" name="login_utilisateur"/>
        <br />

        <input type="submit" value="Créer"/> 
      </form>';
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