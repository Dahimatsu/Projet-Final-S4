<?php

namespace App\Controllers;

class AdminDashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/admin/login');
        }

        return view('back-office/dashboard');
    }
}