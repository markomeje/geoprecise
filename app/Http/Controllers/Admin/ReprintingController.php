<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Reprinting;
use Carbon\Carbon;
use Validator;

class ReprintingController extends Controller
{
    //
    public function index($limit = 20)
    {
        return view('admin.reprinting.index', ['reprinting' => Reprinting::latest()->paginate($limit)]);
    }

}