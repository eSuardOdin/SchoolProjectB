<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\MatièreModel;
use App\Models\ElèveModel;
class ChefModel extends ProfesseurModel
{
    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }

    // Créer un cours et l'affecter à une salle
    public function créer_cours($id_matière, $id_salle)
    {

    }

    // Inscrire un élève à un des cycles (ou le créer s'il n'existe pas)
    public function inscrire_élève($nom, $prénom, $login, $id_cycle)
    {
        
    }


    // Promouvoir un élève de cycle
}