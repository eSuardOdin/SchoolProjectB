<?php
declare(strict_types = 1);
namespace App\Model;

class Utilisateurs
{
    private int $id_utilisateur;
    private string $nom_utilisateur;
    private string $prénom_utilisateur;
    private string $pwd_utilisateur;
    private string $login_utilisateur;
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
}