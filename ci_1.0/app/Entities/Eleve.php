<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\UtilisateurModel;
use App\Models\CycleModel;
use App\Models\DépartementModel;
use App\Entities\Cycle;
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



    // Getters

    /**
     * Pour return l'utilisateur de base
     *  */
    private function get_user(): Utilisateur 
    {
        return model(UtilisateurModel::class)->find((int)$this->attributes['id_élève']);
    }
    public function get_nom() 
    {
        return $this->get_user()->get_nom();
    }


    // Permet de rajouter le rôle dans les user_data de la session
    public function append_role(): array
    {
        $user = $this->get_base_user((int)$this->attributes['id_élève']);
        $arr = $user->get_session_infos();
        $arr['role'] = 'élève';
        $arr['élève'] = [];
        $arr['élève']['cycle'] = $this->get_cycle_élève((int)$this->attributes['id_élève']);
        // Check si demande en cours
        $demande = $this->get_demande_cycle_élève((int)$this->attributes['id_élève']);
        if($demande !== null)
        {
            $arr['élève']['demande'] = $demande;
        }
        return $arr;
    }

    // Get le cycle où est inscrit l'élève
    public function get_cycle_élève(int $id): ?array
    {
        $userModel = model(UtilisateurModel::class);
        $cycleEleve = $userModel->db->table('Elèves_Cycles')
        ->where('id_élève', $id)
        ->where('inscrit_cycle', true)
        ->get()
        ->getRowArray();

        if($cycleEleve !== null)
        {
            $cycle = model(CycleModel::class)->find((int)$cycleEleve['id_cycle']);
            $res = [
                'id_cycle' => $cycleEleve['id_cycle'],
                'nom_cycle' => $cycle->get_nom_cycle(),
                'id_département' => $cycle->get_id_departement(),
                'nom_département' => (model(DépartementModel::class)->find((int)$cycle->get_id_departement()))->get_nom_departement()
            ];
            return $res;
        }
        return null;
    }

    // Get la demande de cycle en cours
    public function get_demande_cycle_élève(int $id): ?array 
    {
        $userModel = model(UtilisateurModel::class);
        return $userModel->db->table('Elèves_Cycles')
        ->where('id_élève', $id)
        ->where('demande_cycle', true)
        ->get()
        ->getRowArray();
    } 
}