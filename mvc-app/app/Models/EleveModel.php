<?php
namespace App\Models;

class EleveModel extends UtilisateurModel
{
    public function set_data()
    {
        // On reset le role
        $this->data['role'] = 'élève';
        $this->data['cycles_eleve'] = $this->set_cycles();

    }

    // Rajoute les cycles dans lesquels l'élève est inscrit
    // au tableau data de l'user
    private function set_cycles()
    {
        $cycles_eleve = $this->db->table('Elèves_Cycles')
        ->select('id_cycle')
        ->where('`id_élève` = ' . $this->data['user_data']->id_utilisateur)//;
        ->get()
        ->getResultArray();
        return $cycles_eleve;
    }


    // Permet à l'élève de réserver une salle (accessible depuis le planning de l'élève,
    // il pourra cliquer sur un créneau sans cours pour placer une réservation)
    public function reserver_salle(/* args */)
    {
        /* Code... */
    }


    // Choix d'un créneau hébdomadaire sur une matière du cycle de l'élève
    public function inscription_cours(/* args */)
    {
        /* Code... */
    }


}