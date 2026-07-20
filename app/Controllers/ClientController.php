<?php

namespace App\Controllers; // Ou App\Controllers\Admin

use App\Controllers\BaseController;
use App\Models\ClientModel;

class ClientController extends BaseController
{
    public function index()
    {
        $clientModel = new ClientModel();

        // On récupère les clients par ordre de création (les plus récents d'abord)
        // paginate(10) va automatiquement créer des pages de 10 éléments
        $data = [
            'clients' => $clientModel->orderBy('id_client', 'DESC')->paginate(10),
            'pager' => $clientModel->pager // On passe l'objet pager à la vue pour afficher les numéros de page
        ];

        return view('back-office/clients', $data);
    }
}