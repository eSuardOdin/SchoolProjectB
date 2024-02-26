<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model{
    protected $table      = 'Utilisateurs';
    protected $primaryKey = 'id_utilisateur';

    protected $allowedFields = [
        'nom_utilisateur',
        'prénom_utilisateur',
        'pwd_utilisateur',
    ];

    protected $useAutoIncrement = true;
    protected $returnType     = \App\Entities\Utilisateur::class;
    protected bool $allowEmptyInserts = false;

    public function get_by_login($login)
    {
        return $this->db->table('Utilisateurs')
        ->where('login_utilisateur', $login)
        ->get()
        ->getRowArray();
    }
}