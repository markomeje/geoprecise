<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Mail\VerificationMail;
use Carbon\Carbon;
use Mail;
use App\Sms;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * Applicable user titles
     *
     */
    public const NAME_TITLES = [
        'mr',
        'prof.',
        'mrs',
        'dr.',
        'miss',
        'barr.',
        'miss',
        'none',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     */
    public static function boot() 
    {
        parent::boot();
        static::created(function($user) {
            if(!empty($user->email)) {
                $user_id = $user->id;
                $token = Str::random(64);
                Verification::create([
                    'token' => $token,
                    'type' => 'email',
                    'expiry' => Carbon::now()->addMinutes(60),
                    'user_id' => $user_id,
                    'verified' => false
                ]);

                $email = $user->email;
                $mail = new VerificationMail([
                    'token' => $token, 
                    'email' => $email, 
                ]);

                if (app()->environment('production')) {
                    Mail::to($email)->send($mail);
                }
                
            }

            $otp = random_int(100000, 999999);
            Verification::create([
                'token' => $otp,
                'type' => 'phone',
                'expiry' => Carbon::now()->addMinutes(60),
                'user_id' => $user_id,
                'verified' => false
            ]);

            if (app()->environment('production')) {
                Sms::otp([
                    'phone' => $user->phone,
                    'otp' => $otp,
                ]);
            }

        });
        
    }

    /**
     * A user may have one profile image
     *
     * @var array<string, string>
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'model_id');
    }

    /**
     * A user may have one client details
     *
     * @var array<string, string>
     */
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    /**
     * A user may have many payments
     *
     * @var array<string, string>
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * A user may have one staff details
     *
     * @var array<string, string>
     */
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    /**
     * A user may have one may verifications
     *
     * @var array<string, string>
     */
    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

}