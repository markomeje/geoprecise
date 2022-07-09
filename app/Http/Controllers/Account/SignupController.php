<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

class SignupController extends Controller
{
    //
    public function index()
    {
        return view('account.signup.index');
    }
}
