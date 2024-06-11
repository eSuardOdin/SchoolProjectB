<?php
namespace App\Models;
use CodeIgniter\Model;
class CycleModel extends Model
{

    protected $table            = 'Cycles';
    protected $primaryKey       = 'id_cycle';
    protected $allowedFields = [
        'nom_cycle',
        'places_cycle',
        'cycle_enfant',
        'id_département'
    ];
    protected $returnType     = \App\Entities\Cycle::class;
    
    public function get_matières_cycle($id_cycle)
    {
        // Get les cycles du département
        $matières = $this->db->table('Matières')
        ->where('id_cycle', $id_cycle)
        ->get()
        ->getResult();
        return $matières;
    }

    public function get_cycles_departement($idDep)
    {
        return $this->db->table('Cycles')
        ->where('id_département = ' . $idDep)
        ->get()
        ->getResult();
    }


    /**
     * Return le cycle suivant le cycle en cours
     */
    public function get_cycle_enfant($idCycle)
    {
        $subQuery = $this->db->table('Cycles')
        ->select('cycle_enfant')
        ->where('id_cycle = ' . $idCycle);

        return $this->db->table('Cycles')
        ->whereIn('id_cycle', $subQuery)
        ->get()
        ->getResult();
    }
}