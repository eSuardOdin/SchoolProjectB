<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\MatièreModel;
class ChefModel extends ProfesseurModel
{
    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }

    
}