<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateursModel;
class MenuController extends BaseController
{

    private function check_logged(): bool
    {
        $session = session();
        if(!$session->has('is_logged'))
        {
            return false;
        }
        elseif($session->get('is_logged') === null || $session->get('is_logged') == false)
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
            return view('utilisateurs/menu');
        }
    }

    
}