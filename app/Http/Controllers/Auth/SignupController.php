<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
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
            'firstname' => ['required', 'string'], 
            'surname' => ['required', 'string'], 
            'email' => ['required', (new EmailRule), 'unique:users'], 
            'phone' => ['required', 'unique:users'], 
            'password' => ['required', 'string'],
            'retype' => ['required', 'same:password'],
            'agree' => ['required', 'string'],
        ], ['retype.required' => 'Please enter a password', 'agree.required' => 'You have to agree to our terms and conditions', 'phone.required' => 'Please enter your phone number.', 'retype.same:password' => 'Retype thesame password', 'phone.unique:users' => 'The phone number is already in use.']);

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

            $id = $user->id ?? null;
            Client::create([
                'name' => $data['firstname'].' '.$data['surname'],
                'title' => $data['title'] ?? null,
                'user_id' => $id,
            ]);

            $token = Str::random(64);
            Verification::create([
                'token' => $token,
                'type' => 'email',
                'expiry' => Carbon::now()->addMinutes(60),
                'user_id' => $id,
                'verified' => false,
            ]);

            // $mailable = (new TemplatedMailable())->identifier(8675309)->include([
            //     'name' => $email,
            //     'action_url' => 'https://example.com/login',
            // ]);

            // Mail::to('contact@geoprecisegroup.com')->send($mailable);

            Mail::to('contact@geoprecisegroup.com')->send(new EmailVerification([
                'email' => $email, 
                'token' => $token
            ]));

            DB::commit();
            return response()->json([
                'status' => 1,
                'info' => 'Signup successful. Please wait . . .',
                'redirect' => route('signup', ['success' => $token]),
            ]);

        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }
}
