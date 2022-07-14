<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientsController extends Controller
{
    //
    public function index()
    {
        return view('admin.clients.index', ['title' => 'All Clients', 'clients' => Client::latest('created_at')->paginate(20)]);
    }

    //
    public function profile($id = 0)
    {
        $client = Client::find($id);
        if (empty($client)) {
            return view('admin.clients.profile', ['title' => 'No client details found', 'client' => '', 'clients' => Client::latest('created_at')->paginate(20)]);
            exit();
        }

        return view('admin.clients.profile', ['title' => 'All Clients', 'client' => $client]);
    }
}
