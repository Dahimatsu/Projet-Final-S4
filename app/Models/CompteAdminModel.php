<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteAdminModel extends Model
{
    protected $table = 'compte_admin';
    protected $primaryKey = 'id_admin';
    
    protected $allowedFields = ['nom', 'prenom', 'email', 'mot_de_passe'];

}