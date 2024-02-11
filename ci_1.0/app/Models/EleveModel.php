<?php
namespace App\Models;

use App\Models\UtilisateurModel;
class EleveModel extends UtilisateurModel
{
    protected $table      = 'Elèves';
    protected $primaryKey = 'id_élève';
    protected $allowedFields = [
        'id_élève'
    ];
    protected $useAutoIncrement = false;
    protected $returnType     = \App\Entities\Eleve::class;
}