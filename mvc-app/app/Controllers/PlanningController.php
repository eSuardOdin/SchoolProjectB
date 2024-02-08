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
            $user = $session->get('logged_user');
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