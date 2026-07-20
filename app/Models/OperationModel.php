<?php

namespace App\Models;

use CodeIgniter\Model;

class OperationModel extends Model
{
    protected $table = 'operation';
    protected $primaryKey = 'id_operation';

    protected $allowedFields = [
        'type_operation_id',
        'id_client',
        'numero_destinataire',
        'montant',
        'frais',
        'date_operation'
    ];

    public function getOperationsDetails()
    {
        return $this->select('operation.*, 
                              type_operation.nom as type_nom, 
                              c1.nom as source_nom, 
                              c2.nom as destinataire_nom')
            ->join('type_operation', 'type_operation.id = operation.type_operation_id')
            ->join('client as c1', 'c1.id = operation.id_client', 'left')
            ->join('client as c2', 'c2.id = operation.numero_destinataire', 'left')
            ->orderBy('operation.date_operation', 'DESC')
            ->findAll();
    }
}