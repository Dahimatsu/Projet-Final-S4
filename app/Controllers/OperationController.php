<?php
namespace App\Controllers;
use App\Models\ClientModel;
use App\Models\BaremeFraisModel;
use App\Models\HistoriqueGainModel;
use App\Models\OperationModel;
use App\Models\PourcentageCommissionModel;

class OperationController extends BaseController
{
    public function vueDepot()
    {
        return view('front-office/depot');
    }

    public function depot()
    {
        $montant = (float) $this->request->getPost('montant');
        $clientModel = new ClientModel();

        $client = $clientModel->where('numero_telephone', session()->get('numero_telephone'))->first();
        if (!$client)
            return redirect()->to('/client/login');

        $clientModel->set('solde', 'solde + ' . $montant, false)
            ->where('id_client', $client['id_client'])
            ->update();

        $operationModel = new OperationModel();
        $operationModel->insert([
            'id_client' => $client['id_client'],
            'type_operation_id' => 1,
            'montant' => $montant,
            'frais' => 0
        ]);

        return redirect()->to('/client/dashboard')->with('success', 'Dépôt de ' . $montant . ' Ar effectué.');
    }

    public function vueRetrait()
    {
        return view('front-office/retrait');
    }

    public function retrait()
    {
        $montant = (float) $this->request->getPost('montant');
        $clientModel = new ClientModel();

        $client = $clientModel->where('numero_telephone', session()->get('numero_telephone'))->first();
        if (!$client)
            return redirect()->to('/client/login');

        $baremeModel = new BaremeFraisModel();
        $frais = (float) $baremeModel->calculFrais(2, $montant);
        $totalAPayer = $montant + $frais;

        if ($client['solde'] < $totalAPayer) {
            return redirect()->back()->with('error', 'Solde insuffisant.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $clientModel->set('solde', 'solde - ' . $totalAPayer, false)
            ->where('id_client', $client['id_client'])
            ->update();

        $operationModel = new OperationModel();
        $operationModel->insert([
            'id_client' => $client['id_client'],
            'type_operation_id' => 2,
            'montant' => $montant,
            'frais' => $frais
        ]);

        $gainModel = new HistoriqueGainModel();
        $gainModel->insert(['montant_gain' => $frais]);

        $db->transComplete();

        return redirect()->to('/client/dashboard')->with('success', 'Retrait effectué.');
    }

    public function vueTransfert()
    {
        return view('front-office/transfert');
    }

    public function transfert()
    {
        $commissionModel = new PourcentageCommissionModel();
        $commissionConfig = $commissionModel->first();
        $tauxCommission = $commissionConfig ? (float) $commissionConfig['pourcentage'] : 0.10;

        $montantTotal = (float) $this->request->getPost('montant');
        $prefixes = $this->request->getPost('prefixe');
        $suffixes = $this->request->getPost('suffixe');
        $inclureFraisRetrait = $this->request->getPost('inclure_frais_retrait') ? true : false;

        $clientModel = new ClientModel();
        $clientExpediteur = $clientModel->where('numero_telephone', session()->get('numero_telephone'))->first();
        if (!$clientExpediteur)
            return redirect()->to('/client/login');

        $nbDestinataires = count($prefixes);
        $montantDivise = $montantTotal / $nbDestinataires;
        $isMultiple = $nbDestinataires > 1;

        $destinatairesData = [];
        $totalAPrelever = 0;
        $baremeModel = new BaremeFraisModel();

        for ($i = 0; $i < $nbDestinataires; $i++) {
            $numero = $prefixes[$i] . trim($suffixes[$i]);
            $isYas = in_array($prefixes[$i], ['034', '038']);

            if ($isMultiple && !$isYas) {
                return redirect()->back()->with('error', 'Envoi multiple autorisé uniquement vers YAS.');
            }
            if ($numero === $clientExpediteur['numero_telephone']) {
                return redirect()->back()->with('error', 'Impossible d\'envoyer à vous-même.');
            }

            $fraisTransfert = (float) $baremeModel->calculFrais(3, $montantDivise);
            if (!$isYas) {
                $fraisTransfert += ($fraisTransfert * $tauxCommission);
            }

            $fraisRetrait = 0;
            if ($inclureFraisRetrait && $isYas) {
                $fraisRetrait = (float) $baremeModel->calculFrais(2, $montantDivise);
            }

            $montantFinalRecu = $montantDivise + $fraisRetrait;
            $coutTotalPourExpediteur = $montantFinalRecu + $fraisTransfert;

            $totalAPrelever += $coutTotalPourExpediteur;

            $destinatairesData[] = [
                'numero' => $numero,
                'isYas' => $isYas,
                'montantRecu' => $montantFinalRecu,
                'fraisTransfert' => $fraisTransfert
            ];
        }

        if ($clientExpediteur['solde'] < $totalAPrelever) {
            return redirect()->back()->with('error', 'Solde insuffisant.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $clientModel->set('solde', 'solde - ' . $totalAPrelever, false)->where('id_client', $clientExpediteur['id_client'])->update();

        $operationModel = new OperationModel();
        $gainModel = new HistoriqueGainModel();

        foreach ($destinatairesData as $dest) {
            if ($dest['isYas']) {
                $destClient = $clientModel->where('numero_telephone', $dest['numero'])->first();
                if (!$destClient) {
                    $db->transRollback();
                    return redirect()->back()->with('error', 'Le numéro ' . $dest['numero'] . ' est introuvable.');
                }
                $clientModel->set('solde', 'solde + ' . $dest['montantRecu'], false)->where('id_client', $destClient['id_client'])->update();
            }

            $operationModel->insert([
                'id_client' => $clientExpediteur['id_client'],
                'type_operation_id' => 3,
                'montant' => $montantDivise,
                'numero_destinataire' => $dest['numero'],
                'frais' => $dest['fraisTransfert']
            ]);

            $gainModel->insert(['montant_gain' => $dest['fraisTransfert']]);
        }

        $db->transComplete();

        return redirect()->to('/client/dashboard')->with('success', 'Transfert effectué.');
    }

    public function historique()
    {
        $clientModel = new ClientModel();
        $client = $clientModel->where('numero_telephone', session()->get('numero_telephone'))->first();
        if (!$client)
            return redirect()->to('/client/login');

        $operationModel = new OperationModel();
        $data['operations'] = $operationModel->getHistoriqueClient($client['id_client']);

        return view('front-office/historique', $data);
    }
}