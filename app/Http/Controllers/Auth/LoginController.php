<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\{User, Verification};
use Validator;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login.index', ['title' => 'Login | Geoprecise Group']);
    }

    //
    public function login()
    {
        $data = request()->only(['phone', 'password']);
        $validator = Validator::make($data, [
            'phone' => ['required'], 
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ], 200);
        }

        $phone = $data['phone'] ?? '';
        $user = User::where(['phone' => $phone])->first();
        if (empty($user)) {
            return [
                'status' => 0,
                'info' => 'Invalid login details.'
            ];
        }

        $verification = Verification::where(['type' => 'phone', 'user_id' => $user->id])->latest()->get()->first();
        if (empty($verification)) {
            return response()->json([
                'status' => 0,
                'info' => 'Please verify your phone number. A verification code was sent to your phone during signup.',
            ]);
        }

        if (true !== (boolean)$verification->verified && app()->environment('production')) {
            return response()->json([
                'status' => 0,
                'info' => 'Please verify your phone number. A verification code was sent to your phone during signup.',
            ]);
        }

        if (auth()->attempt(['password' => $data['password'], 'phone' => $phone], true)) {
            request()->session()->regenerate();
            return response()->json([
                'status' => 1,
                'info' => 'Login successful. Please wait . . .', 
                'redirect' => auth()->user()->role === 'client' ? route('client') : route('admin'),
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Invalid login details'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->invalidate();

        $redirect = request()->query('redirect');
        return Route::has($redirect) ? redirect()->route($redirect) : redirect()->route('login');
    }
}
