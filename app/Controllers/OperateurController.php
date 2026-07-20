<?php

namespace App\Controllers;

use App\Models\PrefixeModel;
use App\Models\BaremeFraisModel;

class OperateurController extends BaseController
{
    public function index()
    {
        $prefixeModel = new PrefixeModel();
        $baremeModel = new BaremeFraisModel();

        $data = [
            'prefixes' => $prefixeModel->findAll(),
            'baremes' => $baremeModel->findAll()
        ];

        return view('operateur/dashboard', $data);
    }
}