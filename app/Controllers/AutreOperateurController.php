<?php

namespace App\Controllers; // Ou App\Controllers\Admin

use App\Controllers\BaseController;
use App\Models\AutreOperateurModel;
use App\Models\OperationModel;
use App\Models\PourcentageCommissionModel;

class AutreOperateurController extends BaseController
{
    public function index()
    {
        $model = new AutreOperateurModel();
        $operationModel = new OperationModel();
        $commissionModel = new PourcentageCommissionModel();

        // 1. Récupération des opérateurs
        $operateurs = $model->orderBy('nom_operateur', 'ASC')
            ->orderBy('prefixe', 'ASC')
            ->findAll();

        // 2. Récupération du taux de commission actuel (ex: 0.10)
        $commissionConfig = $commissionModel->first();
        $tauxCommission = $commissionConfig ? (float) $commissionConfig['pourcentage'] : 0.10;

        // 3. Récupération de tous les transferts (type_operation_id = 3)
        $transferts = $operationModel->where('type_operation_id', 3)
            ->where('numero_destinataire IS NOT NULL')
            ->findAll();

        // 4. Calcul de la situation pour chaque opérateur
        foreach ($operateurs as &$op) {
            $prefixe = $op['prefixe'];
            $totalMontantTransfere = 0;

            // On cherche tous les transferts qui commencent par ce préfixe
            foreach ($transferts as $t) {
                if (strpos($t['numero_destinataire'], $prefixe) === 0) {
                    $totalMontantTransfere += $t['montant'];
                }
            }

            // Calculs
            $commissionDue = $totalMontantTransfere * $tauxCommission;
            $totalAReverser = $totalMontantTransfere + $commissionDue;

            // On ajoute ces calculs au tableau de l'opérateur pour l'envoyer à la vue
            $op['total_transfert'] = $totalMontantTransfere;
            $op['commission_due'] = $commissionDue;
            $op['total_a_reverser'] = $totalAReverser;
        }

        $data = [
            'operateurs' => $operateurs,
            'tauxCommissionAffichage' => $tauxCommission * 100 // Pour afficher "10%" dans l'en-tête du tableau
        ];

        return view('back-office/autre_operateur', $data);
    }

    public function store()
    {
        $rules = [
            'prefixe' => 'required|exact_length[3]|numeric|is_unique[autre_operateur.prefixe]',
            'nom_operateur' => 'required|min_length[2]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Erreur : Le préfixe est invalide ou existe déjà (3 chiffres requis).');
        }

        $model = new AutreOperateurModel();
        $model->insert([
            'prefixe' => $this->request->getPost('prefixe'),
            'nom_operateur' => $this->request->getPost('nom_operateur')
        ]);

        return redirect()->to('/admin/autres-operateurs')->with('success', 'Nouvel opérateur ajouté avec succès.');
    }

    public function delete($id)
    {
        $model = new AutreOperateurModel();
        $model->delete($id);

        return redirect()->to('/admin/autres-operateurs')->with('success', 'Préfixe opérateur supprimé.');
    }
}