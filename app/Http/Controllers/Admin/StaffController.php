<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Validator;

class StaffController extends Controller
{
    //
    public function index()
    {
        return view('admin.staff.index', ['title' => 'All Staff', 'staffs' => Staff::latest()->paginate(20)]);
    }

    public function profile($id = 0)
    {
        return view('admin.staff.profile', ['title' => 'Staff Profile', 'staff' => Staff::find($id)]);
    }

}