<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Mail\{StaffVerificationMail};
use App\Rules\EmailRule;
use Illuminate\Support\DB;
use App\Models\Staff;
use Validator;
use Hash;

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
            'role' => ['required', 'string'],
            'email' => ['required', (new EmailRule), 'unique:users'],
            'phone' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $client = auth()->user()->client;
        if (empty($client)) {
            return response()->json([
                'status' => 0,
                'info' => 'An error occured. Try again later.',
            ]);
        }

        try {
            DB::beginTransaction();
            $password = Str::random(9);
            $email = $data['email'] ?? '';

            $user = User::create([
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin',
                'phone' => $data['phone'],
                'status' => 'inactive',
            ]);

            $user_id = $user->id ?? 0;
            $staff = Staff::create([
                'fullname' => $data['fullname'],
                'address' => $data['address'] ?? null,
                'title' => $data['title'] ?? null,
                'user_id' => $user_id,
                'role' => $data['role'],
            ]);

            $token = Str::random(64);
            Verification::create([
                'token' => $token,
                'type' => 'email',
                'expiry' => Carbon::now()->addMinutes(60),
                'user_id' => $user_id,
                'verified' => false,
            ]);

            $mail = new StaffVerificationMail([
                'email' => $email, 
                'password' => $password,
                'token' => $token,
            ]);
            Mail::to($email)->send($mail);

            DB::commit();
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful. Please wait . . .',
                'redirect' => route('admin.staff.profile', ['id' => $staff->id]),
            ]);
        } catch (Exception $error) {
            DB::rollback();
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

}