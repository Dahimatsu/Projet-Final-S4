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
<<<<<<< HEAD

        return view('front-office/login', ['data' => $data]);
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
            'numero_telephone' => $client['numero_telephone'],
            'nom' => $client['nom'],
            'prenom' => $client['prenom'],
        ]);

        return redirect()->to('/client/dashboard');
    }

    public function authenticate()
    {
        $session = session();
        $model = new ClientModel();

        $prefixe = $this->request->getPost('prefixe');
        $suffixe = $this->request->getPost('suffixe');
        $numeroTelephone = trim($prefixe . $suffixe);
=======
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
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
        
        if ($model->clientExiste('numero_telephone', $numeroTelephone)) {
            $client = $model->where('numero_telephone', $numeroTelephone)->first();
            $session->set([
                'numero_telephone' => $client['numero_telephone'],
                'nom' => $client['nom'],
                'prenom' => $client['prenom']
            ]);
            return redirect()->to('/client/dashboard');
<<<<<<< HEAD
        } else {
            $session->set([
                'numero_telephone' => $numeroTelephone,
=======
        }else{
            $session->set([
                'numero_telephone' => $numeroTelephone
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
            ]);
        }
        return redirect()->back()->with('notExist', 'Entrez vos nom et prénom.s');
    }

<<<<<<< HEAD
    public function logout()
    {
=======

    public function logout() {
>>>>>>> f5b9bc32f762f9cb1569a376fcc23b2f8105261e
        session()->destroy();
        return redirect()->to('/client/login');
    }
}
