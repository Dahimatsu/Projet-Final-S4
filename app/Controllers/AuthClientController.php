<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthClientController extends BaseController
{
    public function index()
    {
        return view('client/login');
    }

    public function authenticate() {
        $model = new ClientModel();
        $numeroTelephone = $this->request->getPost('numero_telephone');
        
        if($model->clientExiste('numero_telephone', $numeroTelephone)) {
            $client = $model->where('numero_telephone', $numeroTelephone)->first();
            $session = session();
            $session->set([
                'numero_telephone' => $client['numero_telephone'],
                'nom' => $client['nom'],
                'prenom' => $client['prenom']
            ]);
            return redirect()->to('/client/dashboard');
        }
        return redirect()->back()->with('notExist', 'Entrez vos nom et prénom.s');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/client/login');
    }
}
