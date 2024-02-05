<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model{
    protected $table      = 'Utilisateurs';
    // Uncomment below if you want add primary key
    //protected $primaryKey = 'id_utilisateur';

    protected $allowedFields = [
        'nom_utilisateur',
        'prénom_utilisateur',
        'pwd_utilisateur',
        'login_utilisateur',
    ];
    protected $role = [
        'élève' => null,
        'professeur' => null,
        'directeur' => null,
    ];
    protected $data = [];

    public function get_data()
    {
        return $this->data;
    }


    public function set_basic_data($id)
    {
        // $this->data['id'] = $id;
        $this->data['user_data'] = $this->db->table('Utilisateurs')
        ->where('id_utilisateur = ' . $id)
        ->get()
        ->getRow();
    }

    public function set_role($id)
    {
        
        // Check si professeur
        $this->role['professeur'] = $this->db->table('Utilisateurs')
        ->select('Utilisateurs.id_utilisateur')
        ->join('Professeurs', 'Professeurs.id_professeur = Utilisateurs.id_utilisateur', 'inner')
        ->where('Utilisateurs.id_utilisateur', $id)
        ->get()
        ->getRowArray();

        
        // Check si élève
        $this->role['élève'] = $this->db->table('Utilisateurs')
        ->select('Utilisateurs.id_utilisateur')
        ->join('Elèves', '`Elèves`.`id_élève` = `Utilisateurs`.`id_utilisateur`', 'inner')
        ->where('Utilisateurs.id_utilisateur', $id)
        ->get()
        ->getRowArray();


        // Check si directeur
        $this->role['directeur'] = $this->db->table('Utilisateurs')
        ->select('Utilisateurs.id_utilisateur')
        ->join('Directeurs', 'Directeurs.id_directeur = Utilisateurs.id_utilisateur', 'inner')
        ->where('Utilisateurs.id_utilisateur', $id)
        ->get()
        ->getRowArray();
    }
    public function get_role() 
    {
        return $this->role;
    } 
    
}