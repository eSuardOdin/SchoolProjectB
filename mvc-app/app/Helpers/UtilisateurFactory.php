<?php
namespace App\Helpers;
use App\Models\ProfesseurModel;
use App\Models\UtilisateurModel;
class UtilisateurFactory
{
    static function upgrade_utilisateur(UtilisateurModel $user, $id)
    {
        $user->set_role($id);
        if($user->get_role()['professeur'] !== null)
        {
            return new ProfesseurModel($id);
        }
    } 
}