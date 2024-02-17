<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Entities\Département;
use CodeIgniter\Controller;
use App\Models\CycleModel;
use App\Models\DépartementModel;
use App\Models\EleveModel;
class InscriptionController extends BaseController
{
    public function index() {}

    public function choix_département()
    {
        $session = session();
        // Redirige si non eleve
        if(!isset(($session->get('user_data'))['élève']))
        {
            return redirect('/');
        }
        $depModel = model(DépartementModel::class);
        $deps = $depModel->findAll();

        $session->set('départements', $deps);

        return view('inscription/départements');
    }

    public function choix_cycle()
    {
        $session = session();
        // Clean la session
        $session->remove('départements');
        
        // Get le département
        $id_dep = $this->request->getVar('dep');
        $depModel = model(DépartementModel::class);
        $dep = $depModel->find((int)$id_dep);
        
        // Redirect si erreur (à changer)
        if($dep === null)
        {
            return redirect('/');
        }

        // Get les cycles et les set session
        $cycles =$dep->get_departement_cycles();
        $session->set('cycles', $cycles);

        return view('inscription/cycles');
    }


    public function inscrire_eleve()
    {
        $session = session();
        // Clean la session
        $session->remove('cycles');


        $id_cycle = (int)($this->request->getVar('cycle'));
        $id_eleve = (int)($session->get('user_data')['id_utilisateur']);
        $eleveModel = model(EleveModel::class);
        // Insertion dans la db
        $eleveModel->eleve_demande_cycle($id_cycle, $id_eleve);

        // Redirection pour traiter la vue
        return redirect()->to('inscription/demande/' . $id_eleve);
    }


    public function voir_demande($idEleve)
    {
        $session = session();
        $idEleve = (int)$idEleve;
        // Get le cycle demandé
        $cycle = model(CycleModel::class)->find((int)(model(EleveModel::class)->find($idEleve))->get_demande_cycle_élève($idEleve)['id_cycle']);
        // Get le nom du département demandé
        $departement = (model(DépartementModel::class)->find($cycle->get_id_departement()))->get_nom_departement();
        // Set les infos sur la demande
        $session->set('demande', $cycle->get_nom_cycle() . ' (' . $departement . ')');
        return view('inscription/demande');
    }

}