<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{User, Verification, Client};
use App\Mail\VerificationMail;
use App\Rules\EmailRule;
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;
use App\Sms;

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
            $user = User::create([
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'role' => 'client',
                'status' => 'inactive',
            ]);

            if (empty($user)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Operation failed. Try again later',
                ]);
            }

            Client::create([
                'fullname' => $data['fullname'],
                'title' => $data['title'] ?? null,
                'user_id' => $user->id,
                'status' => 'complete',
                'occupation' => $data['occupation'],
                'state' => $data['state'] ?? null,
                'dob' => $data['dob'],
                'city' => $data['city'] ?? null,
                'address' => $data['address'],
            ]);
            
            return response()->json([
                'status' => 1,
                'info' => 'Signup successful. Please wait . . .',
                'redirect' => route('signup.ui', ['success' => 'true']),
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }

    public static function sendVerificationEmail($user_id = 0, $email = '', $token = '')
    {
        Verification::create([
            'token' => $token,
            'type' => 'email',
            'expiry' => Carbon::now()->addMinutes(60),
            'user_id' => $user_id,
            'verified' => false
        ]);

        $mail = new VerificationMail([
            'token' => $token, 
            'email' => $email, 
        ]);

        Mail::to($email)->send($mail);
    }

    //
    public function verify()
    {
        $verify = function($token) {
            if (empty($token)) {
                return [
                    'status' => 0,
                    'info' => 'Invalid verification link'
                ];
            }

            $verification = Verification::where([
                'token' => $token, 
                'type' => 'email'
            ])->latest()->get()->first();
            if (empty($verification)) {
                return [
                    'status' => 0,
                    'info' => 'Invalid verification link'
                ];
            }

            if (Carbon::parse($verification->expiry)->diffInMinutes(Carbon::now()) > 60) {
                return [
                    'status' => 0,
                    'info' => 'Expired verification link'
                ];
            }

            if(true === (boolean)$verification->verified) {
                return [
                    'status' => 1,
                    'info' => 'Already verified'
                ];
            }

            $verification->verified = true;
            $verification->token = '';
            if($verification->update()) {
                return [
                    'status' => 1,
                    'info' => 'Verification successfull'
                ];
            }

            return [
                'status' => 0,
                'info' => 'Verification failed'
            ];
        };

        $token = request()->get('token');
        return view('auth.signup.verify', ['title' => 'Signup Verification | Geoprecise Services Limited', 'verification' => $verify($token)]);
    }

    public function resend()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'email' => ['required', (new EmailRule)], 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $email = $data['email'] ?? '';
        $user = User::where(['email' => $email])->first();
        if (empty($user)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid account email.'
            ]);
        }

        $user_id = $user->id ?? 0;
        $verification = Verification::where([
            'user_id' => $user_id
        ])->latest()->first();
        
        $token = Str::random(64);
        if (empty($verification)) {
            Verification::create([ 
                'token' => $token,
                'user_id' => $user_id,
                'verified' => false,
            ]);

            self::sendVerificationEmail($user_id, $email, $token);
            return response()->json([
                'status' => 1,
                'info' => 'Email sent successfully',
                'redirect' => route('signup.verify', ['resend' => 'true'])
            ]);
        }

        $verification->token = $token;
        $verification->user_id = $user_id;
        $verification->verified = false;
        if ($verification->update()) {
            self::sendVerificationEmail($user_id, $email, $token);
            return response()->json([
                'status' => 1,
                'info' => 'Email sent successfully',
                'redirect' => route('signup.verify', ['resend' => 'true'])
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Invalid Operation'
        ]);
    }

    public function resendPhoneVerificationCode()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'phone_number' => ['required'], 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $phone = $data['phone_number'] ?? '';
        $user = User::where(['phone' => $phone])->first();
        if (empty($user)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid account phone number.'
            ]);
        }

        $user_id = $user->id ?? 0;
        $verification = Verification::where([
            'user_id' => $user_id,
            'type' => 'phone'
        ])->latest()->first();
        
        $token = random_int(100000, 999999);
        $expiry = Carbon::now()->addMinutes(60);
        if (empty($verification)) {
            Verification::create([ 
                'token' => $token,
                'user_id' => $user_id,
                'verified' => false,
                'expiry' => $expiry
            ]);

            Sms::otp([
                'phone' => $user->phone,
                'otp' => $token,
            ]);

            return response()->json([
                'status' => 1,
                'info' => 'Code resent successfully',
                'redirect' => route('signup.ui', ['success' => 'resent'])
            ]);
        }

        $verification->token = $token;
        $verification->user_id = $user_id;
        $verification->expiry = $expiry;
        $verification->verified = false;
        if ($verification->update()) {
            Sms::otp([
                'phone' => $user->phone,
                'otp' => $token,
            ]);

            return response()->json([
                'status' => 1,
                'info' => 'Code resent successfully',
                'redirect' => route('signup.ui', ['success' => 'resent'])
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Invalid Operation'
        ]);
    }

    /**
     * Verify phone number
     */
    public function verifyPhone()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'code' => ['required', 'min:6', 'max:6'], 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $code = $data['code'] ?? '';
        $verification = Verification::where([
            'token' => $code, 
            'type' => 'phone'
        ])->latest()->first();

        if (empty($verification)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid verification code'
            ]);
        }

        if(true === (boolean)$verification->verified) {
            return response()->json([
                'status' => 1,
                'info' => 'Already verified',
                'redirect' => route('login')
            ]);
        }

        if (Carbon::parse($verification->expiry)->diffInMinutes(Carbon::now()) > 60) {
            return response()->json([
                'status' => 0,
                'info' => 'Expired verification code'
            ]);
        }

        $verification->verified = true;
        $verification->token = '';
        if($verification->update()) {
            return response()->json([
                'status' => 1,
                'info' => 'Verification successfull',
                'redirect' => route('login')
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Verification failed'
        ]);
    }
}
