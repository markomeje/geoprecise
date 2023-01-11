<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Mail\RecieptMail;
use Pdf;
use Mail;

class PdfController extends Controller
{
    //
    public function template($email = null)
    {
        $email = 'markomejeonline@gmail.com';
        $mail = new RecieptMail([
            'amount' => '18000', 
            'email' => $email, 
        ]);

        Mail::to($email)->send($mail);
  
        // $pdf = Pdf::loadView('emails.reciept', $data);
        // return $pdf->stream('reciept.pdf');
        // Mail::send('emails.reciept', $data, function($message) use($data, $email) {
        //     $message->to($email, $email)->subject('Geoprecise Payment Reciept');
        // });
    }

}