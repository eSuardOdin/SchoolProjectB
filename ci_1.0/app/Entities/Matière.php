<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\MatièreModel;

class Matière extends Entity
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    public function get_id_matière(): int { return (int)$this->attributes['id_matière']; }
    public function get_nom_matière(): string { return $this->attributes['nom_matière']; }
    public function get_durée_matière(): ?int { return $this->attributes['durée_matière']; }
    public function get_max_élèves_matière(): ?int { return $this->attributes['max_élèves_matière']; }
    public function get_id_cycle(): int { return (int) $this->attributes['id_cycle']; }
}