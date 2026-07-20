<?php

namespace App\Controllers;


class LogoutController extends BaseController
{
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}