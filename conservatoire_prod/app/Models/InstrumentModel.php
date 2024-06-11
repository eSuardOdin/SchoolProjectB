<?php

namespace App\Models;

use CodeIgniter\Model;
class InstrumentModel extends Model
{

    protected $table            = 'Instruments';
    protected $primaryKey       = 'id_instrument';
    protected $allowedFields = [
        'nom_instrument',
        'famille_instrument'
    ];
    protected $returnType     = \App\Entities\Instrument::class;
    
}