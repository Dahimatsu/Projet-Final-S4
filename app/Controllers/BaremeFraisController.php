<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BaremeFraisModel;
use CodeIgniter\HTTP\ResponseInterface;

class BaremeFraisController extends BaseController
{
    public function index()
    {
        //
    }

    public function calculFrais($typeOperationId, $montant) 
    {
        $baremeModel = new BaremeFraisModel();
        $bareme = $baremeModel->calculFrais($typeOperationId, $montant);

        if ($bareme) {
            return $bareme['frais'];
        }
        return 0.00; 
    }
}
