<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateursModel extends Model{
    protected $table      = 'Utilisateurs';
    // Uncomment below if you want add primary key
    //protected $primaryKey = 'id_utilisateur';

    protected $allowedFields = [
        'nom_utilisateur',
        'prénom_utilisateur',
        'pwd_utilisateur',
        'login_utilisateur',
    ];
    private $role = [
        'élève' => null,
        'professeur' => null,
        'directeur' => null,
    ];

    public function set_role($id)
    {
        // Check si professeur
        $this->role['professeur'] = $this->db->table('Utilisateurs')
        ->select('Utilisateurs.id_utilisateur')
        ->join('Professeurs', 'Professeurs.id_professeur = Utilisateurs.id_utilisateur', 'inner')
        ->where('Utilisateurs.id_utilisateur', $id)
        ->get()
        ->getRowArray();

        
        if($this->role['professeur'] !== null)
        {
            /* Check les matières enseignées */
            // Get les id des matières comme subquery pour la clause IN
            $id_matieres = $this->db->table('Matières_Professeurs')
            ->distinct()
            ->select('`id_matière`')
            ->where('id_professeur = ' . $id);

            // Get les matières
            $matieres = $this->db->table('Matières')
            ->whereIn('`Matières`.`id_matière`', $id_matieres)
            ->get()
            ->getResultArray();
            
            // Affectation des datas matières
            if($matieres !== null)
            {
                $this->role['professeur']['matières'] = $matieres;
            }

            // Check si chef département
            $is_chef = $this->db->table('Départements')
            ->where('`Départements`.`chef_département`', $id)
            ->get()
            ->getRowArray();
            // Affectation des datas chefs
            if($is_chef !== null)
            {
                $this->role['professeur']['chef'] = $is_chef;
            }
        }
        
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