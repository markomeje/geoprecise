<?php

namespace App\Http\Controllers\Admin;
use App\Models\Form;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard.index', ['forms' => Form::all()]);
    }
}
