<?php
namespace App\Models;
use CodeIgniter\Model;

class BaremeFraisModel extends Model
{
    protected $table = 'bareme_frais';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type_operation_id', 'montant_min', 'montant_max', 'frais'];

    public function calculFrais($typeId, $montant)
    {
        $row = $this->where('type_operation_id', $typeId)
            ->where('montant_min <=', $montant)
            ->where('montant_max >=', $montant)
            ->first();
        return $row ? $row['frais'] : 0;
    }
}