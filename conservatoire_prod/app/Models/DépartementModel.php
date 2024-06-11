<?php
namespace App\Models;

use App\Models\UtilisateurModel;
use App\Entities\Département;
class DépartementModel extends UtilisateurModel
{
    protected $table      = 'Départements';
    protected $primaryKey = 'id_département';
    protected $allowedFields = [
        'nom_département'
    ];
    protected $returnType     = Département::class;
}