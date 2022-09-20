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
        'client_id',
        'verified',
        'paid',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public static $approved = ['yes' => true, 'no' => false];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public static $types = [
        'bank transfer',
        'pos',
        'bank deposit',
        'ussd',
    ];

    /**
     * Scope only completed payments
     */
    public function scopePaid($query)
    {
        return $query->where(['status' => 'paid']);
    }

    /**
     * Get the staff who recorded the payment.
     */
    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Get the staff who approved the payment.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * A payment belongs to a client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
