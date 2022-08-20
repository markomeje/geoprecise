<?php

namespace App;
use App\Paystack;
use Exception;


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
            'user_id' => auth()->id(),
        ])->first();

        if (empty($payment)) {
            return [
                'status' => 0,
                'info' => 'Invalid payment transaction',
            ];
        }

        if ('paid' === strtolower($payment->status) && true === (boolean)$payment->paid) {
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
        		$payment->paid = true;
        		$payment->update();
        		return [
        			'status' => 1, 
        			'info' => 'Payment verified successfully.'
        		];
        	}

        	$payment->status = $status;
        	$payment->paid = false;
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