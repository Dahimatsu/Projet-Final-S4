<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Controllers\SoldeCompteController;
use App\Models\SoldeCompteModel;
use App\Models\BaremeFraisModel;
use CodeIgniter\HTTP\ResponseInterface;


class OperationController extends BaseController
{
    public function index()
    {
        //
    }

    public function vueDepot() {
        return view('client/depot');
    }
    public function depot() {
        $session = session();
        $montant = $this->request->getPost('montant');
        
        $clientModel = new ClientModel();
        $client = $clientModel->where('numero_telephone', $session->get('numero_telephone'))->first();
        if (!$client) {
            return redirect()->to('/client/login');
        }
        $id_client = $client['id'];
        
        $data = [
            'id_client'           => $id_client,
            'type_operation_id'   => 1,
            'montant'             => $montant,
            'numero_destinataire' => null,
            'frais'               => 0.00
        ];

        $operationModel = new \App\Models\OperationModel();
        $operationModel->insert($data);

        return redirect()->to('/client/dashboard')->with('success', 'Dépôt effectué avec succès !');
    }


    public function vueRetrait() {
        return view('client/retrait');
    }
    public function retrait() {
        $session = session();
        $montant = (float) $this->request->getPost('montant');
        
        $clientModel = new ClientModel();
        $client = $clientModel->where('numero_telephone', $session->get('numero_telephone'))->first();
        if (!$client) {
            return redirect()->to('/client/login');
        }
        $id_client = $client['id'];
        
        $soldeModel = new SoldeCompteModel();
        $soldeRecord = $soldeModel->where('id_client', $id_client)->first();
        $solde = $soldeRecord ? (float) $soldeRecord['solde'] : 0.00;

        $baremeModel = new BaremeFraisModel();
        $frais = (float) $baremeModel->calculFrais(2, $montant);

        $totalAPayer = $montant + $frais;

        if ($solde < $totalAPayer) {
            return redirect()->back()->with('error', 'Solde insuffisant ! (Montant: ' . $montant . ' + Frais: ' . $frais . ')');
        }

        $data = [
            'id_client'           => $id_client,
            'type_operation_id'   => 2,
            'montant'             => $montant,
            'numero_destinataire' => null,
            'frais'               => $frais
        ];

        $operationModel = new \App\Models\OperationModel();
        $operationModel->insert($data);

        return redirect()->to('/client/dashboard')->with('success', 'Retrait effectué avec succès !');
    }

    public function vueTransfert() {
        return view('client/transfert');
    }
    public function transfert() {
        $session = session();
        $montant = (float) $this->request->getPost('montant');

        $clientModel = new ClientModel();

        // 1. Récupérer et reconstituer le numéro du destinataire
        $prefixe = $this->request->getPost('prefixe');
        $suffixe = $this->request->getPost('suffixe');
        $numeroDestinataire = trim($prefixe . $suffixe);

        // 2. Vérifier si le client destinataire existe
        $destinataire = $clientModel->where('numero_telephone', $numeroDestinataire)->first();
        if (!$destinataire) {
            return redirect()->back()->with('error', 'Le numéro du destinataire n\'existe pas.');
        }

        // 3. Récupérer l'expéditeur connecté
        $client = $clientModel->where('numero_telephone', $session->get('numero_telephone'))->first();
        if (!$client) {
            return redirect()->to('/client/login');
        }
        $id_client = $client['id'];

        // Empêcher de s'envoyer de l'argent à soi-même (optionnel mais recommandé)
        if ($client['numero_telephone'] === $numeroDestinataire) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas effectuer un transfert vers votre propre compte.');
        }

        // 4. Vérifier le solde de l'expéditeur
        $soldeModel = new SoldeCompteModel();
        $soldeRecord = $soldeModel->where('id_client', $id_client)->first();
        $solde = $soldeRecord ? (float) $soldeRecord['solde'] : 0.00;

        // 5. Calculer les frais pour le transfert (type_operation_id = 3)
        $baremeModel = new BaremeFraisModel();
        $frais = (float) $baremeModel->calculFrais(3, $montant);

        $totalAPayer = $montant + $frais;

        if ($solde < $totalAPayer) {
            return redirect()->back()->with('error', 'Solde insuffisant ! (Montant: ' . $montant . ' + Frais: ' . $frais . ')');
        }

        // 6. Enregistrer l'opération de transfert
        $data = [
            'id_client'           => $id_client,
            'type_operation_id'   => 3,
            'montant'             => $montant,
            'numero_destinataire' => $numeroDestinataire,
            'frais'               => $frais
        ];

        $operationModel = new \App\Models\OperationModel();
        $operationModel->insert($data);

        return redirect()->to('/client/dashboard')->with('success', 'Transfert de ' . $montant . ' Ar vers ' . $numeroDestinataire . ' effectué avec succès !');
    }



    public function historique() {

    }
}
