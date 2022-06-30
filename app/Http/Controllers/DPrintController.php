<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DPrintController extends Controller
{
    //   
    public function index()
    {
        return view('frontend.3dprintingeffect.3dprint');
    }
}
