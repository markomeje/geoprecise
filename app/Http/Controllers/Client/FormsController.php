<?php

namespace App\Http\Controllers\Client;
use App\Models\Form;
use App\Http\Controllers\Controller;

class FormsController extends Controller
{
    //
    public function index()
    {
        return view('client.forms.index', ['forms' => Form::all()]);
    }

    //
    public function form($id = 0)
    {
        return view('client.forms.form', ['form' => Form::find($id)]);
    }
}
