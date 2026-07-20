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

        // 1. Calcul du total des gains depuis la table historique_gain
        $totalGainsRecord = $gainModel->selectSum('montant_gain')->first();
        $totalGains = $totalGainsRecord['montant_gain'] ?? 0;

        // 2. Récupération des détails via la table operation (uniquement celles avec des frais)
        // On fait une jointure pour récupérer le nom et le prénom du client
        $gains = $operationModel->select('operation.date_operation, operation.montant, operation.frais as montant_gain, compte_client.nom as client_nom, compte_client.prenom as client_prenom')
            ->join('compte_client', 'compte_client.id_client = operation.id_client')
            ->where('operation.frais >', 0)
            ->orderBy('operation.date_operation', 'DESC')
            ->paginate(10); // Pagination (10 par page)

        $data = [
            'totalGains' => $totalGains,
            'gains' => $gains,
            'pager' => $operationModel->pager
        ];

        return view('back-office/gains', $data);
    }

    public function situation()
    {
        $operationModel = new OperationModel();
        $prefixeModel = new PrefixeYasModel();

        // 1. Récupérer dynamiquement les préfixes YAS existants (ex: 034, 038)
        $prefixesYas = array_column($prefixeModel->findAll(), 'code');

        // 2. Récupérer toutes les opérations qui ont généré des frais
        $operations = $operationModel->select('operation.*, compte_client.nom, compte_client.prenom, type_operation.nom as type_nom')
            ->join('compte_client', 'compte_client.id_client = operation.id_client')
            ->join('type_operation', 'type_operation.id = operation.type_operation_id')
            ->where('operation.frais >', 0)
            ->orderBy('operation.date_operation', 'DESC')
            ->findAll();

        $gainsYas = [];
        $gainsAutres = [];
        $totalYas = 0;
        $totalAutres = 0;

        // 3. Trier les opérations : Interne (YAS) vs Externe (Autres)
        foreach ($operations as $op) {
            $isInterne = true;

            // Si c'est un transfert, on vérifie les 3 premiers chiffres du destinataire
            if ($op['type_operation_id'] == 3 && !empty($op['numero_destinataire'])) {
                $prefixeDest = substr($op['numero_destinataire'], 0, 3);
                if (!in_array($prefixeDest, $prefixesYas)) {
                    $isInterne = false; // C'est un opérateur externe !
                }
            }

            // Répartition dans les bons tableaux
            if ($isInterne) {
                $gainsYas[] = $op;
                $totalYas += $op['frais'];
            } else {
                $gainsAutres[] = $op;
                $totalAutres += $op['frais'];
            }
        }

        $data = [
            'gainsYas' => $gainsYas,
            'gainsAutres' => $gainsAutres,
            'totalYas' => $totalYas,
            'totalAutres' => $totalAutres,
            'totalGlobal' => $totalYas + $totalAutres
        ];

        return view('back-office/gains', $data);
    }
}