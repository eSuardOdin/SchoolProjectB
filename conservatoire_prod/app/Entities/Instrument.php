<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\InstrumentModel;
class Instrument extends Entity
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    public function get_famille_instrument(): string { return $this->attributes['famille_instrument']; }

    public function get_nom_instrument(): string { return $this->attributes['nom_instrument']; }

}