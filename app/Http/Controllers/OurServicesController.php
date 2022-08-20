<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OurServicesController extends Controller
{
    //
        public function index()
    {
        return view('frontend.ourservices.services');
    }
}
