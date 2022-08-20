<?php

namespace App;
use Yabacon\Paystack as Yabacon;
use Yabacon\Paystack\Exception\ApiException;
use Illuminate\Support\Facades\Log;


class Paystack 
{
    
    /**
     * @var object
     */
	public $paystack;

    /**
     * Call paystack 
     */
	public function __construct() 
    {
		$this->paystack = new Yabacon(env('PAYSTACK_SECRET_KEY'));
	}

    /**
     * $data = ['amount', 'email', reference]
     * Initialize paystack transaction
     */
	public function initialize($data = []) 
    {
        try{
            $data['amount'] = (int)$data['amount'] * 100; //Converting to kobo
            return $this->paystack->transaction->initialize($data);
        } catch(ApiException $error){
            Log::error($error->getMessage());
            return false;
	    }
    }

    /**
     * Verify paystack transaction
     */
    public function verify($reference = '') 
    {
        try{
            return $this->paystack->transaction->verify(['reference' => $reference]);
        } catch(ApiException $error){
        	Log::error($error->getMessage());
            return false;
	    }
    }

}