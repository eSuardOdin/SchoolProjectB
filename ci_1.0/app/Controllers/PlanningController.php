<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
class PlanningController extends BaseController
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

    // Affiche la vue du planning en fonction du rôle professeur/élève
    // redirection si autre rôle 
    public function index()
    {
        $session = session();
        // Check si l'user est bien connecté
        if(!$this->check_logged())
        {
            return redirect('/');
        } else
        {
            log_message('info', 'Entrée dans la gestion du planning');
            // Rediriger en fonction du rôle
            $user = $session->get('user_data');
            if($user['role'] === 'professeur')
            {
                return view('utilisateurs/professeur/planning');
            }
            elseif($user['role'] === 'élève')
            {
                return view('utilisateurs/élève/planning');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }
}