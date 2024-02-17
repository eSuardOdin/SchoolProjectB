<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateurModel;
use App\Models\EleveModel;
use App\Models\ProfesseurModel;
use App\Models\ChefModel;
use App\Models\CycleModel;
use App\Models\DépartementModel;

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
        $session->remove('user_data');
        $userModel = model(UtilisateurModel::class);

        // Variables du post
        $login = $this->request->getVar('login');
        $password = $this->request->getVar('password');

        // Get l'utilisateur dans la db
        $user = $userModel->where('login_utilisateur', $login)->first();
        
        // Check si utilisateur et identifiants ok
        if(is_null($user) || !$user->verify_password($password))
        {
            return redirect('/')->withInput()->with('error', 'Identifiants incorrects');
        }

        // Check si élève
        $eleveModel = model(EleveModel::class);
        $eleve = $eleveModel->where('id_élève', $user->get_user_id())->first();
        if($eleve !== null)
        {
            $session->set('user_data', $eleve->append_role());
            // Si l'élève n'est pas dans un cycle
            if(($session->get('user_data'))['élève']['cycle'] === null)
            {
                // Si l'élève n'a pas encore fait de demande de cycle
                if(($session->get('user_data'))['élève']['demande'] === null)
                {
                    return redirect('inscription/département');     
                }
                // Si la demande est toujours en cours
                else
                {
                    // Cycle
                    $cycle = (model(CycleModel::class))->find((int)$session->get('user_data')['élève']['demande']['id_cycle']);
                    // Nom du département
                    $depNom = (model(DépartementModel::class)->find($cycle->get_id_departement()))->get_nom_departement();

                    // Rajouter les infos de la demande à afficher dans la session
                    $newData = $session->get('user_data');
                    $newData['élève']['demande']['infos'] = $cycle->get_nom_cycle() . " (Département " . $depNom . ")";
                    $session->set('user_data', $newData);
                    return view('inscription/demande');
                }
                // echo 'demande en cours';
            }
            // Menu d'un élève inscrit dans un cycle
            else
            {


            }
        }
        else
        {
            // On libère la mémoire
            $eleveModel = null;
            // Check si professeur
            $profModel = model(ProfesseurModel::class);
            $prof = $profModel->where('id_professeur', $user->get_user_id())->first();
            if($prof !== null)
            {
                // Check si chef
                $chefModel = model(ChefModel::class);
                $chef = $chefModel->where('id_chef', $user->get_user_id())->first();
                if($chef !== null)
                {
                    // On libère la mémoire
                    $profModel = null;
                    // Set des infos chef + prof
                    $session->set('user_data', $chef->append_chef($prof));
                    // On libère la mémoire
                    $prof = null;
                }
                else
                {
                    // On libère la mémoire
                    $chefModel = null;
                    // Set des infos prof
                    $session->set('user_data', $prof->append_role());
                }
            }
        }

        echo '<pre>';
        echo var_dump($_SESSION);
        echo '<pre>';

        // // Menu principal
        // return redirect('menu');
    }

    public function logout()
    {
        $session = session();
        $session->remove(['logged_user', 'is_logged']);
        $session->destroy();
        return redirect()->to('/');
    }
}