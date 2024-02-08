<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
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
                return view('utilisateurs/professeur/chef/cours');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }

    
}