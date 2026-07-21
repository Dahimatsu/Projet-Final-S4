<?php

namespace App\Models;

use CodeIgniter\Model;

class PromotionTransfertModel extends Model
{
    protected $table = 'promotion_transfert';
    protected $primaryKey = 'id_promotion';
    protected $allowedFields = ['id_operation','pourcentage'];
}