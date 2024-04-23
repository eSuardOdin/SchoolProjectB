<?php
namespace App\Models;

use CodeIgniter\Model;
use stdClass;

class MatièreModel extends Model{
    protected $table      = 'Matières';

    protected $allowedFields = [
        'nom_matière',
        'durée_matière',
        'max_élèves_matière',
        'id_cycle'
    ];
    protected $primaryKey       = 'id_matière';
    protected $returnType = \App\Entities\Matière::class;
    // Get une matière, sera utilisée dans l'onglet cours du chef de departement
    public function get_matière($id)
    {
        return $this->db->table('Matières')
        ->where('id_matière = ' . $id)
        ->get()
        ->getRow();
    }

    // Insertion d'une matière dans la db
    
    public function insert_matière(){}

    // Get les matières d'un département
    public function get_matières_département($id_dep)
    {
        // Get les cycles du département
        $cycles = $this->db->table('Cycles')
        ->where('id_département = ' . $id_dep)
        ->get()
        ->getResult();

        // Get les matières des cycles
        $matières = [];
        foreach ($cycles as $cycle) {
            $res = $this->db->table('Matières')
            ->where('id_cycle = ' . $cycle->id_cycle)
            ->get()
            ->getResult();
            $matières[$cycle->nom_cycle] = $res;
        }
        return $matières;
    }

}