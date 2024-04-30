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
        // ->where('début_créneau BETWEEN "' . $h_debut . '" AND "' . $h_fin . '"') // Marche mais empeche l'enchainement de créneaux
        // ->where('(début_créneau < "' . $h_fin . '"')
        ->where('((début_créneau < "'.$h_fin.'" AND "'.$h_debut.'" < fin_créneau) OR ("'.$h_debut.'" < fin_créneau AND début_créneau < "'.$h_fin.'"))')
        ->get()
        ->getResult();

        // Supprimer l'entrée si l'heure de fin est STRICTEMENT égale au début du créneau
        // $clean_creneaux = [];
        // foreach ($creneaux as $c) {
        //     if(strtotime($c->début_créneau) === strtotime($h_fin))
        //     {
        //         array_push($clean_creneaux, $c);
        //     }
        // }
        return $creneaux;
        // return [$h_debut, $h_fin];
    } 

}
