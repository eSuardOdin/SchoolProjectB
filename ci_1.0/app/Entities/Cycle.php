<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\CycleModel;

class Cycle extends Entity
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    
    public function get_places_cycle(): int
    {
        $cycleModel = model(CycleModel::class);
        // On cherche les élèves inscrits
        $places_prises = $cycleModel->db->table('Elèves_Cycles')
        ->selectCount('id_cycle')
        ->where('id_cycle', $this->id_cycle)
        ->where('inscrit_cycle', true)
        ->get()
        ->getResultArray();

        // Et les places totales du cycle
        $places_dispo = ($cycleModel->find($this->id_cycle))->attributes['places_cycle'];

        // Return la difference
        return $places_dispo - $places_prises[0]['id_cycle'];
    }


    public function get_id_cycle(): int { return (int)$this->attributes['id_cycle']; }
    public function get_nom_cycle(): string { return $this->attributes['nom_cycle']; }
}