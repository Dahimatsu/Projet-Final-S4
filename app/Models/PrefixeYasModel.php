<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeYasModel extends Model
{
    protected $table = 'prefixe_yas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code'];
}