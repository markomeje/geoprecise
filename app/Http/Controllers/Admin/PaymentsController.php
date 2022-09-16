<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{Payment, Psr, Survey};
use Carbon\Carbon;
use Validator;
use Exception;

class PaymentsController extends Controller
{
    //
    public function index()
    {
        return view('admin.payments.index', ['title' => 'All Payments', 'payments' => Payment::paid()->latest()->paginate(20)]);
    }

    /**
     * Record Payment
     */
    public function record()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'approved' => ['nullable', 'boolean'], 
            'amount' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $amount = (int)($data['amount'] ?? 0);
        $approved = (boolean)($data['approved'] ?? 0);
        $model_id = $data['model_id'] ?? '';
        $reference = $data['reference'] ?? '';
        $client_id = $data['client_id'] ?? 0;
        $model = $data['model'] ?? '';

        if(empty($model) || empty($model_id) || empty($amount) || empty($client_id)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation.'
            ]);
        }

        try{
            if (empty($reference)) {
                $payment = Payment::create([
                    'amount' => $amount,
                    'type' => $data['type'] ?? '',
                    'status' => 'paid',
                    'model_id' => $model_id,
                    'verified' => false,
                    'reference' => Str::uuid(),
                    'model' => $model,
                    'client_id' => $client_id,
                    'recorder_type' => 'staff',
                ]);

                if (empty($payment->id)) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Payment record failed. Try again.'
                    ]);
                }

                return response()->json([
                    'status' => 1,
                    'info' => 'Payment recorded successfully.',
                    'redirect' => ''
                ]);

            }else {
                $payment = Payment::where([
                    'reference' => $reference,
                    'client_id' => $client_id
                ])->first();

                if (empty($payment)) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Invalid payment record.'
                    ]);
                }

                $payment->type = $data['type'] ?? '';
                $payment->amount = $amount;
                $payment->status = 'paid';

                if ($payment->update()) {
                    return response()->json([
                        'status' => 1,
                        'info' => 'Payment record updated.',
                        'redirect' => '',
                    ]);
                }

                return response()->json([
                    'status' => 0,
                    'info' => 'Updating payment failed.'
                ]);
            }

        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        } 
    }

    /**
     * Approve payment
     */
    public function approve()
    {
        $data = request()->all();
        $model_id = $data['model_id'] ?? '';
        $reference = $data['reference'] ?? '';
        $client_id = $data['client_id'] ?? 0;
        $model = $data['model'] ?? '';

        if(empty($model) || empty($model_id) || empty($reference) || empty($client_id)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation. Try again.'
            ]);
        }

        try{
            $payment = Payment::where([
                'reference' => $reference,
                'client_id' => $client_id
            ])->first();

            if (empty($payment)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Invalid payment record.'
                ]);
            }

            switch ($model) {
                case 'survey':
                    $model = Survey::where(['id' => $model_id])->first();
                    break;
                case 'psr':
                    $model = Psr::where(['id' => $model_id])->first();
                    break;
                default:
                    throw new Exception('Invalid model name passed');
                    break;
            }

            if (empty($model)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Invalid model record.'
                ]);
            }

            if (empty($model->payment)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Unknown error. No payment details found.'
                ]);
            }

            $payment->approved = true;
            $payment->approved_at = Carbon::now();
            $payment->approved_by = auth()->id();
            $payment->verified = true;

            if ($payment->update()) {
                return response()->json([
                    'status' => 1,
                    'info' => 'Payment approved.',
                    'redirect' => '',
                ]);
            }

            return response()->json([
                'status' => 0,
                'info' => 'Updating payment failed.'
            ]);

        }catch(Exception $exception) {
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        } 
    }

}