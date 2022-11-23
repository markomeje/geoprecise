<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Mail\VerificationMail;
use Carbon\Carbon;
use Validator;
use Mail;
use App\Sms;

class Verification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'verified',
        'user_id',
        'type',
        'expiry',
        'status',
        'model',
        'model_id',
    ];

    public static function boot() 
    {
        parent::boot();
        static::created(function($Verification) {
            if(!empty($Verification['email'])) {
                $mail = new VerificationMail([
                    'token' => $token, 
                    'email' => $data['email'], 
                ]);

                Mail::to($data['email'])->send($mail);
            }
        });
        
    }

    public static function sendVerificationEmail($data = []) : void
    {
        $token = Str::random(64);
        self::create([
            'token' => $token,
            'type' => 'email',
            'expiry' => Carbon::now()->addMinutes(60),
            'user_id' => $data['user_id'],
            'verified' => false
        ]);

        $mail = new VerificationMail([
            'token' => $token, 
            'email' => $data['email'], 
        ]);

        Mail::to($data['email'])->send($mail);
    }

    public static function sendVerificationSms($data = []) : void
    {
        $otp = random_int(100000, 999999);
        self::create([
            'token' => $otp,
            'type' => 'otp',
            'expiry' => Carbon::now()->addMinutes(10),
            'user_id' => $data['user_id'],
            'verified' => false
        ]);

        Sms::otp([
            'phone' => $data['phone'],
            'otp' => $otp,
        ]);
    }
}
