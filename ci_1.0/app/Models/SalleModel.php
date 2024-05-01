<?php
namespace App\Models;

use CodeIgniter\Model;
use stdClass;

class SalleModel extends Model{
    protected $table      = 'Salles';

    protected $allowedFields = [
        'nom_salle'
    ];

    /**
     * 
     * Get les salles utilisées par un créneau
     * 
     */
    public function get_used_salles($h_debut, $durée, $jour)
    {
        $h_fin = date('H:i:s', strtotime($h_debut) + $durée * 60);
        // Get les créneaux durant lesquels un prof donne cours
        $salles = $this->db->table('Créneaux')
        ->select('id_salle')
        ->where('jour_créneau = ' . $jour)
        ->where('((début_créneau < "'.$h_fin.'" AND "'.$h_debut.'" < fin_créneau) OR ("'.$h_debut.'" < fin_créneau AND début_créneau < "'.$h_fin.'"))')
        ->get()
        ->getResult();
        
        return $salles;
    }   
}