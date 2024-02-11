<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\UtilisateurModel;

class Professeur extends Utilisateur
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    private function get_base_user(int $id): Utilisateur
    {
        $userModel = model(UtilisateurModel::class);
        return $userModel->where('id_utilisateur', $id)->first();
    }

    // Permet de rajouter le rôle dans les user_data de la session
    public function append_role(): array
    {
        $user = $this->get_base_user((int)$this->attributes['id_professeur']);
        $arr = $user->get_session_infos();
        $arr['role'] = 'professeur';
        return $arr;
    }
}