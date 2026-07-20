<?php

namespace App\Models;

use CodeIgniter\Model;

class BaremeFraisModel extends Model
{
    protected $table = 'bareme_frais';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type_operation_id', 'montant_min', 'montant_max', 'frais'];

    public function getBaremesWithTypes()
    {
        return $this->select('bareme_frais.*, type_operation.nom as type_nom')
            ->join('type_operation', 'type_operation.id = bareme_frais.type_operation_id')
            ->findAll();
    }

    public function calculFrais(int $typeOperationId, float $montant)
    {
        $bareme = $this->where('type_operation_id', $typeOperationId)
                       ->where('montant_min <=', $montant)
                       ->where('montant_max >=', $montant)
                       ->first();

        return $bareme ? $bareme['frais'] : 0.00;
    }
}