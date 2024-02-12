<?php
declare(strict_types=1);
namespace App\Controllers;

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
        $deps = $depModel->select('*')
        ->get()
        ->getResultArray();

        $session->set('départements', $deps);

        echo '<pre>';
        echo var_dump($_SESSION);
        echo '<pre>';
    }

}