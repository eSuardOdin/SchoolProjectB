<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Entities\EleveCycle;
class EleveCycleModel extends Model
{

    protected $table            = 'Elèves_Cycles';
    protected $allowedFields = [
        'id_cycle',
        'id_élève',
        'demande_cycle',
        'inscrit_cycle',
        'promu_cycle'
    ];
    protected $returnType     = EleveCycle::class;

    public function creer_demande($id_cycle, $id_eleve)
    {
        $data = [
            'id_cycle' => $id_cycle,
            'id_élève'    => $id_eleve,
            'demande_cycle' => true,
            'inscrit_cycle' => false,
            'promu_cycle' => false
        ];

        $this->insert($data);
    }
    
   // Méthode pour trouver une inscription par clé primaire composée
   public function findInscription($id_cycle, $id_eleve)
   {
       return $this->where('id_cycle', $id_cycle)
                   ->where('id_élève', $id_eleve)
                   ->first();
   }

   public function findCurrent($id_eleve)
   {
       return $this->where('id_élève', $id_eleve)->where('inscrit_cycle', true)
                   ->first();
   }

   // Méthode pour mettre à jour une inscription par clé primaire composée
   public function updateInscription($id_cycle, $id_eleve, $data)
   {
       return $this->where('id_cycle', $id_cycle)
                   ->where('id_élève', $id_eleve)
                   ->set($data)
                   ->update();
   }

   // Méthode pour supprimer une inscription par clé primaire composée
   public function deleteInscription($id_cycle, $id_eleve)
   {
       return $this->where('id_cycle', $id_cycle)
                   ->where('id_élève', $id_eleve)
                   ->delete();
   }
}