<?php 
namespace App\Controllers;

use App\Models\DépartementModel;
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
        if(!$session->has('user_data'))
        {
            return false;
        }
        elseif($session->get('user_data') === null)
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
            $user = $session->get('user_data');
            if(isset($user['professeur']['chef']))
            {
                $matière_model = model(MatièreModel::class);
                $session->set('matières', $matière_model->get_matières_département($user['professeur']['chef']['id_département']));
                return view('utilisateurs/professeur/chef/cours');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }

    public function show_matière_form()
    {
        $session = session();
        // Check si l'user est bien connecté
        if(!$this->check_logged())
        {
            return redirect('/');
        } else
        {
            log_message('info', 'Entrée dans le show form add matière');
            // Check si le rôle est bien chef de département
            $user = $session->get('user_data');
            if(isset($user['professeur']['chef']))
            {
                $dep_model = model(DépartementModel::class);
                // Trouver les cycles du départements
                $id_dep = (int)$user['professeur']['chef']['id_département'];
                $cycles = [];
                foreach(($dep_model->find($id_dep))->get_departement_cycles() as $c)
                {
                    array_push($cycles, [$c->id_cycle, $c->nom_cycle]);
                }
                $session->set('cycles', $cycles);
                return view('utilisateurs/professeur/chef/add_matière');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }
    
}