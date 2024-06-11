<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\EleveCycleModel;

class EleveCycle extends Entity
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    

    public function get_id_cycle(): int { return (int)$this->attributes['id_cycle']; }
}