<?php

namespace App\Models;

use CodeIgniter\Model;

class DirecteurModel extends UtilisateurModel
{
    protected $table            = 'Directeurs';
    protected $primaryKey       = 'id_directeur';

    // Fonction utilisée dans le Factory builder
    public function set_data()
    {
        // On reset le role
        $this->data['role'] = 'directeur';
        $this->set_data_pole();
    }

    // Set les matières enseignées par le prof
    private function set_data_pole()
    {
        // Get les infos du pole
        $pole = $this->db->table('Pôles')
        ->where('`directeur_pôle` = ' . $this->data['user_data']->id_utilisateur)
        ->get()
        ->getRow();
        $this->data['pole'] = $pole;
    }


}


/*
$userData = $userModel->get_data();
        $session->set($userData);
*/