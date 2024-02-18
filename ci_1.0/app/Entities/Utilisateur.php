<?php
declare(strict_types=1);
namespace App\Entities;
use CodeIgniter\Entity\Entity;

class Utilisateur extends Entity
{
    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }
    public function get_user_id(): int { return (int)$this->attributes['id_utilisateur']; }

    public function get_session_infos(): array 
    {
        $ret = [];
        $ret['id_utilisateur'] = (int)$this->attributes['id_utilisateur'];
        $ret['login_utilisateur'] = $this->attributes['login_utilisateur'];
        $ret['nom_utilisateur'] = $this->attributes['nom_utilisateur'];
        $ret['prénom_utilisateur'] = $this->attributes['prénom_utilisateur'];
        return $ret;
    }

    public function verify_password(string $pwd): bool
    {
        return $this->attributes['pwd_utilisateur'] == $pwd;
    }



    // Getters
    protected function get_nom()
    {
        return $this->attributes['nom_utilisateur'];
    }
}