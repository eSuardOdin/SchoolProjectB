<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\UtilisateurModel;

class Eleve extends Utilisateur
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
        $user = $this->get_base_user((int)$this->attributes['id_élève']);
        $arr = $user->get_session_infos();
        $arr['élève'] = [];
        $arr['élève']['cycle'] = $this->get_cycle_élève((int)$this->attributes['id_élève']);
        return $arr;
    }

    // Get le cycle de l'élève
    public function get_cycle_élève(int $id): ?array
    {
        $userModel = model(UtilisateurModel::class);
        return $userModel->db->table('Elèves_Cycles')
        ->where('id_élève', $id)
        ->where('inscrit_cycle', true)
        ->get()
        ->getRowArray();
    }
}