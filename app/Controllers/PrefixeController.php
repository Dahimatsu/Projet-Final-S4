<?php

namespace App\Controllers; // Ou App\Controllers\Admin si tu l'as mis dans un sous-dossier

use App\Controllers\BaseController;
use App\Models\PrefixeYasModel;

class PrefixeController extends BaseController
{
    public function index()
    {
        $model = new PrefixeYasModel();

        $data['prefixes'] = $model->findAll();

        return view('back-office/prefixe', $data);
    }

    public function store()
    {
        $rules = [
            'code' => 'required|min_length[3]|max_length[3]|is_unique[prefixe_yas.code]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Erreur : Code invalide ou déjà existant (3 chiffres requis).');
        }

        $model = new PrefixeYasModel();
        $model->insert([
            'code' => $this->request->getPost('code')
        ]);

        return redirect()->to('/admin/prefixes')->with('success', 'Préfixe YAS ajouté avec succès.');
    }

    public function delete($id)
    {
        $model = new PrefixeYasModel();
        $model->delete($id);

        return redirect()->to('/admin/prefixes')->with('success', 'Préfixe supprimé.');
    }
}