<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BenefitController extends Controller
{
    //   
    public function index()
    {
        return view('frontend.benefitsofcertification.benefit');
    }
}
