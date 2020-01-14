<?php

namespace App\Http\Controllers\AuthAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function showLoginForm()

    {

        return view('authadmin.admin_login');
    }


    public function login()
    {
        return true;
    }

}
