<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Validator;
use Exception;

class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('auth.login.index', ['title' => 'Login | Geoprecise Group']);
    }

    public function pay()
    {
        try{
            $reference = paystack()->genTranxRef();
            $info = ['amount' => $data['amount'], "currency" => "NGN", 'email' => auth()->user()->email, 'reference' => $reference];
        //     "amount" => 700 * 100,
        // "reference" => '4g4g5485g8545jg8gj',
        // "email" => 'user@mail.com',
        // "currency" => "NGN",
        // "orderID" => 23456,
            $paysack = paystack()->getAuthorizationUrl($info);
        }catch(Exception $exception) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        } 
    }
}
