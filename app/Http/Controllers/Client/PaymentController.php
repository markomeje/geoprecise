<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\{Form, Payment};
use App\Paystack;
use Validator;
use Exception;

class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('client.payments.index', ['title' => 'All Payments', 'payments' => auth()->user()->payments]);
    }

    //
    public function pay()
    {
        $data = request()->all(['form_id', 'type', 'model_id', 'model', 'amount']);
        $type = $data['type'] ?? '';
        $amount = empty($data['amount']) ? 0 : (int)$data['amount'];

        $model_id = $data['model_id'] ?? '';
        $model = $data['model'] ?? '';
        if(empty($model) || empty($model_id) || empty($amount)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation.'
            ]);
        }

        try{
            $reference = \Str::uuid();
            $payment = Payment::create([
                'amount' => $amount,
                'user_id' => auth()->id(),
                'type' => $type,
                'status' => 'initialized',
                'paid' => false,
                'model_id' => $model_id,
                'verified' => false,
                'reference' => $reference,
                'model' => $model,
            ]);

            if ($payment) {
                $data = ['amount' => $amount, 'email' => auth()->user()->email, 'reference' => $reference];
                $paysack = (new Paystack())->initialize($data);
                return response()->json((false !== $paysack && isset($paysack->data)) ? ['status' => 1, 'info' => 'Redirecting, please accept . . .', 'redirect' => $paysack->data->authorization_url] : ['status' => 0, 'info' => 'Payment initialization failed. Try again later.']);
            }else {
                return response()->json([
                    'status' => 0,
                    'info' => 'Payment creation failed. Try again.'
                ]);
            }

        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        } 
    }

}
