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
        $eleveModel->eleve_demande_cycle($id_cycle, $id_eleve);


        // Cycle
        $cycle = (model(CycleModel::class))->find($id_cycle);
        // Nom du département
        $depNom = (model(DépartementModel::class)->find($cycle->get_id_departement()))->get_nom_departement();

        // Rajouter les infos de la demande à afficher dans la session
        $newData = $session->get('user_data');
        $newData['élève']['demande']['infos'] = $cycle->get_nom_cycle() . " (Département " . $depNom . ")";
        $session->set('user_data', $newData);
        return view('inscription/demande');
    }

}