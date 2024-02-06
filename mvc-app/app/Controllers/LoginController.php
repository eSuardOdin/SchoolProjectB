<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateurModel;
use App\Models\ProfesseurModel;
use App\Helpers\UtilisateurFactory;

class LoginController extends BaseController
{


    public function index()
    {
        // Detruire la précédente session
        $this->logout();
        
        $session = session();
        helper('form');
        $data['error'] = null;
        return view('log', $data);
    }


    /**
     * Check le login et mot de passe d'un utilisateur. 
     * @return RedirectResponse en fonction de la réussite de l'authentification
     */
    public function authenticate()
    {
        helper('form');
        // Instance de la session et du model user
        $session = session();
        $userModel = model(UtilisateurModel::class);

        // Variables du post
        $login = $this->request->getVar('login');
        $password = $this->request->getVar('password');

        // Get l'utilisateur dans la db
        $user = $userModel->where('login_utilisateur', $login)->first();

        // Si user non existant
        if(is_null($user))
        {
            return redirect('/')->withInput()->with('error', 'Utilisateur inconnu');
        }

        // Check le password (si hash)
        //$pwdVerif = password_verify($password, $user['pwd_utilisateur']);
        
        // Check le password
        $pwdVerif = $password == $user['pwd_utilisateur'];
        if(! $pwdVerif)
        {
            return redirect('/')->withInput()->with('error', 'Utilisateur inconnu ou mauvais mot de passe');
        }

        // Attribution de l'id
        $userModel->set_basic_data($user['id_utilisateur']);
        
        $userModel = UtilisateurFactory::upgrade_utilisateur($userModel, $user['id_utilisateur']);

        // Set de la session avec data utilisateur
        // $userData = $userModel->get_data();
        $userData = [
            'is_logged' => true,
            'logged_user' => $userModel->get_data()
        ];
        $session->set($userData);
        
        // Menu principal
        return redirect('menu');
    }

    public function logout()
    {
        $session = session();
        $session->remove(['logged_user', 'is_logged']);
        $session->destroy();
        return redirect()->to('/');
    }
}