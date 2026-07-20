<?php

namespace App\Controllers; // Ou App\Controllers\Admin

use App\Controllers\BaseController;
use App\Models\PourcentageCommissionModel;

class CommissionController extends BaseController
{
    public function index()
    {
        $model = new PourcentageCommissionModel();

        // On récupère la première ligne (car il n'y a qu'une seule configuration globale)
        $commission = $model->first();

        // Sécurité : si la table est vide, on insère la valeur par défaut (10%)
        if (!$commission) {
            $model->insert(['pourcentage' => 0.10]);
            $commission = $model->first();
        }

        $data['commission'] = $commission;

        return view('back-office/commissions', $data);
    }

    public function update()
    {
        $rules = [
            'pourcentage' => 'required|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Erreur : Veuillez entrer un nombre valide.');
        }

        $model = new PourcentageCommissionModel();

        $id = $this->request->getPost('id_pourcentage_commission');

        $valeurSaisie = (float) $this->request->getPost('pourcentage');
        $valeurDecimale = $valeurSaisie / 100;

        $model->update($id, [
            'pourcentage' => $valeurDecimale
        ]);

        return redirect()->to('/admin/commissions')->with('success', 'Le pourcentage de commission a été mis à jour avec succès.');
    }
}