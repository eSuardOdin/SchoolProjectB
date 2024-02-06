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

    private function set_cycles()
    {
        $cycles_eleve = $this->db->table('Elèves_Cycles')
        ->select('id_cycle')
        ->where('`id_élève` = ' . $this->data['user_data']->id_utilisateur)//;
        ->get()
        ->getResultArray();
        return $cycles_eleve;
    }
}