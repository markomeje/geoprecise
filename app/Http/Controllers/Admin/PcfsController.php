<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Pcf, Client, Form};
use Validator;

/**
 * Plan Collection Forms Controller
 */
class PcfsController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.pcfs.index', ['title' => 'All Plan Collection Forms', 'pcfs' => Pcf::latest()->paginate($limit)]);
    }

}