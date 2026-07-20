<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\OperationModel;
use App\Models\HistoriqueGainModel;

class AdminDashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        $clientModel = new ClientModel();
        $operationModel = new OperationModel();
        $gainModel = new HistoriqueGainModel();

        $today = date('Y-m-d');

        // 1. Clients
        $totalClients = $clientModel->countAll();

        // 2. Opérations du jour
        $operationsJour = $operationModel->where('DATE(date_operation)', $today)->countAllResults();

        // 3. Solde total de l'opérateur YAS (Somme totale des gains)
        $totalGainsRecord = $gainModel->selectSum('montant_gain')->first();
        $totalGains = $totalGainsRecord['montant_gain'] ?? 0;

        // 4. Gains générés aujourd'hui
        $gainsJourRecord = $gainModel->selectSum('montant_gain')->where('DATE(date_gain)', $today)->first();
        $gainsJour = $gainsJourRecord['montant_gain'] ?? 0;

        // 5. Argent total en circulation (Somme des soldes de tous les clients)
        $argentCirculationRecord = $clientModel->selectSum('solde')->first();
        $argentCirculation = $argentCirculationRecord['solde'] ?? 0;

        // 6. Les 5 dernières opérations sur la plateforme
        $dernieresOperations = $operationModel->select('operation.*, compte_client.numero_telephone, type_operation.nom as type_nom')
            ->join('compte_client', 'compte_client.id_client = operation.id_client')
            ->join('type_operation', 'type_operation.id = operation.type_operation_id')
            ->orderBy('operation.date_operation', 'DESC')
            ->findAll(5);

        $data = [
            'totalClients' => $totalClients,
            'operationsJour' => $operationsJour,
            'totalGains' => (float) $totalGains,
            'gainsJour' => (float) $gainsJour,
            'argentCirculation' => (float) $argentCirculation,
            'dernieresOperations' => $dernieresOperations
        ];

        return view('back-office/dashboard', $data);
    }
}