<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\ProfesseurModel;
use App\Models\ChefModel;

class Chef extends Professeur
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    // Permet de rajouter le rôle dans les user_data de la session
    public function append_chef(Professeur $prof): array
    {
        $arr = $prof->append_role();
        $arr['chef'] = true;
        return $arr;
    }
}