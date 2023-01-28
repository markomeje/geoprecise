<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reprinting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'total_copies',
        'approved_at',
        'plan_id',
        'status',
        'layout_id',
        'plot_number',
        'approved',
        'form_id',
        'approved_by',
        'agree'
    ];

     /**
     * A Reprinting may belong to a user
     *
     * @var array<string, string>
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * A Reprinting may belong to a layout
     *
     * @var array<string, string>
     */
    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    /**
     * A reprinting has many document
     *
     * @var array<string, string>
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'model_id')->where(['model' => 'reprinting']);
    }

    /**
     * A Reprinting has one payment
     *
     * @var array<string, string>
     * cd xamc
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'model_id')->where(['model' => 'reprinting', 'status' => 'paid']);
    }

    /**
     * A Reprinting may belong to a form
     *
     * @var array<string, string>
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}
