<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table            = 'compte_client';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['numero_telephone', 'nom', 'prenom'];

    public function clientExiste(string $champ, $valeur): bool
    {
        return $this->where($champ, $valeur)->first() !== null;
    }

}
