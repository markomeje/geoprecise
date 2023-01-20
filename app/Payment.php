<?php

namespace App;
use App\Paystack;
use App\Mail\RecieptMail;
use Exception;
use Mail;


class Payment 
{
    /**
     * Verify paystack payment
     */
    public static function verify($reference = '') 
    {
        if (empty($reference)) {
            return [
                'status' => 0,
                'info' => 'Invalid payment reference',
            ];
        }

        $payment = \App\Models\Payment::where([
            'reference' => $reference,
            'client_id' => auth()->user()->client->id,
        ])->first();

        if (empty($payment)) {
            return [
                'status' => 0,
                'info' => 'Invalid payment transaction',
            ];
        }

        if ('paid' === strtolower($payment->status)) {
            return [
                'status' => 1,
                'info' => 'Payment already verified',
            ];
        }

        $paystack = (new Paystack())->verify($reference);
        if (is_object($paystack) && isset($paystack->data)) {
        	$status = (string)$paystack->data->status ?? '';
        	if('success' === strtolower($status)) {
        		$payment->status = 'paid';
        		$payment->update();

                if (!empty(auth()->user()->email)) {
                    $email = auth()->user()->email;
                    $mail = new RecieptMail([
                        'amount' => $payment->amount, 
                        'email' => $email, 
                    ]);

                    Mail::to($email)->send($mail);
                }
                
        		return [
        			'status' => 1, 
        			'info' => 'Payment verified successfully.'
        		];
        	}

        	$payment->status = $status;
        	$payment->update();

        	return [
        		'status' => 0, 
        		'info' => 'Invalid payment verification.'
        	];
        }

        return [
            'status' => 0,
            'info' => 'Transaction failed. Try again.',
        ];
    }

}