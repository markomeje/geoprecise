<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationFormsController extends Controller
{
    //
        public function index()
    {
        return view('forms.applicationform');
    }
}
