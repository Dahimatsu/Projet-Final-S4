<?php

namespace App\Controllers;

use App\Models\CompteAdminModel;

class AuthAdminController extends BaseController
{
    public function index()
    {
        return view('back-office/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new CompteAdminModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $model->where('email', $email)->first();

        if ($admin && $password === $admin['mot_de_passe']) {
            $session->set([
                'id_admin' => $admin['id_admin'],
                'nom' => $admin['nom'],
                'logged_in' => true
            ]);
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Email ou mot de passe invalide.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}