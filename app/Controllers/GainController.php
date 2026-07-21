<?php

namespace App\Controllers; // Ou App\Controllers\Admin

use App\Controllers\BaseController;
use App\Models\HistoriqueGainModel;
use App\Models\OperationModel;
use App\Models\PrefixeYasModel;

class GainController extends BaseController
{
    public function index()
    {
        $gainModel = new HistoriqueGainModel();
        $operationModel = new OperationModel();
        $prefixeModel = new PrefixeYasModel();

        // 1. Récupération de tous les préfixes YAS (ex: 034, 038)
        $prefixesYas = array_column($prefixeModel->findAll(), 'code');

        // 2. Calcul des totaux en parcourant les opérations
        $toutesOperations = $operationModel->where('frais >', 0)->findAll();

        $totalGlobal = 0;
        $totalGainsAutres = 0;

        foreach ($toutesOperations as $op) {
            $totalGlobal += $op['frais'];

            // Si c'est un transfert (type 3) vers un autre opérateur
            if ($op['type_operation_id'] == 3 && !empty($op['numero_destinataire'])) {
                $prefixeDest = substr($op['numero_destinataire'], 0, 3);
                if (!in_array($prefixeDest, $prefixesYas)) {
                    // On considère que le gain généré sur cette ligne est destiné à l'autre opérateur
                    $totalGainsAutres += $op['frais'];
                }
            }
        }

        $totalGainsYas = $totalGlobal - $totalGainsAutres;

        // 3. Récupération des données pour le tableau avec pagination
        $gains = $operationModel->select('operation.*, compte_client.nom as client_nom, compte_client.prenom as client_prenom, compte_client.numero_telephone as client_numero')
            ->join('compte_client', 'compte_client.id_client = operation.id_client')
            ->where('operation.frais >', 0)
            ->orderBy('operation.date_operation', 'DESC')
            ->paginate(10);

        $data = [
            'totalGains' => $totalGlobal,
            'totalGainsYas' => $totalGainsYas,
            'totalGainsAutres' => $totalGainsAutres,
            'gains' => $gains,
            'pager' => $operationModel->pager,
            'prefixesYas' => $prefixesYas 
        ];

        return view('back-office/gains', $data);
    }
}