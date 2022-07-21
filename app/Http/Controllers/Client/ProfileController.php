<?php

namespace App\Http\Controllers\Client;
use App\Models\Client;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function index()
    {
        return view('client.profile.index', ['client' => Client::where(['user_id' => auth()->id()])->first()]);
    }

    //
    public function setup()
    {
        die("Here");
        return view('client.profile.setup', ['title' => 'Setup Profile | Geoprecise Services Limited']);
    }
}
