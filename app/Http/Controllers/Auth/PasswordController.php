<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\{User, Password};
use \Carbon\Carbon;
use App\Sms;
use Validator;
use Exception;
use Hash;

class PasswordController extends Controller
{
    //
    public function reset()
    {
        return view('auth.password.reset', ['title' => 'Reset Password']);
    }

    /**
     * Process password reset
     * 
     * @return json
     */
    public function process()
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

        try{
            $code = rand(123456, 456789);
            $user = User::where(['phone' => $data['phone_number']])->first();
            $reset = Password::create([
                'user_id' => $user->id ?? null,
                'code' => $code,
                'expiry' => Carbon::now()->addMinutes(60),
            ]);

            if ($reset) {
                $sms = Sms::otp([
                    'phone' => $data['phone_number'], 
                    'otp' => $code
                ]);

                if (($sms['status'] ?? 0) === 1) {
                    return response()->json([
                        'status' => 1,
                        'info' => 'Operation successful.',
                        'redirect' => route('password.reset'),
                    ]);
                }

                return response()->json([
                    'status' => 0,
                    'info' => 'Could not send sms. Please try again later'
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Operation failed'
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);
        } 
    }

    /**
     * Password reset
     * 
     * @return json
     */
    public function update()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'otp_code' => ['required', 'min:6', 'max:6'],
            'password' => ['required'], 
            'confirm_password' => ['required', 'same:password'], 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try{
            $reset = Password::where(['code' => $data['otp_code']])->get()->last();
            if (empty($reset)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Invalid code.'
                ]);
            }

            $user = $reset->user;
            if (empty($user)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Invalid user account. Try again later.'
                ]);
            }

            if (Carbon::now()->diffInMinutes($reset->expiry) > 60) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Code expired. Try again.'
                ]);
            }

            $user->password = Hash::make($data['password']);
            if ($user->update()) {
                $reset->code = null;
                $reset->update();
                return response()->json([
                    'status' => 1,
                    'info' => 'Operation successful',
                    'redirect' => route('login'),
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Operation failed'
            ]);
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Operation failed. Try again.'
            ]);
        } 
    }
}
