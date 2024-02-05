<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfesseurModel extends UtilisateurModel
{
    protected $table            = 'Professeurs';
    protected $primaryKey       = 'id_professeur';
    protected $matières;
    public function __construct()
    {
        parent::__construct();
        $this->set_data();
    }


    private function set_data()
    {
        $this->data['matières_enseignées'] = $this->set_matières();
    }

    private function set_matières()
    {
        /* Check les matières enseignées */
        // Get les id des matières comme subquery pour la clause IN
        $id_matieres = $this->db->table('Matières_Professeurs')
        ->distinct()
        ->select('`id_matière`')
        ->where('id_professeur = ' . $this->data['id']);

        // Get les matières
        $matieres = $this->db->table('Matières')
        ->whereIn('`Matières`.`id_matière`', $id_matieres)
        ->get()
        ->getResultArray();

        return $matieres;
    }

}
