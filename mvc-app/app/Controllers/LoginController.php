<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateursModel;
class LoginController extends BaseController
{

    public function index()
    {
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
        $userModel = model(UtilisateursModel::class);

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


        // Test rôle
        $userModel->set_role($user['id_utilisateur']);
        echo '<pre>';
        echo print_r($userModel->get_role());
        echo '</pre>';

        /*
        // Set de la session avec data utilisateur
        $userData = [
            'id' => $user['id_utilisateur'],
            'nom' => $user['nom_utilisateur'],
            'prénom' => $user['prénom_utilisateur'],
            'is_logged' => true
        ];
        $session->set($userData);
        
        // Menu principal
        return redirect('menu');
        */
    }

    public function logout()
    {
        $session = session();
        $session->remove(['id', 'nom', 'prénom', 'is_logged']);
        return redirect()->to('/');
    }
}