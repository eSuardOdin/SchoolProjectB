<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfesseurModel extends UtilisateurModel
{
    protected $table            = 'Professeurs';
    protected $primaryKey       = 'id_professeur';
    protected $allowedFields = [
        'id_professeur'
    ];
    protected $useAutoIncrement = false;
    protected $returnType     = \App\Entities\Professeur::class;
    protected $matières;

    // // Fonction utilisée dans le Factory builder
    // public function set_data()
    // {
    //     // On reset le role
    //     $this->data['role'] = 'professeur';
    //     $this->data['matières_enseignées'] = $this->set_matières();

    //     // Check si chef
    //     $this->set_chef();
    // }

    // // Set les matières enseignées par le prof
    // private function set_matières()
    // {
    //     /* Check les matières enseignées */
    //     // Get les id des matières comme subquery pour la clause IN
    //     $id_matieres = $this->db->table('Matières_Professeurs')
    //     ->distinct()
    //     ->select('`id_matière`')
    //     ->where('id_professeur = ' . $this->data['user_data']->id_utilisateur);

    //     // Get les matières
    //     $matieres = $this->db->table('Matières')
    //     ->whereIn('`Matières`.`id_matière`', $id_matieres)
    //     ->get()
    //     ->getResultArray();

    //     return $matieres;
    // }


    // // Set le statut de chef (pour upgrade dans la Factory)
    // private function set_chef()
    // {
    //     $is_chef = $this->db->table('Départements')
    //         ->where('`Départements`.`chef_département`', $this->data['user_data']->id_utilisateur)
    //         ->get()
    //         ->getRow();
    //         // Affectation des datas chefs
    //         if($is_chef !== null)
    //         {
    //             $this->data['chef'] = $is_chef;
    //         }
    // }

}
