<?php
declare(strict_types=1);
namespace App\Controllers;

use CodeIgniter\Controller;
// Entities
use App\Entities\Département;
use App\Entities\Cycle;
use App\Entities\Eleve;
use App\Entities\Instrument;
// Models
use App\Models\CycleModel;
use App\Models\EleveCycleModel;
use App\Models\DépartementModel;
use App\Models\EleveModel;
use App\Models\UtilisateurModel;
use App\Models\InstrumentModel;
use CodeIgniter\Model;

class InscriptionController extends BaseController
{
    public function index() 
    {
        helper('url');


        // Si l'utilisateur est déjà connecté, retour au menu
        $session = session();
        if($session->has('user_data'))
        {
            return redirect('menu');
        }

        // Ajout des familles d'instruments dans la session
        $instrumentModel = model(InstrumentModel::class);
        $familles = $instrumentModel->db->table('Instruments')
        ->select('famille_instrument')
        ->distinct()
        ->get()
        ->getResultArray();

        $oneDimensionFamille = [];
        foreach ($familles as $famille) {
            array_push($oneDimensionFamille, $famille['famille_instrument']);
        }
        $session->set('famille_instrument', $oneDimensionFamille);
        return view('inscription/utilisateur');
    }

    /**
     * Inscription de l'utilisateur 
     */
    public function inscrire_utilisateur()
    {
        $nom = $this->request->getVar("nom");
        $prenom = $this->request->getVar("prénom");
        $login = $this->request->getVar("login");
        $pwd = $this->request->getVar("pwd");
        $idInstrument = $this->request->getVar("instrument_id");
        $data = [
            'nom_utilisateur' => $nom,
            'prénom_utilisateur' => $prenom,
            'login_utilisateur' => $login,
            'pwd_utilisateur' => $pwd,
            'id_instrument' => $idInstrument
        ];
        // Insertion user et élève
        $new_user_id = model(UtilisateurModel::class)->insert($data);
        $data_eleve = [
            "id_élève" => $new_user_id
        ];
        $eleve_id = model(EleveModel::class)->insert($data_eleve);

        // Get les data élève
        $user = model(UtilisateurModel::class)->find($eleve_id);


        // Redirection vers le login controller
        $session = session();
        $data = [
            'login' => $login,
            'password' => $pwd
        ];
        $session->set('identifiants', $data);
        return redirect()->to('login');
    }


    /**
     * L'élève choisit un département où son
     * instrument est enseigné 
     */
    public function choix_département()
    {
        $session = session();
        // Redirige si non eleve
        if(!isset(($session->get('user_data'))['élève']))
        {
            return redirect('/');
        }

        $db = model(Model::class)->db;
        // Get l'id instrument
        $idInstrument = (int)($db->table('Utilisateurs')
        ->select('id_instrument')
        ->where('id_utilisateur = ', (int)($session->get('user_data'))['id_utilisateur'])
        ->get()
        ->getRowArray())['id_instrument'];
        
        $idDeps = $db->table('Départements_Instruments')
        ->select('id_département')
        ->where('id_instrument = ', $idInstrument);
        
        $deps = $db->table('Départements')
        ->whereIn('`Départements`.`id_département`', $idDeps)
        ->get()
        ->getResultArray();
        
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
        $cycles = $dep->get_departement_cycles();
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
     * Voir les informations du cycle en cours d'un élève
     * et de demander une promotion 
     */
    public function voir_cycle()
    {
        // Déclaration des models
        $session = session();
        $cycleModel = model(CycleModel::class);
        $eleveModel = model(EleveModel::class);
        $eleveCycleModel = model(EleveCycleModel::class);

        // Get le cycle suivant
        $cycleEnfant = $cycleModel->get_cycle_enfant($session->get('user_data')['élève']['cycle']['id_cycle']);
        $cycleSession = array();
        // Savoir le statut du cycle suivant (si vide, pas de demande effectuée)
        $idCycleEnfant = -1;
        if(!empty($cycleEnfant))
        {
            $idCycleEnfant = $cycleEnfant['0']->id_cycle;
            // $cycleEleve = $eleveModel->get_statut_promotion($idCycleEnfant, $session->get('user_data')['id_utilisateur']);
            
            $cycleEleve = $eleveCycleModel->findInscription($idCycleEnfant, $session->get('user_data')['id_utilisateur']);
            $cycleSession = array(
                "id" => $idCycleEnfant,
                "nom" => $cycleEnfant['0']->nom_cycle,
                "statut" => $cycleEleve != null ? $cycleEleve->demande_cycle : false
            );
        }
        else
        {
            $cycleSession = array(
                "id" => $session->get('user_data')['élève']['cycle']['id_cycle'],
                "nom" => "Diplome",
                "statut" => false
            );
        }
        
        
        /* Ajouter le statut à la session
        si null -> bouton de demande
        sinon -> afficher "demande en cours pour le cycle [nom]
        */
        $session->set('promotion', $cycleSession);
        
        return view('utilisateurs/élève/cycle');
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
            // Check si demande = passage diplome
            if($demande['inscrit_cycle'])
            {
                // Nom
                $nomCycle = "Passage du DEM";
            }
            else
            {
                // Nom
                $nomCycle = $cycle->get_nom_cycle();
                // Places
                $placeCycle = $cycle->get_places_cycle();
                $res[$demande['id_cycle']]['places_restantes'] = $placeCycle;
            }
            $res[$demande['id_cycle']]['id_cycle'] = $idCycle; // Redondant... à améliorer
            $res[$demande['id_cycle']]['nom_cycle'] = $nomCycle;
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
                    $eleveEntry['id'] = (int)$demande['id_élève']; // Redondant... à améliorer
                    $eleveEntry['nom'] = $eleve->get_nom();
                    $eleveEntry['prénom'] = $eleve->get_prénom();
                    $eleveEntry['instrument'] = (model(InstrumentModel::class)->find($eleve->get_id_instrument()))->get_nom_instrument();
                    $res[$demande['id_cycle']]['élèves'][$demande['id_élève']] = $eleveEntry;
                }
            }
        }
        return $res;
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


    public function traiter_demande()
    {
        // Init de la variable de résultat d'action
        $resultat = [
            "adresse" => $_SERVER['HTTP_REFERER'],
            "message" => ""
        ];
        $idCycle = $this->request->getVar('id_cycle');
        $idEleve = $this->request->getVar('id_élève');
        $action = $this->request->getVar('action');
        $isDiplome = $this->request->getVar('demande_diplome');

        $cycleModel = model(CycleModel::class);
        $eleveCycleModel = model(EleveCycleModel::class);
        $model = model(Model::class);
        
        
        $nomElève = ($model->db->table('Utilisateurs')
            ->where('id_utilisateur = ' . $idEleve)
            ->get()
            ->getResult())[0]->nom_utilisateur;
        $nomCycle = ($model->db->table('Cycles')
            ->where('id_cycle = ' . $idCycle)
            ->get()
            ->getResult())[0]->nom_cycle;

        
        // Chercher si la demande est une primo inscription ou promotion
        $currentCycle = $eleveCycleModel->findCurrent($idEleve);




        // Accepter élève (update demande et inscrit)
        if($action === "Accepter")
        {
            // Si c'est une demande de promotion, on le desinscrit du cycle.
            if(!empty($currentCycle))
            {
                $eleveCycleModel->updateInscription($currentCycle->id_cycle, $idEleve, ['inscrit_cycle' => false, 'promu_cycle' => true]);
            }
            if(!$isDiplome)
            {
                $eleveCycleModel->updateInscription($idCycle, $idEleve, ['demande_cycle' => false, 'inscrit_cycle' => true]);
                $resultat["message"] = "L'élève " . $nomElève . " a été inscrit en " . $nomCycle;
            }
            else
            {
                $eleveCycleModel->updateInscription($idCycle, $idEleve, ['demande_cycle' => false, 'inscrit_cycle' => true, 'promu_cycle' => true]);
                $resultat["message"] = "L'élève " . $nomElève . " a passé son DEM avec succès ";
            }
        }
        // Refuser (supprimer l'entrée, faute de mieux pour le moment)
        else
        {
            if(!$isDiplome)
            {
                $model->db->table('Elèves_Cycles')
                ->where('id_cycle = ' . $idCycle . ' AND `id_élève` = ' . $idEleve)
                ->delete();
                $resultat["message"] = "L'élève " . $nomElève . " a été réfusé en " . $nomCycle;
            }
            else
            {
                $eleveCycleModel->updateInscription($idCycle, $idEleve, ['demande_cycle' => false]);
                $resultat["message"] = "L'élève " . $nomElève . " n'a pas réussi son DEM";
            }
        }

        // echo $resultat["message"];

        session()->set('action_result', $resultat);
        return view('resultat_action');
    }


    /**
     * Formule une demande de promotion d'élève
     */
    public function demande_promotion()
    {
        $session = session();
        $idCycleDemande = $this->request->getVar('id_cycle');
        $idCycle= $session->get('user_data')['élève']['cycle']['id_cycle'];
        $idEleve = $session->get('user_data')['id_utilisateur'];

        $eleveCycleModel = model(EleveCycleModel::class);
        
        // Check que le cycle et le cycle de promotion demandé sont differents (sinon c'est le diplome)
        if($idCycleDemande != $idCycle)
        {
            $eleveCycleModel->creer_demande($idCycleDemande, $idEleve);
        }
        else
        {
            $eleveCycleModel->updateInscription($idCycle, $idEleve, ['demande_cycle' => true]);
        }

        return view('utilisateurs/menu');
    }

    /**
     * Renvoie la liste des instruments de la famille reçue en post
     * pour pouvoir l'afficher dans le formulaire d'inscription.
     */
    public function get_instruments()
    {
        // Get la famille
        $famille =$this->request->getVar('famille_instrument');
        $session = session();
        // On vide les anciens instruments
        if($session->has('instruments'))
        {
            $session->remove('instruments');
        }
        $instruments = model(InstrumentModel::class)->db->table('Instruments')
        ->where('famille_instrument', $famille)
        ->get()
        ->getResultArray();
        
        $res = "";
        // Création des options du select à return
        foreach ($instruments as $instrument)
        {
            $res .= '
            <option value="' . $instrument['id_instrument'] . '">' 
                . $instrument['nom_instrument'] 
            . '</option>';
        }

        echo $res;
    }

    public function check_login()
    {
        $login = $this->request->getVar("login");
        $loginDb = model(UtilisateurModel::class)->get_by_login($login);
        if($loginDb != null) {
            echo "1";
        }
    }
}