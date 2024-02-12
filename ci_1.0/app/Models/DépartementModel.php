<?php
namespace App\Models;

use App\Models\UtilisateurModel;
class EleveModel extends UtilisateurModel
{
    protected $table      = 'Départements';
    protected $primaryKey = 'id_département';
    protected $allowedFields = [
        'nom_département'
    ];
    protected $returnType     = \App\Entities\Département::class;
}