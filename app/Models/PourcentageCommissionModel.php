<?php

namespace App\Models;

use CodeIgniter\Model;

class PourcentageCommissionModel extends Model
{
    protected $table = 'pourcentage_commission';
    protected $primaryKey = 'id_pourcentage_commission';
    protected $allowedFields = ['pourcentage'];
}