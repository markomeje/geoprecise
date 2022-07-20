<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Client;

class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('admin.clients.index', ['title' => 'All Clients', 'clients' => Client::latest('created_at')->paginate(20)]);
    }

}
