<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;
use App\Models\ProfesseurModel;
use App\Models\ChefModel;
use App\Models\DépartementModel;
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
        // Get département
        $dep = model(ChefModel::class)->db->table('Départements')
        ->where('chef_département', (int)$arr['id_utilisateur'])
        ->get()
        ->getRowArray();
        $arr['professeur']['chef'] = $dep;
        return $arr;
    }
}