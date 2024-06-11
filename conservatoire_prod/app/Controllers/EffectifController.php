<?php 
namespace App\Controllers;

use App\Models\CycleModel;
use App\Models\EleveModel;
use App\Models\InstrumentModel;
use CodeIgniter\Controller;
class EffectifController extends BaseController
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

    // Affiche la liste des élèves
    public function index()
    {
        $session = session();
        // Check si l'user est bien connecté
        if(!$this->check_logged())
        {
            return redirect('/');
        }
        if($session->get('user_data')['role'] == "élève")
        {
            return redirect('/');
        }
        // Si l'utilisateur est chef
        $res = [
            "chef" => [],
            "professeur" => []
        ];
        if(isset($session->get('user_data')['professeur']['chef']))
        {
            // Get tous les élèves du département où l'user est chef
            $cycleModel = new CycleModel();
            $eleveModel = new EleveModel();
            $instrumentModel = new InstrumentModel();
            $cycles = $cycleModel->get_cycles_departement($session->get('user_data')['professeur']['chef']['id_département']);
            foreach ($cycles as $c)
            {
                $elèves = $eleveModel->get_élèves_by_cycle($c->id_cycle);
                foreach ($elèves as $e) {
                    array_push($res['chef'], [
                        "élève" => $e->nom_utilisateur . ' ' . $e->prénom_utilisateur,
                        "instrument" => $instrumentModel->find($e->id_instrument)->nom_instrument,
                        "cycle" => $c->nom_cycle
                    ]);
                }
            }
        }


        // Get les élèves en cours avec le professeur
        

        $session->set('élèves', $res);
        
        return view('/utilisateurs/professeur/effectif');
    }
}