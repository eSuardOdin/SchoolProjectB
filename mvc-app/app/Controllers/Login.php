<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateursModel;
class Login extends Controller
{

    public function index(): string
    {
        helper('form');
        $data['error'] = null;
        return view('logging', $data);
    }


    public function authenticate()
    {
        helper('form');
        // Instance de la session
        $session = session();
        // echo '<pre>';
        // echo var_dump($_SESSION);
        // echo '</pre>';

        $userModel = model(UtilisateursModel::class);

        // Variables du post
        $login = $this->request->getVar('login');
        $password = $this->request->getVar('password');

        // Get l'utilisateur dans la db
        $user = $userModel->where('login_utilisateur', $login)->first();

        // Si user non existant
        if(is_null($user))
        {
            return redirect()->back()->withInput()->with('error', 'Utilisateur inconnu');
        }
        
    }
}