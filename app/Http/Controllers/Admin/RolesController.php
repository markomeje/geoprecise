<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Validator;
use Exception;


class RolesController extends Controller
{
    //
    public function index()
    {
        return view('admin.roles.index', ['title' => 'All Roles', 'roles' => Role::all()]);
    }

    //
    public function role($id = 0)
    {
        return view('admin.roles.role', ['title' => env('APP_NAME'), 'role' => Role::find($id)]);
    }
}