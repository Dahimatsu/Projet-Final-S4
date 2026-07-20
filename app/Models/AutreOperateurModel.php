<?php

namespace App\Models;

use CodeIgniter\Model;

class AutreOperateurModel extends Model
{
    protected $table = 'autre_operateur';
    protected $primaryKey = 'id_autre_operateur';
    protected $allowedFields = ['prefixe', 'nom_operateur'];
}