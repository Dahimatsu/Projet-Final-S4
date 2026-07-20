<?php

namespace App\Models;

use CodeIgniter\Model;

class GainModel extends Model
{
    protected $table = 'gain';
    protected $primaryKey = 'id_gain';
    protected $allowedFields = ['id_operation', 'montant_gain'];

    public function getGainsDetails()
    {
        return $this->select('gain.*, operation.montant, operation.date_operation, compte_client.nom as client_nom')
            ->join('operation', 'operation.id_operation = gain.id_operation')
            ->join('compte_client', 'compte_client.id_client = operation.id_client')
            ->orderBy('operation.date_operation', 'DESC')
            ->findAll();
    }
}