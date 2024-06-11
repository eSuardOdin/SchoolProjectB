<?php
namespace App\Models;

use CodeIgniter\Model;
use stdClass;
use CodeIgniter\Database\BaseBuilder;

class SalleModel extends Model{
    protected $table      = 'Salles';

    protected $allowedFields = [
        'nom_salle'
    ];

    /**
     * 
     * Get les salles non utilisées sur une durée
     * 
     */
    public function get_unused_salles($h_debut, $durée, $jour)
    {
        $h_fin = date('H:i:s', strtotime($h_debut) + $durée * 60);
        /*
        // Get les id des salles 
        $used_salles = $this->db->table('Créneaux')
        ->select('id_salle')
        ->where('jour_créneau = ' . $jour)
        ->where('((début_créneau < "'.$h_fin.'" AND "'.$h_debut.'" < fin_créneau) OR ("'.$h_debut.'" < fin_créneau AND début_créneau < "'.$h_fin.'"))')
        ->get()
        ->getResult(); */
        // Get les créneaux durant lesquels un prof donne cours

        
        
        // Création de la subrequest
        $used_salles = $this->db->table('Créneaux')
        ->select('id_salle')
        ->where('jour_créneau = ' . $jour)
        ->where('((début_créneau < "'.$h_fin.'" AND "'.$h_debut.'" < fin_créneau) OR ("'.$h_debut.'" < fin_créneau AND début_créneau < "'.$h_fin.'"))');
        // Get les salles libres
        $free = $this->db->table('Salles')
        ->select('*')
        ->whereNotIn('id_salle', $used_salles)
        ->get()
        ->getResult();
        return $free;
    }   
}