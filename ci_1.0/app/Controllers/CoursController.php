<?php 
namespace App\Controllers;

use App\Entities\Matière;
use App\Models\DépartementModel;
use App\Models\ProfesseurModel;
use CodeIgniter\Controller;
use App\Models\ChefModel;
use App\Models\MatièreModel;
use App\Models\CycleModel;


class CoursController extends BaseController
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

    // Afficher le menu cours à un chef de département, il pourra
    // sélectionner un cycle de son département et voir, ajouter et
    // supprimer la matière. (à voir, la matière serait déjà associée
    // à un cycle par le directeur ?)

    // !!!! CHANGER ET RAJOUTER UNE MANY TO MANY MATIERES CYCLES
    public function index()
    {
        $session = session();
        // Check si l'user est bien connecté
        if(!$this->check_logged())
        {
            return redirect('/');
        } else
        {
            log_message('info', 'Entrée dans la gestion des cours');
            // Check si le rôle est bien chef de département
            $user = $session->get('user_data');
            if(isset($user['professeur']['chef']))
            {
                $matière_model = model(MatièreModel::class);
                $session->set('matières', $matière_model->get_matières_département($user['professeur']['chef']['id_département']));
                return view('utilisateurs/professeur/chef/cours');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }

    public function show_matière_form()
    {
        $session = session();
        // Check si l'user est bien connecté
        if(!$this->check_logged())
        {
            return redirect('/');
        } else
        {
            log_message('info', 'Entrée dans le show form add matière');
            // Check si le rôle est bien chef de département
            $user = $session->get('user_data');
            if(isset($user['professeur']['chef']))
            {
                $dep_model = model(DépartementModel::class);
                // Trouver les cycles du départements
                $id_dep = (int)$user['professeur']['chef']['id_département'];
                $cycles = [];
                foreach(($dep_model->find($id_dep))->get_departement_cycles() as $c)
                {
                    array_push($cycles, [$c->id_cycle, $c->nom_cycle]);
                }
                $session->set('cycles', $cycles);
                return view('utilisateurs/professeur/chef/add_matière');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }


    // Traitement de l'ajout d'une matière
    public function traiter_ajout_matière()
    {
        
        $matière_model = new MatièreModel();
        // Create
        $matière = new Matière();
        $matière->nom_matière = $this->request->getVar('nom_matière');
        $matière->max_élève_matière = $this->request->getVar('max_élèves_matière');
        $matière->durée_matière = $this->request->getVar('durée_matière');
        $matière->id_cycle = $this->request->getVar('id_cycle');

        // Sauvegarde de la matière
        $matière_model->save($matière);
        return redirect('cours');
    }


    // Montre le formulaire de création de créneau
    public function show_creneau_form()
    {
        $session = session();
        // Check si l'user est bien connecté
        if(!$this->check_logged())
        {
            return redirect('/');
        } else
        {
            log_message('info', 'Entrée dans le show form add créneau');
            // Check si le rôle est bien chef de département
            $user = $session->get('user_data');
            if(isset($user['professeur']['chef']))
            {
                $dep_model = model(DépartementModel::class);
                // Trouver les cycles du départements
                $id_dep = (int)$user['professeur']['chef']['id_département'];
                $cycles = [];
                foreach(($dep_model->find($id_dep))->get_departement_cycles() as $c)
                {
                    array_push($cycles, [$c->id_cycle, $c->nom_cycle]);
                }
                $session->set('cycles', $cycles);
                return view('utilisateurs/professeur/chef/add_creneau');
            }
            // Rediriger si rôle non valide 
            else { return redirect('menu'); }
        }
    }
    
    // Return les matières d'un cycle
    public function show_matières()
    {
        $cycle_mod = new CycleModel();
        $matières = $cycle_mod->get_matières_cycle((int)$this->request->getVar('cycles'));
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($matières);
    }

    // Return les options de choix de créneau
    public function show_horaires()
    {
        $durée = (int)$this->request->getVar('durée');
        if($durée == -1) return;
        // Get les heures et les minutes
        $h = intval($durée / 60);
        $m = intval($durée % 60);
        $creneaux = [];
        // Fin du dernier cours à 17h, on set la dernière heure possible du créneau
        $limite_h = $m == 0 ? 17 - $h : 16 - $h;
        $minutes = [];
        // Set des minutes
        if($m > 0 && $m <= 15)
        {
            $minutes = [0, 15, 30, 45];
        }
        elseif($m > 15 && $m <= 30)
        {
            $minutes = [0, 15, 30];
        }
        elseif($m > 30 && $m <= 45)
        {
            $minutes = [0, 15];
        }
        else
        {
            $minutes = [0];
        }
        // Remplissage des heures / minutes possibles ({[heure: n, minutes: [0, 15, 30, 45]]})
        for($i = 8; $i <= $limite_h; $i++)
        {
            if($i != $limite_h)
            {
                array_push($creneaux, [
                    "heure" => $i,
                    "minutes" => [0, 15, 30, 45] 
                ]);
            }
            else
            {
                array_push($creneaux, [
                    "heure" => $i,
                    "minutes" => $minutes 
                ]);
            }
        }
        echo json_encode($creneaux);
    }

    public function show_profs()
    {
        $prof_model = new ProfesseurModel();
        // echo json_encode(["id" => $this->request->getVar("id_matière"), "durée" => $this->request->getVar("durée")]);
        
        // echo json_encode($prof_model->get_professeur_from_matière($this->request->getVar("id_matière")));
        $test = [];
        foreach ($prof_model->get_professeur_from_matière($this->request->getVar("id_matière")) as $p) {
            array_push($test, $prof_model->is_prof_free($p->id_professeur, 0, 0));
        }
        echo json_encode($test);
    }
}