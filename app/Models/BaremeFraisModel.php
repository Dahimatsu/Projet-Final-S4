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
            ->orderBy('type_operation.nom', 'ASC')
            ->orderBy('bareme_frais.montant_min', 'ASC')
            ->findAll();
    }

    public function getBaremesWithTypesFiltered($typeId)
    {
        return $this->select('bareme_frais.*, type_operation.nom as type_nom')
            ->join('type_operation', 'type_operation.id = bareme_frais.type_operation_id')
            ->where('bareme_frais.type_operation_id', $typeId)
            ->findAll();
    }
}