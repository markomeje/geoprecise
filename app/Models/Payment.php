<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'amount',
        'model_id',
        'reference',
        'model',
        'user_id',
        'verified',
        'paid',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public static $verified = ['yes' => true, 'no' => false];

    /**
     * Scope only completed payments
     */
    public function scopePaid($query)
    {
        return $query->where(['status' => 'paid']);
    }

}
