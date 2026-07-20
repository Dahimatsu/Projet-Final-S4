<?php
namespace App\Controllers;
use App\Models\ClientModel;
use App\Models\OperationModel;

class ClientDashboardController extends BaseController
{
    public function index()
    {
        $clientModel = new ClientModel();
        $operationModel = new OperationModel();

        $client = $clientModel->where('numero_telephone', session()->get('numero_telephone'))->first();
        if (!$client) {
            return redirect()->to('/client/login');
        }

        $data['client'] = $client;

        // On récupère juste les 5 dernières opérations pour l'accueil
        $data['dernieres_operations'] = $operationModel->select('operation.*, type_operation.nom as type_nom')
            ->join('type_operation', 'type_operation.id = operation.type_operation_id')
            ->where('operation.id_client', $client['id_client'])
            ->orderBy('operation.date_operation', 'DESC')
            ->findAll(5);

        return view('front-office/dashboard', $data);
    }
}