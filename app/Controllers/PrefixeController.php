<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrefixeModel;

class PrefixeController extends BaseController
{
    protected $prefixeModel;

    public function __construct()
    {
        $this->prefixeModel = new PrefixeModel();
    }

    public function index()
    {
        $data['prefixes'] = $this->prefixeModel->findAll();
        return view('back-office/prefixe', $data);
    }

    public function store()
    {
        $rules = ['code' => 'required|min_length[3]|max_length[3]'];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Le code doit avoir 3 caractères.');
        }

        $this->prefixeModel->save(['code' => $this->request->getPost('code')]);
        return redirect()->to('/admin/prefixe')->with('message', 'Préfixe ajouté avec succès.');
    }

    public function delete($id)
    {
        $model = new PrefixeModel();
        $model->delete($id);

        return redirect()->to('/admin/prefixes')->with('message', 'Préfixe supprimé.');
    }
}