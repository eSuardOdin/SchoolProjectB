<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Entities\Département;
use App\Entities\Cycle;
use App\Entities\Eleve;
use CodeIgniter\Controller;
use App\Models\CycleModel;
use App\Models\DépartementModel;
use App\Models\EleveModel;
use CodeIgniter\Model;

class InscriptionController extends BaseController
{
    public function index() 
    {
    }

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


    /**
     * Obtenir toutes les demandes d'inscription en cours
     * dans un département
     */
    private function get_demandes(int $id_dep): array
    {
        $model = model(Model::class);
        /* Find les id's des cycles du département
           pour trier les demandes */
        $cycles = $model->db->table('Cycles')
        ->select('`id_cycle`')
        ->where('`id_département` = ' . $id_dep);

        // Trier les demandes
        $demandes = model(EleveModel::class)->db->table('Elèves_Cycles')
        ->whereIn('`Elèves_Cycles`.`id_cycle`', $cycles)
        ->where('demande_cycle', true)
        ->orderBy('id_cycle')
        ->get()
        ->getResultArray();
        
        $res = [];
        
        // Les id des cycles demandés deviennent des clé de tableau
        foreach ($demandes as $demande) {
            if(!isset($res[$demande['id_cycle']]))
            {
                $res[$demande['id_cycle']] = []; 
            }
            // Get l'entity Cycle
            $idCycle = (int)$demande['id_cycle'];
            $cycle = model(CycleModel::class)->find($idCycle);
            // Nom
            $nomCycle = $cycle->get_nom_cycle();
            $res[$demande['id_cycle']]['nom_cycle'] = $nomCycle;
            // Places
            $placeCycle = $cycle->get_places_cycle();
            $res[$demande['id_cycle']]['places_restantes'] = $placeCycle;
            if(!isset($res[$demande['id_cycle']]['élèves']))
            {
                // Elèves
                $res[$demande['id_cycle']]['élèves'] = [];
            }
            foreach ($demandes as $innerDemande) {
                if($innerDemande['id_cycle'] === $demande['id_cycle'])
                {
                    $eleveEntry = [];
                    $eleve = model(EleveModel::class)->find((int)$demande['id_élève']);
                    $eleveEntry['nom'] = $eleve->get_nom();

                    $res[$demande['id_cycle']]['élèves'][$demande['id_élève']] = $eleveEntry;
                }
            }

            
        }
        /* Renvoyer :
        Demande {
            [id_cycle] : {
                nom_cycle : "nom du cycle",
                places_restantes : places,
                élèves : {
                    [id_élève] : {
                        nom : "nom",
                        prénom : "prénom",
                        instrument : "nom instrument"
                    }
                }
            }
        }
        */
        return $res;
        // return $demandes;
    }

    public function afficher_demandes()
    {
        $session = session();
        // Redirect si non chef
        if(!isset($_SESSION['user_data']['professeur']['chef']))
        {
            return redirect()->to('menu');
        }

        // Get l'id du departement concerné
        $departement = (int)$_SESSION['user_data']['professeur']['chef']['id_département']; 
        $session->set('demandes', $this->get_demandes($departement));
        return view('utilisateurs/professeur/chef/demandes');
    }

}