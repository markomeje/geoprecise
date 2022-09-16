<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

}