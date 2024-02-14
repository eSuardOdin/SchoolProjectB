<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\DépartementModel;
use App\Models\CycleModel;
class Département extends Entity
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    public function get_id_departement(): int { return (int)$this->attributes['id_département']; }

    public function get_nom_departement(): string { return $this->attributes['nom_département']; }


    public function get_departement_cycles(): array
    {
        $cycleModel = model(CycleModel::class);
        $cycles = $cycleModel->where('id_département', $this->attributes['id_département'])
        ->findAll();

        return $cycles;
    }
}