<?php
namespace App\Models;
use CodeIgniter\Model;

class OperationModel extends Model
{
    protected $table = 'operation';
    protected $primaryKey = 'id_operation';
    protected $allowedFields = ['id_client', 'type_operation_id', 'montant', 'numero_destinataire', 'date_operation', 'frais'];

    // Fonction pour récupérer l'historique avec le nom du type d'opération
    public function getHistoriqueClient($id_client)
    {
        return $this->select('operation.*, type_operation.nom as type_nom')
            ->join('type_operation', 'type_operation.id = operation.type_operation_id')
            ->where('operation.id_client', $id_client)
            ->orderBy('operation.date_operation', 'DESC')
            ->findAll();
    }
}