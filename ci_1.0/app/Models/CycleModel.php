<?php

namespace App\Models;

use CodeIgniter\Model;
class CycleModel extends Model
{

    protected $table            = 'Cycles';
    protected $primaryKey       = 'id_cycle';
    protected $allowedFields = [
        'nom_cycle',
        'places_cycle',
        'cycle_parent',
        'id_département'
    ];
    protected $returnType     = \App\Entities\Cycle::class;
    
}