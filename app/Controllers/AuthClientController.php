<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\PrefixeModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthClientController extends BaseController
{
    public function index()
    {
        $prefixModel = new PrefixeModel();
        $data = $prefixModel->findAll();
        return view('front-office/login', ['data' => $data]);
    }

    public function firstAuthenticate() {
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
        $prefixe = $this->request->getPost('prefixe');
        $suffixe = $this->request->getPost('suffixe');
        $numeroTelephone = trim($prefixe + $suffixe);
        
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
