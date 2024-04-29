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

    

}
