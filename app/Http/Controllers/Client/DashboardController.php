<?php

namespace App\Http\Controllers\Client;
use App\Models\Form;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('client.dashboard.index', ['forms' => Form::all()]);
    }
}
