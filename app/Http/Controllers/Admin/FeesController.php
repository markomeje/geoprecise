<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Fee;
use Validator;

class FeesController extends Controller
{
    //
    public function index()
    {
        return view('admin.fees.index', ['title' => 'All Fees', 'fees' => Fee::all()]);
    }
}
