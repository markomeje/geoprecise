<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Layout;
use Validator;

class PaymentsController extends Controller
{
    //
    public function index()
    {
        return view('admin.layouts.index', ['title' => 'All Layouts', 'layouts' => Layout::all()]);
    }

    //
    public function record()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'verified' => ['nullable', 'boolean'], 
            'amount' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        return $data;

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
            $reference = Str::uuid();
            $payment = Payment::create([
                'amount' => $amount,
                'user_id' => auth()->id(),
                'type' => $data['type'] ?? '',
                'status' => 'initialized',
                'model_id' => $model_id,
                'verified' => false,
                'reference' => $reference,
                'model' => $model,
            ]);

            if (empty($payment->id)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Payment record failed. Try again.'
                ]);
            }else {
                $data = ['amount' => $amount, 'email' => auth()->user()->email, 'reference' => $reference];
                $paysack = (new Paystack())->initialize($data);
                $response = (false !== $paysack && isset($paysack->data)) ? ['status' => 1, 'info' => 'Redirecting, please accept . . .', 'redirect' => $paysack->data->authorization_url] : ['status' => 0, 'info' => 'Payment initialization failed. Try again later.'];
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