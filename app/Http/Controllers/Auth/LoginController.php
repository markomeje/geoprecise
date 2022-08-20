<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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
        $data = request()->only(['email', 'password']);
        $validator = Validator::make($data, [
            'email' => ['required'], 
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ], 200);
        }

        $email = $data['email'] ?? '';
        $user = User::where(['email' => $email])->first();
        if (empty($user)) {
            return [
                'status' => 0,
                'info' => 'Invalid login details.'
            ];
        }

        if (auth()->attempt(['password' => $data['password'], 'email' => $email], true)) {
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
        ], 500);
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
