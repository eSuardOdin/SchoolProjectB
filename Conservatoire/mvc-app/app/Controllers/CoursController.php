<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ChefModel;
use App\Models\MatièreModel;


class CoursController extends BaseController
{

    // Extend le BaseController pour faire mes propres controllers
    // car cette method sera dans tous les controllers
    private function check_logged(): bool
    {
        log_message('info', 'Entrée dans la gestion du logged test');
        $session = session();
        if(!$session->has('logged_user'))
        {
            return false;
        }
        elseif($session->get('logged_user') === null)
        {
            return false;
        }
        return true;
    }

    // Afficher le menu cours à un chef de département, il pourra
    // sélectionner un cycle de son département et voir, ajouter et
    // supprimer la matière. (à voir, la matière serait déjà associée
    // à un cycle par le directeur ?)

    // !!!! CHANGER ET RAJOUTER UNE MANY TO MANY MATIERES CYCLES
    public function index()
    {
        $session = session();
        // Check si l'user est bien connecté
        if(!$this->check_logged())
        {
            return redirect('/');
        } else
        {
            log_message('info', 'Entrée dans la gestion des cours');
            // Check si le rôle est bien chef de département
            $user = $session->get('logged_user');
            if(isset($user['chef']))
            {
                $matière_model = model(MatièreModel::class);
                $session->set('matières', $matière_model->get_matières_département($user['chef']->id_département));
                return view('utilisateurs/professeur/chef/cours');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }

    
}