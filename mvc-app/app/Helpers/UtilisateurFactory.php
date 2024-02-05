<?php
namespace App\Helpers;
use App\Models\ProfesseurModel;
use App\Models\ChefModel;
use App\Models\UtilisateurModel;
use App\Models\EleveModel;
class UtilisateurFactory
{
    static function upgrade_utilisateur(UtilisateurModel $user, $id)
    {
        $user->set_role($id);
        if($user->get_role()['professeur'] !== null)
        {
            $prof = new ProfesseurModel();
            $prof->set_basic_data($id);
            $prof->set_data();
            if(! isset($prof->get_data()['chef']))
            {
                return $prof;
            }
            else
            {
                $chef = new ChefModel($prof->get_data());
                return $chef;
            }
        }
        elseif($user->get_role()['élève'] !== null)
        {
            $eleve = new EleveModel();
            $eleve->set_basic_data($id);
            $eleve->set_data();

            return $eleve;
        }
    } 
}