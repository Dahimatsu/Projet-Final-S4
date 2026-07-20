<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\OperationModel;

class AdminDashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        $clientModel = new ClientModel();
        $operationModel = new OperationModel();

        $totalClients = $clientModel->countAll();

        $today = date('Y-m-d');
        $operationsJour = $operationModel->where('DATE(date_operation)', $today)->countAllResults();

        $data = [
            'totalClients' => $totalClients ?? 0,
            'operationsJour' => $operationsJour ?? 0
        ];

        return view('admin/dashboard', $data);
    }
}