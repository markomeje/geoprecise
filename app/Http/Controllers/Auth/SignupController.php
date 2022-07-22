<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{User, Verification, Client};
use CraigPaul\Mail\TemplatedMailable;
use App\Rules\EmailRule;
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;

class SignupController extends Controller
{
    //
    public function index()
    {
        return view('auth.signup.index', ['title' => "Signup | Geoprecise Services Limited"]);
    }

    //
    public function signup()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'fullname' => ['required', 'string'], 
            'email' => ['required', (new EmailRule), 'unique:users'], 
            'phone' => ['required', 'unique:users'], 
            'password' => ['required', 'string'],
            'retype' => ['required', 'same:password'],
            'agree' => ['required', 'string'],
            'dob' => ['required', 'string'],
            'occupation' => ['required', 'string'],
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'address' => ['required', 'string'],
        ], ['retype.required' => 'Please enter a password', 'agree.required' => 'You have to agree to our terms and conditions', 'phone.required' => 'Please enter your phone number.', 'retype.same:password' => 'Retype thesame password', 'phone.unique:users' => 'The phone number is already in use.', 'dob.required' => 'Date of birth is required', 'dob.string' => 'Date of birth is invalid']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            DB::beginTransaction();
            $email = $data['email'] ?? '';
            $user = User::create([
                'email' => $email,
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'role' => 'client',
                'status' => 'inactive',
            ]);

            if (empty($user)) {
                throw new Exception('Error Processing Request');
            }

            $fullname = $data['fullname'] ?? '';
            Client::create([
                'fullname' => $fullname,
                'title' => $data['title'] ?? null,
                'user_id' => $user->id,
                'status' => 'complete',
                'occupation' => $data['occupation'],
                'state' => $data['state'] ?? null,
                'dob' => $data['dob'],
                'city' => $data['city'] ?? null,
                'address' => $data['address'],
            ]);

            $token = Str::random(64);
            Verification::create([
                'token' => $token,
                'type' => 'email',
                'expiry' => Carbon::now()->addMinutes(60),
                'user_id' => $user->id,
                'verified' => false,
            ]);

            // $company = config('app.name');
            // Mail::to($email)->send((new TemplatedMailable())->identifier(28625150)->include([
            //     'product_name' => $company,
            //     'name' => $fullname,
            //     'action_url' => route('signup.verify', ['token' => $token]),
            //     'company_name' => $company,
            //     'company_address' => config('app.address')
            // ]));

            DB::commit();
            return response()->json([
                'status' => 1,
                'info' => 'Signup successful. Please wait . . .',
                'redirect' => route('signup.ui', ['success' => 'true']),
            ]);

        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }

    //
    public function verify()
    {
        return view('auth.signup.verify', ['title' => "Signup Verification | Geoprecise Services Limited"]);
    }
}
