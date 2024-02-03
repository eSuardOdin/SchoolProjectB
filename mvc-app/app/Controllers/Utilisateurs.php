<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UtilisateursModel;
class Utilisateurs extends Controller
{
    /*public function connect()
    {
        helper('form');

        // $this IncomingRequest
        $data = $this->request->getPost(['login', 'password']);
        $obj = [
            'login' => $data['login'],
            'password' => $data['password']
        ];
        // No need for validation ?
        $user = model(UtilisateursModel::class);

        $user_data = $user->authenticate($obj['login'], $obj['password']);

        if(empty($user_data))
        {
            $data['error'] = "Connexion impossible";
            return view('logging', $data);
        }
        

        echo '<br>';
        echo var_dump($user_data);
        echo '</br>';
        // return view('utilisateurs/menu', $user_data);
    }*/
}