<?php

namespace App\Models;

use CodeIgniter\Model;

class EpargneModel extends Model
{
    protected $table            = 'epargnes';
    protected $primaryKey       = 'id_client';
    protected $allowedFields    = ['id_client', 'montant'];

}
