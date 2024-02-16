<?php
namespace App\Models;

use App\Models\UtilisateurModel;
class EleveModel extends UtilisateurModel
{
    protected $table      = 'Elèves';
    protected $primaryKey = 'id_élève';
    protected $allowedFields = [
        'id_élève'
    ];
    protected $useAutoIncrement = false;
    protected $returnType     = \App\Entities\Eleve::class;


    public function eleve_demande_cycle(int $id_cycle, int $id_eleve): void
    {
        $data = [
            'id_élève' => $id_eleve,
            'id_cycle' => $id_cycle,
            'demande_cycle' => true,
            'inscrit_cycle' => false,
            'promu_cycle' => false
        ];
        $this->db->table('Elèves_Cycles')
        ->insert($data);
    }
}