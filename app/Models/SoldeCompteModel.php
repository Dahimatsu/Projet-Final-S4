<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeCompteModel extends Model
{
    protected $table            = 'solde_compte';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_client', 'solde'];

}
