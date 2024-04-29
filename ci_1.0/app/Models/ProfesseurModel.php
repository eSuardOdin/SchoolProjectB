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

    /**
     * 
     * Get les professeurs enseignant une matière donnée
     * 
     */
    public function get_professeur_from_matière($id_matière)
    {
        return $this->db->table('Matières_Professeurs')
        ->where('id_matière', $id_matière)
        ->get()
        ->getResult();
    }

}
