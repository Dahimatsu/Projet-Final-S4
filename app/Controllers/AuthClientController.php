<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\PrefixeYasModel; 
use App\Controllers\BaseController;

class AuthClientController extends BaseController
{
    public function index()
    {
        $prefixModel = new PrefixeYasModel();

        $data['prefixes'] = $prefixModel->findAll();

        return view('front-office/login', $data);
    }

    public function firstAuthenticate()
    {
        $session = session();
        $model = new ClientModel();

        $numeroTelephone = $session->get('numero_telephone');
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');

        $model->insert([
            'numero_telephone' => $numeroTelephone,
            'nom' => $nom,
            'prenom' => $prenom,
        ]);

        $client = $model->where('numero_telephone', $numeroTelephone)->first();

        $session->set([
            'id_client' => $client['id_client'],
            'numero_telephone' => $client['numero_telephone'],
            'nom' => $client['nom'],
            'prenom' => $client['prenom'],
            'client_logged_in' => true
        ]);

        return redirect()->to('/client/dashboard');
    }

    public function authenticate()
    {
        $session = session();
        $model = new ClientModel();

        $prefixe = $this->request->getPost('prefixe');
        $suffixe = trim($this->request->getPost('suffixe'));

        if (empty($prefixe) || empty($suffixe) || !is_numeric($suffixe) || strlen($suffixe) !== 7) {
            return redirect()->back()->with('error', 'Le numéro de téléphone est invalide. Veuillez entrer un numéro valide.');
        }

        $numeroTelephone = $prefixe . $suffixe;

        $client = $model->where('numero_telephone', $numeroTelephone)->first();

        if ($client) {
            $session->set([
                'id_client' => $client['id_client'],
                'numero_telephone' => $client['numero_telephone'],
                'nom' => $client['nom'],
                'prenom' => $client['prenom'],
                'solde' => $client['solde'],
                'epargne' => $client['epargne'],
                'client_logged_in' => true
            ]);

            return redirect()->to('/client/dashboard');
        }

        $session->set([
            'numero_telephone' => $numeroTelephone,
        ]);

        return redirect()->back()->with('notExist', 'Veuillez entrer vos nom et prénom.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/client/login');
    }
}