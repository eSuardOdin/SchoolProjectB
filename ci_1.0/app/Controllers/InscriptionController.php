<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Entities\Département;
use CodeIgniter\Controller;
use App\Models\DépartementModel;

class InscriptionController extends BaseController
{
    public function index() {}

    public function choix_département()
    {
        $session = session();
        // Redirige si non élève
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

}