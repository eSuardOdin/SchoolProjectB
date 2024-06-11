<?php
namespace App\Models;

use CodeIgniter\Model;
use stdClass;

class CréneauModel extends Model{
    protected $table      = 'Créneaux';

    protected $allowedFields = [
        'jour_créneau',
        'début_créneau',
        'id_salle',
        'id_matière',
        'id_professeur',
        'fin_créneau'
    ];
    protected $primaryKey       = 'id_créneau';
    protected $returnType = \App\Entities\Créneau::class;

}