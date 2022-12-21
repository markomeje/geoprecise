<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{Form, Payment};
use App\Paystack;
use Validator;
use Exception;

class PaymentController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        return view('client.payments.index', ['title' => 'All Payments', 'payments' => Payment::paid()->latest('id')->where(['client_id' => $user->client ? $user->client->id : null])->get()]);
    }

    //
    public function process()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'amount' => ['required'],
            'agree' => ['required'],
        ], ['agree.required' => 'You must agree to our terms and consitions.']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors(),
            ]);
        }

        if (empty($data['model_id']) || empty($data['model'])) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }

        try{
            $amount = $data['amount'] ?: 0;
            $reference = Str::uuid();
            $payment = Payment::create([
                'amount' => $amount,
                'client_id' => auth()->user()->client->id,
                'type' => 'paystack',
                'status' => 'initialized',
                'model_id' => $data['model_id'],
                'verified' => false,
                'reference' => $reference,
                'model' => $data['model'],
                'recorder_type' => '',
            ]);

            if (empty($payment->id)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Payment record failed. Try again.'
                ]);
            }else {
                $data = ['amount' => $amount, 'email' => auth()->user()->email, 'reference' => $reference];
                $paysack = (new Paystack())->initialize($data);
                $response = (false !== $paysack && isset($paysack->data)) ? ['status' => 1, 'info' => 'Redirecting, Click Ok', 'redirect' => $paysack->data->authorization_url] : ['status' => 0, 'info' => 'Payment initialization failed. Try again later.'];
                return response()->json($response);
            }
        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        } 
    }

}
