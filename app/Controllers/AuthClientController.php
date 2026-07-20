<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\PrefixeYasModel; // On utilise le nouveau modèle
use App\Controllers\BaseController;

class AuthClientController extends BaseController
{
    public function index()
    {
        $prefixModel = new PrefixeYasModel();

        // On récupère uniquement les préfixes YAS (034, 038)
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

        // L'insertion va créer le client (le solde se mettra à 0 par défaut grâce à ta BDD)
        $model->insert([
            'numero_telephone' => $numeroTelephone,
            'nom' => $nom,
            'prenom' => $prenom,
        ]);

        // On récupère le client fraîchement créé
        $client = $model->where('numero_telephone', $numeroTelephone)->first();

        $session->set([
            'id_client' => $client['id_client'], // Toujours utile de stocker l'ID
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
        $suffixe = $this->request->getPost('suffixe');
        $numeroTelephone = $prefixe . trim($suffixe);

        // On cherche si le client existe dans la base
        $client = $model->where('numero_telephone', $numeroTelephone)->first();

        if ($client) {
            // Le client existe, on le connecte
            $session->set([
                'id_client' => $client['id_client'],
                'numero_telephone' => $client['numero_telephone'],
                'nom' => $client['nom'],
                'prenom' => $client['prenom'],
                'client_logged_in' => true
            ]);

            return redirect()->to('/client/dashboard');
        }

        // Le client n'existe pas, on sauvegarde juste son numéro temporairement
        $session->set([
            'numero_telephone' => $numeroTelephone,
        ]);

        return redirect()->back()->with('notExist', 'Numéro introuvable. Veuillez créer votre compte en entrant vos nom et prénom.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/client/login');
    }
}