<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\CréneauModel;

class Créneau extends Entity
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    public function get_id_créneau(): int { return (int)$this->attributes['id_créneau']; }
    public function get_début_créneau(): string { return $this->attributes['début_créneau']; }
    public function get_fin_créneau(): string { return $this->attributes['fin_créneau']; }
    public function get_id_matière(): ?int { return $this->attributes['id_matière']; }
    public function get_id_professeur(): ?int { return $this->attributes['id_professeur']; }
    public function get_jour_créneau(): int { return (int) $this->attributes['jour_créneau']; }
}