<?php
namespace App\Models;

use CodeIgniter\Model;
use stdClass;

class CoursModel extends Model{
    protected $table      = 'Cours';

    protected $allowedFields = [
        'date_cours',
        'durée_cours',
        'est_ouvert_cours',
        'id_salle',
        'id_matière',
        'id_professeur'
    ];

    // Get un cours
    public function get_cours($id)
    {
        return $this->db->table('Cours')
        ->where('id_cours = ' . $id)
        ->get()
        ->getRow();
    }

    // Ajout d'un cours dans la bdd
    public function insert_cours() {}    
}