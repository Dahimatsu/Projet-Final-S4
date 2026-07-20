<?php

namespace App\Controllers; // Ou App\Controllers\Admin

use App\Controllers\BaseController;
use App\Models\AutreOperateurModel;

class AutreOperateurController extends BaseController
{
    public function index()
    {
        $model = new AutreOperateurModel();

        // On récupère tous les autres opérateurs triés par nom puis par préfixe
        $data['operateurs'] = $model->orderBy('nom_operateur', 'ASC')
            ->orderBy('prefixe', 'ASC')
            ->findAll();

        return view('back-office/autre_operateur', $data);
    }

    public function store()
    {
        // Validation stricte : 3 chiffres exacts et unique dans cette table
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