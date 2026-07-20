<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class ClientController extends BaseController
{
    public function index()
    {
        $model = new ClientModel();
        $data['clients'] = $model->findAll();

        return view('back-office/clients', $data);
    }
}