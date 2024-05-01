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

    
    /**
     * 
     * Vérifier si un prof est libre
     * 
     */
    public function is_prof_free($id_prof, $h_debut, $durée, $jour)
    {
        $h_fin = date('H:i:s', strtotime($h_debut) + $durée * 60);
        // Get les créneaux durant lesquels un prof donne cours
        $creneaux = $this->db->table('Créneaux')
        ->where('id_professeur', $id_prof)
        ->where('jour_créneau = ' . $jour)
        ->where('((début_créneau < "'.$h_fin.'" AND "'.$h_debut.'" < fin_créneau) OR ("'.$h_debut.'" < fin_créneau AND début_créneau < "'.$h_fin.'"))')
        ->get()
        ->getResult();
        
        return $creneaux;
    }

    /**
     * 
     * Get les professeurs libres sur un créneau
     * qui enseinent la matière souhaitée
     * 
     */
    public function get_free_profs($h_debut, $durée, $jour, $id_matière)
    {
        $h_fin = date('H:i:s', strtotime($h_debut) + $durée * 60);
        // Get les profs qui donnent déjà cours sur le créneau
        $busy = $this->db->table('Créneaux')
        ->select('id_professeur')
        ->where('jour_créneau = ' . $jour)
        ->where('((début_créneau < "'.$h_fin.'" AND "'.$h_debut.'" < fin_créneau) OR ("'.$h_debut.'" < fin_créneau AND début_créneau < "'.$h_fin.'"))');

        // Get les profs libres qui enseignent la bonne matière
        $idle = $this->db->table('Matières_Professeurs')
        ->select('id_professeur')
        ->where('id_matière', $id_matière)
        ->whereNotIn('id_professeur', $busy);

        // Get les professeurs correspondant
        return $this->db->table('Utilisateurs')
        ->whereIn('id_utilisateur', $idle)
        ->get()
        ->getResult();
    }

}
