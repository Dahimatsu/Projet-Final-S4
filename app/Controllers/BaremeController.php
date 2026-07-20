<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;

class BaremeController extends BaseController
{
    protected $baremeModel;

    public function __construct()
    {
        $this->baremeModel = new BaremeFraisModel();
    }

    public function index()
    {
        $typeId = $this->request->getGet('type_operation_id');

        // Récupérer tous les types pour le menu de filtrage
        $typeModel = new TypeOperationModel();  
        $data['types'] = $typeModel->findAll();

        // Filtrer si un ID est passé
        if ($typeId) {
            $data['baremes'] = $this->baremeModel->getBaremesWithTypesFiltered($typeId);
        } else {
            $data['baremes'] = $this->baremeModel->getBaremesWithTypes();
        }
        return view('back-office/bareme', $data);
    }

    public function store()
    {
        $rules = [
            'montant_min' => 'required|numeric',
            'montant_max' => 'required|numeric',
            'frais' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Veuillez vérifier les champs numériques.');
        }

        $this->baremeModel->save($this->request->getPost());
        return redirect()->to('/admin/baremes')->with('message', 'Barème ajouté.');
    }

    public function delete($id)
    {
        $this->baremeModel->delete($id);
        return redirect()->to('/admin/baremes')->with('message', 'Barème supprimé.');
    }
}