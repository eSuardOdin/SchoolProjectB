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
        $arr['professeur'] = [];
        $arr['professeur']['matières'] = $this->get_matières_enseignées();
        $arr['role'] = 'professeur';
        return $arr;
    }

    // Avoir les matières enseignées par un prof
    public function get_matières_enseignées(): array
    {
        $userModel = model(UtilisateurModel::class);
        

        // Get les id des matières comme subquery pour la clause IN
        $id_matieres = $userModel->db->table('Matières_Professeurs')
        ->distinct()
        ->select('`id_matière`')
        ->where('id_professeur = ' . $this->attributes['id_professeur']);

        // Get les matières
        $matieres = $userModel->db->table('Matières')
        ->whereIn('`Matières`.`id_matière`', $id_matieres)
        ->get()
        ->getResultArray();

        return $matieres;
    }
}