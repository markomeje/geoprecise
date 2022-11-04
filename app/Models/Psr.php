<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psr extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'form_id',
        'plot_numbers',
        'layout_id',
        'completed',
        'sold_by',
        'comments',
        'client_id',
        'status',
    ];


    /**
     * Property search requests status
     *
     * @var array<int, string>
     */
    public const STATUS = [
        'Buyer sell',
        'Agent',
        'Others',
        'Intending Buyer',
    ];

    /**
     * A property search request must belong to a client
     *
     * @var array<string, string>
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * A property search request must belong to a form
     *
     * @var array<string, string>
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * A property search request may have a payment
     *
     * @var array<string, string>
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'model_id')->where(['model' => 'psr', 'status' => 'paid']);
    }

    /**
     * A PSR belongs to a layout
     *
     * @var array<string, string>
     */
    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    /**
     * Approver of a particular psr.
     *
     * @var array<string, string>
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

     /**
     * Get the staff who recorded the psr.
     */
    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

}
