<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('account.auth.login');
    }
}
