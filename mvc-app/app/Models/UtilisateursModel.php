<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateursModel extends Model{
    protected $table      = 'Utilisateurs';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom_utilisateur',
        'prénom_utilisateur',
        'pwd_utilisateur',
        'login_utilisateur',
    ];

    /*public function getUtilisateur($login, $password)
    {
        $sql = 'SELECT * FROM Utilisateurs WHERE login_utilisateur = :login: AND pwd_utilisateur = :pwd:';
        $db = db_connect();
        return $db->query($sql, [
            'login' => $login,
            'pwd' => $password])->getRowArray();
    }*/
}