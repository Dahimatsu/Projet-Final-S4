<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthClientController extends BaseController
{
    public function index()
    {
        return view('front-office/login');
    }

    public function firstAutenticate() {
        $session = session();
        $model = new ClientModel();

        $numeroTelephone = $session->get('numero_telephone');
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $data = [
            'numero_telephone' => $numeroTelephone,
            'nom'              => $nom,
            'prenom'           => $prenom
        ];
        $model->insert($data);
        $client = $model->where('numero_telephone', $numeroTelephone)->first();

        $session->set([
            'numero_telephone' => $client['numero_telephone'],
            'nom' => $client['nom'],
            'prenom' => $client['prenom']
        ]);

        return redirect()->to('/client/dashboard');
    }

    public function authenticate() {
        $session = session();
        $model = new ClientModel();
        $numeroTelephone = $this->request->getPost('numero_telephone');
        
        if($model->clientExiste('numero_telephone', $numeroTelephone)) {
            $client = $model->where('numero_telephone', $numeroTelephone)->first();
            $session->set([
                'numero_telephone' => $client['numero_telephone'],
                'nom' => $client['nom'],
                'prenom' => $client['prenom']
            ]);
            return redirect()->to('/client/dashboard');
        }else{
            $session->set([
                'numero_telephone' => $numeroTelephone
            ]);
        }
        return redirect()->back()->with('notExist', 'Entrez vos nom et prénom.s');
    }


    public function logout() {
        session()->destroy();
        return redirect()->to('/client/login');
    }
}
