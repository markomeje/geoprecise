<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class LayoutsController extends Controller
{
    //
    public function index()
    {
        return view('admin.layouts.index', ['title' => 'All Layouts']);
    }
}
