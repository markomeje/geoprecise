<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\{StaffVerificationMail};
use Illuminate\Support\Str;
use App\Rules\EmailRule;
use App\Models\{Staff, User, Verification};
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;

class StaffController extends Controller
{
    //
    public function index()
    {
        return view('admin.staff.index', ['title' => 'All Staff', 'staffs' => Staff::latest()->paginate(20)]);
    }

    //
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'fullname' => ['required', 'string'], 
            'role' => ['required'],
            'email' => ['required', (new EmailRule), 'unique:users'],
            'phone' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make(rand(1000, 999999)),
                'role' => 'admin',
                'phone' => $data['phone'],
                'status' => 'inactive',
            ]);

            if (empty($user)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown Error. Try again.'
                ]);
            }

            $user_id = $user->id;
            $staff = Staff::create([
                'fullname' => $data['fullname'],
                'address' => $data['address'] ?? null,
                'title' => $data['title'] ?? null,
                'user_id' => $user_id,
                'role_id' => $data['role'],
            ]);

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful. Please wait . . .',
                'redirect' => route('admin.staff.profile', ['id' => $staff->id ?? 0]),
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.',
            ]);
        }
            
    }

    public function profile($id = 0)
    {
        return view('admin.staff.profile', ['title' => 'Staff Profile', 'staff' => Staff::find($id)]);
    }

    //
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'fullname' => ['required', 'string'], 
            'role' => ['nullable', 'string'],
            'title' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            $staff = Staff::find($id);
            if (empty($staff)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Staff not found.'
                ]);
            }

            $staff->fullname = $data['fullname'];
            $staff->address = $data['address'] ?? null;
            $staff->title = $data['title'] ?? null;

            if ($staff->update()) {
                return response()->json([
                    'status' => 1,
                    'info' => 'Operation successful. Please wait . . .',
                    'redirect' => '',
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.',
            ]);
                
        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.',
            ]);
        }
            
    }

}