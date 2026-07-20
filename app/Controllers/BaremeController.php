<?php

namespace App\Controllers; // Ou App\Controllers\Admin

use App\Controllers\BaseController;
use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;

class BaremeController extends BaseController
{
    public function index()
    {
        $baremeModel = new BaremeFraisModel();
        $typeModel = new TypeOperationModel();

        // Récupérer le filtre s'il y en a un
        $typeId = $this->request->getGet('type_operation_id');

        // Construire la requête avec jointure pour avoir le nom du type d'opération
        $query = $baremeModel->select('bareme_frais.*, type_operation.nom as type_nom')
            ->join('type_operation', 'type_operation.id = bareme_frais.type_operation_id');

        if (!empty($typeId)) {
            $query->where('type_operation_id', $typeId);
        }

        // Trier par type puis par montant min
        $data['baremes'] = $query->orderBy('type_operation_id', 'ASC')
            ->orderBy('montant_min', 'ASC')
            ->findAll();

        $data['types'] = $typeModel->findAll();

        return view('back-office/bareme', $data);
    }

    public function store()
    {
        $rules = [
            'type_operation_id' => 'required|numeric',
            'montant_min' => 'required|numeric',
            'montant_max' => 'required|numeric|greater_than_equal_to[' . $this->request->getPost('montant_min') . ']',
            'frais' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Erreur : Veuillez vérifier vos montants (le Max doit être supérieur au Min).');
        }

        $model = new BaremeFraisModel();
        $model->insert([
            'type_operation_id' => $this->request->getPost('type_operation_id'),
            'montant_min' => $this->request->getPost('montant_min'),
            'montant_max' => $this->request->getPost('montant_max'),
            'frais' => $this->request->getPost('frais')
        ]);

        return redirect()->to('/admin/baremes')->with('success', 'Barème ajouté avec succès.');
    }

    public function delete($id)
    {
        $model = new BaremeFraisModel();
        $model->delete($id);

        return redirect()->back()->with('success', 'Tranche de frais supprimée.');
    }
}